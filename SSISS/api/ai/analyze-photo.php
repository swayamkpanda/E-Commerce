<?php

/*
|--------------------------------------------------------------------------
| SSISS AI - PHOTO ANALYSIS
|--------------------------------------------------------------------------
| Real OpenRouter Vision API
|
| Input:
| {
|     "image": "data:image/jpeg;base64,...",
|     "gender": "men",
|     "occasion": "casual"
| }
|
| Output:
| Fashion analysis JSON
|--------------------------------------------------------------------------
*/

header('Content-Type: application/json');


try {

    // ======================================================
    // LOAD OPENROUTER
    // ======================================================

    require_once __DIR__ . '/openrouter.php';


    // ======================================================
    // ONLY POST
    // ======================================================

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

        http_response_code(405);

        echo json_encode([
            'success' => false,
            'message' => 'Only POST requests are allowed.'
        ], JSON_PRETTY_PRINT);

        exit;
    }


    // ======================================================
    // READ JSON
    // ======================================================

    $input = json_decode(
        file_get_contents('php://input'),
        true
    );


    if (!is_array($input)) {

        http_response_code(400);

        echo json_encode([
            'success' => false,
            'message' => 'Invalid JSON request.'
        ], JSON_PRETTY_PRINT);

        exit;
    }


    // ======================================================
    // GET DATA
    // ======================================================

    $image = trim(
        $input['image'] ?? ''
    );

    $gender = trim(
        $input['gender'] ?? 'not specified'
    );

    $occasion = trim(
        $input['occasion'] ?? 'not specified'
    );

    $stylePreference = trim(
        $input['style'] ?? 'not specified'
    );


    // ======================================================
    // VALIDATE IMAGE
    // ======================================================

    if ($image === '') {

        http_response_code(422);

        echo json_encode([
            'success' => false,
            'message' => 'Image is required.'
        ], JSON_PRETTY_PRINT);

        exit;
    }


    // ======================================================
    // BASIC IMAGE VALIDATION
    // ======================================================

    if (
        strpos($image, 'data:image/') !== 0
    ) {

        http_response_code(422);

        echo json_encode([
            'success' => false,
            'message' =>
                'Image must be a base64 data URL.'
        ], JSON_PRETTY_PRINT);

        exit;
    }


    // ======================================================
    // LIMIT IMAGE SIZE
    // ======================================================

    /*
    | Approximately 8 MB maximum request image.
    */

    if (strlen($image) > 8 * 1024 * 1024) {

        http_response_code(413);

        echo json_encode([
            'success' => false,
            'message' =>
                'Image is too large. Please use an image under 8 MB.'
        ], JSON_PRETTY_PRINT);

        exit;
    }


    // ======================================================
    // AI PROMPT
    // ======================================================

    $prompt = <<<PROMPT

You are SSISS AI, a professional fashion stylist.

Analyze the uploaded person's photo for fashion styling purposes.

Do NOT identify the person.

Do NOT guess their name, identity, ethnicity, religion,
medical condition, or other sensitive personal information.

Focus only on visible fashion and styling information.

USER INFORMATION:

Gender preference: {$gender}

Occasion: {$occasion}

Preferred style: {$stylePreference}


ANALYZE:

1. Visible clothing.
2. Clothing colours.
3. Clothing categories.
4. Overall visible style.
5. Outfit coordination.
6. Suitable colours.
7. Suitable clothing combinations.
8. Styling improvements.
9. Accessories that would complement the outfit.


IMPORTANT:

- Only describe what is visually useful for fashion.
- Do not make sensitive personal inferences.
- Do not identify the person.
- If something cannot be determined from the image, say "not visible".
- Return ONLY valid JSON.
- Do not use Markdown.
- Do not wrap the response in ```.


RETURN EXACTLY THIS JSON STRUCTURE:

{
    "overall_style": {
        "name": "string",
        "description": "string",
        "score": 0
    },

    "visible_outfit": {
        "top": "string",
        "bottom": "string",
        "footwear": "string",
        "accessories": "string"
    },

    "colour_analysis": {
        "detected_colours": [
            "string"
        ],
        "recommended_colours": [
            "string"
        ],
        "complementary_colours": [
            "string"
        ]
    },

    "style_recommendations": {
        "tops": [
            "string"
        ],
        "bottoms": [
            "string"
        ],
        "footwear": [
            "string"
        ],
        "accessories": [
            "string"
        ]
    },

    "improvements": [
        "string",
        "string",
        "string"
    ],

    "summary": "string"
}

PROMPT;


    // ======================================================
    // OPENROUTER REQUEST
    // ======================================================

    $payload = [

        'model' => 'openrouter/free',

        'messages' => [

            [
                'role' => 'user',

                'content' => [

                    [
                        'type' => 'text',

                        'text' => $prompt
                    ],

                    [
                        'type' => 'image_url',

                        'image_url' => [

                            'url' => $image

                        ]

                    ]

                ]

            ]

        ]

    ];


    // ======================================================
    // SEND REQUEST DIRECTLY
    // ======================================================

    $configPath =
        __DIR__ . '/../../config/ai_config.php';


    if (!file_exists($configPath)) {

        throw new Exception(
            'AI configuration file not found.'
        );
    }


    $config =
        require $configPath;


    $apiKey =
        $config['api_key'] ?? '';


    if (
        $apiKey === '' ||
        $apiKey === 'YOUR_OPENROUTER_API_KEY'
    ) {

        throw new Exception(
            'OpenRouter API key is not configured.'
        );
    }


    $ch = curl_init(
        'https://openrouter.ai/api/v1/chat/completions'
    );


    curl_setopt_array($ch, [

        CURLOPT_POST => true,

        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_HTTPHEADER => [

            'Authorization: Bearer ' . $apiKey,

            'Content-Type: application/json',

            'HTTP-Referer: http://localhost',

            'X-Title: SSISS Fashion AI'

        ],

        CURLOPT_POSTFIELDS =>
            json_encode($payload),

        CURLOPT_TIMEOUT => 120

    ]);


    $response =
        curl_exec($ch);


    // ======================================================
    // CURL ERROR
    // ======================================================

    if ($response === false) {

        $curlError =
            curl_error($ch);

        curl_close($ch);

        throw new Exception(
            'OpenRouter connection failed: ' .
            $curlError
        );
    }


    $httpCode =
        curl_getinfo(
            $ch,
            CURLINFO_HTTP_CODE
        );


    curl_close($ch);


    // ======================================================
    // DECODE RESPONSE
    // ======================================================

    $data =
        json_decode(
            $response,
            true
        );


    // ======================================================
    // OPENROUTER ERROR
    // ======================================================

    if ($httpCode >= 400) {

        $message =
            $data['error']['message']
            ?? 'Unknown OpenRouter API error.';

        throw new Exception(
            'OpenRouter API error: ' .
            $message
        );
    }


    // ======================================================
    // GET AI TEXT
    // ======================================================

    $aiText =
        $data['choices'][0]['message']['content']
        ?? '';


    if ($aiText === '') {

        throw new Exception(
            'AI returned an empty response.'
        );
    }


    // ======================================================
    // REMOVE MARKDOWN
    // ======================================================

    $aiText =
        trim($aiText);


    $aiText =
        preg_replace(
            '/^```json\s*/i',
            '',
            $aiText
        );


    $aiText =
        preg_replace(
            '/^```\s*/',
            '',
            $aiText
        );


    $aiText =
        preg_replace(
            '/\s*```$/',
            '',
            $aiText
        );


    $aiText =
        trim($aiText);


    // ======================================================
    // DECODE AI JSON
    // ======================================================

    $analysis =
        json_decode(
            $aiText,
            true
        );


    if (!is_array($analysis)) {

        throw new Exception(
            'AI returned invalid JSON.'
        );
    }


    // ======================================================
    // FINAL RESPONSE
    // ======================================================

    echo json_encode([

        'success' => true,

        'message' =>
            'Photo analyzed successfully.',

        'analysis' =>
            $analysis

    ], JSON_PRETTY_PRINT);

    exit;


} catch (Throwable $e) {

    // ======================================================
    // ERROR RESPONSE
    // ======================================================

    http_response_code(500);

    echo json_encode([

        'success' => false,

        'message' =>
            'Photo analysis failed.',

        'error' =>
            $e->getMessage()

    ], JSON_PRETTY_PRINT);

    exit;
}
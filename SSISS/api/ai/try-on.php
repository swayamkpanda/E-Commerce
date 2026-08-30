<?php

/*
|--------------------------------------------------------------------------
| SSISS AI - VIRTUAL TRY-ON
|--------------------------------------------------------------------------
| Model:
| recraft/recraft-v3:free
|--------------------------------------------------------------------------
*/

header('Content-Type: application/json');

try {

    // ==========================================================
    // ONLY POST
    // ==========================================================

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

        http_response_code(405);

        echo json_encode([
            'success' => false,
            'message' => 'Only POST requests are allowed.'
        ], JSON_PRETTY_PRINT);

        exit;
    }


    // ==========================================================
    // LOAD CONFIG
    // ==========================================================

    $configPath =
        __DIR__ . '/../../config/ai_config.php';

    if (!file_exists($configPath)) {

        throw new Exception(
            'AI configuration file not found.'
        );
    }

    $config = require $configPath;


    // ==========================================================
    // GET API KEY
    // ==========================================================

    $apiKey =
        $config['openrouter_api_key']
        ?? $config['api_key']
        ?? '';

    if ($apiKey === '') {

        throw new Exception(
            'OpenRouter API key is not configured.'
        );
    }


    // ==========================================================
    // READ REQUEST
    // ==========================================================

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


    // ==========================================================
    // GET IMAGE
    // ==========================================================

    $image =
        trim($input['image'] ?? '');

    if ($image === '') {

        http_response_code(422);

        echo json_encode([
            'success' => false,
            'message' => 'Reference image is required.'
        ], JSON_PRETTY_PRINT);

        exit;
    }


    // ==========================================================
    // VALIDATE IMAGE
    // ==========================================================

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


    // ==========================================================
    // USER OPTIONS
    // ==========================================================

    $clothing =
        trim(
            $input['clothing'] ??
            'a stylish modern outfit'
        );

    $style =
        trim(
            $input['style'] ??
            'modern'
        );

    $colour =
        trim(
            $input['colour'] ??
            'neutral'
        );

    $occasion =
        trim(
            $input['occasion'] ??
            'casual'
        );


    // ==========================================================
    // PROMPT
    // ==========================================================

    $prompt = <<<PROMPT

Create a realistic fashion virtual try-on image.

Use the provided reference photograph of the person.

Keep the same person, face, hairstyle, body proportions, pose,
camera perspective and environment as much as possible.

Change the clothing to:

{$clothing}

Style:

{$style}

Colour:

{$colour}

Occasion:

{$occasion}

The clothing should look naturally worn by the person.

Match the original lighting, shadows and perspective.

Make the result photorealistic.

Do not add another person.

Do not remove the person.

Do not change the person's identity.

Do not make unrealistic body changes.

This is a fashion virtual try-on.

PROMPT;


    // ==========================================================
    // OPENROUTER IMAGE REQUEST
    // ==========================================================

    $payload = [

        'model' =>
            'recraft/recraft-v3:free',

        'prompt' =>
            $prompt,

        'input_references' => [

            [
                'type' => 'image_url',

                'image_url' => [

                    'url' =>
                        $image

                ]
            ]

        ],

        'n' => 1,

        'aspect_ratio' => '3:4',

        'image_config' => [

            'strength' => 0.65

        ]

    ];


    // ==========================================================
    // CURL
    // ==========================================================

    $ch = curl_init(
        'https://openrouter.ai/api/v1/images'
    );

    curl_setopt_array($ch, [

        CURLOPT_POST => true,

        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_HTTPHEADER => [

            'Authorization: Bearer ' .
                $apiKey,

            'Content-Type: application/json',

            'HTTP-Referer: http://localhost',

            'X-Title: SSISS Virtual Try-On'

        ],

        CURLOPT_POSTFIELDS =>
            json_encode($payload),

        CURLOPT_TIMEOUT => 180

    ]);


    // ==========================================================
    // SEND
    // ==========================================================

    $response =
        curl_exec($ch);


    if ($response === false) {

        $error =
            curl_error($ch);

        curl_close($ch);

        throw new Exception(
            'OpenRouter connection failed: ' .
            $error
        );
    }


    // ==========================================================
    // STATUS
    // ==========================================================

    $httpCode =
        curl_getinfo(
            $ch,
            CURLINFO_HTTP_CODE
        );

    curl_close($ch);


    // ==========================================================
    // DECODE
    // ==========================================================

    $result =
        json_decode(
            $response,
            true
        );


    if (!is_array($result)) {

        throw new Exception(
            'OpenRouter returned invalid JSON.'
        );
    }


    // ==========================================================
    // API ERROR
    // ==========================================================

    if ($httpCode >= 400) {

        $errorMessage =
            $result['error']['message']
            ?? 'Unknown OpenRouter image error.';

        throw new Exception(
            'OpenRouter API error: ' .
            $errorMessage
        );
    }


    // ==========================================================
    // GET IMAGE
    // ==========================================================

    $generatedImage =
        $result['data'][0]['b64_json']
        ?? '';

    $mediaType =
        $result['data'][0]['media_type']
        ?? 'image/png';


    if ($generatedImage === '') {

        throw new Exception(
            'No generated image was returned.'
        );
    }


    // ==========================================================
    // DECODE IMAGE
    // ==========================================================

    $imageBytes =
        base64_decode(
            $generatedImage,
            true
        );


    if ($imageBytes === false) {

        throw new Exception(
            'Unable to decode generated image.'
        );
    }


    // ==========================================================
    // OUTPUT DIRECTORY
    // ==========================================================

    $outputDirectory =
        __DIR__ .
        '/../../ai/generated';


    if (!is_dir($outputDirectory)) {

        if (
            !mkdir(
                $outputDirectory,
                0777,
                true
            )
        ) {

            throw new Exception(
                'Unable to create generated folder.'
            );
        }
    }


    // ==========================================================
    // FILE EXTENSION
    // ==========================================================

    $extension = 'png';

    if ($mediaType === 'image/jpeg') {

        $extension = 'jpg';

    } elseif ($mediaType === 'image/webp') {

        $extension = 'webp';

    }


    // ==========================================================
    // FILE NAME
    // ==========================================================

    $fileName =
        'try-on-' .
        date('Ymd-His') .
        '-' .
        bin2hex(
            random_bytes(4)
        ) .
        '.' .
        $extension;


    $filePath =
        $outputDirectory .
        DIRECTORY_SEPARATOR .
        $fileName;


    // ==========================================================
    // SAVE IMAGE
    // ==========================================================

    if (
        file_put_contents(
            $filePath,
            $imageBytes
        ) === false
    ) {

        throw new Exception(
            'Unable to save generated image.'
        );
    }


    // ==========================================================
    // BROWSER URL
    // ==========================================================

    $imageUrl =
        '/E-Commerce/SSISS/ai/generated/' .
        $fileName;


    // ==========================================================
    // SUCCESS
    // ==========================================================

    echo json_encode([

        'success' => true,

        'message' =>
            'Virtual try-on generated successfully.',

        'model' =>
            'recraft/recraft-v3:free',

        'image' => [

            'file' =>
                $fileName,

            'url' =>
                $imageUrl,

            'media_type' =>
                $mediaType

        ],

        'request' => [

            'clothing' =>
                $clothing,

            'style' =>
                $style,

            'colour' =>
                $colour,

            'occasion' =>
                $occasion

        ]

    ], JSON_PRETTY_PRINT);

    exit;


} catch (Throwable $e) {

    // ==========================================================
    // ERROR
    // ==========================================================

    http_response_code(500);

    echo json_encode([

        'success' => false,

        'message' =>
            'Virtual try-on failed.',

        'error' =>
            $e->getMessage()

    ], JSON_PRETTY_PRINT);

    exit;
}
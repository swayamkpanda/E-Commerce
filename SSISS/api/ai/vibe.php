<?php

/*
|--------------------------------------------------------------------------
| SSISS AI - VIBE API
|--------------------------------------------------------------------------
| Real OpenRouter AI integration
|--------------------------------------------------------------------------
*/

header('Content-Type: application/json');

try {

    /*
    |--------------------------------------------------------------------------
    | Load OpenRouter connector
    |--------------------------------------------------------------------------
    */

    require_once __DIR__ . '/openrouter.php';


    /*
    |--------------------------------------------------------------------------
    | Only POST requests
    |--------------------------------------------------------------------------
    */

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

        http_response_code(405);

        echo json_encode([
            'success' => false,
            'message' => 'Only POST requests are allowed.'
        ]);

        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | Read JSON request
    |--------------------------------------------------------------------------
    */

    $input = json_decode(
        file_get_contents('php://input'),
        true
    );


    if (!is_array($input)) {

        http_response_code(400);

        echo json_encode([
            'success' => false,
            'message' => 'Invalid JSON request.'
        ]);

        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | Get user preferences
    |--------------------------------------------------------------------------
    */

    $vibe = trim(
        $input['vibe'] ?? ''
    );

    $gender = trim(
        $input['gender'] ?? ''
    );

    $budget = trim(
        $input['budget'] ?? ''
    );

    $occasion = trim(
        $input['occasion'] ?? ''
    );

    $colour = trim(
        $input['colour'] ?? ''
    );

    $season = trim(
        $input['season'] ?? ''
    );


    /*
    |--------------------------------------------------------------------------
    | Validate required fields
    |--------------------------------------------------------------------------
    */

    if (
        $vibe === '' ||
        $gender === '' ||
        $budget === '' ||
        $occasion === ''
    ) {

        http_response_code(422);

        echo json_encode([
            'success' => false,
            'message' =>
                'Vibe, gender, budget and occasion are required.'
        ]);

        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | AI PROMPT
    |--------------------------------------------------------------------------
    */

    $prompt = <<<PROMPT

You are SSISS AI, an expert personal fashion stylist.

Create a complete fashion outfit based on the user's preferences.

USER INFORMATION:

Vibe: {$vibe}

Gender: {$gender}

Budget: ₹{$budget}

Occasion: {$occasion}

Preferred Colour: {$colour}

Season: {$season}


IMPORTANT RULES:

1. Stay within the user's budget.
2. Recommend realistic clothing items.
3. Make all pieces work together as one outfit.
4. Consider the occasion.
5. Consider the season.
6. Consider the selected vibe.
7. Avoid recommending luxury products that exceed the budget.
8. Give practical fashion advice.
9. Return ONLY valid JSON.
10. Do not use markdown.
11. Do not add ``` around the JSON.


Return exactly this structure:

{
    "title": "string",
    "description": "string",
    "style_score": 0,
    "colour_palette": [
        "string",
        "string",
        "string"
    ],
    "outfit": {
        "top": {
            "name": "string",
            "reason": "string"
        },
        "bottom": {
            "name": "string",
            "reason": "string"
        },
        "shoes": {
            "name": "string",
            "reason": "string"
        },
        "accessory": {
            "name": "string",
            "reason": "string"
        }
    },
    "styling_tips": [
        "string",
        "string",
        "string"
    ],
    "estimated_total": 0
}

PROMPT;


    /*
    |--------------------------------------------------------------------------
    | Call OpenRouter
    |--------------------------------------------------------------------------
    */

    $response = openRouterChat(
        $prompt
    );


    /*
    |--------------------------------------------------------------------------
    | Get AI response text
    |--------------------------------------------------------------------------
    */

    $aiText = openRouterText(
        $response
    );


    if ($aiText === '') {

        throw new Exception(
            'AI returned an empty response.'
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Remove accidental markdown fences
    |--------------------------------------------------------------------------
    */

    $aiText = trim($aiText);

    $aiText = preg_replace(
        '/^```json\s*/i',
        '',
        $aiText
    );

    $aiText = preg_replace(
        '/^```\s*/',
        '',
        $aiText
    );

    $aiText = preg_replace(
        '/\s*```$/',
        '',
        $aiText
    );

    $aiText = trim($aiText);


    /*
    |--------------------------------------------------------------------------
    | Decode AI JSON
    |--------------------------------------------------------------------------
    */

    $outfit = json_decode(
        $aiText,
        true
    );


    if (!is_array($outfit)) {

        throw new Exception(
            'AI returned invalid JSON.'
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Final response
    |--------------------------------------------------------------------------
    */

    echo json_encode([

        'success' => true,

        'message' =>
            'SSISS Vibe AI generated successfully.',

        'request' => [

            'vibe' => $vibe,

            'gender' => $gender,

            'budget' => $budget,

            'occasion' => $occasion,

            'colour' => $colour,

            'season' => $season

        ],

        'ai' => $outfit

    ], JSON_PRETTY_PRINT);

    exit;


} catch (Throwable $e) {

    /*
    |--------------------------------------------------------------------------
    | Error
    |--------------------------------------------------------------------------
    */

    http_response_code(500);

    echo json_encode([

        'success' => false,

        'message' =>
            'SSISS AI request failed.',

        'error' =>
            $e->getMessage()

    ], JSON_PRETTY_PRINT);

    exit;
}
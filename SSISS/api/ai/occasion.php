<?php

/*
|--------------------------------------------------------------------------
| SSISS AI - OCCASION STYLIST
|--------------------------------------------------------------------------
| Real OpenRouter AI integration
|--------------------------------------------------------------------------
*/

header('Content-Type: application/json');


try {

    // ==========================================================
    // LOAD OPENROUTER CONNECTOR
    // ==========================================================

    require_once __DIR__ . '/openrouter.php';


    // ==========================================================
    // ONLY POST REQUESTS
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
    // READ JSON REQUEST
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
    // GET USER INFORMATION
    // ==========================================================

    $gender = trim(
        $input['gender'] ?? ''
    );

    $occasion = trim(
        $input['occasion'] ?? ''
    );

    $budget = trim(
        $input['budget'] ?? ''
    );

    $season = trim(
        $input['season'] ?? ''
    );

    $style = trim(
        $input['style'] ?? ''
    );

    $colour = trim(
        $input['colour'] ?? ''
    );

    $location = trim(
        $input['location'] ?? ''
    );


    // ==========================================================
    // VALIDATION
    // ==========================================================

    if (
        $gender === '' ||
        $occasion === '' ||
        $budget === ''
    ) {

        http_response_code(422);

        echo json_encode([
            'success' => false,
            'message' =>
                'Gender, occasion and budget are required.'
        ], JSON_PRETTY_PRINT);

        exit;
    }


    // ==========================================================
    // CREATE AI PROMPT
    // ==========================================================

    $prompt = <<<PROMPT

You are SSISS AI, a professional personal fashion stylist.

Create a complete outfit specifically for the user's occasion.

USER INFORMATION:

Gender: {$gender}

Occasion: {$occasion}

Budget: ₹{$budget}

Season: {$season}

Preferred Style: {$style}

Preferred Colour: {$colour}

Location: {$location}


YOUR TASK:

Design ONE complete outfit that is appropriate for the occasion.

Think about:

- Dress code
- Formality
- Weather
- Season
- Colour coordination
- Comfort
- Current fashion
- Accessories
- Footwear
- Indian fashion context when appropriate
- The user's budget


IMPORTANT RULES:

1. Stay within the user's budget.
2. Create one coherent outfit.
3. Every item must suit the occasion.
4. Avoid unnecessary luxury items.
5. Give realistic estimated prices in Indian Rupees.
6. The total estimated price MUST NOT exceed the user's budget.
7. If the budget is low, prioritize essential items.
8. Do not invent specific store inventory.
9. These are style recommendations, not actual SSISS products yet.
10. Do not identify or infer sensitive personal information.
11. Return ONLY valid JSON.
12. Do NOT use Markdown.
13. Do NOT wrap the JSON in ```.


RETURN EXACTLY THIS STRUCTURE:

{
    "title": "string",

    "occasion_summary": "string",

    "dress_code": "string",

    "style_score": 0,

    "colour_palette": [
        "string",
        "string",
        "string"
    ],

    "outfit": {

        "top": {
            "category": "string",
            "name": "string",
            "reason": "string",
            "estimated_price": 0
        },

        "bottom": {
            "category": "string",
            "name": "string",
            "reason": "string",
            "estimated_price": 0
        },

        "footwear": {
            "category": "string",
            "name": "string",
            "reason": "string",
            "estimated_price": 0
        },

        "layer": {
            "category": "string",
            "name": "string",
            "reason": "string",
            "estimated_price": 0
        },

        "accessory": {
            "category": "string",
            "name": "string",
            "reason": "string",
            "estimated_price": 0
        }

    },

    "grooming_tips": [
        "string",
        "string",
        "string"
    ],

    "styling_tips": [
        "string",
        "string",
        "string"
    ],

    "estimated_total": 0,

    "budget_remaining": 0
}

PROMPT;


    // ==========================================================
    // CALL OPENROUTER
    // ==========================================================

    $response = openRouterChat(
        $prompt
    );


    // ==========================================================
    // EXTRACT AI RESPONSE
    // ==========================================================

    $aiText = openRouterText(
        $response
    );


    if ($aiText === '') {

        throw new Exception(
            'AI returned an empty response.'
        );
    }


    // ==========================================================
    // CLEAN MARKDOWN CODE BLOCKS
    // ==========================================================

    $aiText = trim(
        $aiText
    );


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


    $aiText = trim(
        $aiText
    );


    // ==========================================================
    // DECODE AI JSON
    // ==========================================================

    $result = json_decode(
        $aiText,
        true
    );


    if (!is_array($result)) {

        throw new Exception(
            'AI returned invalid JSON.'
        );
    }


    // ==========================================================
    // CALCULATE BUDGET
    // ==========================================================

    $budgetAmount = floatval(
        preg_replace(
            '/[^0-9.]/',
            '',
            $budget
        )
    );


    $estimatedTotal = intval(
        $result['estimated_total'] ?? 0
    );


    /*
    |--------------------------------------------------------------------------
    | Recalculate budget remaining ourselves.
    |--------------------------------------------------------------------------
    */

    $budgetRemaining = max(
        0,
        $budgetAmount - $estimatedTotal
    );


    $result['estimated_total'] =
        $estimatedTotal;

    $result['budget_remaining'] =
        $budgetRemaining;


    // ==========================================================
    // FINAL RESPONSE
    // ==========================================================

    echo json_encode([

        'success' => true,

        'message' =>
            'SSISS Occasion Stylist generated successfully.',

        'request' => [

            'gender' => $gender,

            'occasion' => $occasion,

            'budget' => $budget,

            'season' => $season,

            'style' => $style,

            'colour' => $colour,

            'location' => $location

        ],

        'result' => $result

    ], JSON_PRETTY_PRINT);

    exit;


} catch (Throwable $e) {

    // ==========================================================
    // ERROR RESPONSE
    // ==========================================================

    http_response_code(500);

    echo json_encode([

        'success' => false,

        'message' =>
            'Occasion styling failed.',

        'error' =>
            $e->getMessage()

    ], JSON_PRETTY_PRINT);

    exit;
}
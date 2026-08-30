<?php

/*
|--------------------------------------------------------------------------
| SSISS AI - GENERATE OUTFIT
|--------------------------------------------------------------------------
| Real OpenRouter AI integration
|
| Takes:
| - User preferences
| - Optional photo analysis
|
| Returns:
| - Complete outfit
| - Colour palette
| - Styling tips
| - Estimated budget
|--------------------------------------------------------------------------
*/

header('Content-Type: application/json');


try {

    // ======================================================
    // LOAD OPENROUTER CONNECTOR
    // ======================================================

    require_once __DIR__ . '/openrouter.php';


    // ======================================================
    // ONLY POST REQUESTS
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
    // READ JSON REQUEST
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
    // USER PREFERENCES
    // ======================================================

    $gender = trim(
        $input['gender'] ?? ''
    );

    $vibe = trim(
        $input['vibe'] ?? ''
    );

    $occasion = trim(
        $input['occasion'] ?? ''
    );

    $budget = trim(
        $input['budget'] ?? ''
    );

    $colour = trim(
        $input['colour'] ?? ''
    );

    $season = trim(
        $input['season'] ?? ''
    );

    $location = trim(
        $input['location'] ?? ''
    );


    // ======================================================
    // OPTIONAL PHOTO ANALYSIS
    // ======================================================

    $photoAnalysis =
        $input['photo_analysis'] ?? null;


    // ======================================================
    // VALIDATION
    // ======================================================

    if (
        $gender === '' ||
        $vibe === '' ||
        $occasion === '' ||
        $budget === ''
    ) {

        http_response_code(422);

        echo json_encode([
            'success' => false,
            'message' =>
                'Gender, vibe, occasion and budget are required.'
        ], JSON_PRETTY_PRINT);

        exit;
    }


    // ======================================================
    // CLEAN PHOTO ANALYSIS
    // ======================================================

    if (
        is_array($photoAnalysis)
    ) {

        $photoAnalysisText =
            json_encode(
                $photoAnalysis,
                JSON_PRETTY_PRINT
            );

    } else {

        $photoAnalysisText =
            'No photo analysis was provided.';

    }


    // ======================================================
    // AI PROMPT
    // ======================================================

    $prompt = <<<PROMPT

You are SSISS AI, an expert personal fashion stylist.

Your task is to create a complete outfit for the user.

USER PREFERENCES:

Gender: {$gender}

Vibe: {$vibe}

Occasion: {$occasion}

Budget: ₹{$budget}

Preferred Colour: {$colour}

Season: {$season}

Location: {$location}


OPTIONAL PHOTO ANALYSIS:

{$photoAnalysisText}


IMPORTANT RULES:

1. Stay within the user's budget.
2. Create ONE coherent outfit.
3. Consider the requested vibe.
4. Consider the occasion.
5. Consider the season.
6. Consider the user's preferred colour.
7. Use practical and realistically available clothing.
8. Do not recommend unnecessarily expensive luxury items.
9. Include clothing categories separately.
10. Give an estimated total price in Indian Rupees.
11. The estimated total must not exceed the user's budget.
12. If the budget is too low for the requested outfit, choose affordable alternatives.
13. Use Indian fashion shopping context where appropriate.
14. Do not identify or infer sensitive personal information.
15. Return ONLY valid JSON.
16. Do NOT use Markdown.
17. Do NOT wrap the response in ```json.


RETURN EXACTLY THIS STRUCTURE:

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

    "styling_tips": [
        "string",
        "string",
        "string"
    ],

    "estimated_total": 0,

    "budget_remaining": 0,

    "shopping_priority": [
        "string",
        "string",
        "string"
    ]
}

PROMPT;


    // ======================================================
    // CALL OPENROUTER
    // ======================================================

    $response = openRouterChat(
        $prompt
    );


    // ======================================================
    // GET AI TEXT
    // ======================================================

    $aiText =
        openRouterText(
            $response
        );


    if ($aiText === '') {

        throw new Exception(
            'AI returned an empty response.'
        );
    }


    // ======================================================
    // REMOVE MARKDOWN CODE BLOCKS
    // ======================================================

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


    // ======================================================
    // DECODE JSON
    // ======================================================

    $outfit =
        json_decode(
            $aiText,
            true
        );


    if (!is_array($outfit)) {

        throw new Exception(
            'AI returned invalid JSON.'
        );
    }


    // ======================================================
    // VALIDATE ESTIMATED TOTAL
    // ======================================================

    $estimatedTotal =
        intval(
            $outfit['estimated_total'] ?? 0
        );


    $budgetAmount =
        floatval(
            preg_replace(
                '/[^0-9.]/',
                '',
                $budget
            )
        );


    // ======================================================
    // CALCULATE BUDGET REMAINING
    // ======================================================

    $budgetRemaining =
        max(
            0,
            $budgetAmount - $estimatedTotal
        );


    // ======================================================
    // CORRECT BUDGET VALUE
    // ======================================================

    $outfit['estimated_total'] =
        $estimatedTotal;


    $outfit['budget_remaining'] =
        $budgetRemaining;


    // ======================================================
    // FINAL RESPONSE
    // ======================================================

    echo json_encode([

        'success' => true,

        'message' =>
            'SSISS outfit generated successfully.',

        'request' => [

            'gender' => $gender,

            'vibe' => $vibe,

            'occasion' => $occasion,

            'budget' => $budget,

            'colour' => $colour,

            'season' => $season,

            'location' => $location

        ],

        'outfit' =>
            $outfit

    ], JSON_PRETTY_PRINT);

    exit;


} catch (Throwable $e) {

    // ======================================================
    // ERROR
    // ======================================================

    http_response_code(500);

    echo json_encode([

        'success' => false,

        'message' =>
            'Outfit generation failed.',

        'error' =>
            $e->getMessage()

    ], JSON_PRETTY_PRINT);

    exit;
}
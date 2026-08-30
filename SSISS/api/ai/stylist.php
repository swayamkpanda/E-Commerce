<?php

/*
|--------------------------------------------------------------------------
| SSISS AI - PERSONAL STYLIST
|--------------------------------------------------------------------------
| Real OpenRouter AI integration
|--------------------------------------------------------------------------
*/

header('Content-Type: application/json');

try {

    // Load OpenRouter connector
    require_once __DIR__ . '/openrouter.php';


    // Only POST requests
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

        http_response_code(405);

        echo json_encode([
            'success' => false,
            'message' => 'Only POST requests are allowed.'
        ], JSON_PRETTY_PRINT);

        exit;
    }


    // Read JSON request
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


    // User preferences
    $gender = trim(
        $input['gender'] ?? ''
    );

    $ageGroup = trim(
        $input['age_group'] ?? ''
    );

    $style = trim(
        $input['style'] ?? ''
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

    $preferences = trim(
        $input['preferences'] ?? ''
    );


    // Validation
    if (
        $gender === '' ||
        $style === '' ||
        $budget === ''
    ) {

        http_response_code(422);

        echo json_encode([
            'success' => false,
            'message' =>
                'Gender, style and budget are required.'
        ], JSON_PRETTY_PRINT);

        exit;
    }


    // AI prompt
    $prompt = <<<PROMPT

You are SSISS AI, an expert personal fashion stylist.

Create a personalized fashion plan for the user.

USER PROFILE:

Gender: {$gender}

Age Group: {$ageGroup}

Preferred Style: {$style}

Occasion: {$occasion}

Budget: ₹{$budget}

Preferred Colour: {$colour}

Season: {$season}

Location: {$location}

Additional Preferences:
{$preferences}


YOUR TASK:

Act as a personal stylist rather than simply recommending one outfit.

Create a practical style profile and recommend:

1. The user's overall style direction.
2. Recommended colour palette.
3. Essential wardrobe pieces.
4. Outfit combinations.
5. Footwear.
6. Accessories.
7. Styling rules.
8. Common mistakes to avoid.


IMPORTANT RULES:

- Keep recommendations realistic.
- Consider the user's budget.
- Consider the occasion.
- Consider the season.
- Consider the user's preferred style.
- Use Indian fashion context when appropriate.
- Do not identify or infer sensitive personal information.
- Do not make medical or body-related claims.
- Do not recommend unrealistic luxury purchases.
- Give realistic estimated prices in Indian Rupees.
- Prices are estimates only, not actual SSISS inventory.
- Return ONLY valid JSON.
- Do NOT use Markdown.
- Do NOT wrap the response in code fences.


RETURN EXACTLY THIS STRUCTURE:

{
    "style_profile": {
        "name": "string",
        "description": "string",
        "style_score": 0
    },

    "colour_palette": {
        "primary": [
            "string",
            "string",
            "string"
        ],
        "accent": [
            "string",
            "string",
            "string"
        ],
        "colours_to_limit": [
            "string",
            "string"
        ]
    },

    "wardrobe_essentials": [
        {
            "category": "string",
            "item": "string",
            "reason": "string",
            "estimated_price": 0
        }
    ],

    "outfit_ideas": [
        {
            "name": "string",
            "occasion": "string",
            "top": "string",
            "bottom": "string",
            "footwear": "string",
            "accessories": "string"
        }
    ],

    "footwear_recommendations": [
        {
            "type": "string",
            "recommendation": "string",
            "estimated_price": 0
        }
    ],

    "accessories": [
        {
            "item": "string",
            "reason": "string",
            "estimated_price": 0
        }
    ],

    "styling_rules": [
        "string",
        "string",
        "string",
        "string"
    ],

    "mistakes_to_avoid": [
        "string",
        "string",
        "string"
    ],

    "shopping_priority": [
        "string",
        "string",
        "string"
    ]
}

PROMPT;


    // Call OpenRouter
    $response = openRouterChat(
        $prompt
    );


    // Extract AI text
    $aiText = openRouterText(
        $response
    );


    if ($aiText === '') {

        throw new Exception(
            'AI returned an empty response.'
        );
    }


    // Clean Markdown fences
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


    // Decode JSON
    $result = json_decode(
        $aiText,
        true
    );


    if (!is_array($result)) {

        throw new Exception(
            'AI returned invalid JSON.'
        );
    }


    // Final response
    echo json_encode([

        'success' => true,

        'message' =>
            'SSISS Personal Stylist generated successfully.',

        'request' => [

            'gender' => $gender,

            'age_group' => $ageGroup,

            'style' => $style,

            'occasion' => $occasion,

            'budget' => $budget,

            'colour' => $colour,

            'season' => $season,

            'location' => $location,

            'preferences' => $preferences

        ],

        'result' => $result

    ], JSON_PRETTY_PRINT);

    exit;


} catch (Throwable $e) {

    http_response_code(500);

    echo json_encode([

        'success' => false,

        'message' =>
            'Personal styling failed.',

        'error' =>
            $e->getMessage()

    ], JSON_PRETTY_PRINT);

    exit;
}
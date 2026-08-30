<?php

/*
|--------------------------------------------------------------------------
| SSISS - OPENROUTER API CONNECTOR
|--------------------------------------------------------------------------
*/

$configPath = __DIR__ . '/../../config/ai_config.php';

if (!file_exists($configPath)) {

    throw new Exception(
        'AI configuration file not found.'
    );

}

$config = require $configPath;

$apiKey = $config['api_key'] ?? '';

if (
    $apiKey === '' ||
    $apiKey === 'YOUR_OPENROUTER_API_KEY'
) {

    throw new Exception(
        'OpenRouter API key is not configured.'
    );

}


/*
|--------------------------------------------------------------------------
| SEND TEXT REQUEST
|--------------------------------------------------------------------------
*/

function openRouterChat(
    string $prompt,
    ?string $model = null
): array {

    global $config;
    global $apiKey;

    $model =
        $model ??
        $config['model'];

    $payload = [

        'model' => $model,

        'messages' => [

            [
                'role' => 'user',

                'content' => $prompt
            ]

        ]

    ];


    $ch = curl_init(
        $config['api_url']
    );


    curl_setopt_array(

        $ch,

        [

            CURLOPT_POST => true,

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_HTTPHEADER => [

                'Authorization: Bearer ' . $apiKey,

                'Content-Type: application/json',

                'HTTP-Referer: http://localhost',

                'X-Title: SSISS Fashion Store'

            ],

            CURLOPT_POSTFIELDS =>
                json_encode($payload),

            CURLOPT_TIMEOUT => 120

        ]

    );


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


    $httpCode =
        curl_getinfo(
            $ch,
            CURLINFO_HTTP_CODE
        );


    curl_close($ch);


    $data =
        json_decode(
            $response,
            true
        );


    if ($httpCode >= 400) {

        $message =
            $data['error']['message']
            ?? 'Unknown OpenRouter error.';

        throw new Exception(
            'OpenRouter API error: ' .
            $message
        );

    }


    if (!is_array($data)) {

        throw new Exception(
            'Invalid response from OpenRouter.'
        );

    }


    return $data;

}


/*
|--------------------------------------------------------------------------
| EXTRACT AI TEXT
|--------------------------------------------------------------------------
*/

function openRouterText(
    array $response
): string {

    return trim(
        $response['choices'][0]['message']['content']
        ?? ''
    );

}
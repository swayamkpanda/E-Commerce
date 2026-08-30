<?php

/*
|--------------------------------------------------------------------------
| SSISS - OPENAI API CONNECTOR
|--------------------------------------------------------------------------
| Common helper for all SSISS AI endpoints.
|--------------------------------------------------------------------------
*/


// ==========================================================
// LOAD CONFIG
// ==========================================================

$configPath = __DIR__ . '/../../config/ai_config.php';

if (!file_exists($configPath)) {

    throw new Exception(
        'AI configuration file not found.'
    );

}

$aiConfig = require $configPath;


// ==========================================================
// GET API KEY
// ==========================================================

$apiKey = $aiConfig['api_key'] ?? '';


// ==========================================================
// VALIDATE API KEY
// ==========================================================

if ($apiKey === '') {

    throw new Exception(
        'OPENAI_API_KEY is not configured.'
    );

}


// ==========================================================
// OPENAI TEXT / VISION REQUEST
// ==========================================================

function openaiResponse(
    array $input,
    ?array $textFormat = null
): array {

    global $aiConfig;
    global $apiKey;


    $payload = [

        'model' =>
            $aiConfig['model'],

        'input' =>
            $input

    ];


    // ------------------------------------------------------
    // Structured JSON output
    // ------------------------------------------------------

    if ($textFormat !== null) {

        $payload['text'] = [

            'format' => $textFormat

        ];

    }


    // ------------------------------------------------------
    // CURL
    // ------------------------------------------------------

    $ch = curl_init(
        $aiConfig['api_url']
    );


    curl_setopt_array(

        $ch,

        [

            CURLOPT_POST => true,

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_HTTPHEADER => [

                'Content-Type: application/json',

                'Authorization: Bearer ' .
                $apiKey

            ],

            CURLOPT_POSTFIELDS =>
                json_encode(
                    $payload
                ),

            CURLOPT_TIMEOUT => 120

        ]

    );


    $response = curl_exec($ch);


    // ------------------------------------------------------
    // CURL ERROR
    // ------------------------------------------------------

    if ($response === false) {

        $error =
            curl_error($ch);

        curl_close($ch);

        throw new Exception(
            'OpenAI connection failed: ' .
            $error
        );

    }


    $httpCode =
        curl_getinfo(
            $ch,
            CURLINFO_HTTP_CODE
        );


    curl_close($ch);


    // ------------------------------------------------------
    // DECODE
    // ------------------------------------------------------

    $data =
        json_decode(
            $response,
            true
        );


    // ------------------------------------------------------
    // API ERROR
    // ------------------------------------------------------

    if ($httpCode >= 400) {

        $message =
            $data['error']['message']
            ?? 'Unknown OpenAI API error.';

        throw new Exception(
            'OpenAI API error: ' .
            $message
        );

    }


    if (!is_array($data)) {

        throw new Exception(
            'Invalid response received from OpenAI.'
        );

    }


    return $data;

}


// ==========================================================
// EXTRACT OUTPUT TEXT
// ==========================================================

function openaiOutputText(
    array $response
): string {

    // ------------------------------------------------------
    // New Responses API convenience field
    // ------------------------------------------------------

    if (
        isset($response['output_text']) &&
        is_string(
            $response['output_text']
        )
    ) {

        return trim(
            $response['output_text']
        );

    }


    // ------------------------------------------------------
    // Fallback: inspect output
    // ------------------------------------------------------

    $text = '';


    if (
        isset($response['output']) &&
        is_array($response['output'])
    ) {

        foreach (
            $response['output']
            as $item
        ) {

            if (
                isset($item['content']) &&
                is_array(
                    $item['content']
                )
            ) {

                foreach (
                    $item['content']
                    as $content
                ) {

                    if (
                        isset(
                            $content['text']
                        )
                    ) {

                        $text .=
                            $content['text'];

                    }

                }

            }

        }

    }


    return trim($text);

}


// ==========================================================
// JSON OUTPUT HELPER
// ==========================================================

function openaiOutputJson(
    array $response
): array {

    $text =
        openaiOutputText(
            $response
        );


    if ($text === '') {

        throw new Exception(
            'OpenAI returned an empty response.'
        );

    }


    $decoded =
        json_decode(
            $text,
            true
        );


    if (
        !is_array($decoded)
    ) {

        throw new Exception(
            'OpenAI returned invalid JSON.'
        );

    }


    return $decoded;

}
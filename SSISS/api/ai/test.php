<?php

/*
|--------------------------------------------------------------------------
| SSISS - VIBE API TEST
|--------------------------------------------------------------------------
*/

header('Content-Type: application/json');

try {

    // Vibe API URL
    $url =
        'http://localhost/E-Commerce/SSISS/api/ai/vibe.php';


    // Test data
    $data = [

        'vibe' => 'old-money',

        'gender' => 'men',

        'budget' => '5000',

        'occasion' => 'wedding',

        'colour' => 'neutral',

        'season' => 'winter'

    ];


    // Initialize CURL
    $ch = curl_init($url);


    curl_setopt_array($ch, [

        CURLOPT_POST => true,

        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_HTTPHEADER => [

            'Content-Type: application/json'

        ],

        CURLOPT_POSTFIELDS =>
            json_encode($data),

        CURLOPT_TIMEOUT => 120

    ]);


    // Send request
    $response =
        curl_exec($ch);


    // Check CURL error
    if ($response === false) {

        throw new Exception(
            curl_error($ch)
        );

    }


    // Get HTTP status
    $httpCode =
        curl_getinfo(
            $ch,
            CURLINFO_HTTP_CODE
        );


    curl_close($ch);


    // Show API response
    http_response_code($httpCode);

    echo $response;


} catch (Throwable $e) {

    http_response_code(500);

    echo json_encode([

        'success' => false,

        'error' =>
            $e->getMessage()

    ], JSON_PRETTY_PRINT);

}
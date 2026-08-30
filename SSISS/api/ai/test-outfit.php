<?php

header('Content-Type: application/json');

try {

    $url =
        'http://localhost/E-Commerce/SSISS/api/ai/generate-outfit.php';

    $data = [

        'gender' => 'men',

        'vibe' => 'streetwear',

        'occasion' => 'college',

        'budget' => '4000',

        'colour' => 'black',

        'season' => 'summer',

        'location' => 'Bhubaneswar'

    ];

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

    $response = curl_exec($ch);

    if ($response === false) {

        throw new Exception(
            curl_error($ch)
        );

    }

    $httpCode =
        curl_getinfo(
            $ch,
            CURLINFO_HTTP_CODE
        );

    curl_close($ch);

    http_response_code($httpCode);

    echo $response;

} catch (Throwable $e) {

    http_response_code(500);

    echo json_encode([

        'success' => false,

        'error' => $e->getMessage()

    ], JSON_PRETTY_PRINT);

}
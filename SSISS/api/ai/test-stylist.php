<?php

header('Content-Type: application/json');

try {

    // Stylist API URL
    $url =
        'http://localhost/E-Commerce/SSISS/api/ai/stylist.php';


    // Test data
    $data = [

        'gender' => 'men',

        'age_group' => 'young adult',

        'style' => 'smart casual',

        'occasion' => 'college and casual outings',

        'budget' => '8000',

        'colour' => 'navy blue and neutral tones',

        'season' => 'summer',

        'location' => 'Bhubaneswar',

        'preferences' =>
            'Prefer comfortable outfits that look clean and modern.'

    ];


    // CURL
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
    $response = curl_exec($ch);


    if ($response === false) {

        throw new Exception(
            curl_error($ch)
        );
    }


    // HTTP status
    $httpCode = curl_getinfo(
        $ch,
        CURLINFO_HTTP_CODE
    );


    curl_close($ch);


    // Return response
    http_response_code($httpCode);

    echo $response;


} catch (Throwable $e) {

    http_response_code(500);

    echo json_encode([

        'success' => false,

        'error' => $e->getMessage()

    ], JSON_PRETTY_PRINT);

}
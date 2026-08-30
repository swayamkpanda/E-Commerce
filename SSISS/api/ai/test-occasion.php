<?php

header('Content-Type: application/json');

try {

    // Occasion API URL
    $url = 'http://localhost/E-Commerce/SSISS/api/ai/occasion.php';

    // Test data
    $data = [
        'gender' => 'men',
        'occasion' => 'wedding',
        'budget' => '6000',
        'season' => 'winter',
        'style' => 'elegant',
        'colour' => 'navy blue',
        'location' => 'Bhubaneswar'
    ];

    // Create CURL request
    $ch = curl_init($url);

    curl_setopt_array($ch, [

        CURLOPT_POST => true,

        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json'
        ],

        CURLOPT_POSTFIELDS => json_encode($data),

        CURLOPT_TIMEOUT => 120

    ]);

    // Send request
    $response = curl_exec($ch);

    // Check CURL error
    if ($response === false) {

        throw new Exception(
            curl_error($ch)
        );

    }

    // Get HTTP status
    $httpCode = curl_getinfo(
        $ch,
        CURLINFO_HTTP_CODE
    );

    curl_close($ch);

    // Return API response
    http_response_code($httpCode);

    echo $response;

} catch (Throwable $e) {

    http_response_code(500);

    echo json_encode([

        'success' => false,

        'error' => $e->getMessage()

    ], JSON_PRETTY_PRINT);

}
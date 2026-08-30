<?php

header('Content-Type: application/json');

try {

    // ==========================================================
    // TEST PHOTO
    // ==========================================================

    $photoPath =
        __DIR__ .
        '/../../ai/test-photo.jpg';


    if (!file_exists($photoPath)) {

        throw new Exception(
            'test-photo.jpg not found.'
        );
    }


    // ==========================================================
    // READ PHOTO
    // ==========================================================

    $imageData =
        file_get_contents(
            $photoPath
        );


    if ($imageData === false) {

        throw new Exception(
            'Unable to read test-photo.jpg.'
        );
    }


    // ==========================================================
    // MIME
    // ==========================================================

    $mimeType =
        mime_content_type(
            $photoPath
        );


    if (!$mimeType) {

        $mimeType =
            'image/jpeg';
    }


    // ==========================================================
    // BASE64
    // ==========================================================

    $image =
        'data:' .
        $mimeType .
        ';base64,' .
        base64_encode(
            $imageData
        );


    // ==========================================================
    // TEST REQUEST
    // ==========================================================

    $data = [

        'image' =>
            $image,

        'clothing' =>
            'a dark navy blue bomber jacket over a clean white t-shirt with black straight-fit trousers',

        'style' =>
            'modern minimal streetwear',

        'colour' =>
            'navy blue, white and black',

        'occasion' =>
            'college and casual evening outing'

    ];


    // ==========================================================
    // API
    // ==========================================================

    $url =
        'http://localhost/E-Commerce/SSISS/api/ai/try-on.php';


    $ch =
        curl_init($url);


    curl_setopt_array($ch, [

        CURLOPT_POST => true,

        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_HTTPHEADER => [

            'Content-Type: application/json'

        ],

        CURLOPT_POSTFIELDS =>
            json_encode($data),

        CURLOPT_TIMEOUT => 180

    ]);


    // ==========================================================
    // SEND
    // ==========================================================

    $response =
        curl_exec($ch);


    if ($response === false) {

        throw new Exception(
            curl_error($ch)
        );
    }


    // ==========================================================
    // STATUS
    // ==========================================================

    $httpCode =
        curl_getinfo(
            $ch,
            CURLINFO_HTTP_CODE
        );


    curl_close($ch);


    // ==========================================================
    // OUTPUT
    // ==========================================================

    http_response_code(
        $httpCode
    );

    echo $response;


} catch (Throwable $e) {

    http_response_code(500);

    echo json_encode([

        'success' => false,

        'error' =>
            $e->getMessage()

    ], JSON_PRETTY_PRINT);

}
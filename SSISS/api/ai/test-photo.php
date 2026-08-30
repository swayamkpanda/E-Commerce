<?php

header('Content-Type: application/json');


try {

    /*
    |--------------------------------------------------------------------------
    | PHOTO TO TEST
    |--------------------------------------------------------------------------
    */

    $photoPath =
        __DIR__ . '/../../ai/test-photo.jpg';


    if (!file_exists($photoPath)) {

        throw new Exception(
            'Test photo not found: ' .
            $photoPath
        );
    }


    /*
    |--------------------------------------------------------------------------
    | READ PHOTO
    |--------------------------------------------------------------------------
    */

    $imageData =
        file_get_contents(
            $photoPath
        );


    if ($imageData === false) {

        throw new Exception(
            'Unable to read test photo.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DETECT MIME
    |--------------------------------------------------------------------------
    */

    $mimeType =
        mime_content_type(
            $photoPath
        );


    /*
    |--------------------------------------------------------------------------
    | BASE64 DATA URL
    |--------------------------------------------------------------------------
    */

    $base64 =
        base64_encode(
            $imageData
        );


    $image =
        'data:' .
        $mimeType .
        ';base64,' .
        $base64;


    /*
    |--------------------------------------------------------------------------
    | REQUEST
    |--------------------------------------------------------------------------
    */

    $request = [

        'image' =>
            $image,

        'gender' =>
            'men',

        'occasion' =>
            'casual',

        'style' =>
            'modern'

    ];


    /*
    |--------------------------------------------------------------------------
    | CALL API
    |--------------------------------------------------------------------------
    */

    $url =
        'http://localhost/E-Commerce/SSISS/api/ai/analyze-photo.php';


    $ch =
        curl_init($url);


    curl_setopt_array($ch, [

        CURLOPT_POST => true,

        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_HTTPHEADER => [

            'Content-Type: application/json'

        ],

        CURLOPT_POSTFIELDS =>
            json_encode($request),

        CURLOPT_TIMEOUT => 120

    ]);


    $response =
        curl_exec($ch);


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
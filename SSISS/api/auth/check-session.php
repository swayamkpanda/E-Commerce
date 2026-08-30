<?php

/*
|--------------------------------------------------------------------------
| SSISS - CHECK SESSION API
|--------------------------------------------------------------------------
| GET /api/auth/check-session.php
|--------------------------------------------------------------------------
*/

header('Content-Type: application/json; charset=UTF-8');


// ==========================================================
// HELPER: JSON RESPONSE
// ==========================================================

function response($success, $message, $data = [], $status = 200)
{
    http_response_code($status);

    echo json_encode(
        [
            'success' => $success,
            'message' => $message,
            'data' => $data
        ],
        JSON_PRETTY_PRINT
    );

    exit;
}


// ==========================================================
// ONLY GET REQUEST
// ==========================================================

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {

    response(
        false,
        'Only GET requests are allowed.',
        [],
        405
    );
}


// ==========================================================
// START SESSION
// ==========================================================

if (session_status() === PHP_SESSION_NONE) {

    session_start();
}


// ==========================================================
// CHECK LOGIN STATUS
// ==========================================================

if (
    !isset($_SESSION['logged_in']) ||
    $_SESSION['logged_in'] !== true ||
    !isset($_SESSION['user_id'])
) {

    response(
        true,
        'User is not logged in.',
        [
            'authenticated' => false,
            'user' => null
        ],
        200
    );
}


// ==========================================================
// RETURN USER SESSION
// ==========================================================

$user = [

    'id' =>
        (int) $_SESSION['user_id'],

    'name' =>
        $_SESSION['user_name'] ?? '',

    'email' =>
        $_SESSION['user_email'] ?? '',

    'role' =>
        $_SESSION['user_role'] ?? 'user'

];


// ==========================================================
// SUCCESS
// ==========================================================

response(
    true,
    'User is logged in.',
    [
        'authenticated' => true,
        'user' => $user
    ],
    200
);
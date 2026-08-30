<?php

/*
|--------------------------------------------------------------------------
| SSISS - LOGOUT API
|--------------------------------------------------------------------------
| POST /api/auth/logout.php
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
// ONLY POST REQUEST
// ==========================================================

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    response(
        false,
        'Only POST requests are allowed.',
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
// CHECK WHETHER USER IS LOGGED IN
// ==========================================================

$wasLoggedIn =
    isset($_SESSION['user_id']);


// ==========================================================
// CLEAR SESSION DATA
// ==========================================================

$_SESSION = [];


// ==========================================================
// DELETE SESSION COOKIE
// ==========================================================

if (ini_get('session.use_cookies')) {

    $params =
        session_get_cookie_params();

    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}


// ==========================================================
// DESTROY SESSION
// ==========================================================

session_destroy();


// ==========================================================
// SUCCESS
// ==========================================================

if ($wasLoggedIn) {

    response(
        true,
        'Logged out successfully.',
        [],
        200
    );

}


// ==========================================================
// ALREADY LOGGED OUT
// ==========================================================

response(
    true,
    'No active session found.',
    [],
    200
);
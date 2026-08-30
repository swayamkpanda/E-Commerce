<?php

/*
|--------------------------------------------------------------------------
| SSISS - LOGIN API
|--------------------------------------------------------------------------
| POST /api/auth/login.php
|
| Expected JSON:
| {
|     "email": "test@example.com",
|     "password": "Password@123"
| }
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
// LOAD DATABASE
// ==========================================================

$databasePath =
    __DIR__ . '/../../config/database.php';

if (!file_exists($databasePath)) {

    response(
        false,
        'Database configuration file not found.',
        [],
        500
    );
}

require_once $databasePath;


// ==========================================================
// CHECK PDO
// ==========================================================

if (
    !isset($pdo) ||
    !($pdo instanceof PDO)
) {

    response(
        false,
        'Database connection is not available.',
        [],
        500
    );
}


// ==========================================================
// READ JSON
// ==========================================================

$rawInput =
    file_get_contents('php://input');

$input =
    json_decode(
        $rawInput,
        true
    );


if (!is_array($input)) {

    response(
        false,
        'Invalid JSON request.',
        [],
        400
    );
}


// ==========================================================
// GET INPUT
// ==========================================================

$email =
    trim(
        $input['email'] ?? ''
    );

$password =
    $input['password'] ?? '';


// ==========================================================
// VALIDATE EMAIL
// ==========================================================

if ($email === '') {

    response(
        false,
        'Email is required.',
        [],
        422
    );
}


if (!filter_var(
    $email,
    FILTER_VALIDATE_EMAIL
)) {

    response(
        false,
        'Please provide a valid email address.',
        [],
        422
    );
}


// ==========================================================
// VALIDATE PASSWORD
// ==========================================================

if ($password === '') {

    response(
        false,
        'Password is required.',
        [],
        422
    );
}


// ==========================================================
// FIND USER
// ==========================================================

try {

    $sql = "
        SELECT
            id,
            name,
            email,
            password,
            role
        FROM users
        WHERE email = ?
        LIMIT 1
    ";


    $stmt =
        $pdo->prepare($sql);


    $stmt->execute([
        $email
    ]);


    $user =
        $stmt->fetch(
            PDO::FETCH_ASSOC
        );


    // ======================================================
    // USER NOT FOUND
    // ======================================================

    if (!$user) {

        response(
            false,
            'Invalid email or password.',
            [],
            401
        );
    }


    // ======================================================
    // VERIFY PASSWORD
    // ======================================================

    if (
        !password_verify(
            $password,
            $user['password']
        )
    ) {

        response(
            false,
            'Invalid email or password.',
            [],
            401
        );
    }


    // ======================================================
    // START SESSION
    // ======================================================

    if (session_status() === PHP_SESSION_NONE) {

        session_start();
    }


    // Regenerate session ID for security
    session_regenerate_id(true);


    // ======================================================
    // STORE USER SESSION
    // ======================================================

    $_SESSION['user_id'] =
        (int) $user['id'];

    $_SESSION['user_name'] =
        $user['name'];

    $_SESSION['user_email'] =
        $user['email'];

    $_SESSION['user_role'] =
        $user['role'];

    $_SESSION['logged_in'] =
        true;


    // ======================================================
    // SUCCESS
    // ======================================================

    response(
        true,
        'Login successful.',
        [
            'user' => [

                'id' =>
                    (int) $user['id'],

                'name' =>
                    $user['name'],

                'email' =>
                    $user['email'],

                'role' =>
                    $user['role']

            ]
        ],
        200
    );


} catch (PDOException $e) {

    response(
        false,
        'Unable to process login.',
        [],
        500
    );

} catch (Throwable $e) {

    response(
        false,
        'Something went wrong.',
        [],
        500
    );
}
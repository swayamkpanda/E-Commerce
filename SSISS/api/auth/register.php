<?php

/*
|--------------------------------------------------------------------------
| SSISS - REGISTER API
|--------------------------------------------------------------------------
| POST /api/auth/register.php
|
| Expected JSON:
| {
|     "name": "Swayam",
|     "email": "swayam@example.com",
|     "password": "Password@123",
|     "confirm_password": "Password@123"
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


// Load your existing database configuration
require_once $databasePath;


// ==========================================================
// FIND DATABASE CONNECTION
// ==========================================================
//
// This supports either:
// $pdo
//
// OR:
// $conn
//
// OR:
// $mysqli
//
// depending on how your database.php is written.
// ==========================================================

$db = null;

if (isset($pdo) && $pdo instanceof PDO) {

    $db = $pdo;

} elseif (
    isset($conn) &&
    $conn instanceof PDO
) {

    $db = $conn;

}


// ==========================================================
// PDO CONNECTION CHECK
// ==========================================================

if (!$db) {

    response(
        false,
        'PDO database connection was not found. Check config/database.php.',
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

$name =
    trim(
        $input['name'] ?? ''
    );


$email =
    trim(
        $input['email'] ?? ''
    );


$password =
    $input['password'] ?? '';


$confirmPassword =
    $input['confirm_password'] ?? '';


// ==========================================================
// VALIDATE NAME
// ==========================================================

if ($name === '') {

    response(
        false,
        'Name is required.',
        [],
        422
    );
}


if (strlen($name) < 2) {

    response(
        false,
        'Name must contain at least 2 characters.',
        [],
        422
    );
}


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


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

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


if (strlen($password) < 8) {

    response(
        false,
        'Password must contain at least 8 characters.',
        [],
        422
    );
}


// ==========================================================
// CONFIRM PASSWORD
// ==========================================================

if ($confirmPassword === '') {

    response(
        false,
        'Please confirm your password.',
        [],
        422
    );
}


if ($password !== $confirmPassword) {

    response(
        false,
        'Passwords do not match.',
        [],
        422
    );
}


// ==========================================================
// CHECK EXISTING USER
// ==========================================================

try {

    $checkSql = "
        SELECT id
        FROM users
        WHERE email = ?
        LIMIT 1
    ";


    $checkStmt =
        $db->prepare(
            $checkSql
        );


    $checkStmt->execute(
        [$email]
    );


    $existingUser =
        $checkStmt->fetch(
            PDO::FETCH_ASSOC
        );


    if ($existingUser) {

        response(
            false,
            'An account with this email already exists.',
            [],
            409
        );
    }


    // ======================================================
    // HASH PASSWORD
    // ======================================================

    $passwordHash =
        password_hash(
            $password,
            PASSWORD_DEFAULT
        );


    if ($passwordHash === false) {

        response(
            false,
            'Unable to secure password.',
            [],
            500
        );
    }


    // ======================================================
    // CREATE USER
    // ======================================================

    $insertSql = "
        INSERT INTO users
        (
            name,
            email,
            password,
            created_at
        )
        VALUES
        (
            ?,
            ?,
            ?,
            NOW()
        )
    ";


    $insertStmt =
        $db->prepare(
            $insertSql
        );


    $insertStmt->execute(
        [
            $name,
            $email,
            $passwordHash
        ]
    );


    // ======================================================
    // GET NEW USER ID
    // ======================================================

    $userId =
        $db->lastInsertId();


    // ======================================================
    // SUCCESS
    // ======================================================

    response(
        true,
        'Account created successfully.',
        [
            'user' => [
                'id' =>
                    (int) $userId,

                'name' =>
                    $name,

                'email' =>
                    $email
            ]
        ],
        201
    );


} catch (PDOException $e) {

    // ======================================================
    // DATABASE ERROR
    // ======================================================

    response(
        false,
        'Unable to create account.',
        [],
        500
    );

} catch (Throwable $e) {

    // ======================================================
    // GENERAL ERROR
    // ======================================================

    response(
        false,
        'Something went wrong.',
        [],
        500
    );
}
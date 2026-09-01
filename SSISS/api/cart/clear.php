<?php

/*
|--------------------------------------------------------------------------
| SSISS - CLEAR CART API
|--------------------------------------------------------------------------
| POST /api/cart/clear.php
|--------------------------------------------------------------------------
*/

header('Content-Type: application/json; charset=UTF-8');


// ==========================================================
// JSON RESPONSE
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
// ONLY POST
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
// CHECK LOGIN
// ==========================================================

if (
    !isset($_SESSION['logged_in']) ||
    $_SESSION['logged_in'] !== true ||
    !isset($_SESSION['user_id'])
) {

    response(
        false,
        'Please login to clear your cart.',
        [],
        401
    );
}


$userId = (int) $_SESSION['user_id'];


// ==========================================================
// DATABASE CONNECTION
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
// CLEAR CART
// ==========================================================

try {

    // ------------------------------------------------------
    // FIND USER CART
    // ------------------------------------------------------

    $cartSql = "
        SELECT id
        FROM cart
        WHERE user_id = ?
        LIMIT 1
    ";

    $cartStmt =
        $pdo->prepare($cartSql);

    $cartStmt->execute([
        $userId
    ]);

    $cart =
        $cartStmt->fetch(
            PDO::FETCH_ASSOC
        );


    // ------------------------------------------------------
    // CART DOES NOT EXIST
    // ------------------------------------------------------

    if (!$cart) {

        response(
            true,
            'Cart is already empty.',
            [
                'cart_id' => null,
                'removed_items' => 0
            ],
            200
        );
    }


    $cartId =
        (int) $cart['id'];


    // ------------------------------------------------------
    // COUNT ITEMS BEFORE DELETE
    // ------------------------------------------------------

    $countSql = "
        SELECT COUNT(*) AS total
        FROM cart_items
        WHERE cart_id = ?
    ";

    $countStmt =
        $pdo->prepare($countSql);

    $countStmt->execute([
        $cartId
    ]);

    $countResult =
        $countStmt->fetch(
            PDO::FETCH_ASSOC
        );

    $removedItems =
        (int) $countResult['total'];


    // ------------------------------------------------------
    // DELETE CART ITEMS
    // ------------------------------------------------------

    $deleteSql = "
        DELETE FROM cart_items
        WHERE cart_id = ?
    ";

    $deleteStmt =
        $pdo->prepare($deleteSql);

    $deleteStmt->execute([
        $cartId
    ]);


    // ------------------------------------------------------
    // SUCCESS
    // ------------------------------------------------------

    response(
        true,

        'Cart cleared successfully.',

        [
            'cart_id' =>
                $cartId,

            'removed_items' =>
                $removedItems
        ],

        200
    );


} catch (PDOException $e) {

    response(
        false,
        'Unable to clear cart.',
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

?>
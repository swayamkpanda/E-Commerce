<?php

/*
|--------------------------------------------------------------------------
| SSISS - GET CART API
|--------------------------------------------------------------------------
| GET /api/cart/get.php
|--------------------------------------------------------------------------
*/

header('Content-Type: application/json; charset=UTF-8');


// ==========================================================
// JSON RESPONSE FUNCTION
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
// CHECK LOGIN
// ==========================================================

if (
    !isset($_SESSION['logged_in']) ||
    $_SESSION['logged_in'] !== true ||
    !isset($_SESSION['user_id'])
) {

    response(
        false,
        'Please login to view your cart.',
        [],
        401
    );
}


$userId = (int) $_SESSION['user_id'];


// ==========================================================
// DATABASE CONNECTION
// ==========================================================

$databasePath = __DIR__ . '/../../config/database.php';

if (!file_exists($databasePath)) {

    response(
        false,
        'Database configuration file not found.',
        [],
        500
    );
}

require_once $databasePath;


// Check PDO connection

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
// GET CART
// ==========================================================

try {

    // ------------------------------------------------------
    // Find user's cart
    // ------------------------------------------------------

    $cartSql = "
        SELECT id
        FROM cart
        WHERE user_id = ?
        LIMIT 1
    ";

    $cartStmt = $pdo->prepare($cartSql);

    $cartStmt->execute([
        $userId
    ]);

    $cart = $cartStmt->fetch(PDO::FETCH_ASSOC);


    // ------------------------------------------------------
    // CART DOES NOT EXIST
    // ------------------------------------------------------

    if (!$cart) {

        response(
            true,
            'Cart is empty.',
            [
                'cart_id' => null,

                'items' => [],

                'summary' => [
                    'item_count' => 0,
                    'total_quantity' => 0,
                    'subtotal' => 0
                ]
            ],
            200
        );
    }


    $cartId = (int) $cart['id'];


    // ------------------------------------------------------
    // GET CART ITEMS
    // ------------------------------------------------------

    $itemsSql = "
        SELECT

            ci.id AS cart_item_id,

            ci.product_id,

            ci.quantity,

            p.name,

            p.price,

            p.stock

        FROM cart_items ci

        INNER JOIN products p
            ON p.id = ci.product_id

        WHERE ci.cart_id = ?

        ORDER BY ci.id DESC
    ";

    $itemsStmt = $pdo->prepare($itemsSql);

    $itemsStmt->execute([
        $cartId
    ]);

    $rows = $itemsStmt->fetchAll(PDO::FETCH_ASSOC);


    // ------------------------------------------------------
    // PREPARE CART DATA
    // ------------------------------------------------------

    $items = [];

    $subtotal = 0;

    $totalQuantity = 0;


    foreach ($rows as $row) {

        $quantity = (int) $row['quantity'];

        $price = (float) $row['price'];

        $itemTotal = $price * $quantity;


        $subtotal += $itemTotal;

        $totalQuantity += $quantity;


        $items[] = [

            'cart_item_id' =>
                (int) $row['cart_item_id'],

            'product_id' =>
                (int) $row['product_id'],

            'name' =>
                $row['name'],

            'price' =>
                $price,

            'quantity' =>
                $quantity,

            'stock' =>
                (int) $row['stock'],

            'item_total' =>
                round($itemTotal, 2)

        ];
    }


    // ------------------------------------------------------
    // RETURN CART
    // ------------------------------------------------------

    response(
        true,

        'Cart retrieved successfully.',

        [

            'cart_id' =>
                $cartId,

            'items' =>
                $items,

            'summary' => [

                'item_count' =>
                    count($items),

                'total_quantity' =>
                    $totalQuantity,

                'subtotal' =>
                    round($subtotal, 2)

            ]

        ],

        200
    );


} catch (PDOException $e) {

    response(
        false,
        'Unable to retrieve cart.',
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
<?php

/*
|--------------------------------------------------------------------------
| SSISS - ADD TO CART API
|--------------------------------------------------------------------------
| POST /api/cart/add.php
|
| JSON:
| {
|     "product_id": 1,
|     "quantity": 1
| }
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
// SESSION
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
        'Please login to add items to your cart.',
        [],
        401
    );
}


$userId = (int) $_SESSION['user_id'];


// ==========================================================
// DATABASE
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
// INPUT
// ==========================================================

$productId =
    isset($input['product_id'])
        ? (int) $input['product_id']
        : 0;

$quantity =
    isset($input['quantity'])
        ? (int) $input['quantity']
        : 1;


// ==========================================================
// VALIDATE PRODUCT ID
// ==========================================================

if ($productId <= 0) {

    response(
        false,
        'A valid product_id is required.',
        [],
        422
    );
}


// ==========================================================
// VALIDATE QUANTITY
// ==========================================================

if ($quantity <= 0) {

    response(
        false,
        'Quantity must be at least 1.',
        [],
        422
    );
}


if ($quantity > 99) {

    response(
        false,
        'Maximum quantity is 99.',
        [],
        422
    );
}


// ==========================================================
// DATABASE OPERATIONS
// ==========================================================

try {

    // ------------------------------------------------------
    // CHECK PRODUCT
    // ------------------------------------------------------

    $productSql = "
        SELECT
            id,
            name,
            price,
            stock
        FROM products
        WHERE id = ?
        LIMIT 1
    ";

    $productStmt =
        $pdo->prepare($productSql);

    $productStmt->execute([
        $productId
    ]);

    $product =
        $productStmt->fetch(
            PDO::FETCH_ASSOC
        );


    if (!$product) {

        response(
            false,
            'Product not found.',
            [],
            404
        );
    }


    // ------------------------------------------------------
    // CHECK STOCK
    // ------------------------------------------------------

    $stock =
        (int) $product['stock'];


    if ($stock <= 0) {

        response(
            false,
            'This product is out of stock.',
            [],
            409
        );
    }


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
    // CREATE CART IF NEEDED
    // ------------------------------------------------------

    if (!$cart) {

        $createCartSql = "
            INSERT INTO cart (user_id)
            VALUES (?)
        ";

        $createCartStmt =
            $pdo->prepare(
                $createCartSql
            );

        $createCartStmt->execute([
            $userId
        ]);

        $cartId =
            (int) $pdo->lastInsertId();

    } else {

        $cartId =
            (int) $cart['id'];
    }


    // ------------------------------------------------------
    // CHECK EXISTING CART ITEM
    // ------------------------------------------------------

    $itemSql = "
        SELECT
            id,
            quantity
        FROM cart_items
        WHERE cart_id = ?
          AND product_id = ?
        LIMIT 1
    ";

    $itemStmt =
        $pdo->prepare($itemSql);

    $itemStmt->execute([
        $cartId,
        $productId
    ]);

    $existingItem =
        $itemStmt->fetch(
            PDO::FETCH_ASSOC
        );


    // ------------------------------------------------------
    // ADD / UPDATE ITEM
    // ------------------------------------------------------

    if ($existingItem) {

        $newQuantity =
            (int) $existingItem['quantity']
            + $quantity;


        if ($newQuantity > $stock) {

            response(
                false,
                "Only {$stock} item(s) are available.",
                [],
                409
            );
        }


        if ($newQuantity > 99) {
            $newQuantity = 99;
        }


        $updateSql = "
            UPDATE cart_items
            SET quantity = ?
            WHERE id = ?
        ";

        $updateStmt =
            $pdo->prepare(
                $updateSql
            );

        $updateStmt->execute([
            $newQuantity,
            $existingItem['id']
        ]);

        $finalQuantity =
            $newQuantity;

    } else {

        if ($quantity > $stock) {

            response(
                false,
                "Only {$stock} item(s) are available.",
                [],
                409
            );
        }


        $insertSql = "
            INSERT INTO cart_items
            (
                cart_id,
                product_id,
                quantity
            )
            VALUES
            (
                ?,
                ?,
                ?
            )
        ";

        $insertStmt =
            $pdo->prepare(
                $insertSql
            );

        $insertStmt->execute([
            $cartId,
            $productId,
            $quantity
        ]);

        $finalQuantity =
            $quantity;
    }


    // ------------------------------------------------------
    // SUCCESS
    // ------------------------------------------------------

    response(
        true,
        'Product added to cart successfully.',
        [
            'cart_id' =>
                $cartId,

            'product' => [
                'id' =>
                    (int) $product['id'],

                'name' =>
                    $product['name'],

                'price' =>
                    (float) $product['price']
            ],

            'quantity' =>
                $finalQuantity
        ],
        200
    );


} catch (PDOException $e) {

    response(
        false,
        'Unable to add product to cart.',
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
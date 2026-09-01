<?php

/*
|--------------------------------------------------------------------------
| SSISS - UPDATE CART API
|--------------------------------------------------------------------------
| PUT /api/cart/update.php
|
| JSON:
| {
|     "cart_item_id": 1,
|     "quantity": 3
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
// ONLY PUT / POST
// ==========================================================

if (
    $_SERVER['REQUEST_METHOD'] !== 'PUT' &&
    $_SERVER['REQUEST_METHOD'] !== 'POST'
) {

    response(
        false,
        'Only PUT or POST requests are allowed.',
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
        'Please login to update your cart.',
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

$cartItemId =
    isset($input['cart_item_id'])
        ? (int) $input['cart_item_id']
        : 0;

$quantity =
    isset($input['quantity'])
        ? (int) $input['quantity']
        : 0;


// ==========================================================
// VALIDATE CART ITEM
// ==========================================================

if ($cartItemId <= 0) {

    response(
        false,
        'A valid cart_item_id is required.',
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
// UPDATE CART ITEM
// ==========================================================

try {

    // ------------------------------------------------------
    // Find cart item belonging to logged-in user
    // ------------------------------------------------------

    $sql = "
        SELECT

            ci.id AS cart_item_id,

            ci.quantity,

            ci.product_id,

            c.id AS cart_id,

            p.name,

            p.price,

            p.stock

        FROM cart_items ci

        INNER JOIN cart c
            ON c.id = ci.cart_id

        INNER JOIN products p
            ON p.id = ci.product_id

        WHERE ci.id = ?

        AND c.user_id = ?

        LIMIT 1
    ";

    $stmt =
        $pdo->prepare($sql);

    $stmt->execute([
        $cartItemId,
        $userId
    ]);

    $item =
        $stmt->fetch(
            PDO::FETCH_ASSOC
        );


    // ------------------------------------------------------
    // ITEM NOT FOUND
    // ------------------------------------------------------

    if (!$item) {

        response(
            false,
            'Cart item not found.',
            [],
            404
        );
    }


    // ------------------------------------------------------
    // CHECK STOCK
    // ------------------------------------------------------

    $stock =
        (int) $item['stock'];


    if ($stock <= 0) {

        response(
            false,
            'This product is out of stock.',
            [],
            409
        );
    }


    if ($quantity > $stock) {

        response(
            false,
            "Only {$stock} item(s) are available.",
            [],
            409
        );
    }


    // ------------------------------------------------------
    // UPDATE
    // ------------------------------------------------------

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
        $quantity,
        $cartItemId
    ]);


    // ------------------------------------------------------
    // CALCULATE ITEM TOTAL
    // ------------------------------------------------------

    $price =
        (float) $item['price'];

    $itemTotal =
        $price * $quantity;


    // ------------------------------------------------------
    // SUCCESS
    // ------------------------------------------------------

    response(
        true,

        'Cart quantity updated successfully.',

        [

            'cart_id' =>
                (int) $item['cart_id'],

            'cart_item_id' =>
                $cartItemId,

            'product_id' =>
                (int) $item['product_id'],

            'product_name' =>
                $item['name'],

            'price' =>
                $price,

            'quantity' =>
                $quantity,

            'item_total' =>
                round(
                    $itemTotal,
                    2
                )

        ],

        200
    );


} catch (PDOException $e) {

    response(
        false,
        'Unable to update cart.',
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
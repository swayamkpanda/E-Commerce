<?php

session_start();

require_once "../config/database.php";


header("Content-Type: application/json");


/* =========================================
   CHECK LOGIN
========================================= */

if (!isset($_SESSION["user_id"])) {

    echo json_encode([
        "success" => false,
        "message" => "Please login to add items to your wishlist."
    ]);

    exit;

}


/* =========================================
   ONLY ACCEPT POST REQUEST
========================================= */

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    echo json_encode([
        "success" => false,
        "message" => "Invalid request method."
    ]);

    exit;

}


/* =========================================
   GET PRODUCT ID
========================================= */

$productId = $_POST["product_id"] ?? null;


if (empty($productId)) {

    echo json_encode([
        "success" => false,
        "message" => "Product ID is required."
    ]);

    exit;

}


$userId = $_SESSION["user_id"];


/* =========================================
   CHECK IF PRODUCT EXISTS
========================================= */

try {

    $productQuery = $pdo->prepare(

        "SELECT id FROM products WHERE id = ?"

    );


    $productQuery->execute([$productId]);


    if (!$productQuery->fetch()) {

        echo json_encode([
            "success" => false,
            "message" => "Product not found."
        ]);

        exit;

    }


    /* =========================================
       CHECK IF ALREADY IN WISHLIST
    ========================================= */

    $checkWishlist = $pdo->prepare(

        "SELECT id 
         FROM wishlist_items 
         WHERE user_id = ? 
         AND product_id = ?"

    );


    $checkWishlist->execute([

        $userId,

        $productId

    ]);


    if ($checkWishlist->fetch()) {

        echo json_encode([

            "success" => false,

            "message" => "Product already exists in wishlist."

        ]);

        exit;

    }


    /* =========================================
       ADD PRODUCT
    ========================================= */

    $addWishlist = $pdo->prepare(

        "INSERT INTO wishlist_items
        (
            user_id,
            product_id,
            created_at
        )

        VALUES
        (
            ?,
            ?,
            NOW()
        )"

    );


    $addWishlist->execute([

        $userId,

        $productId

    ]);


    echo json_encode([

        "success" => true,

        "message" => "Added to wishlist successfully ❤️"

    ]);


} catch (PDOException $e) {


    echo json_encode([

        "success" => false,

        "message" => "Something went wrong while adding to wishlist."

    ]);


}

?>
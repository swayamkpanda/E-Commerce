<?php

session_start();


/* =========================================
   DATABASE CONNECTION
========================================= */

require_once "../config/database.php";


/* =========================================
   CHECK PRODUCT ID
========================================= */

if (!isset($_GET["id"])) {

    header(
        "Location: index.php?error=invalid_request"
    );

    exit;

}


$productId = (int) $_GET["id"];


/* =========================================
   VALIDATE ID
========================================= */

if ($productId <= 0) {

    header(
        "Location: index.php?error=invalid_product"
    );

    exit;

}


/* =========================================
   DELETE PRODUCT
========================================= */

$sql = "
    DELETE FROM products
    WHERE id = ?
";


$stmt = $conn->prepare($sql);


if (!$stmt) {

    header(
        "Location: index.php?error=database_error"
    );

    exit;

}


$stmt->bind_param(
    "i",
    $productId
);


if ($stmt->execute()) {


    if ($stmt->affected_rows > 0) {

        header(
            "Location: index.php?success=product_removed"
        );

        exit;

    }


    header(
        "Location: index.php?error=product_not_found"
    );

    exit;


}


/* =========================================
   ERROR
========================================= */

header(
    "Location: index.php?error=remove_failed"
);

exit;

?>
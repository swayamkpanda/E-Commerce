<?php

session_start();


/* =========================================
   GET ITEM ID
========================================= */

$itemId = isset($_GET["id"])
    ? (int) $_GET["id"]
    : 0;


/* =========================================
   VALIDATE ITEM ID
========================================= */

if ($itemId <= 0) {

    header(
        "Location: index.php?error=invalid_item"
    );

    exit;

}


/* =========================================
   TEMPORARY WARDROBE DATA

   Later this will come from MySQL.
========================================= */

$wardrobeItems = [

    [
        "id" => 1,
        "name" => "Black Oversized T-Shirt"
    ],

    [
        "id" => 2,
        "name" => "Blue Denim Jacket"
    ],

    [
        "id" => 3,
        "name" => "White Sneakers"
    ],

    [
        "id" => 4,
        "name" => "Black Cargo Pants"
    ]

];


/* =========================================
   CHECK IF ITEM EXISTS
========================================= */

$itemExists = false;


foreach ($wardrobeItems as $item) {

    if ($item["id"] === $itemId) {

        $itemExists = true;

        break;

    }

}


/* =========================================
   HANDLE INVALID ITEM
========================================= */

if (!$itemExists) {

    header(
        "Location: index.php?error=item_not_found"
    );

    exit;

}


/* =========================================
   REMOVE ITEM

   DATABASE VERSION LATER:

   DELETE FROM wardrobe_items
   WHERE id = ?
   AND user_id = ?
========================================= */


/*
 * Temporary behaviour.
 *
 * The item will be permanently removed
 * once MySQL is connected.
 */


/* =========================================
   REDIRECT
========================================= */

header(
    "Location: index.php?success=item_removed"
);

exit;

?>
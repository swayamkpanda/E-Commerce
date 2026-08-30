 <?php

$pageTitle = "Edit Listing | SSISS";


/* =========================================
   TEMPORARY LISTING DATA
   Later replace with MySQL queries
========================================= */

$listings = [

    101 => [
        "id" => 101,
        "name" => "Classic Blue Denim Jacket",
        "category" => "Men",
        "brand" => "Levi's",
        "size" => "M",
        "condition" => "Excellent",
        "originalPrice" => 2499,
        "sellingPrice" => 899,
        "description" => "Classic blue denim jacket in excellent condition. Comfortable fit with minimal signs of wear.",
        "location" => "Bhubaneswar",
        "image" => "../assets/images/products/denim-jacket.jpg",
        "status" => "Active"
    ],

    102 => [
        "id" => 102,
        "name" => "Black Casual Hoodie",
        "category" => "Men",
        "brand" => "",
        "size" => "L",
        "condition" => "Like New",
        "originalPrice" => 1799,
        "sellingPrice" => 699,
        "description" => "Comfortable black casual hoodie in like-new condition.",
        "location" => "Cuttack",
        "image" => "../assets/images/products/black-hoodie.jpg",
        "status" => "Active"
    ],

    103 => [
        "id" => 103,
        "name" => "Cotton Summer Shirt",
        "category" => "Men",
        "brand" => "",
        "size" => "M",
        "condition" => "Good",
        "originalPrice" => 1299,
        "sellingPrice" => 499,
        "description" => "Lightweight cotton shirt suitable for casual summer wear.",
        "location" => "Bhubaneswar",
        "image" => "../assets/images/products/casual-shirt.jpg",
        "status" => "Pending"
    ],

    104 => [
        "id" => 104,
        "name" => "Vintage Denim Jeans",
        "category" => "Men",
        "brand" => "Levi's",
        "size" => "32",
        "condition" => "Excellent",
        "originalPrice" => 2199,
        "sellingPrice" => 799,
        "description" => "Vintage-style denim jeans in excellent condition.",
        "location" => "Puri",
        "image" => "../assets/images/products/denim-jeans.jpg",
        "status" => "Active"
    ]

];


/* =========================================
   GET LISTING ID
========================================= */

$listingId = isset($_GET["id"])

    ? (int) $_GET["id"]

    : 0;


/* =========================================
   CHECK IF LISTING EXISTS
========================================= */

if (!isset($listings[$listingId])) {

    header(
        "Location: my-listings.php"
    );

    exit;

}


$listing = $listings[$listingId];


/* =========================================
   FORM OPTIONS
========================================= */

$categories = [
    "Men",
    "Women",
    "Kids",
    "Accessories"
];


$conditions = [
    "New with Tags",
    "Like New",
    "Excellent",
    "Good",
    "Fair"
];


/* =========================================
   FORM MESSAGE
========================================= */

$message = "";

$messageType = "";


/* =========================================
   FORM SUBMISSION
========================================= */

if ($_SERVER["REQUEST_METHOD"] === "POST") {


    $productName =
        trim(
            $_POST["product_name"]
            ?? ""
        );


    $category =
        $_POST["category"]
        ?? "";


    $brand =
        trim(
            $_POST["brand"]
            ?? ""
        );


    $size =
        trim(
            $_POST["size"]
            ?? ""
        );


    $condition =
        $_POST["condition"]
        ?? "";


    $originalPrice =
        trim(
            $_POST["original_price"]
            ?? ""
        );


    $sellingPrice =
        trim(
            $_POST["selling_price"]
            ?? ""
        );


    $description =
        trim(
            $_POST["description"]
            ?? ""
        );


    $location =
        trim(
            $_POST["location"]
            ?? ""
        );


    /* =====================================
       VALIDATION
    ====================================== */

    if (

        $productName === ""

        ||

        $category === ""

        ||

        $size === ""

        ||

        $condition === ""

        ||

        $sellingPrice === ""

        ||

        $description === ""

        ||

        $location === ""

    ) {


        $message =
            "Please fill in all required fields.";


        $messageType =
            "error";


    }

    elseif (

        !is_numeric(
            $sellingPrice
        )

        ||

        (float) $sellingPrice <= 0

    ) {


        $message =
            "Please enter a valid selling price.";


        $messageType =
            "error";


    }

    else {


        /* =================================
           UPDATE TEMPORARY LISTING DATA

           Later replace this section with:

           UPDATE marketplace_listings
           SET ...
           WHERE id = ?
        ================================= */

        $listing["name"] =
            $productName;


        $listing["category"] =
            $category;


        $listing["brand"] =
            $brand;


        $listing["size"] =
            $size;


        $listing["condition"] =
            $condition;


        $listing["originalPrice"] =
            $originalPrice !== ""

                ? (float) $originalPrice

                : 0;


        $listing["sellingPrice"] =
            (float) $sellingPrice;


        $listing["description"] =
            $description;


        $listing["location"] =
            $location;


        $message =
            "Your listing has been updated successfully!";


        $messageType =
            "success";


    }


}

?>

<!DOCTYPE html>

<html lang="en">

<head>


    <meta charset="UTF-8">


    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >


    <title>


        <?php
        echo htmlspecialchars(
            $pageTitle
        );
        ?>


    </title>


    <!-- GOOGLE FONTS -->

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >


    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >


    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet"
    >


    <!-- FONT AWESOME -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    >


    <!-- PROJECT CSS -->

    <link
        rel="stylesheet"
        href="../assets/css/home.css"
    >


    <link
        rel="stylesheet"
        href="../assets/css/marketplace.css"
    >


</head>


<body>


<!-- =========================================
     NAVBAR
========================================= -->

<header class="navbar">


    <a
        href="../index.php"
        class="logo"
    >

        SSI<span>SS</span>

    </a>


    <nav class="nav-links">


        <a href="../index.php">

            Home

        </a>


        <a href="../shop/index.php">

            Shop

        </a>


        <a href="../wardrobe/index.php">

            Wardrobe

        </a>


        <a
            href="index.php"
            class="active"
        >

            Pre-Loved

        </a>


        <a href="../impact/index.php">

            Impact

        </a>


    </nav>


    <div class="nav-actions">


        <a
            href="../wishlist/index.php"
            class="icon-btn"
        >

            <i class="fa-solid fa-heart"></i>

        </a>


        <a
            href="../cart/index.php"
            class="icon-btn"
        >

            <i class="fa-solid fa-bag-shopping"></i>

        </a>


        <a
            href="../profile/index.php"
            class="profile-btn"
        >

            <i class="fa-solid fa-user"></i>

        </a>


    </div>


</header>



<!-- =========================================
     EDIT LISTING PAGE
========================================= -->

<main class="marketplace-listing-page">


    <!-- BACK BUTTON -->

    <a
        href="my-listings.php"
        class="marketplace-back-btn"
    >


        <i class="fa-solid fa-arrow-left"></i>


        BACK TO MY LISTINGS


    </a>



    <!-- =====================================
         PAGE HEADER
    ====================================== -->

    <section class="marketplace-listing-header">


        <p class="section-tag">

            MANAGE YOUR LISTING

        </p>


        <h1>

            EDIT

            <span>LISTING.</span>

        </h1>


        <p>

            Update your item details, price,
            description, and photos.

        </p>


    </section>



    <!-- =====================================
         FORM MESSAGE
    ====================================== -->

    <?php if ($message !== ""): ?>


        <div
            class="marketplace-form-message <?php
            echo htmlspecialchars(
                $messageType
            );
            ?>"
        >


            <?php if ($messageType === "success"): ?>


                <i class="fa-solid fa-circle-check"></i>


            <?php else: ?>


                <i class="fa-solid fa-circle-exclamation"></i>


            <?php endif; ?>


            <span>


                <?php
                echo htmlspecialchars(
                    $message
                );
                ?>


            </span>


        </div>


    <?php endif; ?>



    <!-- =====================================
         EDIT FORM
    ====================================== -->

    <form
        action="edit-listing.php?id=<?php
        echo urlencode(
            $listing["id"]
        );
        ?>"
        method="POST"
        enctype="multipart/form-data"
        class="marketplace-listing-form"
    >


        <!-- =================================
             CURRENT LISTING STATUS
        ================================== -->

        <section class="marketplace-form-section">


            <div class="marketplace-current-listing-status">


                <div>


                    <span>

                        LISTING STATUS

                    </span>


                    <strong
                        class="marketplace-listing-status <?php
                        echo strtolower(
                            $listing["status"]
                        );
                        ?>"
                    >


                        <?php
                        echo htmlspecialchars(
                            $listing["status"]
                        );
                        ?>


                    </strong>


                </div>


                <a
                    href="product.php?id=<?php
                    echo urlencode(
                        $listing["id"]
                    );
                    ?>"
                    class="marketplace-view-listing-btn"
                >


                    <i class="fa-solid fa-eye"></i>


                    VIEW LISTING


                </a>


            </div>


        </section>



        <!-- =================================
             ITEM INFORMATION
        ================================== -->

        <section class="marketplace-form-section">


            <div class="marketplace-form-section-heading">


                <div class="marketplace-form-section-icon">


                    <i class="fa-solid fa-shirt"></i>


                </div>


                <div>


                    <h2>

                        ITEM INFORMATION

                    </h2>


                    <p>

                        Update your clothing details.

                    </p>


                </div>


            </div>



            <div class="marketplace-form-grid">


                <!-- PRODUCT NAME -->

                <div
                    class="marketplace-form-group full-width"
                >


                    <label
                        for="product_name"
                    >


                        PRODUCT NAME

                        <span>*</span>


                    </label>


                    <input
                        type="text"
                        id="product_name"
                        name="product_name"
                        value="<?php
                        echo htmlspecialchars(
                            $listing["name"]
                        );
                        ?>"
                        required
                    >


                </div>



                <!-- CATEGORY -->

                <div class="marketplace-form-group">


                    <label
                        for="category"
                    >


                        CATEGORY

                        <span>*</span>


                    </label>


                    <select
                        id="category"
                        name="category"
                        required
                    >


                        <?php foreach (

                            $categories

                            as

                            $itemCategory

                        ): ?>


                            <option
                                value="<?php
                                echo htmlspecialchars(
                                    $itemCategory
                                );
                                ?>"
                                <?php
                                echo
                                    $listing["category"]
                                    ===
                                    $itemCategory

                                        ? "selected"

                                        : "";
                                ?>
                            >


                                <?php
                                echo htmlspecialchars(
                                    strtoupper(
                                        $itemCategory
                                    )
                                );
                                ?>


                            </option>


                        <?php endforeach; ?>


                    </select>


                </div>



                <!-- BRAND -->

                <div class="marketplace-form-group">


                    <label
                        for="brand"
                    >


                        BRAND

                        <small>

                            OPTIONAL

                        </small>


                    </label>


                    <input
                        type="text"
                        id="brand"
                        name="brand"
                        value="<?php
                        echo htmlspecialchars(
                            $listing["brand"]
                        );
                        ?>"
                    >


                </div>



                <!-- SIZE -->

                <div class="marketplace-form-group">


                    <label
                        for="size"
                    >


                        SIZE

                        <span>*</span>


                    </label>


                    <input
                        type="text"
                        id="size"
                        name="size"
                        value="<?php
                        echo htmlspecialchars(
                            $listing["size"]
                        );
                        ?>"
                        required
                    >


                </div>



                <!-- CONDITION -->

                <div class="marketplace-form-group">


                    <label
                        for="condition"
                    >


                        CONDITION

                        <span>*</span>


                    </label>


                    <select
                        id="condition"
                        name="condition"
                        required
                    >


                        <?php foreach (

                            $conditions

                            as

                            $itemCondition

                        ): ?>


                            <option
                                value="<?php
                                echo htmlspecialchars(
                                    $itemCondition
                                );
                                ?>"
                                <?php
                                echo
                                    $listing["condition"]
                                    ===
                                    $itemCondition

                                        ? "selected"

                                        : "";
                                ?>
                            >


                                <?php
                                echo htmlspecialchars(
                                    strtoupper(
                                        $itemCondition
                                    )
                                );
                                ?>


                            </option>


                        <?php endforeach; ?>


                    </select>


                </div>


            </div>


        </section>



        <!-- =================================
             PRICING
        ================================== -->

        <section class="marketplace-form-section">


            <div class="marketplace-form-section-heading">


                <div class="marketplace-form-section-icon">


                    <i class="fa-solid fa-indian-rupee-sign"></i>


                </div>


                <div>


                    <h2>

                        PRICING

                    </h2>


                    <p>

                        Update the selling price of your item.

                    </p>


                </div>


            </div>



            <div class="marketplace-form-grid">


                <!-- ORIGINAL PRICE -->

                <div class="marketplace-form-group">


                    <label
                        for="original_price"
                    >


                        ORIGINAL PRICE

                        <small>

                            OPTIONAL

                        </small>


                    </label>


                    <div class="marketplace-input-prefix">


                        <span>

                            ₹

                        </span>


                        <input
                            type="number"
                            id="original_price"
                            name="original_price"
                            min="0"
                            step="1"
                            value="<?php
                            echo htmlspecialchars(
                                $listing[
                                    "originalPrice"
                                ]
                            );
                            ?>"
                        >


                    </div>


                </div>



                <!-- SELLING PRICE -->

                <div class="marketplace-form-group">


                    <label
                        for="selling_price"
                    >


                        SELLING PRICE

                        <span>*</span>


                    </label>


                    <div class="marketplace-input-prefix">


                        <span>

                            ₹

                        </span>


                        <input
                            type="number"
                            id="selling_price"
                            name="selling_price"
                            min="1"
                            step="1"
                            value="<?php
                            echo htmlspecialchars(
                                $listing[
                                    "sellingPrice"
                                ]
                            );
                            ?>"
                            required
                        >


                    </div>


                </div>


            </div>


        </section>



        <!-- =================================
             DESCRIPTION
        ================================== -->

        <section class="marketplace-form-section">


            <div class="marketplace-form-section-heading">


                <div class="marketplace-form-section-icon">


                    <i class="fa-solid fa-align-left"></i>


                </div>


                <div>


                    <h2>

                        DESCRIPTION

                    </h2>


                    <p>

                        Keep your description accurate.

                    </p>


                </div>


            </div>



            <div class="marketplace-form-group">


                <label
                    for="description"
                >


                    ITEM DESCRIPTION

                    <span>*</span>


                </label>


                <textarea
                    id="description"
                    name="description"
                    rows="7"
                    required
                ><?php
                echo htmlspecialchars(
                    $listing["description"]
                );
                ?></textarea>


            </div>


        </section>



        <!-- =================================
             LOCATION
        ================================== -->

        <section class="marketplace-form-section">


            <div class="marketplace-form-section-heading">


                <div class="marketplace-form-section-icon">


                    <i class="fa-solid fa-location-dot"></i>


                </div>


                <div>


                    <h2>

                        LOCATION

                    </h2>


                    <p>

                        Update your item's location.

                    </p>


                </div>


            </div>



            <div class="marketplace-form-group">


                <label
                    for="location"
                >


                    CITY / LOCATION

                    <span>*</span>


                </label>


                <input
                    type="text"
                    id="location"
                    name="location"
                    value="<?php
                    echo htmlspecialchars(
                        $listing["location"]
                    );
                    ?>"
                    required
                >


            </div>


        </section>



        <!-- =================================
             PRODUCT IMAGE
        ================================== -->

        <section class="marketplace-form-section">


            <div class="marketplace-form-section-heading">


                <div class="marketplace-form-section-icon">


                    <i class="fa-solid fa-camera"></i>


                </div>


                <div>


                    <h2>

                        ITEM PHOTO

                    </h2>


                    <p>

                        Replace your current listing photo
                        if needed.

                    </p>


                </div>


            </div>



            <!-- CURRENT IMAGE -->

            <div
                class="marketplace-current-image"
            >


                <img
                    id="currentListingImage"
                    src="<?php
                    echo htmlspecialchars(
                        $listing["image"]
                    );
                    ?>"
                    alt="<?php
                    echo htmlspecialchars(
                        $listing["name"]
                    );
                    ?>"
                >


            </div>



            <!-- IMAGE UPLOAD -->

            <div class="marketplace-upload-area">


                <input
                    type="file"
                    id="product_image"
                    name="product_image"
                    accept="image/*"
                    hidden
                >


                <label
                    for="product_image"
                    class="marketplace-upload-label"
                >


                    <div
                        class="marketplace-upload-icon"
                    >


                        <i class="fa-solid fa-arrows-rotate"></i>


                    </div>


                    <h3>

                        REPLACE ITEM PHOTO

                    </h3>


                    <p>

                        PNG, JPG OR WEBP

                    </p>


                    <span>

                        CLICK TO SELECT A NEW PHOTO

                    </span>


                </label>


            </div>


        </section>



        <!-- =================================
             FORM ACTIONS
        ================================== -->

        <div class="marketplace-form-actions">


            <a
                href="my-listings.php"
                class="marketplace-secondary-btn"
            >


                CANCEL


            </a>


            <button
                type="submit"
                class="marketplace-primary-btn"
            >


                <i class="fa-solid fa-floppy-disk"></i>


                SAVE CHANGES


            </button>


        </div>


    </form>


</main>



<!-- =========================================
     IMAGE PREVIEW SCRIPT
========================================= -->

<script>


const imageInput =
    document.getElementById(
        "product_image"
    );


const currentImage =
    document.getElementById(
        "currentListingImage"
    );


imageInput.addEventListener(

    "change",

    function () {


        const file =
            this.files[0];


        if (!file) {

            return;

        }


        currentImage.src =
            URL.createObjectURL(
                file
            );


    }

);


</script>


<!-- PROJECT JAVASCRIPT -->

<script src="../assets/js/marketplace.js"></script>


</body>

</html>   
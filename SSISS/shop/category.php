<?php

$pageTitle = "Category | SSISS";


/* =========================================
   GET CATEGORY
========================================= */

$category = isset($_GET["name"])
    ? trim($_GET["name"])
    : "";


/* =========================================
   VALID CATEGORIES
========================================= */

$categories = [

    "Clothing",
    "Shoes",
    "Watches",
    "Spectacles",
    "Accessories"

];


/* =========================================
   TEMPORARY PRODUCT DATA

   Later replace with MySQL database.
========================================= */

$products = [

    [
        "id" => 1,
        "name" => "Oversized Essential Tee",
        "category" => "Clothing",
        "price" => 799,
        "badge" => "NEW",
        "image" =>
            "https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=800&q=80"
    ],

    [
        "id" => 2,
        "name" => "Classic Leather Sneakers",
        "category" => "Shoes",
        "price" => 2999,
        "badge" => "TRENDING",
        "image" =>
            "https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=800&q=80"
    ],

    [
        "id" => 3,
        "name" => "Minimal Steel Watch",
        "category" => "Watches",
        "price" => 3499,
        "badge" => "POPULAR",
        "image" =>
            "https://images.unsplash.com/photo-1524805444758-089113d48a6d?auto=format&fit=crop&w=800&q=80"
    ],

    [
        "id" => 4,
        "name" => "Retro Square Sunglasses",
        "category" => "Spectacles",
        "price" => 1299,
        "badge" => "NEW",
        "image" =>
            "https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=800&q=80"
    ],

    [
        "id" => 5,
        "name" => "Urban Cargo Pants",
        "category" => "Clothing",
        "price" => 1899,
        "badge" => "STREET",
        "image" =>
            "https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=800&q=80"
    ],

    [
        "id" => 6,
        "name" => "Premium Canvas Shoes",
        "category" => "Shoes",
        "price" => 2299,
        "badge" => "BESTSELLER",
        "image" =>
            "https://images.unsplash.com/photo-1543508282-6319a3e2621f?auto=format&fit=crop&w=800&q=80"
    ],

    [
        "id" => 7,
        "name" => "Classic Silver Watch",
        "category" => "Watches",
        "price" => 4199,
        "badge" => "LIMITED",
        "image" =>
            "https://images.unsplash.com/photo-1508057198894-247b23fe5ade?auto=format&fit=crop&w=800&q=80"
    ],

    [
        "id" => 8,
        "name" => "Minimal Crossbody Bag",
        "category" => "Accessories",
        "price" => 1599,
        "badge" => "NEW",
        "image" =>
            "https://images.unsplash.com/photo-1553062407-98eeb64c6a62?auto=format&fit=crop&w=800&q=80"
    ]

];


/* =========================================
   CHECK CATEGORY
========================================= */

$validCategory = false;


foreach ($categories as $item) {

    if (
        strtolower($item) ===
        strtolower($category)
    ) {

        $category = $item;

        $validCategory = true;

        break;

    }

}


/* =========================================
   FILTER CATEGORY PRODUCTS
========================================= */

$categoryProducts = [];


if ($validCategory) {

    foreach ($products as $product) {

        if (
            strtolower($product["category"]) ===
            strtolower($category)
        ) {

            $categoryProducts[] = $product;

        }

    }

}


$pageTitle = $validCategory
    ? $category . " | SSISS"
    : "Category Not Found | SSISS";

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

        <?php echo htmlspecialchars($pageTitle); ?>

    </title>


    <!-- FONTS -->

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
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;1,500;1,600&display=swap"
        rel="stylesheet"
    >


    <!-- FONT AWESOME -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    >


    <!-- CSS -->

    <link
        rel="stylesheet"
        href="../assets/css/home.css"
    >

    <link
        rel="stylesheet"
        href="../assets/css/category.css"
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


        <a
            href="index.php"
            class="nav-active"
        >

            Shop

        </a>


        <a href="../ai/index.php">

            AI Stylist
            <span class="sparkle">✦</span>

        </a>


        <a href="../ai/vibe.php">

            Vibes

        </a>


        <a href="../marketplace/index.php">

            Pre-Loved

        </a>


        <a href="../impact/index.php">

            Impact

        </a>

    </nav>


    <div class="nav-actions">


        <!-- SEARCH -->

        <a
            href="search.php"
            class="icon-btn"
        >

            <i class="fa-solid fa-magnifying-glass"></i>

        </a>


        <!-- WISHLIST -->

        <a
            href="../wishlist/index.php"
            class="icon-btn"
        >

            <i class="fa-regular fa-heart"></i>

            <span class="wishlist-count">

                0

            </span>

        </a>


        <!-- CART -->

        <a
            href="../cart/index.php"
            class="icon-btn"
        >

            <i class="fa-solid fa-bag-shopping"></i>

            <span class="cart-count">

                0

            </span>

        </a>


        <!-- PROFILE -->

        <a
            href="../auth/login.php"
            class="profile-btn"
        >

            <i class="fa-regular fa-user"></i>

        </a>


    </div>


</header>



<!-- =========================================
     CATEGORY PAGE
========================================= -->

<main class="category-page">


<?php if ($validCategory): ?>


    <!-- =====================================
         CATEGORY HERO
    ====================================== -->

    <section class="category-hero">


        <p class="section-tag">

            SSISS COLLECTION

        </p>


        <h1>

            <?php echo htmlspecialchars(
                strtoupper($category)
            ); ?>

            <span>

                COLLECTION.

            </span>

        </h1>


        <p class="category-description">

            Discover curated products selected
            to match your style, vibe and
            everyday lifestyle.

        </p>


        <div class="category-meta">

            <span>

                <?php echo count(
                    $categoryProducts
                ); ?>

                PRODUCT<?php
                echo count($categoryProducts) !== 1
                    ? "S"
                    : "";
                ?>

            </span>


            <a href="filter.php">

                FILTER PRODUCTS
                <i class="fa-solid fa-sliders"></i>

            </a>

        </div>


    </section>



    <!-- =====================================
         CATEGORY NAVIGATION
    ====================================== -->

    <section class="category-navigation">


        <a href="index.php">

            ALL

        </a>


        <?php foreach ($categories as $item): ?>


            <a
                href="category.php?name=<?php
                echo urlencode($item);
                ?>"

                class="<?php
                echo strtolower($item) ===
                    strtolower($category)
                    ? "active"
                    : "";
                ?>"
            >

                <?php
                echo strtoupper($item);
                ?>

            </a>


        <?php endforeach; ?>


    </section>



    <!-- =====================================
         PRODUCTS
    ====================================== -->

    <section class="category-products">


        <div class="category-products-grid">


            <?php
            foreach (
                $categoryProducts as $product
            ):
            ?>


                <article class="category-product-card">


                    <!-- PRODUCT IMAGE -->

                    <a
                        href="product.php?id=<?php
                        echo $product["id"];
                        ?>"

                        class="category-product-image"
                    >

                        <img
                            src="<?php
                            echo htmlspecialchars(
                                $product["image"]
                            );
                            ?>"

                            alt="<?php
                            echo htmlspecialchars(
                                $product["name"]
                            );
                            ?>"
                        >


                        <span class="category-badge">

                            <?php
                            echo htmlspecialchars(
                                $product["badge"]
                            );
                            ?>

                        </span>


                        <span class="view-product-overlay">

                            VIEW PRODUCT

                        </span>


                    </a>



                    <!-- PRODUCT INFO -->

                    <div class="category-product-info">


                        <p>

                            <?php
                            echo strtoupper(
                                htmlspecialchars(
                                    $product["category"]
                                )
                            );
                            ?>

                        </p>


                        <a
                            href="product.php?id=<?php
                            echo $product["id"];
                            ?>"
                        >

                            <h2>

                                <?php
                                echo htmlspecialchars(
                                    $product["name"]
                                );
                                ?>

                            </h2>

                        </a>


                        <div class="category-product-bottom">


                            <strong>

                                ₹<?php
                                echo number_format(
                                    $product["price"]
                                );
                                ?>

                            </strong>


                            <button
                                class="quick-wishlist"
                                data-id="<?php
                                echo $product["id"];
                                ?>"
                                title="Add to Wishlist"
                            >

                                <i class="fa-regular fa-heart"></i>

                            </button>


                        </div>


                    </div>


                </article>


            <?php endforeach; ?>


        </div>


    </section>



<?php else: ?>


    <!-- =====================================
         INVALID CATEGORY
    ====================================== -->

    <section class="category-not-found">


        <div class="category-error-icon">

            <i class="fa-solid fa-compass"></i>

        </div>


        <p class="section-tag">

            CATEGORY NOT FOUND

        </p>


        <h1>

            OOPS, WRONG

            <span>TURN.</span>

        </h1>


        <p>

            The collection you are looking for
            doesn't exist or may have been moved.

        </p>


        <a
            href="index.php"
            class="explore-shop-btn"
        >

            EXPLORE THE SHOP

        </a>


    </section>


<?php endif; ?>


</main>



<!-- =========================================
     JAVASCRIPT
========================================= -->

<script src="../assets/js/category.js"></script>


</body>

</html>
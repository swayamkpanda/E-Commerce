<?php

$pageTitle = "Pre-Loved Marketplace | SSISS";


/* =========================================
   TEMPORARY MARKETPLACE DATA
   Later replace with MySQL queries
========================================= */

$products = [

    [
        "id" => 1,
        "name" => "Classic Denim Jacket",
        "category" => "Men",
        "size" => "M",
        "condition" => "Excellent",
        "price" => 899,
        "originalPrice" => 2499,
        "seller" => "Rahul Sharma",
        "location" => "Bhubaneswar",
        "image" => "https://images.unsplash.com/photo-1576871337632-b9aef4c17ab9?auto=format&fit=crop&w=900&q=80",
        "status" => "Available"
    ],

    [
        "id" => 2,
        "name" => "Floral Summer Dress",
        "category" => "Women",
        "size" => "S",
        "condition" => "Like New",
        "price" => 699,
        "originalPrice" => 1999,
        "seller" => "Priya Das",
        "location" => "Cuttack",
        "image" => "https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?auto=format&fit=crop&w=900&q=80",
        "status" => "Available"
    ],

    [
        "id" => 3,
        "name" => "Black Leather Jacket",
        "category" => "Men",
        "size" => "L",
        "condition" => "Good",
        "price" => 1299,
        "originalPrice" => 3499,
        "seller" => "Aman Kumar",
        "location" => "Bhubaneswar",
        "image" => "https://images.unsplash.com/photo-1551028719-00167b16eac5?auto=format&fit=crop&w=900&q=80",
        "status" => "Available"
    ],

    [
        "id" => 4,
        "name" => "Cotton Casual Shirt",
        "category" => "Men",
        "size" => "M",
        "condition" => "Excellent",
        "price" => 499,
        "originalPrice" => 1299,
        "seller" => "Rohan Singh",
        "location" => "Puri",
        "image" => "https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?auto=format&fit=crop&w=900&q=80",
        "status" => "Available"
    ],

    [
        "id" => 5,
        "name" => "Vintage Handbag",
        "category" => "Accessories",
        "size" => "One Size",
        "condition" => "Good",
        "price" => 799,
        "originalPrice" => 2299,
        "seller" => "Sneha Patel",
        "location" => "Bhubaneswar",
        "image" => "https://images.unsplash.com/photo-1584917865442-de89df76afd3?auto=format&fit=crop&w=900&q=80",
        "status" => "Available"
    ],

    [
        "id" => 6,
        "name" => "Kids Winter Hoodie",
        "category" => "Kids",
        "size" => "8-10 Years",
        "condition" => "Like New",
        "price" => 399,
        "originalPrice" => 999,
        "seller" => "Ananya Singh",
        "location" => "Cuttack",
        "image" => "https://images.unsplash.com/photo-1519238360530-93c2b77b5d97?auto=format&fit=crop&w=900&q=80",
        "status" => "Available"
    ]

];


/* =========================================
   GET SEARCH AND FILTER VALUES
========================================= */

$search = trim($_GET["search"] ?? "");

$category = $_GET["category"] ?? "All";


/* =========================================
   FILTER PRODUCTS
========================================= */

$filteredProducts = array_filter(

    $products,

    function ($product) use ($search, $category) {

        $matchesSearch = true;

        $matchesCategory = true;


        if ($search !== "") {

            $matchesSearch =

                stripos(
                    $product["name"],
                    $search
                ) !== false

                ||

                stripos(
                    $product["category"],
                    $search
                ) !== false;

        }


        if ($category !== "All") {

            $matchesCategory =
                $product["category"] === $category;

        }


        return
            $matchesSearch
            &&
            $matchesCategory;

    }

);

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
        echo htmlspecialchars($pageTitle);
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
     MARKETPLACE HERO
========================================= -->

<section class="marketplace-hero">


    <div class="marketplace-hero-content">


        <p class="section-tag">

            CIRCULAR FASHION MARKETPLACE

        </p>


        <h1>

            GIVE FASHION A

            <span>SECOND LIFE.</span>

        </h1>


        <p>

            Discover quality pre-loved clothing
            and give your wardrobe a sustainable upgrade.

        </p>


        <div class="marketplace-hero-actions">


            <a
                href="sell.php"
                class="marketplace-primary-btn"
            >

                <i class="fa-solid fa-plus"></i>

                SELL AN ITEM

            </a>


            <a
                href="my-listings.php"
                class="marketplace-secondary-btn"
            >

                <i class="fa-solid fa-list"></i>

                MY LISTINGS

            </a>


        </div>


    </div>


    <div class="marketplace-hero-visual">


        <div class="marketplace-hero-circle">


            <i class="fa-solid fa-recycle"></i>


        </div>


        <div class="marketplace-floating-card card-one">

            <i class="fa-solid fa-shirt"></i>

            <span>PRE-LOVED</span>

        </div>


        <div class="marketplace-floating-card card-two">

            <i class="fa-solid fa-leaf"></i>

            <span>SUSTAINABLE</span>

        </div>


    </div>


</section>



<!-- =========================================
     MARKETPLACE CONTENT
========================================= -->

<main class="marketplace-page">


    <!-- =====================================
         SECTION HEADER
    ====================================== -->

    <section class="marketplace-section-heading">


        <div>


            <p class="section-tag">

                DISCOVER PRE-LOVED

            </p>


            <h2>

                FIND YOUR

                <span>NEXT FAVORITE.</span>

            </h2>


        </div>


        <a
            href="sell.php"
            class="marketplace-text-link"
        >

            SELL YOUR CLOTHES

            <i class="fa-solid fa-arrow-right"></i>

        </a>


    </section>



    <!-- =====================================
         SEARCH
    ====================================== -->

    <section class="marketplace-search-section">


        <form
            action="index.php"
            method="GET"
            class="marketplace-search-form"
        >


            <div class="marketplace-search-box">


                <i class="fa-solid fa-magnifying-glass"></i>


                <input
                    type="text"
                    name="search"
                    placeholder="Search clothing, brands or styles..."
                    value="<?php
                    echo htmlspecialchars($search);
                    ?>"
                >


            </div>


            <button
                type="submit"
                class="marketplace-search-btn"
            >

                SEARCH

            </button>


        </form>


    </section>



    <!-- =====================================
         CATEGORY FILTERS
    ====================================== -->

    <section class="marketplace-categories">


        <?php

        $categories = [
            "All",
            "Men",
            "Women",
            "Kids",
            "Accessories"
        ];


        foreach ($categories as $itemCategory):

        ?>


            <a
                href="index.php?category=<?php
                echo urlencode($itemCategory);
                ?>"
                class="marketplace-category-btn <?php
                echo $category === $itemCategory
                    ? "active"
                    : "";
                ?>"
            >

                <?php
                echo htmlspecialchars($itemCategory);
                ?>

            </a>


        <?php endforeach; ?>


    </section>



    <!-- =====================================
         RESULTS INFO
    ====================================== -->

    <section class="marketplace-results-header">


        <p>

            <strong>

                <?php
                echo count($filteredProducts);
                ?>

            </strong>

            ITEMS AVAILABLE

        </p>


        <span>

            PRE-LOVED & VERIFIED

        </span>


    </section>



    <!-- =====================================
         PRODUCT GRID
    ====================================== -->

    <section class="marketplace-product-grid">


        <?php if (!empty($filteredProducts)): ?>


            <?php foreach ($filteredProducts as $product): ?>


                <article class="marketplace-product-card">


                    <!-- PRODUCT IMAGE -->


                    <a
                        href="product.php?id=<?php
                        echo urlencode($product["id"]);
                        ?>"
                        class="marketplace-product-image"
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


                        <span class="marketplace-condition">

                            <?php
                            echo htmlspecialchars(
                                $product["condition"]
                            );
                            ?>

                        </span>


                    </a>



                    <!-- PRODUCT CONTENT -->


                    <div class="marketplace-product-content">


                        <div class="marketplace-product-top">


                            <span class="marketplace-category">

                                <?php
                                echo htmlspecialchars(
                                    $product["category"]
                                );
                                ?>

                            </span>


                            <a
                                href="../wishlist/add.php?id=<?php
                                echo urlencode(
                                    $product["id"]
                                );
                                ?>"
                                class="marketplace-wishlist-btn"
                                title="Add to Wishlist"
                            >

                                <i class="fa-regular fa-heart"></i>

                            </a>


                        </div>



                        <h3>


                            <a
                                href="product.php?id=<?php
                                echo urlencode(
                                    $product["id"]
                                );
                                ?>"
                            >

                                <?php
                                echo htmlspecialchars(
                                    $product["name"]
                                );
                                ?>

                            </a>


                        </h3>



                        <div class="marketplace-product-meta">


                            <span>

                                SIZE:

                                <strong>

                                    <?php
                                    echo htmlspecialchars(
                                        $product["size"]
                                    );
                                    ?>

                                </strong>

                            </span>


                            <span>

                                ·

                            </span>


                            <span>

                                <?php
                                echo htmlspecialchars(
                                    $product["condition"]
                                );
                                ?>

                            </span>


                        </div>



                        <!-- PRICE -->


                        <div class="marketplace-price">


                            <strong>

                                ₹<?php
                                echo number_format(
                                    $product["price"]
                                );
                                ?>

                            </strong>


                            <span>

                                ₹<?php
                                echo number_format(
                                    $product["originalPrice"]
                                );
                                ?>

                            </span>


                        </div>



                        <!-- SELLER -->


                        <div class="marketplace-seller">


                            <div class="marketplace-seller-avatar">

                                <?php

                                echo strtoupper(
                                    substr(
                                        $product["seller"],
                                        0,
                                        1
                                    )
                                );

                                ?>

                            </div>


                            <div>


                                <span>

                                    SOLD BY

                                </span>


                                <strong>

                                    <?php
                                    echo htmlspecialchars(
                                        $product["seller"]
                                    );
                                    ?>

                                </strong>


                            </div>


                            <small>

                                <i class="fa-solid fa-location-dot"></i>

                                <?php
                                echo htmlspecialchars(
                                    $product["location"]
                                );
                                ?>

                            </small>


                        </div>


                    </div>


                </article>


            <?php endforeach; ?>


        <?php else: ?>


            <!-- EMPTY STATE -->


            <div class="marketplace-empty-state">


                <div class="marketplace-empty-icon">

                    <i class="fa-solid fa-shirt"></i>

                </div>


                <h3>

                    NO ITEMS FOUND

                </h3>


                <p>

                    Try changing your search
                    or selecting another category.

                </p>


                <a
                    href="index.php"
                    class="marketplace-primary-btn"
                >

                    VIEW ALL ITEMS

                </a>


            </div>


        <?php endif; ?>


    </section>


</main>



<!-- =========================================
     MARKETPLACE CTA
========================================= -->

<section class="marketplace-bottom-cta">


    <div>


        <p class="section-tag">

            YOUR CLOTHES DESERVE A SECOND CHANCE

        </p>


        <h2>

            DON'T LET GREAT CLOTHES

            <span>GO TO WASTE.</span>

        </h2>


        <p>

            Sell clothes you no longer wear
            and let someone else love them.

        </p>


    </div>


    <a
        href="sell.php"
        class="marketplace-primary-btn"
    >

        START SELLING

        <i class="fa-solid fa-arrow-right"></i>

    </a>


</section>



<!-- PROJECT JAVASCRIPT -->

<script src="../assets/js/marketplace.js"></script>


</body>

</html>

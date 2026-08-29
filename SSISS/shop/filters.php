<?php

$pageTitle = "Filter Products | SSISS";


/* =========================================
   GET FILTER VALUES
========================================= */

$category = isset($_GET["category"])
    ? trim($_GET["category"])
    : "";

$minPrice = isset($_GET["min_price"])
    ? (int) $_GET["min_price"]
    : 0;

$maxPrice = isset($_GET["max_price"])
    ? (int) $_GET["max_price"]
    : 100000;

$badge = isset($_GET["badge"])
    ? trim($_GET["badge"])
    : "";

$sort = isset($_GET["sort"])
    ? trim($_GET["sort"])
    : "";


/* =========================================
   TEMPORARY PRODUCT DATA

   Later this will come from MySQL.
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
   FILTER PRODUCTS
========================================= */

$filteredProducts = $products;


foreach ($filteredProducts as $key => $product) {


    /* CATEGORY FILTER */

    if (
        $category !== "" &&
        strtolower($product["category"]) !== strtolower($category)
    ) {

        unset($filteredProducts[$key]);

        continue;

    }


    /* MIN PRICE FILTER */

    if (
        $product["price"] < $minPrice
    ) {

        unset($filteredProducts[$key]);

        continue;

    }


    /* MAX PRICE FILTER */

    if (
        $product["price"] > $maxPrice
    ) {

        unset($filteredProducts[$key]);

        continue;

    }


    /* BADGE FILTER */

    if (
        $badge !== "" &&
        strtolower($product["badge"]) !== strtolower($badge)
    ) {

        unset($filteredProducts[$key]);

        continue;

    }

}


/* Reset array indexes */

$filteredProducts = array_values(
    $filteredProducts
);


/* =========================================
   SORT PRODUCTS
========================================= */

if ($sort === "price_low") {

    usort(
        $filteredProducts,
        function ($a, $b) {

            return $a["price"] <=> $b["price"];

        }
    );

}


if ($sort === "price_high") {

    usort(
        $filteredProducts,
        function ($a, $b) {

            return $b["price"] <=> $a["price"];

        }
    );

}


if ($sort === "name_az") {

    usort(
        $filteredProducts,
        function ($a, $b) {

            return strcmp(
                $a["name"],
                $b["name"]
            );

        }
    );

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
        href="../assets/css/filter.css"
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

        <a
            href="search.php"
            class="icon-btn"
        >

            <i class="fa-solid fa-magnifying-glass"></i>

        </a>


        <a
            href="../wishlist/index.php"
            class="icon-btn"
        >

            <i class="fa-regular fa-heart"></i>

            <span class="wishlist-count">
                0
            </span>

        </a>


        <a
            href="../cart/index.php"
            class="icon-btn"
        >

            <i class="fa-solid fa-bag-shopping"></i>

            <span class="cart-count">
                0
            </span>

        </a>


        <a
            href="../auth/login.php"
            class="profile-btn"
        >

            <i class="fa-regular fa-user"></i>

        </a>

    </div>

</header>



<!-- =========================================
     FILTER PAGE
========================================= -->

<main class="filter-page">


    <!-- PAGE HEADER -->

    <section class="filter-header">

        <div>

            <p class="section-tag">

                DISCOVER YOUR STYLE

            </p>


            <h1>

                FIND YOUR

                <span>PERFECT FIT.</span>

            </h1>

        </div>


        <a
            href="index.php"
            class="back-shop"
        >

            ← BACK TO SHOP

        </a>

    </section>



    <!-- =====================================
         FILTER LAYOUT
    ====================================== -->

    <section class="filter-layout">


        <!-- FILTER SIDEBAR -->

        <aside class="filter-sidebar">


            <div class="filter-sidebar-header">

                <h2>

                    FILTERS

                </h2>


                <a href="filter.php">

                    CLEAR ALL

                </a>

            </div>



            <!-- FILTER FORM -->

            <form
                method="GET"
                action="filter.php"
                id="filterForm"
            >


                <!-- CATEGORY -->

                <div class="filter-group">

                    <h3>

                        CATEGORY

                    </h3>


                    <label>

                        <input
                            type="radio"
                            name="category"
                            value=""
                            <?php
                            echo $category === ""
                                ? "checked"
                                : "";
                            ?>
                        >

                        ALL PRODUCTS

                    </label>


                    <label>

                        <input
                            type="radio"
                            name="category"
                            value="Clothing"
                            <?php
                            echo strtolower($category) === "clothing"
                                ? "checked"
                                : "";
                            ?>
                        >

                        CLOTHING

                    </label>


                    <label>

                        <input
                            type="radio"
                            name="category"
                            value="Shoes"
                            <?php
                            echo strtolower($category) === "shoes"
                                ? "checked"
                                : "";
                            ?>
                        >

                        SHOES

                    </label>


                    <label>

                        <input
                            type="radio"
                            name="category"
                            value="Watches"
                            <?php
                            echo strtolower($category) === "watches"
                                ? "checked"
                                : "";
                            ?>
                        >

                        WATCHES

                    </label>


                    <label>

                        <input
                            type="radio"
                            name="category"
                            value="Spectacles"
                            <?php
                            echo strtolower($category) === "spectacles"
                                ? "checked"
                                : "";
                            ?>
                        >

                        SPECTACLES

                    </label>


                    <label>

                        <input
                            type="radio"
                            name="category"
                            value="Accessories"
                            <?php
                            echo strtolower($category) === "accessories"
                                ? "checked"
                                : "";
                            ?>
                        >

                        ACCESSORIES

                    </label>

                </div>



                <!-- PRICE RANGE -->

                <div class="filter-group">

                    <h3>

                        PRICE RANGE

                    </h3>


                    <div class="price-inputs">

                        <div>

                            <span>
                                MIN ₹
                            </span>

                            <input
                                type="number"
                                name="min_price"
                                min="0"
                                value="<?php
                                echo $minPrice;
                                ?>"
                            >

                        </div>


                        <div>

                            <span>
                                MAX ₹
                            </span>

                            <input
                                type="number"
                                name="max_price"
                                min="0"
                                value="<?php
                                echo $maxPrice;
                                ?>"
                            >

                        </div>

                    </div>

                </div>



                <!-- BADGE -->

                <div class="filter-group">

                    <h3>

                        COLLECTION

                    </h3>


                    <select name="badge">

                        <option value="">

                            ALL COLLECTIONS

                        </option>


                        <option
                            value="NEW"
                            <?php
                            echo strtoupper($badge) === "NEW"
                                ? "selected"
                                : "";
                            ?>
                        >

                            NEW

                        </option>


                        <option
                            value="TRENDING"
                            <?php
                            echo strtoupper($badge) === "TRENDING"
                                ? "selected"
                                : "";
                            ?>
                        >

                            TRENDING

                        </option>


                        <option
                            value="POPULAR"
                            <?php
                            echo strtoupper($badge) === "POPULAR"
                                ? "selected"
                                : "";
                            ?>
                        >

                            POPULAR

                        </option>


                        <option
                            value="BESTSELLER"
                            <?php
                            echo strtoupper($badge) === "BESTSELLER"
                                ? "selected"
                                : "";
                            ?>
                        >

                            BESTSELLER

                        </option>


                        <option
                            value="LIMITED"
                            <?php
                            echo strtoupper($badge) === "LIMITED"
                                ? "selected"
                                : "";
                            ?>
                        >

                            LIMITED

                        </option>

                    </select>

                </div>



                <!-- SORT -->

                <div class="filter-group">

                    <h3>

                        SORT BY

                    </h3>


                    <select name="sort">

                        <option value="">

                            DEFAULT

                        </option>


                        <option
                            value="price_low"
                            <?php
                            echo $sort === "price_low"
                                ? "selected"
                                : "";
                            ?>
                        >

                            PRICE: LOW TO HIGH

                        </option>


                        <option
                            value="price_high"
                            <?php
                            echo $sort === "price_high"
                                ? "selected"
                                : "";
                            ?>
                        >

                            PRICE: HIGH TO LOW

                        </option>


                        <option
                            value="name_az"
                            <?php
                            echo $sort === "name_az"
                                ? "selected"
                                : "";
                            ?>
                        >

                            NAME: A TO Z

                        </option>

                    </select>

                </div>



                <!-- APPLY BUTTON -->

                <button
                    type="submit"
                    class="apply-filter"
                >

                    APPLY FILTERS

                    <i class="fa-solid fa-sliders"></i>

                </button>


            </form>


        </aside>



        <!-- =====================================
             PRODUCTS
        ====================================== -->

        <section class="filtered-products-section">


            <div class="filtered-products-header">


                <div>

                    <p class="section-tag">

                        SSISS STORE

                    </p>


                    <h2>

                        <?php
                        echo count($filteredProducts);
                        ?>

                        PRODUCT<?php
                        echo count($filteredProducts) !== 1
                            ? "S"
                            : "";
                        ?>

                        FOUND

                    </h2>

                </div>


            </div>



            <!-- PRODUCTS GRID -->

            <?php if (count($filteredProducts) > 0): ?>


                <div class="filtered-products-grid">


                    <?php
                    foreach (
                        $filteredProducts as $product
                    ):
                    ?>


                        <article class="filter-product-card">


                            <a
                                href="product.php?id=<?php
                                echo $product["id"];
                                ?>"
                                class="filter-product-image"
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


                                <span class="filter-badge">

                                    <?php
                                    echo htmlspecialchars(
                                        $product["badge"]
                                    );
                                    ?>

                                </span>

                            </a>



                            <div class="filter-product-info">


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

                                    <h3>

                                        <?php
                                        echo htmlspecialchars(
                                            $product["name"]
                                        );
                                        ?>

                                    </h3>

                                </a>


                                <div class="filter-product-bottom">


                                    <strong>

                                        ₹<?php
                                        echo number_format(
                                            $product["price"]
                                        );
                                        ?>

                                    </strong>


                                    <a
                                        href="product.php?id=<?php
                                        echo $product["id"];
                                        ?>"
                                        class="view-product"
                                    >

                                        VIEW

                                    </a>

                                </div>


                            </div>


                        </article>


                    <?php endforeach; ?>


                </div>


            <?php else: ?>


                <!-- EMPTY STATE -->

                <div class="filter-empty">


                    <i class="fa-solid fa-box-open"></i>


                    <h2>

                        NO PRODUCTS FOUND

                    </h2>


                    <p>

                        Try changing your filters
                        to discover more products.

                    </p>


                    <a
                        href="filter.php"
                        class="reset-filters"
                    >

                        RESET FILTERS

                    </a>


                </div>


            <?php endif; ?>


        </section>


    </section>


</main>


<!-- JS -->

<script src="../assets/js/filter.js"></script>


</body>

</html>
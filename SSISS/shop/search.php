<?php

$pageTitle = "Search | SSISS";


/* =========================================
   GET SEARCH QUERY
========================================= */

$query = isset($_GET["q"])
    ? trim($_GET["q"])
    : "";


/* =========================================
   TEMPORARY PRODUCT DATA

   Later replace this with MySQL query.
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
   SEARCH PRODUCTS
========================================= */

$results = [];


if ($query !== "") {

    foreach ($products as $product) {

        $searchText =
            strtolower(
                $product["name"] . " " .
                $product["category"]
            );


        if (
            strpos(
                $searchText,
                strtolower($query)
            ) !== false
        ) {

            $results[] = $product;

        }

    }

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo htmlspecialchars($pageTitle); ?>
    </title>


    <!-- Fonts -->

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>


    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;1,500;1,600&display=swap"
        rel="stylesheet"
    >


    <!-- Font Awesome -->

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
        href="../assets/css/search.css"
    >

</head>


<body>


<!-- =========================================
     NAVBAR
========================================= -->

<header class="navbar">

    <a href="../index.php"
       class="logo">

        SSI<span>SS</span>

    </a>


    <nav class="nav-links">

        <a href="../index.php">
            Home
        </a>

        <a href="index.php">
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


        <a href="search.php"
           class="icon-btn">

            <i class="fa-solid fa-magnifying-glass"></i>

        </a>


        <a href="../wishlist/index.php"
           class="icon-btn">

            <i class="fa-regular fa-heart"></i>

            <span class="wishlist-count">
                0
            </span>

        </a>


        <a href="../cart/index.php"
           class="icon-btn">

            <i class="fa-solid fa-bag-shopping"></i>

            <span class="cart-count">
                0
            </span>

        </a>


        <a href="../auth/login.php"
           class="profile-btn">

            <i class="fa-regular fa-user"></i>

        </a>

    </div>

</header>



<!-- =========================================
     SEARCH PAGE
========================================= -->

<main class="search-page">


    <section class="search-header">


        <p class="section-tag">

            DISCOVER YOUR STYLE

        </p>


        <h1>

            SEARCH THE

            <span>STORE.</span>

        </h1>


        <!-- SEARCH FORM -->

        <form
            class="search-form"
            method="GET"
            action="search.php"
        >

            <i class="fa-solid fa-magnifying-glass"></i>


            <input
                type="text"
                name="q"
                placeholder="SEARCH CLOTHES, SHOES, WATCHES..."
                value="<?php echo htmlspecialchars($query); ?>"
                autofocus
            >


            <button type="submit">

                SEARCH

            </button>

        </form>


        <!-- QUICK SEARCH -->

        <div class="quick-search">

            <span>
                POPULAR:
            </span>


            <a href="search.php?q=clothing">
                CLOTHING
            </a>


            <a href="search.php?q=shoes">
                SHOES
            </a>


            <a href="search.php?q=watches">
                WATCHES
            </a>


            <a href="search.php?q=accessories">
                ACCESSORIES
            </a>

        </div>


    </section>



    <!-- =========================================
         SEARCH RESULTS
    ========================================= -->

    <?php if ($query !== ""): ?>


        <section class="search-results">


            <div class="results-header">

                <div>

                    <p class="section-tag">

                        SEARCH RESULTS

                    </p>


                    <h2>

                        <?php echo count($results); ?>

                        RESULT<?php
                        echo count($results) !== 1
                            ? "S"
                            : "";
                        ?>

                        FOR

                        <span>

                            "<?php
                            echo htmlspecialchars($query);
                            ?>"

                        </span>

                    </h2>

                </div>


                <a href="index.php"
                   class="back-shop">

                    ← BACK TO SHOP

                </a>

            </div>



            <!-- PRODUCT GRID -->

            <?php if (count($results) > 0): ?>


                <div class="search-products">


                    <?php
                    foreach ($results as $product):
                    ?>


                        <article class="search-product">


                            <a
                                href="product.php?id=<?php
                                echo $product["id"];
                                ?>"
                                class="search-product-image"
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


                                <span class="product-badge">

                                    <?php
                                    echo htmlspecialchars(
                                        $product["badge"]
                                    );
                                    ?>

                                </span>

                            </a>



                            <div class="search-product-info">


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


                                <div class="search-product-bottom">


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

                <div class="search-empty">

                    <i class="fa-solid fa-magnifying-glass"></i>


                    <h2>

                        NOTHING FOUND

                    </h2>


                    <p>

                        We couldn't find products matching

                        <strong>
                            "<?php
                            echo htmlspecialchars(
                                $query
                            );
                            ?>"
                        </strong>

                    </p>


                    <a
                        href="index.php"
                        class="back-shop-button"
                    >

                        EXPLORE SHOP

                    </a>

                </div>


            <?php endif; ?>


        </section>


    <?php endif; ?>


</main>



<script src="../assets/js/search.js"></script>

</body>

</html>
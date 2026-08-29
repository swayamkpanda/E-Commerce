<?php
$pageTitle = "Shop | SSISS";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title><?php echo $pageTitle; ?></title>


    <!-- Google Fonts -->

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>


    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;1,500;1,600&display=swap"
          rel="stylesheet">


    <!-- Font Awesome -->

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">


    <!-- CSS -->

    <link rel="stylesheet"
          href="../assets/css/home.css">

    <link rel="stylesheet"
          href="../assets/css/shop.css">

</head>


<body>


<!-- =========================
     NAVBAR
========================= -->

<header class="navbar">

    <a href="../index.php"
       class="logo">

        SSI<span>SS</span>

    </a>


    <nav class="nav-links">

        <a href="../index.php">Home</a>

        <a href="index.php"
           class="nav-active">

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


        <button class="icon-btn"
                id="searchButton">

            <i class="fa-solid fa-magnifying-glass"></i>

        </button>


        <a href="../rewards/wallet.php"
           class="coin-btn">

            🪙

            <span>0</span>

        </a>


        <a href="../wishlist/index.php"
           class="icon-btn">

            <i class="fa-regular fa-heart"></i>

            <span class="wishlist-count">
                0
            </span>

        </a>


        <a href="../cart/index.php"
           class="icon-btn cart-icon">

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



<!-- =========================
     SHOP HERO
========================= -->

<section class="shop-hero">


    <div class="shop-hero-content">

        <p class="section-tag">

            CURATED FOR YOUR VIBE

        </p>


        <h1>

            FIND YOUR

            <span>FIT.</span>

        </h1>


        <p>

            Discover clothing, watches, shoes and accessories
            curated for every style, mood and budget.

        </p>


    </div>


    <div class="shop-hero-side">

        <span>01 — 04</span>

        <p>
            WEAR WHAT
            FEELS LIKE YOU.
        </p>

    </div>


</section>



<!-- =========================
     CATEGORY BAR
========================= -->

<section class="category-section">

    <div class="category-list">

        <button class="category-btn active"
                data-category="all">

            ALL

        </button>


        <button class="category-btn"
                data-category="clothing">

            CLOTHING

        </button>


        <button class="category-btn"
                data-category="shoes">

            SHOES

        </button>


        <button class="category-btn"
                data-category="watches">

            WATCHES

        </button>


        <button class="category-btn"
                data-category="spectacles">

            SPECTACLES

        </button>


        <button class="category-btn"
                data-category="accessories">

            ACCESSORIES

        </button>

    </div>


</section>



<!-- =========================
     SHOP TOOLBAR
========================= -->

<section class="shop-toolbar">


    <div class="product-count">

        <span id="productCount">

            0

        </span>

        PRODUCTS

    </div>


    <div class="shop-tools">


        <select id="sortProducts">

            <option value="default">
                SORT BY
            </option>

            <option value="low">
                PRICE: LOW TO HIGH
            </option>

            <option value="high">
                PRICE: HIGH TO LOW
            </option>

            <option value="name">
                NAME
            </option>

        </select>


        <a href="filters.php" class="filter-button">

            <i class="fa-solid fa-sliders"></i>

            FILTERS

</a>


    </div>


</section>



<!-- =========================
     PRODUCTS
========================= -->

<section class="shop-products"
         id="shopProducts">


    <!-- PRODUCTS WILL BE INSERTED BY JAVASCRIPT -->


</section>



<!-- =========================
     EMPTY STATE
========================= -->

<section class="shop-empty"
         id="shopEmpty">

    <i class="fa-solid fa-shirt"></i>

    <h2>
        NO PRODUCTS FOUND
    </h2>

    <p>
        Try selecting another category.
    </p>

</section>



<!-- =========================
     NEWSLETTER
========================= -->

<section class="shop-newsletter">

    <p class="section-tag">

        STAY IN THE LOOP

    </p>


    <h2>

        YOUR VIBE IS

        <span>EVOLVING.</span>

    </h2>


    <p>

        Get style drops, AI fashion insights
        and SSISS updates.

    </p>


    <form class="newsletter-form">

        <input
            type="email"
            placeholder="YOUR EMAIL ADDRESS"
            required
        >

        <button type="submit">

            JOIN SSISS

            <i class="fa-solid fa-arrow-right"></i>

        </button>

    </form>


</section>



<!-- =========================
     TOAST
========================= -->

<div class="toast"
     id="toast">

    <i class="fa-solid fa-check"></i>

    <span id="toastMessage">

        Updated successfully

    </span>

</div>



<script src="../assets/js/shop.js"></script>

</body>

</html>
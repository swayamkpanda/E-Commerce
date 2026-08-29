<?php

$pageTitle = "Product Details | SSISS";


/* =========================================
   GET PRODUCT ID
========================================= */

$productId = isset($_GET["id"])
    ? (int) $_GET["id"]
    : 1;


/* =========================================
   TEMPORARY PRODUCT DATA

   Later this will come from MySQL.
========================================= */

$products = [

    1 => [
        "id" => 1,
        "name" => "Oversized Essential Tee",
        "category" => "Clothing",
        "price" => 799,
        "badge" => "NEW",
        "description" =>
            "A premium oversized essential tee designed for everyday comfort. Minimal, versatile and perfect for building your streetwear look.",
        "image" =>
            "https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=1000&q=80",
        "sizes" => ["S", "M", "L", "XL"],
        "colors" => ["Black", "White", "Grey"]
    ],

    2 => [
        "id" => 2,
        "name" => "Classic Leather Sneakers",
        "category" => "Shoes",
        "price" => 2999,
        "badge" => "TRENDING",
        "description" =>
            "Clean and versatile sneakers built to match almost every outfit. A modern classic for your everyday wardrobe.",
        "image" =>
            "https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=1000&q=80",
        "sizes" => ["7", "8", "9", "10"],
        "colors" => ["Red", "Black", "White"]
    ],

    3 => [
        "id" => 3,
        "name" => "Minimal Steel Watch",
        "category" => "Watches",
        "price" => 3499,
        "badge" => "POPULAR",
        "description" =>
            "A sleek steel watch with a minimal design that works perfectly with casual and formal outfits.",
        "image" =>
            "https://images.unsplash.com/photo-1524805444758-089113d48a6d?auto=format&fit=crop&w=1000&q=80",
        "sizes" => [],
        "colors" => ["Silver", "Black"]
    ],

    4 => [
        "id" => 4,
        "name" => "Retro Square Sunglasses",
        "category" => "Spectacles",
        "price" => 1299,
        "badge" => "NEW",
        "description" =>
            "Retro-inspired square sunglasses that instantly add personality and confidence to your look.",
        "image" =>
            "https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=1000&q=80",
        "sizes" => [],
        "colors" => ["Black", "Brown"]
    ],

    5 => [
        "id" => 5,
        "name" => "Urban Cargo Pants",
        "category" => "Clothing",
        "price" => 1899,
        "badge" => "STREET",
        "description" =>
            "Relaxed cargo pants designed for movement, comfort and modern streetwear styling.",
        "image" =>
            "https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=1000&q=80",
        "sizes" => ["S", "M", "L", "XL"],
        "colors" => ["Black", "Olive", "Beige"]
    ],

    6 => [
        "id" => 6,
        "name" => "Premium Canvas Shoes",
        "category" => "Shoes",
        "price" => 2299,
        "badge" => "BESTSELLER",
        "description" =>
            "Comfortable premium canvas shoes made for everyday movement and effortless casual styling.",
        "image" =>
            "https://images.unsplash.com/photo-1543508282-6319a3e2621f?auto=format&fit=crop&w=1000&q=80",
        "sizes" => ["7", "8", "9", "10"],
        "colors" => ["White", "Black"]
    ],

    7 => [
        "id" => 7,
        "name" => "Classic Silver Watch",
        "category" => "Watches",
        "price" => 4199,
        "badge" => "LIMITED",
        "description" =>
            "A refined silver watch with timeless styling for people who prefer understated luxury.",
        "image" =>
            "https://images.unsplash.com/photo-1508057198894-247b23fe5ade?auto=format&fit=crop&w=1000&q=80",
        "sizes" => [],
        "colors" => ["Silver"]
    ],

    8 => [
        "id" => 8,
        "name" => "Minimal Crossbody Bag",
        "category" => "Accessories",
        "price" => 1599,
        "badge" => "NEW",
        "description" =>
            "A clean and functional crossbody bag designed to carry your essentials without compromising your style.",
        "image" =>
            "https://images.unsplash.com/photo-1553062407-98eeb64c6a62?auto=format&fit=crop&w=1000&q=80",
        "sizes" => [],
        "colors" => ["Black", "Brown"]
    ]

];


/* =========================================
   CHECK PRODUCT EXISTS
========================================= */

if (!isset($products[$productId])) {

    header("Location: index.php");

    exit;

}


$product = $products[$productId];

$pageTitle = $product["name"] . " | SSISS";

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


    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;1,500;1,600&display=swap"
          rel="stylesheet">


    <!-- Font Awesome -->

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">


    <!-- CSS -->

    <link rel="stylesheet"
          href="../assets/css/home.css">

    <link rel="stylesheet"
          href="../assets/css/product.css">

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



<!-- =========================================
     PRODUCT PAGE
========================================= -->

<main class="product-page">


    <!-- Breadcrumb -->

    <div class="breadcrumb">

        <a href="../index.php">
            HOME
        </a>

        <span>/</span>

        <a href="index.php">
            SHOP
        </a>

        <span>/</span>

        <span>
            <?php echo strtoupper(
                htmlspecialchars($product["name"])
            ); ?>
        </span>

    </div>



    <!-- Product Details -->

    <section class="product-details">


        <!-- PRODUCT IMAGE -->

        <div class="product-gallery">

            <div class="main-product-image">

                <span class="detail-badge">

                    <?php echo htmlspecialchars(
                        $product["badge"]
                    ); ?>

                </span>


                <img
                    src="<?php echo htmlspecialchars(
                        $product["image"]
                    ); ?>"

                    alt="<?php echo htmlspecialchars(
                        $product["name"]
                    ); ?>"
                >

            </div>


            <!-- Thumbnail placeholders -->

            <div class="product-thumbnails">

                <button class="thumbnail active">

                    <img
                        src="<?php echo htmlspecialchars(
                            $product["image"]
                        ); ?>"

                        alt="Product view"
                    >

                </button>


                <button class="thumbnail">

                    <img
                        src="<?php echo htmlspecialchars(
                            $product["image"]
                        ); ?>"

                        alt="Product view"
                    >

                </button>


                <button class="thumbnail">

                    <img
                        src="<?php echo htmlspecialchars(
                            $product["image"]
                        ); ?>"

                        alt="Product view"
                    >

                </button>

            </div>

        </div>



        <!-- PRODUCT INFORMATION -->

        <div class="product-information">


            <p class="product-detail-category">

                <?php echo strtoupper(
                    htmlspecialchars(
                        $product["category"]
                    )
                ); ?>

            </p>


            <h1>

                <?php echo htmlspecialchars(
                    $product["name"]
                ); ?>

            </h1>


            <!-- Rating -->

            <div class="product-rating">

                <div class="stars">

                    ★ ★ ★ ★ ★

                </div>

                <span>

                    4.8

                </span>

                <span class="reviews">

                    (124 REVIEWS)

                </span>

            </div>


            <!-- Price -->

            <div class="detail-price">

                ₹<?php echo number_format(
                    $product["price"]
                ); ?>

            </div>


            <!-- Description -->

            <p class="product-description">

                <?php echo htmlspecialchars(
                    $product["description"]
                ); ?>

            </p>


            <!-- AI MATCH -->

            <div class="ai-style-match">

                <div class="ai-match-icon">

                    ✨

                </div>


                <div>

                    <small>
                        SSISS AI STYLE MATCH
                    </small>

                    <strong>
                        94% MATCH FOR YOUR VIBE
                    </strong>

                </div>


                <a href="../ai/stylist.php">

                    ASK AI

                    <i class="fa-solid fa-arrow-right"></i>

                </a>

            </div>



            <!-- COLORS -->

            <?php if (!empty($product["colors"])): ?>

                <div class="product-option">

                    <div class="option-header">

                        <span>
                            COLOR
                        </span>

                        <strong id="selectedColor">

                            <?php echo htmlspecialchars(
                                $product["colors"][0]
                            ); ?>

                        </strong>

                    </div>


                    <div class="color-options">

                        <?php
                        foreach ($product["colors"] as $index => $color):
                        ?>

                            <button

                                class="color-btn <?php
                                echo $index === 0
                                    ? "active"
                                    : "";
                                ?>"

                                data-color="<?php
                                echo htmlspecialchars($color);
                                ?>"

                            >

                                <?php echo htmlspecialchars(
                                    strtoupper($color)
                                ); ?>

                            </button>

                        <?php endforeach; ?>

                    </div>

                </div>

            <?php endif; ?>



            <!-- SIZES -->

            <?php if (!empty($product["sizes"])): ?>

                <div class="product-option">

                    <div class="option-header">

                        <span>
                            SIZE
                        </span>

                        <strong id="selectedSize">

                            SELECT SIZE

                        </strong>

                    </div>


                    <div class="size-options">

                        <?php foreach ($product["sizes"] as $size): ?>

                            <button

                                class="size-btn"

                                data-size="<?php
                                echo htmlspecialchars($size);
                                ?>"

                            >

                                <?php echo htmlspecialchars(
                                    $size
                                ); ?>

                            </button>

                        <?php endforeach; ?>

                    </div>

                </div>

            <?php endif; ?>



            <!-- Quantity -->

            <div class="product-option quantity-section">

                <div class="option-header">

                    <span>
                        QUANTITY
                    </span>

                </div>


                <div class="quantity-selector">

                    <button id="decreaseQuantity">

                        −

                    </button>


                    <span id="productQuantity">

                        1

                    </span>


                    <button id="increaseQuantity">

                        +

                    </button>

                </div>

            </div>



            <!-- ACTION BUTTONS -->

            <div class="product-actions">

                <button

                    class="detail-add-cart"

                    data-id="<?php
                    echo $product["id"];
                    ?>"

                >

                    ADD TO BAG

                    <i class="fa-solid fa-bag-shopping"></i>

                </button>


                <button

                    class="detail-wishlist"

                    data-id="<?php
                    echo $product["id"];
                    ?>"

                    title="Add to Wishlist"

                >

                    <i class="fa-regular fa-heart"></i>

                </button>

            </div>



            <!-- Product Features -->

            <div class="product-features">

                <div>

                    <i class="fa-solid fa-truck-fast"></i>

                    <span>
                        Fast Delivery
                    </span>

                </div>


                <div>

                    <i class="fa-solid fa-arrow-rotate-left"></i>

                    <span>
                        Easy Returns
                    </span>

                </div>


                <div>

                    <i class="fa-solid fa-shield-halved"></i>

                    <span>
                        Secure Shopping
                    </span>

                </div>

            </div>


        </div>

    </section>



    <!-- PRODUCT DETAILS -->

    <section class="details-tabs">

        <div class="tabs-header">

            <button class="tab-btn active"
                    data-tab="description">

                DESCRIPTION

            </button>


            <button class="tab-btn"
                    data-tab="details">

                DETAILS

            </button>


            <button class="tab-btn"
                    data-tab="shipping">

                SHIPPING

            </button>

        </div>


        <div class="tab-content active"
             id="description">

            <p>

                <?php echo htmlspecialchars(
                    $product["description"]
                ); ?>

            </p>

        </div>


        <div class="tab-content"
             id="details">

            <ul>

                <li>
                    Premium quality materials
                </li>

                <li>
                    Designed for everyday comfort
                </li>

                <li>
                    Curated for modern fashion
                </li>

                <li>
                    SSISS quality checked
                </li>

            </ul>

        </div>


        <div class="tab-content"
             id="shipping">

            <p>

                Orders are usually processed within
                1–2 business days. Delivery time may
                vary depending on your location.

            </p>

        </div>

    </section>



    <!-- COMPLETE THE LOOK -->

    <section class="complete-look">

        <div class="complete-look-header">

            <p class="section-tag">

                AI CURATED

            </p>


            <h2>

                COMPLETE THE

                <span>LOOK.</span>

            </h2>

        </div>


        <div class="complete-products">


            <article class="look-product">

                <div class="look-image">

                    <img
                        src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=600&q=80"
                        alt="Suggested product"
                    >

                </div>


                <h3>
                    Style Match
                </h3>

                <span>
                    AI Recommended
                </span>

            </article>


            <article class="look-product">

                <div class="look-image">

                    <img
                        src="https://images.unsplash.com/photo-1524805444758-089113d48a6d?auto=format&fit=crop&w=600&q=80"
                        alt="Suggested product"
                    >

                </div>


                <h3>
                    Perfect Accessory
                </h3>

                <span>
                    Complete Your Vibe
                </span>

            </article>


            <article class="look-product">

                <div class="look-image">

                    <img
                        src="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?auto=format&fit=crop&w=600&q=80"
                        alt="Suggested product"
                    >

                </div>


                <h3>
                    Everyday Essential
                </h3>

                <span>
                    Trending Now
                </span>

            </article>


        </div>

    </section>


</main>



<!-- =========================================
     TOAST
========================================= -->

<div class="toast"
     id="toast">

    <i class="fa-solid fa-check"></i>

    <span id="toastMessage">

        Updated successfully

    </span>

</div>


<script>

    const currentProduct = <?php echo json_encode(
        $product
    ); ?>;

</script>


<script src="../assets/js/product.js"></script>

</body>

</html>
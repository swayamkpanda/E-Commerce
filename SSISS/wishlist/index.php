<?php
$pageTitle = "My Wishlist | SSISS";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $pageTitle; ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;1,500;1,600&display=swap"
          rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet"
          href="../assets/css/home.css">

    <!-- Wishlist CSS -->
    <link rel="stylesheet"
          href="../assets/css/wishlist.css">

</head>

<body>


<!-- =========================
     NAVBAR
========================= -->

<header class="navbar">

    <a href="../index.php" class="logo">
        SSI<span>SS</span>
    </a>


    <nav class="nav-links">

        <a href="../index.php">Home</a>

        <a href="../shop/index.php">Shop</a>

        <a href="../ai/index.php">
            AI Stylist
            <span class="sparkle">✦</span>
        </a>

        <a href="../ai/vibe.php">Vibes</a>

        <a href="../marketplace/index.php">Pre-Loved</a>

        <a href="../impact/index.php">Impact</a>

    </nav>


    <div class="nav-actions">

        <a href="../rewards/wallet.php"
           class="coin-btn">

            🪙
            <span>0</span>

        </a>


        <a href="index.php"
           class="icon-btn active-icon">

            <i class="fa-solid fa-heart"></i>

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
     WISHLIST
========================= -->

<main class="wishlist-page">


    <!-- Header -->

    <section class="wishlist-header">

        <p class="section-tag">
            YOUR PERSONAL COLLECTION
        </p>


        <h1>
            MY <span>WISHLIST.</span>
        </h1>


        <p>
            Save the pieces you love and come back
            whenever you're ready.
        </p>

    </section>



    <!-- Wishlist Controls -->

    <section class="wishlist-controls">

        <div>

            <span id="wishlistItemCount">
                0
            </span>

            ITEMS SAVED

        </div>


        <button id="clearWishlist"
                class="clear-btn">

            <i class="fa-regular fa-trash-can"></i>

            CLEAR ALL

        </button>

    </section>



    <!-- Wishlist Products -->

    <section class="wishlist-products"
             id="wishlistProducts">

        <!-- JavaScript will insert products here -->

    </section>



    <!-- Empty Wishlist -->

    <section class="empty-wishlist"
             id="emptyWishlist">

        <div class="empty-heart">

            <i class="fa-regular fa-heart"></i>

        </div>


        <p class="section-tag">
            NOTHING SAVED YET
        </p>


        <h2>
            YOUR WISHLIST IS
            <span>WAITING.</span>
        </h2>


        <p>
            Explore SSISS and save the pieces
            that match your vibe.
        </p>


        <a href="../shop/index.php"
           class="shop-btn">

            EXPLORE SHOP

            <i class="fa-solid fa-arrow-right"></i>

        </a>

    </section>


</main>



<!-- =========================
     TOAST
========================= -->

<div class="toast"
     id="toast">

    <i class="fa-solid fa-check"></i>

    <span id="toastMessage">
        Product updated
    </span>

</div>



<!-- JavaScript -->

<script src="../assets/js/wishlist.js"></script>

</body>

</html>
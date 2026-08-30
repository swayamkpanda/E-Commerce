<?php

$pageTitle = "Sell Your Clothes | SSISS";


/* =========================================
   TEMPORARY SELLER STATISTICS
   Later replace with MySQL queries
========================================= */

$sellerStats = [

    "itemsSold" => 12,

    "activeListings" => 3,

    "totalEarnings" => 8450,

    "averageRating" => "4.8"

];

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
     SELL PAGE
========================================= -->

<main class="marketplace-sell-page">


    <!-- BACK BUTTON -->

    <a
        href="index.php"
        class="marketplace-back-btn"
    >

        <i class="fa-solid fa-arrow-left"></i>

        BACK TO MARKETPLACE

    </a>



    <!-- =====================================
         HERO
    ====================================== -->

    <section class="marketplace-sell-hero">


        <div class="marketplace-sell-hero-content">


            <p class="section-tag">

                SELL PRE-LOVED FASHION

            </p>


            <h1>

                TURN YOUR CLOTHES

                <span>INTO VALUE.</span>

            </h1>


            <p>

                Give clothes you no longer wear a second
                life. List them on SSISS and connect with
                people who will love them next.

            </p>


            <div class="marketplace-sell-actions">


                <a
                    href="create-listing.php"
                    class="marketplace-primary-btn"
                >

                    <i class="fa-solid fa-plus"></i>

                    CREATE A LISTING

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



        <!-- HERO VISUAL -->

        <div class="marketplace-sell-visual">


            <div class="marketplace-sell-main-icon">

                <i class="fa-solid fa-shirt"></i>

            </div>


            <div class="marketplace-sell-floating-card card-one">


                <i class="fa-solid fa-indian-rupee-sign"></i>

                <span>

                    EARN FROM YOUR CLOTHES

                </span>


            </div>


            <div class="marketplace-sell-floating-card card-two">


                <i class="fa-solid fa-recycle"></i>

                <span>

                    GIVE THEM A SECOND LIFE

                </span>


            </div>


        </div>


    </section>



    <!-- =====================================
         SELLER STATS
    ====================================== -->

    <section class="marketplace-seller-stats-grid">


        <article class="marketplace-seller-stat-card">


            <div class="marketplace-stat-icon">


                <i class="fa-solid fa-circle-check"></i>


            </div>


            <div>


                <span>

                    ITEMS SOLD

                </span>


                <strong>


                    <?php
                    echo $sellerStats["itemsSold"];
                    ?>


                </strong>


            </div>


        </article>



        <article class="marketplace-seller-stat-card">


            <div class="marketplace-stat-icon">


                <i class="fa-solid fa-list"></i>


            </div>


            <div>


                <span>

                    ACTIVE LISTINGS

                </span>


                <strong>


                    <?php
                    echo $sellerStats["activeListings"];
                    ?>


                </strong>


            </div>


        </article>



        <article class="marketplace-seller-stat-card">


            <div class="marketplace-stat-icon">


                <i class="fa-solid fa-wallet"></i>


            </div>


            <div>


                <span>

                    TOTAL EARNINGS

                </span>


                <strong>


                    ₹<?php
                    echo number_format(
                        $sellerStats["totalEarnings"]
                    );
                    ?>


                </strong>


            </div>


        </article>



        <article class="marketplace-seller-stat-card">


            <div class="marketplace-stat-icon">


                <i class="fa-solid fa-star"></i>


            </div>


            <div>


                <span>

                    SELLER RATING

                </span>


                <strong>


                    <?php
                    echo htmlspecialchars(
                        $sellerStats["averageRating"]
                    );
                    ?>


                </strong>


            </div>


        </article>


    </section>



    <!-- =====================================
         HOW IT WORKS
    ====================================== -->

    <section class="marketplace-sell-section">


        <div class="marketplace-section-heading">


            <div>


                <p class="section-tag">

                    SIMPLE SELLING PROCESS

                </p>


                <h2>

                    HOW TO

                    <span>SELL.</span>

                </h2>


            </div>


        </div>



        <div class="marketplace-steps-grid">


            <!-- STEP 1 -->

            <article class="marketplace-step-card">


                <div class="marketplace-step-number">

                    01

                </div>


                <div class="marketplace-step-icon">

                    <i class="fa-solid fa-camera"></i>

                </div>


                <h3>

                    ADD YOUR ITEM

                </h3>


                <p>

                    Upload clear photos and provide details
                    about your clothing item.

                </p>


            </article>



            <!-- STEP 2 -->

            <article class="marketplace-step-card">


                <div class="marketplace-step-number">

                    02

                </div>


                <div class="marketplace-step-icon">

                    <i class="fa-solid fa-tags"></i>

                </div>


                <h3>

                    SET YOUR PRICE

                </h3>


                <p>

                    Choose a fair price based on the
                    item's condition and original value.

                </p>


            </article>



            <!-- STEP 3 -->

            <article class="marketplace-step-card">


                <div class="marketplace-step-number">

                    03

                </div>


                <div class="marketplace-step-icon">

                    <i class="fa-solid fa-eye"></i>

                </div>


                <h3>

                    GET DISCOVERED

                </h3>


                <p>

                    Your listing becomes visible to people
                    browsing the pre-loved marketplace.

                </p>


            </article>



            <!-- STEP 4 -->

            <article class="marketplace-step-card">


                <div class="marketplace-step-number">

                    04

                </div>


                <div class="marketplace-step-icon">

                    <i class="fa-solid fa-handshake"></i>

                </div>


                <h3>

                    COMPLETE THE SALE

                </h3>


                <p>

                    Once sold, update your listing and
                    track your selling activity.

                </p>


            </article>


        </div>


    </section>



    <!-- =====================================
         SELLING GUIDELINES
    ====================================== -->

    <section class="marketplace-guidelines-section">


        <div class="marketplace-guidelines-content">


            <p class="section-tag">

                SELL RESPONSIBLY

            </p>


            <h2>

                WHAT MAKES A

                <span>GREAT LISTING?</span>

            </h2>


            <p>

                Honest and detailed listings help buyers
                make confident decisions and create a better
                marketplace experience for everyone.

            </p>


        </div>



        <div class="marketplace-guidelines-list">


            <div class="marketplace-guideline-item">


                <i class="fa-solid fa-circle-check"></i>


                <div>


                    <h3>

                        USE CLEAR PHOTOS

                    </h3>


                    <p>

                        Upload images that clearly show the
                        clothing item's colour and condition.

                    </p>


                </div>


            </div>



            <div class="marketplace-guideline-item">


                <i class="fa-solid fa-circle-check"></i>


                <div>


                    <h3>

                        DESCRIBE CONDITION HONESTLY

                    </h3>


                    <p>

                        Clearly mention any signs of wear,
                        damage, or imperfections.

                    </p>


                </div>


            </div>



            <div class="marketplace-guideline-item">


                <i class="fa-solid fa-circle-check"></i>


                <div>


                    <h3>

                        SET A FAIR PRICE

                    </h3>


                    <p>

                        Consider the original price, condition,
                        brand, and current demand.

                    </p>


                </div>


            </div>



            <div class="marketplace-guideline-item">


                <i class="fa-solid fa-circle-check"></i>


                <div>


                    <h3>

                        KEEP YOUR LISTING UPDATED

                    </h3>


                    <p>

                        Mark items as sold when they are no
                        longer available.

                    </p>


                </div>


            </div>


        </div>


    </section>



    <!-- =====================================
         CTA
    ====================================== -->

    <section class="marketplace-bottom-cta">


        <div>


            <p class="section-tag">

                READY TO START?

            </p>


            <h2>

                YOUR CLOTHES CAN

                <span>LIVE AGAIN.</span>

            </h2>


            <p>

                Create your first listing and help build
                a more sustainable fashion community.

            </p>


        </div>


        <a
            href="create-listing.php"
            class="marketplace-primary-btn"
        >

            CREATE LISTING

            <i class="fa-solid fa-arrow-right"></i>

        </a>


    </section>


</main>



<!-- PROJECT JAVASCRIPT -->

<script src="../assets/js/marketplace.js"></script>


</body>

</html>
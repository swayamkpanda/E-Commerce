<?php

$pageTitle = "SSISS Rewards | SSISS";


/* =========================================
   TEMPORARY USER REWARD DATA

   Later this will come from MySQL.
========================================= */

$userCoins = 250;

$totalDonations = 5;

$totalClothesDonated = 12;


/* =========================================
   RECENT ACTIVITY

   Later this will come from MySQL.
========================================= */

$recentActivity = [

    [
        "type" => "Clothes Donation",
        "description" => "You donated 3 clothing items",
        "coins" => 60,
        "date" => "15 March 2026"
    ],

    [
        "type" => "Donation Bonus",
        "description" => "Eco Impact Bonus",
        "coins" => 20,
        "date" => "01 March 2026"
    ],

    [
        "type" => "Reward Redeemed",
        "description" => "₹100 Shopping Discount",
        "coins" => -100,
        "date" => "25 February 2026"
    ]

];


/* =========================================
   FEATURED REWARDS

   Later this will come from MySQL.
========================================= */

$featuredRewards = [

    [
        "title" => "₹100 OFF",
        "description" =>
            "Get ₹100 off your next purchase.",
        "coins" => 100,
        "icon" => "fa-ticket"
    ],

    [
        "title" => "₹250 OFF",
        "description" =>
            "Save ₹250 on selected products.",
        "coins" => 250,
        "icon" => "fa-gift"
    ],

    [
        "title" => "15% OFF",
        "description" =>
            "Get 15% off your next SSISS order.",
        "coins" => 400,
        "icon" => "fa-percent"
    ]

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
        <?php echo htmlspecialchars($pageTitle); ?>
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


    <!-- CSS -->

    <link
        rel="stylesheet"
        href="../assets/css/home.css"
    >

    <link
        rel="stylesheet"
        href="../assets/css/reward.css"
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


        <a href="../ai/index.php">

            AI Stylist

            <span class="sparkle">
                ✦
            </span>

        </a>


        <a href="../wardrobe/index.php">
            Wardrobe
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
            href="../shop/search.php"
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
     REWARD PAGE
========================================= -->

<main class="reward-page">


    <!-- =====================================
         PAGE HEADER
    ====================================== -->

    <section class="reward-header">


        <p class="section-tag">

            DONATE • EARN • SAVE

        </p>


        <h1>

            YOUR SSISS

            <span>REWARDS.</span>

        </h1>


        <p>

            Turn your positive fashion choices
            into rewards. Donate clothes, reduce
            fashion waste, support NGOs, and earn
            SSISS Coins.

        </p>


    </section>



    <!-- =====================================
         COINS HERO CARD
    ====================================== -->

    <section class="coins-hero-card">


        <div class="coins-hero-content">


            <p class="coins-label">

                YOUR CURRENT BALANCE

            </p>


            <h2>

                <i class="fa-solid fa-coins"></i>

                <?php echo $userCoins; ?>

                <span>

                    SSISS COINS

                </span>

            </h2>


            <p class="coins-info">

                Use your SSISS Coins to unlock
                discounts and rewards while shopping.

            </p>


            <div class="coins-actions">


                <a
                    href="earn.php"
                    class="earn-coins-btn"
                >

                    <i class="fa-solid fa-plus"></i>

                    EARN COINS

                </a>


                <a
                    href="redeem.php"
                    class="redeem-coins-btn"
                >

                    <i class="fa-solid fa-gift"></i>

                    REDEEM COINS

                </a>


            </div>


        </div>


        <div class="coins-hero-visual">

            <div class="coin-circle coin-one">
                🪙
            </div>

            <div class="coin-circle coin-two">
                🪙
            </div>

            <div class="coin-circle coin-three">
                🪙
            </div>

        </div>


    </section>



    <!-- =====================================
         QUICK STATS
    ====================================== -->

    <section class="reward-stats">


        <article class="reward-stat-card">


            <div class="stat-icon">

                <i class="fa-solid fa-shirt"></i>

            </div>


            <div>


                <strong>

                    <?php
                    echo $totalClothesDonated;
                    ?>

                </strong>


                <span>

                    CLOTHES DONATED

                </span>


            </div>


        </article>



        <article class="reward-stat-card">


            <div class="stat-icon">

                <i class="fa-solid fa-heart"></i>

            </div>


            <div>


                <strong>

                    <?php
                    echo $totalDonations;
                    ?>

                </strong>


                <span>

                    DONATIONS MADE

                </span>


            </div>


        </article>



        <article class="reward-stat-card">


            <div class="stat-icon">

                <i class="fa-solid fa-earth-americas"></i>

            </div>


            <div>


                <strong>

                    POSITIVE

                </strong>


                <span>

                    FASHION IMPACT

                </span>


            </div>


        </article>


    </section>



    <!-- =====================================
         FEATURED REWARDS
    ====================================== -->

    <section class="featured-rewards-section">


        <div class="section-heading">


            <div>


                <p class="section-tag">

                    SPEND YOUR COINS

                </p>


                <h2>

                    FEATURED

                    <span>REWARDS.</span>

                </h2>


            </div>


            <a
                href="redeem.php"
                class="view-all-link"
            >

                VIEW ALL

                <i class="fa-solid fa-arrow-right"></i>

            </a>


        </div>



        <div class="rewards-grid">


            <?php foreach ($featuredRewards as $reward): ?>


                <article class="reward-card">


                    <div class="reward-card-icon">

                        <i
                            class="fa-solid <?php
                            echo htmlspecialchars(
                                $reward["icon"]
                            );
                            ?>"
                        ></i>

                    </div>


                    <h3>

                        <?php
                        echo htmlspecialchars(
                            $reward["title"]
                        );
                        ?>

                    </h3>


                    <p>

                        <?php
                        echo htmlspecialchars(
                            $reward["description"]
                        );
                        ?>

                    </p>


                    <div class="reward-card-footer">


                        <span>

                            🪙

                            <?php
                            echo $reward["coins"];
                            ?>

                            COINS

                        </span>


                        <a
                            href="redeem.php"
                            class="reward-redeem-link"
                        >

                            REDEEM

                        </a>


                    </div>


                </article>


            <?php endforeach; ?>


        </div>


    </section>



    <!-- =====================================
         HOW IT WORKS
    ====================================== -->

    <section class="reward-how-it-works">


        <div class="section-heading center-heading">


            <p class="section-tag">

                SIMPLE • SUSTAINABLE • REWARDING

            </p>


            <h2>

                HOW TO EARN

                <span>COINS.</span>

            </h2>


        </div>


        <div class="reward-steps">


            <article class="reward-step">


                <div class="step-number">
                    01
                </div>


                <div class="step-icon">

                    <i class="fa-solid fa-shirt"></i>

                </div>


                <h3>

                    SELECT CLOTHES

                </h3>


                <p>

                    Choose clothes you no longer
                    wear and prepare them for donation.

                </p>


            </article>



            <article class="reward-step">


                <div class="step-number">
                    02
                </div>


                <div class="step-icon">

                    <i class="fa-solid fa-handshake"></i>

                </div>


                <h3>

                    DONATE

                </h3>


                <p>

                    Donate your clothes through
                    an SSISS partner NGO.

                </p>


            </article>



            <article class="reward-step">


                <div class="step-number">
                    03
                </div>


                <div class="step-icon">

                    <i class="fa-solid fa-circle-check"></i>

                </div>


                <h3>

                    GET VERIFIED

                </h3>


                <p>

                    Once your donation is verified,
                    your contribution is recorded.

                </p>


            </article>



            <article class="reward-step">


                <div class="step-number">
                    04
                </div>


                <div class="step-icon">

                    <i class="fa-solid fa-coins"></i>

                </div>


                <h3>

                    EARN COINS

                </h3>


                <p>

                    SSISS Coins are added to your
                    account as a reward.

                </p>


            </article>


        </div>


        <div class="reward-how-action">


            <a
                href="earn.php"
                class="generate-outfit-main-btn"
            >

                LEARN HOW TO EARN

                <i class="fa-solid fa-arrow-right"></i>

            </a>


        </div>


    </section>



    <!-- =====================================
         RECENT ACTIVITY
    ====================================== -->

    <section class="recent-activity-section">


        <div class="section-heading">


            <div>


                <p class="section-tag">

                    YOUR COIN JOURNEY

                </p>


                <h2>

                    RECENT

                    <span>ACTIVITY.</span>

                </h2>


            </div>


            <a
                href="history.php"
                class="view-all-link"
            >

                VIEW HISTORY

                <i class="fa-solid fa-arrow-right"></i>

            </a>


        </div>



        <div class="activity-list">


            <?php foreach ($recentActivity as $activity): ?>


                <article class="activity-item">


                    <div class="activity-icon">


                        <?php if ($activity["coins"] > 0): ?>


                            <i class="fa-solid fa-coins"></i>


                        <?php else: ?>


                            <i class="fa-solid fa-gift"></i>


                        <?php endif; ?>


                    </div>


                    <div class="activity-info">


                        <h3>

                            <?php
                            echo htmlspecialchars(
                                $activity["type"]
                            );
                            ?>

                        </h3>


                        <p>

                            <?php
                            echo htmlspecialchars(
                                $activity["description"]
                            );
                            ?>

                        </p>


                        <span>

                            <?php
                            echo htmlspecialchars(
                                $activity["date"]
                            );
                            ?>

                        </span>


                    </div>


                    <div
                        class="activity-coins
                        <?php
                        echo $activity["coins"] < 0
                            ? "coins-spent"
                            : "coins-earned";
                        ?>"
                    >


                        <?php
                        echo $activity["coins"] > 0
                            ? "+"
                            : "";
                        ?>


                        <?php
                        echo $activity["coins"];
                        ?>


                        🪙


                    </div>


                </article>


            <?php endforeach; ?>


        </div>


    </section>



    <!-- =====================================
         DONATION CTA
    ====================================== -->

    <section class="reward-donation-cta">


        <div class="donation-cta-content">


            <p class="section-tag">

                MAKE A DIFFERENCE

            </p>


            <h2>

                GIVE YOUR CLOTHES

                <span>A SECOND LIFE.</span>

            </h2>


            <p>

                Donate clothes you no longer wear,
                support NGOs, reduce textile waste,
                and earn SSISS Coins.

            </p>


            <a
                href="../donation/index.php"
                class="generate-outfit-main-btn"
            >

                <i class="fa-solid fa-heart"></i>

                DONATE CLOTHES

            </a>


        </div>


    </section>


</main>


<!-- JAVASCRIPT -->

<script src="../assets/js/reward.js"></script>


</body>

</html>
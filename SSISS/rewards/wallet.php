<?php

$pageTitle = "My Wallet | SSISS";


/* =========================================
   TEMPORARY WALLET DATA

   Later this will come from MySQL.
========================================= */

$userCoins = 250;

$totalEarned = 500;

$totalSpent = 250;


/* =========================================
   AVAILABLE / UNLOCKED REWARDS

   Later this will come from MySQL.
========================================= */

$myRewards = [

    [
        "id" => 1,
        "title" => "₹100 OFF",
        "description" => "Get ₹100 off your next SSISS purchase.",
        "code" => "SSISS100",
        "status" => "Active",
        "expiry" => "30 April 2026",
        "icon" => "fa-ticket"
    ],

    [
        "id" => 2,
        "title" => "FREE SHIPPING",
        "description" => "Free shipping on your next order.",
        "code" => "FREESSISS",
        "status" => "Active",
        "expiry" => "15 May 2026",
        "icon" => "fa-truck"
    ]

];


/* =========================================
   RECENT WALLET ACTIVITY
========================================= */

$walletActivity = [

    [
        "type" => "Coins Earned",
        "description" => "Clothes donation verified",
        "coins" => 60,
        "date" => "15 March 2026",
        "status" => "earned"
    ],

    [
        "type" => "Coins Earned",
        "description" => "Eco Impact Bonus",
        "coins" => 20,
        "date" => "10 March 2026",
        "status" => "earned"
    ],

    [
        "type" => "Coins Spent",
        "description" => "₹100 discount redeemed",
        "coins" => -100,
        "date" => "25 February 2026",
        "status" => "spent"
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

        </a>


        <a
            href="../cart/index.php"
            class="icon-btn"
        >

            <i class="fa-solid fa-bag-shopping"></i>

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
     WALLET PAGE
========================================= -->

<main class="wallet-page">


    <!-- PAGE HEADER -->

    <section class="wallet-header">


        <a
            href="index.php"
            class="back-rewards"
        >

            <i class="fa-solid fa-arrow-left"></i>

            BACK TO REWARDS

        </a>


        <p class="section-tag">

            YOUR DIGITAL WALLET

        </p>


        <h1>

            MY SSISS

            <span>WALLET.</span>

        </h1>


        <p>

            Manage your SSISS Coins, rewards,
            discount coupons, and sustainable
            fashion benefits in one place.

        </p>


    </section>



    <!-- =====================================
         WALLET HERO
    ====================================== -->

    <section class="wallet-hero-card">


        <div class="wallet-main-info">


            <div class="wallet-icon">

                <i class="fa-solid fa-wallet"></i>

            </div>


            <div>


                <p>

                    AVAILABLE BALANCE

                </p>


                <h2>

                    <?php
                    echo $userCoins;
                    ?>

                    <span>

                        SSISS COINS

                    </span>

                </h2>


                <small>

                    🪙 Your sustainable fashion rewards

                </small>


            </div>


        </div>


        <div class="wallet-actions">


            <a
                href="earn.php"
                class="wallet-earn-btn"
            >

                <i class="fa-solid fa-plus"></i>

                EARN COINS

            </a>


            <a
                href="redeem.php"
                class="wallet-redeem-btn"
            >

                <i class="fa-solid fa-gift"></i>

                REDEEM

            </a>


        </div>


    </section>



    <!-- =====================================
         WALLET STATISTICS
    ====================================== -->

    <section class="wallet-stats">


        <article class="wallet-stat-card">


            <i class="fa-solid fa-arrow-trend-up"></i>


            <div>

                <span>

                    TOTAL EARNED

                </span>


                <strong>

                    +

                    <?php
                    echo $totalEarned;
                    ?>

                </strong>


                <small>

                    COINS

                </small>


            </div>


        </article>



        <article class="wallet-stat-card">


            <i class="fa-solid fa-arrow-trend-down"></i>


            <div>

                <span>

                    TOTAL SPENT

                </span>


                <strong>

                    -

                    <?php
                    echo $totalSpent;
                    ?>

                </strong>


                <small>

                    COINS

                </small>


            </div>


        </article>



        <article class="wallet-stat-card">


            <i class="fa-solid fa-gift"></i>


            <div>

                <span>

                    ACTIVE REWARDS

                </span>


                <strong>

                    <?php
                    echo count($myRewards);
                    ?>

                </strong>


                <small>

                    AVAILABLE

                </small>


            </div>


        </article>


    </section>



    <!-- =====================================
         MY ACTIVE REWARDS
    ====================================== -->

    <section class="my-rewards-section">


        <div class="section-heading">


            <div>


                <p class="section-tag">

                    READY TO USE

                </p>


                <h2>

                    MY ACTIVE

                    <span>REWARDS.</span>

                </h2>


            </div>


            <a
                href="redeem.php"
                class="view-all-link"
            >

                GET MORE

                <i class="fa-solid fa-arrow-right"></i>

            </a>


        </div>


        <div class="my-rewards-grid">


            <?php foreach ($myRewards as $reward): ?>


                <article class="my-reward-card">


                    <div class="my-reward-icon">


                        <i
                            class="fa-solid <?php
                            echo htmlspecialchars(
                                $reward["icon"]
                            );
                            ?>"
                        ></i>


                    </div>


                    <div class="my-reward-content">


                        <span class="reward-status">

                            <?php
                            echo htmlspecialchars(
                                $reward["status"]
                            );
                            ?>

                        </span>


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


                    </div>


                    <div class="reward-code-box">


                        <small>

                            REWARD CODE

                        </small>


                        <strong>

                            <?php
                            echo htmlspecialchars(
                                $reward["code"]
                            );
                            ?>

                        </strong>


                    </div>


                    <div class="reward-expiry">


                        <i class="fa-regular fa-calendar"></i>

                        Valid until

                        <?php
                        echo htmlspecialchars(
                            $reward["expiry"]
                        );
                        ?>

                    </div>


                </article>


            <?php endforeach; ?>


        </div>


    </section>



    <!-- =====================================
         RECENT WALLET ACTIVITY
    ====================================== -->

    <section class="wallet-activity-section">


        <div class="section-heading">


            <div>


                <p class="section-tag">

                    RECENT MOVEMENTS

                </p>


                <h2>

                    WALLET

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


        <div class="wallet-activity-list">


            <?php foreach ($walletActivity as $activity): ?>


                <article class="wallet-activity-item">


                    <div
                        class="wallet-activity-icon
                        <?php
                        echo $activity["status"];
                        ?>"
                    >


                        <?php
                        if (
                            $activity["status"] ===
                            "earned"
                        ):
                        ?>


                            <i class="fa-solid fa-coins"></i>


                        <?php else: ?>


                            <i class="fa-solid fa-gift"></i>


                        <?php endif; ?>


                    </div>


                    <div class="wallet-activity-info">


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


                        <small>

                            <?php
                            echo htmlspecialchars(
                                $activity["date"]
                            );
                            ?>

                        </small>


                    </div>


                    <div
                        class="wallet-activity-coins
                        <?php
                        echo $activity["status"];
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
         QUICK ACTIONS
    ====================================== -->

    <section class="wallet-quick-actions">


        <a
            href="earn.php"
            class="wallet-quick-card"
        >

            <i class="fa-solid fa-shirt"></i>


            <div>

                <h3>

                    DONATE & EARN

                </h3>


                <p>

                    Donate clothes and earn
                    SSISS Coins.

                </p>


            </div>


            <i class="fa-solid fa-arrow-right"></i>


        </a>



        <a
            href="redeem.php"
            class="wallet-quick-card"
        >

            <i class="fa-solid fa-gift"></i>


            <div>

                <h3>

                    REDEEM REWARDS

                </h3>


                <p>

                    Turn your coins into
                    shopping benefits.

                </p>


            </div>


            <i class="fa-solid fa-arrow-right"></i>


        </a>



        <a
            href="history.php"
            class="wallet-quick-card"
        >

            <i class="fa-solid fa-clock-rotate-left"></i>


            <div>

                <h3>

                    VIEW HISTORY

                </h3>


                <p>

                    Track all your coin
                    transactions.

                </p>


            </div>


            <i class="fa-solid fa-arrow-right"></i>


        </a>


    </section>


</main>


<!-- JAVASCRIPT -->

<script src="../assets/js/reward.js"></script>


</body>

</html>
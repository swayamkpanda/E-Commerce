<?php

$pageTitle = "Redeem Rewards | SSISS";


/* =========================================
   TEMPORARY USER COIN BALANCE

   Later this will come from MySQL.
========================================= */

$userCoins = 250;


/* =========================================
   AVAILABLE REWARDS

   Later this data will come from MySQL.
========================================= */

$rewards = [

    [
        "id" => 1,
        "title" => "₹100 OFF",
        "description" =>
            "Get ₹100 off your next purchase on SSISS.",
        "coins" => 100,
        "category" => "discount",
        "icon" => "fa-ticket"
    ],

    [
        "id" => 2,
        "title" => "₹250 OFF",
        "description" =>
            "Save ₹250 on selected fashion products.",
        "coins" => 250,
        "category" => "discount",
        "icon" => "fa-gift"
    ],

    [
        "id" => 3,
        "title" => "15% OFF",
        "description" =>
            "Get 15% off your next SSISS order.",
        "coins" => 400,
        "category" => "discount",
        "icon" => "fa-percent"
    ],

    [
        "id" => 4,
        "title" => "FREE SHIPPING",
        "description" =>
            "Unlock free shipping on your next order.",
        "coins" => 150,
        "category" => "shipping",
        "icon" => "fa-truck"
    ],

    [
        "id" => 5,
        "title" => "₹500 OFF",
        "description" =>
            "Get ₹500 off when shopping for selected collections.",
        "coins" => 700,
        "category" => "premium",
        "icon" => "fa-crown"
    ],

    [
        "id" => 6,
        "title" => "EARLY ACCESS",
        "description" =>
            "Get early access to selected SSISS fashion drops.",
        "coins" => 300,
        "category" => "premium",
        "icon" => "fa-star"
    ]

];


/* =========================================
   FILTER
========================================= */

$filter = isset($_GET["filter"])
    ? $_GET["filter"]
    : "all";


$filteredRewards = $rewards;


/* FILTER: DISCOUNTS */

if ($filter === "discount") {

    $filteredRewards = array_filter(

        $rewards,

        function ($reward) {

            return
                $reward["category"] ===
                "discount";

        }

    );

}


/* FILTER: SHIPPING */

if ($filter === "shipping") {

    $filteredRewards = array_filter(

        $rewards,

        function ($reward) {

            return
                $reward["category"] ===
                "shipping";

        }

    );

}


/* FILTER: PREMIUM */

if ($filter === "premium") {

    $filteredRewards = array_filter(

        $rewards,

        function ($reward) {

            return
                $reward["category"] ===
                "premium";

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
     REDEEM PAGE
========================================= -->

<main class="redeem-page">


    <!-- =====================================
         HEADER
    ====================================== -->

    <section class="redeem-header">


        <a
            href="index.php"
            class="back-rewards"
        >

            <i class="fa-solid fa-arrow-left"></i>

            BACK TO REWARDS

        </a>


        <p class="section-tag">

            TURN COINS INTO BENEFITS

        </p>


        <h1>

            REDEEM YOUR

            <span>COINS.</span>

        </h1>


        <p>

            Use your SSISS Coins to unlock
            exclusive discounts, offers,
            shopping benefits, and more.

        </p>


    </section>



    <!-- =====================================
         COIN BALANCE
    ====================================== -->

    <section class="redeem-balance-card">


        <div class="balance-icon">

            🪙

        </div>


        <div class="balance-info">


            <span>

                AVAILABLE BALANCE

            </span>


            <h2>

                <?php
                echo $userCoins;
                ?>

                <small>

                    SSISS COINS

                </small>

            </h2>


        </div>


        <a
            href="earn.php"
            class="earn-more-link"
        >

            EARN MORE

            <i class="fa-solid fa-arrow-right"></i>

        </a>


    </section>



    <!-- =====================================
         REWARD FILTERS
    ====================================== -->

    <section class="redeem-filter-section">


        <div class="section-heading">


            <div>


                <p class="section-tag">

                    AVAILABLE BENEFITS

                </p>


                <h2>

                    CHOOSE YOUR

                    <span>REWARD.</span>

                </h2>


            </div>


        </div>


        <div class="redeem-filters">


            <a
                href="redeem.php?filter=all"
                class="redeem-filter-btn
                <?php
                echo $filter === "all"
                    ? "active"
                    : "";
                ?>"
            >

                ALL REWARDS

            </a>


            <a
                href="redeem.php?filter=discount"
                class="redeem-filter-btn
                <?php
                echo $filter === "discount"
                    ? "active"
                    : "";
                ?>"
            >

                DISCOUNTS

            </a>


            <a
                href="redeem.php?filter=shipping"
                class="redeem-filter-btn
                <?php
                echo $filter === "shipping"
                    ? "active"
                    : "";
                ?>"
            >

                SHIPPING

            </a>


            <a
                href="redeem.php?filter=premium"
                class="redeem-filter-btn
                <?php
                echo $filter === "premium"
                    ? "active"
                    : "";
                ?>"
            >

                PREMIUM

            </a>


        </div>


    </section>



    <!-- =====================================
         REWARDS GRID
    ====================================== -->

    <section class="redeem-rewards-grid">


        <?php foreach ($filteredRewards as $reward): ?>


            <article
                class="redeem-reward-card
                <?php
                echo htmlspecialchars(
                    $reward["category"]
                );
                ?>"
            >


                <!-- ICON -->

                <div class="redeem-reward-icon">


                    <i
                        class="fa-solid <?php
                        echo htmlspecialchars(
                            $reward["icon"]
                        );
                        ?>"
                    ></i>


                </div>



                <!-- CATEGORY -->

                <span class="reward-category">


                    <?php
                    echo strtoupper(
                        htmlspecialchars(
                            $reward["category"]
                        )
                    );
                    ?>


                </span>



                <!-- TITLE -->

                <h3>


                    <?php
                    echo htmlspecialchars(
                        $reward["title"]
                    );
                    ?>


                </h3>



                <!-- DESCRIPTION -->

                <p>


                    <?php
                    echo htmlspecialchars(
                        $reward["description"]
                    );
                    ?>


                </p>



                <!-- COST -->

                <div class="reward-cost">


                    <span>

                        🪙

                        <?php
                        echo $reward["coins"];
                        ?>

                        COINS

                    </span>


                    <?php
                    if (
                        $userCoins >=
                        $reward["coins"]
                    ):
                    ?>


                        <button
                            class="redeem-btn"
                            data-reward-id="<?php
                            echo $reward["id"];
                            ?>"
                        >

                            REDEEM

                        </button>


                    <?php else: ?>


                        <button
                            class="redeem-btn disabled"
                            disabled
                        >

                            NEED

                            <?php
                            echo
                                $reward["coins"] -
                                $userCoins;
                            ?>

                            MORE

                        </button>


                    <?php endif; ?>


                </div>


            </article>


        <?php endforeach; ?>


    </section>



    <!-- =====================================
         EMPTY STATE
    ====================================== -->

    <?php
    if (
        empty($filteredRewards)
    ):
    ?>


        <section class="empty-rewards">


            <i class="fa-solid fa-gift"></i>


            <h2>

                NO REWARDS FOUND

            </h2>


            <p>

                There are currently no rewards
                available in this category.

            </p>


            <a
                href="redeem.php?filter=all"
                class="generate-outfit-main-btn"
            >

                VIEW ALL REWARDS

            </a>


        </section>


    <?php endif; ?>



    <!-- =====================================
         HOW REDEEMING WORKS
    ====================================== -->

    <section class="redeem-how-it-works">


        <div class="section-heading center-heading">


            <p class="section-tag">

                SIMPLE REWARD SYSTEM

            </p>


            <h2>

                HOW REDEEMING

                <span>WORKS.</span>

            </h2>


        </div>


        <div class="redeem-steps">


            <article class="redeem-step">


                <div class="redeem-step-number">

                    01

                </div>


                <i class="fa-solid fa-coins"></i>


                <h3>

                    EARN COINS

                </h3>


                <p>

                    Earn SSISS Coins by donating
                    clothes and participating in
                    sustainable activities.

                </p>


            </article>



            <article class="redeem-step">


                <div class="redeem-step-number">

                    02

                </div>


                <i class="fa-solid fa-gift"></i>


                <h3>

                    CHOOSE A REWARD

                </h3>


                <p>

                    Browse available rewards and
                    select the benefit you want.

                </p>


            </article>



            <article class="redeem-step">


                <div class="redeem-step-number">

                    03

                </div>


                <i class="fa-solid fa-ticket"></i>


                <h3>

                    REDEEM

                </h3>


                <p>

                    Spend your SSISS Coins to
                    unlock your selected reward.

                </p>


            </article>



            <article class="redeem-step">


                <div class="redeem-step-number">

                    04

                </div>


                <i class="fa-solid fa-bag-shopping"></i>


                <h3>

                    SHOP & SAVE

                </h3>


                <p>

                    Apply your unlocked reward
                    while shopping on SSISS.

                </p>


            </article>


        </div>


    </section>



    <!-- =====================================
         CTA
    ====================================== -->

    <section class="redeem-earn-cta">


        <div>


            <p class="section-tag">

                NOT ENOUGH COINS?

            </p>


            <h2>

                MAKE AN IMPACT.

                <span>EARN REWARDS.</span>

            </h2>


            <p>

                Donate clothes you no longer wear
                and turn sustainable fashion choices
                into real shopping benefits.

            </p>


        </div>


        <a
            href="earn.php"
            class="generate-outfit-main-btn"
        >

            <i class="fa-solid fa-coins"></i>

            START EARNING

        </a>


    </section>


</main>


<!-- JAVASCRIPT -->

<script src="../assets/js/reward.js"></script>


</body>

</html>
<?php

$pageTitle = "Reward History | SSISS";


/* =========================================
   TEMPORARY USER DATA

   Later this will come from MySQL.
========================================= */

$userCoins = 250;


/* =========================================
   TEMPORARY COIN HISTORY

   Later this data will come from a
   MySQL reward_transactions table.
========================================= */

$transactions = [

    [
        "id" => 1,
        "type" => "Clothes Donation",
        "description" => "You donated 3 clothing items",
        "coins" => 60,
        "date" => "15 March 2026",
        "category" => "earned"
    ],

    [
        "id" => 2,
        "type" => "Donation Bonus",
        "description" => "Bonus for sustainable contribution",
        "coins" => 20,
        "date" => "10 March 2026",
        "category" => "earned"
    ],

    [
        "id" => 3,
        "type" => "Reward Redeemed",
        "description" => "₹100 shopping discount",
        "coins" => -100,
        "date" => "25 February 2026",
        "category" => "spent"
    ],

    [
        "id" => 4,
        "type" => "Clothes Donation",
        "description" => "You donated 2 clothing items",
        "coins" => 40,
        "date" => "20 February 2026",
        "category" => "earned"
    ],

    [
        "id" => 5,
        "type" => "Eco Challenge",
        "description" => "Completed monthly sustainable fashion challenge",
        "coins" => 30,
        "date" => "15 February 2026",
        "category" => "earned"
    ],

    [
        "id" => 6,
        "type" => "Reward Redeemed",
        "description" => "₹250 shopping discount",
        "coins" => -250,
        "date" => "10 February 2026",
        "category" => "spent"
    ],

    [
        "id" => 7,
        "type" => "Referral Bonus",
        "description" => "Friend joined SSISS",
        "coins" => 50,
        "date" => "05 February 2026",
        "category" => "earned"
    ]

];


/* =========================================
   FILTER

   Later this can be connected with
   database queries.
========================================= */

$filter = isset($_GET["filter"])
    ? $_GET["filter"]
    : "all";


$filteredTransactions = $transactions;


if ($filter === "earned") {

    $filteredTransactions = array_filter(

        $transactions,

        function ($transaction) {

            return
                $transaction["category"] ===
                "earned";

        }

    );

}


if ($filter === "spent") {

    $filteredTransactions = array_filter(

        $transactions,

        function ($transaction) {

            return
                $transaction["category"] ===
                "spent";

        }

    );

}


/* =========================================
   CALCULATE TOTALS
========================================= */

$totalEarned = 0;

$totalSpent = 0;


foreach ($transactions as $transaction) {

    if ($transaction["coins"] > 0) {

        $totalEarned +=
            $transaction["coins"];

    } else {

        $totalSpent +=
            abs($transaction["coins"]);

    }

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
     HISTORY PAGE
========================================= -->

<main class="reward-history-page">


    <!-- PAGE HEADER -->

    <section class="history-header">


        <a
            href="index.php"
            class="back-rewards"
        >

            <i class="fa-solid fa-arrow-left"></i>

            BACK TO REWARDS

        </a>


        <p class="section-tag">

            YOUR SSISS COIN JOURNEY

        </p>


        <h1>

            REWARD

            <span>HISTORY.</span>

        </h1>


        <p>

            Track every SSISS Coin you earn,
            spend, and receive through your
            sustainable fashion journey.

        </p>


    </section>



    <!-- =====================================
         COIN SUMMARY
    ====================================== -->

    <section class="history-summary">


        <article class="summary-card">


            <div class="summary-icon">

                <i class="fa-solid fa-coins"></i>

            </div>


            <div>


                <span>

                    CURRENT BALANCE

                </span>


                <strong>

                    <?php
                    echo $userCoins;
                    ?>

                    COINS

                </strong>


            </div>


        </article>



        <article class="summary-card">


            <div class="summary-icon">

                <i class="fa-solid fa-arrow-trend-up"></i>

            </div>


            <div>


                <span>

                    TOTAL EARNED

                </span>


                <strong>

                    +

                    <?php
                    echo $totalEarned;
                    ?>

                    COINS

                </strong>


            </div>


        </article>



        <article class="summary-card">


            <div class="summary-icon">

                <i class="fa-solid fa-arrow-trend-down"></i>

            </div>


            <div>


                <span>

                    TOTAL SPENT

                </span>


                <strong>

                    -

                    <?php
                    echo $totalSpent;
                    ?>

                    COINS

                </strong>


            </div>


        </article>


    </section>



    <!-- =====================================
         FILTERS
    ====================================== -->

    <section class="history-filter-section">


        <div class="history-filter-header">


            <h2>

                ALL TRANSACTIONS

            </h2>


            <p>

                <?php
                echo count(
                    $filteredTransactions
                );
                ?>

                TRANSACTIONS FOUND

            </p>


        </div>


        <div class="history-filters">


            <a
                href="history.php?filter=all"
                class="filter-btn
                <?php
                echo $filter === "all"
                    ? "active"
                    : "";
                ?>"
            >

                ALL

            </a>


            <a
                href="history.php?filter=earned"
                class="filter-btn
                <?php
                echo $filter === "earned"
                    ? "active"
                    : "";
                ?>"
            >

                EARNED

            </a>


            <a
                href="history.php?filter=spent"
                class="filter-btn
                <?php
                echo $filter === "spent"
                    ? "active"
                    : "";
                ?>"
            >

                SPENT

            </a>


        </div>


    </section>



    <!-- =====================================
         TRANSACTION LIST
    ====================================== -->

    <section class="transaction-list">


        <?php
        foreach (
            $filteredTransactions
            as $transaction
        ):
        ?>


            <article
                class="transaction-item
                <?php
                echo htmlspecialchars(
                    $transaction["category"]
                );
                ?>"
            >


                <!-- ICON -->

                <div class="transaction-icon">


                    <?php
                    if (
                        $transaction["category"] ===
                        "earned"
                    ):
                    ?>


                        <i class="fa-solid fa-coins"></i>


                    <?php else: ?>


                        <i class="fa-solid fa-gift"></i>


                    <?php endif; ?>


                </div>



                <!-- INFORMATION -->

                <div class="transaction-info">


                    <h3>

                        <?php
                        echo htmlspecialchars(
                            $transaction["type"]
                        );
                        ?>

                    </h3>


                    <p>

                        <?php
                        echo htmlspecialchars(
                            $transaction["description"]
                        );
                        ?>

                    </p>


                    <span>

                        <i class="fa-regular fa-calendar"></i>

                        <?php
                        echo htmlspecialchars(
                            $transaction["date"]
                        );
                        ?>

                    </span>


                </div>



                <!-- COINS -->

                <div
                    class="transaction-coins
                    <?php
                    echo $transaction["coins"] > 0
                        ? "coins-earned"
                        : "coins-spent";
                    ?>"
                >


                    <?php
                    echo $transaction["coins"] > 0
                        ? "+"
                        : "";
                    ?>


                    <?php
                    echo $transaction["coins"];
                    ?>


                    🪙


                </div>


            </article>


        <?php endforeach; ?>


    </section>



    <!-- =====================================
         EMPTY STATE
    ====================================== -->

    <?php
    if (
        empty($filteredTransactions)
    ):
    ?>


        <section class="empty-history">


            <i class="fa-solid fa-receipt"></i>


            <h2>

                NO TRANSACTIONS FOUND

            </h2>


            <p>

                There are no transactions
                available for this filter.

            </p>


            <a
                href="history.php?filter=all"
                class="generate-outfit-main-btn"
            >

                VIEW ALL TRANSACTIONS

            </a>


        </section>


    <?php endif; ?>


    <!-- =====================================
         EARN MORE CTA
    ====================================== -->

    <section class="history-earn-cta">


        <div>


            <p class="section-tag">

                KEEP MAKING AN IMPACT

            </p>


            <h2>

                WANT MORE

                <span>SSISS COINS?</span>

            </h2>


            <p>

                Donate clothes, participate in
                sustainable activities, and help
                give fashion a second life.

            </p>


        </div>


        <a
            href="earn.php"
            class="generate-outfit-main-btn"
        >

            <i class="fa-solid fa-coins"></i>

            EARN MORE COINS

        </a>


    </section>


</main>


<!-- JAVASCRIPT -->

<script src="../assets/js/reward.js"></script>


</body>

</html>
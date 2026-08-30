<?php

$pageTitle = "Reports | NGO Portal | SSISS";


/* =========================================
   TEMPORARY REPORT DATA
   Later replace with MySQL queries
========================================= */

$reportData = [

    "totalDonations" => 128,

    "totalDonors" => 76,

    "totalItemsReceived" => 642,

    "totalItemsDistributed" => 518,

    "pendingVerification" => 24,

    "readyForDistribution" => 37,

    "totalBeneficiaries" => 214

];


/* =========================================
   MONTHLY ACTIVITY DATA
========================================= */

$monthlyActivity = [

    [
        "month" => "January",
        "donations" => 18,
        "received" => 76,
        "distributed" => 58
    ],

    [
        "month" => "February",
        "donations" => 26,
        "received" => 112,
        "distributed" => 89
    ],

    [
        "month" => "March",
        "donations" => 34,
        "received" => 156,
        "distributed" => 127
    ],

    [
        "month" => "April",
        "donations" => 22,
        "received" => 104,
        "distributed" => 83
    ]

];


/* =========================================
   CATEGORY DISTRIBUTION
========================================= */

$categories = [

    [
        "name" => "Men's Clothing",
        "items" => 164,
        "percentage" => 26
    ],

    [
        "name" => "Women's Clothing",
        "items" => 192,
        "percentage" => 30
    ],

    [
        "name" => "Kids Clothing",
        "items" => 118,
        "percentage" => 18
    ],

    [
        "name" => "Winter Wear",
        "items" => 96,
        "percentage" => 15
    ],

    [
        "name" => "Mixed Clothing",
        "items" => 72,
        "percentage" => 11
    ]

];


/* =========================================
   RECENT ACTIVITY
========================================= */

$recentActivities = [

    [
        "icon" => "fa-hand-holding-heart",
        "title" => "New Donation Received",
        "description" => "A donation of 6 clothing items was received.",
        "time" => "Today"
    ],

    [
        "icon" => "fa-circle-check",
        "title" => "Verification Completed",
        "description" => "10 clothing items were approved for distribution.",
        "time" => "Today"
    ],

    [
        "icon" => "fa-truck",
        "title" => "Distribution Completed",
        "description" => "8 clothing items were distributed to a beneficiary.",
        "time" => "Yesterday"
    ],

    [
        "icon" => "fa-user-plus",
        "title" => "New Donor Added",
        "description" => "A new donor completed their first clothing donation.",
        "time" => "Yesterday"
    ]

];


/* =========================================
   CALCULATIONS
========================================= */

$remainingItems =
    $reportData["totalItemsReceived"]
    -
    $reportData["totalItemsDistributed"];


$distributionRate = 0;


if ($reportData["totalItemsReceived"] > 0) {

    $distributionRate = round(

        (
            $reportData["totalItemsDistributed"]
            /
            $reportData["totalItemsReceived"]
        )
        * 100

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
        href="../assets/css/ngo.css"
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


        <a href="../marketplace/index.php">
            Pre-Loved
        </a>


        <a href="../impact/index.php">
            Impact
        </a>


    </nav>


    <div class="nav-actions">


        <a
            href="index.php"
            class="icon-btn"
            title="NGO Dashboard"
        >

            <i class="fa-solid fa-building-ngo"></i>

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
     MAIN CONTENT
========================================= -->

<main class="ngo-reports-page">


    <!-- PAGE HEADER -->

    <section class="ngo-page-header">


        <a
            href="index.php"
            class="back-profile"
        >

            <i class="fa-solid fa-arrow-left"></i>

            BACK TO DASHBOARD

        </a>


        <p class="section-tag">

            NGO ANALYTICS

        </p>


        <h1>

            IMPACT

            <span>REPORTS.</span>

        </h1>


        <p>

            Monitor donations, clothing distribution,
            beneficiaries, and the overall impact created
            by your NGO.

        </p>


    </section>



    <!-- =====================================
         MAIN REPORT SUMMARY
    ====================================== -->

    <section class="ngo-reports-summary-grid">


        <article class="ngo-summary-card">


            <div class="ngo-summary-icon">

                <i class="fa-solid fa-hand-holding-heart"></i>

            </div>


            <div>

                <span>
                    TOTAL DONATIONS
                </span>


                <strong>

                    <?php
                    echo $reportData["totalDonations"];
                    ?>

                </strong>


            </div>


        </article>



        <article class="ngo-summary-card">


            <div class="ngo-summary-icon">

                <i class="fa-solid fa-users"></i>

            </div>


            <div>

                <span>
                    TOTAL DONORS
                </span>


                <strong>

                    <?php
                    echo $reportData["totalDonors"];
                    ?>

                </strong>


            </div>


        </article>



        <article class="ngo-summary-card">


            <div class="ngo-summary-icon">

                <i class="fa-solid fa-shirt"></i>

            </div>


            <div>

                <span>
                    ITEMS RECEIVED
                </span>


                <strong>

                    <?php
                    echo $reportData["totalItemsReceived"];
                    ?>

                </strong>


            </div>


        </article>



        <article class="ngo-summary-card">


            <div class="ngo-summary-icon">

                <i class="fa-solid fa-handshake-angle"></i>

            </div>


            <div>

                <span>
                    ITEMS DISTRIBUTED
                </span>


                <strong>

                    <?php
                    echo $reportData["totalItemsDistributed"];
                    ?>

                </strong>


            </div>


        </article>


    </section>



    <!-- =====================================
         IMPACT OVERVIEW
    ====================================== -->

    <section class="ngo-report-overview-grid">


        <article class="ngo-report-highlight-card">


            <div class="ngo-report-highlight-icon">

                <i class="fa-solid fa-chart-line"></i>

            </div>


            <span>

                DISTRIBUTION RATE

            </span>


            <strong>

                <?php
                echo $distributionRate;
                ?>%

            </strong>


            <p>

                Of received clothing has been
                successfully distributed.

            </p>


        </article>



        <article class="ngo-report-highlight-card">


            <div class="ngo-report-highlight-icon">

                <i class="fa-solid fa-box"></i>

            </div>


            <span>

                ITEMS AVAILABLE

            </span>


            <strong>

                <?php
                echo $remainingItems;
                ?>

            </strong>


            <p>

                Items currently available
                for future distribution.

            </p>


        </article>



        <article class="ngo-report-highlight-card">


            <div class="ngo-report-highlight-icon">

                <i class="fa-solid fa-clock"></i>

            </div>


            <span>

                PENDING VERIFICATION

            </span>


            <strong>

                <?php
                echo $reportData["pendingVerification"];
                ?>

            </strong>


            <p>

                Items waiting for NGO
                quality verification.

            </p>


        </article>



        <article class="ngo-report-highlight-card">


            <div class="ngo-report-highlight-icon">

                <i class="fa-solid fa-heart"></i>

            </div>


            <span>

                BENEFICIARIES HELPED

            </span>


            <strong>

                <?php
                echo $reportData["totalBeneficiaries"];
                ?>

            </strong>


            <p>

                People and communities
                supported through donations.

            </p>


        </article>


    </section>



    <!-- =====================================
         MONTHLY ACTIVITY
    ====================================== -->

    <section class="ngo-report-section">


        <div class="ngo-section-heading">


            <div>


                <p class="section-tag">

                    MONTHLY PERFORMANCE

                </p>


                <h2>

                    ACTIVITY

                    <span>OVERVIEW.</span>

                </h2>


            </div>


        </div>



        <div class="ngo-report-table-wrapper">


            <table class="ngo-report-table">


                <thead>


                    <tr>

                        <th>
                            MONTH
                        </th>

                        <th>
                            DONATIONS
                        </th>

                        <th>
                            ITEMS RECEIVED
                        </th>

                        <th>
                            ITEMS DISTRIBUTED
                        </th>

                    </tr>


                </thead>


                <tbody>


                    <?php foreach ($monthlyActivity as $activity): ?>


                        <tr>


                            <td>

                                <?php
                                echo htmlspecialchars(
                                    $activity["month"]
                                );
                                ?>

                            </td>


                            <td>

                                <?php
                                echo $activity["donations"];
                                ?>

                            </td>


                            <td>

                                <?php
                                echo $activity["received"];
                                ?>

                            </td>


                            <td>

                                <?php
                                echo $activity["distributed"];
                                ?>

                            </td>


                        </tr>


                    <?php endforeach; ?>


                </tbody>


            </table>


        </div>


    </section>



    <!-- =====================================
         CATEGORY BREAKDOWN
    ====================================== -->

    <section class="ngo-report-section">


        <div class="ngo-section-heading">


            <div>


                <p class="section-tag">

                    DONATION BREAKDOWN

                </p>


                <h2>

                    CLOTHING

                    <span>CATEGORIES.</span>

                </h2>


            </div>


        </div>



        <div class="ngo-category-report-list">


            <?php foreach ($categories as $category): ?>


                <article class="ngo-category-report-card">


                    <div class="ngo-category-report-top">


                        <div>


                            <h3>

                                <?php
                                echo htmlspecialchars(
                                    $category["name"]
                                );
                                ?>

                            </h3>


                            <span>

                                <?php
                                echo $category["items"];
                                ?>

                                ITEMS

                            </span>


                        </div>


                        <strong>

                            <?php
                            echo $category["percentage"];
                            ?>%

                        </strong>


                    </div>



                    <div class="ngo-progress-bar">


                        <div
                            class="ngo-progress-fill"
                            style="width: <?php
                            echo $category["percentage"];
                            ?>%;"
                        >

                        </div>


                    </div>


                </article>


            <?php endforeach; ?>


        </div>


    </section>



    <!-- =====================================
         RECENT ACTIVITY
    ====================================== -->

    <section class="ngo-report-section">


        <div class="ngo-section-heading">


            <div>


                <p class="section-tag">

                    LATEST UPDATES

                </p>


                <h2>

                    RECENT

                    <span>ACTIVITY.</span>

                </h2>


            </div>


        </div>



        <div class="ngo-report-activity-list">


            <?php foreach ($recentActivities as $activity): ?>


                <article class="ngo-report-activity-card">


                    <div class="ngo-report-activity-icon">


                        <i
                            class="fa-solid <?php
                            echo htmlspecialchars(
                                $activity["icon"]
                            );
                            ?>"
                        ></i>


                    </div>


                    <div class="ngo-report-activity-content">


                        <h3>

                            <?php
                            echo htmlspecialchars(
                                $activity["title"]
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


                    </div>


                    <span>

                        <?php
                        echo htmlspecialchars(
                            $activity["time"]
                        );
                        ?>

                    </span>


                </article>


            <?php endforeach; ?>


        </div>


    </section>


</main>



<!-- PROJECT JAVASCRIPT -->

<script src="../assets/js/ngo.js"></script>


</body>

</html>
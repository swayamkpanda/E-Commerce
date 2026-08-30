<?php

$pageTitle = "Received Donations | NGO Portal | SSISS";


/* =========================================
   TEMPORARY RECEIVED DONATION DATA
   Later replace with MySQL queries
========================================= */

$receivedDonations = [

    [
        "id" => "REC-1001",
        "donationId" => "DON-10243",
        "pickupId" => "PKP-1003",
        "donor" => "Aman Kumar",
        "items" => 3,
        "category" => "Casual Wear",
        "condition" => "Excellent",
        "receivedDate" => "23 March 2026",
        "receivedBy" => "NGO Volunteer",
        "status" => "Ready for Distribution",
        "statusClass" => "ready"
    ],

    [
        "id" => "REC-1002",
        "donationId" => "DON-10240",
        "pickupId" => "PKP-1004",
        "donor" => "Ananya Singh",
        "items" => 6,
        "category" => "Mixed Clothing",
        "condition" => "Good",
        "receivedDate" => "22 March 2026",
        "receivedBy" => "SSISS NGO Team",
        "status" => "Ready for Distribution",
        "statusClass" => "ready"
    ],

    [
        "id" => "REC-1003",
        "donationId" => "DON-10238",
        "pickupId" => "PKP-1006",
        "donor" => "Vikram Das",
        "items" => 10,
        "category" => "Winter Wear",
        "condition" => "Good",
        "receivedDate" => "21 March 2026",
        "receivedBy" => "NGO Volunteer",
        "status" => "Distributed",
        "statusClass" => "distributed"
    ],

    [
        "id" => "REC-1004",
        "donationId" => "DON-10235",
        "pickupId" => "PKP-1007",
        "donor" => "Neha Sharma",
        "items" => 5,
        "category" => "Women's Clothing",
        "condition" => "Excellent",
        "receivedDate" => "20 March 2026",
        "receivedBy" => "SSISS NGO Team",
        "status" => "Distributed",
        "statusClass" => "distributed"
    ]

];


/* =========================================
   FILTER
========================================= */

$filter = $_GET["filter"] ?? "all";

$allowedFilters = [
    "all",
    "ready",
    "distributed"
];


if (!in_array($filter, $allowedFilters, true)) {

    $filter = "all";

}


$filteredDonations = $receivedDonations;


if ($filter !== "all") {

    $filteredDonations = array_filter(

        $receivedDonations,

        function ($donation) use ($filter) {

            return
                $donation["statusClass"] === $filter;

        }

    );

}


/* =========================================
   SUMMARY CALCULATIONS
========================================= */

$totalReceived = count($receivedDonations);

$totalItems = 0;

$readyCount = 0;

$distributedCount = 0;


foreach ($receivedDonations as $donation) {

    $totalItems += $donation["items"];


    if ($donation["statusClass"] === "ready") {

        $readyCount++;

    }


    if ($donation["statusClass"] === "distributed") {

        $distributedCount++;

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

<main class="ngo-received-page">


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

            RECEIVED DONATIONS

        </p>


        <h1>

            CLOTHES

            <span>RECEIVED.</span>

        </h1>


        <p>

            Track donations that have successfully
            arrived at your NGO and prepare them
            for distribution.

        </p>


    </section>



    <!-- =====================================
         SUMMARY CARDS
    ====================================== -->

    <section class="ngo-received-summary-grid">


        <article class="ngo-summary-card">


            <div class="ngo-summary-icon">

                <i class="fa-solid fa-box-open"></i>

            </div>


            <div>

                <span>
                    TOTAL RECEIVED
                </span>


                <strong>

                    <?php echo $totalReceived; ?>

                </strong>


            </div>


        </article>



        <article class="ngo-summary-card">


            <div class="ngo-summary-icon">

                <i class="fa-solid fa-shirt"></i>

            </div>


            <div>

                <span>
                    TOTAL ITEMS
                </span>


                <strong>

                    <?php echo $totalItems; ?>

                </strong>


            </div>


        </article>



        <article class="ngo-summary-card">


            <div class="ngo-summary-icon">

                <i class="fa-solid fa-box"></i>

            </div>


            <div>

                <span>
                    READY TO DISTRIBUTE
                </span>


                <strong>

                    <?php echo $readyCount; ?>

                </strong>


            </div>


        </article>



        <article class="ngo-summary-card">


            <div class="ngo-summary-icon">

                <i class="fa-solid fa-hand-holding-heart"></i>

            </div>


            <div>

                <span>
                    DISTRIBUTED
                </span>


                <strong>

                    <?php echo $distributedCount; ?>

                </strong>


            </div>


        </article>


    </section>



    <!-- =====================================
         FILTER SECTION
    ====================================== -->

    <section class="ngo-filter-section">


        <div class="ngo-filter-buttons">


            <a
                href="received.php?filter=all"
                class="ngo-filter-btn <?php
                echo $filter === "all" ? "active" : "";
                ?>"
            >
                ALL
            </a>


            <a
                href="received.php?filter=ready"
                class="ngo-filter-btn <?php
                echo $filter === "ready" ? "active" : "";
                ?>"
            >
                READY TO DISTRIBUTE
            </a>


            <a
                href="received.php?filter=distributed"
                class="ngo-filter-btn <?php
                echo $filter === "distributed" ? "active" : "";
                ?>"
            >
                DISTRIBUTED
            </a>


        </div>


        <span class="ngo-results-count">

            <?php echo count($filteredDonations); ?>

            DONATION(S)

        </span>


    </section>



    <!-- =====================================
         RECEIVED DONATION LIST
    ====================================== -->

    <section class="ngo-received-section">


        <?php if (!empty($filteredDonations)): ?>


            <div class="ngo-received-list">


                <?php foreach ($filteredDonations as $donation): ?>


                    <article class="ngo-received-card">


                        <!-- HEADER -->


                        <div class="ngo-received-header">


                            <div class="ngo-received-id">


                                <div class="donation-item-icon">

                                    <i class="fa-solid fa-box-open"></i>

                                </div>


                                <div>


                                    <span>

                                        RECEIVED #

                                        <?php
                                        echo htmlspecialchars(
                                            $donation["id"]
                                        );
                                        ?>

                                    </span>


                                    <small>

                                        Donation:

                                        <?php
                                        echo htmlspecialchars(
                                            $donation["donationId"]
                                        );
                                        ?>

                                    </small>


                                </div>


                            </div>


                            <span
                                class="ngo-status <?php
                                echo htmlspecialchars(
                                    $donation["statusClass"]
                                );
                                ?>"
                            >

                                <?php
                                echo htmlspecialchars(
                                    $donation["status"]
                                );
                                ?>

                            </span>


                        </div>



                        <!-- DONATION DETAILS -->


                        <div class="ngo-received-details">


                            <div>


                                <span>
                                    DONOR
                                </span>


                                <strong>

                                    <?php
                                    echo htmlspecialchars(
                                        $donation["donor"]
                                    );
                                    ?>

                                </strong>


                            </div>



                            <div>


                                <span>
                                    ITEMS
                                </span>


                                <strong>

                                    <?php
                                    echo htmlspecialchars(
                                        $donation["items"]
                                    );
                                    ?>

                                </strong>


                            </div>



                            <div>


                                <span>
                                    CATEGORY
                                </span>


                                <strong>

                                    <?php
                                    echo htmlspecialchars(
                                        $donation["category"]
                                    );
                                    ?>

                                </strong>


                            </div>



                            <div>


                                <span>
                                    CONDITION
                                </span>


                                <strong>

                                    <?php
                                    echo htmlspecialchars(
                                        $donation["condition"]
                                    );
                                    ?>

                                </strong>


                            </div>


                        </div>



                        <!-- RECEIVING INFO -->


                        <div class="ngo-received-info">


                            <div>


                                <i class="fa-solid fa-calendar-days"></i>


                                <span>

                                    Received:

                                    <?php
                                    echo htmlspecialchars(
                                        $donation["receivedDate"]
                                    );
                                    ?>

                                </span>


                            </div>



                            <div>


                                <i class="fa-solid fa-user-check"></i>


                                <span>

                                    Received by:

                                    <?php
                                    echo htmlspecialchars(
                                        $donation["receivedBy"]
                                    );
                                    ?>

                                </span>


                            </div>


                        </div>



                        <!-- ACTIONS -->


                        <div class="ngo-received-actions">


                            <?php if (
                                $donation["statusClass"] === "ready"
                            ): ?>


                                <a
                                    href="distribution.php?donation=<?php
                                    echo urlencode(
                                        $donation["id"]
                                    );
                                    ?>"
                                    class="ngo-action-primary"
                                >

                                    <i class="fa-solid fa-hand-holding-heart"></i>

                                    START DISTRIBUTION

                                </a>


                            <?php else: ?>


                                <span class="ngo-completed-action">


                                    <i class="fa-solid fa-circle-check"></i>


                                    DISTRIBUTION COMPLETED


                                </span>


                            <?php endif; ?>



                            <a
                                href="donations.php"
                                class="ngo-action-secondary"
                            >

                                VIEW DONATION

                            </a>


                        </div>


                    </article>


                <?php endforeach; ?>


            </div>


        <?php else: ?>


            <!-- EMPTY STATE -->


            <div class="ngo-empty-state">


                <div class="empty-orders-icon">

                    <i class="fa-solid fa-box-open"></i>

                </div>


                <h2>

                    NO DONATIONS FOUND

                </h2>


                <p>

                    There are no received donations
                    matching this filter.

                </p>


                <a
                    href="received.php?filter=all"
                    class="ngo-action-primary"
                >

                    VIEW ALL RECEIVED DONATIONS

                </a>


            </div>


        <?php endif; ?>


    </section>


</main>



<!-- PROJECT JAVASCRIPT -->

<script src="../assets/js/ngo.js"></script>


</body>

</html>
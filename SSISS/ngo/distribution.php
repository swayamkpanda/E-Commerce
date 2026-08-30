<?php

$pageTitle = "Distribution | NGO Portal | SSISS";


/* =========================================
   TEMPORARY DISTRIBUTION DATA
   Later replace with MySQL queries
========================================= */

$distributions = [

    [
        "id" => "DST-1001",
        "receivedId" => "REC-1001",
        "donationId" => "DON-10243",
        "beneficiary" => "Community Shelter A",
        "location" => "Patia, Bhubaneswar",
        "items" => 3,
        "category" => "Casual Wear",
        "assignedDate" => "24 March 2026",
        "distributionDate" => "Not Distributed Yet",
        "status" => "Ready for Distribution",
        "statusClass" => "ready"
    ],

    [
        "id" => "DST-1002",
        "receivedId" => "REC-1002",
        "donationId" => "DON-10240",
        "beneficiary" => "Women Support Centre",
        "location" => "Nayapalli, Bhubaneswar",
        "items" => 6,
        "category" => "Mixed Clothing",
        "assignedDate" => "23 March 2026",
        "distributionDate" => "Not Distributed Yet",
        "status" => "Assigned",
        "statusClass" => "assigned"
    ],

    [
        "id" => "DST-1003",
        "receivedId" => "REC-1003",
        "donationId" => "DON-10238",
        "beneficiary" => "Winter Relief Camp",
        "location" => "Khandagiri, Bhubaneswar",
        "items" => 10,
        "category" => "Winter Wear",
        "assignedDate" => "22 March 2026",
        "distributionDate" => "23 March 2026",
        "status" => "Distributed",
        "statusClass" => "distributed"
    ],

    [
        "id" => "DST-1004",
        "receivedId" => "REC-1004",
        "donationId" => "DON-10235",
        "beneficiary" => "Women Empowerment Centre",
        "location" => "Saheed Nagar, Bhubaneswar",
        "items" => 5,
        "category" => "Women's Clothing",
        "assignedDate" => "20 March 2026",
        "distributionDate" => "21 March 2026",
        "status" => "Distributed",
        "statusClass" => "distributed"
    ],

    [
        "id" => "DST-1005",
        "receivedId" => "REC-1005",
        "donationId" => "DON-10230",
        "beneficiary" => "Children Care Home",
        "location" => "Chandrasekharpur, Bhubaneswar",
        "items" => 12,
        "category" => "Kids Clothing",
        "assignedDate" => "24 March 2026",
        "distributionDate" => "Not Distributed Yet",
        "status" => "Ready for Distribution",
        "statusClass" => "ready"
    ]

];


/* =========================================
   FILTER
========================================= */

$filter = $_GET["filter"] ?? "all";

$allowedFilters = [
    "all",
    "ready",
    "assigned",
    "distributed"
];


if (!in_array($filter, $allowedFilters, true)) {

    $filter = "all";

}


$filteredDistributions = $distributions;


if ($filter !== "all") {

    $filteredDistributions = array_filter(

        $distributions,

        function ($distribution) use ($filter) {

            return
                $distribution["statusClass"] === $filter;

        }

    );

}


/* =========================================
   SUMMARY CALCULATIONS
========================================= */

$totalDistributions = count($distributions);

$totalItems = 0;

$readyCount = 0;

$assignedCount = 0;

$distributedCount = 0;


foreach ($distributions as $distribution) {

    $totalItems += $distribution["items"];


    if ($distribution["statusClass"] === "ready") {

        $readyCount++;

    }


    if ($distribution["statusClass"] === "assigned") {

        $assignedCount++;

    }


    if ($distribution["statusClass"] === "distributed") {

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

<main class="ngo-distribution-page">


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

            DISTRIBUTION MANAGEMENT

        </p>


        <h1>

            CLOTHING

            <span>DISTRIBUTION.</span>

        </h1>


        <p>

            Assign received clothes to beneficiaries
            and track successful distribution.

        </p>


    </section>



    <!-- =====================================
         SUMMARY CARDS
    ====================================== -->

    <section class="ngo-distribution-summary-grid">


        <article class="ngo-summary-card">


            <div class="ngo-summary-icon">

                <i class="fa-solid fa-boxes-stacked"></i>

            </div>


            <div>

                <span>
                    TOTAL RECORDS
                </span>


                <strong>
                    <?php echo $totalDistributions; ?>
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

                <i class="fa-solid fa-clock"></i>

            </div>


            <div>

                <span>
                    READY
                </span>


                <strong>
                    <?php echo $readyCount; ?>
                </strong>


            </div>


        </article>



        <article class="ngo-summary-card">


            <div class="ngo-summary-icon">

                <i class="fa-solid fa-truck-ramp-box"></i>

            </div>


            <div>

                <span>
                    ASSIGNED
                </span>


                <strong>
                    <?php echo $assignedCount; ?>
                </strong>


            </div>


        </article>



        <article class="ngo-summary-card">


            <div class="ngo-summary-icon">

                <i class="fa-solid fa-circle-check"></i>

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
                href="distribution.php?filter=all"
                class="ngo-filter-btn <?php
                echo $filter === "all" ? "active" : "";
                ?>"
            >
                ALL
            </a>


            <a
                href="distribution.php?filter=ready"
                class="ngo-filter-btn <?php
                echo $filter === "ready" ? "active" : "";
                ?>"
            >
                READY
            </a>


            <a
                href="distribution.php?filter=assigned"
                class="ngo-filter-btn <?php
                echo $filter === "assigned" ? "active" : "";
                ?>"
            >
                ASSIGNED
            </a>


            <a
                href="distribution.php?filter=distributed"
                class="ngo-filter-btn <?php
                echo $filter === "distributed" ? "active" : "";
                ?>"
            >
                DISTRIBUTED
            </a>


        </div>


        <span class="ngo-results-count">

            <?php echo count($filteredDistributions); ?>

            DISTRIBUTION(S)

        </span>


    </section>



    <!-- =====================================
         DISTRIBUTION LIST
    ====================================== -->

    <section class="ngo-distribution-section">


        <?php if (!empty($filteredDistributions)): ?>


            <div class="ngo-distribution-list">


                <?php foreach ($filteredDistributions as $distribution): ?>


                    <article class="ngo-distribution-card">


                        <!-- HEADER -->

                        <div class="ngo-distribution-header">


                            <div class="ngo-distribution-id">


                                <div class="donation-item-icon">

                                    <i class="fa-solid fa-hand-holding-heart"></i>

                                </div>


                                <div>


                                    <span>

                                        DISTRIBUTION #

                                        <?php
                                        echo htmlspecialchars(
                                            $distribution["id"]
                                        );
                                        ?>

                                    </span>


                                    <small>

                                        Donation:

                                        <?php
                                        echo htmlspecialchars(
                                            $distribution["donationId"]
                                        );
                                        ?>

                                    </small>


                                </div>


                            </div>


                            <span
                                class="ngo-status <?php
                                echo htmlspecialchars(
                                    $distribution["statusClass"]
                                );
                                ?>"
                            >

                                <?php
                                echo htmlspecialchars(
                                    $distribution["status"]
                                );
                                ?>

                            </span>


                        </div>



                        <!-- BENEFICIARY -->

                        <div class="ngo-beneficiary-info">


                            <div>

                                <span>
                                    BENEFICIARY
                                </span>


                                <strong>

                                    <?php
                                    echo htmlspecialchars(
                                        $distribution["beneficiary"]
                                    );
                                    ?>

                                </strong>


                            </div>


                            <div>

                                <span>
                                    LOCATION
                                </span>


                                <strong>

                                    <i class="fa-solid fa-location-dot"></i>

                                    <?php
                                    echo htmlspecialchars(
                                        $distribution["location"]
                                    );
                                    ?>

                                </strong>


                            </div>


                        </div>



                        <!-- DISTRIBUTION DETAILS -->

                        <div class="ngo-distribution-details">


                            <div>

                                <span>
                                    ITEMS
                                </span>


                                <strong>

                                    <?php
                                    echo $distribution["items"];
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
                                        $distribution["category"]
                                    );
                                    ?>

                                </strong>


                            </div>


                            <div>

                                <span>
                                    ASSIGNED DATE
                                </span>


                                <strong>

                                    <?php
                                    echo htmlspecialchars(
                                        $distribution["assignedDate"]
                                    );
                                    ?>

                                </strong>


                            </div>


                            <div>

                                <span>
                                    DISTRIBUTION DATE
                                </span>


                                <strong>

                                    <?php
                                    echo htmlspecialchars(
                                        $distribution["distributionDate"]
                                    );
                                    ?>

                                </strong>


                            </div>


                        </div>



                        <!-- ACTIONS -->

                        <div class="ngo-distribution-actions">


                            <?php if (
                                $distribution["statusClass"] === "ready"
                            ): ?>


                                <a
                                    href="distribution.php?action=assign&id=<?php
                                    echo urlencode(
                                        $distribution["id"]
                                    );
                                    ?>"
                                    class="ngo-action-primary"
                                >

                                    <i class="fa-solid fa-user-plus"></i>

                                    ASSIGN BENEFICIARY

                                </a>


                            <?php elseif (
                                $distribution["statusClass"] === "assigned"
                            ): ?>


                                <a
                                    href="distribution.php?action=complete&id=<?php
                                    echo urlencode(
                                        $distribution["id"]
                                    );
                                    ?>"
                                    class="ngo-action-primary"
                                >

                                    <i class="fa-solid fa-hand-holding-heart"></i>

                                    MARK AS DISTRIBUTED

                                </a>


                            <?php else: ?>


                                <span class="ngo-completed-action">

                                    <i class="fa-solid fa-circle-check"></i>

                                    DISTRIBUTION COMPLETED

                                </span>


                            <?php endif; ?>


                            <a
                                href="received.php"
                                class="ngo-action-secondary"
                            >

                                VIEW RECEIVED RECORD

                            </a>


                        </div>


                    </article>


                <?php endforeach; ?>


            </div>


        <?php else: ?>


            <!-- EMPTY STATE -->

            <div class="ngo-empty-state">


                <div class="empty-orders-icon">

                    <i class="fa-solid fa-hand-holding-heart"></i>

                </div>


                <h2>

                    NO DISTRIBUTIONS FOUND

                </h2>


                <p>

                    There are no distribution records
                    matching this filter.

                </p>


                <a
                    href="distribution.php?filter=all"
                    class="ngo-action-primary"
                >

                    VIEW ALL DISTRIBUTIONS

                </a>


            </div>


        <?php endif; ?>


    </section>


</main>



<!-- PROJECT JAVASCRIPT -->

<script src="../assets/js/ngo.js"></script>


</body>

</html>
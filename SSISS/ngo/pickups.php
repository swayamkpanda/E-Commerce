<?php

$pageTitle = "Pickups | NGO Portal | SSISS";


/* =========================================
   TEMPORARY PICKUP DATA
   Later replace with MySQL queries
========================================= */

$pickups = [

    [
        "id" => "PKP-1001",
        "donationId" => "DON-10245",
        "donor" => "Rahul Sharma",
        "phone" => "+91 9876543210",
        "items" => 4,
        "pickupDate" => "24 March 2026",
        "pickupTime" => "10:00 AM",
        "location" => "Patia, Bhubaneswar",
        "status" => "Pending",
        "statusClass" => "pending"
    ],

    [
        "id" => "PKP-1002",
        "donationId" => "DON-10244",
        "donor" => "Priya Das",
        "phone" => "+91 9876543211",
        "items" => 7,
        "pickupDate" => "24 March 2026",
        "pickupTime" => "12:30 PM",
        "location" => "Khandagiri, Bhubaneswar",
        "status" => "Scheduled",
        "statusClass" => "scheduled"
    ],

    [
        "id" => "PKP-1003",
        "donationId" => "DON-10243",
        "donor" => "Aman Kumar",
        "phone" => "+91 9876543212",
        "items" => 3,
        "pickupDate" => "23 March 2026",
        "pickupTime" => "03:00 PM",
        "location" => "Jaydev Vihar, Bhubaneswar",
        "status" => "Picked Up",
        "statusClass" => "picked"
    ],

    [
        "id" => "PKP-1004",
        "donationId" => "DON-10240",
        "donor" => "Ananya Singh",
        "phone" => "+91 9876543215",
        "items" => 6,
        "pickupDate" => "22 March 2026",
        "pickupTime" => "11:00 AM",
        "location" => "Nayapalli, Bhubaneswar",
        "status" => "Received",
        "statusClass" => "received"
    ],

    [
        "id" => "PKP-1005",
        "donationId" => "DON-10241",
        "donor" => "Rohit Mishra",
        "phone" => "+91 9876543214",
        "items" => 8,
        "pickupDate" => "25 March 2026",
        "pickupTime" => "02:00 PM",
        "location" => "Saheed Nagar, Bhubaneswar",
        "status" => "Scheduled",
        "statusClass" => "scheduled"
    ]

];


/* =========================================
   FILTER
========================================= */

$filter = $_GET["filter"] ?? "all";

$allowedFilters = [
    "all",
    "pending",
    "scheduled",
    "picked",
    "received"
];


if (!in_array($filter, $allowedFilters, true)) {

    $filter = "all";

}


$filteredPickups = $pickups;


if ($filter !== "all") {

    $filteredPickups = array_filter(

        $pickups,

        function ($pickup) use ($filter) {

            return $pickup["statusClass"] === $filter;

        }

    );

}


/* =========================================
   SUMMARY COUNTS
========================================= */

$totalPickups = count($pickups);

$pendingCount = 0;

$scheduledCount = 0;

$pickedCount = 0;

$receivedCount = 0;


foreach ($pickups as $pickup) {

    switch ($pickup["statusClass"]) {

        case "pending":
            $pendingCount++;
            break;

        case "scheduled":
            $scheduledCount++;
            break;

        case "picked":
            $pickedCount++;
            break;

        case "received":
            $receivedCount++;
            break;

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

<main class="ngo-pickups-page">


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

            PICKUP MANAGEMENT

        </p>


        <h1>

            DONATION

            <span>PICKUPS.</span>

        </h1>


        <p>

            Manage pickup schedules and track
            donation collection progress.

        </p>


    </section>



    <!-- =====================================
         SUMMARY CARDS
    ====================================== -->

    <section class="ngo-pickup-summary-grid">


        <article class="ngo-summary-card">

            <div class="ngo-summary-icon">

                <i class="fa-solid fa-truck"></i>

            </div>

            <div>

                <span>
                    TOTAL PICKUPS
                </span>

                <strong>
                    <?php echo $totalPickups; ?>
                </strong>

            </div>

        </article>



        <article class="ngo-summary-card">

            <div class="ngo-summary-icon">

                <i class="fa-solid fa-clock"></i>

            </div>

            <div>

                <span>
                    PENDING
                </span>

                <strong>
                    <?php echo $pendingCount; ?>
                </strong>

            </div>

        </article>



        <article class="ngo-summary-card">

            <div class="ngo-summary-icon">

                <i class="fa-solid fa-calendar-check"></i>

            </div>

            <div>

                <span>
                    SCHEDULED
                </span>

                <strong>
                    <?php echo $scheduledCount; ?>
                </strong>

            </div>

        </article>



        <article class="ngo-summary-card">

            <div class="ngo-summary-icon">

                <i class="fa-solid fa-check"></i>

            </div>

            <div>

                <span>
                    PICKED UP
                </span>

                <strong>
                    <?php echo $pickedCount; ?>
                </strong>

            </div>

        </article>


    </section>



    <!-- =====================================
         FILTER BUTTONS
    ====================================== -->

    <section class="ngo-filter-section">


        <div class="ngo-filter-buttons">


            <a
                href="pickups.php?filter=all"
                class="ngo-filter-btn <?php
                echo $filter === "all" ? "active" : "";
                ?>"
            >
                ALL
            </a>


            <a
                href="pickups.php?filter=pending"
                class="ngo-filter-btn <?php
                echo $filter === "pending" ? "active" : "";
                ?>"
            >
                PENDING
            </a>


            <a
                href="pickups.php?filter=scheduled"
                class="ngo-filter-btn <?php
                echo $filter === "scheduled" ? "active" : "";
                ?>"
            >
                SCHEDULED
            </a>


            <a
                href="pickups.php?filter=picked"
                class="ngo-filter-btn <?php
                echo $filter === "picked" ? "active" : "";
                ?>"
            >
                PICKED UP
            </a>


            <a
                href="pickups.php?filter=received"
                class="ngo-filter-btn <?php
                echo $filter === "received" ? "active" : "";
                ?>"
            >
                RECEIVED
            </a>


        </div>


        <span class="ngo-results-count">

            <?php echo count($filteredPickups); ?>

            PICKUP(S)

        </span>


    </section>



    <!-- =====================================
         PICKUP LIST
    ====================================== -->

    <section class="ngo-pickups-section">


        <?php if (!empty($filteredPickups)): ?>


            <div class="ngo-pickups-list">


                <?php foreach ($filteredPickups as $pickup): ?>


                    <article class="ngo-pickup-card">


                        <!-- PICKUP HEADER -->

                        <div class="ngo-pickup-header">


                            <div class="ngo-pickup-id">


                                <div class="donation-item-icon">

                                    <i class="fa-solid fa-truck"></i>

                                </div>


                                <div>

                                    <span>

                                        PICKUP #

                                        <?php
                                        echo htmlspecialchars(
                                            $pickup["id"]
                                        );
                                        ?>

                                    </span>


                                    <small>

                                        Donation:

                                        <?php
                                        echo htmlspecialchars(
                                            $pickup["donationId"]
                                        );
                                        ?>

                                    </small>


                                </div>


                            </div>


                            <span
                                class="ngo-status <?php
                                echo htmlspecialchars(
                                    $pickup["statusClass"]
                                );
                                ?>"
                            >

                                <?php
                                echo htmlspecialchars(
                                    $pickup["status"]
                                );
                                ?>

                            </span>


                        </div>



                        <!-- DONOR INFO -->

                        <div class="ngo-pickup-donor">


                            <div>

                                <span>
                                    DONOR
                                </span>

                                <strong>

                                    <?php
                                    echo htmlspecialchars(
                                        $pickup["donor"]
                                    );
                                    ?>

                                </strong>

                            </div>


                            <div>

                                <span>
                                    CONTACT
                                </span>

                                <strong>

                                    <?php
                                    echo htmlspecialchars(
                                        $pickup["phone"]
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
                                        $pickup["items"]
                                    );
                                    ?>

                                </strong>

                            </div>


                        </div>



                        <!-- PICKUP LOCATION -->

                        <div class="ngo-pickup-location">

                            <i class="fa-solid fa-location-dot"></i>

                            <?php
                            echo htmlspecialchars(
                                $pickup["location"]
                            );
                            ?>

                        </div>



                        <!-- PICKUP DATE AND TIME -->

                        <div class="ngo-pickup-schedule">


                            <div>

                                <i class="fa-solid fa-calendar-days"></i>


                                <span>

                                    <?php
                                    echo htmlspecialchars(
                                        $pickup["pickupDate"]
                                    );
                                    ?>

                                </span>


                            </div>


                            <div>

                                <i class="fa-solid fa-clock"></i>


                                <span>

                                    <?php
                                    echo htmlspecialchars(
                                        $pickup["pickupTime"]
                                    );
                                    ?>

                                </span>


                            </div>


                        </div>



                        <!-- ACTIONS -->

                        <div class="ngo-pickup-actions">


                            <?php if (
                                $pickup["statusClass"] === "pending"
                            ): ?>


                                <a
                                    href="pickups.php?action=schedule&id=<?php
                                    echo urlencode(
                                        $pickup["id"]
                                    );
                                    ?>"
                                    class="ngo-action-primary"
                                >

                                    <i class="fa-solid fa-calendar-plus"></i>

                                    SCHEDULE PICKUP

                                </a>


                            <?php elseif (
                                $pickup["statusClass"] === "scheduled"
                            ): ?>


                                <a
                                    href="pickups.php?action=picked&id=<?php
                                    echo urlencode(
                                        $pickup["id"]
                                    );
                                    ?>"
                                    class="ngo-action-primary"
                                >

                                    <i class="fa-solid fa-truck"></i>

                                    MARK AS PICKED UP

                                </a>


                            <?php elseif (
                                $pickup["statusClass"] === "picked"
                            ): ?>


                                <a
                                    href="received.php?pickup=<?php
                                    echo urlencode(
                                        $pickup["id"]
                                    );
                                    ?>"
                                    class="ngo-action-primary"
                                >

                                    <i class="fa-solid fa-box"></i>

                                    CONFIRM RECEIVED

                                </a>


                            <?php else: ?>


                                <span class="ngo-completed-action">

                                    <i class="fa-solid fa-circle-check"></i>

                                    PICKUP COMPLETED

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

                    <i class="fa-solid fa-truck"></i>

                </div>


                <h2>

                    NO PICKUPS FOUND

                </h2>


                <p>

                    There are currently no pickup
                    requests matching this filter.

                </p>


                <a
                    href="pickups.php?filter=all"
                    class="ngo-action-primary"
                >

                    VIEW ALL PICKUPS

                </a>


            </div>


        <?php endif; ?>


    </section>


</main>



<!-- PROJECT JAVASCRIPT -->

<script src="../assets/js/ngo.js"></script>


</body>

</html>
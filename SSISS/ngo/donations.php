<?php

$pageTitle = "Donations | NGO Portal | SSISS";


/* =========================================
   TEMPORARY DONATION DATA
   Later replace with MySQL queries
========================================= */

$donations = [

    [
        "id" => "DON-10245",
        "donor" => "Rahul Sharma",
        "items" => 4,
        "category" => "Men's Clothing",
        "condition" => "Excellent",
        "date" => "20 March 2026",
        "status" => "Pending Pickup",
        "statusClass" => "pending",
        "location" => "Patia, Bhubaneswar"
    ],

    [
        "id" => "DON-10244",
        "donor" => "Priya Das",
        "items" => 7,
        "category" => "Winter Wear",
        "condition" => "Good",
        "date" => "19 March 2026",
        "status" => "Scheduled",
        "statusClass" => "scheduled",
        "location" => "Khandagiri, Bhubaneswar"
    ],

    [
        "id" => "DON-10243",
        "donor" => "Aman Kumar",
        "items" => 3,
        "category" => "Casual Wear",
        "condition" => "Excellent",
        "date" => "18 March 2026",
        "status" => "Received",
        "statusClass" => "received",
        "location" => "Jaydev Vihar, Bhubaneswar"
    ],

    [
        "id" => "DON-10242",
        "donor" => "Sneha Patel",
        "items" => 5,
        "category" => "Women's Clothing",
        "condition" => "Good",
        "date" => "17 March 2026",
        "status" => "Distributed",
        "statusClass" => "distributed",
        "location" => "Chandrasekharpur, Bhubaneswar"
    ],

    [
        "id" => "DON-10241",
        "donor" => "Rohit Mishra",
        "items" => 8,
        "category" => "Kids Clothing",
        "condition" => "Excellent",
        "date" => "16 March 2026",
        "status" => "Pending Pickup",
        "statusClass" => "pending",
        "location" => "Saheed Nagar, Bhubaneswar"
    ],

    [
        "id" => "DON-10240",
        "donor" => "Ananya Singh",
        "items" => 6,
        "category" => "Mixed Clothing",
        "condition" => "Good",
        "date" => "15 March 2026",
        "status" => "Received",
        "statusClass" => "received",
        "location" => "Nayapalli, Bhubaneswar"
    ]

];


/* =========================================
   FILTER
========================================= */

$filter = $_GET["filter"] ?? "all";

$filteredDonations = $donations;


if ($filter !== "all") {

    $filteredDonations = array_filter(

        $donations,

        function ($donation) use ($filter) {

            return $donation["statusClass"] === $filter;

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

<main class="ngo-donations-page">


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

            DONATION MANAGEMENT

        </p>


        <h1>

            CLOTHING

            <span>DONATIONS.</span>

        </h1>


        <p>

            Manage incoming clothing donations,
            track their status and coordinate pickups.

        </p>


    </section>



    <!-- =====================================
         DONATION SUMMARY
    ====================================== -->

    <section class="ngo-donation-summary">


        <article class="ngo-summary-card">


            <div class="ngo-summary-icon">

                <i class="fa-solid fa-shirt"></i>

            </div>


            <div>

                <span>
                    TOTAL DONATIONS
                </span>


                <strong>

                    <?php echo count($donations); ?>

                </strong>

            </div>


        </article>



        <article class="ngo-summary-card">


            <div class="ngo-summary-icon">

                <i class="fa-solid fa-clock"></i>

            </div>


            <div>

                <span>
                    PENDING PICKUP
                </span>


                <strong>

                    <?php

                    $pending = 0;

                    foreach ($donations as $donation) {

                        if (
                            $donation["statusClass"] === "pending"
                        ) {

                            $pending++;

                        }

                    }

                    echo $pending;

                    ?>

                </strong>

            </div>


        </article>



        <article class="ngo-summary-card">


            <div class="ngo-summary-icon">

                <i class="fa-solid fa-box"></i>

            </div>


            <div>

                <span>
                    RECEIVED
                </span>


                <strong>

                    <?php

                    $received = 0;

                    foreach ($donations as $donation) {

                        if (
                            $donation["statusClass"] === "received"
                        ) {

                            $received++;

                        }

                    }

                    echo $received;

                    ?>

                </strong>

            </div>


        </article>


    </section>



    <!-- =====================================
         FILTERS
    ====================================== -->

    <section class="ngo-filter-section">


        <div class="ngo-filter-buttons">


            <a
                href="donations.php?filter=all"
                class="ngo-filter-btn <?php
                echo $filter === "all" ? "active" : "";
                ?>"
            >
                ALL
            </a>


            <a
                href="donations.php?filter=pending"
                class="ngo-filter-btn <?php
                echo $filter === "pending" ? "active" : "";
                ?>"
            >
                PENDING
            </a>


            <a
                href="donations.php?filter=scheduled"
                class="ngo-filter-btn <?php
                echo $filter === "scheduled" ? "active" : "";
                ?>"
            >
                SCHEDULED
            </a>


            <a
                href="donations.php?filter=received"
                class="ngo-filter-btn <?php
                echo $filter === "received" ? "active" : "";
                ?>"
            >
                RECEIVED
            </a>


            <a
                href="donations.php?filter=distributed"
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
         DONATION LIST
    ====================================== -->

    <section class="ngo-donations-section">


        <?php if (!empty($filteredDonations)): ?>


            <div class="ngo-donations-list">


                <?php foreach ($filteredDonations as $donation): ?>


                    <article class="ngo-donation-card">


                        <!-- TOP -->

                        <div class="ngo-donation-top">


                            <div class="ngo-donation-id">


                                <div class="donation-item-icon">

                                    <i class="fa-solid fa-shirt"></i>

                                </div>


                                <div>


                                    <span>

                                        DONATION #

                                        <?php
                                        echo htmlspecialchars(
                                            $donation["id"]
                                        );
                                        ?>

                                    </span>


                                    <small>

                                        Submitted on

                                        <?php
                                        echo htmlspecialchars(
                                            $donation["date"]
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



                        <!-- DETAILS -->

                        <div class="ngo-donation-details">


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



                        <!-- LOCATION -->

                        <div class="ngo-donation-location">


                            <i class="fa-solid fa-location-dot"></i>


                            <?php
                            echo htmlspecialchars(
                                $donation["location"]
                            );
                            ?>


                        </div>



                        <!-- ACTIONS -->

                        <div class="ngo-donation-actions">


                            <?php if (
                                $donation["statusClass"] === "pending"
                            ): ?>


                                <a
                                    href="pickups.php?donation=<?php
                                    echo urlencode(
                                        $donation["id"]
                                    );
                                    ?>"
                                    class="ngo-action-primary"
                                >

                                    <i class="fa-solid fa-truck"></i>

                                    SCHEDULE PICKUP

                                </a>


                            <?php endif; ?>



                            <?php if (
                                $donation["statusClass"] === "scheduled"
                            ): ?>


                                <a
                                    href="received.php?donation=<?php
                                    echo urlencode(
                                        $donation["id"]
                                    );
                                    ?>"
                                    class="ngo-action-primary"
                                >

                                    <i class="fa-solid fa-box"></i>

                                    MARK AS RECEIVED

                                </a>


                            <?php endif; ?>



                            <?php if (
                                $donation["statusClass"] === "received"
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

                                    DISTRIBUTE

                                </a>


                            <?php endif; ?>



                            <?php if (
                                $donation["statusClass"] === "distributed"
                            ): ?>


                                <span class="ngo-completed-action">

                                    <i class="fa-solid fa-circle-check"></i>

                                    SUCCESSFULLY DISTRIBUTED

                                </span>


                            <?php endif; ?>


                            <a
                                href="donors.php?donor=<?php
                                echo urlencode(
                                    $donation["donor"]
                                );
                                ?>"
                                class="ngo-action-secondary"
                            >

                                VIEW DONOR

                            </a>


                        </div>


                    </article>


                <?php endforeach; ?>


            </div>


        <?php else: ?>


            <!-- EMPTY STATE -->


            <div class="ngo-empty-state">


                <div class="empty-orders-icon">

                    <i class="fa-solid fa-shirt"></i>

                </div>


                <h2>

                    NO DONATIONS FOUND

                </h2>


                <p>

                    There are currently no donations
                    matching this filter.

                </p>


                <a
                    href="donations.php?filter=all"
                    class="ngo-action-primary"
                >

                    VIEW ALL DONATIONS

                </a>


            </div>


        <?php endif; ?>


    </section>


</main>



<!-- PROJECT JAVASCRIPT -->

<script src="../assets/js/ngo.js"></script>


</body>

</html>
<?php

$pageTitle = "NGO Dashboard | SSISS";


/* =========================================
   TEMPORARY NGO DATA
   Later replace with MySQL queries
========================================= */

$ngo = [

    "name" => "SSISS Partner NGO",
    "status" => "Verified",
    "city" => "Bhubaneswar, Odisha"

];


$stats = [

    [
        "title" => "PENDING DONATIONS",
        "value" => 12,
        "icon" => "fa-shirt"
    ],

    [
        "title" => "PICKUPS TODAY",
        "value" => 5,
        "icon" => "fa-truck"
    ],

    [
        "title" => "ITEMS RECEIVED",
        "value" => 148,
        "icon" => "fa-box"
    ],

    [
        "title" => "CLOTHES DISTRIBUTED",
        "value" => 326,
        "icon" => "fa-hand-holding-heart"
    ]

];


/* =========================================
   RECENT DONATIONS
========================================= */

$recentDonations = [

    [
        "id" => "DON-10245",
        "donor" => "Rahul Sharma",
        "items" => 4,
        "category" => "Clothing",
        "status" => "Pending Pickup",
        "statusClass" => "pending"
    ],

    [
        "id" => "DON-10244",
        "donor" => "Priya Das",
        "items" => 7,
        "category" => "Winter Wear",
        "status" => "Scheduled",
        "statusClass" => "scheduled"
    ],

    [
        "id" => "DON-10243",
        "donor" => "Aman Kumar",
        "items" => 3,
        "category" => "Casual Wear",
        "status" => "Received",
        "statusClass" => "received"
    ]

];


/* =========================================
   UPCOMING PICKUPS
========================================= */

$pickups = [

    [
        "time" => "10:00 AM",
        "donor" => "Rahul Sharma",
        "location" => "Patia, Bhubaneswar",
        "items" => 4
    ],

    [
        "time" => "12:30 PM",
        "donor" => "Priya Das",
        "location" => "Khandagiri, Bhubaneswar",
        "items" => 7
    ],

    [
        "time" => "04:00 PM",
        "donor" => "Sneha Patel",
        "location" => "Chandrasekharpur, Bhubaneswar",
        "items" => 5
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
            href="../profile/index.php"
            class="profile-btn"
        >

            <i class="fa-solid fa-user"></i>

        </a>


    </div>


</header>



<!-- =========================================
     NGO DASHBOARD
========================================= -->

<main class="ngo-dashboard">


    <!-- DASHBOARD HEADER -->

    <section class="ngo-dashboard-header">


        <div>


            <p class="section-tag">

                NGO PARTNER PORTAL

            </p>


            <h1>

                WELCOME BACK,

                <span>
                    <?php
                    echo htmlspecialchars($ngo["name"]);
                    ?>
                </span>

            </h1>


            <p class="ngo-location">

                <i class="fa-solid fa-location-dot"></i>

                <?php
                echo htmlspecialchars($ngo["city"]);
                ?>

            </p>


        </div>


        <div class="ngo-verified-badge">


            <i class="fa-solid fa-circle-check"></i>

            <?php
            echo htmlspecialchars($ngo["status"]);
            ?>

        </div>


    </section>



    <!-- =====================================
         STATISTICS
    ====================================== -->

    <section class="ngo-stats-grid">


        <?php foreach ($stats as $stat): ?>


            <article class="ngo-stat-card">


                <div class="ngo-stat-icon">

                    <i
                        class="fa-solid <?php
                        echo htmlspecialchars($stat["icon"]);
                        ?>"
                    ></i>

                </div>


                <div>

                    <span>

                        <?php
                        echo htmlspecialchars($stat["title"]);
                        ?>

                    </span>


                    <strong>

                        <?php
                        echo htmlspecialchars($stat["value"]);
                        ?>

                    </strong>


                </div>


            </article>


        <?php endforeach; ?>


    </section>



    <!-- =====================================
         QUICK ACTIONS
    ====================================== -->

    <section class="ngo-quick-actions">


        <div class="section-heading">


            <div>


                <p class="section-tag">

                    QUICK ACCESS

                </p>


                <h2>

                    MANAGE YOUR

                    <span>ACTIVITY.</span>

                </h2>


            </div>


        </div>


        <div class="ngo-action-grid">


            <a
                href="donations.php"
                class="ngo-action-card"
            >

                <i class="fa-solid fa-shirt"></i>

                <h3>
                    DONATIONS
                </h3>

                <p>
                    View and manage donated clothes.
                </p>

            </a>



            <a
                href="pickups.php"
                class="ngo-action-card"
            >

                <i class="fa-solid fa-truck"></i>

                <h3>
                    PICKUPS
                </h3>

                <p>
                    Manage scheduled donation pickups.
                </p>

            </a>



            <a
                href="received.php"
                class="ngo-action-card"
            >

                <i class="fa-solid fa-box-open"></i>

                <h3>
                    RECEIVED
                </h3>

                <p>
                    Confirm and manage received donations.
                </p>

            </a>



            <a
                href="distribution.php"
                class="ngo-action-card"
            >

                <i class="fa-solid fa-hand-holding-heart"></i>

                <h3>
                    DISTRIBUTION
                </h3>

                <p>
                    Track clothing distribution activity.
                </p>

            </a>



            <a
                href="donors.php"
                class="ngo-action-card"
            >

                <i class="fa-solid fa-users"></i>

                <h3>
                    DONORS
                </h3>

                <p>
                    View your donor community.
                </p>

            </a>



            <a
                href="reports.php"
                class="ngo-action-card"
            >

                <i class="fa-solid fa-chart-line"></i>

                <h3>
                    REPORTS
                </h3>

                <p>
                    View donation and distribution reports.
                </p>

            </a>


        </div>


    </section>



    <!-- =====================================
         DASHBOARD CONTENT
    ====================================== -->

    <section class="ngo-content-grid">


        <!-- RECENT DONATIONS -->


        <div class="ngo-panel">


            <div class="ngo-panel-header">


                <div>


                    <p class="section-tag">

                        RECENT ACTIVITY

                    </p>


                    <h2>

                        RECENT

                        <span>DONATIONS.</span>

                    </h2>


                </div>


                <a
                    href="donations.php"
                    class="view-all-link"
                >

                    VIEW ALL

                    <i class="fa-solid fa-arrow-right"></i>

                </a>


            </div>



            <div class="recent-donations-list">


                <?php foreach (
                    $recentDonations
                    as
                    $donation
                ): ?>


                    <article class="recent-donation-item">


                        <div class="donation-item-icon">

                            <i class="fa-solid fa-shirt"></i>

                        </div>


                        <div class="donation-item-info">


                            <h3>

                                <?php
                                echo htmlspecialchars(
                                    $donation["donor"]
                                );
                                ?>

                            </h3>


                            <p>

                                <?php
                                echo htmlspecialchars(
                                    $donation["id"]
                                );
                                ?>

                                ·

                                <?php
                                echo htmlspecialchars(
                                    $donation["items"]
                                );
                                ?>

                                items

                            </p>


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


                    </article>


                <?php endforeach; ?>


            </div>


        </div>



        <!-- UPCOMING PICKUPS -->


        <div class="ngo-panel">


            <div class="ngo-panel-header">


                <div>


                    <p class="section-tag">

                        TODAY'S SCHEDULE

                    </p>


                    <h2>

                        UPCOMING

                        <span>PICKUPS.</span>

                    </h2>


                </div>


                <a
                    href="pickups.php"
                    class="view-all-link"
                >

                    VIEW ALL

                    <i class="fa-solid fa-arrow-right"></i>

                </a>


            </div>



            <div class="pickup-list">


                <?php foreach (
                    $pickups
                    as
                    $pickup
                ): ?>


                    <article class="pickup-item">


                        <div class="pickup-time">

                            <strong>

                                <?php
                                echo htmlspecialchars(
                                    $pickup["time"]
                                );
                                ?>

                            </strong>

                        </div>


                        <div class="pickup-info">


                            <h3>

                                <?php
                                echo htmlspecialchars(
                                    $pickup["donor"]
                                );
                                ?>

                            </h3>


                            <p>

                                <i class="fa-solid fa-location-dot"></i>

                                <?php
                                echo htmlspecialchars(
                                    $pickup["location"]
                                );
                                ?>

                            </p>


                        </div>


                        <span class="pickup-items">

                            <?php
                            echo htmlspecialchars(
                                $pickup["items"]
                            );
                            ?>

                            ITEMS

                        </span>


                    </article>


                <?php endforeach; ?>


            </div>


        </div>


    </section>



    <!-- =====================================
         FOOTER ACTIONS
    ====================================== -->

    <section class="ngo-dashboard-footer-actions">


        <a
            href="verification.php"
            class="ngo-secondary-action"
        >

            <i class="fa-solid fa-shield-halved"></i>

            VERIFICATION

        </a>


        <a
            href="impact.php"
            class="ngo-primary-action"
        >

            <i class="fa-solid fa-earth-americas"></i>

            VIEW OUR IMPACT

        </a>


    </section>


</main>



<!-- JAVASCRIPT -->

<script src="../assets/js/ngo.js"></script>


</body>

</html>
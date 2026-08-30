<?php

$pageTitle = "Donor Details | NGO Portal | SSISS";


/* =========================================
   TEMPORARY DONOR DATA
   Later replace with MySQL queries
========================================= */

$donors = [

    "USR-1001" => [
        "id" => "USR-1001",
        "name" => "Rahul Sharma",
        "email" => "rahul@example.com",
        "phone" => "+91 9876543210",
        "location" => "Patia, Bhubaneswar",
        "joinedDate" => "10 January 2026",
        "totalDonations" => 5,
        "totalItems" => 24,
        "lastDonation" => "20 March 2026",
        "status" => "Active",
        "statusClass" => "active"
    ],

    "USR-1002" => [
        "id" => "USR-1002",
        "name" => "Priya Das",
        "email" => "priya@example.com",
        "phone" => "+91 9876543211",
        "location" => "Khandagiri, Bhubaneswar",
        "joinedDate" => "15 January 2026",
        "totalDonations" => 3,
        "totalItems" => 17,
        "lastDonation" => "19 March 2026",
        "status" => "Active",
        "statusClass" => "active"
    ],

    "USR-1003" => [
        "id" => "USR-1003",
        "name" => "Aman Kumar",
        "email" => "aman@example.com",
        "phone" => "+91 9876543212",
        "location" => "Jaydev Vihar, Bhubaneswar",
        "joinedDate" => "20 January 2026",
        "totalDonations" => 2,
        "totalItems" => 8,
        "lastDonation" => "18 March 2026",
        "status" => "Active",
        "statusClass" => "active"
    ],

    "USR-1004" => [
        "id" => "USR-1004",
        "name" => "Sneha Patel",
        "email" => "sneha@example.com",
        "phone" => "+91 9876543213",
        "location" => "Chandrasekharpur, Bhubaneswar",
        "joinedDate" => "25 January 2026",
        "totalDonations" => 4,
        "totalItems" => 21,
        "lastDonation" => "17 March 2026",
        "status" => "Active",
        "statusClass" => "active"
    ]

];


/* =========================================
   GET DONOR ID FROM URL
========================================= */

$donorId = $_GET["id"] ?? "USR-1001";


/* =========================================
   CHECK IF DONOR EXISTS
========================================= */

if (!isset($donors[$donorId])) {

    header("Location: donors.php");

    exit;

}


$donor = $donors[$donorId];


/* =========================================
   TEMPORARY DONATION HISTORY
========================================= */

$donationHistory = [

    [
        "id" => "DON-10245",
        "date" => "20 March 2026",
        "items" => 4,
        "category" => "Men's Clothing",
        "condition" => "Excellent",
        "status" => "Pending Pickup",
        "statusClass" => "pending"
    ],

    [
        "id" => "DON-10220",
        "date" => "10 March 2026",
        "items" => 6,
        "category" => "Casual Wear",
        "condition" => "Good",
        "status" => "Received",
        "statusClass" => "received"
    ],

    [
        "id" => "DON-10195",
        "date" => "25 February 2026",
        "items" => 5,
        "category" => "Winter Wear",
        "condition" => "Good",
        "status" => "Distributed",
        "statusClass" => "distributed"
    ],

    [
        "id" => "DON-10170",
        "date" => "10 February 2026",
        "items" => 4,
        "category" => "Mixed Clothing",
        "condition" => "Excellent",
        "status" => "Distributed",
        "statusClass" => "distributed"
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

<main class="ngo-donor-page">


    <!-- BACK BUTTON -->

    <section class="ngo-page-header">


        <a
            href="donors.php"
            class="back-profile"
        >

            <i class="fa-solid fa-arrow-left"></i>

            BACK TO DONORS

        </a>


        <p class="section-tag">

            DONOR PROFILE

        </p>


        <h1>

            DONOR

            <span>DETAILS.</span>

        </h1>


    </section>



    <!-- =====================================
         DONOR PROFILE CARD
    ====================================== -->

    <section class="ngo-donor-profile-card">


        <div class="ngo-donor-profile-top">


            <div class="ngo-donor-avatar large">


                <?php

                echo strtoupper(
                    substr(
                        $donor["name"],
                        0,
                        1
                    )
                );

                ?>


            </div>


            <div class="ngo-donor-profile-name">


                <h2>

                    <?php
                    echo htmlspecialchars(
                        $donor["name"]
                    );
                    ?>

                </h2>


                <p>

                    <?php
                    echo htmlspecialchars(
                        $donor["id"]
                    );
                    ?>

                </p>


                <span
                    class="ngo-status <?php
                    echo htmlspecialchars(
                        $donor["statusClass"]
                    );
                    ?>"
                >

                    <?php
                    echo htmlspecialchars(
                        $donor["status"]
                    );
                    ?>

                </span>


            </div>


        </div>



        <!-- CONTACT DETAILS -->

        <div class="ngo-donor-profile-contact">


            <div>

                <span>
                    <i class="fa-solid fa-envelope"></i>
                    EMAIL
                </span>


                <strong>

                    <?php
                    echo htmlspecialchars(
                        $donor["email"]
                    );
                    ?>

                </strong>


            </div>



            <div>

                <span>
                    <i class="fa-solid fa-phone"></i>
                    PHONE
                </span>


                <strong>

                    <?php
                    echo htmlspecialchars(
                        $donor["phone"]
                    );
                    ?>

                </strong>


            </div>



            <div>

                <span>
                    <i class="fa-solid fa-location-dot"></i>
                    LOCATION
                </span>


                <strong>

                    <?php
                    echo htmlspecialchars(
                        $donor["location"]
                    );
                    ?>

                </strong>


            </div>



            <div>

                <span>
                    <i class="fa-solid fa-calendar"></i>
                    MEMBER SINCE
                </span>


                <strong>

                    <?php
                    echo htmlspecialchars(
                        $donor["joinedDate"]
                    );
                    ?>

                </strong>


            </div>


        </div>


    </section>



    <!-- =====================================
         DONOR STATISTICS
    ====================================== -->

    <section class="ngo-donor-details-stats">


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
                    echo $donor["totalDonations"];
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
                    ITEMS DONATED
                </span>


                <strong>

                    <?php
                    echo $donor["totalItems"];
                    ?>

                </strong>


            </div>


        </article>



        <article class="ngo-summary-card">


            <div class="ngo-summary-icon">

                <i class="fa-solid fa-calendar-check"></i>

            </div>


            <div>

                <span>
                    LAST DONATION
                </span>


                <strong>

                    <?php
                    echo htmlspecialchars(
                        $donor["lastDonation"]
                    );
                    ?>

                </strong>


            </div>


        </article>


    </section>



    <!-- =====================================
         DONATION HISTORY
    ====================================== -->

    <section class="ngo-donor-history-section">


        <div class="ngo-section-heading">


            <div>

                <p class="section-tag">

                    DONATION ACTIVITY

                </p>


                <h2>

                    DONATION

                    <span>HISTORY.</span>

                </h2>


            </div>


            <span class="ngo-results-count">

                <?php
                echo count($donationHistory);
                ?>

                RECORD(S)

            </span>


        </div>



        <div class="ngo-donor-history-list">


            <?php foreach ($donationHistory as $donation): ?>


                <article class="ngo-donor-history-card">


                    <!-- HISTORY HEADER -->

                    <div class="ngo-history-header">


                        <div class="ngo-history-id">


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



                    <!-- HISTORY DETAILS -->

                    <div class="ngo-history-details">


                        <div>

                            <span>
                                ITEMS
                            </span>


                            <strong>

                                <?php
                                echo $donation["items"];
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


                </article>


            <?php endforeach; ?>


        </div>


    </section>


</main>



<!-- PROJECT JAVASCRIPT -->

<script src="../assets/js/ngo.js"></script>


</body>

</html>
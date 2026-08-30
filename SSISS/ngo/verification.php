<?php

$pageTitle = "Verification | NGO Portal | SSISS";


/* =========================================
   TEMPORARY VERIFICATION DATA
   Later replace with MySQL queries
========================================= */

$verifications = [

    [
        "id" => "VER-1001",
        "receivedId" => "REC-1001",
        "donationId" => "DON-10243",
        "donor" => "Aman Kumar",
        "items" => 3,
        "category" => "Casual Wear",
        "condition" => "Excellent",
        "receivedDate" => "23 March 2026",
        "status" => "Pending Verification",
        "statusClass" => "pending"
    ],

    [
        "id" => "VER-1002",
        "receivedId" => "REC-1002",
        "donationId" => "DON-10240",
        "donor" => "Ananya Singh",
        "items" => 6,
        "category" => "Mixed Clothing",
        "condition" => "Good",
        "receivedDate" => "22 March 2026",
        "status" => "Approved",
        "statusClass" => "approved"
    ],

    [
        "id" => "VER-1003",
        "receivedId" => "REC-1003",
        "donationId" => "DON-10238",
        "donor" => "Vikram Das",
        "items" => 10,
        "category" => "Winter Wear",
        "condition" => "Fair",
        "receivedDate" => "21 March 2026",
        "status" => "Approved",
        "statusClass" => "approved"
    ],

    [
        "id" => "VER-1004",
        "receivedId" => "REC-1004",
        "donationId" => "DON-10235",
        "donor" => "Neha Sharma",
        "items" => 5,
        "category" => "Women's Clothing",
        "condition" => "Poor",
        "receivedDate" => "20 March 2026",
        "status" => "Rejected",
        "statusClass" => "rejected"
    ],

    [
        "id" => "VER-1005",
        "receivedId" => "REC-1005",
        "donationId" => "DON-10230",
        "donor" => "Rohit Mishra",
        "items" => 8,
        "category" => "Men's Clothing",
        "condition" => "Good",
        "receivedDate" => "24 March 2026",
        "status" => "Pending Verification",
        "statusClass" => "pending"
    ]

];


/* =========================================
   FILTER
========================================= */

$filter = $_GET["filter"] ?? "all";

$allowedFilters = [
    "all",
    "pending",
    "approved",
    "rejected"
];


if (!in_array($filter, $allowedFilters, true)) {

    $filter = "all";

}


$filteredVerifications = $verifications;


if ($filter !== "all") {

    $filteredVerifications = array_filter(

        $verifications,

        function ($verification) use ($filter) {

            return
                $verification["statusClass"] === $filter;

        }

    );

}


/* =========================================
   SUMMARY COUNTS
========================================= */

$totalVerifications = count($verifications);

$pendingCount = 0;

$approvedCount = 0;

$rejectedCount = 0;

$totalItems = 0;


foreach ($verifications as $verification) {

    $totalItems += $verification["items"];


    if ($verification["statusClass"] === "pending") {

        $pendingCount++;

    }


    if ($verification["statusClass"] === "approved") {

        $approvedCount++;

    }


    if ($verification["statusClass"] === "rejected") {

        $rejectedCount++;

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

        <a href="../index.php">Home</a>

        <a href="../shop/index.php">Shop</a>

        <a href="../wardrobe/index.php">Wardrobe</a>

        <a href="../marketplace/index.php">Pre-Loved</a>

        <a href="../impact/index.php">Impact</a>

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

<main class="ngo-verification-page">


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

            QUALITY CONTROL

        </p>


        <h1>

            DONATION

            <span>VERIFICATION.</span>

        </h1>


        <p>

            Inspect received clothing donations
            and approve suitable items for distribution.

        </p>


    </section>



    <!-- =====================================
         SUMMARY CARDS
    ====================================== -->

    <section class="ngo-verification-summary-grid">


        <article class="ngo-summary-card">

            <div class="ngo-summary-icon">

                <i class="fa-solid fa-list-check"></i>

            </div>

            <div>

                <span>TOTAL RECORDS</span>

                <strong>
                    <?php echo $totalVerifications; ?>
                </strong>

            </div>

        </article>



        <article class="ngo-summary-card">

            <div class="ngo-summary-icon">

                <i class="fa-solid fa-clock"></i>

            </div>

            <div>

                <span>PENDING</span>

                <strong>
                    <?php echo $pendingCount; ?>
                </strong>

            </div>

        </article>



        <article class="ngo-summary-card">

            <div class="ngo-summary-icon">

                <i class="fa-solid fa-circle-check"></i>

            </div>

            <div>

                <span>APPROVED</span>

                <strong>
                    <?php echo $approvedCount; ?>
                </strong>

            </div>

        </article>



        <article class="ngo-summary-card">

            <div class="ngo-summary-icon">

                <i class="fa-solid fa-circle-xmark"></i>

            </div>

            <div>

                <span>REJECTED</span>

                <strong>
                    <?php echo $rejectedCount; ?>
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
                href="verification.php?filter=all"
                class="ngo-filter-btn <?php
                echo $filter === "all" ? "active" : "";
                ?>"
            >
                ALL
            </a>


            <a
                href="verification.php?filter=pending"
                class="ngo-filter-btn <?php
                echo $filter === "pending" ? "active" : "";
                ?>"
            >
                PENDING
            </a>


            <a
                href="verification.php?filter=approved"
                class="ngo-filter-btn <?php
                echo $filter === "approved" ? "active" : "";
                ?>"
            >
                APPROVED
            </a>


            <a
                href="verification.php?filter=rejected"
                class="ngo-filter-btn <?php
                echo $filter === "rejected" ? "active" : "";
                ?>"
            >
                REJECTED
            </a>


        </div>


        <span class="ngo-results-count">

            <?php echo count($filteredVerifications); ?>

            RECORD(S)

        </span>


    </section>



    <!-- =====================================
         VERIFICATION LIST
    ====================================== -->

    <section class="ngo-verification-section">


        <?php if (!empty($filteredVerifications)): ?>


            <div class="ngo-verification-list">


                <?php foreach ($filteredVerifications as $verification): ?>


                    <article class="ngo-verification-card">


                        <!-- HEADER -->

                        <div class="ngo-verification-header">


                            <div class="ngo-verification-id">


                                <div class="donation-item-icon">

                                    <i class="fa-solid fa-magnifying-glass"></i>

                                </div>


                                <div>


                                    <span>

                                        VERIFICATION #

                                        <?php
                                        echo htmlspecialchars(
                                            $verification["id"]
                                        );
                                        ?>

                                    </span>


                                    <small>

                                        Donation:

                                        <?php
                                        echo htmlspecialchars(
                                            $verification["donationId"]
                                        );
                                        ?>

                                    </small>


                                </div>


                            </div>


                            <span
                                class="ngo-status <?php
                                echo htmlspecialchars(
                                    $verification["statusClass"]
                                );
                                ?>"
                            >

                                <?php
                                echo htmlspecialchars(
                                    $verification["status"]
                                );
                                ?>

                            </span>


                        </div>



                        <!-- DETAILS -->

                        <div class="ngo-verification-details">


                            <div>

                                <span>DONOR</span>

                                <strong>

                                    <?php
                                    echo htmlspecialchars(
                                        $verification["donor"]
                                    );
                                    ?>

                                </strong>

                            </div>


                            <div>

                                <span>ITEMS</span>

                                <strong>

                                    <?php
                                    echo $verification["items"];
                                    ?>

                                </strong>

                            </div>


                            <div>

                                <span>CATEGORY</span>

                                <strong>

                                    <?php
                                    echo htmlspecialchars(
                                        $verification["category"]
                                    );
                                    ?>

                                </strong>

                            </div>


                            <div>

                                <span>CONDITION</span>

                                <strong>

                                    <?php
                                    echo htmlspecialchars(
                                        $verification["condition"]
                                    );
                                    ?>

                                </strong>

                            </div>


                        </div>



                        <!-- RECEIVED DATE -->

                        <div class="ngo-verification-date">


                            <i class="fa-solid fa-calendar-days"></i>


                            Received on:

                            <?php
                            echo htmlspecialchars(
                                $verification["receivedDate"]
                            );
                            ?>


                        </div>



                        <!-- ACTIONS -->

                        <div class="ngo-verification-actions">


                            <?php if (
                                $verification["statusClass"] === "pending"
                            ): ?>


                                <a
                                    href="verification.php?action=approve&id=<?php
                                    echo urlencode(
                                        $verification["id"]
                                    );
                                    ?>"
                                    class="ngo-action-primary"
                                >

                                    <i class="fa-solid fa-check"></i>

                                    APPROVE

                                </a>


                                <a
                                    href="verification.php?action=reject&id=<?php
                                    echo urlencode(
                                        $verification["id"]
                                    );
                                    ?>"
                                    class="ngo-action-danger"
                                >

                                    <i class="fa-solid fa-xmark"></i>

                                    REJECT

                                </a>


                            <?php elseif (
                                $verification["statusClass"] === "approved"
                            ): ?>


                                <a
                                    href="distribution.php?verification=<?php
                                    echo urlencode(
                                        $verification["id"]
                                    );
                                    ?>"
                                    class="ngo-action-primary"
                                >

                                    <i class="fa-solid fa-hand-holding-heart"></i>

                                    SEND TO DISTRIBUTION

                                </a>


                            <?php else: ?>


                                <span class="ngo-completed-action">

                                    <i class="fa-solid fa-circle-xmark"></i>

                                    NOT APPROVED FOR DISTRIBUTION

                                </span>


                            <?php endif; ?>


                        </div>


                    </article>


                <?php endforeach; ?>


            </div>


        <?php else: ?>


            <!-- EMPTY STATE -->

            <div class="ngo-empty-state">


                <div class="empty-orders-icon">

                    <i class="fa-solid fa-magnifying-glass"></i>

                </div>


                <h2>

                    NO RECORDS FOUND

                </h2>


                <p>

                    There are no verification records
                    matching this filter.

                </p>


                <a
                    href="verification.php?filter=all"
                    class="ngo-action-primary"
                >

                    VIEW ALL RECORDS

                </a>


            </div>


        <?php endif; ?>


    </section>


</main>



<!-- PROJECT JAVASCRIPT -->

<script src="../assets/js/ngo.js"></script>


</body>

</html>
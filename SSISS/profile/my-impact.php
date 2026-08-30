<?php

$pageTitle = "My Impact | SSISS";


/* =========================================
   TEMPORARY USER IMPACT DATA

   Later this data will come from MySQL.
========================================= */

$userName = "Alex Johnson";

$totalItemsDonated = 24;

$totalDonations = 6;

$totalCoinsEarned = 520;

$estimatedCO2Saved = 38;

$clothesReused = 24;

$ngoPartnersHelped = 3;


/* =========================================
   IMPACT STATS
========================================= */

$impactStats = [

    [
        "title" => "CLOTHES DONATED",
        "value" => $totalItemsDonated,
        "label" => "ITEMS",
        "icon" => "fa-shirt"
    ],

    [
        "title" => "DONATIONS MADE",
        "value" => $totalDonations,
        "label" => "DONATIONS",
        "icon" => "fa-heart"
    ],

    [
        "title" => "CO₂ SAVED",
        "value" => $estimatedCO2Saved,
        "label" => "KG EST.",
        "icon" => "fa-leaf"
    ],

    [
        "title" => "SSISS COINS",
        "value" => $totalCoinsEarned,
        "label" => "EARNED",
        "icon" => "fa-coins"
    ]

];


/* =========================================
   RECENT IMPACT ACTIVITY
========================================= */

$recentActivities = [

    [
        "title" => "Clothes Donation Completed",
        "description" =>
            "4 clothing items were successfully donated to a verified NGO partner.",
        "date" => "15 March 2026",
        "icon" => "fa-heart",
        "coins" => "+80"
    ],

    [
        "title" => "Items Given a Second Life",
        "description" =>
            "3 pre-loved clothing items were reused instead of going to waste.",
        "date" => "08 March 2026",
        "icon" => "fa-recycle",
        "coins" => "+30"
    ],

    [
        "title" => "Eco Challenge Completed",
        "description" =>
            "You completed the Sustainable Wardrobe Challenge.",
        "date" => "01 March 2026",
        "icon" => "fa-leaf",
        "coins" => "+20"
    ]

];


/* =========================================
   ACHIEVEMENTS
========================================= */

$achievements = [

    [
        "title" => "FIRST DONATION",
        "description" =>
            "Completed your first clothing donation.",
        "icon" => "fa-heart",
        "status" => "unlocked"
    ],

    [
        "title" => "ECO CONTRIBUTOR",
        "description" =>
            "Donated more than 20 clothing items.",
        "icon" => "fa-leaf",
        "status" => "unlocked"
    ],

    [
        "title" => "CIRCULAR FASHION HERO",
        "description" =>
            "Give 50 clothing items a second life.",
        "icon" => "fa-recycle",
        "status" => "locked"
    ]

];


/* =========================================
   MONTHLY IMPACT DATA

   Later this can come from MySQL.
========================================= */

$monthlyImpact = [

    [
        "month" => "JAN",
        "items" => 4
    ],

    [
        "month" => "FEB",
        "items" => 7
    ],

    [
        "month" => "MAR",
        "items" => 13
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


    <!-- PROJECT CSS -->

    <link
        rel="stylesheet"
        href="../assets/css/home.css"
    >

    <link
        rel="stylesheet"
        href="../assets/css/profile.css"
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


        <a
            href="../impact/index.php"
            class="active"
        >

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
            href="index.php"
            class="profile-btn"
        >

            <i class="fa-solid fa-user"></i>

        </a>


    </div>


</header>



<!-- =========================================
     MY IMPACT PAGE
========================================= -->

<main class="my-impact-page">


    <!-- =====================================
         PAGE HEADER
    ====================================== -->

    <section class="impact-header">


        <a
            href="index.php"
            class="back-profile"
        >

            <i class="fa-solid fa-arrow-left"></i>

            BACK TO PROFILE

        </a>


        <p class="section-tag">

            YOUR SUSTAINABLE JOURNEY

        </p>


        <h1>

            MY

            <span>IMPACT.</span>

        </h1>


        <p>

            Every sustainable choice matters.
            See the positive difference you have
            made through your SSISS journey.

        </p>


    </section>



    <!-- =====================================
         IMPACT HERO
    ====================================== -->

    <section class="impact-hero-card">


        <div class="impact-hero-content">


            <span class="impact-hero-tag">

                <i class="fa-solid fa-leaf"></i>

                SUSTAINABILITY SCORE

            </span>


            <h2>

                YOU ARE MAKING A

                <span>DIFFERENCE.</span>

            </h2>


            <p>

                <?php
                echo htmlspecialchars($userName);
                ?>,

                your fashion choices have helped
                reduce waste and give clothing
                a second life.

            </p>


        </div>


        <div class="impact-score">


            <div class="impact-score-circle">


                <strong>

                    82

                </strong>


                <span>

                    / 100

                </span>


            </div>


            <p>

                GREAT IMPACT!

            </p>


        </div>


    </section>



    <!-- =====================================
         IMPACT STATISTICS
    ====================================== -->

    <section class="impact-stats-grid">


        <?php foreach ($impactStats as $stat): ?>


            <article class="impact-stat-card">


                <div class="impact-stat-icon">


                    <i
                        class="fa-solid <?php
                        echo htmlspecialchars(
                            $stat["icon"]
                        );
                        ?>"
                    ></i>


                </div>


                <div class="impact-stat-info">


                    <span>

                        <?php
                        echo htmlspecialchars(
                            $stat["title"]
                        );
                        ?>

                    </span>


                    <strong>

                        <?php
                        echo $stat["value"];
                        ?>

                    </strong>


                    <small>

                        <?php
                        echo htmlspecialchars(
                            $stat["label"]
                        );
                        ?>

                    </small>


                </div>


            </article>


        <?php endforeach; ?>


    </section>



    <!-- =====================================
         ENVIRONMENTAL IMPACT
    ====================================== -->

    <section class="environment-impact-section">


        <div class="section-heading">


            <div>


                <p class="section-tag">

                    POSITIVE CHANGE

                </p>


                <h2>

                    YOUR ENVIRONMENTAL

                    <span>IMPACT.</span>

                </h2>


            </div>


        </div>


        <div class="environment-impact-grid">


            <article class="environment-card">


                <div class="environment-icon">

                    🌍

                </div>


                <h3>

                    LESS TEXTILE WASTE

                </h3>


                <p>

                    <?php
                    echo $clothesReused;
                    ?>

                    clothing items were given
                    another opportunity to be
                    reused instead of discarded.

                </p>


            </article>



            <article class="environment-card">


                <div class="environment-icon">

                    ♻️

                </div>


                <h3>

                    CIRCULAR FASHION

                </h3>


                <p>

                    Your donations help create
                    a more circular fashion
                    ecosystem through reuse
                    and redistribution.

                </p>


            </article>



            <article class="environment-card">


                <div class="environment-icon">

                    🤝

                </div>


                <h3>

                    COMMUNITY SUPPORT

                </h3>


                <p>

                    Your donations have helped
                    support

                    <?php
                    echo $ngoPartnersHelped;
                    ?>

                    NGO partners and their
                    communities.

                </p>


            </article>


        </div>


    </section>



    <!-- =====================================
         MONTHLY PROGRESS
    ====================================== -->

    <section class="monthly-impact-section">


        <div class="section-heading">


            <div>


                <p class="section-tag">

                    YOUR PROGRESS

                </p>


                <h2>

                    MONTHLY

                    <span>IMPACT.</span>

                </h2>


            </div>


        </div>


        <div class="impact-chart-card">


            <div class="chart-header">


                <div>


                    <h3>

                        CLOTHING ITEMS SAVED

                    </h3>


                    <p>

                        Your sustainable contribution
                        over the last three months.

                    </p>


                </div>


            </div>


            <div class="simple-chart">


                <?php foreach ($monthlyImpact as $data): ?>


                    <?php

                    $barHeight =
                        ($data["items"] / 15) * 100;

                    ?>


                    <div class="chart-column">


                        <div class="chart-bar-wrapper">


                            <div
                                class="chart-bar"
                                style="
                                    height:
                                    <?php
                                    echo $barHeight;
                                    ?>
                                    %
                                "
                            >


                                <span>

                                    <?php
                                    echo $data["items"];
                                    ?>

                                </span>


                            </div>


                        </div>


                        <small>

                            <?php
                            echo htmlspecialchars(
                                $data["month"]
                            );
                            ?>

                        </small>


                    </div>


                <?php endforeach; ?>


            </div>


        </div>


    </section>



    <!-- =====================================
         RECENT ACTIVITY
    ====================================== -->

    <section class="impact-activity-section">


        <div class="section-heading">


            <div>


                <p class="section-tag">

                    YOUR JOURNEY

                </p>


                <h2>

                    RECENT

                    <span>ACTIVITY.</span>

                </h2>


            </div>


        </div>


        <div class="impact-activity-list">


            <?php foreach ($recentActivities as $activity): ?>


                <article class="impact-activity-item">


                    <div class="activity-icon">


                        <i
                            class="fa-solid <?php
                            echo htmlspecialchars(
                                $activity["icon"]
                            );
                            ?>"
                        ></i>


                    </div>


                    <div class="activity-content">


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


                        <small>

                            <?php
                            echo htmlspecialchars(
                                $activity["date"]
                            );
                            ?>

                        </small>


                    </div>


                    <div class="activity-coins">


                        🪙

                        <?php
                        echo htmlspecialchars(
                            $activity["coins"]
                        );
                        ?>


                    </div>


                </article>


            <?php endforeach; ?>


        </div>


    </section>



    <!-- =====================================
         ACHIEVEMENTS
    ====================================== -->

    <section class="impact-achievements-section">


        <div class="section-heading">


            <div>


                <p class="section-tag">

                    MILESTONES

                </p>


                <h2>

                    YOUR

                    <span>ACHIEVEMENTS.</span>

                </h2>


            </div>


        </div>


        <div class="impact-achievements-grid">


            <?php foreach ($achievements as $achievement): ?>


                <article
                    class="impact-achievement-card
                    <?php
                    echo htmlspecialchars(
                        $achievement["status"]
                    );
                    ?>"
                >


                    <div class="achievement-icon">


                        <i
                            class="fa-solid <?php
                            echo htmlspecialchars(
                                $achievement["icon"]
                            );
                            ?>"
                        ></i>


                    </div>


                    <h3>

                        <?php
                        echo htmlspecialchars(
                            $achievement["title"]
                        );
                        ?>

                    </h3>


                    <p>

                        <?php
                        echo htmlspecialchars(
                            $achievement["description"]
                        );
                        ?>

                    </p>


                    <?php
                    if (
                        $achievement["status"] ===
                        "unlocked"
                    ):
                    ?>


                        <span class="achievement-status unlocked">

                            <i class="fa-solid fa-check"></i>

                            UNLOCKED

                        </span>


                    <?php else: ?>


                        <span class="achievement-status locked">

                            <i class="fa-solid fa-lock"></i>

                            LOCKED

                        </span>


                    <?php endif; ?>


                </article>


            <?php endforeach; ?>


        </div>


    </section>



    <!-- =====================================
         CTA
    ====================================== -->

    <section class="impact-cta">


        <div>


            <p class="section-tag">

                KEEP GOING

            </p>


            <h2>

                MAKE FASHION

                <span>MATTER MORE.</span>

            </h2>


            <p>

                Donate clothes you no longer wear,
                shop sustainably, and continue
                building your positive impact.

            </p>


        </div>


        <a
            href="../donation/index.php"
            class="generate-outfit-main-btn"
        >

            <i class="fa-solid fa-heart"></i>

            DONATE CLOTHES

        </a>


    </section>


</main>


<!-- JAVASCRIPT -->

<script src="../assets/js/profile.js"></script>


</body>

</html>
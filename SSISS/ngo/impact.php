<?php

$pageTitle = "NGO Impact | SSISS";


/* =========================================
   TEMPORARY IMPACT DATA
   Later replace with MySQL queries
========================================= */

$impactData = [

    "clothesReused" => 518,

    "textileWasteReduced" => 207,

    "waterSaved" => 1295000,

    "co2Reduced" => 3626,

    "peopleHelped" => 214,

    "activeDonors" => 76

];


/* =========================================
   MONTHLY IMPACT DATA
========================================= */

$monthlyImpact = [

    [
        "month" => "January",
        "items" => 58,
        "people" => 24
    ],

    [
        "month" => "February",
        "items" => 89,
        "people" => 38
    ],

    [
        "month" => "March",
        "items" => 127,
        "people" => 52
    ],

    [
        "month" => "April",
        "items" => 83,
        "people" => 36
    ]

];


/* =========================================
   IMPACT STORIES
========================================= */

$impactStories = [

    [
        "title" => "Winter Clothing Support",
        "description" =>
            "Winter clothing donations were distributed to families in need, helping them stay warm during the colder season.",
        "items" => 84,
        "beneficiaries" => 31,
        "icon" => "fa-snowflake"
    ],

    [
        "title" => "Community Clothing Drive",
        "description" =>
            "Clothes collected from local donors were sorted and distributed through community support centres.",
        "items" => 126,
        "beneficiaries" => 54,
        "icon" => "fa-people-group"
    ],

    [
        "title" => "Women Support Initiative",
        "description" =>
            "Essential clothing was provided to women through local support and empowerment centres.",
        "items" => 97,
        "beneficiaries" => 42,
        "icon" => "fa-heart"
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

<main class="ngo-impact-page">


    <!-- =====================================
         PAGE HEADER
    ====================================== -->

    <section class="ngo-page-header">


        <a
            href="index.php"
            class="back-profile"
        >

            <i class="fa-solid fa-arrow-left"></i>

            BACK TO DASHBOARD

        </a>


        <p class="section-tag">

            OUR COLLECTIVE IMPACT

        </p>


        <h1>

            MAKING A

            <span>DIFFERENCE.</span>

        </h1>


        <p>

            Every clothing donation creates a positive
            impact by reducing textile waste, supporting
            communities, and giving clothes a second life.

        </p>


    </section>



    <!-- =====================================
         MAIN IMPACT STATS
    ====================================== -->

    <section class="ngo-impact-stats-grid">


        <!-- CLOTHES REUSED -->

        <article class="ngo-impact-card">


            <div class="ngo-impact-icon">

                <i class="fa-solid fa-shirt"></i>

            </div>


            <span>

                CLOTHES REUSED

            </span>


            <strong>

                <?php
                echo number_format(
                    $impactData["clothesReused"]
                );
                ?>

            </strong>


            <p>

                Clothing items given a second life.

            </p>


        </article>



        <!-- TEXTILE WASTE -->

        <article class="ngo-impact-card">


            <div class="ngo-impact-icon">

                <i class="fa-solid fa-recycle"></i>

            </div>


            <span>

                TEXTILE WASTE REDUCED

            </span>


            <strong>

                <?php
                echo number_format(
                    $impactData["textileWasteReduced"]
                );
                ?>

                KG

            </strong>


            <p>

                Textile waste diverted from landfills.

            </p>


        </article>



        <!-- WATER SAVED -->

        <article class="ngo-impact-card">


            <div class="ngo-impact-icon">

                <i class="fa-solid fa-droplet"></i>

            </div>


            <span>

                WATER SAVED

            </span>


            <strong>

                <?php
                echo number_format(
                    $impactData["waterSaved"]
                );
                ?>

                L

            </strong>


            <p>

                Estimated water conserved through reuse.

            </p>


        </article>



        <!-- CO2 REDUCED -->

        <article class="ngo-impact-card">


            <div class="ngo-impact-icon">

                <i class="fa-solid fa-leaf"></i>

            </div>


            <span>

                CO₂ IMPACT REDUCED

            </span>


            <strong>

                <?php
                echo number_format(
                    $impactData["co2Reduced"]
                );
                ?>

                KG

            </strong>


            <p>

                Estimated carbon emissions reduced.

            </p>


        </article>



        <!-- PEOPLE HELPED -->

        <article class="ngo-impact-card">


            <div class="ngo-impact-icon">

                <i class="fa-solid fa-people-group"></i>

            </div>


            <span>

                PEOPLE HELPED

            </span>


            <strong>

                <?php
                echo number_format(
                    $impactData["peopleHelped"]
                );
                ?>

            </strong>


            <p>

                Individuals supported through donations.

            </p>


        </article>



        <!-- ACTIVE DONORS -->

        <article class="ngo-impact-card">


            <div class="ngo-impact-icon">

                <i class="fa-solid fa-hand-holding-heart"></i>

            </div>


            <span>

                ACTIVE DONORS

            </span>


            <strong>

                <?php
                echo number_format(
                    $impactData["activeDonors"]
                );
                ?>

            </strong>


            <p>

                People contributing to sustainable fashion.

            </p>


        </article>


    </section>



    <!-- =====================================
         IMPACT MESSAGE
    ====================================== -->

    <section class="ngo-impact-message">


        <div class="ngo-impact-message-icon">

            <i class="fa-solid fa-heart"></i>

        </div>


        <div>


            <p class="section-tag">

                TOGETHER WE CREATE CHANGE

            </p>


            <h2>

                SMALL ACTIONS.

                <span>BIG IMPACT.</span>

            </h2>


            <p>

                Through clothing reuse and responsible
                distribution, every donation helps reduce
                environmental waste while supporting people
                and communities who need clothing.

            </p>


        </div>


    </section>



    <!-- =====================================
         MONTHLY IMPACT
    ====================================== -->

    <section class="ngo-impact-section">


        <div class="ngo-section-heading">


            <div>


                <p class="section-tag">

                    MONTHLY CONTRIBUTION

                </p>


                <h2>

                    IMPACT

                    <span>OVER TIME.</span>

                </h2>


            </div>


        </div>



        <div class="ngo-impact-timeline">


            <?php foreach ($monthlyImpact as $impact): ?>


                <article class="ngo-impact-timeline-card">


                    <div class="ngo-impact-month">


                        <?php
                        echo htmlspecialchars(
                            $impact["month"]
                        );
                        ?>

                    </div>


                    <div class="ngo-impact-timeline-data">


                        <div>


                            <i class="fa-solid fa-shirt"></i>


                            <strong>

                                <?php
                                echo $impact["items"];
                                ?>

                            </strong>


                            <span>

                                ITEMS DISTRIBUTED

                            </span>


                        </div>


                        <div>


                            <i class="fa-solid fa-heart"></i>


                            <strong>

                                <?php
                                echo $impact["people"];
                                ?>

                            </strong>


                            <span>

                                PEOPLE HELPED

                            </span>


                        </div>


                    </div>


                </article>


            <?php endforeach; ?>


        </div>


    </section>



    <!-- =====================================
         IMPACT STORIES
    ====================================== -->

    <section class="ngo-impact-section">


        <div class="ngo-section-heading">


            <div>


                <p class="section-tag">

                    COMMUNITY STORIES

                </p>


                <h2>

                    REAL

                    <span>IMPACT.</span>

                </h2>


            </div>


        </div>



        <div class="ngo-impact-stories-grid">


            <?php foreach ($impactStories as $story): ?>


                <article class="ngo-impact-story-card">


                    <div class="ngo-impact-story-icon">


                        <i
                            class="fa-solid <?php
                            echo htmlspecialchars(
                                $story["icon"]
                            );
                            ?>"
                        ></i>


                    </div>


                    <h3>

                        <?php
                        echo htmlspecialchars(
                            $story["title"]
                        );
                        ?>

                    </h3>


                    <p>

                        <?php
                        echo htmlspecialchars(
                            $story["description"]
                        );
                        ?>

                    </p>


                    <div class="ngo-impact-story-stats">


                        <span>

                            <i class="fa-solid fa-shirt"></i>

                            <?php
                            echo $story["items"];
                            ?>

                            ITEMS

                        </span>


                        <span>

                            <i class="fa-solid fa-users"></i>

                            <?php
                            echo $story["beneficiaries"];
                            ?>

                            PEOPLE

                        </span>


                    </div>


                </article>


            <?php endforeach; ?>


        </div>


    </section>



    <!-- =====================================
         CALL TO ACTION
    ====================================== -->

    <section class="ngo-impact-cta">


        <div>


            <p class="section-tag">

                CONTINUE THE MISSION

            </p>


            <h2>

                EVERY DONATION

                <span>MATTERS.</span>

            </h2>


            <p>

                Continue collecting, verifying, and
                distributing clothing to create an even
                bigger impact in the community.

            </p>


        </div>


        <a
            href="donations.php"
            class="ngo-action-primary"
        >

            <i class="fa-solid fa-hand-holding-heart"></i>

            VIEW DONATIONS

        </a>


    </section>


</main>



<!-- PROJECT JAVASCRIPT -->

<script src="../assets/js/ngo.js"></script>


</body>

</html>
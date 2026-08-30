<?php

$pageTitle = "Style DNA | SSISS";


$styleDNA = [

    "primaryStyle" => "Minimal Streetwear",

    "secondaryStyle" => "Modern Casual",

    "colorPreference" => "Neutral & Dark",

    "shoppingVibe" => "Smart & Sustainable",

    "sustainabilityScore" => 82,

    "confidenceScore" => 91

];


$styleTraits = [

    [
        "title" => "MINIMAL",
        "value" => 92,
        "icon" => "fa-minus"
    ],

    [
        "title" => "CASUAL",
        "value" => 88,
        "icon" => "fa-shirt"
    ],

    [
        "title" => "STREETWEAR",
        "value" => 74,
        "icon" => "fa-bolt"
    ],

    [
        "title" => "FORMAL",
        "value" => 42,
        "icon" => "fa-user-tie"
    ],

    [
        "title" => "BOLD",
        "value" => 55,
        "icon" => "fa-fire"
    ]

];


$recommendedCategories = [

    "Oversized Shirts",
    "Minimal Sneakers",
    "Neutral Jackets",
    "Classic Watches",
    "Simple Accessories"

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

    <title><?php echo $pageTitle; ?></title>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    >

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

<header class="navbar">

    <a href="../index.php" class="logo">
        SSI<span>SS</span>
    </a>


    <nav class="nav-links">

        <a href="../index.php">Home</a>

        <a href="../shop/index.php">Shop</a>

        <a href="../ai/index.php">
            AI Stylist
            <span class="sparkle">✦</span>
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

</header>



<main class="style-dna-page">


    <section class="profile-page-header">

        <a href="index.php" class="back-profile">

            <i class="fa-solid fa-arrow-left"></i>

            BACK TO PROFILE

        </a>


        <p class="section-tag">

            AI STYLE ANALYSIS

        </p>


        <h1>

            YOUR STYLE
            <span>DNA.</span>

        </h1>


        <p>

            Your unique fashion identity,
            created from your preferences,
            wardrobe and style choices.

        </p>

    </section>



    <!-- STYLE DNA HERO -->

    <section class="style-dna-hero">


        <div class="dna-icon-large">

            🧬

        </div>


        <div>

            <p class="section-tag">

                YOUR PRIMARY IDENTITY

            </p>


            <h2>

                <?php
                echo htmlspecialchars(
                    $styleDNA["primaryStyle"]
                );
                ?>

            </h2>


            <p>

                Your style combines clean,
                modern fashion with comfortable
                and expressive elements.

            </p>

        </div>


        <div class="dna-confidence">

            <span>
                STYLE MATCH
            </span>

            <strong>

                <?php
                echo $styleDNA["confidenceScore"];
                ?>%

            </strong>

        </div>

    </section>



    <!-- STYLE SUMMARY -->

    <section class="style-dna-summary-grid">


        <article class="style-dna-summary-card">

            <i class="fa-solid fa-wand-magic-sparkles"></i>

            <span>
                PRIMARY STYLE
            </span>

            <strong>

                <?php
                echo htmlspecialchars(
                    $styleDNA["primaryStyle"]
                );
                ?>

            </strong>

        </article>



        <article class="style-dna-summary-card">

            <i class="fa-solid fa-layer-group"></i>

            <span>
                SECONDARY STYLE
            </span>

            <strong>

                <?php
                echo htmlspecialchars(
                    $styleDNA["secondaryStyle"]
                );
                ?>

            </strong>

        </article>



        <article class="style-dna-summary-card">

            <i class="fa-solid fa-palette"></i>

            <span>
                COLOR PREFERENCE
            </span>

            <strong>

                <?php
                echo htmlspecialchars(
                    $styleDNA["colorPreference"]
                );
                ?>

            </strong>

        </article>



        <article class="style-dna-summary-card">

            <i class="fa-solid fa-leaf"></i>

            <span>
                SUSTAINABILITY
            </span>

            <strong>

                <?php
                echo $styleDNA["sustainabilityScore"];
                ?>/100

            </strong>

        </article>

    </section>



    <!-- STYLE TRAITS -->

    <section class="style-traits-section">

        <div class="section-heading">

            <div>

                <p class="section-tag">
                    AI ANALYSIS
                </p>

                <h2>
                    YOUR STYLE
                    <span>TRAITS.</span>
                </h2>

            </div>

        </div>



        <div class="style-traits-list">

            <?php foreach ($styleTraits as $trait): ?>

                <article class="style-trait-card">


                    <div class="style-trait-top">

                        <div>

                            <i
                                class="fa-solid <?php
                                echo htmlspecialchars(
                                    $trait["icon"]
                                );
                                ?>"
                            ></i>


                            <strong>

                                <?php
                                echo htmlspecialchars(
                                    $trait["title"]
                                );
                                ?>

                            </strong>

                        </div>


                        <span>

                            <?php
                            echo $trait["value"];
                            ?>%

                        </span>

                    </div>



                    <div class="style-trait-bar">

                        <div
                            class="style-trait-fill"
                            style="
                                width:
                                <?php
                                echo $trait["value"];
                                ?>%
                            "
                        ></div>

                    </div>

                </article>

            <?php endforeach; ?>

        </div>

    </section>



    <!-- AI RECOMMENDATIONS -->

    <section class="profile-content-section">

        <div class="section-heading">

            <div>

                <p class="section-tag">
                    BASED ON YOUR DNA
                </p>

                <h2>
                    PERFECT FOR
                    <span>YOU.</span>
                </h2>

            </div>

        </div>



        <div class="recommendation-tags">

            <?php foreach ($recommendedCategories as $category): ?>

                <span class="recommendation-tag">

                    <i class="fa-solid fa-check"></i>

                    <?php
                    echo htmlspecialchars($category);
                    ?>

                </span>

            <?php endforeach; ?>

        </div>

    </section>



    <!-- CTA -->

    <section class="profile-cta">

        <div>

            <p class="section-tag">
                POWERED BY YOUR STYLE DNA
            </p>


            <h2>

                GET A LOOK MADE
                <span>FOR YOU.</span>

            </h2>


            <p>

                Let the SSISS AI Stylist
                create personalized outfits
                using your unique Style DNA.

            </p>

        </div>


        <a
            href="../ai/index.php"
            class="generate-outfit-main-btn"
        >

            <i class="fa-solid fa-wand-magic-sparkles"></i>

            GENERATE LOOK

        </a>

    </section>


</main>


<script src="../assets/js/profile.js"></script>

</body>
</html>
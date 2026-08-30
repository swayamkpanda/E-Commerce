<?php

$pageTitle = "Saved Looks | SSISS";


$savedLooks = [

    [
        "id" => 1,
        "name" => "Minimal Street Look",
        "occasion" => "Casual",
        "vibe" => "Minimal",
        "image" => "../assets/images/products/product-1.jpg"
    ],

    [
        "id" => 2,
        "name" => "Weekend Coffee Look",
        "occasion" => "Casual",
        "vibe" => "Relaxed",
        "image" => "../assets/images/products/product-2.jpg"
    ],

    [
        "id" => 3,
        "name" => "Smart College Fit",
        "occasion" => "College",
        "vibe" => "Modern",
        "image" => "../assets/images/products/product-3.jpg"
    ],

    [
        "id" => 4,
        "name" => "Night Out Outfit",
        "occasion" => "Party",
        "vibe" => "Bold",
        "image" => "../assets/images/products/product-4.jpg"
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
        <a href="../ai/index.php">AI Stylist ✦</a>
        <a href="../wardrobe/index.php">Wardrobe</a>
        <a href="../marketplace/index.php">Pre-Loved</a>
        <a href="../impact/index.php">Impact</a>

    </nav>

</header>



<main class="saved-looks-page">

    <section class="profile-page-header">

        <a href="index.php" class="back-profile">

            <i class="fa-solid fa-arrow-left"></i>

            BACK TO PROFILE

        </a>


        <p class="section-tag">
            YOUR STYLE COLLECTION
        </p>


        <h1>
            SAVED <span>LOOKS.</span>
        </h1>


        <p>
            Your favorite AI-generated
            outfits and style inspirations
            saved in one place.
        </p>

    </section>



    <section class="profile-content-section">

        <div class="section-heading">

            <div>

                <p class="section-tag">
                    STYLE INSPIRATION
                </p>

                <h2>
                    YOUR SAVED
                    <span>OUTFITS.</span>
                </h2>

            </div>


            <span class="orders-count">

                <?php echo count($savedLooks); ?>

                SAVED

            </span>

        </div>



        <div class="saved-looks-grid">

            <?php foreach ($savedLooks as $look): ?>

                <article class="saved-look-card">

                    <div class="saved-look-image">

                        <img
                            src="<?php echo htmlspecialchars($look["image"]); ?>"
                            alt="<?php echo htmlspecialchars($look["name"]); ?>"
                        >


                        <button
                            type="button"
                            class="remove-look-btn"
                        >

                            <i class="fa-solid fa-trash"></i>

                        </button>

                    </div>


                    <div class="saved-look-content">

                        <div>

                            <span class="look-vibe">

                                <?php
                                echo htmlspecialchars($look["vibe"]);
                                ?>

                            </span>


                            <h3>

                                <?php
                                echo htmlspecialchars($look["name"]);
                                ?>

                            </h3>


                            <p>

                                <?php
                                echo htmlspecialchars($look["occasion"]);
                                ?>

                            </p>

                        </div>


                        <a
                            href="../ai/index.php"
                            class="saved-look-action"
                        >

                            VIEW LOOK

                            <i class="fa-solid fa-arrow-right"></i>

                        </a>

                    </div>

                </article>

            <?php endforeach; ?>

        </div>

    </section>



    <section class="profile-cta">

        <div>

            <p class="section-tag">
                NEED MORE IDEAS?
            </p>

            <h2>
                CREATE YOUR NEXT
                <span>PERFECT LOOK.</span>
            </h2>

            <p>
                Let SSISS AI Stylist create
                personalized outfits based
                on your vibe and preferences.
            </p>

        </div>


        <a
            href="../ai/index.php"
            class="generate-outfit-main-btn"
        >

            <i class="fa-solid fa-wand-magic-sparkles"></i>

            AI STYLIST

        </a>

    </section>

</main>


<script src="../assets/js/profile.js"></script>

</body>
</html>     
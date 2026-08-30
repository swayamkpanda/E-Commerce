<?php

$pageTitle = "Generate Outfit | SSISS";


/* =========================================
   TEMPORARY WARDROBE DATA

   Later this will come from MySQL.
========================================= */

$wardrobeItems = [

    [
        "id" => 1,
        "name" => "Black Oversized T-Shirt",
        "category" => "Tops",
        "color" => "Black",
        "season" => "All Season",
        "style" => "Streetwear",
        "image" =>
            "https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=800&q=80"
    ],

    [
        "id" => 2,
        "name" => "Blue Denim Jacket",
        "category" => "Outerwear",
        "color" => "Blue",
        "season" => "Winter",
        "style" => "Casual",
        "image" =>
            "https://images.unsplash.com/photo-1529139574466-a303027c1d8b?auto=format&fit=crop&w=800&q=80"
    ],

    [
        "id" => 3,
        "name" => "White Sneakers",
        "category" => "Shoes",
        "color" => "White",
        "season" => "All Season",
        "style" => "Minimal",
        "image" =>
            "https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=800&q=80"
    ],

    [
        "id" => 4,
        "name" => "Black Cargo Pants",
        "category" => "Bottoms",
        "color" => "Black",
        "season" => "All Season",
        "style" => "Streetwear",
        "image" =>
            "https://images.unsplash.com/photo-1473966968600-fa801b869a1a?auto=format&fit=crop&w=800&q=80"
    ],

    [
        "id" => 5,
        "name" => "White Casual Shirt",
        "category" => "Tops",
        "color" => "White",
        "season" => "Summer",
        "style" => "Casual",
        "image" =>
            "https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?auto=format&fit=crop&w=800&q=80"
    ],

    [
        "id" => 6,
        "name" => "Brown Leather Boots",
        "category" => "Shoes",
        "color" => "Brown",
        "season" => "Winter",
        "style" => "Vintage",
        "image" =>
            "https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=800&q=80"
    ],

    [
        "id" => 7,
        "name" => "Silver Watch",
        "category" => "Accessories",
        "color" => "Silver",
        "season" => "All Season",
        "style" => "Minimal",
        "image" =>
            "https://images.unsplash.com/photo-1524805444758-089113d48a6d?auto=format&fit=crop&w=800&q=80"
    ]

];


/* =========================================
   FILTER ITEMS BY CATEGORY
========================================= */

function getItemsByCategory(
    $items,
    $category
) {

    return array_values(
        array_filter(
            $items,
            function ($item) use ($category) {

                return strtolower(
                    $item["category"]
                ) === strtolower(
                    $category
                );

            }
        )
    );

}


$tops = getItemsByCategory(
    $wardrobeItems,
    "Tops"
);


$bottoms = getItemsByCategory(
    $wardrobeItems,
    "Bottoms"
);


$outerwear = getItemsByCategory(
    $wardrobeItems,
    "Outerwear"
);


$shoes = getItemsByCategory(
    $wardrobeItems,
    "Shoes"
);


$accessories = getItemsByCategory(
    $wardrobeItems,
    "Accessories"
);


/* =========================================
   OUTFIT GENERATION
========================================= */

$generatedOutfit = null;


if ($_SERVER["REQUEST_METHOD"] === "POST") {


    $occasion = trim(
        $_POST["occasion"] ?? ""
    );


    $vibe = trim(
        $_POST["vibe"] ?? ""
    );


    $season = trim(
        $_POST["season"] ?? ""
    );


    /*
     * Select random items.
     * Later AI will decide these.
     */

    if (
        !empty($tops) &&
        !empty($bottoms) &&
        !empty($shoes)
    ) {


        $generatedOutfit = [

            "top" =>
                $tops[
                    array_rand($tops)
                ],

            "bottom" =>
                $bottoms[
                    array_rand($bottoms)
                ],

            "shoes" =>
                $shoes[
                    array_rand($shoes)
                ],

            "outerwear" =>
                !empty($outerwear)
                    ? $outerwear[
                        array_rand($outerwear)
                    ]
                    : null,

            "accessory" =>
                !empty($accessories)
                    ? $accessories[
                        array_rand($accessories)
                    ]
                    : null

        ];

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


    <!-- CSS -->

    <link
        rel="stylesheet"
        href="../assets/css/home.css"
    >

    <link
        rel="stylesheet"
        href="../assets/css/wardrobe.css"
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


        <a
            href="index.php"
            class="nav-active"
        >
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

            <span class="wishlist-count">
                0
            </span>

        </a>


        <a
            href="../cart/index.php"
            class="icon-btn"
        >

            <i class="fa-solid fa-bag-shopping"></i>

            <span class="cart-count">
                0
            </span>

        </a>


        <a
            href="../auth/login.php"
            class="profile-btn"
        >

            <i class="fa-regular fa-user"></i>

        </a>


    </div>


</header>



<!-- =========================================
     OUTFIT GENERATOR
========================================= -->

<main class="outfit-page">


    <!-- HERO -->

    <section class="outfit-header">


        <a
            href="index.php"
            class="back-wardrobe"
        >

            <i class="fa-solid fa-arrow-left"></i>

            BACK TO WARDROBE

        </a>


        <p class="section-tag">

            AI POWERED WARDROBE

        </p>


        <h1>

            CREATE YOUR

            <span>OUTFIT.</span>

        </h1>


        <p>

            Tell SSISS what you're dressing for
            and we'll create an outfit using
            clothes you already own.

        </p>


    </section>



    <!-- =====================================
         OUTFIT PREFERENCES
    ====================================== -->

    <section class="outfit-preferences">


        <form
            action="outfit.php"
            method="POST"
            id="outfitForm"
        >


            <div class="outfit-form-grid">


                <!-- OCCASION -->

                <div class="form-group">


                    <label for="occasion">

                        WHAT'S THE OCCASION?

                    </label>


                    <select
                        name="occasion"
                        id="occasion"
                    >

                        <option value="Casual">

                            CASUAL DAY

                        </option>


                        <option value="College">

                            COLLEGE

                        </option>


                        <option value="Work">

                            WORK / OFFICE

                        </option>


                        <option value="Party">

                            PARTY

                        </option>


                        <option value="Date">

                            DATE NIGHT

                        </option>


                        <option value="Travel">

                            TRAVEL

                        </option>


                    </select>


                </div>



                <!-- VIBE -->

                <div class="form-group">


                    <label for="vibe">

                        CHOOSE YOUR VIBE

                    </label>


                    <select
                        name="vibe"
                        id="vibe"
                    >

                        <option value="Casual">

                            CASUAL

                        </option>


                        <option value="Streetwear">

                            STREETWEAR

                        </option>


                        <option value="Minimal">

                            MINIMAL

                        </option>


                        <option value="Formal">

                            FORMAL

                        </option>


                        <option value="Vintage">

                            VINTAGE

                        </option>


                        <option value="Sporty">

                            SPORTY

                        </option>


                    </select>


                </div>



                <!-- SEASON -->

                <div class="form-group">


                    <label for="season">

                        CURRENT SEASON

                    </label>


                    <select
                        name="season"
                        id="season"
                    >

                        <option value="All Season">

                            ALL SEASON

                        </option>


                        <option value="Summer">

                            SUMMER

                        </option>


                        <option value="Winter">

                            WINTER

                        </option>


                        <option value="Monsoon">

                            MONSOON

                        </option>


                    </select>


                </div>


            </div>



            <button
                type="submit"
                class="generate-outfit-main-btn"
            >

                ✦ GENERATE MY OUTFIT

            </button>


        </form>


    </section>



    <!-- =====================================
         GENERATED OUTFIT
    ====================================== -->

    <?php if ($generatedOutfit !== null): ?>


        <section class="generated-outfit-section">


            <div class="generated-outfit-title">


                <p class="section-tag">

                    YOUR SSISS LOOK

                </p>


                <h2>

                    HERE'S YOUR

                    <span>OUTFIT.</span>

                </h2>


                <p>

                    A combination selected from
                    your personal wardrobe.

                </p>


            </div>



            <!-- OUTFIT GRID -->

            <div class="outfit-items-grid">


                <!-- TOP -->

                <article class="outfit-item-card">


                    <div class="outfit-item-image">


                        <img
                            src="<?php
                            echo htmlspecialchars(
                                $generatedOutfit["top"]["image"]
                            );
                            ?>"
                            alt="<?php
                            echo htmlspecialchars(
                                $generatedOutfit["top"]["name"]
                            );
                            ?>"
                        >


                    </div>


                    <div class="outfit-item-info">


                        <span>

                            TOP

                        </span>


                        <h3>

                            <?php
                            echo htmlspecialchars(
                                $generatedOutfit["top"]["name"]
                            );
                            ?>

                        </h3>


                    </div>


                </article>



                <!-- BOTTOM -->

                <article class="outfit-item-card">


                    <div class="outfit-item-image">


                        <img
                            src="<?php
                            echo htmlspecialchars(
                                $generatedOutfit["bottom"]["image"]
                            );
                            ?>"
                            alt="<?php
                            echo htmlspecialchars(
                                $generatedOutfit["bottom"]["name"]
                            );
                            ?>"
                        >


                    </div>


                    <div class="outfit-item-info">


                        <span>

                            BOTTOM

                        </span>


                        <h3>

                            <?php
                            echo htmlspecialchars(
                                $generatedOutfit["bottom"]["name"]
                            );
                            ?>

                        </h3>


                    </div>


                </article>



                <!-- SHOES -->

                <article class="outfit-item-card">


                    <div class="outfit-item-image">


                        <img
                            src="<?php
                            echo htmlspecialchars(
                                $generatedOutfit["shoes"]["image"]
                            );
                            ?>"
                            alt="<?php
                            echo htmlspecialchars(
                                $generatedOutfit["shoes"]["name"]
                            );
                            ?>"
                        >


                    </div>


                    <div class="outfit-item-info">


                        <span>

                            SHOES

                        </span>


                        <h3>

                            <?php
                            echo htmlspecialchars(
                                $generatedOutfit["shoes"]["name"]
                            );
                            ?>

                        </h3>


                    </div>


                </article>



                <!-- OUTERWEAR -->

                <?php
                if (
                    $generatedOutfit["outerwear"]
                    !== null
                ):
                ?>


                    <article class="outfit-item-card">


                        <div class="outfit-item-image">


                            <img
                                src="<?php
                                echo htmlspecialchars(
                                    $generatedOutfit[
                                        "outerwear"
                                    ]["image"]
                                );
                                ?>"
                                alt="<?php
                                echo htmlspecialchars(
                                    $generatedOutfit[
                                        "outerwear"
                                    ]["name"]
                                );
                                ?>"
                            >


                        </div>


                        <div class="outfit-item-info">


                            <span>

                                OUTERWEAR

                            </span>


                            <h3>

                                <?php
                                echo htmlspecialchars(
                                    $generatedOutfit[
                                        "outerwear"
                                    ]["name"]
                                );
                                ?>

                            </h3>


                        </div>


                    </article>


                <?php endif; ?>



                <!-- ACCESSORY -->

                <?php
                if (
                    $generatedOutfit["accessory"]
                    !== null
                ):
                ?>


                    <article class="outfit-item-card">


                        <div class="outfit-item-image">


                            <img
                                src="<?php
                                echo htmlspecialchars(
                                    $generatedOutfit[
                                        "accessory"
                                    ]["image"]
                                );
                                ?>"
                                alt="<?php
                                echo htmlspecialchars(
                                    $generatedOutfit[
                                        "accessory"
                                    ]["name"]
                                );
                                ?>"
                            >


                        </div>


                        <div class="outfit-item-info">


                            <span>

                                ACCESSORY

                            </span>


                            <h3>

                                <?php
                                echo htmlspecialchars(
                                    $generatedOutfit[
                                        "accessory"
                                    ]["name"]
                                );
                                ?>

                            </h3>


                        </div>


                    </article>


                <?php endif; ?>


            </div>



            <!-- AI EXPLANATION -->

            <div class="outfit-ai-note">


                <div class="ai-note-icon">

                    ✦

                </div>


                <div>


                    <strong>

                        WHY THIS OUTFIT?

                    </strong>


                    <p>

                        This combination balances
                        your selected vibe and season
                        using items already available
                        in your wardrobe.

                    </p>


                </div>


            </div>



            <!-- ACTIONS -->

            <div class="generated-outfit-actions">


                <a
                    href="outfit.php"
                    class="generate-again-btn"
                >

                    <i class="fa-solid fa-rotate"></i>

                    GENERATE AGAIN

                </a>


                <a
                    href="../ai/index.php"
                    class="ask-ai-btn"
                >

                    ✦ ASK AI STYLIST

                </a>


            </div>


        </section>


    <?php endif; ?>


</main>



<script src="../assets/js/wardrobe.js"></script>


</body>

</html>
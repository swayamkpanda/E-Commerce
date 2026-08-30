<?php

$pageTitle = "Restyle Your Item | SSISS";


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
   GET ITEM BY ID
========================================= */

$selectedItemId = isset($_GET["id"])
    ? (int) $_GET["id"]
    : 0;


$selectedItem = null;


foreach ($wardrobeItems as $item) {

    if ($item["id"] === $selectedItemId) {

        $selectedItem = $item;

        break;

    }

}


/* =========================================
   RESTYLE RESULT
========================================= */

$restyleResults = [];


if (
    $_SERVER["REQUEST_METHOD"] === "POST"
) {


    $selectedItemId = isset($_POST["item_id"])
        ? (int) $_POST["item_id"]
        : 0;


    foreach ($wardrobeItems as $item) {

        if ($item["id"] === $selectedItemId) {

            $selectedItem = $item;

            break;

        }

    }


    /*
     * Get other wardrobe items
     */

    $otherItems = array_filter(
        $wardrobeItems,
        function ($item) use ($selectedItemId) {

            return $item["id"] !==
                $selectedItemId;

        }
    );


    $otherItems = array_values(
        $otherItems
    );


    /*
     * Generate different styling ideas.
     *
     * Later this can be replaced
     * with an AI API.
     */

    if (!empty($selectedItem)) {


        $styleIdeas = [

            [
                "title" => "CASUAL LOOK",
                "description" =>
                    "A comfortable everyday outfit built around your selected item."
            ],

            [
                "title" => "STREET STYLE",
                "description" =>
                    "A bold and relaxed combination with a modern streetwear feel."
            ],

            [
                "title" => "MINIMAL LOOK",
                "description" =>
                    "A clean and simple outfit that keeps the focus on your selected item."
            ]

        ];


        foreach ($styleIdeas as $index => $idea) {


            $suggestedItems = [];


            if (!empty($otherItems)) {


                shuffle($otherItems);


                $suggestedItems =
                    array_slice(
                        $otherItems,
                        0,
                        min(
                            3,
                            count($otherItems)
                        )
                    );

            }


            $restyleResults[] = [

                "title" =>
                    $idea["title"],

                "description" =>
                    $idea["description"],

                "items" =>
                    $suggestedItems

            ];

        }

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

        </a>


        <a
            href="../cart/index.php"
            class="icon-btn"
        >

            <i class="fa-solid fa-bag-shopping"></i>

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
     RESTYLE PAGE
========================================= -->

<main class="restyle-page">


    <!-- HEADER -->

    <section class="restyle-header">


        <a
            href="index.php"
            class="back-wardrobe"
        >

            <i class="fa-solid fa-arrow-left"></i>

            BACK TO WARDROBE

        </a>


        <p class="section-tag">

            STYLE WHAT YOU ALREADY OWN

        </p>


        <h1>

            RESTYLE YOUR

            <span>FAVORITES.</span>

        </h1>


        <p>

            Choose an item from your wardrobe
            and discover new ways to wear it.

        </p>


    </section>



    <!-- =====================================
         ITEM SELECTION
    ====================================== -->

    <section class="restyle-selection">


        <form
            action="restyle.php"
            method="POST"
            id="restyleForm"
        >


            <div class="form-group">


                <label for="item_id">

                    SELECT AN ITEM TO RESTYLE

                </label>


                <select
                    name="item_id"
                    id="item_id"
                    required
                >


                    <option value="">

                        CHOOSE FROM YOUR WARDROBE

                    </option>


                    <?php
                    foreach (
                        $wardrobeItems as $item
                    ):
                    ?>


                        <option
                            value="<?php
                            echo $item["id"];
                            ?>"

                            <?php
                            echo (
                                $selectedItem !== null &&
                                $selectedItem["id"] ===
                                $item["id"]
                            )
                                ? "selected"
                                : "";
                            ?>
                        >

                            <?php
                            echo htmlspecialchars(
                                $item["name"]
                            );
                            ?>

                            —

                            <?php
                            echo htmlspecialchars(
                                $item["category"]
                            );
                            ?>


                        </option>


                    <?php endforeach; ?>


                </select>


            </div>



            <button
                type="submit"
                class="generate-outfit-main-btn"
            >

                ✦ RESTYLE THIS ITEM

            </button>


        </form>


    </section>



    <!-- =====================================
         SELECTED ITEM
    ====================================== -->

    <?php
    if (
        $selectedItem !== null
    ):
    ?>


        <section class="selected-restyle-item">


            <div class="selected-restyle-image">


                <img
                    src="<?php
                    echo htmlspecialchars(
                        $selectedItem["image"]
                    );
                    ?>"

                    alt="<?php
                    echo htmlspecialchars(
                        $selectedItem["name"]
                    );
                    ?>"
                >


            </div>


            <div class="selected-restyle-info">


                <p class="section-tag">

                    YOUR SELECTED ITEM

                </p>


                <h2>

                    <?php
                    echo htmlspecialchars(
                        $selectedItem["name"]
                    );
                    ?>

                </h2>


                <p>

                    <?php
                    echo htmlspecialchars(
                        $selectedItem["category"]
                    );
                    ?>

                    ·

                    <?php
                    echo htmlspecialchars(
                        $selectedItem["color"]
                    );
                    ?>

                    ·

                    <?php
                    echo htmlspecialchars(
                        $selectedItem["style"]
                    );
                    ?>

                </p>


            </div>


        </section>


    <?php endif; ?>



    <!-- =====================================
         RESTYLE RESULTS
    ====================================== -->

    <?php
    if (
        !empty($restyleResults)
    ):
    ?>


        <section class="restyle-results">


            <div class="generated-outfit-title">


                <p class="section-tag">

                    NEW WAYS TO WEAR IT

                </p>


                <h2>

                    3 WAYS TO

                    <span>RESTYLE IT.</span>

                </h2>


                <p>

                    Mix your selected item
                    with other pieces from
                    your digital wardrobe.

                </p>


            </div>



            <div class="restyle-results-grid">


                <?php
                foreach (
                    $restyleResults as $result
                ):
                ?>


                    <article class="restyle-card">


                        <div class="restyle-card-header">


                            <span>

                                ✦

                            </span>


                            <h3>

                                <?php
                                echo htmlspecialchars(
                                    $result["title"]
                                );
                                ?>

                            </h3>


                        </div>


                        <p>

                            <?php
                            echo htmlspecialchars(
                                $result["description"]
                            );
                            ?>

                        </p>



                        <!-- SELECTED ITEM -->

                        <div class="restyle-selected-item">


                            <img
                                src="<?php
                                echo htmlspecialchars(
                                    $selectedItem[
                                        "image"
                                    ]
                                );
                                ?>"
                                alt="<?php
                                echo htmlspecialchars(
                                    $selectedItem[
                                        "name"
                                    ]
                                );
                                ?>"
                            >


                            <span>

                                <?php
                                echo htmlspecialchars(
                                    $selectedItem[
                                        "name"
                                    ]
                                );
                                ?>

                            </span>


                        </div>



                        <!-- SUGGESTED ITEMS -->

                        <div class="restyle-suggested-items">


                            <?php
                            foreach (
                                $result["items"]
                                as $suggestedItem
                            ):
                            ?>


                                <div
                                    class="restyle-suggested-item"
                                >


                                    <img
                                        src="<?php
                                        echo htmlspecialchars(
                                            $suggestedItem[
                                                "image"
                                            ]
                                        );
                                        ?>"
                                        alt="<?php
                                        echo htmlspecialchars(
                                            $suggestedItem[
                                                "name"
                                            ]
                                        );
                                        ?>"
                                    >


                                    <span>

                                        <?php
                                        echo htmlspecialchars(
                                            $suggestedItem[
                                                "name"
                                            ]
                                        );
                                        ?>

                                    </span>


                                </div>


                            <?php endforeach; ?>


                        </div>


                    </article>


                <?php endforeach; ?>


            </div>


        </section>


    <?php endif; ?>


</main>


<script src="../assets/js/wardrobe.js"></script>


</body>

</html>
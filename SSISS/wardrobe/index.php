<?php

$pageTitle = "My Wardrobe | SSISS";


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
        <?php echo $pageTitle; ?>
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
            <span class="sparkle">✦</span>
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
     WARDROBE PAGE
========================================= -->

<main class="wardrobe-page">


    <!-- HERO -->

    <section class="wardrobe-hero">


        <div class="wardrobe-hero-content">


            <p class="section-tag">

                YOUR PERSONAL COLLECTION

            </p>


            <h1>

                MY

                <span>DIGITAL WARDROBE.</span>

            </h1>


            <p>

                Add the clothes you already own
                and let SSISS AI create outfits
                around your personal style.

            </p>


            <div class="wardrobe-hero-actions">


                <a
                    href="add.php"
                    class="add-wardrobe-btn"
                >

                    <i class="fa-solid fa-plus"></i>

                    ADD TO WARDROBE

                </a>


                <a
                    href="outfit.php"
                    class="generate-outfit-btn"
                >

                    ✦ GENERATE OUTFIT

                </a>


            </div>


        </div>



        <div class="wardrobe-stat-card">


            <i class="fa-solid fa-shirt"></i>


            <strong>

                <?php
                echo count($wardrobeItems);
                ?>

            </strong>


            <span>

                ITEMS IN YOUR WARDROBE

            </span>


        </div>


    </section>



    <!-- =====================================
         FILTER BAR
    ====================================== -->

    <section class="wardrobe-controls">


        <div class="wardrobe-categories">


            <button
                class="wardrobe-filter active"
                data-category="all"
            >
                ALL
            </button>


            <button
                class="wardrobe-filter"
                data-category="Tops"
            >
                TOPS
            </button>


            <button
                class="wardrobe-filter"
                data-category="Bottoms"
            >
                BOTTOMS
            </button>


            <button
                class="wardrobe-filter"
                data-category="Outerwear"
            >
                OUTERWEAR
            </button>


            <button
                class="wardrobe-filter"
                data-category="Shoes"
            >
                SHOES
            </button>


            <button
                class="wardrobe-filter"
                data-category="Accessories"
            >
                ACCESSORIES
            </button>


        </div>


        <div class="wardrobe-search">


            <i class="fa-solid fa-magnifying-glass"></i>


            <input
                type="text"
                id="wardrobeSearch"
                placeholder="SEARCH YOUR WARDROBE"
            >


        </div>


    </section>



    <!-- =====================================
         WARDROBE GRID
    ====================================== -->

    <section
        class="wardrobe-grid"
        id="wardrobeGrid"
    >


        <?php foreach ($wardrobeItems as $item): ?>


            <article
                class="wardrobe-card"
                data-category="<?php
                echo htmlspecialchars(
                    $item["category"]
                );
                ?>"
            >


                <!-- IMAGE -->

                <div class="wardrobe-image">


                    <img
                        src="<?php
                        echo htmlspecialchars(
                            $item["image"]
                        );
                        ?>"

                        alt="<?php
                        echo htmlspecialchars(
                            $item["name"]
                        );
                        ?>"
                    >


                    <div class="wardrobe-actions">


                        <a
                            href="edit.php?id=<?php
                            echo $item["id"];
                            ?>"
                            title="Edit Item"
                        >

                            <i class="fa-solid fa-pen"></i>

                        </a>


                        <a
                            href="delete.php?id=<?php
                            echo $item["id"];
                            ?>"
                            class="delete-item"
                            title="Delete Item"
                        >

                            <i class="fa-solid fa-trash"></i>

                        </a>


                    </div>


                </div>



                <!-- INFO -->

                <div class="wardrobe-info">


                    <div class="wardrobe-category">

                        <?php
                        echo strtoupper(
                            htmlspecialchars(
                                $item["category"]
                            )
                        );
                        ?>

                    </div>


                    <h2>

                        <?php
                        echo htmlspecialchars(
                            $item["name"]
                        );
                        ?>

                    </h2>


                    <div class="wardrobe-tags">


                        <span>

                            <?php
                            echo htmlspecialchars(
                                $item["color"]
                            );
                            ?>

                        </span>


                        <span>

                            <?php
                            echo htmlspecialchars(
                                $item["season"]
                            );
                            ?>

                        </span>


                        <span>

                            <?php
                            echo htmlspecialchars(
                                $item["style"]
                            );
                            ?>

                        </span>


                    </div>


                </div>


            </article>


        <?php endforeach; ?>


    </section>



    <!-- EMPTY STATE -->

    <div
        class="wardrobe-empty"
        id="wardrobeEmpty"
        style="display: none;"
    >


        <i class="fa-solid fa-shirt"></i>


        <h2>

            NO ITEMS FOUND

        </h2>


        <p>

            Try another category or
            add a new item to your wardrobe.

        </p>


        <a
            href="add.php"
            class="add-wardrobe-btn"
        >

            ADD YOUR FIRST ITEM

        </a>


    </div>


</main>



<script src="../assets/js/wardrobe.js"></script>

</body>

</html>
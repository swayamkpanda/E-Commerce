<?php

$pageTitle = "Edit Wardrobe Item | SSISS";


/* =========================================
   GET ITEM ID
========================================= */

$itemId = isset($_GET["id"])
    ? (int) $_GET["id"]
    : 0;


/* =========================================
   TEMPORARY WARDROBE DATA

   Later replace this with MySQL.
========================================= */

$wardrobeItems = [

    [
        "id" => 1,
        "name" => "Black Oversized T-Shirt",
        "category" => "Tops",
        "color" => "Black",
        "season" => "All Season",
        "style" => "Streetwear",
        "description" =>
            "Comfortable oversized black t-shirt.",
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
        "description" =>
            "Classic blue denim jacket for casual outfits.",
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
        "description" =>
            "Clean white sneakers for everyday outfits.",
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
        "description" =>
            "Relaxed fit black cargo pants.",
        "image" =>
            "https://images.unsplash.com/photo-1473966968600-fa801b869a1a?auto=format&fit=crop&w=800&q=80"
    ]

];


/* =========================================
   FIND SELECTED ITEM
========================================= */

$item = null;


foreach ($wardrobeItems as $wardrobeItem) {

    if ($wardrobeItem["id"] === $itemId) {

        $item = $wardrobeItem;

        break;

    }

}


/* =========================================
   HANDLE INVALID ITEM
========================================= */

if ($item === null) {

    header(
        "Location: index.php?error=item_not_found"
    );

    exit;

}


/* =========================================
   HANDLE FORM SUBMISSION

   Database saving will be added later.
========================================= */

$successMessage = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {


    /*
     * Get form data
     */

    $itemName = trim(
        $_POST["item_name"] ?? ""
    );

    $category = trim(
        $_POST["category"] ?? ""
    );

    $color = trim(
        $_POST["color"] ?? ""
    );

    $season = trim(
        $_POST["season"] ?? ""
    );

    $style = trim(
        $_POST["style"] ?? ""
    );

    $description = trim(
        $_POST["description"] ?? ""
    );


    /*
     * Basic validation
     */

    if (
        $itemName === "" ||
        $category === "" ||
        $color === "" ||
        $season === "" ||
        $style === ""
    ) {

        $errorMessage =
            "Please fill in all required fields.";

    } else {


        /*
         * TEMPORARY SUCCESS

         * Later:
         *
         * UPDATE wardrobe_items
         * SET ...
         * WHERE id = ?
         */

        $successMessage =
            "Your wardrobe item has been updated successfully!";


        /*
         * Update local display values
         */

        $item["name"] =
            $itemName;

        $item["category"] =
            $category;

        $item["color"] =
            $color;

        $item["season"] =
            $season;

        $item["style"] =
            $style;

        $item["description"] =
            $description;

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
     EDIT WARDROBE PAGE
========================================= -->

<main class="add-wardrobe-page">


    <!-- PAGE HEADER -->

    <section class="add-wardrobe-header">


        <a
            href="index.php"
            class="back-wardrobe"
        >

            <i class="fa-solid fa-arrow-left"></i>

            BACK TO WARDROBE

        </a>


        <p class="section-tag">

            UPDATE YOUR COLLECTION

        </p>


        <h1>

            EDIT YOUR

            <span>ITEM.</span>

        </h1>


        <p>

            Update the details of your wardrobe
            item to keep your digital wardrobe
            accurate and organized.

        </p>


    </section>



    <!-- SUCCESS MESSAGE -->

    <?php if (!empty($successMessage)): ?>


        <div class="wardrobe-message success-message">

            <i class="fa-solid fa-circle-check"></i>

            <?php
            echo htmlspecialchars(
                $successMessage
            );
            ?>

        </div>


    <?php endif; ?>



    <!-- ERROR MESSAGE -->

    <?php if (!empty($errorMessage)): ?>


        <div class="wardrobe-message error-message">

            <i class="fa-solid fa-circle-exclamation"></i>

            <?php
            echo htmlspecialchars(
                $errorMessage
            );
            ?>

        </div>


    <?php endif; ?>



    <!-- =====================================
         EDIT FORM
    ====================================== -->

    <section class="add-wardrobe-container">


        <form
            action="edit.php?id=<?php
            echo $item["id"];
            ?>"
            method="POST"
            enctype="multipart/form-data"
            id="editWardrobeForm"
        >


            <!-- =============================
                 LEFT SIDE - IMAGE
            ============================== -->

            <div class="upload-section">


                <p class="form-section-title">

                    01 — ITEM PHOTO

                </p>


                <label
                    for="wardrobeImage"
                    class="image-upload-box"
                    id="imageUploadBox"
                >


                    <input
                        type="file"
                        id="wardrobeImage"
                        name="wardrobe_image"
                        accept="image/*"
                        hidden
                    >


                    <div
                        class="image-preview-wrapper edit-preview"
                        id="imagePreviewWrapper"
                    >


                        <img
                            id="imagePreview"
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


                        <button
                            type="button"
                            class="remove-image-btn"
                            id="removeImage"
                        >

                            <i class="fa-solid fa-xmark"></i>

                        </button>


                    </div>


                </label>


                <p class="upload-tip">

                    💡 Click the image to upload
                    a new photo.

                </p>


            </div>



            <!-- =============================
                 RIGHT SIDE - DETAILS
            ============================== -->

            <div class="wardrobe-form-details">


                <p class="form-section-title">

                    02 — ITEM DETAILS

                </p>



                <!-- ITEM NAME -->

                <div class="form-group">


                    <label for="itemName">

                        ITEM NAME

                    </label>


                    <input
                        type="text"
                        id="itemName"
                        name="item_name"
                        value="<?php
                        echo htmlspecialchars(
                            $item["name"]
                        );
                        ?>"
                        required
                    >


                </div>



                <!-- CATEGORY -->

                <div class="form-group">


                    <label for="category">

                        CATEGORY

                    </label>


                    <select
                        id="category"
                        name="category"
                        required
                    >


                        <?php

                        $categories = [

                            "Tops",
                            "Bottoms",
                            "Outerwear",
                            "Dresses",
                            "Shoes",
                            "Accessories"

                        ];


                        foreach (
                            $categories as $categoryOption
                        ):
                        ?>


                            <option
                                value="<?php
                                echo $categoryOption;
                                ?>"

                                <?php
                                echo $item["category"] ===
                                    $categoryOption
                                    ? "selected"
                                    : "";
                                ?>
                            >

                                <?php
                                echo strtoupper(
                                    $categoryOption
                                );
                                ?>

                            </option>


                        <?php endforeach; ?>


                    </select>


                </div>



                <!-- COLOR + SEASON -->

                <div class="form-row">


                    <!-- COLOR -->

                    <div class="form-group">


                        <label for="color">

                            COLOR

                        </label>


                        <select
                            id="color"
                            name="color"
                            required
                        >


                            <?php

                            $colors = [

                                "Black",
                                "White",
                                "Blue",
                                "Red",
                                "Green",
                                "Brown",
                                "Grey",
                                "Beige",
                                "Multicolor"

                            ];


                            foreach (
                                $colors as $colorOption
                            ):
                            ?>


                                <option
                                    value="<?php
                                    echo $colorOption;
                                    ?>"

                                    <?php
                                    echo $item["color"] ===
                                        $colorOption
                                        ? "selected"
                                        : "";
                                    ?>
                                >

                                    <?php
                                    echo strtoupper(
                                        $colorOption
                                    );
                                    ?>

                                </option>


                            <?php endforeach; ?>


                        </select>


                    </div>



                    <!-- SEASON -->

                    <div class="form-group">


                        <label for="season">

                            SEASON

                        </label>


                        <select
                            id="season"
                            name="season"
                            required
                        >


                            <?php

                            $seasons = [

                                "All Season",
                                "Summer",
                                "Winter",
                                "Monsoon"

                            ];


                            foreach (
                                $seasons as $seasonOption
                            ):
                            ?>


                                <option
                                    value="<?php
                                    echo $seasonOption;
                                    ?>"

                                    <?php
                                    echo $item["season"] ===
                                        $seasonOption
                                        ? "selected"
                                        : "";
                                    ?>
                                >

                                    <?php
                                    echo strtoupper(
                                        $seasonOption
                                    );
                                    ?>

                                </option>


                            <?php endforeach; ?>


                        </select>


                    </div>


                </div>



                <!-- STYLE -->

                <div class="form-group">


                    <label for="style">

                        STYLE / VIBE

                    </label>


                    <select
                        id="style"
                        name="style"
                        required
                    >


                        <?php

                        $styles = [

                            "Casual",
                            "Streetwear",
                            "Minimal",
                            "Formal",
                            "Vintage",
                            "Sporty",
                            "Party",
                            "Traditional"

                        ];


                        foreach (
                            $styles as $styleOption
                        ):
                        ?>


                            <option
                                value="<?php
                                echo $styleOption;
                                ?>"

                                <?php
                                echo $item["style"] ===
                                    $styleOption
                                    ? "selected"
                                    : "";
                                ?>
                            >

                                <?php
                                echo strtoupper(
                                    $styleOption
                                );
                                ?>

                            </option>


                        <?php endforeach; ?>


                    </select>


                </div>



                <!-- DESCRIPTION -->

                <div class="form-group">


                    <label for="description">

                        DESCRIPTION

                        <span>

                            OPTIONAL

                        </span>

                    </label>


                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                    ><?php
                    echo htmlspecialchars(
                        $item["description"]
                    );
                    ?></textarea>


                </div>



                <!-- ACTIONS -->

                <div class="add-wardrobe-actions">


                    <a
                        href="index.php"
                        class="cancel-wardrobe-btn"
                    >

                        CANCEL

                    </a>


                    <button
                        type="submit"
                        class="save-wardrobe-btn"
                    >

                        <i class="fa-solid fa-floppy-disk"></i>

                        SAVE CHANGES

                    </button>


                </div>


            </div>


        </form>


    </section>


</main>



<!-- JAVASCRIPT -->

<script src="../assets/js/wardrobe.js"></script>


</body>

</html>
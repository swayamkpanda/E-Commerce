<?php

$pageTitle = "Add to Wardrobe | SSISS";

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
     ADD WARDROBE PAGE
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

            BUILD YOUR DIGITAL CLOSET

        </p>


        <h1>

            ADD TO YOUR

            <span>WARDROBE.</span>

        </h1>


        <p>

            Upload a photo of something you own.
            SSISS will later use your wardrobe
            to help create personalized outfits.

        </p>


    </section>



    <!-- =====================================
         ADD FORM
    ====================================== -->

    <section class="add-wardrobe-container">


        <form
            action="add.php"
            method="POST"
            enctype="multipart/form-data"
            id="addWardrobeForm"
        >


            <!-- =============================
                 LEFT SIDE - IMAGE UPLOAD
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


                    <!-- DEFAULT UPLOAD CONTENT -->

                    <div
                        class="upload-placeholder"
                        id="uploadPlaceholder"
                    >


                        <div class="upload-icon">

                            <i class="fa-solid fa-cloud-arrow-up"></i>

                        </div>


                        <h3>

                            UPLOAD YOUR ITEM

                        </h3>


                        <p>

                            Drag & drop an image here

                            <br>

                            or click to browse

                        </p>


                        <span>

                            JPG, PNG, WEBP

                        </span>


                    </div>


                    <!-- IMAGE PREVIEW -->

                    <div
                        class="image-preview-wrapper"
                        id="imagePreviewWrapper"
                        style="display: none;"
                    >


                        <img
                            id="imagePreview"
                            src=""
                            alt="Wardrobe item preview"
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

                    💡 Tip: Use a clear photo with
                    the clothing item visible.

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
                        placeholder="E.g. Black Oversized T-Shirt"
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

                        <option value="">

                            SELECT CATEGORY

                        </option>


                        <option value="Tops">

                            TOPS

                        </option>


                        <option value="Bottoms">

                            BOTTOMS

                        </option>


                        <option value="Outerwear">

                            OUTERWEAR

                        </option>


                        <option value="Dresses">

                            DRESSES

                        </option>


                        <option value="Shoes">

                            SHOES

                        </option>


                        <option value="Accessories">

                            ACCESSORIES

                        </option>


                    </select>

                </div>



                <!-- COLOR + SEASON -->

                <div class="form-row">


                    <div class="form-group">

                        <label for="color">

                            COLOR

                        </label>


                        <select
                            id="color"
                            name="color"
                            required
                        >

                            <option value="">

                                SELECT COLOR

                            </option>


                            <option value="Black">

                                BLACK

                            </option>


                            <option value="White">

                                WHITE

                            </option>


                            <option value="Blue">

                                BLUE

                            </option>


                            <option value="Red">

                                RED

                            </option>


                            <option value="Green">

                                GREEN

                            </option>


                            <option value="Brown">

                                BROWN

                            </option>


                            <option value="Grey">

                                GREY

                            </option>


                            <option value="Beige">

                                BEIGE

                            </option>


                            <option value="Multicolor">

                                MULTICOLOR

                            </option>


                        </select>

                    </div>



                    <div class="form-group">

                        <label for="season">

                            SEASON

                        </label>


                        <select
                            id="season"
                            name="season"
                            required
                        >

                            <option value="">

                                SELECT SEASON

                            </option>


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

                        <option value="">

                            SELECT YOUR VIBE

                        </option>


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


                        <option value="Party">

                            PARTY

                        </option>


                        <option value="Traditional">

                            TRADITIONAL

                        </option>


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
                        placeholder="Add details about the item..."
                    ></textarea>

                </div>



                <!-- FORM ACTIONS -->

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

                        <i class="fa-solid fa-plus"></i>

                        ADD TO WARDROBE

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
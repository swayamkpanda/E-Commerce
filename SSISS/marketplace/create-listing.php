<?php

$pageTitle = "Create Listing | SSISS";


/* =========================================
   TEMPORARY FORM DATA
   Later replace with MySQL database logic
========================================= */

$categories = [
    "Men",
    "Women",
    "Kids",
    "Accessories"
];


$conditions = [
    "New with Tags",
    "Like New",
    "Excellent",
    "Good",
    "Fair"
];


$message = "";
$messageType = "";


/* =========================================
   FORM SUBMISSION
========================================= */

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $productName = trim($_POST["product_name"] ?? "");
    $category = $_POST["category"] ?? "";
    $brand = trim($_POST["brand"] ?? "");
    $size = trim($_POST["size"] ?? "");
    $condition = $_POST["condition"] ?? "";
    $originalPrice = trim($_POST["original_price"] ?? "");
    $sellingPrice = trim($_POST["selling_price"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $location = trim($_POST["location"] ?? "");


    /* =====================================
       BASIC VALIDATION
    ====================================== */

    if (
        $productName === ""
        ||
        $category === ""
        ||
        $size === ""
        ||
        $condition === ""
        ||
        $sellingPrice === ""
        ||
        $description === ""
        ||
        $location === ""
    ) {

        $message = "Please fill in all required fields.";
        $messageType = "error";

    } elseif (
        !is_numeric($sellingPrice)
        ||
        (float) $sellingPrice <= 0
    ) {

        $message = "Please enter a valid selling price.";
        $messageType = "error";

    } else {

        /*
         * TEMPORARY SUCCESS
         *
         * Later:
         *
         * 1. Upload image
         * 2. Insert listing into database
         * 3. Associate listing with logged-in user
         * 4. Redirect to my-listings.php
         */

        $message =
            "Your listing has been created successfully!";

        $messageType = "success";

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


    <!-- PROJECT CSS -->

    <link
        rel="stylesheet"
        href="../assets/css/home.css"
    >


    <link
        rel="stylesheet"
        href="../assets/css/marketplace.css"
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


        <a
            href="index.php"
            class="active"
        >
            Pre-Loved
        </a>


        <a href="../impact/index.php">
            Impact
        </a>


    </nav>


    <div class="nav-actions">


        <a
            href="../wishlist/index.php"
            class="icon-btn"
        >

            <i class="fa-solid fa-heart"></i>

        </a>


        <a
            href="../cart/index.php"
            class="icon-btn"
        >

            <i class="fa-solid fa-bag-shopping"></i>

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
     CREATE LISTING PAGE
========================================= -->

<main class="marketplace-listing-page">


    <!-- BACK BUTTON -->

    <a
        href="sell.php"
        class="marketplace-back-btn"
    >

        <i class="fa-solid fa-arrow-left"></i>

        BACK TO SELLING

    </a>



    <!-- =====================================
         PAGE HEADER
    ====================================== -->

    <section class="marketplace-listing-header">


        <p class="section-tag">

            SELL PRE-LOVED FASHION

        </p>


        <h1>

            CREATE YOUR

            <span>LISTING.</span>

        </h1>


        <p>

            Add accurate details and clear photos to help
            buyers discover your item.

        </p>


    </section>



    <!-- =====================================
         FORM MESSAGE
    ====================================== -->

    <?php if ($message !== ""): ?>


        <div
            class="marketplace-form-message <?php
            echo htmlspecialchars($messageType);
            ?>"
        >


            <?php if ($messageType === "success"): ?>


                <i class="fa-solid fa-circle-check"></i>


            <?php else: ?>


                <i class="fa-solid fa-circle-exclamation"></i>


            <?php endif; ?>


            <span>

                <?php
                echo htmlspecialchars($message);
                ?>

            </span>


        </div>


    <?php endif; ?>



    <!-- =====================================
         LISTING FORM
    ====================================== -->

    <form
        action="create-listing.php"
        method="POST"
        enctype="multipart/form-data"
        class="marketplace-listing-form"
    >


        <!-- =================================
             PRODUCT INFORMATION
        ================================== -->

        <section class="marketplace-form-section">


            <div class="marketplace-form-section-heading">


                <div class="marketplace-form-section-icon">

                    <i class="fa-solid fa-shirt"></i>

                </div>


                <div>


                    <h2>

                        ITEM INFORMATION

                    </h2>


                    <p>

                        Tell buyers about your clothing item.

                    </p>


                </div>


            </div>



            <div class="marketplace-form-grid">


                <!-- PRODUCT NAME -->

                <div class="marketplace-form-group full-width">


                    <label for="product_name">

                        PRODUCT NAME

                        <span>*</span>

                    </label>


                    <input
                        type="text"
                        id="product_name"
                        name="product_name"
                        placeholder="Example: Classic Blue Denim Jacket"
                        value="<?php
                        echo htmlspecialchars(
                            $_POST["product_name"] ?? ""
                        );
                        ?>"
                        required
                    >


                </div>



                <!-- CATEGORY -->

                <div class="marketplace-form-group">


                    <label for="category">

                        CATEGORY

                        <span>*</span>

                    </label>


                    <select
                        id="category"
                        name="category"
                        required
                    >


                        <option value="">

                            SELECT CATEGORY

                        </option>


                        <?php foreach ($categories as $itemCategory): ?>


                            <option
                                value="<?php
                                echo htmlspecialchars(
                                    $itemCategory
                                );
                                ?>"
                                <?php
                                echo (
                                    ($_POST["category"] ?? "")
                                    === $itemCategory
                                )
                                    ? "selected"
                                    : "";
                                ?>
                            >


                                <?php
                                echo htmlspecialchars(
                                    strtoupper(
                                        $itemCategory
                                    )
                                );
                                ?>


                            </option>


                        <?php endforeach; ?>


                    </select>


                </div>



                <!-- BRAND -->

                <div class="marketplace-form-group">


                    <label for="brand">

                        BRAND

                        <small>

                            OPTIONAL

                        </small>

                    </label>


                    <input
                        type="text"
                        id="brand"
                        name="brand"
                        placeholder="Example: Levi's"
                        value="<?php
                        echo htmlspecialchars(
                            $_POST["brand"] ?? ""
                        );
                        ?>"
                    >


                </div>



                <!-- SIZE -->

                <div class="marketplace-form-group">


                    <label for="size">

                        SIZE

                        <span>*</span>

                    </label>


                    <input
                        type="text"
                        id="size"
                        name="size"
                        placeholder="Example: M"
                        value="<?php
                        echo htmlspecialchars(
                            $_POST["size"] ?? ""
                        );
                        ?>"
                        required
                    >


                </div>



                <!-- CONDITION -->

                <div class="marketplace-form-group">


                    <label for="condition">

                        CONDITION

                        <span>*</span>

                    </label>


                    <select
                        id="condition"
                        name="condition"
                        required
                    >


                        <option value="">

                            SELECT CONDITION

                        </option>


                        <?php foreach ($conditions as $itemCondition): ?>


                            <option
                                value="<?php
                                echo htmlspecialchars(
                                    $itemCondition
                                );
                                ?>"
                                <?php
                                echo (
                                    ($_POST["condition"] ?? "")
                                    === $itemCondition
                                )
                                    ? "selected"
                                    : "";
                                ?>
                            >


                                <?php
                                echo htmlspecialchars(
                                    strtoupper(
                                        $itemCondition
                                    )
                                );
                                ?>


                            </option>


                        <?php endforeach; ?>


                    </select>


                </div>


            </div>


        </section>



        <!-- =================================
             PRICING
        ================================== -->

        <section class="marketplace-form-section">


            <div class="marketplace-form-section-heading">


                <div class="marketplace-form-section-icon">

                    <i class="fa-solid fa-indian-rupee-sign"></i>

                </div>


                <div>


                    <h2>

                        PRICING

                    </h2>


                    <p>

                        Set a fair and realistic selling price.

                    </p>


                </div>


            </div>



            <div class="marketplace-form-grid">


                <!-- ORIGINAL PRICE -->

                <div class="marketplace-form-group">


                    <label for="original_price">

                        ORIGINAL PRICE

                        <small>

                            OPTIONAL

                        </small>

                    </label>


                    <div class="marketplace-input-prefix">


                        <span>

                            ₹

                        </span>


                        <input
                            type="number"
                            id="original_price"
                            name="original_price"
                            min="0"
                            step="1"
                            placeholder="0"
                            value="<?php
                            echo htmlspecialchars(
                                $_POST["original_price"] ?? ""
                            );
                            ?>"
                        >


                    </div>


                </div>



                <!-- SELLING PRICE -->

                <div class="marketplace-form-group">


                    <label for="selling_price">

                        SELLING PRICE

                        <span>*</span>

                    </label>


                    <div class="marketplace-input-prefix">


                        <span>

                            ₹

                        </span>


                        <input
                            type="number"
                            id="selling_price"
                            name="selling_price"
                            min="1"
                            step="1"
                            placeholder="0"
                            value="<?php
                            echo htmlspecialchars(
                                $_POST["selling_price"] ?? ""
                            );
                            ?>"
                            required
                        >


                    </div>


                </div>


            </div>


        </section>



        <!-- =================================
             DESCRIPTION
        ================================== -->

        <section class="marketplace-form-section">


            <div class="marketplace-form-section-heading">


                <div class="marketplace-form-section-icon">

                    <i class="fa-solid fa-align-left"></i>

                </div>


                <div>


                    <h2>

                        DESCRIPTION

                    </h2>


                    <p>

                        Describe your item honestly.

                    </p>


                </div>


            </div>



            <div class="marketplace-form-group">


                <label for="description">

                    ITEM DESCRIPTION

                    <span>*</span>

                </label>


                <textarea
                    id="description"
                    name="description"
                    rows="7"
                    placeholder="Describe the item, its condition, colour, fit and any important details..."
                    required
                ><?php
                echo htmlspecialchars(
                    $_POST["description"] ?? ""
                );
                ?></textarea>


                <small class="marketplace-form-help">

                    Mention any visible wear, marks,
                    or imperfections.

                </small>


            </div>


        </section>



        <!-- =================================
             LOCATION
        ================================== -->

        <section class="marketplace-form-section">


            <div class="marketplace-form-section-heading">


                <div class="marketplace-form-section-icon">

                    <i class="fa-solid fa-location-dot"></i>

                </div>


                <div>


                    <h2>

                        LOCATION

                    </h2>


                    <p>

                        Help buyers understand where the item is located.

                    </p>


                </div>


            </div>



            <div class="marketplace-form-group">


                <label for="location">

                    CITY / LOCATION

                    <span>*</span>

                </label>


                <input
                    type="text"
                    id="location"
                    name="location"
                    placeholder="Example: Bhubaneswar"
                    value="<?php
                    echo htmlspecialchars(
                        $_POST["location"] ?? ""
                    );
                    ?>"
                    required
                >


            </div>


        </section>



        <!-- =================================
             IMAGE UPLOAD
        ================================== -->

        <section class="marketplace-form-section">


            <div class="marketplace-form-section-heading">


                <div class="marketplace-form-section-icon">

                    <i class="fa-solid fa-camera"></i>

                </div>


                <div>


                    <h2>

                        ITEM PHOTOS

                    </h2>


                    <p>

                        Add clear photos of your item.

                    </p>


                </div>


            </div>



            <div class="marketplace-upload-area">


                <input
                    type="file"
                    id="product_image"
                    name="product_image"
                    accept="image/*"
                    hidden
                >


                <label
                    for="product_image"
                    class="marketplace-upload-label"
                >


                    <div class="marketplace-upload-icon">


                        <i class="fa-solid fa-cloud-arrow-up"></i>


                    </div>


                    <h3>

                        UPLOAD ITEM PHOTO

                    </h3>


                    <p>

                        PNG, JPG or WEBP

                    </p>


                    <span>

                        CLICK TO SELECT A FILE

                    </span>


                </label>


            </div>



            <!-- IMAGE PREVIEW -->


            <div
                id="imagePreview"
                class="marketplace-image-preview"
            ></div>


        </section>



        <!-- =================================
             FORM ACTIONS
        ================================== -->

        <div class="marketplace-form-actions">


            <a
                href="sell.php"
                class="marketplace-secondary-btn"
            >

                CANCEL

            </a>


            <button
                type="submit"
                class="marketplace-primary-btn"
            >

                <i class="fa-solid fa-plus"></i>

                CREATE LISTING

            </button>


        </div>


    </form>


</main>



<!-- =========================================
     JAVASCRIPT
========================================= -->

<script>


const imageInput =
    document.getElementById("product_image");


const imagePreview =
    document.getElementById("imagePreview");


imageInput.addEventListener(
    "change",
    function () {

        imagePreview.innerHTML = "";


        const file =
            this.files[0];


        if (!file) {

            return;

        }


        const image =
            document.createElement("img");


        image.src =
            URL.createObjectURL(file);


        image.alt =
            "Product preview";


        imagePreview.appendChild(image);

    }
);


</script>


<script src="../assets/js/marketplace.js"></script>


</body>

</html>
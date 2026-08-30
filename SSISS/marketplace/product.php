<?php

$pageTitle = "Product Details | SSISS";


/* =========================================
   TEMPORARY MARKETPLACE DATA
   Later replace with MySQL queries
========================================= */

$products = [

    [
        "id" => 1,
        "name" => "Classic Denim Jacket",
        "category" => "Men",
        "size" => "M",
        "condition" => "Excellent",
        "price" => 899,
        "originalPrice" => 2499,
        "seller" => "Rahul Sharma",
        "location" => "Bhubaneswar",
        "description" =>
            "A stylish classic denim jacket in excellent condition. Perfect for casual outfits and easy to pair with almost anything.",
        "image" => "../assets/images/products/denim-jacket.jpg",
        "status" => "Available"
    ],

    [
        "id" => 2,
        "name" => "Floral Summer Dress",
        "category" => "Women",
        "size" => "S",
        "condition" => "Like New",
        "price" => 699,
        "originalPrice" => 1999,
        "seller" => "Priya Das",
        "location" => "Cuttack",
        "description" =>
            "A lightweight floral summer dress that has been gently used and maintained in excellent condition.",
        "image" => "../assets/images/products/floral-dress.jpg",
        "status" => "Available"
    ],

    [
        "id" => 3,
        "name" => "Black Leather Jacket",
        "category" => "Men",
        "size" => "L",
        "condition" => "Good",
        "price" => 1299,
        "originalPrice" => 3499,
        "seller" => "Aman Kumar",
        "location" => "Bhubaneswar",
        "description" =>
            "A classic black leather jacket with a timeless design. Comfortable, stylish, and suitable for casual wear.",
        "image" => "../assets/images/products/leather-jacket.jpg",
        "status" => "Available"
    ],

    [
        "id" => 4,
        "name" => "Cotton Casual Shirt",
        "category" => "Men",
        "size" => "M",
        "condition" => "Excellent",
        "price" => 499,
        "originalPrice" => 1299,
        "seller" => "Rohan Singh",
        "location" => "Puri",
        "description" =>
            "Comfortable cotton casual shirt in excellent condition. Ideal for daily wear and relaxed occasions.",
        "image" => "../assets/images/products/casual-shirt.jpg",
        "status" => "Available"
    ],

    [
        "id" => 5,
        "name" => "Vintage Handbag",
        "category" => "Accessories",
        "size" => "One Size",
        "condition" => "Good",
        "price" => 799,
        "originalPrice" => 2299,
        "seller" => "Sneha Patel",
        "location" => "Bhubaneswar",
        "description" =>
            "A stylish vintage handbag with plenty of space and a timeless design.",
        "image" => "../assets/images/products/handbag.jpg",
        "status" => "Available"
    ],

    [
        "id" => 6,
        "name" => "Kids Winter Hoodie",
        "category" => "Kids",
        "size" => "8-10 Years",
        "condition" => "Like New",
        "price" => 399,
        "originalPrice" => 999,
        "seller" => "Ananya Singh",
        "location" => "Cuttack",
        "description" =>
            "Warm and comfortable winter hoodie for children, maintained in very good condition.",
        "image" => "../assets/images/products/kids-hoodie.jpg",
        "status" => "Available"
    ]

];


/* =========================================
   GET PRODUCT ID
========================================= */

$productId = isset($_GET["id"])
    ? (int) $_GET["id"]
    : 0;


/* =========================================
   FIND PRODUCT
========================================= */

$product = null;


foreach ($products as $item) {

    if ($item["id"] === $productId) {

        $product = $item;

        break;

    }

}


/* =========================================
   PRODUCT NOT FOUND
========================================= */

if ($product === null) {

    header("Location: index.php");

    exit;

}


/* =========================================
   RELATED PRODUCTS
========================================= */

$relatedProducts = [];


foreach ($products as $item) {

    if (
        $item["id"] !== $product["id"]
        &&
        $item["category"] === $product["category"]
    ) {

        $relatedProducts[] = $item;

    }

}


/* If there are fewer related products,
   show other products as fallback */

if (count($relatedProducts) < 3) {

    foreach ($products as $item) {

        if (
            $item["id"] !== $product["id"]
            &&
            !in_array(
                $item,
                $relatedProducts,
                true
            )
        ) {

            $relatedProducts[] = $item;

        }

    }

}


/* Limit to 3 products */

$relatedProducts = array_slice(
    $relatedProducts,
    0,
    3
);

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
        echo htmlspecialchars(
            $product["name"]
        );
        ?>

        | SSISS

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
     PRODUCT PAGE
========================================= -->

<main class="marketplace-product-page">


    <!-- BACK BUTTON -->

    <a
        href="index.php"
        class="marketplace-back-btn"
    >

        <i class="fa-solid fa-arrow-left"></i>

        BACK TO MARKETPLACE

    </a>



    <!-- =====================================
         PRODUCT DETAILS
    ====================================== -->

    <section class="marketplace-product-details">


        <!-- PRODUCT IMAGE -->

        <div class="marketplace-product-gallery">


            <div class="marketplace-main-image">


                <img
                    src="<?php
                    echo htmlspecialchars(
                        $product["image"]
                    );
                    ?>"
                    alt="<?php
                    echo htmlspecialchars(
                        $product["name"]
                    );
                    ?>"
                >


                <span class="marketplace-product-status">

                    <?php
                    echo htmlspecialchars(
                        $product["status"]
                    );
                    ?>

                </span>


            </div>


            <div class="marketplace-product-gallery-note">


                <i class="fa-solid fa-circle-check"></i>

                VERIFIED PRE-LOVED ITEM

            </div>


        </div>



        <!-- PRODUCT INFORMATION -->

        <div class="marketplace-product-info">


            <span class="marketplace-category">

                <?php
                echo htmlspecialchars(
                    $product["category"]
                );
                ?>

            </span>


            <h1>

                <?php
                echo htmlspecialchars(
                    $product["name"]
                );
                ?>

            </h1>


            <!-- PRICE -->

            <div class="marketplace-product-price">


                <strong>

                    ₹<?php
                    echo number_format(
                        $product["price"]
                    );
                    ?>

                </strong>


                <span>

                    Original:

                    <del>

                        ₹<?php
                        echo number_format(
                            $product["originalPrice"]
                        );
                        ?>

                    </del>

                </span>


            </div>



            <!-- SAVINGS -->

            <div class="marketplace-savings">


                <?php

                $savedAmount =
                    $product["originalPrice"]
                    -
                    $product["price"];


                echo "You save ₹"
                    .
                    number_format(
                        $savedAmount
                    );

                ?>

            </div>



            <!-- PRODUCT META -->

            <div class="marketplace-product-info-grid">


                <div>


                    <span>

                        SIZE

                    </span>


                    <strong>

                        <?php
                        echo htmlspecialchars(
                            $product["size"]
                        );
                        ?>

                    </strong>


                </div>


                <div>


                    <span>

                        CONDITION

                    </span>


                    <strong>

                        <?php
                        echo htmlspecialchars(
                            $product["condition"]
                        );
                        ?>

                    </strong>


                </div>


                <div>


                    <span>

                        CATEGORY

                    </span>


                    <strong>

                        <?php
                        echo htmlspecialchars(
                            $product["category"]
                        );
                        ?>

                    </strong>


                </div>


            </div>



            <!-- DESCRIPTION -->

            <div class="marketplace-description">


                <h3>

                    DESCRIPTION

                </h3>


                <p>

                    <?php
                    echo htmlspecialchars(
                        $product["description"]
                    );
                    ?>

                </p>


            </div>



            <!-- ACTIONS -->

            <div class="marketplace-product-actions">


                <a
                    href="../cart/add.php?id=<?php
                    echo urlencode(
                        $product["id"]
                    );
                    ?>"
                    class="marketplace-primary-btn"
                >

                    <i class="fa-solid fa-bag-shopping"></i>

                    ADD TO CART

                </a>


                <a
                    href="../wishlist/add.php?id=<?php
                    echo urlencode(
                        $product["id"]
                    );
                    ?>"
                    class="marketplace-wishlist-action"
                >

                    <i class="fa-regular fa-heart"></i>

                    SAVE

                </a>


            </div>


        </div>


    </section>



    <!-- =====================================
         SELLER INFORMATION
    ====================================== -->

    <section class="marketplace-seller-section">


        <div class="marketplace-seller-card">


            <div class="marketplace-seller-avatar large">


                <?php

                echo strtoupper(
                    substr(
                        $product["seller"],
                        0,
                        1
                    )
                );

                ?>

            </div>


            <div class="marketplace-seller-details">


                <span>

                    SELLER

                </span>


                <h2>

                    <?php
                    echo htmlspecialchars(
                        $product["seller"]
                    );
                    ?>

                </h2>


                <p>

                    <i class="fa-solid fa-location-dot"></i>

                    <?php
                    echo htmlspecialchars(
                        $product["location"]
                    );
                    ?>

                </p>


            </div>


            <a
                href="#"
                class="marketplace-secondary-btn"
            >

                <i class="fa-solid fa-comment"></i>

                CONTACT SELLER

            </a>


        </div>


    </section>



    <!-- =====================================
         SUSTAINABILITY MESSAGE
    ====================================== -->

    <section class="marketplace-sustainability-box">


        <div class="marketplace-sustainability-icon">

            <i class="fa-solid fa-leaf"></i>

        </div>


        <div>


            <p class="section-tag">

                CIRCULAR FASHION

            </p>


            <h2>

                YOU'RE GIVING THIS ITEM

                <span>A SECOND LIFE.</span>

            </h2>


            <p>

                Choosing pre-loved clothing helps extend
                the life of garments and supports a more
                sustainable fashion ecosystem.

            </p>


        </div>


    </section>



    <!-- =====================================
         RELATED PRODUCTS
    ====================================== -->

    <?php if (!empty($relatedProducts)): ?>


        <section class="marketplace-related-section">


            <div class="marketplace-section-heading">


                <div>


                    <p class="section-tag">

                        YOU MAY ALSO LIKE

                    </p>


                    <h2>

                        MORE PRE-LOVED

                        <span>FAVORITES.</span>

                    </h2>


                </div>


                <a
                    href="index.php"
                    class="marketplace-text-link"
                >

                    VIEW ALL

                    <i class="fa-solid fa-arrow-right"></i>

                </a>


            </div>



            <div class="marketplace-product-grid">


                <?php foreach ($relatedProducts as $related): ?>


                    <article class="marketplace-product-card">


                        <a
                            href="product.php?id=<?php
                            echo urlencode(
                                $related["id"]
                            );
                            ?>"
                            class="marketplace-product-image"
                        >


                            <img
                                src="<?php
                                echo htmlspecialchars(
                                    $related["image"]
                                );
                                ?>"
                                alt="<?php
                                echo htmlspecialchars(
                                    $related["name"]
                                );
                                ?>"
                            >


                            <span class="marketplace-condition">


                                <?php
                                echo htmlspecialchars(
                                    $related["condition"]
                                );
                                ?>


                            </span>


                        </a>



                        <div class="marketplace-product-content">


                            <span class="marketplace-category">


                                <?php
                                echo htmlspecialchars(
                                    $related["category"]
                                );
                                ?>


                            </span>


                            <h3>


                                <a
                                    href="product.php?id=<?php
                                    echo urlencode(
                                        $related["id"]
                                    );
                                    ?>"
                                >


                                    <?php
                                    echo htmlspecialchars(
                                        $related["name"]
                                    );
                                    ?>


                                </a>


                            </h3>


                            <div class="marketplace-price">


                                <strong>


                                    ₹<?php
                                    echo number_format(
                                        $related["price"]
                                    );
                                    ?>


                                </strong>


                                <span>


                                    ₹<?php
                                    echo number_format(
                                        $related["originalPrice"]
                                    );
                                    ?>


                                </span>


                            </div>


                            <div class="marketplace-product-meta">


                                <span>


                                    SIZE:

                                    <strong>


                                        <?php
                                        echo htmlspecialchars(
                                            $related["size"]
                                        );
                                        ?>


                                    </strong>


                                </span>


                                <span>

                                    ·

                                </span>


                                <span>


                                    <?php
                                    echo htmlspecialchars(
                                        $related["condition"]
                                    );
                                    ?>


                                </span>


                            </div>


                        </div>


                    </article>


                <?php endforeach; ?>


            </div>


        </section>


    <?php endif; ?>


</main>



<!-- PROJECT JAVASCRIPT -->

<script src="../assets/js/marketplace.js"></script>


</body>

</html>
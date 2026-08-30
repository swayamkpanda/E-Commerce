<?php

$pageTitle = "Order Details | SSISS";


/* =========================================
   GET ORDER ID
========================================= */

$orderId = $_GET["id"] ?? "";


/* =========================================
   TEMPORARY ORDER DATA

   Later, this will come from MySQL.
========================================= */

$orders = [

    "SSISS-10245" => [

        "id" => "SSISS-10245",

        "date" => "18 March 2026",

        "status" => "Delivered",

        "statusClass" => "delivered",

        "paymentStatus" => "Paid",

        "paymentMethod" => "UPI Payment",

        "subtotal" => 3299,

        "shipping" => 200,

        "discount" => 0,

        "total" => 3499,

        "address" => [

            "name" => "SSISS User",

            "phone" => "+91 9876543210",

            "street" => "123 Fashion Street",

            "city" => "Bhubaneswar",

            "state" => "Odisha",

            "pincode" => "751001"

        ],

        "products" => [

            [

                "name" => "Minimal Classic Jacket",

                "price" => 1999,

                "quantity" => 1,

                "image" =>
                "../assets/images/products/product-1.jpg"

            ],

            [

                "name" => "Premium Casual T-Shirt",

                "price" => 1300,

                "quantity" => 1,

                "image" =>
                "../assets/images/products/product-2.jpg"

            ]

        ]

    ],



    "SSISS-10231" => [

        "id" => "SSISS-10231",

        "date" => "12 March 2026",

        "status" => "Shipped",

        "statusClass" => "shipped",

        "paymentStatus" => "Paid",

        "paymentMethod" => "Credit Card",

        "subtotal" => 1999,

        "shipping" => 200,

        "discount" => 0,

        "total" => 2199,

        "address" => [

            "name" => "SSISS User",

            "phone" => "+91 9876543210",

            "street" => "123 Fashion Street",

            "city" => "Bhubaneswar",

            "state" => "Odisha",

            "pincode" => "751001"

        ],

        "products" => [

            [

                "name" => "Premium Casual Collection",

                "price" => 2199,

                "quantity" => 1,

                "image" =>
                "../assets/images/products/product-2.jpg"

            ]

        ]

    ],



    "SSISS-10198" => [

        "id" => "SSISS-10198",

        "date" => "05 March 2026",

        "status" => "Processing",

        "statusClass" => "processing",

        "paymentStatus" => "Paid",

        "paymentMethod" => "Cash on Delivery",

        "subtotal" => 1399,

        "shipping" => 200,

        "discount" => 0,

        "total" => 1599,

        "address" => [

            "name" => "SSISS User",

            "phone" => "+91 9876543210",

            "street" => "123 Fashion Street",

            "city" => "Bhubaneswar",

            "state" => "Odisha",

            "pincode" => "751001"

        ],

        "products" => [

            [

                "name" => "Urban Style Sneakers",

                "price" => 1599,

                "quantity" => 1,

                "image" =>
                "../assets/images/products/product-3.jpg"

            ]

        ]

    ]

];


/* =========================================
   CHECK ORDER
========================================= */

$order = $orders[$orderId] ?? null;

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
        href="../assets/css/orders.css"
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
            AI Stylist ✦
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
            href="../profile/index.php"
            class="profile-btn"
        >
            <i class="fa-solid fa-user"></i>
        </a>

    </div>


</header>



<main class="order-details-page">


<?php if ($order): ?>


    <!-- =====================================
         PAGE HEADER
    ====================================== -->

    <section class="order-details-header">


        <a
            href="index.php"
            class="back-profile"
        >

            <i class="fa-solid fa-arrow-left"></i>

            BACK TO ORDERS

        </a>


        <p class="section-tag">

            ORDER DETAILS

        </p>


        <h1>

            ORDER

            <span>
                #<?php
                echo htmlspecialchars($order["id"]);
                ?>
            </span>

        </h1>


        <p>

            Placed on

            <?php
            echo htmlspecialchars($order["date"]);
            ?>

        </p>


    </section>



    <!-- =====================================
         ORDER STATUS
    ====================================== -->

    <section class="order-status-banner">


        <div class="status-banner-icon">

            <i class="fa-solid fa-box"></i>

        </div>


        <div>

            <span>
                CURRENT STATUS
            </span>


            <h2>

                <?php
                echo htmlspecialchars(
                    $order["status"]
                );
                ?>

            </h2>


            <p>

                Your order is currently

                <?php
                echo strtolower(
                    htmlspecialchars(
                        $order["status"]
                    )
                );
                ?>

            </p>

        </div>


        <?php if (
            $order["status"] === "Shipped"
            ||
            $order["status"] === "Processing"
        ): ?>


            <a
                href="track.php?id=<?php
                echo urlencode($order["id"]);
                ?>"
                class="track-order-main-btn"
            >

                <i class="fa-solid fa-location-dot"></i>

                TRACK ORDER

            </a>


        <?php endif; ?>


    </section>



    <!-- =====================================
         PRODUCTS + SUMMARY
    ====================================== -->

    <section class="order-details-layout">


        <!-- PRODUCTS -->


        <div class="order-products-section">


            <div class="section-heading">

                <div>

                    <p class="section-tag">
                        PURCHASED ITEMS
                    </p>


                    <h2>

                        YOUR

                        <span>ITEMS.</span>

                    </h2>

                </div>

            </div>



            <div class="order-products-list">


                <?php foreach (
                    $order["products"]
                    as
                    $product
                ): ?>


                    <article class="order-detail-product-card">


                        <div class="order-detail-product-image">


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


                        </div>


                        <div class="order-detail-product-info">


                            <h3>

                                <?php
                                echo htmlspecialchars(
                                    $product["name"]
                                );
                                ?>

                            </h3>


                            <p>

                                Quantity:

                                <?php
                                echo $product["quantity"];
                                ?>

                            </p>


                            <strong>

                                ₹<?php
                                echo number_format(
                                    $product["price"]
                                );
                                ?>

                            </strong>


                        </div>


                    </article>


                <?php endforeach; ?>


            </div>


        </div>



        <!-- SUMMARY -->


        <aside class="order-summary-box">


            <h3>

                ORDER SUMMARY

            </h3>


            <div class="summary-row">

                <span>
                    Subtotal
                </span>

                <span>

                    ₹<?php
                    echo number_format(
                        $order["subtotal"]
                    );
                    ?>

                </span>

            </div>



            <div class="summary-row">

                <span>
                    Shipping
                </span>

                <span>

                    ₹<?php
                    echo number_format(
                        $order["shipping"]
                    );
                    ?>

                </span>

            </div>



            <div class="summary-row">

                <span>
                    Discount
                </span>

                <span>

                    -₹<?php
                    echo number_format(
                        $order["discount"]
                    );
                    ?>

                </span>

            </div>



            <hr>



            <div class="summary-total">

                <strong>
                    TOTAL
                </strong>


                <strong>

                    ₹<?php
                    echo number_format(
                        $order["total"]
                    );
                    ?>

                </strong>

            </div>


        </aside>


    </section>



    <!-- =====================================
         ADDRESS + PAYMENT
    ====================================== -->

    <section class="order-info-grid">


        <!-- SHIPPING ADDRESS -->


        <article class="order-info-card">


            <div class="order-info-icon">

                <i class="fa-solid fa-location-dot"></i>

            </div>


            <h3>

                SHIPPING ADDRESS

            </h3>


            <p>

                <strong>

                    <?php
                    echo htmlspecialchars(
                        $order["address"]["name"]
                    );
                    ?>

                </strong>

            </p>


            <p>

                <?php
                echo htmlspecialchars(
                    $order["address"]["street"]
                );
                ?>

            </p>


            <p>

                <?php
                echo htmlspecialchars(
                    $order["address"]["city"]
                );
                ?>,

                <?php
                echo htmlspecialchars(
                    $order["address"]["state"]
                );
                ?>

            </p>


            <p>

                <?php
                echo htmlspecialchars(
                    $order["address"]["pincode"]
                );
                ?>

            </p>


            <p>

                <?php
                echo htmlspecialchars(
                    $order["address"]["phone"]
                );
                ?>

            </p>


        </article>



        <!-- PAYMENT -->


        <article class="order-info-card">


            <div class="order-info-icon">

                <i class="fa-solid fa-credit-card"></i>

            </div>


            <h3>

                PAYMENT DETAILS

            </h3>


            <p>

                <strong>

                    <?php
                    echo htmlspecialchars(
                        $order["paymentMethod"]
                    );
                    ?>

                </strong>

            </p>


            <p>

                Payment Status:

                <span class="payment-success">

                    <?php
                    echo htmlspecialchars(
                        $order["paymentStatus"]
                    );
                    ?>

                </span>

            </p>


        </article>


    </section>



<?php else: ?>


    <!-- =====================================
         ORDER NOT FOUND
    ====================================== -->

    <section class="order-not-found">


        <div class="empty-orders-icon">

            <i class="fa-solid fa-box-open"></i>

        </div>


        <h1>

            ORDER NOT FOUND

        </h1>


        <p>

            The order you are looking for
            does not exist or may have
            been removed.

        </p>


        <a
            href="index.php"
            class="shop-now-btn"
        >

            <i class="fa-solid fa-arrow-left"></i>

            BACK TO ORDERS

        </a>


    </section>


<?php endif; ?>


</main>



<!-- JAVASCRIPT -->

<script src="../assets/js/orders.js"></script>


</body>

</html>
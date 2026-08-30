<?php

$pageTitle = "My Orders | SSISS";


/* =========================================
   TEMPORARY ORDER DATA

   Later this data will come from MySQL.
========================================= */

$orders = [

    [
        "id" => "SSISS-10245",
        "date" => "18 March 2026",
        "status" => "Delivered",
        "statusClass" => "delivered",
        "total" => 3499,
        "items" => 3,
        "image" => "../assets/images/products/product-1.jpg",
        "productName" => "Minimal Classic Jacket",
        "tracking" => "Delivered successfully"
    ],

    [
        "id" => "SSISS-10231",
        "date" => "12 March 2026",
        "status" => "Shipped",
        "statusClass" => "shipped",
        "total" => 2199,
        "items" => 2,
        "image" => "../assets/images/products/product-2.jpg",
        "productName" => "Premium Casual Collection",
        "tracking" => "Your order is on the way"
    ],

    [
        "id" => "SSISS-10198",
        "date" => "05 March 2026",
        "status" => "Processing",
        "statusClass" => "processing",
        "total" => 1599,
        "items" => 1,
        "image" => "../assets/images/products/product-3.jpg",
        "productName" => "Urban Style Sneakers",
        "tracking" => "Your order is being prepared"
    ],

    [
        "id" => "SSISS-10175",
        "date" => "22 February 2026",
        "status" => "Cancelled",
        "statusClass" => "cancelled",
        "total" => 1899,
        "items" => 2,
        "image" => "../assets/images/products/product-4.jpg",
        "productName" => "Classic Fashion Essentials",
        "tracking" => "This order was cancelled"
    ]

];


/* =========================================
   ORDER FILTER
========================================= */

$filter = isset($_GET["filter"])
    ? $_GET["filter"]
    : "all";


$filteredOrders = $orders;


if ($filter !== "all") {

    $filteredOrders = array_filter(

        $orders,

        function ($order) use ($filter) {

            return
                strtolower($order["status"])
                ===
                $filter;

        }

    );

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
        href="../assets/css/profile.css"
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
            href="index.php"
            class="profile-btn"
        >

            <i class="fa-solid fa-user"></i>

        </a>


    </div>


</header>



<!-- =========================================
     MY ORDERS PAGE
========================================= -->

<main class="my-orders-page">


    <!-- =====================================
         PAGE HEADER
    ====================================== -->

    <section class="orders-header">


        <a
            href="index.php"
            class="back-profile"
        >

            <i class="fa-solid fa-arrow-left"></i>

            BACK TO PROFILE

        </a>


        <p class="section-tag">

            SHOPPING HISTORY

        </p>


        <h1>

            MY

            <span>ORDERS.</span>

        </h1>


        <p>

            Track your purchases, check order
            status, and manage your SSISS orders
            from one place.

        </p>


    </section>



    <!-- =====================================
         ORDER SUMMARY
    ====================================== -->

    <section class="orders-summary">


        <article class="orders-summary-card">


            <i class="fa-solid fa-bag-shopping"></i>


            <div>


                <span>

                    TOTAL ORDERS

                </span>


                <strong>

                    <?php
                    echo count($orders);
                    ?>

                </strong>


            </div>


        </article>



        <article class="orders-summary-card">


            <i class="fa-solid fa-truck"></i>


            <div>


                <span>

                    IN PROGRESS

                </span>


                <strong>

                    <?php

                    $inProgress = 0;


                    foreach ($orders as $order) {

                        if (
                            $order["status"] ===
                            "Processing"
                            ||
                            $order["status"] ===
                            "Shipped"
                        ) {

                            $inProgress++;

                        }

                    }


                    echo $inProgress;

                    ?>

                </strong>


            </div>


        </article>



        <article class="orders-summary-card">


            <i class="fa-solid fa-circle-check"></i>


            <div>


                <span>

                    DELIVERED

                </span>


                <strong>

                    <?php

                    $delivered = 0;


                    foreach ($orders as $order) {

                        if (
                            $order["status"] ===
                            "Delivered"
                        ) {

                            $delivered++;

                        }

                    }


                    echo $delivered;

                    ?>

                </strong>


            </div>


        </article>


    </section>



    <!-- =====================================
         FILTERS
    ====================================== -->

    <section class="orders-filter-section">


        <div class="orders-filter-buttons">


            <a
                href="my-orders.php?filter=all"
                class="order-filter-btn
                <?php
                echo $filter === "all"
                    ? "active"
                    : "";
                ?>"
            >

                ALL ORDERS

            </a>


            <a
                href="my-orders.php?filter=processing"
                class="order-filter-btn
                <?php
                echo $filter === "processing"
                    ? "active"
                    : "";
                ?>"
            >

                PROCESSING

            </a>


            <a
                href="my-orders.php?filter=shipped"
                class="order-filter-btn
                <?php
                echo $filter === "shipped"
                    ? "active"
                    : "";
                ?>"
            >

                SHIPPED

            </a>


            <a
                href="my-orders.php?filter=delivered"
                class="order-filter-btn
                <?php
                echo $filter === "delivered"
                    ? "active"
                    : "";
                ?>"
            >

                DELIVERED

            </a>


            <a
                href="my-orders.php?filter=cancelled"
                class="order-filter-btn
                <?php
                echo $filter === "cancelled"
                    ? "active"
                    : "";
                ?>"
            >

                CANCELLED

            </a>


        </div>


    </section>



    <!-- =====================================
         ORDER LIST
    ====================================== -->

    <section class="orders-list-section">


        <div class="section-heading">


            <div>


                <p class="section-tag">

                    YOUR PURCHASES

                </p>


                <h2>

                    ORDER

                    <span>HISTORY.</span>

                </h2>


            </div>


            <span class="orders-count">


                <?php
                echo count($filteredOrders);
                ?>

                ORDER(S)

            </span>


        </div>



        <!-- =================================
             ORDER CARDS
        ================================== -->


        <?php if (!empty($filteredOrders)): ?>


            <div class="orders-list">


                <?php foreach ($filteredOrders as $order): ?>


                    <article class="order-card">


                        <!-- ORDER TOP -->


                        <div class="order-card-top">


                            <div>


                                <span class="order-id">

                                    ORDER #

                                    <?php
                                    echo htmlspecialchars(
                                        $order["id"]
                                    );
                                    ?>

                                </span>


                                <small>

                                    Placed on

                                    <?php
                                    echo htmlspecialchars(
                                        $order["date"]
                                    );
                                    ?>

                                </small>


                            </div>


                            <span
                                class="order-status
                                <?php
                                echo htmlspecialchars(
                                    $order["statusClass"]
                                );
                                ?>"
                            >

                                <?php
                                echo htmlspecialchars(
                                    $order["status"]
                                );
                                ?>

                            </span>


                        </div>



                        <!-- ORDER PRODUCT -->


                        <div class="order-product-preview">


                            <div class="order-product-image">


                                <img
                                    src="<?php
                                    echo htmlspecialchars(
                                        $order["image"]
                                    );
                                    ?>"
                                    alt="<?php
                                    echo htmlspecialchars(
                                        $order["productName"]
                                    );
                                    ?>"
                                >


                            </div>


                            <div class="order-product-info">


                                <h3>

                                    <?php
                                    echo htmlspecialchars(
                                        $order["productName"]
                                    );
                                    ?>

                                </h3>


                                <p>

                                    <?php
                                    echo $order["items"];
                                    ?>

                                    ITEM(S)

                                </p>


                                <span>

                                    <?php
                                    echo htmlspecialchars(
                                        $order["tracking"]
                                    );
                                    ?>

                                </span>


                            </div>


                        </div>



                        <!-- ORDER FOOTER -->


                        <div class="order-card-footer">


                            <div class="order-total">


                                <span>

                                    TOTAL

                                </span>


                                <strong>

                                    ₹<?php
                                    echo number_format(
                                        $order["total"]
                                    );
                                    ?>

                                </strong>


                            </div>


                            <div class="order-actions">


                                <a
                                    href="../orders/index.php?id=<?php
                                    echo urlencode(
                                        $order["id"]
                                    );
                                    ?>"
                                    class="view-order-btn"
                                >

                                    VIEW ORDER

                                </a>


                                <?php
                                if (
                                    $order["status"] ===
                                    "Shipped"
                                ):
                                ?>


                                    <a
                                        href="../orders/track.php?id=<?php
                                        echo urlencode(
                                            $order["id"]
                                        );
                                        ?>"
                                        class="track-order-btn"
                                    >

                                        <i class="fa-solid fa-location-dot"></i>

                                        TRACK

                                    </a>


                                <?php endif; ?>


                                <?php
                                if (
                                    $order["status"] ===
                                    "Delivered"
                                ):
                                ?>


                                    <a
                                        href="../shop/index.php"
                                        class="buy-again-btn"
                                    >

                                        <i class="fa-solid fa-rotate-right"></i>

                                        BUY AGAIN

                                    </a>


                                <?php endif; ?>


                            </div>


                        </div>


                    </article>


                <?php endforeach; ?>


            </div>


        <?php else: ?>


            <!-- EMPTY STATE -->


            <div class="empty-orders">


                <div class="empty-orders-icon">


                    <i class="fa-solid fa-bag-shopping"></i>


                </div>


                <h2>

                    NO ORDERS FOUND

                </h2>


                <p>

                    You do not have any orders
                    in this category yet.

                </p>


                <a
                    href="../shop/index.php"
                    class="generate-outfit-main-btn"
                >

                    <i class="fa-solid fa-bag-shopping"></i>

                    START SHOPPING

                </a>


            </div>


        <?php endif; ?>


    </section>



    <!-- =====================================
         HELP CTA
    ====================================== -->

    <section class="orders-help-section">


        <div>


            <p class="section-tag">

                NEED HELP?

            </p>


            <h2>

                QUESTIONS ABOUT

                <span>YOUR ORDER?</span>

            </h2>


            <p>

                Our support team is here to help
                you with tracking, delivery,
                returns, and other order issues.

            </p>


        </div>


        <a
            href="../community/index.php"
            class="generate-outfit-main-btn"
        >

            <i class="fa-solid fa-headset"></i>

            GET SUPPORT

        </a>


    </section>


</main>


<!-- JAVASCRIPT -->

<script src="../assets/js/profile.js"></script>


</body>

</html>
<?php

$pageTitle = "My Orders | SSISS";


/* =========================================
   TEMPORARY ORDER DATA
   Later replace this with MySQL data
========================================= */

$orders = [

    [
        "id" => "SSISS-10245",
        "date" => "18 March 2026",
        "status" => "Delivered",
        "statusClass" => "delivered",
        "total" => 3499,
        "items" => 3,
        "productName" => "Minimal Classic Jacket",
        "image" => "../assets/images/products/product-1.jpg"
    ],

    [
        "id" => "SSISS-10231",
        "date" => "12 March 2026",
        "status" => "Shipped",
        "statusClass" => "shipped",
        "total" => 2199,
        "items" => 2,
        "productName" => "Premium Casual Collection",
        "image" => "../assets/images/products/product-2.jpg"
    ],

    [
        "id" => "SSISS-10198",
        "date" => "05 March 2026",
        "status" => "Processing",
        "statusClass" => "processing",
        "total" => 1599,
        "items" => 1,
        "productName" => "Urban Style Sneakers",
        "image" => "../assets/images/products/product-3.jpg"
    ],

    [
        "id" => "SSISS-10175",
        "date" => "22 February 2026",
        "status" => "Cancelled",
        "statusClass" => "cancelled",
        "total" => 1899,
        "items" => 2,
        "productName" => "Classic Fashion Essentials",
        "image" => "../assets/images/products/product-4.jpg"
    ]

];


/* =========================================
   FILTER
========================================= */

$filter = $_GET["filter"] ?? "all";

$filteredOrders = $orders;


if ($filter !== "all") {

    $filteredOrders = array_filter(

        $orders,

        function ($order) use ($filter) {

            return strtolower($order["status"]) === $filter;

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
            AI Stylist
            <span class="sparkle">✦</span>
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



<!-- =========================================
     MAIN CONTENT
========================================= -->

<main class="orders-page">


    <!-- PAGE HEADER -->

    <section class="orders-page-header">


        <a
            href="../profile/index.php"
            class="back-profile"
        >

            <i class="fa-solid fa-arrow-left"></i>

            BACK TO PROFILE

        </a>


        <p class="section-tag">
            SHOPPING HISTORY
        </p>


        <h1>
            MY <span>ORDERS.</span>
        </h1>


        <p>
            View all your purchases, check
            order status and track your
            deliveries.
        </p>


    </section>



    <!-- ORDER SUMMARY -->

    <section class="orders-summary-grid">


        <article class="order-summary-card">

            <i class="fa-solid fa-bag-shopping"></i>

            <div>

                <span>TOTAL ORDERS</span>

                <strong>
                    <?php echo count($orders); ?>
                </strong>

            </div>

        </article>



        <article class="order-summary-card">

            <i class="fa-solid fa-truck"></i>

            <div>

                <span>IN PROGRESS</span>

                <strong>

                    <?php

                    $inProgress = 0;

                    foreach ($orders as $order) {

                        if (
                            $order["status"] === "Processing"
                            ||
                            $order["status"] === "Shipped"
                        ) {

                            $inProgress++;

                        }

                    }

                    echo $inProgress;

                    ?>

                </strong>

            </div>

        </article>



        <article class="order-summary-card">

            <i class="fa-solid fa-circle-check"></i>

            <div>

                <span>DELIVERED</span>

                <strong>

                    <?php

                    $delivered = 0;

                    foreach ($orders as $order) {

                        if (
                            $order["status"] === "Delivered"
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



    <!-- FILTER SECTION -->

    <section class="orders-filter-section">


        <div class="orders-filter-buttons">


            <a
                href="index.php?filter=all"
                class="order-filter-btn <?php
                echo $filter === "all" ? "active" : "";
                ?>"
            >
                ALL
            </a>


            <a
                href="index.php?filter=processing"
                class="order-filter-btn <?php
                echo $filter === "processing" ? "active" : "";
                ?>"
            >
                PROCESSING
            </a>


            <a
                href="index.php?filter=shipped"
                class="order-filter-btn <?php
                echo $filter === "shipped" ? "active" : "";
                ?>"
            >
                SHIPPED
            </a>


            <a
                href="index.php?filter=delivered"
                class="order-filter-btn <?php
                echo $filter === "delivered" ? "active" : "";
                ?>"
            >
                DELIVERED
            </a>


            <a
                href="index.php?filter=cancelled"
                class="order-filter-btn <?php
                echo $filter === "cancelled" ? "active" : "";
                ?>"
            >
                CANCELLED
            </a>


        </div>


    </section>



    <!-- ORDER LIST -->

    <section class="orders-list-section">


        <div class="section-heading">


            <div>

                <p class="section-tag">
                    YOUR PURCHASES
                </p>


                <h2>
                    ORDER <span>HISTORY.</span>
                </h2>


            </div>


            <span class="orders-count">

                <?php echo count($filteredOrders); ?>

                ORDER(S)

            </span>


        </div>



        <?php if (!empty($filteredOrders)): ?>


            <div class="orders-list">


                <?php foreach ($filteredOrders as $order): ?>


                    <article class="order-card">


                        <!-- TOP -->

                        <div class="order-card-top">


                            <div>

                                <span class="order-id">

                                    ORDER #
                                    <?php
                                    echo htmlspecialchars($order["id"]);
                                    ?>

                                </span>


                                <small>

                                    Placed on
                                    <?php
                                    echo htmlspecialchars($order["date"]);
                                    ?>

                                </small>


                            </div>


                            <span
                                class="order-status <?php
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



                        <!-- PRODUCT -->

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


                            </div>


                        </div>



                        <!-- FOOTER -->

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
                                    href="details.php?id=<?php
                                    echo urlencode(
                                        $order["id"]
                                    );
                                    ?>"
                                    class="view-order-btn"
                                >

                                    VIEW DETAILS

                                </a>


                                <?php
                                if (
                                    $order["status"] === "Shipped"
                                    ||
                                    $order["status"] === "Processing"
                                ):
                                ?>


                                    <a
                                        href="track.php?id=<?php
                                        echo urlencode(
                                            $order["id"]
                                        );
                                        ?>"
                                        class="track-order-btn"
                                    >

                                        <i class="fa-solid fa-location-dot"></i>

                                        TRACK ORDER

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
                    You dont have any orders
                    in this category yet.
                </p>


                <a
                    href="../shop/index.php"
                    class="shop-now-btn"
                >

                    <i class="fa-solid fa-bag-shopping"></i>

                    START SHOPPING

                </a>


            </div>


        <?php endif; ?>


    </section>



</main>



<!-- JAVASCRIPT -->

<script src="../assets/js/orders.js"></script>


</body>

</html>
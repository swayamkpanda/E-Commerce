<?php

$pageTitle = "Track Order | SSISS";


/* =========================================
   GET ORDER ID
========================================= */

$orderId = $_GET["id"] ?? "";


/* =========================================
   TEMPORARY TRACKING DATA

   Later this will come from MySQL.
========================================= */

$orders = [

    "SSISS-10245" => [

        "id" => "SSISS-10245",

        "status" => "Delivered",

        "currentStep" => 5,

        "estimatedDelivery" => "Delivered on 22 March 2026",

        "location" => "Bhubaneswar, Odisha",

        "trackingNumber" => "SSISSIND10245",

        "courier" => "SSISS Delivery",

        "productName" => "Minimal Classic Jacket",

        "image" =>
        "../assets/images/products/product-1.jpg"

    ],


    "SSISS-10231" => [

        "id" => "SSISS-10231",

        "status" => "Shipped",

        "currentStep" => 3,

        "estimatedDelivery" => "25 March 2026",

        "location" => "Cuttack Distribution Center",

        "trackingNumber" => "SSISSIND10231",

        "courier" => "SSISS Delivery",

        "productName" => "Premium Casual Collection",

        "image" =>
        "../assets/images/products/product-2.jpg"

    ],


    "SSISS-10198" => [

        "id" => "SSISS-10198",

        "status" => "Processing",

        "currentStep" => 2,

        "estimatedDelivery" => "28 March 2026",

        "location" => "SSISS Processing Center",

        "trackingNumber" => "SSISSIND10198",

        "courier" => "SSISS Delivery",

        "productName" => "Urban Style Sneakers",

        "image" =>
        "../assets/images/products/product-3.jpg"

    ]

];


/* =========================================
   GET SELECTED ORDER
========================================= */

$order = $orders[$orderId] ?? null;


/* =========================================
   TRACKING STEPS
========================================= */

$trackingSteps = [

    [
        "title" => "Order Placed",

        "description" =>
        "Your order has been successfully placed.",

        "icon" => "fa-bag-shopping"
    ],


    [
        "title" => "Processing",

        "description" =>
        "Your order is being prepared and packed.",

        "icon" => "fa-box"
    ],


    [
        "title" => "Shipped",

        "description" =>
        "Your order has left our facility.",

        "icon" => "fa-truck"
    ],


    [
        "title" => "Out for Delivery",

        "description" =>
        "Your order is on its way to you.",

        "icon" => "fa-location-dot"
    ],


    [
        "title" => "Delivered",

        "description" =>
        "Your order has been delivered successfully.",

        "icon" => "fa-circle-check"
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

<main class="track-order-page">


<?php if ($order): ?>


    <!-- =====================================
         PAGE HEADER
    ====================================== -->

    <section class="track-page-header">


        <a
            href="details.php?id=<?php
            echo urlencode($order["id"]);
            ?>"
            class="back-profile"
        >

            <i class="fa-solid fa-arrow-left"></i>

            BACK TO ORDER DETAILS

        </a>


        <p class="section-tag">

            ORDER TRACKING

        </p>


        <h1>

            TRACK YOUR

            <span>ORDER.</span>

        </h1>


        <p>

            Order #

            <?php
            echo htmlspecialchars($order["id"]);
            ?>

        </p>


    </section>



    <!-- =====================================
         CURRENT STATUS CARD
    ====================================== -->

    <section class="tracking-status-card">


        <div class="tracking-product">


            <div class="tracking-product-image">


                <img
                    src="<?php
                    echo htmlspecialchars($order["image"]);
                    ?>"
                    alt="<?php
                    echo htmlspecialchars(
                        $order["productName"]
                    );
                    ?>"
                >


            </div>


            <div>


                <span>

                    CURRENT ORDER

                </span>


                <h2>

                    <?php
                    echo htmlspecialchars(
                        $order["productName"]
                    );
                    ?>

                </h2>


                <p>

                    Tracking ID:

                    <strong>

                        <?php
                        echo htmlspecialchars(
                            $order["trackingNumber"]
                        );
                        ?>

                    </strong>

                </p>


            </div>


        </div>



        <div class="tracking-current-status">


            <span>

                CURRENT STATUS

            </span>


            <strong>

                <?php
                echo htmlspecialchars(
                    $order["status"]
                );
                ?>

            </strong>


            <p>

                <i class="fa-solid fa-location-dot"></i>

                <?php
                echo htmlspecialchars(
                    $order["location"]
                );
                ?>

            </p>


        </div>


    </section>



    <!-- =====================================
         DELIVERY INFORMATION
    ====================================== -->

    <section class="delivery-info-grid">


        <article class="delivery-info-card">


            <i class="fa-solid fa-calendar-days"></i>


            <div>


                <span>

                    <?php
                    echo $order["status"] === "Delivered"
                        ? "DELIVERY DATE"
                        : "ESTIMATED DELIVERY";
                    ?>

                </span>


                <strong>

                    <?php
                    echo htmlspecialchars(
                        $order["estimatedDelivery"]
                    );
                    ?>

                </strong>


            </div>


        </article>



        <article class="delivery-info-card">


            <i class="fa-solid fa-truck-fast"></i>


            <div>


                <span>

                    DELIVERY PARTNER

                </span>


                <strong>

                    <?php
                    echo htmlspecialchars(
                        $order["courier"]
                    );
                    ?>

                </strong>


            </div>


        </article>


    </section>



    <!-- =====================================
         TRACKING TIMELINE
    ====================================== -->

    <section class="tracking-timeline-section">


        <div class="section-heading">


            <div>


                <p class="section-tag">

                    LIVE ORDER STATUS

                </p>


                <h2>

                    DELIVERY

                    <span>PROGRESS.</span>

                </h2>


            </div>


        </div>



        <div class="tracking-timeline">


            <?php foreach (

                $trackingSteps

                as

                $index => $step

            ): ?>


                <?php

                $stepNumber = $index + 1;

                $isCompleted =
                    $stepNumber < $order["currentStep"];

                $isCurrent =
                    $stepNumber === $order["currentStep"];

                ?>


                <article
                    class="<?php
                        $classes = 'tracking-step';
                        if ($isCompleted) {
                            $classes .= ' completed';
                        }
                        if ($isCurrent) {
                            $classes .= ' current';
                        }
                        echo $classes;
                    ?>"
                >


                    <!-- STEP ICON -->


                    <div class="tracking-step-icon">


                        <?php if ($isCompleted): ?>


                            <i
                                class="fa-solid fa-check"
                            ></i>


                        <?php else: ?>


                            <i
                                class="fa-solid <?php
                                echo htmlspecialchars(
                                    $step["icon"]
                                );
                                ?>"
                            ></i>


                        <?php endif; ?>


                    </div>



                    <!-- STEP CONTENT -->


                    <div class="tracking-step-content">


                        <h3>

                            <?php
                            echo htmlspecialchars(
                                $step["title"]
                            );
                            ?>

                        </h3>


                        <p>

                            <?php
                            echo htmlspecialchars(
                                $step["description"]
                            );
                            ?>

                        </p>


                        <?php if ($isCurrent): ?>


                            <span class="current-step-label">

                                CURRENT STATUS

                            </span>


                        <?php endif; ?>


                    </div>


                </article>


            <?php endforeach; ?>


        </div>


    </section>



    <!-- =====================================
         ORDER ACTIONS
    ====================================== -->

    <section class="tracking-actions">


        <a
            href="details.php?id=<?php
            echo urlencode($order["id"]);
            ?>"
            class="view-order-btn"
        >

            <i class="fa-solid fa-box"></i>

            VIEW ORDER DETAILS

        </a>


        <a
            href="../profile/my-orders.php"
            class="track-order-btn"
        >

            <i class="fa-solid fa-bag-shopping"></i>

            MY ORDERS

        </a>


    </section>


<?php else: ?>


    <!-- =====================================
         ORDER NOT FOUND
    ====================================== -->

    <section class="order-not-found">


        <div class="empty-orders-icon">


            <i class="fa-solid fa-truck"></i>


        </div>


        <h1>

            TRACKING NOT AVAILABLE

        </h1>


        <p>

            We could not find tracking
            information for this order.

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

<?php

$pageTitle = "Sold Items | SSISS";


/* =========================================
   TEMPORARY SOLD ITEMS DATA
   Later replace with MySQL queries
========================================= */

$soldItems = [

    [
        "id" => 201,
        "name" => "Vintage Brown Leather Jacket",
        "category" => "Men",
        "size" => "L",
        "condition" => "Excellent",
        "soldPrice" => 1499,
        "originalPrice" => 3999,
        "buyer" => "Arjun Kumar",
        "image" => "../assets/images/products/vintage-leather-jacket.jpg",
        "soldDate" => "24 Aug 2026",
        "status" => "Completed"
    ],

    [
        "id" => 202,
        "name" => "Classic White Sneakers",
        "category" => "Men",
        "size" => "9",
        "condition" => "Like New",
        "soldPrice" => 999,
        "originalPrice" => 2499,
        "buyer" => "Rohit Das",
        "image" => "../assets/images/products/white-sneakers.jpg",
        "soldDate" => "18 Aug 2026",
        "status" => "Completed"
    ],

    [
        "id" => 203,
        "name" => "Olive Green Overshirt",
        "category" => "Men",
        "size" => "M",
        "condition" => "Good",
        "soldPrice" => 649,
        "originalPrice" => 1599,
        "buyer" => "Amit Singh",
        "image" => "../assets/images/products/olive-overshirt.jpg",
        "soldDate" => "11 Aug 2026",
        "status" => "Completed"
    ]

];


/* =========================================
   CALCULATE STATISTICS
========================================= */

$totalSoldItems = count($soldItems);


$totalEarnings = array_sum(
    array_column(
        $soldItems,
        "soldPrice"
    )
);


$averageSalePrice =

    $totalSoldItems > 0

        ? $totalEarnings / $totalSoldItems

        : 0;


/* =========================================
   FILTER
========================================= */

$filter = $_GET["filter"] ?? "All";


$filteredItems = $soldItems;


if ($filter !== "All") {

    $filteredItems = array_filter(

        $soldItems,

        function ($item) use ($filter) {

            return
                $item["category"]
                ===
                $filter;

        }

    );

}


/* =========================================
   GET UNIQUE CATEGORIES
========================================= */

$categories = array_unique(

    array_column(
        $soldItems,
        "category"
    )

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
     SOLD ITEMS PAGE
========================================= -->

<main class="marketplace-sold-page">


    <!-- BACK BUTTON -->

    <a
        href="my-listings.php"
        class="marketplace-back-btn"
    >

        <i class="fa-solid fa-arrow-left"></i>

        BACK TO MY LISTINGS

    </a>



    <!-- =====================================
         PAGE HEADER
    ====================================== -->

    <section class="marketplace-sold-header">


        <div>


            <p class="section-tag">

                SELLER HISTORY

            </p>


            <h1>

                SOLD

                <span>ITEMS.</span>

            </h1>


            <p>

                Track your completed sales and see the
                value you have earned from giving your
                clothes a second life.

            </p>


        </div>


        <a
            href="create-listing.php"
            class="marketplace-primary-btn"
        >

            <i class="fa-solid fa-plus"></i>

            SELL ANOTHER ITEM

        </a>


    </section>



    <!-- =====================================
         EARNINGS STATISTICS
    ====================================== -->

    <section class="marketplace-sold-stats-grid">


        <!-- TOTAL SOLD -->

        <article class="marketplace-sold-stat-card">


            <div class="marketplace-stat-icon">


                <i class="fa-solid fa-box"></i>


            </div>


            <div>


                <span>

                    ITEMS SOLD

                </span>


                <strong>

                    <?php
                    echo $totalSoldItems;
                    ?>

                </strong>


            </div>


        </article>



        <!-- TOTAL EARNINGS -->

        <article class="marketplace-sold-stat-card">


            <div class="marketplace-stat-icon">


                <i class="fa-solid fa-wallet"></i>


            </div>


            <div>


                <span>

                    TOTAL EARNINGS

                </span>


                <strong>

                    ₹<?php
                    echo number_format(
                        $totalEarnings
                    );
                    ?>

                </strong>


            </div>


        </article>



        <!-- AVERAGE SALE -->

        <article class="marketplace-sold-stat-card">


            <div class="marketplace-stat-icon">


                <i class="fa-solid fa-chart-line"></i>


            </div>


            <div>


                <span>

                    AVERAGE SALE

                </span>


                <strong>

                    ₹<?php
                    echo number_format(
                        $averageSalePrice
                    );
                    ?>

                </strong>


            </div>


        </article>


    </section>



    <!-- =====================================
         FILTER
    ====================================== -->

    <section class="marketplace-sold-filters">


        <a
            href="sold.php?filter=All"
            class="marketplace-category-btn <?php
            echo $filter === "All"
                ? "active"
                : "";
            ?>"
        >

            ALL

        </a>


        <?php foreach ($categories as $category): ?>


            <a
                href="sold.php?filter=<?php
                echo urlencode(
                    $category
                );
                ?>"
                class="marketplace-category-btn <?php
                echo $filter === $category
                    ? "active"
                    : "";
                ?>"
            >

                <?php
                echo htmlspecialchars(
                    strtoupper(
                        $category
                    )
                );
                ?>

            </a>


        <?php endforeach; ?>


    </section>



    <!-- =====================================
         SOLD ITEMS LIST
    ====================================== -->

    <section class="marketplace-sold-items-list">


        <?php if (!empty($filteredItems)): ?>


            <?php foreach ($filteredItems as $item): ?>


                <article class="marketplace-sold-item-card">


                    <!-- IMAGE -->

                    <div class="marketplace-sold-item-image">


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


                        <span class="marketplace-sold-badge">


                            <i class="fa-solid fa-circle-check"></i>

                            SOLD

                        </span>


                    </div>



                    <!-- DETAILS -->

                    <div class="marketplace-sold-item-details">


                        <span class="marketplace-category">


                            <?php
                            echo htmlspecialchars(
                                $item["category"]
                            );
                            ?>


                        </span>


                        <h2>


                            <?php
                            echo htmlspecialchars(
                                $item["name"]
                            );
                            ?>


                        </h2>


                        <div class="marketplace-product-meta">


                            <span>


                                SIZE:

                                <strong>


                                    <?php
                                    echo htmlspecialchars(
                                        $item["size"]
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
                                    $item["condition"]
                                );
                                ?>


                            </span>


                        </div>


                        <p class="marketplace-sold-buyer">


                            <i class="fa-solid fa-user"></i>

                            SOLD TO:

                            <strong>


                                <?php
                                echo htmlspecialchars(
                                    $item["buyer"]
                                );
                                ?>


                            </strong>


                        </p>


                    </div>



                    <!-- SALE DETAILS -->

                    <div class="marketplace-sale-summary">


                        <div>


                            <span>

                                SOLD FOR

                            </span>


                            <strong>

                                ₹<?php
                                echo number_format(
                                    $item["soldPrice"]
                                );
                                ?>

                            </strong>


                        </div>


                        <div>


                            <span>

                                SOLD ON

                            </span>


                            <p>


                                <?php
                                echo htmlspecialchars(
                                    $item["soldDate"]
                                );
                                ?>


                            </p>


                        </div>


                        <span class="marketplace-sale-complete">


                            <i class="fa-solid fa-circle-check"></i>

                            <?php
                            echo htmlspecialchars(
                                $item["status"]
                            );
                            ?>


                        </span>


                    </div>


                </article>


            <?php endforeach; ?>


        <?php else: ?>


            <!-- EMPTY STATE -->


            <div class="marketplace-empty-state">


                <div class="marketplace-empty-icon">


                    <i class="fa-solid fa-box-open"></i>


                </div>


                <h3>

                    NO SOLD ITEMS FOUND

                </h3>


                <p>

                    You haven't sold any items in this
                    category yet.

                </p>


                <a
                    href="create-listing.php"
                    class="marketplace-primary-btn"
                >

                    SELL YOUR FIRST ITEM

                </a>


            </div>


        <?php endif; ?>


    </section>



    <!-- =====================================
         SUSTAINABILITY MESSAGE
    ====================================== -->

    <section class="marketplace-sold-impact">


        <div class="marketplace-sold-impact-icon">


            <i class="fa-solid fa-recycle"></i>


        </div>


        <div>


            <p class="section-tag">

                YOUR IMPACT

            </p>


            <h2>

                EVERY SALE HELPS

                <span>REDUCE WASTE.</span>

            </h2>


            <p>

                By selling clothes instead of throwing them
                away, you help extend their lifecycle and
                support a more circular fashion system.

            </p>


        </div>


    </section>


</main>



<!-- PROJECT JAVASCRIPT -->

<script src="../assets/js/marketplace.js"></script>


</body>

</html>
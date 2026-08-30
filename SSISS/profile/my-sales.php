<?php

$pageTitle = "My Sales | SSISS";

$sales = [

    [
        "id" => "SALE-1001",
        "name" => "Vintage Denim Jacket",
        "price" => 1499,
        "status" => "Sold",
        "statusClass" => "sold",
        "date" => "18 March 2026",
        "image" => "../assets/images/products/product-1.jpg"
    ],

    [
        "id" => "SALE-1002",
        "name" => "Classic White Sneakers",
        "price" => 2199,
        "status" => "Active",
        "statusClass" => "active",
        "date" => "15 March 2026",
        "image" => "../assets/images/products/product-2.jpg"
    ],

    [
        "id" => "SALE-1003",
        "name" => "Minimal Black Watch",
        "price" => 1799,
        "status" => "Pending",
        "statusClass" => "pending",
        "date" => "12 March 2026",
        "image" => "../assets/images/products/product-3.jpg"
    ]

];

$totalSales = 12;
$totalEarnings = 18500;
$activeListings = 5;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title><?php echo $pageTitle; ?></title>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    >

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

<header class="navbar">

    <a href="../index.php" class="logo">
        SSI<span>SS</span>
    </a>


    <nav class="nav-links">

        <a href="../index.php">Home</a>

        <a href="../shop/index.php">Shop</a>

        <a href="../ai/index.php">
            AI Stylist
            <span class="sparkle">✦</span>
        </a>

        <a href="../wardrobe/index.php">Wardrobe</a>

        <a href="../marketplace/index.php">
            Pre-Loved
        </a>

        <a href="../impact/index.php">
            Impact
        </a>

    </nav>


    <div class="nav-actions">

        <a href="../shop/search.php" class="icon-btn">
            <i class="fa-solid fa-magnifying-glass"></i>
        </a>

        <a href="../wishlist/index.php" class="icon-btn">
            <i class="fa-regular fa-heart"></i>
        </a>

        <a href="../cart/index.php" class="icon-btn">
            <i class="fa-solid fa-bag-shopping"></i>
        </a>

        <a href="index.php" class="profile-btn">
            <i class="fa-solid fa-user"></i>
        </a>

    </div>

</header>



<main class="my-sales-page">

    <section class="profile-page-header">

        <a href="index.php" class="back-profile">

            <i class="fa-solid fa-arrow-left"></i>

            BACK TO PROFILE

        </a>


        <p class="section-tag">
            PRE-LOVED MARKETPLACE
        </p>


        <h1>
            MY <span>SALES.</span>
        </h1>


        <p>
            Manage your pre-loved listings,
            track your sales and monitor
            your earnings.
        </p>

    </section>



    <section class="sales-summary-grid">

        <article class="sales-summary-card">

            <i class="fa-solid fa-bag-shopping"></i>

            <div>

                <span>TOTAL SALES</span>

                <strong>
                    <?php echo $totalSales; ?>
                </strong>

            </div>

        </article>



        <article class="sales-summary-card">

            <i class="fa-solid fa-indian-rupee-sign"></i>

            <div>

                <span>TOTAL EARNINGS</span>

                <strong>
                    ₹<?php echo number_format($totalEarnings); ?>
                </strong>

            </div>

        </article>



        <article class="sales-summary-card">

            <i class="fa-solid fa-shirt"></i>

            <div>

                <span>ACTIVE LISTINGS</span>

                <strong>
                    <?php echo $activeListings; ?>
                </strong>

            </div>

        </article>

    </section>



    <section class="profile-content-section">

        <div class="section-heading">

            <div>

                <p class="section-tag">
                    YOUR MARKETPLACE
                </p>

                <h2>
                    RECENT <span>LISTINGS.</span>
                </h2>

            </div>


            <a
                href="../marketplace/index.php"
                class="profile-small-btn"
            >
                SELL AN ITEM
            </a>

        </div>



        <div class="sales-list">

            <?php foreach ($sales as $sale): ?>

                <article class="sale-card">

                    <div class="sale-image">

                        <img
                            src="<?php echo htmlspecialchars($sale["image"]); ?>"
                            alt="<?php echo htmlspecialchars($sale["name"]); ?>"
                        >

                    </div>


                    <div class="sale-info">

                        <span class="sale-id">

                            <?php echo htmlspecialchars($sale["id"]); ?>

                        </span>


                        <h3>

                            <?php
                            echo htmlspecialchars($sale["name"]);
                            ?>

                        </h3>


                        <p>

                            Listed on
                            <?php echo htmlspecialchars($sale["date"]); ?>

                        </p>

                    </div>


                    <div class="sale-price">

                        ₹<?php
                        echo number_format($sale["price"]);
                        ?>

                    </div>


                    <span
                        class="sale-status <?php
                        echo htmlspecialchars($sale["statusClass"]);
                        ?>"
                    >

                        <?php
                        echo htmlspecialchars($sale["status"]);
                        ?>

                    </span>


                    <a
                        href="../marketplace/index.php"
                        class="sale-view-btn"
                    >

                        VIEW

                    </a>

                </article>

            <?php endforeach; ?>

        </div>

    </section>



    <section class="profile-cta">

        <div>

            <p class="section-tag">
                GIVE IT A SECOND LIFE
            </p>

            <h2>
                SELL WHAT YOU
                <span>NO LONGER WEAR.</span>
            </h2>

            <p>
                Turn your unused fashion items
                into value and help reduce
                textile waste.
            </p>

        </div>


        <a
            href="../marketplace/index.php"
            class="generate-outfit-main-btn"
        >

            <i class="fa-solid fa-plus"></i>

            CREATE LISTING

        </a>

    </section>

</main>


<script src="../assets/js/profile.js"></script>

</body>
</html>
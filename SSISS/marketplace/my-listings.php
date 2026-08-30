<?php

$pageTitle = "My Listings | SSISS";


/* =========================================
   TEMPORARY USER LISTING DATA
   Later replace with MySQL queries
========================================= */

$listings = [

    [
        "id" => 101,
        "name" => "Classic Blue Denim Jacket",
        "category" => "Men",
        "size" => "M",
        "condition" => "Excellent",
        "price" => 899,
        "originalPrice" => 2499,
        "image" => "../assets/images/products/denim-jacket.jpg",
        "status" => "Active",
        "views" => 124,
        "likes" => 18,
        "listedDate" => "12 Aug 2026"
    ],

    [
        "id" => 102,
        "name" => "Black Casual Hoodie",
        "category" => "Men",
        "size" => "L",
        "condition" => "Like New",
        "price" => 699,
        "originalPrice" => 1799,
        "image" => "../assets/images/products/black-hoodie.jpg",
        "status" => "Active",
        "views" => 89,
        "likes" => 11,
        "listedDate" => "08 Aug 2026"
    ],

    [
        "id" => 103,
        "name" => "Cotton Summer Shirt",
        "category" => "Men",
        "size" => "M",
        "condition" => "Good",
        "price" => 499,
        "originalPrice" => 1299,
        "image" => "../assets/images/products/casual-shirt.jpg",
        "status" => "Pending",
        "views" => 42,
        "likes" => 5,
        "listedDate" => "28 Aug 2026"
    ],

    [
        "id" => 104,
        "name" => "Vintage Denim Jeans",
        "category" => "Men",
        "size" => "32",
        "condition" => "Excellent",
        "price" => 799,
        "originalPrice" => 2199,
        "image" => "../assets/images/products/denim-jeans.jpg",
        "status" => "Active",
        "views" => 76,
        "likes" => 9,
        "listedDate" => "03 Aug 2026"
    ]

];


/* =========================================
   FILTER BY STATUS
========================================= */

$statusFilter = $_GET["status"] ?? "All";


$filteredListings = array_filter(

    $listings,

    function ($listing) use ($statusFilter) {

        if ($statusFilter === "All") {

            return true;

        }

        return
            strtolower($listing["status"])
            ===
            strtolower($statusFilter);

    }

);


/* =========================================
   CALCULATE DASHBOARD STATISTICS
========================================= */

$totalListings =
    count($listings);


$activeListings =
    count(
        array_filter(
            $listings,
            function ($listing) {

                return
                    $listing["status"]
                    ===
                    "Active";

            }
        )
    );


$pendingListings =
    count(
        array_filter(
            $listings,
            function ($listing) {

                return
                    $listing["status"]
                    ===
                    "Pending";

            }
        )
    );


$totalViews =
    array_sum(
        array_column(
            $listings,
            "views"
        )
    );


$totalLikes =
    array_sum(
        array_column(
            $listings,
            "likes"
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
     MY LISTINGS PAGE
========================================= -->

<main class="marketplace-listings-page">


    <!-- =====================================
         BACK BUTTON
    ====================================== -->

    <a
        href="index.php"
        class="marketplace-back-btn"
    >

        <i class="fa-solid fa-arrow-left"></i>

        BACK TO MARKETPLACE

    </a>



    <!-- =====================================
         PAGE HEADER
    ====================================== -->

    <section class="marketplace-listings-header">


        <div>


            <p class="section-tag">

                SELLER DASHBOARD

            </p>


            <h1>

                MY

                <span>LISTINGS.</span>

            </h1>


            <p>

                Manage your active items, pending listings,
                and marketplace activity.

            </p>


        </div>


        <div class="marketplace-listings-header-actions">


            <a
                href="sold.php"
                class="marketplace-secondary-btn"
            >

                <i class="fa-solid fa-box"></i>

                SOLD ITEMS

            </a>


            <a
                href="create-listing.php"
                class="marketplace-primary-btn"
            >

                <i class="fa-solid fa-plus"></i>

                CREATE LISTING

            </a>


        </div>


    </section>



    <!-- =====================================
         STATISTICS
    ====================================== -->

    <section class="marketplace-listings-stats-grid">


        <!-- TOTAL LISTINGS -->

        <article class="marketplace-listings-stat-card">


            <div class="marketplace-stat-icon">


                <i class="fa-solid fa-list"></i>


            </div>


            <div>


                <span>

                    TOTAL LISTINGS

                </span>


                <strong>

                    <?php
                    echo $totalListings;
                    ?>

                </strong>


            </div>


        </article>



        <!-- ACTIVE LISTINGS -->

        <article class="marketplace-listings-stat-card">


            <div class="marketplace-stat-icon">


                <i class="fa-solid fa-circle-check"></i>


            </div>


            <div>


                <span>

                    ACTIVE

                </span>


                <strong>

                    <?php
                    echo $activeListings;
                    ?>

                </strong>


            </div>


        </article>



        <!-- PENDING -->

        <article class="marketplace-listings-stat-card">


            <div class="marketplace-stat-icon">


                <i class="fa-solid fa-clock"></i>


            </div>


            <div>


                <span>

                    PENDING

                </span>


                <strong>

                    <?php
                    echo $pendingListings;
                    ?>

                </strong>


            </div>


        </article>



        <!-- TOTAL VIEWS -->

        <article class="marketplace-listings-stat-card">


            <div class="marketplace-stat-icon">


                <i class="fa-solid fa-eye"></i>


            </div>


            <div>


                <span>

                    TOTAL VIEWS

                </span>


                <strong>

                    <?php
                    echo number_format($totalViews);
                    ?>

                </strong>


            </div>


        </article>


    </section>



    <!-- =====================================
         FILTERS
    ====================================== -->

    <section class="marketplace-listings-filters">


        <?php

        $filters = [
            "All",
            "Active",
            "Pending"
        ];

        ?>


        <?php foreach ($filters as $filter): ?>


            <a
                href="my-listings.php?status=<?php
                echo urlencode($filter);
                ?>"
                class="marketplace-category-btn <?php
                echo $statusFilter === $filter
                    ? "active"
                    : "";
                ?>"
            >

                <?php
                echo htmlspecialchars($filter);
                ?>

            </a>


        <?php endforeach; ?>


    </section>



    <!-- =====================================
         LISTINGS GRID
    ====================================== -->

    <section class="marketplace-my-listings-grid">


        <?php if (!empty($filteredListings)): ?>


            <?php foreach ($filteredListings as $listing): ?>


                <article class="marketplace-my-listing-card">


                    <!-- IMAGE -->

                    <a
                        href="product.php?id=<?php
                        echo urlencode(
                            $listing["id"]
                        );
                        ?>"
                        class="marketplace-my-listing-image"
                    >


                        <img
                            src="<?php
                            echo htmlspecialchars(
                                $listing["image"]
                            );
                            ?>"
                            alt="<?php
                            echo htmlspecialchars(
                                $listing["name"]
                            );
                            ?>"
                        >


                        <span
                            class="marketplace-listing-status <?php
                            echo strtolower(
                                $listing["status"]
                            );
                            ?>"
                        >

                            <?php
                            echo htmlspecialchars(
                                $listing["status"]
                            );
                            ?>

                        </span>


                    </a>



                    <!-- CONTENT -->

                    <div class="marketplace-my-listing-content">


                        <div class="marketplace-listing-category-row">


                            <span class="marketplace-category">


                                <?php
                                echo htmlspecialchars(
                                    $listing["category"]
                                );
                                ?>


                            </span>


                            <span class="marketplace-listing-date">


                                <?php
                                echo htmlspecialchars(
                                    $listing["listedDate"]
                                );
                                ?>


                            </span>


                        </div>



                        <h3>


                            <?php
                            echo htmlspecialchars(
                                $listing["name"]
                            );
                            ?>


                        </h3>



                        <div class="marketplace-product-meta">


                            <span>


                                SIZE:

                                <strong>


                                    <?php
                                    echo htmlspecialchars(
                                        $listing["size"]
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
                                    $listing["condition"]
                                );
                                ?>


                            </span>


                        </div>



                        <div class="marketplace-price">


                            <strong>


                                ₹<?php
                                echo number_format(
                                    $listing["price"]
                                );
                                ?>


                            </strong>


                            <span>


                                ₹<?php
                                echo number_format(
                                    $listing["originalPrice"]
                                );
                                ?>


                            </span>


                        </div>



                        <!-- PERFORMANCE -->

                        <div class="marketplace-listing-performance">


                            <span>


                                <i class="fa-solid fa-eye"></i>


                                <?php
                                echo number_format(
                                    $listing["views"]
                                );
                                ?>


                            </span>


                            <span>


                                <i class="fa-solid fa-heart"></i>


                                <?php
                                echo number_format(
                                    $listing["likes"]
                                );
                                ?>


                            </span>


                        </div>



                        <!-- ACTIONS -->

                        <div class="marketplace-listing-actions">


                            <a
                                href="edit-listing.php?id=<?php
                                echo urlencode(
                                    $listing["id"]
                                );
                                ?>"
                                class="marketplace-edit-btn"
                            >


                                <i class="fa-solid fa-pen"></i>

                                EDIT


                            </a>


                            <a
                                href="#"
                                class="marketplace-remove-btn"
                                onclick="
                                    return confirm(
                                        'Are you sure you want to remove this listing?'
                                    );
                                "
                            >


                                <i class="fa-solid fa-trash"></i>

                                REMOVE


                            </a>


                        </div>


                    </div>


                </article>


            <?php endforeach; ?>


        <?php else: ?>


            <!-- EMPTY STATE -->


            <div class="marketplace-empty-state">


                <div class="marketplace-empty-icon">


                    <i class="fa-solid fa-list"></i>


                </div>


                <h3>

                    NO LISTINGS FOUND

                </h3>


                <p>

                    You don't have any listings in this
                    category yet.

                </p>


                <a
                    href="create-listing.php"
                    class="marketplace-primary-btn"
                >

                    CREATE YOUR FIRST LISTING

                </a>


            </div>


        <?php endif; ?>


    </section>



    <!-- =====================================
         SELLER PERFORMANCE
    ====================================== -->

    <section class="marketplace-performance-section">


        <div class="marketplace-performance-content">


            <p class="section-tag">

                MARKETPLACE ACTIVITY

            </p>


            <h2>

                YOUR LISTINGS ARE

                <span>GETTING NOTICED.</span>

            </h2>


            <p>

                You have received

                <strong>

                    <?php
                    echo number_format($totalViews);
                    ?>

                    total views

                </strong>

                and

                <strong>

                    <?php
                    echo number_format($totalLikes);
                    ?>

                    likes

                </strong>

                across your active marketplace listings.

            </p>


        </div>


        <div class="marketplace-performance-icon">


            <i class="fa-solid fa-chart-line"></i>


        </div>


    </section>


</main>



<!-- =========================================
     PROJECT JAVASCRIPT
========================================= -->

<script src="../assets/js/marketplace.js"></script>


</body>

</html>
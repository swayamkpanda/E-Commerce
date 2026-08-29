<?php

session_start();

/*
|--------------------------------------------------------------------------
| SSISS ADMIN - REVIEW MANAGEMENT
|--------------------------------------------------------------------------
| Demo version.
| MySQL review integration will be connected later.
|--------------------------------------------------------------------------
*/

$adminName = $_SESSION['admin_name'] ?? 'Admin';


// ==========================================================
// DEMO REVIEWS
// ==========================================================

$reviews = [

    [
        'id' => 1,
        'customer' => 'Aarav Sharma',
        'email' => 'aarav@example.com',
        'product' => 'Oversized Essential Tee',
        'rating' => 5,
        'review' => 'The fit is amazing and the fabric feels premium. Perfect for daily wear.',
        'verified' => true,
        'sentiment' => 'Positive',
        'status' => 'Published',
        'flagged' => false,
        'date' => '29 Aug 2026'
    ],

    [
        'id' => 2,
        'customer' => 'Ananya Das',
        'email' => 'ananya@example.com',
        'product' => 'Classic Runner Sneakers',
        'rating' => 4,
        'review' => 'Really comfortable sneakers. Took a little time to break in but now they are great.',
        'verified' => true,
        'sentiment' => 'Positive',
        'status' => 'Published',
        'flagged' => false,
        'date' => '28 Aug 2026'
    ],

    [
        'id' => 3,
        'customer' => 'Rohan Patel',
        'email' => 'rohan@example.com',
        'product' => 'Relaxed Cargo Pants',
        'rating' => 3,
        'review' => 'Good material but the sizing feels slightly different from the size chart.',
        'verified' => true,
        'sentiment' => 'Neutral',
        'status' => 'Published',
        'flagged' => false,
        'date' => '28 Aug 2026'
    ],

    [
        'id' => 4,
        'customer' => 'Diya Mehta',
        'email' => 'diya@example.com',
        'product' => 'Minimal Steel Watch',
        'rating' => 5,
        'review' => 'Looks even better in person. The minimal design is exactly what I wanted.',
        'verified' => true,
        'sentiment' => 'Positive',
        'status' => 'Published',
        'flagged' => false,
        'date' => '27 Aug 2026'
    ],

    [
        'id' => 5,
        'customer' => 'Kabir Singh',
        'email' => 'kabir@example.com',
        'product' => 'Retro Square Frames',
        'rating' => 2,
        'review' => 'The product arrived late and the frame was not what I expected.',
        'verified' => true,
        'sentiment' => 'Negative',
        'status' => 'Pending',
        'flagged' => true,
        'date' => '27 Aug 2026'
    ],

    [
        'id' => 6,
        'customer' => 'Meera Nair',
        'email' => 'meera@example.com',
        'product' => 'Vintage Denim Jacket',
        'rating' => 5,
        'review' => 'Loved the vintage look! Quality is excellent for a pre-loved piece.',
        'verified' => true,
        'sentiment' => 'Positive',
        'status' => 'Published',
        'flagged' => false,
        'date' => '26 Aug 2026'
    ],

    [
        'id' => 7,
        'customer' => 'Vihaan Roy',
        'email' => 'vihaan@example.com',
        'product' => 'Signature Oversized Hoodie',
        'rating' => 1,
        'review' => 'Poor experience. The product did not match the description.',
        'verified' => false,
        'sentiment' => 'Negative',
        'status' => 'Pending',
        'flagged' => true,
        'date' => '26 Aug 2026'
    ],

    [
        'id' => 8,
        'customer' => 'Ishita Sen',
        'email' => 'ishita@example.com',
        'product' => 'Cloud Street Sneakers',
        'rating' => 4,
        'review' => 'Nice design and comfortable for college. Would recommend.',
        'verified' => true,
        'sentiment' => 'Positive',
        'status' => 'Published',
        'flagged' => false,
        'date' => '25 Aug 2026'
    ],

    [
        'id' => 9,
        'customer' => 'Arjun Kapoor',
        'email' => 'arjun@example.com',
        'product' => 'Urban Essential Shirt',
        'rating' => 3,
        'review' => 'Decent shirt. Nothing extraordinary but good for the price.',
        'verified' => true,
        'sentiment' => 'Neutral',
        'status' => 'Published',
        'flagged' => false,
        'date' => '24 Aug 2026'
    ],

    [
        'id' => 10,
        'customer' => 'Saanvi Rao',
        'email' => 'saanvi@example.com',
        'product' => 'Old Money Blazer',
        'rating' => 5,
        'review' => 'Absolutely beautiful. The fit and finish are premium.',
        'verified' => true,
        'sentiment' => 'Positive',
        'status' => 'Published',
        'flagged' => false,
        'date' => '23 Aug 2026'
    ]

];


// ==========================================================
// FILTERS
// ==========================================================

$search = trim($_GET['search'] ?? '');

$ratingFilter = trim($_GET['rating'] ?? '');

$statusFilter = trim($_GET['status'] ?? '');

$sentimentFilter = trim(
    $_GET['sentiment'] ?? ''
);


// ==========================================================
// FILTER REVIEWS
// ==========================================================

$filteredReviews = array_filter(

    $reviews,

    function ($review) use (
        $search,
        $ratingFilter,
        $statusFilter,
        $sentimentFilter
    ) {

        // Search

        if ($search !== '') {

            $searchText = strtolower(

                $review['customer'] . ' ' .
                $review['email'] . ' ' .
                $review['product'] . ' ' .
                $review['review']

            );

            if (
                strpos(
                    $searchText,
                    strtolower($search)
                ) === false
            ) {

                return false;

            }

        }


        // Rating

        if (
            $ratingFilter !== '' &&
            (int)$review['rating'] !==
            (int)$ratingFilter
        ) {

            return false;

        }


        // Status

        if (
            $statusFilter !== '' &&
            $review['status'] !== $statusFilter
        ) {

            return false;

        }


        // Sentiment

        if (
            $sentimentFilter !== '' &&
            $review['sentiment'] !==
            $sentimentFilter
        ) {

            return false;

        }


        return true;

    }

);


// ==========================================================
// STATISTICS
// ==========================================================

$totalReviews = count($reviews);


$publishedReviews = count(

    array_filter(

        $reviews,

        function ($review) {

            return $review['status'] ===
                'Published';

        }

    )

);


$pendingReviews = count(

    array_filter(

        $reviews,

        function ($review) {

            return $review['status'] ===
                'Pending';

        }

    )

);


$flaggedReviews = count(

    array_filter(

        $reviews,

        function ($review) {

            return $review['flagged'] === true;

        }

    )

);


// Average rating

$totalRating = 0;

foreach ($reviews as $review) {

    $totalRating +=
        $review['rating'];

}


$averageRating =
    $totalReviews > 0
        ? $totalRating / $totalReviews
        : 0;


// Sentiment counts

$positiveReviews = count(

    array_filter(

        $reviews,

        function ($review) {

            return $review['sentiment'] ===
                'Positive';

        }

    )

);


$negativeReviews = count(

    array_filter(

        $reviews,

        function ($review) {

            return $review['sentiment'] ===
                'Negative';

        }

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
        Reviews | SSISS Admin
    </title>


    <link
        rel="stylesheet"
        href="../assets/css/style.css"
    >

    <link
        rel="stylesheet"
        href="../assets/css/dashboard.css"
    >

</head>


<body>


<div class="admin-layout">


    <!-- ======================================================
         SIDEBAR
    ======================================================= -->

    <aside class="admin-sidebar">


        <div class="admin-logo">
            SSISS
        </div>


        <div class="admin-label">
            ADMIN PANEL
        </div>


        <nav class="admin-nav">


            <a
                href="index.php"
                class="admin-nav-item"
            >
                <span>⌂</span>
                Dashboard
            </a>


            <a
                href="products.php"
                class="admin-nav-item"
            >
                <span>◈</span>
                Products
            </a>


            <a
                href="categories.php"
                class="admin-nav-item"
            >
                <span>▦</span>
                Categories
            </a>


            <a
                href="brands.php"
                class="admin-nav-item"
            >
                <span>◇</span>
                Brands
            </a>


            <a
                href="inventory.php"
                class="admin-nav-item"
            >
                <span>▤</span>
                Inventory
            </a>


            <a
                href="orders.php"
                class="admin-nav-item"
            >
                <span>□</span>
                Orders
            </a>


            <a
                href="users.php"
                class="admin-nav-item"
            >
                <span>♙</span>
                Users
            </a>


            <div class="admin-nav-divider"></div>


            <div class="admin-section-title">
                CIRCULAR FASHION
            </div>


            <a
                href="resale.php"
                class="admin-nav-item"
            >
                <span>♻</span>
                Pre-Loved
            </a>


            <a
                href="donations.php"
                class="admin-nav-item"
            >
                <span>♥</span>
                Donations
            </a>


            <a
                href="ngos.php"
                class="admin-nav-item"
            >
                <span>◎</span>
                NGOs
            </a>


            <div class="admin-nav-divider"></div>


            <div class="admin-section-title">
                AI & REWARDS
            </div>


            <a
                href="coins.php"
                class="admin-nav-item"
            >
                <span>🪙</span>
                SSISS Coins
            </a>


            <a
                href="rewards.php"
                class="admin-nav-item"
            >
                <span>✦</span>
                Rewards
            </a>


            <a
                href="ai-analytics.php"
                class="admin-nav-item"
            >
                <span>✧</span>
                AI Analytics
            </a>


            <div class="admin-nav-divider"></div>


            <a
                href="reports.php"
                class="admin-nav-item"
            >
                <span>▥</span>
                Reports
            </a>


            <a
                href="settings.php"
                class="admin-nav-item"
            >
                <span>⚙</span>
                Settings
            </a>


        </nav>


        <div class="admin-sidebar-bottom">


            <a
                href="../index.php"
                class="view-store"
            >
                ← View Store
            </a>


            <div class="admin-profile-mini">


                <div class="admin-avatar">

                    <?= htmlspecialchars(
                        strtoupper(
                            substr(
                                $adminName,
                                0,
                                1
                            )
                        )
                    ); ?>

                </div>


                <div>

                    <strong>
                        <?= htmlspecialchars(
                            $adminName
                        ); ?>
                    </strong>


                    <small>
                        Administrator
                    </small>

                </div>


            </div>


        </div>


    </aside>


    <!-- ======================================================
         MAIN CONTENT
    ======================================================= -->

    <main class="admin-main">


        <!-- ==================================================
             HEADER
        =================================================== -->

        <header class="admin-topbar">


            <div>

                <p class="admin-breadcrumb">
                    SSISS / Reviews
                </p>


                <h1>
                    Reviews
                </h1>


                <p class="admin-subtitle">
                    Manage customer feedback, ratings and review moderation.
                </p>


            </div>


        </header>


        <!-- ==================================================
             PAGE ACTIONS
        =================================================== -->

        <section class="page-actions">


            <div>

                <h2>
                    Review Management
                </h2>


                <p>
                    Monitor customer feedback and maintain review quality.
                </p>


            </div>


            <button
                type="button"
                class="btn btn-primary"
                onclick="alert('Review export will be connected later.')"
            >
                ↓ Export Reviews
            </button>


        </section>


        <!-- ==================================================
             STATISTICS
        =================================================== -->

        <section class="stats-grid">


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ★
                    </span>

                </div>


                <p>
                    Total Reviews
                </p>


                <h2>
                    <?= number_format(
                        $totalReviews
                    ); ?>
                </h2>


                <small>
                    Customer reviews
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ★
                    </span>

                </div>


                <p>
                    Average Rating
                </p>


                <h2>
                    <?= number_format(
                        $averageRating,
                        1
                    ); ?>
                    / 5
                </h2>


                <small>
                    Across all reviews
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ◷
                    </span>

                </div>


                <p>
                    Pending
                </p>


                <h2>
                    <?= number_format(
                        $pendingReviews
                    ); ?>
                </h2>


                <small>
                    Waiting for moderation
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ⚑
                    </span>

                </div>


                <p>
                    Flagged
                </p>


                <h2>
                    <?= number_format(
                        $flaggedReviews
                    ); ?>
                </h2>


                <small>
                    Need attention
                </small>


            </div>


        </section>


        <!-- ==================================================
             SENTIMENT SUMMARY
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        AI Sentiment Overview
                    </h3>


                    <p>
                        Demo sentiment classification for customer reviews.
                    </p>

                </div>


            </div>


            <div class="stats-grid">


                <div class="stat-card">


                    <p>
                        Positive
                    </p>


                    <h2>
                        <?= number_format(
                            $positiveReviews
                        ); ?>
                    </h2>


                    <small>
                        Positive customer sentiment
                    </small>


                </div>


                <div class="stat-card">


                    <p>
                        Negative
                    </p>


                    <h2>
                        <?= number_format(
                            $negativeReviews
                        ); ?>
                    </h2>


                    <small>
                        Reviews requiring attention
                    </small>


                </div>


            </div>


        </section>


        <!-- ==================================================
             FILTERS
        =================================================== -->

        <section class="dashboard-panel">


            <form
                method="GET"
                action="reviews.php"
                class="filter-form"
            >


                <!-- SEARCH -->

                <div class="form-group">


                    <label for="search">
                        Search
                    </label>


                    <input
                        type="search"
                        id="search"
                        name="search"
                        value="<?= htmlspecialchars(
                            $search
                        ); ?>"
                        placeholder="Customer, product or review..."
                    >


                </div>


                <!-- RATING -->

                <div class="form-group">


                    <label for="rating">
                        Rating
                    </label>


                    <select
                        id="rating"
                        name="rating"
                    >


                        <option value="">
                            All Ratings
                        </option>


                        <option
                            value="5"
                            <?= $ratingFilter ===
                                '5'
                                ? 'selected'
                                : ''; ?>
                        >
                            ★★★★★ 5
                        </option>


                        <option
                            value="4"
                            <?= $ratingFilter ===
                                '4'
                                ? 'selected'
                                : ''; ?>
                        >
                            ★★★★ 4
                        </option>


                        <option
                            value="3"
                            <?= $ratingFilter ===
                                '3'
                                ? 'selected'
                                : ''; ?>
                        >
                            ★★★ 3
                        </option>


                        <option
                            value="2"
                            <?= $ratingFilter ===
                                '2'
                                ? 'selected'
                                : ''; ?>
                        >
                            ★★ 2
                        </option>


                        <option
                            value="1"
                            <?= $ratingFilter ===
                                '1'
                                ? 'selected'
                                : ''; ?>
                        >
                            ★ 1
                        </option>


                    </select>


                </div>


                <!-- STATUS -->

                <div class="form-group">


                    <label for="status">
                        Status
                    </label>


                    <select
                        id="status"
                        name="status"
                    >


                        <option value="">
                            All Status
                        </option>


                        <option
                            value="Published"
                            <?= $statusFilter ===
                                'Published'
                                ? 'selected'
                                : ''; ?>
                        >
                            Published
                        </option>


                        <option
                            value="Pending"
                            <?= $statusFilter ===
                                'Pending'
                                ? 'selected'
                                : ''; ?>
                        >
                            Pending
                        </option>


                        <option
                            value="Rejected"
                            <?= $statusFilter ===
                                'Rejected'
                                ? 'selected'
                                : ''; ?>
                        >
                            Rejected
                        </option>


                    </select>


                </div>


                <!-- SENTIMENT -->

                <div class="form-group">


                    <label for="sentiment">
                        AI Sentiment
                    </label>


                    <select
                        id="sentiment"
                        name="sentiment"
                    >


                        <option value="">
                            All Sentiment
                        </option>


                        <option
                            value="Positive"
                            <?= $sentimentFilter ===
                                'Positive'
                                ? 'selected'
                                : ''; ?>
                        >
                            Positive
                        </option>


                        <option
                            value="Neutral"
                            <?= $sentimentFilter ===
                                'Neutral'
                                ? 'selected'
                                : ''; ?>
                        >
                            Neutral
                        </option>


                        <option
                            value="Negative"
                            <?= $sentimentFilter ===
                                'Negative'
                                ? 'selected'
                                : ''; ?>
                        >
                            Negative
                        </option>


                    </select>


                </div>


                <!-- ACTIONS -->

                <div class="form-actions">


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Apply
                    </button>


                    <a
                        href="reviews.php"
                        class="btn btn-secondary"
                    >
                        Reset
                    </a>


                </div>


            </form>


        </section>


        <!-- ==================================================
             REVIEWS TABLE
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        Customer Reviews
                    </h3>


                    <p>

                        <?= count(
                            $filteredReviews
                        ); ?>

                        review(s) found

                    </p>


                </div>


            </div>


            <div class="table-wrapper">


                <?php if (
                    !empty(
                        $filteredReviews
                    )
                ): ?>


                    <table class="admin-table">


                        <thead>

                            <tr>

                                <th>
                                    Customer
                                </th>

                                <th>
                                    Product
                                </th>

                                <th>
                                    Rating
                                </th>

                                <th>
                                    Review
                                </th>

                                <th>
                                    Verified
                                </th>

                                <th>
                                    AI Sentiment
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Flag
                                </th>

                                <th>
                                    Date
                                </th>

                                <th>
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                        <?php foreach (
                            $filteredReviews
                            as $review
                        ): ?>


                            <tr>


                                <!-- CUSTOMER -->

                                <td>


                                    <strong>

                                        <?= htmlspecialchars(
                                            $review['customer']
                                        ); ?>

                                    </strong>


                                    <small class="table-subtext">

                                        <?= htmlspecialchars(
                                            $review['email']
                                        ); ?>

                                    </small>


                                </td>


                                <!-- PRODUCT -->

                                <td>


                                    <?= htmlspecialchars(
                                        $review['product']
                                    ); ?>


                                </td>


                                <!-- RATING -->

                                <td>


                                    <strong>

                                        <?= str_repeat(
                                            '★',
                                            $review['rating']
                                        ); ?>

                                    </strong>


                                    <small class="table-subtext">

                                        <?= $review['rating']; ?>/5

                                    </small>


                                </td>


                                <!-- REVIEW -->

                                <td>


                                    <div class="review-preview">

                                        <?= htmlspecialchars(
                                            $review['review']
                                        ); ?>

                                    </div>


                                </td>


                                <!-- VERIFIED -->

                                <td>


                                    <?php if (
                                        $review['verified']
                                    ): ?>


                                        <span
                                            class="status-badge status-active"
                                        >
                                            Verified
                                        </span>


                                    <?php else: ?>


                                        <span
                                            class="condition-badge"
                                        >
                                            Unverified
                                        </span>


                                    <?php endif; ?>


                                </td>


                                <!-- SENTIMENT -->

                                <td>


                                    <?php

                                    if (
                                        $review['sentiment'] ===
                                        'Positive'
                                    ) {

                                        $sentimentClass =
                                            'status-active';

                                    } elseif (
                                        $review['sentiment'] ===
                                        'Negative'
                                    ) {

                                        $sentimentClass =
                                            'status-danger';

                                    } else {

                                        $sentimentClass =
                                            'status-warning';

                                    }

                                    ?>


                                    <span
                                        class="status-badge <?= $sentimentClass; ?>"
                                    >

                                        <?= htmlspecialchars(
                                            $review['sentiment']
                                        ); ?>

                                    </span>


                                </td>


                                <!-- STATUS -->

                                <td>


                                    <?php if (
                                        $review['status'] ===
                                        'Published'
                                    ): ?>


                                        <span
                                            class="status-badge status-active"
                                        >
                                            Published
                                        </span>


                                    <?php elseif (
                                        $review['status'] ===
                                        'Pending'
                                    ): ?>


                                        <span
                                            class="status-badge status-warning"
                                        >
                                            Pending
                                        </span>


                                    <?php else: ?>


                                        <span
                                            class="status-badge status-danger"
                                        >
                                            Rejected
                                        </span>


                                    <?php endif; ?>


                                </td>


                                <!-- FLAG -->

                                <td>


                                    <?php if (
                                        $review['flagged']
                                    ): ?>


                                        <span
                                            class="status-badge status-danger"
                                        >
                                            ⚑ Flagged
                                        </span>


                                    <?php else: ?>


                                        <span
                                            class="condition-badge"
                                        >
                                            Clear
                                        </span>


                                    <?php endif; ?>


                                </td>


                                <!-- DATE -->

                                <td>

                                    <?= htmlspecialchars(
                                        $review['date']
                                    ); ?>

                                </td>


                                <!-- ACTIONS -->

                                <td>


                                    <div class="table-actions">


                                        <button
                                            type="button"
                                            class="table-action"
                                            onclick="alert('Review moderation will be connected to MySQL later.')"
                                        >
                                            Moderate
                                        </button>


                                        <button
                                            type="button"
                                            class="table-action danger"
                                            onclick="alert('Delete functionality will be connected to MySQL later.')"
                                        >
                                            Delete
                                        </button>


                                    </div>


                                </td>


                            </tr>


                        <?php endforeach; ?>


                        </tbody>


                    </table>


                <?php else: ?>


                    <div class="empty-state">


                        <div class="empty-state-icon">
                            ★
                        </div>


                        <h3>
                            No reviews found
                        </h3>


                        <p>
                            Try changing your search or filters.
                        </p>


                        <a
                            href="reviews.php"
                            class="btn btn-secondary"
                        >
                            Clear Filters
                        </a>


                    </div>


                <?php endif; ?>


            </div>


        </section>


        <!-- ==================================================
             FOOTER
        =================================================== -->

        <footer class="admin-footer">


            <span>
                SSISS Admin Panel
            </span>


            <span>
                Fashion • AI • Impact
            </span>


        </footer>


    </main>


</div>


</body>

</html>
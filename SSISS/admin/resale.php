<?php

session_start();

/*
|--------------------------------------------------------------------------
| SSISS ADMIN - PRE-LOVED / RESALE MANAGEMENT
|--------------------------------------------------------------------------
| Demo version.
| MySQL integration will be added later.
|--------------------------------------------------------------------------
*/

$adminName = $_SESSION['admin_name'] ?? 'Admin';


// ==========================================================
// DEMO RESALE LISTINGS
// ==========================================================

$resaleListings = [

    [
        'id' => 'RES-10001',
        'seller' => 'Aarav Sharma',
        'email' => 'aarav@example.com',
        'item' => 'Oversized Denim Jacket',
        'category' => 'Jackets',
        'condition' => 'Excellent',
        'price' => 899,
        'coins' => 90,
        'status' => 'Approved',
        'destination' => 'Marketplace',
        'date' => '29 Aug 2026'
    ],

    [
        'id' => 'RES-10002',
        'seller' => 'Ananya Das',
        'email' => 'ananya@example.com',
        'item' => 'Floral Summer Dress',
        'category' => 'Dresses',
        'condition' => 'Like New',
        'price' => 699,
        'coins' => 70,
        'status' => 'Pending',
        'destination' => 'Marketplace',
        'date' => '29 Aug 2026'
    ],

    [
        'id' => 'RES-10003',
        'seller' => 'Rohan Patel',
        'email' => 'rohan@example.com',
        'item' => 'Classic Black Hoodie',
        'category' => 'Hoodies',
        'condition' => 'Good',
        'price' => 549,
        'coins' => 55,
        'status' => 'Approved',
        'destination' => 'Marketplace',
        'date' => '28 Aug 2026'
    ],

    [
        'id' => 'RES-10004',
        'seller' => 'Diya Mehta',
        'email' => 'diya@example.com',
        'item' => 'White Casual Shirt',
        'category' => 'Shirts',
        'condition' => 'Excellent',
        'price' => 449,
        'coins' => 45,
        'status' => 'Approved',
        'destination' => 'Marketplace',
        'date' => '28 Aug 2026'
    ],

    [
        'id' => 'RES-10005',
        'seller' => 'Kabir Singh',
        'email' => 'kabir@example.com',
        'item' => 'Streetwear Cargo Pants',
        'category' => 'Pants',
        'condition' => 'Fair',
        'price' => 399,
        'coins' => 40,
        'status' => 'Rejected',
        'destination' => 'Donation',
        'date' => '27 Aug 2026'
    ],

    [
        'id' => 'RES-10006',
        'seller' => 'Meera Nair',
        'email' => 'meera@example.com',
        'item' => 'Vintage Graphic Tee',
        'category' => 'T-Shirts',
        'condition' => 'Good',
        'price' => 299,
        'coins' => 30,
        'status' => 'Pending',
        'destination' => 'Marketplace',
        'date' => '27 Aug 2026'
    ],

    [
        'id' => 'RES-10007',
        'seller' => 'Vihaan Roy',
        'email' => 'vihaan@example.com',
        'item' => 'Brown Corduroy Jacket',
        'category' => 'Jackets',
        'condition' => 'Excellent',
        'price' => 799,
        'coins' => 80,
        'status' => 'Approved',
        'destination' => 'Marketplace',
        'date' => '26 Aug 2026'
    ],

    [
        'id' => 'RES-10008',
        'seller' => 'Ishita Sen',
        'email' => 'ishita@example.com',
        'item' => 'Black Party Dress',
        'category' => 'Dresses',
        'condition' => 'Like New',
        'price' => 999,
        'coins' => 100,
        'status' => 'Pending',
        'destination' => 'Marketplace',
        'date' => '26 Aug 2026'
    ],

    [
        'id' => 'RES-10009',
        'seller' => 'Arjun Kapoor',
        'email' => 'arjun@example.com',
        'item' => 'Old School Denim Shirt',
        'category' => 'Shirts',
        'condition' => 'Good',
        'price' => 349,
        'coins' => 35,
        'status' => 'Approved',
        'destination' => 'Marketplace',
        'date' => '25 Aug 2026'
    ],

    [
        'id' => 'RES-10010',
        'seller' => 'Saanvi Rao',
        'email' => 'saanvi@example.com',
        'item' => 'Pastel Oversized Sweater',
        'category' => 'Sweaters',
        'condition' => 'Good',
        'price' => 599,
        'coins' => 60,
        'status' => 'Rejected',
        'destination' => 'Donation',
        'date' => '24 Aug 2026'
    ]

];


// ==========================================================
// FILTERS
// ==========================================================

$search = trim($_GET['search'] ?? '');

$statusFilter = trim($_GET['status'] ?? '');

$conditionFilter = trim(
    $_GET['condition'] ?? ''
);

$destinationFilter = trim(
    $_GET['destination'] ?? ''
);


// ==========================================================
// FILTER LISTINGS
// ==========================================================

$filteredListings = array_filter(

    $resaleListings,

    function ($listing) use (
        $search,
        $statusFilter,
        $conditionFilter,
        $destinationFilter
    ) {

        // Search

        if ($search !== '') {

            $searchText = strtolower(

                $listing['id'] . ' ' .
                $listing['seller'] . ' ' .
                $listing['email'] . ' ' .
                $listing['item'] . ' ' .
                $listing['category']

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


        // Status

        if (
            $statusFilter !== '' &&
            $listing['status'] !== $statusFilter
        ) {

            return false;

        }


        // Condition

        if (
            $conditionFilter !== '' &&
            $listing['condition'] !== $conditionFilter
        ) {

            return false;

        }


        // Destination

        if (
            $destinationFilter !== '' &&
            $listing['destination'] !==
            $destinationFilter
        ) {

            return false;

        }


        return true;

    }

);


// ==========================================================
// STATISTICS
// ==========================================================

$totalListings = count($resaleListings);


$approvedListings = count(

    array_filter(

        $resaleListings,

        function ($listing) {

            return $listing['status'] ===
                'Approved';

        }

    )

);


$pendingListings = count(

    array_filter(

        $resaleListings,

        function ($listing) {

            return $listing['status'] ===
                'Pending';

        }

    )

);


$rejectedListings = count(

    array_filter(

        $resaleListings,

        function ($listing) {

            return $listing['status'] ===
                'Rejected';

        }

    )

);


$totalCoins = array_sum(

    array_column(
        $resaleListings,
        'coins'
    )

);


$marketplaceListings = count(

    array_filter(

        $resaleListings,

        function ($listing) {

            return $listing['destination'] ===
                'Marketplace';

        }

    )

);


$donationListings = count(

    array_filter(

        $resaleListings,

        function ($listing) {

            return $listing['destination'] ===
                'Donation';

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
        Pre-Loved | SSISS Admin
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
                class="admin-nav-item active"
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
                    SSISS / Pre-Loved
                </p>


                <h1>
                    Pre-Loved
                </h1>


                <p class="admin-subtitle">
                    Manage user-listed fashion and circular marketplace items.
                </p>


            </div>


        </header>


        <!-- ==================================================
             PAGE ACTIONS
        =================================================== -->

        <section class="page-actions">


            <div>

                <h2>
                    Pre-Loved Marketplace
                </h2>


                <p>
                    Review user listings before they enter the marketplace.
                </p>


            </div>


            <button
                type="button"
                class="btn btn-primary"
                onclick="alert('Manual listing creation will be connected later.')"
            >
                + Add Listing
            </button>


        </section>


        <!-- ==================================================
             STATISTICS
        =================================================== -->

        <section class="stats-grid">


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ♻
                    </span>

                </div>


                <p>
                    Total Listings
                </p>


                <h2>
                    <?= number_format(
                        $totalListings
                    ); ?>
                </h2>


                <small>
                    User submitted items
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ✓
                    </span>

                </div>


                <p>
                    Approved
                </p>


                <h2>
                    <?= number_format(
                        $approvedListings
                    ); ?>
                </h2>


                <small>
                    Listed on marketplace
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
                        $pendingListings
                    ); ?>
                </h2>


                <small>
                    Awaiting moderation
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ⚑
                    </span>

                </div>


                <p>
                    Rejected
                </p>


                <h2>
                    <?= number_format(
                        $rejectedListings
                    ); ?>
                </h2>


                <small>
                    Failed marketplace review
                </small>


            </div>


        </section>


        <!-- ==================================================
             CIRCULAR ECONOMY SUMMARY
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        Circular Economy Overview
                    </h3>


                    <p>
                        Track where user-submitted clothing is going.
                    </p>

                </div>


            </div>


            <div class="stats-grid">


                <div class="stat-card">


                    <p>
                        Marketplace
                    </p>


                    <h2>
                        <?= number_format(
                            $marketplaceListings
                        ); ?>
                    </h2>


                    <small>
                        Items being resold
                    </small>


                </div>


                <div class="stat-card">


                    <p>
                        Donation
                    </p>


                    <h2>
                        <?= number_format(
                            $donationListings
                        ); ?>
                    </h2>


                    <small>
                        Items redirected to NGOs
                    </small>


                </div>


                <div class="stat-card">


                    <p>
                        Coins Generated
                    </p>


                    <h2>
                        🪙 <?= number_format(
                            $totalCoins
                        ); ?>
                    </h2>


                    <small>
                        Seller reward coins
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
                action="resale.php"
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
                        placeholder="Seller, item or listing ID..."
                    >


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
                            value="Pending"
                            <?= $statusFilter ===
                                'Pending'
                                ? 'selected'
                                : ''; ?>
                        >
                            Pending
                        </option>


                        <option
                            value="Approved"
                            <?= $statusFilter ===
                                'Approved'
                                ? 'selected'
                                : ''; ?>
                        >
                            Approved
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


                <!-- CONDITION -->

                <div class="form-group">


                    <label for="condition">
                        Condition
                    </label>


                    <select
                        id="condition"
                        name="condition"
                    >


                        <option value="">
                            All Conditions
                        </option>


                        <option
                            value="Like New"
                            <?= $conditionFilter ===
                                'Like New'
                                ? 'selected'
                                : ''; ?>
                        >
                            Like New
                        </option>


                        <option
                            value="Excellent"
                            <?= $conditionFilter ===
                                'Excellent'
                                ? 'selected'
                                : ''; ?>
                        >
                            Excellent
                        </option>


                        <option
                            value="Good"
                            <?= $conditionFilter ===
                                'Good'
                                ? 'selected'
                                : ''; ?>
                        >
                            Good
                        </option>


                        <option
                            value="Fair"
                            <?= $conditionFilter ===
                                'Fair'
                                ? 'selected'
                                : ''; ?>
                        >
                            Fair
                        </option>


                    </select>


                </div>


                <!-- DESTINATION -->

                <div class="form-group">


                    <label for="destination">
                        Destination
                    </label>


                    <select
                        id="destination"
                        name="destination"
                    >


                        <option value="">
                            All Destinations
                        </option>


                        <option
                            value="Marketplace"
                            <?= $destinationFilter ===
                                'Marketplace'
                                ? 'selected'
                                : ''; ?>
                        >
                            Marketplace
                        </option>


                        <option
                            value="Donation"
                            <?= $destinationFilter ===
                                'Donation'
                                ? 'selected'
                                : ''; ?>
                        >
                            Donation
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
                        href="resale.php"
                        class="btn btn-secondary"
                    >
                        Reset
                    </a>


                </div>


            </form>


        </section>


        <!-- ==================================================
             RESALE TABLE
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        User Listings
                    </h3>


                    <p>

                        <?= count(
                            $filteredListings
                        ); ?>

                        listing(s) found

                    </p>


                </div>


            </div>


            <div class="table-wrapper">


                <?php if (
                    !empty(
                        $filteredListings
                    )
                ): ?>


                    <table class="admin-table">


                        <thead>

                            <tr>

                                <th>
                                    Listing
                                </th>

                                <th>
                                    Seller
                                </th>

                                <th>
                                    Item
                                </th>

                                <th>
                                    Condition
                                </th>

                                <th>
                                    Price
                                </th>

                                <th>
                                    Coins
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Destination
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
                            $filteredListings
                            as $listing
                        ): ?>


                            <tr>


                                <!-- LISTING ID -->

                                <td>


                                    <strong>

                                        <?= htmlspecialchars(
                                            $listing['id']
                                        ); ?>

                                    </strong>


                                </td>


                                <!-- SELLER -->

                                <td>


                                    <strong>

                                        <?= htmlspecialchars(
                                            $listing['seller']
                                        ); ?>

                                    </strong>


                                    <small class="table-subtext">

                                        <?= htmlspecialchars(
                                            $listing['email']
                                        ); ?>

                                    </small>


                                </td>


                                <!-- ITEM -->

                                <td>


                                    <strong>

                                        <?= htmlspecialchars(
                                            $listing['item']
                                        ); ?>

                                    </strong>


                                    <small class="table-subtext">

                                        <?= htmlspecialchars(
                                            $listing['category']
                                        ); ?>

                                    </small>


                                </td>


                                <!-- CONDITION -->

                                <td>

                                    <?= htmlspecialchars(
                                        $listing['condition']
                                    ); ?>


                                </td>


                                <!-- PRICE -->

                                <td>


                                    <strong>

                                        ₹<?= number_format(
                                            $listing['price']
                                        ); ?>

                                    </strong>


                                </td>


                                <!-- COINS -->

                                <td>


                                    🪙
                                    <?= number_format(
                                        $listing['coins']
                                    ); ?>


                                </td>


                                <!-- STATUS -->

                                <td>


                                    <?php

                                    if (
                                        $listing['status'] ===
                                        'Approved'
                                    ) {

                                        $statusClass =
                                            'status-active';

                                    } elseif (
                                        $listing['status'] ===
                                        'Pending'
                                    ) {

                                        $statusClass =
                                            'status-warning';

                                    } else {

                                        $statusClass =
                                            'status-danger';

                                    }

                                    ?>


                                    <span
                                        class="status-badge <?= $statusClass; ?>"
                                    >

                                        <?= htmlspecialchars(
                                            $listing['status']
                                        ); ?>

                                    </span>


                                </td>


                                <!-- DESTINATION -->

                                <td>


                                    <?php if (
                                        $listing['destination'] ===
                                        'Marketplace'
                                    ): ?>


                                        <span
                                            class="status-badge status-active"
                                        >
                                            ♻ Marketplace
                                        </span>


                                    <?php else: ?>


                                        <span
                                            class="status-badge status-warning"
                                        >
                                            ♥ Donation
                                        </span>


                                    <?php endif; ?>


                                </td>


                                <!-- DATE -->

                                <td>

                                    <?= htmlspecialchars(
                                        $listing['date']
                                    ); ?>

                                </td>


                                <!-- ACTIONS -->

                                <td>


                                    <div class="table-actions">


                                        <button
                                            type="button"
                                            class="table-action"
                                            onclick="alert('Listing details will be connected later.')"
                                        >
                                            View
                                        </button>


                                        <button
                                            type="button"
                                            class="table-action"
                                            onclick="alert('Approval system will be connected to MySQL later.')"
                                        >
                                            Review
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
                            ♻
                        </div>


                        <h3>
                            No listings found
                        </h3>


                        <p>
                            Try changing your search or filters.
                        </p>


                        <a
                            href="resale.php"
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
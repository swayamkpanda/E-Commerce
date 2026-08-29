<?php

session_start();

/*
|--------------------------------------------------------------------------
| SSISS ADMIN - DONATION MANAGEMENT
|--------------------------------------------------------------------------
| Demo version.
| MySQL integration will be added later.
|--------------------------------------------------------------------------
*/

$adminName = $_SESSION['admin_name'] ?? 'Admin';


// ==========================================================
// DEMO DONATIONS
// ==========================================================

$donations = [

    [
        'id' => 'DON-10001',
        'donor' => 'Aarav Sharma',
        'email' => 'aarav@example.com',
        'items' => 4,
        'category' => 'Clothing',
        'description' => 'T-shirts, shirts and jeans',
        'ngo' => 'Helping Hands Foundation',
        'condition' => 'Good',
        'status' => 'Delivered',
        'coins' => 200,
        'date' => '29 Aug 2026'
    ],

    [
        'id' => 'DON-10002',
        'donor' => 'Ananya Das',
        'email' => 'ananya@example.com',
        'items' => 3,
        'category' => 'Dresses',
        'description' => 'Women casual and party dresses',
        'ngo' => 'Hope Foundation',
        'condition' => 'Excellent',
        'status' => 'Verified',
        'coins' => 150,
        'date' => '29 Aug 2026'
    ],

    [
        'id' => 'DON-10003',
        'donor' => 'Rohan Patel',
        'email' => 'rohan@example.com',
        'items' => 6,
        'category' => 'Mixed',
        'description' => 'Shirts, trousers and jackets',
        'ngo' => 'Care India Trust',
        'condition' => 'Good',
        'status' => 'In Transit',
        'coins' => 300,
        'date' => '28 Aug 2026'
    ],

    [
        'id' => 'DON-10004',
        'donor' => 'Diya Mehta',
        'email' => 'diya@example.com',
        'items' => 2,
        'category' => 'Clothing',
        'description' => 'Winter sweaters',
        'ngo' => 'Helping Hands Foundation',
        'condition' => 'Like New',
        'status' => 'Pending',
        'coins' => 100,
        'date' => '28 Aug 2026'
    ],

    [
        'id' => 'DON-10005',
        'donor' => 'Kabir Singh',
        'email' => 'kabir@example.com',
        'items' => 5,
        'category' => 'Shoes',
        'description' => 'Casual shoes and sneakers',
        'ngo' => 'Hope Foundation',
        'condition' => 'Good',
        'status' => 'Verified',
        'coins' => 250,
        'date' => '27 Aug 2026'
    ],

    [
        'id' => 'DON-10006',
        'donor' => 'Meera Nair',
        'email' => 'meera@example.com',
        'items' => 8,
        'category' => 'Mixed',
        'description' => 'Clothes for children and adults',
        'ngo' => 'Care India Trust',
        'condition' => 'Good',
        'status' => 'Delivered',
        'coins' => 400,
        'date' => '27 Aug 2026'
    ],

    [
        'id' => 'DON-10007',
        'donor' => 'Vihaan Roy',
        'email' => 'vihaan@example.com',
        'items' => 2,
        'category' => 'Jackets',
        'description' => 'Winter jackets',
        'ngo' => 'Helping Hands Foundation',
        'condition' => 'Excellent',
        'status' => 'Rejected',
        'coins' => 0,
        'date' => '26 Aug 2026'
    ],

    [
        'id' => 'DON-10008',
        'donor' => 'Ishita Sen',
        'email' => 'ishita@example.com',
        'items' => 5,
        'category' => 'Clothing',
        'description' => 'Casual clothing collection',
        'ngo' => 'Hope Foundation',
        'condition' => 'Good',
        'status' => 'In Transit',
        'coins' => 250,
        'date' => '26 Aug 2026'
    ],

    [
        'id' => 'DON-10009',
        'donor' => 'Arjun Kapoor',
        'email' => 'arjun@example.com',
        'items' => 3,
        'category' => 'Clothing',
        'description' => 'Formal shirts and trousers',
        'ngo' => 'Care India Trust',
        'condition' => 'Excellent',
        'status' => 'Delivered',
        'coins' => 150,
        'date' => '25 Aug 2026'
    ],

    [
        'id' => 'DON-10010',
        'donor' => 'Saanvi Rao',
        'email' => 'saanvi@example.com',
        'items' => 7,
        'category' => 'Mixed',
        'description' => 'Family clothing donation',
        'ngo' => 'Helping Hands Foundation',
        'condition' => 'Good',
        'status' => 'Pending',
        'coins' => 350,
        'date' => '24 Aug 2026'
    ]

];


// ==========================================================
// FILTERS
// ==========================================================

$search = trim($_GET['search'] ?? '');

$statusFilter = trim($_GET['status'] ?? '');

$ngoFilter = trim($_GET['ngo'] ?? '');

$conditionFilter = trim(
    $_GET['condition'] ?? ''
);


// ==========================================================
// FILTER DONATIONS
// ==========================================================

$filteredDonations = array_filter(

    $donations,

    function ($donation) use (
        $search,
        $statusFilter,
        $ngoFilter,
        $conditionFilter
    ) {

        // Search

        if ($search !== '') {

            $searchText = strtolower(

                $donation['id'] . ' ' .
                $donation['donor'] . ' ' .
                $donation['email'] . ' ' .
                $donation['description'] . ' ' .
                $donation['category']

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
            $donation['status'] !== $statusFilter
        ) {

            return false;

        }


        // NGO

        if (
            $ngoFilter !== '' &&
            $donation['ngo'] !== $ngoFilter
        ) {

            return false;

        }


        // Condition

        if (
            $conditionFilter !== '' &&
            $donation['condition'] !==
            $conditionFilter
        ) {

            return false;

        }


        return true;

    }

);


// ==========================================================
// STATISTICS
// ==========================================================

$totalDonations = count($donations);


$pendingDonations = count(

    array_filter(

        $donations,

        function ($donation) {

            return $donation['status'] ===
                'Pending';

        }

    )

);


$verifiedDonations = count(

    array_filter(

        $donations,

        function ($donation) {

            return $donation['status'] ===
                'Verified';

        }

    )

);


$inTransitDonations = count(

    array_filter(

        $donations,

        function ($donation) {

            return $donation['status'] ===
                'In Transit';

        }

    )

);


$deliveredDonations = count(

    array_filter(

        $donations,

        function ($donation) {

            return $donation['status'] ===
                'Delivered';

        }

    )

);


$rejectedDonations = count(

    array_filter(

        $donations,

        function ($donation) {

            return $donation['status'] ===
                'Rejected';

        }

    )

);


$totalItems = array_sum(

    array_column(
        $donations,
        'items'
    )

);


$totalCoins = array_sum(

    array_column(
        $donations,
        'coins'
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
        Donations | SSISS Admin
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
                class="admin-nav-item active"
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
                    SSISS / Donations
                </p>


                <h1>
                    Donations
                </h1>


                <p class="admin-subtitle">
                    Manage clothing donations and NGO distribution.
                </p>


            </div>


        </header>


        <!-- ==================================================
             PAGE ACTIONS
        =================================================== -->

        <section class="page-actions">


            <div>

                <h2>
                    Donation Management
                </h2>


                <p>
                    Verify donations, assign NGOs and track their journey.
                </p>


            </div>


            <button
                type="button"
                class="btn btn-primary"
                onclick="alert('Manual donation entry will be connected later.')"
            >
                + Add Donation
            </button>


        </section>


        <!-- ==================================================
             STATISTICS
        =================================================== -->

        <section class="stats-grid">


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ♥
                    </span>

                </div>


                <p>
                    Total Donations
                </p>


                <h2>
                    <?= number_format(
                        $totalDonations
                    ); ?>
                </h2>


                <small>
                    Donation requests
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
                        $pendingDonations
                    ); ?>
                </h2>


                <small>
                    Awaiting verification
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ✓
                    </span>

                </div>


                <p>
                    Verified
                </p>


                <h2>
                    <?= number_format(
                        $verifiedDonations
                    ); ?>
                </h2>


                <small>
                    Approved donations
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        →
                    </span>

                </div>


                <p>
                    In Transit
                </p>


                <h2>
                    <?= number_format(
                        $inTransitDonations
                    ); ?>
                </h2>


                <small>
                    Going to NGOs
                </small>


            </div>


        </section>


        <!-- ==================================================
             IMPACT SUMMARY
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        Social Impact
                    </h3>


                    <p>
                        Track clothing redistribution and community impact.
                    </p>

                </div>


            </div>


            <div class="stats-grid">


                <div class="stat-card">


                    <p>
                        Items Donated
                    </p>


                    <h2>
                        <?= number_format(
                            $totalItems
                        ); ?>
                    </h2>


                    <small>
                        Clothing items
                    </small>


                </div>


                <div class="stat-card">


                    <p>
                        Delivered
                    </p>


                    <h2>
                        <?= number_format(
                            $deliveredDonations
                        ); ?>
                    </h2>


                    <small>
                        Successfully delivered
                    </small>


                </div>


                <div class="stat-card">


                    <p>
                        SSISS Coins Generated
                    </p>


                    <h2>
                        🪙 <?= number_format(
                            $totalCoins
                        ); ?>
                    </h2>


                    <small>
                        Donor rewards
                    </small>


                </div>


                <div class="stat-card">


                    <p>
                        Rejected
                    </p>


                    <h2>
                        <?= number_format(
                            $rejectedDonations
                        ); ?>
                    </h2>


                    <small>
                        Failed verification
                    </small>


                </div>


            </div>


        </section>


        <!-- ==================================================
             DONATION FLOW
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        Donation Flow
                    </h3>


                    <p>
                        How a donation moves through SSISS.
                    </p>

                </div>


            </div>


            <div class="donation-flow">


                <div class="flow-step">

                    <strong>
                        1
                    </strong>

                    <span>
                        User Donates
                    </span>

                </div>


                <div class="flow-arrow">
                    →
                </div>


                <div class="flow-step">

                    <strong>
                        2
                    </strong>

                    <span>
                        Verification
                    </span>

                </div>


                <div class="flow-arrow">
                    →
                </div>


                <div class="flow-step">

                    <strong>
                        3
                    </strong>

                    <span>
                        NGO Assigned
                    </span>

                </div>


                <div class="flow-arrow">
                    →
                </div>


                <div class="flow-step">

                    <strong>
                        4
                    </strong>

                    <span>
                        Delivered
                    </span>

                </div>


                <div class="flow-arrow">
                    →
                </div>


                <div class="flow-step">

                    <strong>
                        5
                    </strong>

                    <span>
                        Coins Awarded
                    </span>

                </div>


            </div>


        </section>


        <!-- ==================================================
             FILTERS
        =================================================== -->

        <section class="dashboard-panel">


            <form
                method="GET"
                action="donations.php"
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
                        placeholder="Donor, donation ID or item..."
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
                            value="Verified"
                            <?= $statusFilter ===
                                'Verified'
                                ? 'selected'
                                : ''; ?>
                        >
                            Verified
                        </option>


                        <option
                            value="In Transit"
                            <?= $statusFilter ===
                                'In Transit'
                                ? 'selected'
                                : ''; ?>
                        >
                            In Transit
                        </option>


                        <option
                            value="Delivered"
                            <?= $statusFilter ===
                                'Delivered'
                                ? 'selected'
                                : ''; ?>
                        >
                            Delivered
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


                <!-- NGO -->

                <div class="form-group">


                    <label for="ngo">
                        NGO
                    </label>


                    <select
                        id="ngo"
                        name="ngo"
                    >


                        <option value="">
                            All NGOs
                        </option>


                        <option
                            value="Helping Hands Foundation"
                            <?= $ngoFilter ===
                                'Helping Hands Foundation'
                                ? 'selected'
                                : ''; ?>
                        >
                            Helping Hands Foundation
                        </option>


                        <option
                            value="Hope Foundation"
                            <?= $ngoFilter ===
                                'Hope Foundation'
                                ? 'selected'
                                : ''; ?>
                        >
                            Hope Foundation
                        </option>


                        <option
                            value="Care India Trust"
                            <?= $ngoFilter ===
                                'Care India Trust'
                                ? 'selected'
                                : ''; ?>
                        >
                            Care India Trust
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


                <!-- ACTIONS -->

                <div class="form-actions">


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Apply
                    </button>


                    <a
                        href="donations.php"
                        class="btn btn-secondary"
                    >
                        Reset
                    </a>


                </div>


            </form>


        </section>


        <!-- ==================================================
             DONATIONS TABLE
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        Donation Requests
                    </h3>


                    <p>

                        <?= count(
                            $filteredDonations
                        ); ?>

                        donation(s) found

                    </p>


                </div>


            </div>


            <div class="table-wrapper">


                <?php if (
                    !empty(
                        $filteredDonations
                    )
                ): ?>


                    <table class="admin-table">


                        <thead>

                            <tr>

                                <th>
                                    Donation
                                </th>

                                <th>
                                    Donor
                                </th>

                                <th>
                                    Items
                                </th>

                                <th>
                                    Description
                                </th>

                                <th>
                                    Condition
                                </th>

                                <th>
                                    NGO
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Coins
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
                            $filteredDonations
                            as $donation
                        ): ?>


                            <tr>


                                <!-- DONATION ID -->

                                <td>


                                    <strong>

                                        <?= htmlspecialchars(
                                            $donation['id']
                                        ); ?>

                                    </strong>


                                    <small class="table-subtext">

                                        <?= htmlspecialchars(
                                            $donation['category']
                                        ); ?>

                                    </small>


                                </td>


                                <!-- DONOR -->

                                <td>


                                    <strong>

                                        <?= htmlspecialchars(
                                            $donation['donor']
                                        ); ?>

                                    </strong>


                                    <small class="table-subtext">

                                        <?= htmlspecialchars(
                                            $donation['email']
                                        ); ?>

                                    </small>


                                </td>


                                <!-- ITEMS -->

                                <td>


                                    <strong>

                                        <?= number_format(
                                            $donation['items']
                                        ); ?>

                                    </strong>


                                </td>


                                <!-- DESCRIPTION -->

                                <td>


                                    <?= htmlspecialchars(
                                        $donation['description']
                                    ); ?>


                                </td>


                                <!-- CONDITION -->

                                <td>

                                    <?= htmlspecialchars(
                                        $donation['condition']
                                    ); ?>


                                </td>


                                <!-- NGO -->

                                <td>


                                    <?= htmlspecialchars(
                                        $donation['ngo']
                                    ); ?>


                                </td>


                                <!-- STATUS -->

                                <td>


                                    <?php

                                    if (
                                        $donation['status'] ===
                                        'Delivered'
                                    ) {

                                        $statusClass =
                                            'status-active';

                                    } elseif (
                                        $donation['status'] ===
                                        'Verified' ||
                                        $donation['status'] ===
                                        'In Transit'
                                    ) {

                                        $statusClass =
                                            'status-warning';

                                    } elseif (
                                        $donation['status'] ===
                                        'Rejected'
                                    ) {

                                        $statusClass =
                                            'status-danger';

                                    } else {

                                        $statusClass =
                                            'status-warning';

                                    }

                                    ?>


                                    <span
                                        class="status-badge <?= $statusClass; ?>"
                                    >

                                        <?= htmlspecialchars(
                                            $donation['status']
                                        ); ?>

                                    </span>


                                </td>


                                <!-- COINS -->

                                <td>


                                    <?php if (
                                        $donation['coins'] > 0
                                    ): ?>


                                        🪙
                                        <?= number_format(
                                            $donation['coins']
                                        ); ?>


                                    <?php else: ?>


                                        —

                                    <?php endif; ?>


                                </td>


                                <!-- DATE -->

                                <td>

                                    <?= htmlspecialchars(
                                        $donation['date']
                                    ); ?>

                                </td>


                                <!-- ACTIONS -->

                                <td>


                                    <div class="table-actions">


                                        <button
                                            type="button"
                                            class="table-action"
                                            onclick="alert('Donation details will be connected later.')"
                                        >
                                            View
                                        </button>


                                        <button
                                            type="button"
                                            class="table-action"
                                            onclick="alert('Donation verification and NGO assignment will be connected to MySQL later.')"
                                        >
                                            Manage
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
                            ♥
                        </div>


                        <h3>
                            No donations found
                        </h3>


                        <p>
                            Try changing your search or filters.
                        </p>


                        <a
                            href="donations.php"
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
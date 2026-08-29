<?php

session_start();

/*
|--------------------------------------------------------------------------
| SSISS ADMIN - REWARDS MANAGEMENT
|--------------------------------------------------------------------------
| Demo version.
| MySQL integration will be added later.
|--------------------------------------------------------------------------
*/

$adminName = $_SESSION['admin_name'] ?? 'Admin';


// ==========================================================
// DEMO REWARDS
// ==========================================================

$rewards = [

    [
        'id' => 'RWD-001',
        'name' => '₹50 OFF',
        'description' => 'Get ₹50 off on your next purchase.',
        'type' => 'Flat Discount',
        'value' => '₹50',
        'coins' => 500,
        'tier' => 'Bronze',
        'redemptions' => 128,
        'status' => 'Active',
        'expiry' => '30 Sep 2026'
    ],

    [
        'id' => 'RWD-002',
        'name' => '10% OFF',
        'description' => 'Get 10% discount on your entire order.',
        'type' => 'Percentage Discount',
        'value' => '10%',
        'coins' => 800,
        'tier' => 'Silver',
        'redemptions' => 94,
        'status' => 'Active',
        'expiry' => '30 Sep 2026'
    ],

    [
        'id' => 'RWD-003',
        'name' => '₹150 OFF',
        'description' => 'Get ₹150 off on orders above ₹999.',
        'type' => 'Flat Discount',
        'value' => '₹150',
        'coins' => 1200,
        'tier' => 'Silver',
        'redemptions' => 67,
        'status' => 'Active',
        'expiry' => '15 Oct 2026'
    ],

    [
        'id' => 'RWD-004',
        'name' => '20% OFF',
        'description' => 'Premium 20% discount for Gold members.',
        'type' => 'Percentage Discount',
        'value' => '20%',
        'coins' => 2000,
        'tier' => 'Gold',
        'redemptions' => 43,
        'status' => 'Active',
        'expiry' => '31 Oct 2026'
    ],

    [
        'id' => 'RWD-005',
        'name' => '₹500 OFF',
        'description' => 'Exclusive ₹500 discount for Platinum members.',
        'type' => 'Flat Discount',
        'value' => '₹500',
        'coins' => 4000,
        'tier' => 'Platinum',
        'redemptions' => 18,
        'status' => 'Active',
        'expiry' => '31 Dec 2026'
    ],

    [
        'id' => 'RWD-006',
        'name' => 'FREE SHIPPING',
        'description' => 'Redeem free shipping on your next order.',
        'type' => 'Shipping',
        'value' => 'Free',
        'coins' => 600,
        'tier' => 'Bronze',
        'redemptions' => 156,
        'status' => 'Active',
        'expiry' => '30 Sep 2026'
    ],

    [
        'id' => 'RWD-007',
        'name' => 'EARLY ACCESS',
        'description' => 'Get early access to selected drops.',
        'type' => 'Exclusive Access',
        'value' => 'Early Access',
        'coins' => 1500,
        'tier' => 'Gold',
        'redemptions' => 29,
        'status' => 'Active',
        'expiry' => '31 Dec 2026'
    ],

    [
        'id' => 'RWD-008',
        'name' => 'WELCOME REWARD',
        'description' => 'Special reward for new SSISS members.',
        'type' => 'Welcome Bonus',
        'value' => '₹100',
        'coins' => 0,
        'tier' => 'All',
        'redemptions' => 245,
        'status' => 'Inactive',
        'expiry' => 'Expired'
    ]

];


// ==========================================================
// FILTERS
// ==========================================================

$search = trim($_GET['search'] ?? '');

$typeFilter = trim($_GET['type'] ?? '');

$tierFilter = trim($_GET['tier'] ?? '');

$statusFilter = trim($_GET['status'] ?? '');


// ==========================================================
// FILTER REWARDS
// ==========================================================

$filteredRewards = array_filter(

    $rewards,

    function ($reward) use (
        $search,
        $typeFilter,
        $tierFilter,
        $statusFilter
    ) {

        if ($search !== '') {

            $searchText = strtolower(

                $reward['id'] . ' ' .
                $reward['name'] . ' ' .
                $reward['description']

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


        if (
            $typeFilter !== '' &&
            $reward['type'] !== $typeFilter
        ) {

            return false;

        }


        if (
            $tierFilter !== '' &&
            $reward['tier'] !== $tierFilter
        ) {

            return false;

        }


        if (
            $statusFilter !== '' &&
            $reward['status'] !== $statusFilter
        ) {

            return false;

        }


        return true;

    }

);


// ==========================================================
// STATISTICS
// ==========================================================

$totalRewards = count($rewards);


$activeRewards = count(

    array_filter(

        $rewards,

        function ($reward) {

            return $reward['status'] === 'Active';

        }

    )

);


$inactiveRewards = count(

    array_filter(

        $rewards,

        function ($reward) {

            return $reward['status'] === 'Inactive';

        }

    )

);


$totalRedemptions = array_sum(

    array_column(
        $rewards,
        'redemptions'
    )

);


$totalCoinsRequired = array_sum(

    array_column(
        $rewards,
        'coins'
    )

);


// ==========================================================
// TIER INFORMATION
// ==========================================================

$tiers = [

    [
        'name' => 'Bronze',
        'minimum' => 0,
        'benefit' => 'Basic discounts'
    ],

    [
        'name' => 'Silver',
        'minimum' => 1000,
        'benefit' => 'Better discounts'
    ],

    [
        'name' => 'Gold',
        'minimum' => 2500,
        'benefit' => 'Premium rewards'
    ],

    [
        'name' => 'Platinum',
        'minimum' => 5000,
        'benefit' => 'Exclusive benefits'
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
        Rewards | SSISS Admin
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


            <a href="index.php" class="admin-nav-item">
                <span>⌂</span>
                Dashboard
            </a>


            <a href="products.php" class="admin-nav-item">
                <span>◈</span>
                Products
            </a>


            <a href="categories.php" class="admin-nav-item">
                <span>▦</span>
                Categories
            </a>


            <a href="brands.php" class="admin-nav-item">
                <span>◇</span>
                Brands
            </a>


            <a href="inventory.php" class="admin-nav-item">
                <span>▤</span>
                Inventory
            </a>


            <a href="orders.php" class="admin-nav-item">
                <span>□</span>
                Orders
            </a>


            <a href="users.php" class="admin-nav-item">
                <span>♙</span>
                Users
            </a>


            <div class="admin-nav-divider"></div>


            <div class="admin-section-title">
                CIRCULAR FASHION
            </div>


            <a href="resale.php" class="admin-nav-item">
                <span>♻</span>
                Pre-Loved
            </a>


            <a href="donations.php" class="admin-nav-item">
                <span>♥</span>
                Donations
            </a>


            <a href="ngos.php" class="admin-nav-item">
                <span>◎</span>
                NGOs
            </a>


            <div class="admin-nav-divider"></div>


            <div class="admin-section-title">
                AI & REWARDS
            </div>


            <a href="coins.php" class="admin-nav-item">
                <span>🪙</span>
                SSISS Coins
            </a>


            <a
                href="rewards.php"
                class="admin-nav-item active"
            >
                <span>✦</span>
                Rewards
            </a>


            <a href="ai-analytics.php" class="admin-nav-item">
                <span>✧</span>
                AI Analytics
            </a>


            <div class="admin-nav-divider"></div>


            <a href="reports.php" class="admin-nav-item">
                <span>▥</span>
                Reports
            </a>


            <a href="settings.php" class="admin-nav-item">
                <span>⚙</span>
                Settings
            </a>


        </nav>


        <div class="admin-sidebar-bottom">


            <a href="../index.php" class="view-store">
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


        <header class="admin-topbar">


            <div>

                <p class="admin-breadcrumb">
                    SSISS / Rewards
                </p>


                <h1>
                    Rewards
                </h1>


                <p class="admin-subtitle">
                    Manage discounts, perks and SSISS Coin redemption.
                </p>


            </div>


        </header>


        <!-- ==================================================
             PAGE ACTIONS
        =================================================== -->

        <section class="page-actions">


            <div>

                <h2>
                    Reward Management
                </h2>


                <p>
                    Create and manage rewards available to SSISS members.
                </p>


            </div>


            <button
                type="button"
                class="btn btn-primary"
                onclick="alert('Create reward functionality will be connected later.')"
            >
                + Create Reward
            </button>


        </section>


        <!-- ==================================================
             STATISTICS
        =================================================== -->

        <section class="stats-grid">


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ✦
                    </span>

                </div>


                <p>
                    Total Rewards
                </p>


                <h2>
                    <?= number_format(
                        $totalRewards
                    ); ?>
                </h2>


                <small>
                    Reward campaigns
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ✓
                    </span>

                </div>


                <p>
                    Active Rewards
                </p>


                <h2>
                    <?= number_format(
                        $activeRewards
                    ); ?>
                </h2>


                <small>
                    Currently available
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ↗
                    </span>

                </div>


                <p>
                    Redemptions
                </p>


                <h2>
                    <?= number_format(
                        $totalRedemptions
                    ); ?>
                </h2>


                <small>
                    Total reward redemptions
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        🪙
                    </span>

                </div>


                <p>
                    Coins Required
                </p>


                <h2>
                    <?= number_format(
                        $totalCoinsRequired
                    ); ?>
                </h2>


                <small>
                    Across reward catalogue
                </small>


            </div>


        </section>


        <!-- ==================================================
             MEMBERSHIP TIERS
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        SSISS Membership Tiers
                    </h3>


                    <p>
                        Reward loyal users with better benefits.
                    </p>

                </div>


            </div>


            <div class="table-wrapper">


                <table class="admin-table">


                    <thead>

                        <tr>

                            <th>
                                Tier
                            </th>

                            <th>
                                Minimum Coins
                            </th>

                            <th>
                                Benefits
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php foreach (
                        $tiers as $tier
                    ): ?>


                        <tr>


                            <td>


                                <strong>

                                    <?= htmlspecialchars(
                                        $tier['name']
                                    ); ?>

                                </strong>


                            </td>


                            <td>


                                🪙
                                <?= number_format(
                                    $tier['minimum']
                                ); ?>


                            </td>


                            <td>

                                <?= htmlspecialchars(
                                    $tier['benefit']
                                ); ?>

                            </td>


                            <td>


                                <span
                                    class="status-badge status-active"
                                >
                                    Active
                                </span>


                            </td>


                            <td>


                                <button
                                    type="button"
                                    class="table-action"
                                    onclick="alert('Tier settings will be connected later.')"
                                >
                                    Edit
                                </button>


                            </td>


                        </tr>


                    <?php endforeach; ?>


                    </tbody>


                </table>


            </div>


        </section>


        <!-- ==================================================
             FILTERS
        =================================================== -->

        <section class="dashboard-panel">


            <form
                method="GET"
                action="rewards.php"
                class="filter-form"
            >


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
                        placeholder="Reward name or ID..."
                    >


                </div>


                <div class="form-group">


                    <label for="type">
                        Type
                    </label>


                    <select
                        id="type"
                        name="type"
                    >


                        <option value="">
                            All Types
                        </option>


                        <option value="Flat Discount">
                            Flat Discount
                        </option>


                        <option value="Percentage Discount">
                            Percentage Discount
                        </option>


                        <option value="Shipping">
                            Shipping
                        </option>


                        <option value="Exclusive Access">
                            Exclusive Access
                        </option>


                        <option value="Welcome Bonus">
                            Welcome Bonus
                        </option>


                    </select>


                </div>


                <div class="form-group">


                    <label for="tier">
                        Tier
                    </label>


                    <select
                        id="tier"
                        name="tier"
                    >


                        <option value="">
                            All Tiers
                        </option>


                        <option value="All">
                            All Users
                        </option>


                        <option value="Bronze">
                            Bronze
                        </option>


                        <option value="Silver">
                            Silver
                        </option>


                        <option value="Gold">
                            Gold
                        </option>


                        <option value="Platinum">
                            Platinum
                        </option>


                    </select>


                </div>


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


                        <option value="Active">
                            Active
                        </option>


                        <option value="Inactive">
                            Inactive
                        </option>


                    </select>


                </div>


                <div class="form-actions">


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Apply
                    </button>


                    <a
                        href="rewards.php"
                        class="btn btn-secondary"
                    >
                        Reset
                    </a>


                </div>


            </form>


        </section>


        <!-- ==================================================
             REWARDS TABLE
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        Reward Catalogue
                    </h3>


                    <p>

                        <?= count(
                            $filteredRewards
                        ); ?>

                        reward(s) found

                    </p>


                </div>


            </div>


            <div class="table-wrapper">


                <?php if (
                    !empty(
                        $filteredRewards
                    )
                ): ?>


                    <table class="admin-table">


                        <thead>

                            <tr>

                                <th>
                                    Reward
                                </th>

                                <th>
                                    Type
                                </th>

                                <th>
                                    Value
                                </th>

                                <th>
                                    Coins
                                </th>

                                <th>
                                    Tier
                                </th>

                                <th>
                                    Redemptions
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Expiry
                                </th>

                                <th>
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                        <?php foreach (
                            $filteredRewards
                            as $reward
                        ): ?>


                            <tr>


                                <!-- REWARD -->

                                <td>


                                    <strong>

                                        <?= htmlspecialchars(
                                            $reward['name']
                                        ); ?>

                                    </strong>


                                    <small class="table-subtext">

                                        <?= htmlspecialchars(
                                            $reward['id']
                                        ); ?>

                                    </small>


                                    <small class="table-subtext">

                                        <?= htmlspecialchars(
                                            $reward['description']
                                        ); ?>

                                    </small>


                                </td>


                                <!-- TYPE -->

                                <td>

                                    <?= htmlspecialchars(
                                        $reward['type']
                                    ); ?>

                                </td>


                                <!-- VALUE -->

                                <td>


                                    <strong>

                                        <?= htmlspecialchars(
                                            $reward['value']
                                        ); ?>

                                    </strong>


                                </td>


                                <!-- COINS -->

                                <td>


                                    <?php if (
                                        $reward['coins'] > 0
                                    ): ?>


                                        🪙
                                        <?= number_format(
                                            $reward['coins']
                                        ); ?>


                                    <?php else: ?>


                                        FREE

                                    <?php endif; ?>


                                </td>


                                <!-- TIER -->

                                <td>


                                    <span class="condition-badge">

                                        <?= htmlspecialchars(
                                            $reward['tier']
                                        ); ?>

                                    </span>


                                </td>


                                <!-- REDEMPTIONS -->

                                <td>


                                    <?= number_format(
                                        $reward['redemptions']
                                    ); ?>


                                </td>


                                <!-- STATUS -->

                                <td>


                                    <?php if (
                                        $reward['status'] ===
                                        'Active'
                                    ): ?>


                                        <span
                                            class="status-badge status-active"
                                        >
                                            Active
                                        </span>


                                    <?php else: ?>


                                        <span
                                            class="status-badge status-danger"
                                        >
                                            Inactive
                                        </span>


                                    <?php endif; ?>


                                </td>


                                <!-- EXPIRY -->

                                <td>

                                    <?= htmlspecialchars(
                                        $reward['expiry']
                                    ); ?>

                                </td>


                                <!-- ACTIONS -->

                                <td>


                                    <div class="table-actions">


                                        <button
                                            type="button"
                                            class="table-action"
                                            onclick="alert('Reward editing will be connected to MySQL later.')"
                                        >
                                            Edit
                                        </button>


                                        <button
                                            type="button"
                                            class="table-action"
                                            onclick="alert('Reward status control will be connected later.')"
                                        >
                                            Toggle
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
                            ✦
                        </div>


                        <h3>
                            No rewards found
                        </h3>


                        <p>
                            Try changing your filters.
                        </p>


                        <a
                            href="rewards.php"
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
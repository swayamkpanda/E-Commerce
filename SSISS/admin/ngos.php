<?php

session_start();

/*
|--------------------------------------------------------------------------
| SSISS ADMIN - NGO MANAGEMENT
|--------------------------------------------------------------------------
| Demo version.
| MySQL integration will be added later.
|--------------------------------------------------------------------------
*/

$adminName = $_SESSION['admin_name'] ?? 'Admin';


// ==========================================================
// DEMO NGOS
// ==========================================================

$ngos = [

    [
        'id' => 'NGO-001',
        'name' => 'Helping Hands Foundation',
        'email' => 'contact@helpinghands.org',
        'phone' => '+91 98765 10001',
        'location' => 'Bhubaneswar, Odisha',
        'focus' => 'Clothing & Children',
        'capacity' => 500,
        'received' => 284,
        'beneficiaries' => 420,
        'status' => 'Active',
        'verified' => true,
        'joined' => '10 Jun 2026'
    ],

    [
        'id' => 'NGO-002',
        'name' => 'Hope Foundation',
        'email' => 'contact@hopefoundation.org',
        'phone' => '+91 98765 10002',
        'location' => 'Cuttack, Odisha',
        'focus' => 'Women & Families',
        'capacity' => 350,
        'received' => 196,
        'beneficiaries' => 310,
        'status' => 'Active',
        'verified' => true,
        'joined' => '15 Jun 2026'
    ],

    [
        'id' => 'NGO-003',
        'name' => 'Care India Trust',
        'email' => 'contact@careindiatrust.org',
        'phone' => '+91 98765 10003',
        'location' => 'Puri, Odisha',
        'focus' => 'Rural Communities',
        'capacity' => 400,
        'received' => 241,
        'beneficiaries' => 365,
        'status' => 'Active',
        'verified' => true,
        'joined' => '22 Jun 2026'
    ],

    [
        'id' => 'NGO-004',
        'name' => 'Green Future Initiative',
        'email' => 'hello@greenfuture.org',
        'phone' => '+91 98765 10004',
        'location' => 'Bhubaneswar, Odisha',
        'focus' => 'Sustainability',
        'capacity' => 250,
        'received' => 108,
        'beneficiaries' => 180,
        'status' => 'Active',
        'verified' => true,
        'joined' => '30 Jun 2026'
    ],

    [
        'id' => 'NGO-005',
        'name' => 'Udaan Welfare Society',
        'email' => 'contact@udaan.org',
        'phone' => '+91 98765 10005',
        'location' => 'Khurda, Odisha',
        'focus' => 'Education & Families',
        'capacity' => 300,
        'received' => 75,
        'beneficiaries' => 120,
        'status' => 'Pending',
        'verified' => false,
        'joined' => '02 Jul 2026'
    ],

    [
        'id' => 'NGO-006',
        'name' => 'Hope For All',
        'email' => 'support@hopeforall.org',
        'phone' => '+91 98765 10006',
        'location' => 'Rourkela, Odisha',
        'focus' => 'Homeless Communities',
        'capacity' => 450,
        'received' => 318,
        'beneficiaries' => 510,
        'status' => 'Active',
        'verified' => true,
        'joined' => '07 Jul 2026'
    ],

    [
        'id' => 'NGO-007',
        'name' => 'Sahara Community Trust',
        'email' => 'contact@saharatrust.org',
        'phone' => '+91 98765 10007',
        'location' => 'Balasore, Odisha',
        'focus' => 'Children & Elderly',
        'capacity' => 200,
        'received' => 82,
        'beneficiaries' => 145,
        'status' => 'Inactive',
        'verified' => true,
        'joined' => '12 Jul 2026'
    ],

    [
        'id' => 'NGO-008',
        'name' => 'Nayi Disha Foundation',
        'email' => 'hello@nayidisha.org',
        'phone' => '+91 98765 10008',
        'location' => 'Sambalpur, Odisha',
        'focus' => 'Rural Women',
        'capacity' => 280,
        'received' => 154,
        'beneficiaries' => 240,
        'status' => 'Active',
        'verified' => true,
        'joined' => '18 Jul 2026'
    ]

];


// ==========================================================
// FILTERS
// ==========================================================

$search = trim($_GET['search'] ?? '');

$statusFilter = trim($_GET['status'] ?? '');

$locationFilter = trim(
    $_GET['location'] ?? ''
);

$verifiedFilter = trim(
    $_GET['verified'] ?? ''
);


// ==========================================================
// FILTER NGOS
// ==========================================================

$filteredNgos = array_filter(

    $ngos,

    function ($ngo) use (
        $search,
        $statusFilter,
        $locationFilter,
        $verifiedFilter
    ) {

        // Search

        if ($search !== '') {

            $searchText = strtolower(

                $ngo['id'] . ' ' .
                $ngo['name'] . ' ' .
                $ngo['email'] . ' ' .
                $ngo['location'] . ' ' .
                $ngo['focus']

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
            $ngo['status'] !== $statusFilter
        ) {

            return false;

        }


        // Location

        if (
            $locationFilter !== '' &&
            $ngo['location'] !== $locationFilter
        ) {

            return false;

        }


        // Verification

        if ($verifiedFilter !== '') {

            $isVerified =
                $ngo['verified']
                    ? 'Verified'
                    : 'Pending';

            if (
                $isVerified !==
                $verifiedFilter
            ) {

                return false;

            }

        }


        return true;

    }

);


// ==========================================================
// STATISTICS
// ==========================================================

$totalNgos = count($ngos);


$activeNgos = count(

    array_filter(

        $ngos,

        function ($ngo) {

            return $ngo['status'] ===
                'Active';

        }

    )

);


$pendingNgos = count(

    array_filter(

        $ngos,

        function ($ngo) {

            return $ngo['status'] ===
                'Pending';

        }

    )

);


$verifiedNgos = count(

    array_filter(

        $ngos,

        function ($ngo) {

            return $ngo['verified'] === true;

        }

    )

);


$totalCapacity = array_sum(

    array_column(
        $ngos,
        'capacity'
    )

);


$totalReceived = array_sum(

    array_column(
        $ngos,
        'received'
    )

);


$totalBeneficiaries = array_sum(

    array_column(
        $ngos,
        'beneficiaries'
    )

);


// Remaining capacity

$remainingCapacity =
    $totalCapacity - $totalReceived;

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
        NGOs | SSISS Admin
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
                class="admin-nav-item active"
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
                    SSISS / NGOs
                </p>


                <h1>
                    NGOs
                </h1>


                <p class="admin-subtitle">
                    Manage verified NGO partners and donation distribution.
                </p>


            </div>


        </header>


        <!-- ==================================================
             PAGE ACTIONS
        =================================================== -->

        <section class="page-actions">


            <div>

                <h2>
                    NGO Management
                </h2>


                <p>
                    Manage NGO partners, capacity and community impact.
                </p>


            </div>


            <button
                type="button"
                class="btn btn-primary"
                onclick="alert('Add NGO functionality will be connected later.')"
            >
                + Add NGO
            </button>


        </section>


        <!-- ==================================================
             STATISTICS
        =================================================== -->

        <section class="stats-grid">


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ◎
                    </span>

                </div>


                <p>
                    Total NGOs
                </p>


                <h2>
                    <?= number_format(
                        $totalNgos
                    ); ?>
                </h2>


                <small>
                    Registered partners
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ✓
                    </span>

                </div>


                <p>
                    Active NGOs
                </p>


                <h2>
                    <?= number_format(
                        $activeNgos
                    ); ?>
                </h2>


                <small>
                    Currently accepting donations
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ◷
                    </span>

                </div>


                <p>
                    Pending Verification
                </p>


                <h2>
                    <?= number_format(
                        $pendingNgos
                    ); ?>
                </h2>


                <small>
                    Need admin approval
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ✓
                    </span>

                </div>


                <p>
                    Verified NGOs
                </p>


                <h2>
                    <?= number_format(
                        $verifiedNgos
                    ); ?>
                </h2>


                <small>
                    Trusted partners
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
                        NGO Impact Overview
                    </h3>


                    <p>
                        Monitor donation capacity and community reach.
                    </p>

                </div>


            </div>


            <div class="stats-grid">


                <div class="stat-card">


                    <p>
                        Donation Capacity
                    </p>


                    <h2>
                        <?= number_format(
                            $totalCapacity
                        ); ?>
                    </h2>


                    <small>
                        Total available capacity
                    </small>


                </div>


                <div class="stat-card">


                    <p>
                        Items Received
                    </p>


                    <h2>
                        <?= number_format(
                            $totalReceived
                        ); ?>
                    </h2>


                    <small>
                        Donations delivered
                    </small>


                </div>


                <div class="stat-card">


                    <p>
                        Remaining Capacity
                    </p>


                    <h2>
                        <?= number_format(
                            $remainingCapacity
                        ); ?>
                    </h2>


                    <small>
                        Current available capacity
                    </small>


                </div>


                <div class="stat-card">


                    <p>
                        People Helped
                    </p>


                    <h2>
                        <?= number_format(
                            $totalBeneficiaries
                        ); ?>
                    </h2>


                    <small>
                        Estimated beneficiaries
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
                action="ngos.php"
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
                        placeholder="NGO name, location or focus..."
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
                            value="Active"
                            <?= $statusFilter ===
                                'Active'
                                ? 'selected'
                                : ''; ?>
                        >
                            Active
                        </option>


                        <option
                            value="Inactive"
                            <?= $statusFilter ===
                                'Inactive'
                                ? 'selected'
                                : ''; ?>
                        >
                            Inactive
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


                    </select>


                </div>


                <!-- LOCATION -->

                <div class="form-group">


                    <label for="location">
                        Location
                    </label>


                    <select
                        id="location"
                        name="location"
                    >


                        <option value="">
                            All Locations
                        </option>


                        <option
                            value="Bhubaneswar, Odisha"
                            <?= $locationFilter ===
                                'Bhubaneswar, Odisha'
                                ? 'selected'
                                : ''; ?>
                        >
                            Bhubaneswar
                        </option>


                        <option
                            value="Cuttack, Odisha"
                            <?= $locationFilter ===
                                'Cuttack, Odisha'
                                ? 'selected'
                                : ''; ?>
                        >
                            Cuttack
                        </option>


                        <option
                            value="Puri, Odisha"
                            <?= $locationFilter ===
                                'Puri, Odisha'
                                ? 'selected'
                                : ''; ?>
                        >
                            Puri
                        </option>


                        <option
                            value="Khurda, Odisha"
                            <?= $locationFilter ===
                                'Khurda, Odisha'
                                ? 'selected'
                                : ''; ?>
                        >
                            Khurda
                        </option>


                        <option
                            value="Rourkela, Odisha"
                            <?= $locationFilter ===
                                'Rourkela, Odisha'
                                ? 'selected'
                                : ''; ?>
                        >
                            Rourkela
                        </option>


                        <option
                            value="Balasore, Odisha"
                            <?= $locationFilter ===
                                'Balasore, Odisha'
                                ? 'selected'
                                : ''; ?>
                        >
                            Balasore
                        </option>


                        <option
                            value="Sambalpur, Odisha"
                            <?= $locationFilter ===
                                'Sambalpur, Odisha'
                                ? 'selected'
                                : ''; ?>
                        >
                            Sambalpur
                        </option>


                    </select>


                </div>


                <!-- VERIFICATION -->

                <div class="form-group">


                    <label for="verified">
                        Verification
                    </label>


                    <select
                        id="verified"
                        name="verified"
                    >


                        <option value="">
                            All
                        </option>


                        <option
                            value="Verified"
                            <?= $verifiedFilter ===
                                'Verified'
                                ? 'selected'
                                : ''; ?>
                        >
                            Verified
                        </option>


                        <option
                            value="Pending"
                            <?= $verifiedFilter ===
                                'Pending'
                                ? 'selected'
                                : ''; ?>
                        >
                            Pending
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
                        href="ngos.php"
                        class="btn btn-secondary"
                    >
                        Reset
                    </a>


                </div>


            </form>


        </section>


        <!-- ==================================================
             NGO TABLE
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        NGO Partners
                    </h3>


                    <p>

                        <?= count(
                            $filteredNgos
                        ); ?>

                        NGO(s) found

                    </p>


                </div>


            </div>


            <div class="table-wrapper">


                <?php if (
                    !empty(
                        $filteredNgos
                    )
                ): ?>


                    <table class="admin-table">


                        <thead>

                            <tr>

                                <th>
                                    NGO
                                </th>

                                <th>
                                    Contact
                                </th>

                                <th>
                                    Location
                                </th>

                                <th>
                                    Focus
                                </th>

                                <th>
                                    Capacity
                                </th>

                                <th>
                                    Received
                                </th>

                                <th>
                                    Beneficiaries
                                </th>

                                <th>
                                    Verification
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                        <?php foreach (
                            $filteredNgos
                            as $ngo
                        ): ?>


                            <tr>


                                <!-- NGO -->

                                <td>


                                    <strong>

                                        <?= htmlspecialchars(
                                            $ngo['name']
                                        ); ?>

                                    </strong>


                                    <small class="table-subtext">

                                        <?= htmlspecialchars(
                                            $ngo['id']
                                        ); ?>

                                    </small>


                                </td>


                                <!-- CONTACT -->

                                <td>


                                    <strong>

                                        <?= htmlspecialchars(
                                            $ngo['email']
                                        ); ?>

                                    </strong>


                                    <small class="table-subtext">

                                        <?= htmlspecialchars(
                                            $ngo['phone']
                                        ); ?>

                                    </small>


                                </td>


                                <!-- LOCATION -->

                                <td>

                                    <?= htmlspecialchars(
                                        $ngo['location']
                                    ); ?>

                                </td>


                                <!-- FOCUS -->

                                <td>

                                    <?= htmlspecialchars(
                                        $ngo['focus']
                                    ); ?>

                                </td>


                                <!-- CAPACITY -->

                                <td>


                                    <strong>

                                        <?= number_format(
                                            $ngo['capacity']
                                        ); ?>

                                    </strong>


                                </td>


                                <!-- RECEIVED -->

                                <td>


                                    <strong>

                                        <?= number_format(
                                            $ngo['received']
                                        ); ?>

                                    </strong>


                                </td>


                                <!-- BENEFICIARIES -->

                                <td>


                                    <strong>

                                        <?= number_format(
                                            $ngo['beneficiaries']
                                        ); ?>

                                    </strong>


                                </td>


                                <!-- VERIFICATION -->

                                <td>


                                    <?php if (
                                        $ngo['verified']
                                    ): ?>


                                        <span
                                            class="status-badge status-active"
                                        >
                                            ✓ Verified
                                        </span>


                                    <?php else: ?>


                                        <span
                                            class="status-badge status-warning"
                                        >
                                            ◷ Pending
                                        </span>


                                    <?php endif; ?>


                                </td>


                                <!-- STATUS -->

                                <td>


                                    <?php

                                    if (
                                        $ngo['status'] ===
                                        'Active'
                                    ) {

                                        $statusClass =
                                            'status-active';

                                    } elseif (
                                        $ngo['status'] ===
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
                                            $ngo['status']
                                        ); ?>

                                    </span>


                                </td>


                                <!-- ACTIONS -->

                                <td>


                                    <div class="table-actions">


                                        <button
                                            type="button"
                                            class="table-action"
                                            onclick="alert('NGO details will be connected later.')"
                                        >
                                            View
                                        </button>


                                        <button
                                            type="button"
                                            class="table-action"
                                            onclick="alert('NGO verification and management will be connected to MySQL later.')"
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
                            ◎
                        </div>


                        <h3>
                            No NGOs found
                        </h3>


                        <p>
                            Try changing your search or filters.
                        </p>


                        <a
                            href="ngos.php"
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
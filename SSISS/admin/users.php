<?php

session_start();

/*
|--------------------------------------------------------------------------
| SSISS ADMIN - USER MANAGEMENT
|--------------------------------------------------------------------------
| Demo version.
| MySQL user integration will be connected later.
|--------------------------------------------------------------------------
*/

$adminName = $_SESSION['admin_name'] ?? 'Admin';


// ==========================================================
// DEMO USERS
// ==========================================================

$users = [

    [
        'id' => 10001,
        'name' => 'Aarav Sharma',
        'email' => 'aarav@example.com',
        'phone' => '+91 98765 43210',
        'gender' => 'Male',
        'coins' => 1250,
        'orders' => 12,
        'spent' => 18450,
        'status' => 'Active',
        'joined' => '12 Aug 2026',
        'role' => 'Customer'
    ],

    [
        'id' => 10002,
        'name' => 'Ananya Das',
        'email' => 'ananya@example.com',
        'phone' => '+91 91234 56789',
        'gender' => 'Female',
        'coins' => 2840,
        'orders' => 18,
        'spent' => 29680,
        'status' => 'Active',
        'joined' => '08 Aug 2026',
        'role' => 'Customer'
    ],

    [
        'id' => 10003,
        'name' => 'Rohan Patel',
        'email' => 'rohan@example.com',
        'phone' => '+91 99887 66554',
        'gender' => 'Male',
        'coins' => 620,
        'orders' => 5,
        'spent' => 7499,
        'status' => 'Active',
        'joined' => '03 Aug 2026',
        'role' => 'Customer'
    ],

    [
        'id' => 10004,
        'name' => 'Diya Mehta',
        'email' => 'diya@example.com',
        'phone' => '+91 98761 23456',
        'gender' => 'Female',
        'coins' => 4210,
        'orders' => 24,
        'spent' => 42850,
        'status' => 'Active',
        'joined' => '27 Jul 2026',
        'role' => 'Customer'
    ],

    [
        'id' => 10005,
        'name' => 'Kabir Singh',
        'email' => 'kabir@example.com',
        'phone' => '+91 90909 80808',
        'gender' => 'Male',
        'coins' => 350,
        'orders' => 3,
        'spent' => 4199,
        'status' => 'Suspended',
        'joined' => '22 Jul 2026',
        'role' => 'Customer'
    ],

    [
        'id' => 10006,
        'name' => 'Meera Nair',
        'email' => 'meera@example.com',
        'phone' => '+91 93456 78901',
        'gender' => 'Female',
        'coins' => 1980,
        'orders' => 10,
        'spent' => 15780,
        'status' => 'Active',
        'joined' => '18 Jul 2026',
        'role' => 'Customer'
    ],

    [
        'id' => 10007,
        'name' => 'Vihaan Roy',
        'email' => 'vihaan@example.com',
        'phone' => '+91 97654 32109',
        'gender' => 'Male',
        'coins' => 890,
        'orders' => 7,
        'spent' => 10890,
        'status' => 'Active',
        'joined' => '11 Jul 2026',
        'role' => 'Customer'
    ],

    [
        'id' => 10008,
        'name' => 'Ishita Sen',
        'email' => 'ishita@example.com',
        'phone' => '+91 95555 44444',
        'gender' => 'Female',
        'coins' => 3120,
        'orders' => 16,
        'spent' => 26740,
        'status' => 'Active',
        'joined' => '05 Jul 2026',
        'role' => 'Customer'
    ],

    [
        'id' => 10009,
        'name' => 'Arjun Kapoor',
        'email' => 'arjun@example.com',
        'phone' => '+91 98888 77777',
        'gender' => 'Male',
        'coins' => 540,
        'orders' => 4,
        'spent' => 6299,
        'status' => 'Inactive',
        'joined' => '28 Jun 2026',
        'role' => 'Customer'
    ],

    [
        'id' => 10010,
        'name' => 'Saanvi Rao',
        'email' => 'saanvi@example.com',
        'phone' => '+91 92222 33333',
        'gender' => 'Female',
        'coins' => 3750,
        'orders' => 21,
        'spent' => 38950,
        'status' => 'Active',
        'joined' => '21 Jun 2026',
        'role' => 'Customer'
    ]

];


// ==========================================================
// FILTERS
// ==========================================================

$search = trim($_GET['search'] ?? '');

$statusFilter = trim($_GET['status'] ?? '');

$genderFilter = trim($_GET['gender'] ?? '');


// ==========================================================
// FILTER USERS
// ==========================================================

$filteredUsers = array_filter(

    $users,

    function ($user) use (
        $search,
        $statusFilter,
        $genderFilter
    ) {

        // Search

        if ($search !== '') {

            $searchText = strtolower(

                $user['name'] . ' ' .
                $user['email'] . ' ' .
                $user['phone'] . ' ' .
                $user['id']

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
            $user['status'] !== $statusFilter
        ) {

            return false;

        }


        // Gender

        if (
            $genderFilter !== '' &&
            $user['gender'] !== $genderFilter
        ) {

            return false;

        }


        return true;

    }

);


// ==========================================================
// STATISTICS
// ==========================================================

$totalUsers = count($users);


$activeUsers = count(

    array_filter(

        $users,

        function ($user) {

            return $user['status'] === 'Active';

        }

    )

);


$suspendedUsers = count(

    array_filter(

        $users,

        function ($user) {

            return $user['status'] === 'Suspended';

        }

    )

);


$totalOrders = array_sum(

    array_column(
        $users,
        'orders'
    )

);


$totalSpent = array_sum(

    array_column(
        $users,
        'spent'
    )

);


$totalCoins = array_sum(

    array_column(
        $users,
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
        Users | SSISS Admin
    </title>


    <!-- CSS WILL BE CREATED LATER -->

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
                class="admin-nav-item active"
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
                    SSISS / Users
                </p>


                <h1>
                    Users
                </h1>


                <p class="admin-subtitle">
                    Manage SSISS customers and their accounts.
                </p>


            </div>


        </header>


        <!-- ==================================================
             PAGE ACTION
        =================================================== -->

        <section class="page-actions">


            <div>

                <h2>
                    User Management
                </h2>


                <p>
                    View customers, activity, orders and SSISS Coins.
                </p>


            </div>


            <button
                type="button"
                class="btn btn-primary"
                onclick="alert('Add user functionality will be connected later.')"
            >
                + Add User
            </button>


        </section>


        <!-- ==================================================
             STATISTICS
        =================================================== -->

        <section class="stats-grid">


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ♙
                    </span>

                </div>


                <p>
                    Total Users
                </p>


                <h2>
                    <?= number_format(
                        $totalUsers
                    ); ?>
                </h2>


                <small>
                    Registered customers
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ✓
                    </span>

                </div>


                <p>
                    Active Users
                </p>


                <h2>
                    <?= number_format(
                        $activeUsers
                    ); ?>
                </h2>


                <small>
                    Currently active
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        □
                    </span>

                </div>


                <p>
                    Orders
                </p>


                <h2>
                    <?= number_format(
                        $totalOrders
                    ); ?>
                </h2>


                <small>
                    Orders by all users
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        🪙
                    </span>

                </div>


                <p>
                    SSISS Coins
                </p>


                <h2>
                    <?= number_format(
                        $totalCoins
                    ); ?>
                </h2>


                <small>
                    Coins held by users
                </small>


            </div>


        </section>


        <!-- ==================================================
             USER SUMMARY
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        Customer Overview
                    </h3>


                    <p>
                        High-level customer activity.
                    </p>

                </div>


            </div>


            <div class="stats-grid">


                <div class="stat-card">


                    <p>
                        Total Customer Spend
                    </p>


                    <h2>
                        ₹<?= number_format(
                            $totalSpent
                        ); ?>
                    </h2>


                    <small>
                        Lifetime spending
                    </small>


                </div>


                <div class="stat-card">


                    <p>
                        Suspended Accounts
                    </p>


                    <h2>
                        <?= number_format(
                            $suspendedUsers
                        ); ?>
                    </h2>


                    <small>
                        Require attention
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
                action="users.php"
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
                        placeholder="Name, email, phone or ID..."
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
                            value="Suspended"
                            <?= $statusFilter ===
                                'Suspended'
                                ? 'selected'
                                : ''; ?>
                        >
                            Suspended
                        </option>


                    </select>


                </div>


                <!-- GENDER -->

                <div class="form-group">


                    <label for="gender">
                        Gender
                    </label>


                    <select
                        id="gender"
                        name="gender"
                    >


                        <option value="">
                            All
                        </option>


                        <option
                            value="Male"
                            <?= $genderFilter ===
                                'Male'
                                ? 'selected'
                                : ''; ?>
                        >
                            Male
                        </option>


                        <option
                            value="Female"
                            <?= $genderFilter ===
                                'Female'
                                ? 'selected'
                                : ''; ?>
                        >
                            Female
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
                        href="users.php"
                        class="btn btn-secondary"
                    >
                        Reset
                    </a>


                </div>


            </form>


        </section>


        <!-- ==================================================
             USERS TABLE
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        All Users
                    </h3>


                    <p>

                        <?= count(
                            $filteredUsers
                        ); ?>

                        user(s) found

                    </p>


                </div>


            </div>


            <div class="table-wrapper">


                <?php if (
                    !empty(
                        $filteredUsers
                    )
                ): ?>


                    <table class="admin-table">


                        <thead>

                            <tr>

                                <th>
                                    User
                                </th>

                                <th>
                                    Contact
                                </th>

                                <th>
                                    Gender
                                </th>

                                <th>
                                    Orders
                                </th>

                                <th>
                                    Spent
                                </th>

                                <th>
                                    SSISS Coins
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Joined
                                </th>

                                <th>
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                        <?php foreach (
                            $filteredUsers
                            as $user
                        ): ?>


                            <tr>


                                <!-- USER -->

                                <td>


                                    <strong>

                                        <?= htmlspecialchars(
                                            $user['name']
                                        ); ?>

                                    </strong>


                                    <small class="table-subtext">

                                        ID:
                                        <?= htmlspecialchars(
                                            $user['id']
                                        ); ?>

                                    </small>


                                </td>


                                <!-- CONTACT -->

                                <td>


                                    <strong>

                                        <?= htmlspecialchars(
                                            $user['email']
                                        ); ?>

                                    </strong>


                                    <small class="table-subtext">

                                        <?= htmlspecialchars(
                                            $user['phone']
                                        ); ?>

                                    </small>


                                </td>


                                <!-- GENDER -->

                                <td>

                                    <?= htmlspecialchars(
                                        $user['gender']
                                    ); ?>

                                </td>


                                <!-- ORDERS -->

                                <td>


                                    <strong>

                                        <?= number_format(
                                            $user['orders']
                                        ); ?>

                                    </strong>


                                </td>


                                <!-- SPENT -->

                                <td>


                                    <strong>

                                        ₹<?= number_format(
                                            $user['spent']
                                        ); ?>

                                    </strong>


                                </td>


                                <!-- COINS -->

                                <td>


                                    <strong>

                                        🪙
                                        <?= number_format(
                                            $user['coins']
                                        ); ?>

                                    </strong>


                                </td>


                                <!-- STATUS -->

                                <td>


                                    <?php

                                    if (
                                        $user['status'] ===
                                        'Active'
                                    ) {

                                        $statusClass =
                                            'status-active';

                                    } elseif (
                                        $user['status'] ===
                                        'Suspended'
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
                                            $user['status']
                                        ); ?>

                                    </span>


                                </td>


                                <!-- JOINED -->

                                <td>

                                    <?= htmlspecialchars(
                                        $user['joined']
                                    ); ?>

                                </td>


                                <!-- ACTIONS -->

                                <td>


                                    <div class="table-actions">


                                        <a
                                            href="view-user.php?id=<?= urlencode(
                                                $user['id']
                                            ); ?>"
                                            class="table-action"
                                        >
                                            View
                                        </a>


                                        <button
                                            type="button"
                                            class="table-action"
                                            onclick="alert('User management will be connected to MySQL later.')"
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
                            ♙
                        </div>


                        <h3>
                            No users found
                        </h3>


                        <p>
                            Try changing your search or filters.
                        </p>


                        <a
                            href="users.php"
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
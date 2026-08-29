<?php

session_start();

/*
|--------------------------------------------------------------------------
| SSISS ADMIN - REPORTS
|--------------------------------------------------------------------------
| Demo version.
| MySQL integration will be added later.
|--------------------------------------------------------------------------
*/

$adminName = $_SESSION['admin_name'] ?? 'Admin';


// ==========================================================
// DEMO REPORT DATA
// ==========================================================

$report = [

    'totalSales' => 584920,
    'totalOrders' => 1248,
    'totalUsers' => 6840,
    'newUsers' => 426,

    'totalProducts' => 486,
    'activeProducts' => 421,

    'resaleItems' => 284,
    'resaleSales' => 92400,

    'donations' => 184,
    'donatedItems' => 942,

    'ngoPartners' => 8,
    'peopleHelped' => 2290,

    'coinsIssued' => 128400,
    'coinsRedeemed' => 68420,

    'aiRecommendations' => 12840,
    'aiConversion' => 76.6

];


// ==========================================================
// MONTHLY SALES
// ==========================================================

$monthlySales = [

    [
        'month' => 'March',
        'orders' => 126,
        'sales' => 58200
    ],

    [
        'month' => 'April',
        'orders' => 148,
        'sales' => 67400
    ],

    [
        'month' => 'May',
        'orders' => 172,
        'sales' => 78200
    ],

    [
        'month' => 'June',
        'orders' => 214,
        'sales' => 96400
    ],

    [
        'month' => 'July',
        'orders' => 256,
        'sales' => 118320
    ],

    [
        'month' => 'August',
        'orders' => 332,
        'sales' => 166400
    ]

];


// ==========================================================
// CATEGORY SALES
// ==========================================================

$categorySales = [

    [
        'category' => 'T-Shirts',
        'orders' => 286,
        'sales' => 84200
    ],

    [
        'category' => 'Sneakers',
        'orders' => 242,
        'sales' => 103500
    ],

    [
        'category' => 'Dresses',
        'orders' => 198,
        'sales' => 92400
    ],

    [
        'category' => 'Watches',
        'orders' => 156,
        'sales' => 68400
    ],

    [
        'category' => 'Jackets',
        'orders' => 142,
        'sales' => 74600
    ],

    [
        'category' => 'Spectacles',
        'orders' => 124,
        'sales' => 58200
    ]

];


// ==========================================================
// IMPACT REPORT
// ==========================================================

$impactData = [

    [
        'metric' => 'Clothing Donated',
        'value' => 942,
        'unit' => 'items'
    ],

    [
        'metric' => 'NGO Deliveries',
        'value' => 136,
        'unit' => 'deliveries'
    ],

    [
        'metric' => 'People Helped',
        'value' => 2290,
        'unit' => 'people'
    ],

    [
        'metric' => 'Pre-Loved Items Resold',
        'value' => 284,
        'unit' => 'items'
    ],

    [
        'metric' => 'Estimated Textile Waste Avoided',
        'value' => 1.8,
        'unit' => 'tons'
    ],

    [
        'metric' => 'SSISS Coins Given',
        'value' => 128400,
        'unit' => 'coins'
    ]

];


// ==========================================================
// AI REPORT
// ==========================================================

$aiReport = [

    [
        'feature' => 'Vibe Dress AI',
        'requests' => 3840,
        'success' => 91.2
    ],

    [
        'feature' => 'Image Style Analysis',
        'requests' => 5120,
        'success' => 86.4
    ],

    [
        'feature' => 'Budget Stylist',
        'requests' => 2260,
        'success' => 84.8
    ],

    [
        'feature' => 'Smart Product Matching',
        'requests' => 1620,
        'success' => 89.6
    ]

];


// ==========================================================
// FILTERS
// ==========================================================

$period = $_GET['period'] ?? '6months';

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
        Reports | SSISS Admin
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
                class="admin-nav-item active"
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
                    SSISS / Reports
                </p>


                <h1>
                    Reports
                </h1>


                <p class="admin-subtitle">
                    Business, customer, AI and social-impact performance.
                </p>


            </div>


        </header>


        <!-- ==================================================
             PAGE ACTIONS
        =================================================== -->

        <section class="page-actions">


            <div>

                <h2>
                    SSISS Reports Center
                </h2>


                <p>
                    View your complete store and social-impact performance.
                </p>


            </div>


            <button
                type="button"
                class="btn btn-primary"
                onclick="alert('PDF/CSV report export will be connected later.')"
            >
                ↓ Export Report
            </button>


        </section>


        <!-- ==================================================
             PERIOD FILTER
        =================================================== -->

        <section class="dashboard-panel">


            <form
                method="GET"
                action="reports.php"
                class="filter-form"
            >


                <div class="form-group">


                    <label for="period">
                        Reporting Period
                    </label>


                    <select
                        id="period"
                        name="period"
                    >


                        <option
                            value="7days"
                            <?= $period === '7days'
                                ? 'selected'
                                : ''; ?>
                        >
                            Last 7 Days
                        </option>


                        <option
                            value="30days"
                            <?= $period === '30days'
                                ? 'selected'
                                : ''; ?>
                        >
                            Last 30 Days
                        </option>


                        <option
                            value="6months"
                            <?= $period === '6months'
                                ? 'selected'
                                : ''; ?>
                        >
                            Last 6 Months
                        </option>


                        <option
                            value="1year"
                            <?= $period === '1year'
                                ? 'selected'
                                : ''; ?>
                        >
                            Last 1 Year
                        </option>


                    </select>


                </div>


                <div class="form-actions">


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Generate
                    </button>


                </div>


            </form>


        </section>


        <!-- ==================================================
             BUSINESS OVERVIEW
        =================================================== -->

        <section class="stats-grid">


            <div class="stat-card">


                <p>
                    Total Sales
                </p>


                <h2>

                    ₹<?= number_format(
                        $report['totalSales']
                    ); ?>

                </h2>


                <small>
                    Gross store sales
                </small>


            </div>


            <div class="stat-card">


                <p>
                    Total Orders
                </p>


                <h2>

                    <?= number_format(
                        $report['totalOrders']
                    ); ?>

                </h2>


                <small>
                    Completed store orders
                </small>


            </div>


            <div class="stat-card">


                <p>
                    Total Users
                </p>


                <h2>

                    <?= number_format(
                        $report['totalUsers']
                    ); ?>

                </h2>


                <small>
                    Registered customers
                </small>


            </div>


            <div class="stat-card">


                <p>
                    New Users
                </p>


                <h2>

                    <?= number_format(
                        $report['newUsers']
                    ); ?>

                </h2>


                <small>
                    New registrations
                </small>


            </div>


        </section>


        <!-- ==================================================
             PRODUCT OVERVIEW
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        Product Performance
                    </h3>


                    <p>
                        Current catalogue performance.
                    </p>

                </div>


            </div>


            <div class="stats-grid">


                <div class="stat-card">


                    <p>
                        Total Products
                    </p>


                    <h2>

                        <?= number_format(
                            $report['totalProducts']
                        ); ?>

                    </h2>


                    <small>
                        Products in catalogue
                    </small>


                </div>


                <div class="stat-card">


                    <p>
                        Active Products
                    </p>


                    <h2>

                        <?= number_format(
                            $report['activeProducts']
                        ); ?>

                    </h2>


                    <small>
                        Currently available
                    </small>


                </div>


                <div class="stat-card">


                    <p>
                        Pre-Loved Items
                    </p>


                    <h2>

                        <?= number_format(
                            $report['resaleItems']
                        ); ?>

                    </h2>


                    <small>
                        User-listed fashion
                    </small>


                </div>


                <div class="stat-card">


                    <p>
                        Pre-Loved Sales
                    </p>


                    <h2>

                        ₹<?= number_format(
                            $report['resaleSales']
                        ); ?>

                    </h2>


                    <small>
                        Resale marketplace revenue
                    </small>


                </div>


            </div>


        </section>


        <!-- ==================================================
             SALES REPORT
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        Monthly Sales
                    </h3>


                    <p>
                        Orders and sales over recent months.
                    </p>

                </div>


            </div>


            <div class="table-wrapper">


                <table class="admin-table">


                    <thead>

                        <tr>

                            <th>
                                Month
                            </th>

                            <th>
                                Orders
                            </th>

                            <th>
                                Sales
                            </th>

                            <th>
                                Average Order Value
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php foreach (
                        $monthlySales as $month
                    ): ?>


                        <tr>


                            <td>

                                <strong>

                                    <?= htmlspecialchars(
                                        $month['month']
                                    ); ?>

                                </strong>

                            </td>


                            <td>

                                <?= number_format(
                                    $month['orders']
                                ); ?>

                            </td>


                            <td>

                                ₹<?= number_format(
                                    $month['sales']
                                ); ?>

                            </td>


                            <td>

                                ₹<?= number_format(
                                    $month['sales'] /
                                    $month['orders']
                                ); ?>

                            </td>


                        </tr>


                    <?php endforeach; ?>


                    </tbody>


                </table>


            </div>


        </section>


        <!-- ==================================================
             CATEGORY REPORT
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        Category Performance
                    </h3>


                    <p>
                        Sales performance across fashion categories.
                    </p>

                </div>


            </div>


            <div class="table-wrapper">


                <table class="admin-table">


                    <thead>

                        <tr>

                            <th>
                                Category
                            </th>

                            <th>
                                Orders
                            </th>

                            <th>
                                Revenue
                            </th>

                            <th>
                                Average Order
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php foreach (
                        $categorySales as $category
                    ): ?>


                        <tr>


                            <td>

                                <strong>

                                    <?= htmlspecialchars(
                                        $category['category']
                                    ); ?>

                                </strong>

                            </td>


                            <td>

                                <?= number_format(
                                    $category['orders']
                                ); ?>

                            </td>


                            <td>

                                ₹<?= number_format(
                                    $category['sales']
                                ); ?>

                            </td>


                            <td>

                                ₹<?= number_format(
                                    $category['sales'] /
                                    $category['orders']
                                ); ?>

                            </td>


                        </tr>


                    <?php endforeach; ?>


                    </tbody>


                </table>


            </div>


        </section>


        <!-- ==================================================
             SOCIAL IMPACT REPORT
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        ♻ Social Impact Report
                    </h3>


                    <p>
                        The difference SSISS is making through circular fashion.
                    </p>

                </div>


            </div>


            <div class="stats-grid">


                <div class="stat-card">


                    <p>
                        Donations
                    </p>


                    <h2>

                        <?= number_format(
                            $report['donations']
                        ); ?>

                    </h2>


                    <small>
                        Clothing donation requests
                    </small>


                </div>


                <div class="stat-card">


                    <p>
                        Items Donated
                    </p>


                    <h2>

                        <?= number_format(
                            $report['donatedItems']
                        ); ?>

                    </h2>


                    <small>
                        Clothing items redistributed
                    </small>


                </div>


                <div class="stat-card">


                    <p>
                        NGO Partners
                    </p>


                    <h2>

                        <?= number_format(
                            $report['ngoPartners']
                        ); ?>

                    </h2>


                    <small>
                        Active NGO partners
                    </small>


                </div>


                <div class="stat-card">


                    <p>
                        People Helped
                    </p>


                    <h2>

                        <?= number_format(
                            $report['peopleHelped']
                        ); ?>

                    </h2>


                    <small>
                        Estimated beneficiaries
                    </small>


                </div>


            </div>


            <div class="table-wrapper">


                <table class="admin-table">


                    <thead>

                        <tr>

                            <th>
                                Impact Metric
                            </th>

                            <th>
                                Value
                            </th>

                            <th>
                                Unit
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php foreach (
                        $impactData as $impact
                    ): ?>


                        <tr>


                            <td>

                                <strong>

                                    <?= htmlspecialchars(
                                        $impact['metric']
                                    ); ?>

                                </strong>

                            </td>


                            <td>

                                <?= number_format(
                                    $impact['value']
                                ); ?>

                            </td>


                            <td>

                                <?= htmlspecialchars(
                                    $impact['unit']
                                ); ?>

                            </td>


                        </tr>


                    <?php endforeach; ?>


                    </tbody>


                </table>


            </div>


        </section>


        <!-- ==================================================
             COIN REPORT
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        🪙 SSISS Coin Economy
                    </h3>


                    <p>
                        Monitor rewards issued and redeemed by customers.
                    </p>

                </div>


            </div>


            <div class="stats-grid">


                <div class="stat-card">


                    <p>
                        Coins Issued
                    </p>


                    <h2>

                        <?= number_format(
                            $report['coinsIssued']
                        ); ?>

                    </h2>


                    <small>
                        Rewards distributed
                    </small>


                </div>


                <div class="stat-card">


                    <p>
                        Coins Redeemed
                    </p>


                    <h2>

                        <?= number_format(
                            $report['coinsRedeemed']
                        ); ?>

                    </h2>


                    <small>
                        Used for rewards
                    </small>


                </div>


                <div class="stat-card">


                    <p>
                        Coins Remaining
                    </p>


                    <h2>

                        <?= number_format(
                            $report['coinsIssued'] -
                            $report['coinsRedeemed']
                        ); ?>

                    </h2>


                    <small>
                        Outstanding customer coins
                    </small>


                </div>


            </div>


        </section>


        <!-- ==================================================
             AI REPORT
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        🤖 AI Performance
                    </h3>


                    <p>
                        Performance of SSISS AI fashion tools.
                    </p>

                </div>


            </div>


            <div class="stats-grid">


                <div class="stat-card">


                    <p>
                        AI Recommendations
                    </p>


                    <h2>

                        <?= number_format(
                            $report['aiRecommendations']
                        ); ?>

                    </h2>


                    <small>
                        Total recommendations
                    </small>


                </div>


                <div class="stat-card">


                    <p>
                        AI Conversion
                    </p>


                    <h2>

                        <?= number_format(
                            $report['aiConversion'],
                            1
                        ); ?>%

                    </h2>


                    <small>
                        Recommendation engagement
                    </small>


                </div>


            </div>


            <div class="table-wrapper">


                <table class="admin-table">


                    <thead>

                        <tr>

                            <th>
                                AI Feature
                            </th>

                            <th>
                                Requests
                            </th>

                            <th>
                                Success Rate
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php foreach (
                        $aiReport as $ai
                    ): ?>


                        <tr>


                            <td>

                                <strong>

                                    <?= htmlspecialchars(
                                        $ai['feature']
                                    ); ?>

                                </strong>

                            </td>


                            <td>

                                <?= number_format(
                                    $ai['requests']
                                ); ?>

                            </td>


                            <td>


                                <span
                                    class="status-badge status-active"
                                >

                                    <?= number_format(
                                        $ai['success'],
                                        1
                                    ); ?>%

                                </span>


                            </td>


                        </tr>


                    <?php endforeach; ?>


                    </tbody>


                </table>


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
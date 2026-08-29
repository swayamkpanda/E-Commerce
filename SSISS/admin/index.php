<?php
// TODO: Implement this SSISS module.

session_start();

/*
|--------------------------------------------------------------------------
| SSISS ADMIN DASHBOARD
|--------------------------------------------------------------------------
| Temporary demo data is used for now.
| We will connect this page to MySQL later.
|--------------------------------------------------------------------------
*/

// Temporary admin user for UI development.
// REMOVE this when real authentication is connected.
$adminName = $_SESSION['admin_name'] ?? 'Admin';

// Demo statistics
$stats = [
    'revenue' => 284950,
    'orders' => 1284,
    'users' => 8432,
    'products' => 1268,
    'donations' => 384,
    'coins_issued' => 185420,
    'coins_redeemed' => 92750,
    'resale_listings' => 426
];

// Demo recent orders
$recentOrders = [
    [
        'id' => 'SSG10284',
        'customer' => 'Arjun Sharma',
        'product' => 'Oversized Street Tee',
        'amount' => 699,
        'status' => 'Delivered'
    ],
    [
        'id' => 'SSG10283',
        'customer' => 'Riya Das',
        'product' => 'Cargo Pants',
        'amount' => 999,
        'status' => 'Shipped'
    ],
    [
        'id' => 'SSG10282',
        'customer' => 'Kabir Singh',
        'product' => 'Minimal Watch',
        'amount' => 1299,
        'status' => 'Processing'
    ],
    [
        'id' => 'SSG10281',
        'customer' => 'Ananya Roy',
        'product' => 'Classic Sneakers',
        'amount' => 1999,
        'status' => 'Delivered'
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

    <title>SSISS Admin Dashboard</title>

    <link
        rel="stylesheet"
        href="../assets/css/dashboard.css"
    >

    <link
        rel="stylesheet"
        href="../assets/css/style.css"
    >
</head>

<body>

<div class="admin-layout">

    <!-- =========================================
         SIDEBAR
    ========================================== -->

    <aside class="admin-sidebar">

        <div class="admin-logo">
            S<span>SISS</span>
        </div>

        <div class="admin-label">
            ADMIN PANEL
        </div>

        <nav class="admin-nav">

            <a
                href="index.php"
                class="admin-nav-item active"
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
                SSISS AI & REWARDS
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
                    <?= strtoupper(substr($adminName, 0, 1)); ?>
                </div>

                <div>
                    <strong>
                        <?= htmlspecialchars($adminName); ?>
                    </strong>

                    <small>
                        Administrator
                    </small>
                </div>

            </div>

        </div>

    </aside>


    <!-- =========================================
         MAIN CONTENT
    ========================================== -->

    <main class="admin-main">

        <!-- TOP BAR -->

        <header class="admin-topbar">

            <div>

                <p class="admin-breadcrumb">
                    SSISS / Dashboard
                </p>

                <h1>
                    Good morning, <?= htmlspecialchars($adminName); ?>.
                </h1>

                <p class="admin-subtitle">
                    Here's what's happening across SSISS today.
                </p>

            </div>

            <div class="admin-top-actions">

                <button
                    class="icon-button"
                    title="Notifications"
                >
                    ♧
                    <span class="notification-dot"></span>
                </button>

                <div class="admin-user">

                    <div class="admin-avatar">
                        <?= strtoupper(substr($adminName, 0, 1)); ?>
                    </div>

                    <div>
                        <strong>
                            <?= htmlspecialchars($adminName); ?>
                        </strong>

                        <small>
                            Admin
                        </small>
                    </div>

                </div>

            </div>

        </header>


        <!-- =========================================
             STATISTICS
        ========================================== -->

        <section class="stats-grid">

            <div class="stat-card">

                <div class="stat-card-top">
                    <span class="stat-icon">₹</span>

                    <span class="stat-trend positive">
                        +12.8%
                    </span>
                </div>

                <p>Total Revenue</p>

                <h2>
                    ₹<?= number_format($stats['revenue']); ?>
                </h2>

                <small>
                    Compared with last month
                </small>

            </div>


            <div class="stat-card">

                <div class="stat-card-top">
                    <span class="stat-icon">□</span>

                    <span class="stat-trend positive">
                        +8.4%
                    </span>
                </div>

                <p>Total Orders</p>

                <h2>
                    <?= number_format($stats['orders']); ?>
                </h2>

                <small>
                    Orders placed
                </small>

            </div>


            <div class="stat-card">

                <div class="stat-card-top">
                    <span class="stat-icon">♙</span>

                    <span class="stat-trend positive">
                        +14.2%
                    </span>
                </div>

                <p>Users</p>

                <h2>
                    <?= number_format($stats['users']); ?>
                </h2>

                <small>
                    Registered users
                </small>

            </div>


            <div class="stat-card">

                <div class="stat-card-top">
                    <span class="stat-icon">◈</span>

                    <span class="stat-trend">
                        <?= number_format($stats['products']); ?>
                    </span>
                </div>

                <p>Products</p>

                <h2>
                    <?= number_format($stats['products']); ?>
                </h2>

                <small>
                    Active products
                </small>

            </div>

        </section>


        <!-- =========================================
             SECONDARY STATS
        ========================================== -->

        <section class="secondary-stats">

            <div class="mini-stat">
                <span class="mini-icon">♻</span>

                <div>
                    <small>Pre-Loved Listings</small>
                    <strong>
                        <?= number_format($stats['resale_listings']); ?>
                    </strong>
                </div>
            </div>


            <div class="mini-stat">
                <span class="mini-icon">♥</span>

                <div>
                    <small>Donations</small>
                    <strong>
                        <?= number_format($stats['donations']); ?>
                    </strong>
                </div>
            </div>


            <div class="mini-stat">
                <span class="mini-icon">🪙</span>

                <div>
                    <small>Coins Issued</small>
                    <strong>
                        <?= number_format($stats['coins_issued']); ?>
                    </strong>
                </div>
            </div>


            <div class="mini-stat">
                <span class="mini-icon">✦</span>

                <div>
                    <small>Coins Redeemed</small>
                    <strong>
                        <?= number_format($stats['coins_redeemed']); ?>
                    </strong>
                </div>
            </div>

        </section>


        <!-- =========================================
             CONTENT GRID
        ========================================== -->

        <section class="dashboard-content-grid">


            <!-- RECENT ORDERS -->

            <div class="dashboard-panel orders-panel">

                <div class="panel-header">

                    <div>
                        <h3>
                            Recent Orders
                        </h3>

                        <p>
                            Latest customer purchases
                        </p>
                    </div>

                    <a href="orders.php">
                        View all →
                    </a>

                </div>


                <div class="table-wrapper">

                    <table class="admin-table">

                        <thead>

                        <tr>
                            <th>Order</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>

                        </thead>

                        <tbody>

                        <?php foreach ($recentOrders as $order): ?>

                            <tr>

                                <td>
                                    <strong>
                                        #<?= htmlspecialchars($order['id']); ?>
                                    </strong>
                                </td>

                                <td>
                                    <?= htmlspecialchars($order['customer']); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($order['product']); ?>
                                </td>

                                <td>
                                    ₹<?= number_format($order['amount']); ?>
                                </td>

                                <td>

                                    <span
                                        class="status-badge
                                        status-<?= strtolower($order['status']); ?>"
                                    >
                                        <?= htmlspecialchars($order['status']); ?>
                                    </span>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>


            <!-- QUICK ACTIONS -->

            <div class="dashboard-panel quick-panel">

                <div class="panel-header">

                    <div>
                        <h3>Quick Actions</h3>
                        <p>Manage SSISS quickly</p>
                    </div>

                </div>


                <div class="quick-actions">

                    <a href="add-product.php" class="quick-action">
                        <span>＋</span>
                        <div>
                            <strong>Add Product</strong>
                            <small>Add a new store item</small>
                        </div>
                    </a>


                    <a href="donations.php" class="quick-action">
                        <span>♥</span>
                        <div>
                            <strong>Review Donations</strong>
                            <small>Verify pending donations</small>
                        </div>
                    </a>


                    <a href="resale.php" class="quick-action">
                        <span>♻</span>
                        <div>
                            <strong>Review Listings</strong>
                            <small>Manage pre-loved items</small>
                        </div>
                    </a>


                    <a href="rewards.php" class="quick-action">
                        <span>🪙</span>
                        <div>
                            <strong>Manage Rewards</strong>
                            <small>Configure SSISS Coins</small>
                        </div>
                    </a>

                </div>

            </div>

        </section>


        <!-- =========================================
             LOWER DASHBOARD
        ========================================== -->

        <section class="dashboard-lower-grid">


            <!-- SALES OVERVIEW -->

            <div class="dashboard-panel">

                <div class="panel-header">

                    <div>
                        <h3>Sales Overview</h3>
                        <p>Revenue performance</p>
                    </div>

                    <select class="dashboard-select">
                        <option>Last 7 days</option>
                        <option>Last 30 days</option>
                        <option>Last 90 days</option>
                    </select>

                </div>


                <div class="chart-placeholder">

                    <div class="chart-label">
                        ₹
                    </div>

                    <div class="fake-chart">

                        <div style="height:35%"></div>
                        <div style="height:50%"></div>
                        <div style="height:42%"></div>
                        <div style="height:65%"></div>
                        <div style="height:55%"></div>
                        <div style="height:78%"></div>
                        <div style="height:90%"></div>

                    </div>

                    <div class="chart-days">
                        <span>Mon</span>
                        <span>Tue</span>
                        <span>Wed</span>
                        <span>Thu</span>
                        <span>Fri</span>
                        <span>Sat</span>
                        <span>Sun</span>
                    </div>

                </div>

            </div>


            <!-- IMPACT -->

            <div class="dashboard-panel impact-admin-panel">

                <div class="panel-header">

                    <div>
                        <h3>SSISS Impact</h3>
                        <p>Community & sustainability</p>
                    </div>

                    <a href="reports.php">
                        Details →
                    </a>

                </div>


                <div class="impact-number">

                    <strong>
                        <?= number_format($stats['donations']); ?>
                    </strong>

                    <span>
                        verified donations
                    </span>

                </div>


                <div class="impact-progress">

                    <div class="progress-info">
                        <span>Monthly goal</span>
                        <strong>76%</strong>
                    </div>

                    <div class="progress-bar">
                        <div style="width:76%"></div>
                    </div>

                </div>


                <div class="impact-message">
                    ♻️ Keep building a more circular fashion ecosystem.
                </div>

            </div>

        </section>


        <footer class="admin-footer">
            <span>SSISS Admin Panel</span>
            <span>Fashion • AI • Impact</span>
        </footer>

    </main>

</div>

</body>
</html>
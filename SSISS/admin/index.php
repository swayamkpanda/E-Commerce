<?php
// TODO: Implement this YFF module.

session_start();

/*
|--------------------------------------------------------------------------
| YFF ADMIN DASHBOARD
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

    <title>YFF Admin Dashboard</title>

    <!-- <link
        rel="stylesheet"
        href="../assets/css/dashboard.css"
    >

    <link
        rel="stylesheet"
        href="../assets/css/style.css" -->
        <style>

/* =========================================================
   YFF ADMIN DASHBOARD - INTERNAL CSS
   ========================================================= */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
}

body {
    font-family: Arial, Helvetica, sans-serif;
    background: #f4f3ee;
    color: #171717;
    min-height: 100vh;
}


/* =========================================================
   MAIN LAYOUT
   ========================================================= */

.admin-layout {
    min-height: 100vh;
    display: flex;
}


/* =========================================================
   SIDEBAR
   ========================================================= */

.sidebar {
    width: 250px;
    height: 100vh;

    position: fixed;
    left: 0;
    top: 0;

    background: #151515;
    color: white;

    padding: 28px 18px;

    z-index: 1000;

    overflow-y: auto;
}


/* =========================================================
   ADMIN LOGO
   ========================================================= */

.admin-logo {
    padding: 8px 14px 35px;
}

.admin-logo h1 {
    font-size: 30px;
    font-weight: 900;

    letter-spacing: 5px;
}

.admin-logo p {
    margin-top: 5px;

    color: #888;

    font-size: 8px;

    letter-spacing: 2px;
}

.admin-badge {
    display: inline-block;

    margin-top: 18px;

    padding: 6px 10px;

    border: 1px solid #444;

    color: #c7e899;

    font-size: 8px;

    font-weight: bold;

    letter-spacing: 2px;
}


/* =========================================================
   NAVIGATION
   ========================================================= */

.admin-nav {
    display: flex;

    flex-direction: column;

    gap: 6px;
}

.admin-nav a,
.admin-nav button {

    width: 100%;

    display: flex;

    align-items: center;

    gap: 12px;

    padding: 14px 15px;

    border: none;

    background: transparent;

    color: #999;

    text-decoration: none;

    text-align: left;

    cursor: pointer;

    border-radius: 5px;

    font-size: 11px;

    letter-spacing: 1px;

    transition: all .25s ease;
}

.admin-nav a:hover,
.admin-nav button:hover {

    background: #252525;

    color: white;
}

.admin-nav a.active,
.admin-nav button.active {

    background: #d9edbd;

    color: #151515;

    font-weight: 700;
}

.nav-icon {

    width: 22px;

    display: inline-flex;

    justify-content: center;

    font-size: 15px;
}


/* =========================================================
   SIDEBAR BOTTOM
   ========================================================= */

.sidebar-bottom {

    position: absolute;

    left: 18px;
    right: 18px;
    bottom: 25px;
}

.back-store {

    display: block;

    padding: 12px;

    border: 1px solid #3c3c3c;

    color: #aaa;

    text-decoration: none;

    text-align: center;

    font-size: 9px;

    letter-spacing: 1.5px;

    transition: .25s;
}

.back-store:hover {

    color: white;

    border-color: white;
}


/* =========================================================
   MAIN CONTENT
   ========================================================= */

.admin-main {

    width: calc(100% - 250px);

    margin-left: 250px;

    min-height: 100vh;

    padding: 30px 40px 60px;
}


/* =========================================================
   TOP BAR
   ========================================================= */

.admin-topbar {

    display: flex;

    align-items: center;

    justify-content: space-between;

    margin-bottom: 35px;
}

.page-heading small {

    display: block;

    margin-bottom: 8px;

    color: #888;

    font-size: 9px;

    letter-spacing: 3px;
}

.page-heading h1 {

    font-size: 36px;

    letter-spacing: -1.5px;
}


/* =========================================================
   ADMIN PROFILE
   ========================================================= */

.admin-profile {

    display: flex;

    align-items: center;

    gap: 12px;
}

.profile-avatar {

    width: 42px;
    height: 42px;

    border-radius: 50%;

    background: #d9edbd;

    display: flex;

    align-items: center;

    justify-content: center;

    color: #171717;

    font-size: 13px;

    font-weight: bold;
}

.profile-info strong {

    display: block;

    font-size: 12px;
}

.profile-info span {

    display: block;

    margin-top: 3px;

    color: #888;

    font-size: 9px;
}


/* =========================================================
   MOBILE MENU
   ========================================================= */

.mobile-menu {

    display: none;

    border: none;

    background: #171717;

    color: white;

    padding: 10px 13px;

    cursor: pointer;

    font-size: 16px;
}


/* =========================================================
   STATISTICS
   ========================================================= */

.stats {

    display: grid;

    grid-template-columns:
        repeat(4, 1fr);

    gap: 18px;

    margin-bottom: 28px;
}

.stat-card {

    position: relative;

    overflow: hidden;

    padding: 24px;

    background: white;

    border: 1px solid #dfddd6;

    transition: .25s;
}

.stat-card:hover {

    transform: translateY(-4px);

    box-shadow:
        0 15px 30px
        rgba(0,0,0,.07);
}

.stat-card::after {

    content: "";

    position: absolute;

    right: -25px;
    bottom: -25px;

    width: 85px;
    height: 85px;

    border-radius: 50%;

    background: #e4f1d2;
}

.stat-label {

    color: #888;

    font-size: 9px;

    letter-spacing: 2px;
}

.stat-value {

    margin-top: 12px;

    font-size: 31px;

    font-weight: 700;
}

.stat-change {

    margin-top: 8px;

    color: #4d8038;

    font-size: 9px;

    font-weight: bold;
}


/* =========================================================
   CONTENT GRID
   ========================================================= */

.content-grid {

    display: grid;

    grid-template-columns:
        1.5fr 1fr;

    gap: 25px;

    margin-bottom: 25px;
}


/* =========================================================
   PANELS
   ========================================================= */

.panel {

    background: white;

    border: 1px solid #dfddd6;

    padding: 25px;
}

.panel-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    margin-bottom: 22px;
}

.panel-header h2 {

    font-size: 17px;
}

.panel-header span {

    color: #888;

    font-size: 9px;

    letter-spacing: 1px;
}


/* =========================================================
   SALES CHART
   ========================================================= */

.chart {

    height: 235px;

    display: flex;

    align-items: flex-end;

    justify-content: space-around;

    gap: 12px;

    padding:
        20px 5px 0;

    border-bottom: 1px solid #ddd;
}

.bar-group {

    height: 100%;

    flex: 1;

    display: flex;

    flex-direction: column;

    justify-content: flex-end;

    align-items: center;
}

.bar {

    position: relative;

    width: 42px;

    max-width: 100%;

    background: #273d2b;

    transition: .4s;
}

.bar:hover {

    background: #8fb65d;
}

.bar-value {

    position: absolute;

    top: -20px;

    left: 50%;

    transform:
        translateX(-50%);

    color: #777;

    font-size: 8px;

    white-space: nowrap;
}

.bar-label {

    margin-top: 9px;

    color: #888;

    font-size: 9px;
}


/* =========================================================
   QUICK ACTIONS
   ========================================================= */

.quick-actions {

    display: grid;

    grid-template-columns:
        1fr 1fr;

    gap: 12px;
}

.action {

    padding: 18px;

    border: 1px solid #ddd;

    background: #fafaf7;

    cursor: pointer;

    text-align: left;

    transition: .25s;
}

.action:hover {

    background: #171717;

    color: white;

    transform:
        translateY(-2px);
}

.action-icon {

    margin-bottom: 10px;

    font-size: 20px;
}

.action strong {

    display: block;

    margin-bottom: 5px;

    font-size: 11px;
}

.action span {

    color: #888;

    font-size: 9px;
}

.action:hover span {

    color: #aaa;
}


/* =========================================================
   TABLE
   ========================================================= */

.table-panel {

    background: white;

    border: 1px solid #dfddd6;

    padding: 25px;

    overflow-x: auto;
}

table {

    width: 100%;

    border-collapse: collapse;

    min-width: 650px;
}

th {

    padding: 14px 10px;

    border-bottom: 1px solid #ddd;

    color: #888;

    text-align: left;

    font-size: 9px;

    letter-spacing: 1.5px;
}

td {

    padding: 16px 10px;

    border-bottom: 1px solid #eee;

    font-size: 11px;
}

tr:hover td {

    background: #fafaf7;
}

.order-id {

    font-weight: bold;
}


/* =========================================================
   STATUS BADGES
   ========================================================= */

.status {

    display: inline-block;

    padding: 5px 8px;

    font-size: 8px;

    letter-spacing: 1px;

    font-weight: bold;
}

.processing {

    background: #fff1d9;

    color: #9a681f;
}

.shipped {

    background: #dcebd4;

    color: #466f35;
}

.delivered {

    background: #dceeea;

    color: #367466;
}

.cancelled {

    background: #f3dddd;

    color: #9a3f3f;
}


/* =========================================================
   PRODUCTS
   ========================================================= */

.product-section {

    margin-top: 25px;
}

.product-grid {

    display: grid;

    grid-template-columns:
        repeat(4, 1fr);

    gap: 16px;
}

.product-card {

    background: white;

    border: 1px solid #dfddd6;

    overflow: hidden;

    transition: .25s;
}

.product-card:hover {

    transform:
        translateY(-4px);

    box-shadow:
        0 10px 25px
        rgba(0,0,0,.06);
}

.product-photo {

    height: 175px;

    background: #e6e4dc;

    display: flex;

    align-items: center;

    justify-content: center;

    color: #888;

    font-size: 10px;

    letter-spacing: 2px;

    overflow: hidden;
}

.product-photo img {

    width: 100%;
    height: 100%;

    object-fit: cover;
}

.product-details {

    padding: 15px;
}

.product-details small {

    color: #888;

    font-size: 8px;

    letter-spacing: 1.5px;

    text-transform: uppercase;
}

.product-details h3 {

    margin-top: 6px;

    font-size: 13px;

    line-height: 1.3;
}

.product-bottom {

    display: flex;

    justify-content: space-between;

    align-items: center;

    margin-top: 12px;
}

.product-price {

    font-size: 12px;

    font-weight: bold;
}

.stock {

    color: #568341;

    font-size: 8px;
}


/* =========================================================
   MODAL
   ========================================================= */

.modal {

    position: fixed;

    inset: 0;

    z-index: 5000;

    display: none;

    align-items: center;

    justify-content: center;

    padding: 20px;

    background:
        rgba(0,0,0,.65);
}

.modal.active {

    display: flex;
}

.modal-box {

    width: 100%;

    max-width: 500px;

    padding: 30px;

    background: white;

    animation:
        modalIn .3s ease;
}

@keyframes modalIn {

    from {

        opacity: 0;

        transform:
            translateY(20px)
            scale(.97);
    }

    to {

        opacity: 1;

        transform:
            translateY(0)
            scale(1);
    }
}

.modal-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    margin-bottom: 25px;
}

.modal-header h2 {

    font-size: 22px;
}

.close {

    border: none;

    background: none;

    cursor: pointer;

    font-size: 23px;
}


/* =========================================================
   FORM
   ========================================================= */

.form-group {

    margin-bottom: 18px;
}

.form-group label {

    display: block;

    margin-bottom: 7px;

    color: #777;

    font-size: 9px;

    letter-spacing: 1.5px;
}

.form-group input {

    width: 100%;

    padding: 13px;

    border: 1px solid #ccc;

    outline: none;

    font-size: 12px;
}

.form-group input:focus {

    border-color: #171717;
}

.save-product {

    width: 100%;

    padding: 15px;

    border: none;

    background: #171717;

    color: white;

    cursor: pointer;

    font-size: 10px;

    font-weight: bold;

    letter-spacing: 1.5px;
}

.save-product:hover {

    background: #333;
}


/* =========================================================
   TOAST
   ========================================================= */

.toast {

    position: fixed;

    right: 25px;
    bottom: 25px;

    z-index: 10000;

    padding: 15px 22px;

    background: #171717;

    color: white;

    font-size: 11px;

    transform:
        translateY(50px);

    opacity: 0;

    transition: .3s;
}

.toast.show {

    transform:
        translateY(0);

    opacity: 1;
}


/* =========================================================
   MOBILE
   ========================================================= */

@media(max-width: 1100px) {

    .stats {

        grid-template-columns:
            repeat(2, 1fr);
    }

    .product-grid {

        grid-template-columns:
            repeat(2, 1fr);
    }

}


@media(max-width: 850px) {

    .sidebar {

        transform:
            translateX(-100%);
    }

    .sidebar.open {

        transform:
            translateX(0);
    }

    .admin-main {

        width: 100%;

        margin-left: 0;

        padding: 25px;
    }

    .mobile-menu {

        display: block;
    }

    .content-grid {

        grid-template-columns: 1fr;
    }

}


@media(max-width: 600px) {

    .admin-main {

        padding: 20px 15px;
    }

    .stats {

        grid-template-columns: 1fr;
    }

    .product-grid {

        grid-template-columns: 1fr;
    }

    .quick-actions {

        grid-template-columns: 1fr;
    }

    .profile-info {

        display: none;
    }

    .panel,
    .table-panel {

        padding: 18px;
    }

    .page-heading h1 {

        font-size: 28px;
    }

}

</style>
    
</head>

<body>

<div class="admin-layout">

    <!-- =========================================
         SIDEBAR
    ========================================== -->

    <aside class="admin-sidebar">

        <div class="admin-logo">
            S<span>YFF</span>
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
                YFF AI & REWARDS
            </div>

            <a
                href="coins.php"
                class="admin-nav-item"
            >
                <span>🪙</span>
                YFF Coins
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
                    YFF / Dashboard
                </p>

                <h1>
                    Good morning, <?= htmlspecialchars($adminName); ?>.
                </h1>

                <p class="admin-subtitle">
                    Here's what's happening across YFF today.
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
                        <p>Manage YFF quickly</p>
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
                            <small>Configure YFF Coins</small>
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
                        <h3>YFF Impact</h3>
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
            <span>YFF Admin Panel</span>
            <span>Fashion • AI • Impact</span>
        </footer>

    </main>

</div>

</body>
</html>
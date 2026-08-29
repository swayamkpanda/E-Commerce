<?php

session_start();

/*
|--------------------------------------------------------------------------
| SSISS ADMIN - ORDER MANAGEMENT
|--------------------------------------------------------------------------
| Demo version.
| MySQL order integration will be connected later.
|--------------------------------------------------------------------------
*/

$adminName = $_SESSION['admin_name'] ?? 'Admin';


// ==========================================================
// DEMO ORDERS
// ==========================================================

$orders = [

    [
        'id' => 'SSISS-10001',
        'customer' => 'Aarav Sharma',
        'email' => 'aarav@example.com',
        'items' => 3,
        'products' => 'Oversized Essential Tee, Classic Runner Sneakers',
        'amount' => 3848,
        'payment_method' => 'UPI',
        'payment_status' => 'Paid',
        'order_status' => 'Processing',
        'shipping_status' => 'Preparing',
        'date' => '29 Aug 2026, 10:42 AM'
    ],

    [
        'id' => 'SSISS-10002',
        'customer' => 'Ananya Das',
        'email' => 'ananya@example.com',
        'items' => 2,
        'products' => 'Relaxed Cargo Pants, Minimal Steel Watch',
        'amount' => 3498,
        'payment_method' => 'Card',
        'payment_status' => 'Paid',
        'order_status' => 'Shipped',
        'shipping_status' => 'In Transit',
        'date' => '29 Aug 2026, 09:18 AM'
    ],

    [
        'id' => 'SSISS-10003',
        'customer' => 'Rohan Patel',
        'email' => 'rohan@example.com',
        'items' => 1,
        'products' => 'Vintage Denim Jacket',
        'amount' => 1199,
        'payment_method' => 'COD',
        'payment_status' => 'Pending',
        'order_status' => 'Confirmed',
        'shipping_status' => 'Not Shipped',
        'date' => '28 Aug 2026, 08:51 PM'
    ],

    [
        'id' => 'SSISS-10004',
        'customer' => 'Diya Mehta',
        'email' => 'diya@example.com',
        'items' => 4,
        'products' => 'Oversized Tee, Sneakers, Sunglasses',
        'amount' => 5299,
        'payment_method' => 'UPI',
        'payment_status' => 'Paid',
        'order_status' => 'Delivered',
        'shipping_status' => 'Delivered',
        'date' => '28 Aug 2026, 04:35 PM'
    ],

    [
        'id' => 'SSISS-10005',
        'customer' => 'Kabir Singh',
        'email' => 'kabir@example.com',
        'items' => 2,
        'products' => 'Signature Oversized Hoodie',
        'amount' => 1799,
        'payment_method' => 'Card',
        'payment_status' => 'Paid',
        'order_status' => 'Cancelled',
        'shipping_status' => 'Cancelled',
        'date' => '27 Aug 2026, 11:24 AM'
    ],

    [
        'id' => 'SSISS-10006',
        'customer' => 'Meera Nair',
        'email' => 'meera@example.com',
        'items' => 1,
        'products' => 'Retro Square Frames',
        'amount' => 899,
        'payment_method' => 'UPI',
        'payment_status' => 'Paid',
        'order_status' => 'Processing',
        'shipping_status' => 'Preparing',
        'date' => '27 Aug 2026, 09:12 AM'
    ],

    [
        'id' => 'SSISS-10007',
        'customer' => 'Vihaan Roy',
        'email' => 'vihaan@example.com',
        'items' => 3,
        'products' => 'Streetwear Cargo, Oversized Tee',
        'amount' => 2898,
        'payment_method' => 'COD',
        'payment_status' => 'Pending',
        'order_status' => 'Confirmed',
        'shipping_status' => 'Not Shipped',
        'date' => '26 Aug 2026, 07:42 PM'
    ],

    [
        'id' => 'SSISS-10008',
        'customer' => 'Ishita Sen',
        'email' => 'ishita@example.com',
        'items' => 2,
        'products' => 'Minimal Watch, Classic Sneakers',
        'amount' => 4298,
        'payment_method' => 'Card',
        'payment_status' => 'Paid',
        'order_status' => 'Shipped',
        'shipping_status' => 'Out for Delivery',
        'date' => '26 Aug 2026, 02:18 PM'
    ]

];


// ==========================================================
// FILTERS
// ==========================================================

$search = trim($_GET['search'] ?? '');

$orderStatusFilter = trim(
    $_GET['order_status'] ?? ''
);

$paymentStatusFilter = trim(
    $_GET['payment_status'] ?? ''
);


// ==========================================================
// FILTER ORDERS
// ==========================================================

$filteredOrders = array_filter(

    $orders,

    function ($order) use (
        $search,
        $orderStatusFilter,
        $paymentStatusFilter
    ) {

        if ($search !== '') {

            $searchText = strtolower(

                $order['id'] . ' ' .
                $order['customer'] . ' ' .
                $order['email'] . ' ' .
                $order['products']

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
            $orderStatusFilter !== '' &&
            $order['order_status'] !==
            $orderStatusFilter
        ) {

            return false;

        }


        if (
            $paymentStatusFilter !== '' &&
            $order['payment_status'] !==
            $paymentStatusFilter
        ) {

            return false;

        }


        return true;

    }

);


// ==========================================================
// ORDER STATISTICS
// ==========================================================

$totalOrders = count($orders);


$processingOrders = count(

    array_filter(

        $orders,

        function ($order) {

            return $order['order_status'] ===
                'Processing';

        }

    )

);


$shippedOrders = count(

    array_filter(

        $orders,

        function ($order) {

            return $order['order_status'] ===
                'Shipped';

        }

    )

);


$deliveredOrders = count(

    array_filter(

        $orders,

        function ($order) {

            return $order['order_status'] ===
                'Delivered';

        }

    )

);


$cancelledOrders = count(

    array_filter(

        $orders,

        function ($order) {

            return $order['order_status'] ===
                'Cancelled';

        }

    )

);


$totalRevenue = 0;

foreach ($orders as $order) {

    if (
        $order['payment_status'] ===
        'Paid'
    ) {

        $totalRevenue +=
            $order['amount'];

    }

}

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
        Orders | SSISS Admin
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
                class="admin-nav-item active"
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
                    SSISS / Orders
                </p>


                <h1>
                    Orders
                </h1>


                <p class="admin-subtitle">
                    Manage customer orders, payments and delivery.
                </p>


            </div>


        </header>


        <!-- ==================================================
             PAGE ACTIONS
        =================================================== -->

        <section class="page-actions">


            <div>

                <h2>
                    Order Management
                </h2>


                <p>
                    Track and manage every SSISS customer order.
                </p>


            </div>


            <button
                type="button"
                class="btn btn-primary"
                onclick="alert('Order export will be connected later.')"
            >
                ↓ Export Orders
            </button>


        </section>


        <!-- ==================================================
             STATISTICS
        =================================================== -->

        <section class="stats-grid">


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        □
                    </span>

                </div>


                <p>
                    Total Orders
                </p>


                <h2>
                    <?= number_format(
                        $totalOrders
                    ); ?>
                </h2>


                <small>
                    All orders
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ◷
                    </span>

                </div>


                <p>
                    Processing
                </p>


                <h2>
                    <?= number_format(
                        $processingOrders
                    ); ?>
                </h2>


                <small>
                    Need fulfillment
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        →
                    </span>

                </div>


                <p>
                    Shipped
                </p>


                <h2>
                    <?= number_format(
                        $shippedOrders
                    ); ?>
                </h2>


                <small>
                    On the way
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ✓
                    </span>

                </div>


                <p>
                    Delivered
                </p>


                <h2>
                    <?= number_format(
                        $deliveredOrders
                    ); ?>
                </h2>


                <small>
                    Successfully delivered
                </small>


            </div>


        </section>


        <!-- ==================================================
             REVENUE SUMMARY
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        Revenue Summary
                    </h3>


                    <p>
                        Revenue from paid orders.
                    </p>


                </div>


            </div>


            <div class="stats-grid">


                <div class="stat-card">


                    <p>
                        Paid Revenue
                    </p>


                    <h2>
                        ₹<?= number_format(
                            $totalRevenue
                        ); ?>
                    </h2>


                    <small>
                        Confirmed payments
                    </small>


                </div>


                <div class="stat-card">


                    <p>
                        Cancelled
                    </p>


                    <h2>
                        <?= number_format(
                            $cancelledOrders
                        ); ?>
                    </h2>


                    <small>
                        Cancelled orders
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
                action="orders.php"
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
                        placeholder="Order ID, customer or product..."
                    >


                </div>


                <!-- ORDER STATUS -->

                <div class="form-group">


                    <label for="order_status">
                        Order Status
                    </label>


                    <select
                        id="order_status"
                        name="order_status"
                    >


                        <option value="">
                            All Status
                        </option>


                        <option
                            value="Confirmed"
                            <?= $orderStatusFilter ===
                                'Confirmed'
                                ? 'selected'
                                : ''; ?>
                        >
                            Confirmed
                        </option>


                        <option
                            value="Processing"
                            <?= $orderStatusFilter ===
                                'Processing'
                                ? 'selected'
                                : ''; ?>
                        >
                            Processing
                        </option>


                        <option
                            value="Shipped"
                            <?= $orderStatusFilter ===
                                'Shipped'
                                ? 'selected'
                                : ''; ?>
                        >
                            Shipped
                        </option>


                        <option
                            value="Delivered"
                            <?= $orderStatusFilter ===
                                'Delivered'
                                ? 'selected'
                                : ''; ?>
                        >
                            Delivered
                        </option>


                        <option
                            value="Cancelled"
                            <?= $orderStatusFilter ===
                                'Cancelled'
                                ? 'selected'
                                : ''; ?>
                        >
                            Cancelled
                        </option>


                    </select>


                </div>


                <!-- PAYMENT STATUS -->

                <div class="form-group">


                    <label for="payment_status">
                        Payment
                    </label>


                    <select
                        id="payment_status"
                        name="payment_status"
                    >


                        <option value="">
                            All Payments
                        </option>


                        <option
                            value="Paid"
                            <?= $paymentStatusFilter ===
                                'Paid'
                                ? 'selected'
                                : ''; ?>
                        >
                            Paid
                        </option>


                        <option
                            value="Pending"
                            <?= $paymentStatusFilter ===
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
                        href="orders.php"
                        class="btn btn-secondary"
                    >
                        Reset
                    </a>


                </div>


            </form>


        </section>


        <!-- ==================================================
             ORDERS TABLE
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        All Orders
                    </h3>


                    <p>

                        <?= count(
                            $filteredOrders
                        ); ?>

                        order(s) found

                    </p>


                </div>


            </div>


            <div class="table-wrapper">


                <?php if (
                    !empty(
                        $filteredOrders
                    )
                ): ?>


                    <table class="admin-table">


                        <thead>

                            <tr>

                                <th>
                                    Order
                                </th>

                                <th>
                                    Customer
                                </th>

                                <th>
                                    Items
                                </th>

                                <th>
                                    Amount
                                </th>

                                <th>
                                    Payment
                                </th>

                                <th>
                                    Order Status
                                </th>

                                <th>
                                    Shipping
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
                            $filteredOrders
                            as $order
                        ): ?>


                            <tr>


                                <!-- ORDER -->

                                <td>


                                    <strong>

                                        <?= htmlspecialchars(
                                            $order['id']
                                        ); ?>

                                    </strong>


                                </td>


                                <!-- CUSTOMER -->

                                <td>


                                    <strong>

                                        <?= htmlspecialchars(
                                            $order['customer']
                                        ); ?>

                                    </strong>


                                    <small class="table-subtext">

                                        <?= htmlspecialchars(
                                            $order['email']
                                        ); ?>

                                    </small>


                                </td>


                                <!-- ITEMS -->

                                <td>


                                    <?= number_format(
                                        $order['items']
                                    ); ?>


                                    <small class="table-subtext">

                                        <?= htmlspecialchars(
                                            $order['products']
                                        ); ?>

                                    </small>


                                </td>


                                <!-- AMOUNT -->

                                <td>


                                    <strong>

                                        ₹<?= number_format(
                                            $order['amount']
                                        ); ?>

                                    </strong>


                                </td>


                                <!-- PAYMENT -->

                                <td>


                                    <strong>

                                        <?= htmlspecialchars(
                                            $order['payment_method']
                                        ); ?>

                                    </strong>


                                    <small class="table-subtext">

                                        <?= htmlspecialchars(
                                            $order['payment_status']
                                        ); ?>

                                    </small>


                                </td>


                                <!-- ORDER STATUS -->

                                <td>


                                    <?php

                                    $orderStatusClass =
                                        'status-active';


                                    if (
                                        $order['order_status'] ===
                                        'Processing'
                                    ) {

                                        $orderStatusClass =
                                            'status-warning';

                                    } elseif (
                                        $order['order_status'] ===
                                        'Cancelled'
                                    ) {

                                        $orderStatusClass =
                                            'status-danger';

                                    }

                                    ?>


                                    <span
                                        class="status-badge <?= $orderStatusClass; ?>"
                                    >

                                        <?= htmlspecialchars(
                                            $order['order_status']
                                        ); ?>

                                    </span>


                                </td>


                                <!-- SHIPPING -->

                                <td>


                                    <?= htmlspecialchars(
                                        $order['shipping_status']
                                    ); ?>


                                </td>


                                <!-- DATE -->

                                <td>


                                    <?= htmlspecialchars(
                                        $order['date']
                                    ); ?>


                                </td>


                                <!-- ACTIONS -->

                                <td>


                                    <div class="table-actions">


                                        <a
                                            href="view-order.php?id=<?= urlencode(
                                                $order['id']
                                            ); ?>"
                                            class="table-action"
                                        >
                                            View
                                        </a>


                                        <button
                                            type="button"
                                            class="table-action"
                                            onclick="alert('Order status update will be connected to MySQL later.')"
                                        >
                                            Update
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
                            □
                        </div>


                        <h3>
                            No orders found
                        </h3>


                        <p>
                            Try changing your search or filters.
                        </p>


                        <a
                            href="orders.php"
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
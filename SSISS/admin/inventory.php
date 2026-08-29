<?php

session_start();

/*
|--------------------------------------------------------------------------
| SSISS ADMIN - INVENTORY MANAGEMENT
|--------------------------------------------------------------------------
| Demo version.
| MySQL inventory integration will be connected later.
|--------------------------------------------------------------------------
*/

$adminName = $_SESSION['admin_name'] ?? 'Admin';


// ==========================================================
// DEMO INVENTORY DATA
// ==========================================================

$inventory = [

    [
        'id' => 1001,
        'sku' => 'SST-TEE-001',
        'name' => 'Oversized Essential Tee',
        'category' => 'Clothing',
        'location' => 'Warehouse A',
        'stock' => 42,
        'reserved' => 6,
        'available' => 36,
        'reorder_level' => 10,
        'status' => 'In Stock',
        'updated' => '29 Aug 2026'
    ],

    [
        'id' => 1002,
        'sku' => 'UCR-CARGO-002',
        'name' => 'Relaxed Cargo Pants',
        'category' => 'Clothing',
        'location' => 'Warehouse A',
        'stock' => 18,
        'reserved' => 3,
        'available' => 15,
        'reorder_level' => 10,
        'status' => 'In Stock',
        'updated' => '29 Aug 2026'
    ],

    [
        'id' => 1003,
        'sku' => 'STR-SNK-003',
        'name' => 'Classic Runner Sneakers',
        'category' => 'Shoes',
        'location' => 'Warehouse B',
        'stock' => 7,
        'reserved' => 2,
        'available' => 5,
        'reorder_level' => 8,
        'status' => 'Low Stock',
        'updated' => '28 Aug 2026'
    ],

    [
        'id' => 1004,
        'sku' => 'CHR-WAT-004',
        'name' => 'Minimal Steel Watch',
        'category' => 'Watches',
        'location' => 'Warehouse B',
        'stock' => 3,
        'reserved' => 1,
        'available' => 2,
        'reorder_level' => 5,
        'status' => 'Low Stock',
        'updated' => '28 Aug 2026'
    ],

    [
        'id' => 1005,
        'sku' => 'VIS-EYE-005',
        'name' => 'Retro Square Frames',
        'category' => 'Eyewear',
        'location' => 'Warehouse C',
        'stock' => 0,
        'reserved' => 0,
        'available' => 0,
        'reorder_level' => 5,
        'status' => 'Out of Stock',
        'updated' => '27 Aug 2026'
    ],

    [
        'id' => 1006,
        'sku' => 'PVL-JKT-006',
        'name' => 'Vintage Denim Jacket',
        'category' => 'Pre-Loved',
        'location' => 'Pre-Loved Hub',
        'stock' => 5,
        'reserved' => 1,
        'available' => 4,
        'reorder_level' => 3,
        'status' => 'In Stock',
        'updated' => '29 Aug 2026'
    ],

    [
        'id' => 1007,
        'sku' => 'SST-HOOD-007',
        'name' => 'Signature Oversized Hoodie',
        'category' => 'Clothing',
        'location' => 'Warehouse A',
        'stock' => 4,
        'reserved' => 1,
        'available' => 3,
        'reorder_level' => 8,
        'status' => 'Low Stock',
        'updated' => '29 Aug 2026'
    ],

    [
        'id' => 1008,
        'sku' => 'STR-SNK-008',
        'name' => 'Cloud Street Sneakers',
        'category' => 'Shoes',
        'location' => 'Warehouse B',
        'stock' => 0,
        'reserved' => 0,
        'available' => 0,
        'reorder_level' => 6,
        'status' => 'Out of Stock',
        'updated' => '26 Aug 2026'
    ]

];


// ==========================================================
// FILTERS
// ==========================================================

$search = trim($_GET['search'] ?? '');

$categoryFilter = trim($_GET['category'] ?? '');

$statusFilter = trim($_GET['status'] ?? '');

$locationFilter = trim($_GET['location'] ?? '');


// ==========================================================
// FILTER INVENTORY
// ==========================================================

$filteredInventory = array_filter(

    $inventory,

    function ($item) use (
        $search,
        $categoryFilter,
        $statusFilter,
        $locationFilter
    ) {

        // Search

        if ($search !== '') {

            $searchText = strtolower(

                $item['name'] . ' ' .
                $item['sku'] . ' ' .
                $item['category']

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


        // Category

        if (
            $categoryFilter !== '' &&
            $item['category'] !== $categoryFilter
        ) {

            return false;

        }


        // Status

        if (
            $statusFilter !== '' &&
            $item['status'] !== $statusFilter
        ) {

            return false;

        }


        // Location

        if (
            $locationFilter !== '' &&
            $item['location'] !== $locationFilter
        ) {

            return false;

        }


        return true;

    }

);


// ==========================================================
// INVENTORY STATISTICS
// ==========================================================

$totalProducts = count($inventory);


$totalUnits = array_sum(
    array_column(
        $inventory,
        'stock'
    )
);


$totalReserved = array_sum(
    array_column(
        $inventory,
        'reserved'
    )
);


$totalAvailable = array_sum(
    array_column(
        $inventory,
        'available'
    )
);


$lowStock = count(

    array_filter(

        $inventory,

        function ($item) {

            return $item['status'] === 'Low Stock';

        }

    )

);


$outOfStock = count(

    array_filter(

        $inventory,

        function ($item) {

            return $item['status'] === 'Out of Stock';

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
        Inventory | SSISS Admin
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
                class="admin-nav-item active"
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
                    SSISS / Inventory
                </p>


                <h1>
                    Inventory
                </h1>


                <p class="admin-subtitle">
                    Monitor stock, availability and inventory movement.
                </p>


            </div>


        </header>


        <!-- ==================================================
             PAGE ACTIONS
        =================================================== -->

        <section class="page-actions">


            <div>

                <h2>
                    Inventory Management
                </h2>


                <p>
                    Track products and maintain healthy stock levels.
                </p>

            </div>


            <button
                type="button"
                class="btn btn-primary"
                onclick="alert('Stock adjustment will be connected to MySQL later.')"
            >
                + Adjust Stock
            </button>


        </section>


        <!-- ==================================================
             INVENTORY STATISTICS
        =================================================== -->

        <section class="stats-grid">


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ◈
                    </span>

                </div>


                <p>
                    Products
                </p>


                <h2>
                    <?= number_format(
                        $totalProducts
                    ); ?>
                </h2>


                <small>
                    Products tracked
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ▤
                    </span>

                </div>


                <p>
                    Total Units
                </p>


                <h2>
                    <?= number_format(
                        $totalUnits
                    ); ?>
                </h2>


                <small>
                    Physical inventory
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ◷
                    </span>

                </div>


                <p>
                    Reserved
                </p>


                <h2>
                    <?= number_format(
                        $totalReserved
                    ); ?>
                </h2>


                <small>
                    Reserved for orders
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ✓
                    </span>

                </div>


                <p>
                    Available
                </p>


                <h2>
                    <?= number_format(
                        $totalAvailable
                    ); ?>
                </h2>


                <small>
                    Ready to sell
                </small>


            </div>


        </section>


        <!-- ==================================================
             ALERTS
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        Inventory Alerts
                    </h3>


                    <p>
                        Products requiring attention.
                    </p>

                </div>


            </div>


            <div class="stats-grid">


                <div class="stat-card">


                    <p>
                        Low Stock
                    </p>


                    <h2>
                        <?= number_format(
                            $lowStock
                        ); ?>
                    </h2>


                    <small>
                        Consider restocking
                    </small>


                </div>


                <div class="stat-card">


                    <p>
                        Out of Stock
                    </p>


                    <h2>
                        <?= number_format(
                            $outOfStock
                        ); ?>
                    </h2>


                    <small>
                        Immediate action required
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
                action="inventory.php"
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
                        placeholder="Search product or SKU..."
                    >


                </div>


                <!-- CATEGORY -->

                <div class="form-group">


                    <label for="category">
                        Category
                    </label>


                    <select
                        id="category"
                        name="category"
                    >


                        <option value="">
                            All Categories
                        </option>


                        <option
                            value="Clothing"
                            <?= $categoryFilter ===
                                'Clothing'
                                ? 'selected'
                                : ''; ?>
                        >
                            Clothing
                        </option>


                        <option
                            value="Shoes"
                            <?= $categoryFilter ===
                                'Shoes'
                                ? 'selected'
                                : ''; ?>
                        >
                            Shoes
                        </option>


                        <option
                            value="Watches"
                            <?= $categoryFilter ===
                                'Watches'
                                ? 'selected'
                                : ''; ?>
                        >
                            Watches
                        </option>


                        <option
                            value="Eyewear"
                            <?= $categoryFilter ===
                                'Eyewear'
                                ? 'selected'
                                : ''; ?>
                        >
                            Eyewear
                        </option>


                        <option
                            value="Pre-Loved"
                            <?= $categoryFilter ===
                                'Pre-Loved'
                                ? 'selected'
                                : ''; ?>
                        >
                            Pre-Loved
                        </option>


                    </select>


                </div>


                <!-- STATUS -->

                <div class="form-group">


                    <label for="status">
                        Stock Status
                    </label>


                    <select
                        id="status"
                        name="status"
                    >


                        <option value="">
                            All Status
                        </option>


                        <option
                            value="In Stock"
                            <?= $statusFilter ===
                                'In Stock'
                                ? 'selected'
                                : ''; ?>
                        >
                            In Stock
                        </option>


                        <option
                            value="Low Stock"
                            <?= $statusFilter ===
                                'Low Stock'
                                ? 'selected'
                                : ''; ?>
                        >
                            Low Stock
                        </option>


                        <option
                            value="Out of Stock"
                            <?= $statusFilter ===
                                'Out of Stock'
                                ? 'selected'
                                : ''; ?>
                        >
                            Out of Stock
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
                            value="Warehouse A"
                            <?= $locationFilter ===
                                'Warehouse A'
                                ? 'selected'
                                : ''; ?>
                        >
                            Warehouse A
                        </option>


                        <option
                            value="Warehouse B"
                            <?= $locationFilter ===
                                'Warehouse B'
                                ? 'selected'
                                : ''; ?>
                        >
                            Warehouse B
                        </option>


                        <option
                            value="Warehouse C"
                            <?= $locationFilter ===
                                'Warehouse C'
                                ? 'selected'
                                : ''; ?>
                        >
                            Warehouse C
                        </option>


                        <option
                            value="Pre-Loved Hub"
                            <?= $locationFilter ===
                                'Pre-Loved Hub'
                                ? 'selected'
                                : ''; ?>
                        >
                            Pre-Loved Hub
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
                        href="inventory.php"
                        class="btn btn-secondary"
                    >
                        Reset
                    </a>


                </div>


            </form>


        </section>


        <!-- ==================================================
             INVENTORY TABLE
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        Inventory
                    </h3>


                    <p>

                        <?= count(
                            $filteredInventory
                        ); ?>

                        inventory item(s)

                    </p>

                </div>


            </div>


            <div class="table-wrapper">


                <?php if (
                    !empty(
                        $filteredInventory
                    )
                ): ?>


                    <table class="admin-table">


                        <thead>

                            <tr>

                                <th>
                                    Product
                                </th>

                                <th>
                                    SKU
                                </th>

                                <th>
                                    Category
                                </th>

                                <th>
                                    Location
                                </th>

                                <th>
                                    Stock
                                </th>

                                <th>
                                    Reserved
                                </th>

                                <th>
                                    Available
                                </th>

                                <th>
                                    Reorder Level
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Updated
                                </th>

                                <th>
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                        <?php foreach (
                            $filteredInventory
                            as $item
                        ): ?>


                            <tr>


                                <!-- PRODUCT -->

                                <td>


                                    <strong>

                                        <?= htmlspecialchars(
                                            $item['name']
                                        ); ?>

                                    </strong>


                                    <small class="table-subtext">

                                        Product ID:
                                        <?= htmlspecialchars(
                                            $item['id']
                                        ); ?>

                                    </small>


                                </td>


                                <!-- SKU -->

                                <td>


                                    <code>

                                        <?= htmlspecialchars(
                                            $item['sku']
                                        ); ?>

                                    </code>


                                </td>


                                <!-- CATEGORY -->

                                <td>

                                    <?= htmlspecialchars(
                                        $item['category']
                                    ); ?>

                                </td>


                                <!-- LOCATION -->

                                <td>

                                    <?= htmlspecialchars(
                                        $item['location']
                                    ); ?>

                                </td>


                                <!-- STOCK -->

                                <td>


                                    <strong>

                                        <?= number_format(
                                            $item['stock']
                                        ); ?>

                                    </strong>


                                </td>


                                <!-- RESERVED -->

                                <td>

                                    <?= number_format(
                                        $item['reserved']
                                    ); ?>

                                </td>


                                <!-- AVAILABLE -->

                                <td>


                                    <strong>

                                        <?= number_format(
                                            $item['available']
                                        ); ?>

                                    </strong>


                                </td>


                                <!-- REORDER -->

                                <td>

                                    <?= number_format(
                                        $item['reorder_level']
                                    ); ?>

                                </td>


                                <!-- STATUS -->

                                <td>


                                    <?php

                                    if (
                                        $item['status'] ===
                                        'In Stock'
                                    ) {

                                        $statusClass =
                                            'status-active';

                                    } elseif (
                                        $item['status'] ===
                                        'Low Stock'
                                    ) {

                                        $statusClass =
                                            'status-warning';

                                    } else {

                                        $statusClass =
                                            'status-danger';

                                    }

                                    ?>


                                    <span
                                        class="status-badge
                                        <?= $statusClass; ?>"
                                    >

                                        <?= htmlspecialchars(
                                            $item['status']
                                        ); ?>

                                    </span>


                                </td>


                                <!-- UPDATED -->

                                <td>

                                    <?= htmlspecialchars(
                                        $item['updated']
                                    ); ?>

                                </td>


                                <!-- ACTIONS -->

                                <td>


                                    <div class="table-actions">


                                        <button
                                            type="button"
                                            class="table-action"
                                            onclick="alert('Stock adjustment will be connected to MySQL later.')"
                                        >
                                            Adjust
                                        </button>


                                        <a
                                            href="edit-product.php?id=<?= urlencode(
                                                $item['id']
                                            ); ?>"
                                            class="table-action"
                                        >
                                            Edit
                                        </a>


                                    </div>


                                </td>


                            </tr>


                        <?php endforeach; ?>


                        </tbody>


                    </table>


                <?php else: ?>


                    <div class="empty-state">


                        <div class="empty-state-icon">
                            ▤
                        </div>


                        <h3>
                            No inventory found
                        </h3>


                        <p>
                            Try changing your search or filters.
                        </p>


                        <a
                            href="inventory.php"
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
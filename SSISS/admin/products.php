<?php

session_start();

/*
|--------------------------------------------------------------------------
| SSISS ADMIN - PRODUCTS
|--------------------------------------------------------------------------
| Product management page.
|
| IMPORTANT:
| This version uses demo data.
| MySQL integration will be connected later.
|--------------------------------------------------------------------------
*/


// ==========================================================
// ADMIN DATA
// ==========================================================

$adminName = $_SESSION['admin_name'] ?? 'Admin';


// ==========================================================
// DEMO PRODUCTS
// ==========================================================
// Later this will come from MySQL.
// ==========================================================

$products = [

    [
        'id' => 1001,
        'name' => 'Oversized Essential Tee',
        'brand' => 'SSISS Studio',
        'category' => 'Clothing',
        'subcategory' => 'T-Shirts',
        'price' => 699,
        'stock' => 42,
        'condition' => 'New',
        'status' => 'Active',
        'style' => 'Streetwear',
        'image' => '../assets/images/products/tshirt.jpg'
    ],

    [
        'id' => 1002,
        'name' => 'Relaxed Cargo Pants',
        'brand' => 'Urban Core',
        'category' => 'Clothing',
        'subcategory' => 'Pants',
        'price' => 1299,
        'stock' => 18,
        'condition' => 'New',
        'status' => 'Active',
        'style' => 'Streetwear',
        'image' => '../assets/images/products/cargo.jpg'
    ],

    [
        'id' => 1003,
        'name' => 'Classic Runner Sneakers',
        'brand' => 'Stride',
        'category' => 'Shoes',
        'subcategory' => 'Sneakers',
        'price' => 2499,
        'stock' => 7,
        'condition' => 'New',
        'status' => 'Active',
        'style' => 'Sporty',
        'image' => '../assets/images/products/sneakers.jpg'
    ],

    [
        'id' => 1004,
        'name' => 'Minimal Steel Watch',
        'brand' => 'Chrono',
        'category' => 'Watches',
        'subcategory' => 'Analog',
        'price' => 1899,
        'stock' => 3,
        'condition' => 'New',
        'status' => 'Low Stock',
        'style' => 'Minimal',
        'image' => '../assets/images/products/watch.jpg'
    ],

    [
        'id' => 1005,
        'name' => 'Retro Square Frames',
        'brand' => 'Vision',
        'category' => 'Eyewear',
        'subcategory' => 'Glasses',
        'price' => 899,
        'stock' => 0,
        'condition' => 'New',
        'status' => 'Out of Stock',
        'style' => 'Vintage',
        'image' => '../assets/images/products/glasses.jpg'
    ],

    [
        'id' => 1006,
        'name' => 'Vintage Denim Jacket',
        'brand' => 'Pre-Loved',
        'category' => 'Clothing',
        'subcategory' => 'Jackets',
        'price' => 999,
        'stock' => 5,
        'condition' => 'Pre-Loved',
        'status' => 'Active',
        'style' => 'Vintage',
        'image' => '../assets/images/products/jacket.jpg'
    ]

];


// ==========================================================
// FILTER INPUTS
// ==========================================================

$search = trim($_GET['search'] ?? '');

$category = trim($_GET['category'] ?? '');

$status = trim($_GET['status'] ?? '');

$condition = trim($_GET['condition'] ?? '');


// ==========================================================
// FILTER PRODUCTS
// ==========================================================

$filteredProducts = array_filter(

    $products,

    function ($product) use (
        $search,
        $category,
        $status,
        $condition
    ) {

        // Search
        if ($search !== '') {

            $searchText = strtolower(

                $product['name'] . ' ' .
                $product['brand'] . ' ' .
                $product['category'] . ' ' .
                $product['subcategory'] . ' ' .
                $product['style']

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
            $category !== '' &&
            $product['category'] !== $category
        ) {

            return false;

        }


        // Status
        if (
            $status !== '' &&
            $product['status'] !== $status
        ) {

            return false;

        }


        // Condition
        if (
            $condition !== '' &&
            $product['condition'] !== $condition
        ) {

            return false;

        }


        return true;

    }

);


// ==========================================================
// PRODUCT STATISTICS
// ==========================================================

$totalProducts = count($products);


$activeProducts = count(

    array_filter(

        $products,

        function ($product) {

            return $product['status'] === 'Active';

        }

    )

);


$lowStockProducts = count(

    array_filter(

        $products,

        function ($product) {

            return $product['status'] === 'Low Stock';

        }

    )

);


$outOfStockProducts = count(

    array_filter(

        $products,

        function ($product) {

            return $product['status'] === 'Out of Stock';

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
        Products | SSISS Admin
    </title>


    <!-- SSISS GLOBAL CSS -->

    <link
        rel="stylesheet"
        href="../assets/css/style.css"
    >


    <!-- ADMIN CSS -->

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
                class="admin-nav-item active"
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
                        <?= htmlspecialchars($adminName); ?>
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


        <!-- PAGE HEADER -->

        <header class="admin-topbar">


            <div>

                <p class="admin-breadcrumb">
                    SSISS / Products
                </p>


                <h1>
                    Products
                </h1>


                <p class="admin-subtitle">
                    Manage your SSISS fashion catalog.
                </p>

            </div>


            <div class="admin-top-actions">


                <button
                    type="button"
                    class="icon-button"
                    title="Notifications"
                >
                    ♧
                </button>


                <div class="admin-user">


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
                            <?= htmlspecialchars($adminName); ?>
                        </strong>

                        <small>
                            Admin
                        </small>

                    </div>


                </div>


            </div>


        </header>


        <!-- ======================================================
             PRODUCT HEADER ACTION
        ======================================================= -->

        <section class="page-actions">


            <div>

                <h2>
                    Product Catalog
                </h2>

                <p>
                    Add, edit and manage products available in the store.
                </p>

            </div>


            <a
                href="add-product.php"
                class="btn btn-primary"
            >
                + Add Product
            </a>


        </section>


        <!-- ======================================================
             PRODUCT STATISTICS
        ======================================================= -->

        <section class="stats-grid">


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ◈
                    </span>

                </div>


                <p>
                    Total Products
                </p>


                <h2>
                    <?= number_format($totalProducts); ?>
                </h2>


                <small>
                    Products in catalog
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ✓
                    </span>

                </div>


                <p>
                    Active Products
                </p>


                <h2>
                    <?= number_format($activeProducts); ?>
                </h2>


                <small>
                    Currently available
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        !
                    </span>

                </div>


                <p>
                    Low Stock
                </p>


                <h2>
                    <?= number_format($lowStockProducts); ?>
                </h2>


                <small>
                    Needs restocking
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ×
                    </span>

                </div>


                <p>
                    Out of Stock
                </p>


                <h2>
                    <?= number_format($outOfStockProducts); ?>
                </h2>


                <small>
                    Currently unavailable
                </small>


            </div>


        </section>


        <!-- ======================================================
             FILTERS
        ======================================================= -->

        <section class="dashboard-panel">


            <form
                method="GET"
                action="products.php"
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
                        value="<?= htmlspecialchars($search); ?>"
                        placeholder="Search product, brand or style..."
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
                            <?= $category === 'Clothing' ? 'selected' : ''; ?>
                        >
                            Clothing
                        </option>

                        <option
                            value="Shoes"
                            <?= $category === 'Shoes' ? 'selected' : ''; ?>
                        >
                            Shoes
                        </option>

                        <option
                            value="Watches"
                            <?= $category === 'Watches' ? 'selected' : ''; ?>
                        >
                            Watches
                        </option>

                        <option
                            value="Eyewear"
                            <?= $category === 'Eyewear' ? 'selected' : ''; ?>
                        >
                            Eyewear
                        </option>

                    </select>


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
                            <?= $status === 'Active' ? 'selected' : ''; ?>
                        >
                            Active
                        </option>

                        <option
                            value="Low Stock"
                            <?= $status === 'Low Stock' ? 'selected' : ''; ?>
                        >
                            Low Stock
                        </option>

                        <option
                            value="Out of Stock"
                            <?= $status === 'Out of Stock' ? 'selected' : ''; ?>
                        >
                            Out of Stock
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
                            value="New"
                            <?= $condition === 'New' ? 'selected' : ''; ?>
                        >
                            New
                        </option>

                        <option
                            value="Pre-Loved"
                            <?= $condition === 'Pre-Loved' ? 'selected' : ''; ?>
                        >
                            Pre-Loved
                        </option>

                    </select>


                </div>


                <!-- BUTTON -->

                <div class="form-actions">


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Apply Filters
                    </button>


                    <a
                        href="products.php"
                        class="btn btn-secondary"
                    >
                        Reset
                    </a>


                </div>


            </form>


        </section>


        <!-- ======================================================
             PRODUCTS TABLE
        ======================================================= -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        Products
                    </h3>

                    <p>
                        <?= count($filteredProducts); ?>
                        product(s) found
                    </p>

                </div>


                <a
                    href="add-product.php"
                    class="btn btn-primary"
                >
                    + Add Product
                </a>


            </div>


            <div class="table-wrapper">


                <?php if (!empty($filteredProducts)): ?>


                    <table class="admin-table">


                        <thead>

                            <tr>

                                <th>
                                    Product
                                </th>

                                <th>
                                    Category
                                </th>

                                <th>
                                    Brand
                                </th>

                                <th>
                                    Price
                                </th>

                                <th>
                                    Stock
                                </th>

                                <th>
                                    Condition
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
                            $filteredProducts
                            as $product
                        ): ?>


                            <tr>


                                <!-- PRODUCT -->

                                <td>


                                    <div class="table-product">


                                        <div class="table-product-image">


                                            <?php

                                            $imagePath =
                                                $product['image'];

                                            $absoluteImagePath =
                                                __DIR__ .
                                                '/' .
                                                $imagePath;

                                            ?>


                                            <?php if (
                                                file_exists(
                                                    $absoluteImagePath
                                                )
                                            ): ?>


                                                <img
                                                    src="<?= htmlspecialchars($imagePath); ?>"
                                                    alt="<?= htmlspecialchars($product['name']); ?>"
                                                >


                                            <?php else: ?>


                                                <div class="image-placeholder">
                                                    ◈
                                                </div>


                                            <?php endif; ?>


                                        </div>


                                        <div>


                                            <strong>
                                                <?= htmlspecialchars(
                                                    $product['name']
                                                ); ?>
                                            </strong>


                                            <small>
                                                #<?= htmlspecialchars(
                                                    $product['id']
                                                ); ?>
                                            </small>


                                        </div>


                                    </div>


                                </td>


                                <!-- CATEGORY -->

                                <td>

                                    <?= htmlspecialchars(
                                        $product['category']
                                    ); ?>


                                    <small class="table-subtext">

                                        <?= htmlspecialchars(
                                            $product['subcategory']
                                        ); ?>

                                    </small>

                                </td>


                                <!-- BRAND -->

                                <td>

                                    <?= htmlspecialchars(
                                        $product['brand']
                                    ); ?>

                                </td>


                                <!-- PRICE -->

                                <td>

                                    <strong>

                                        ₹<?= number_format(
                                            $product['price']
                                        ); ?>

                                    </strong>

                                </td>


                                <!-- STOCK -->

                                <td>


                                    <?php if (
                                        $product['stock'] === 0
                                    ): ?>


                                        <span class="stock-danger">
                                            0
                                        </span>


                                    <?php elseif (
                                        $product['stock'] <= 5
                                    ): ?>


                                        <span class="stock-warning">
                                            <?= number_format(
                                                $product['stock']
                                            ); ?>
                                        </span>


                                    <?php else: ?>


                                        <span class="stock-good">
                                            <?= number_format(
                                                $product['stock']
                                            ); ?>
                                        </span>


                                    <?php endif; ?>


                                </td>


                                <!-- CONDITION -->

                                <td>

                                    <span class="condition-badge">

                                        <?= htmlspecialchars(
                                            $product['condition']
                                        ); ?>

                                    </span>

                                </td>


                                <!-- STATUS -->

                                <td>


                                    <?php

                                    $statusClass = 'status-active';

                                    if (
                                        $product['status'] ===
                                        'Low Stock'
                                    ) {

                                        $statusClass =
                                            'status-warning';

                                    }

                                    if (
                                        $product['status'] ===
                                        'Out of Stock'
                                    ) {

                                        $statusClass =
                                            'status-danger';

                                    }

                                    ?>


                                    <span
                                        class="status-badge
                                        <?= $statusClass; ?>"
                                    >

                                        <?= htmlspecialchars(
                                            $product['status']
                                        ); ?>

                                    </span>


                                </td>


                                <!-- ACTIONS -->

                                <td>


                                    <div class="table-actions">


                                        <a
                                            href="edit-product.php?id=<?= urlencode($product['id']); ?>"
                                            class="table-action"
                                            title="Edit Product"
                                        >
                                            Edit
                                        </a>


                                        <a
                                            href="../shop/product.php?id=<?= urlencode($product['id']); ?>"
                                            class="table-action"
                                            title="View Product"
                                        >
                                            View
                                        </a>


                                        <button
                                       type="button"
    class="table-action danger"
    onclick="alert('Delete functionality will be connected to MySQL later.')"
>
    Delete
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
                            ◈
                        </div>


                        <h3>
                            No products found
                        </h3>


                        <p>
                            Try changing your search or filters.
                        </p>


                        <a
                            href="products.php"
                            class="btn btn-secondary"
                        >
                            Clear Filters
                        </a>


                    </div>


                <?php endif; ?>


            </div>


        </section>


        <!-- ======================================================
             FOOTER
        ======================================================= -->

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
<script>
function confirmDelete(productId) {
    if (confirm("Are you sure you want to delete product #" + productId + "?")) {
        window.location.href = "delete-product.php?id=" + productId;
    }
}
</script>


</body>

</html>
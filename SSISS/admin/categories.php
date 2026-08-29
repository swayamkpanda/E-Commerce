<?php

session_start();

/*
|--------------------------------------------------------------------------
| SSISS ADMIN - CATEGORY MANAGEMENT
|--------------------------------------------------------------------------
| Demo version.
| Database connection will be added later.
|--------------------------------------------------------------------------
*/


// ==========================================================
// ADMIN
// ==========================================================

$adminName = $_SESSION['admin_name'] ?? 'Admin';


// ==========================================================
// DEMO CATEGORIES
// ==========================================================

$categories = [

    [
        'id' => 1,
        'name' => 'Clothing',
        'slug' => 'clothing',
        'description' => 'T-shirts, shirts, jackets, pants and other fashion clothing.',
        'product_count' => 486,
        'status' => 'Active',
        'featured' => true
    ],

    [
        'id' => 2,
        'name' => 'Shoes',
        'slug' => 'shoes',
        'description' => 'Sneakers, casual shoes, boots and footwear.',
        'product_count' => 214,
        'status' => 'Active',
        'featured' => true
    ],

    [
        'id' => 3,
        'name' => 'Watches',
        'slug' => 'watches',
        'description' => 'Classic, smart and fashion watches.',
        'product_count' => 126,
        'status' => 'Active',
        'featured' => false
    ],

    [
        'id' => 4,
        'name' => 'Eyewear',
        'slug' => 'eyewear',
        'description' => 'Sunglasses, glasses and fashion eyewear.',
        'product_count' => 98,
        'status' => 'Active',
        'featured' => false
    ],

    [
        'id' => 5,
        'name' => 'Accessories',
        'slug' => 'accessories',
        'description' => 'Bags, belts, wallets, caps and other accessories.',
        'product_count' => 176,
        'status' => 'Active',
        'featured' => true
    ],

    [
        'id' => 6,
        'name' => 'Pre-Loved',
        'slug' => 'pre-loved',
        'description' => 'User-listed second-hand and pre-loved fashion.',
        'product_count' => 168,
        'status' => 'Active',
        'featured' => true
    ],

    [
        'id' => 7,
        'name' => 'Limited Edition',
        'slug' => 'limited-edition',
        'description' => 'Exclusive and limited SSISS collections.',
        'product_count' => 32,
        'status' => 'Inactive',
        'featured' => false
    ]

];


// ==========================================================
// SEARCH
// ==========================================================

$search = trim($_GET['search'] ?? '');


// ==========================================================
// STATUS FILTER
// ==========================================================

$statusFilter = trim($_GET['status'] ?? '');


// ==========================================================
// FILTER CATEGORIES
// ==========================================================

$filteredCategories = array_filter(

    $categories,

    function ($category) use ($search, $statusFilter) {

        if ($search !== '') {

            $searchText = strtolower(

                $category['name'] . ' ' .
                $category['slug'] . ' ' .
                $category['description']

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
            $statusFilter !== '' &&
            $category['status'] !== $statusFilter
        ) {

            return false;

        }


        return true;

    }

);


// ==========================================================
// STATISTICS
// ==========================================================

$totalCategories = count($categories);


$activeCategories = count(

    array_filter(

        $categories,

        function ($category) {

            return $category['status'] === 'Active';

        }

    )

);


$featuredCategories = count(

    array_filter(

        $categories,

        function ($category) {

            return $category['featured'] === true;

        }

    )

);


$totalProducts = array_sum(

    array_column(
        $categories,
        'product_count'
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
        Categories | SSISS Admin
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
                class="admin-nav-item active"
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
         MAIN
    ======================================================= -->

    <main class="admin-main">


        <!-- ==================================================
             HEADER
        =================================================== -->

        <header class="admin-topbar">


            <div>

                <p class="admin-breadcrumb">
                    SSISS / Categories
                </p>


                <h1>
                    Categories
                </h1>


                <p class="admin-subtitle">
                    Organize products across the SSISS store.
                </p>

            </div>


        </header>


        <!-- ==================================================
             PAGE ACTIONS
        =================================================== -->

        <section class="page-actions">


            <div>

                <h2>
                    Category Management
                </h2>


                <p>
                    Create and manage product categories.
                </p>

            </div>


            <button
                type="button"
                class="btn btn-primary"
                onclick="alert('Add category form will be connected later.')"
            >
                + Add Category
            </button>


        </section>


        <!-- ==================================================
             STATISTICS
        =================================================== -->

        <section class="stats-grid">


            <div class="stat-card">

                <div class="stat-card-top">

                    <span class="stat-icon">
                        ▦
                    </span>

                </div>


                <p>
                    Total Categories
                </p>


                <h2>
                    <?= number_format(
                        $totalCategories
                    ); ?>
                </h2>


                <small>
                    Categories created
                </small>

            </div>


            <div class="stat-card">

                <div class="stat-card-top">

                    <span class="stat-icon">
                        ✓
                    </span>

                </div>


                <p>
                    Active
                </p>


                <h2>
                    <?= number_format(
                        $activeCategories
                    ); ?>
                </h2>


                <small>
                    Currently visible
                </small>

            </div>


            <div class="stat-card">

                <div class="stat-card-top">

                    <span class="stat-icon">
                        ✦
                    </span>

                </div>


                <p>
                    Featured
                </p>


                <h2>
                    <?= number_format(
                        $featuredCategories
                    ); ?>
                </h2>


                <small>
                    Featured categories
                </small>

            </div>


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
                    Across all categories
                </small>

            </div>


        </section>


        <!-- ==================================================
             FILTERS
        =================================================== -->

        <section class="dashboard-panel">


            <form
                method="GET"
                action="categories.php"
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
                        placeholder="Search categories..."
                    >


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
                        href="categories.php"
                        class="btn btn-secondary"
                    >
                        Reset
                    </a>


                </div>


            </form>


        </section>


        <!-- ==================================================
             CATEGORY TABLE
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        All Categories
                    </h3>


                    <p>

                        <?= count(
                            $filteredCategories
                        ); ?>

                        category(s)

                    </p>

                </div>


            </div>


            <div class="table-wrapper">


                <?php if (
                    !empty(
                        $filteredCategories
                    )
                ): ?>


                    <table class="admin-table">


                        <thead>

                            <tr>

                                <th>
                                    Category
                                </th>

                                <th>
                                    Slug
                                </th>

                                <th>
                                    Description
                                </th>

                                <th>
                                    Products
                                </th>

                                <th>
                                    Featured
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
                            $filteredCategories
                            as $category
                        ): ?>


                            <tr>


                                <!-- CATEGORY -->

                                <td>

                                    <strong>

                                        <?= htmlspecialchars(
                                            $category['name']
                                        ); ?>

                                    </strong>

                                </td>


                                <!-- SLUG -->

                                <td>

                                    <code>

                                        <?= htmlspecialchars(
                                            $category['slug']
                                        ); ?>

                                    </code>

                                </td>


                                <!-- DESCRIPTION -->

                                <td>

                                    <?= htmlspecialchars(
                                        $category['description']
                                    ); ?>

                                </td>


                                <!-- PRODUCTS -->

                                <td>

                                    <strong>

                                        <?= number_format(
                                            $category['product_count']
                                        ); ?>

                                    </strong>

                                </td>


                                <!-- FEATURED -->

                                <td>


                                    <?php if (
                                        $category['featured']
                                    ): ?>


                                        <span
                                            class="status-badge status-active"
                                        >
                                            Featured
                                        </span>


                                    <?php else: ?>


                                        <span
                                            class="condition-badge"
                                        >
                                            No
                                        </span>


                                    <?php endif; ?>


                                </td>


                                <!-- STATUS -->

                                <td>


                                    <?php if (
                                        $category['status'] ===
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


                                <!-- ACTIONS -->

                                <td>


                                    <div class="table-actions">


                                        <a
                                            href="edit-category.php?id=<?= urlencode(
                                                $category['id']
                                            ); ?>"
                                            class="table-action"
                                        >
                                            Edit
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
                            ▦
                        </div>


                        <h3>
                            No categories found
                        </h3>


                        <p>
                            Try changing your search or filters.
                        </p>


                        <a
                            href="categories.php"
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
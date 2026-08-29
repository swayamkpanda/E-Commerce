<?php

session_start();

/*
|--------------------------------------------------------------------------
| SSISS ADMIN - BRAND MANAGEMENT
|--------------------------------------------------------------------------
| Demo version.
| MySQL connection will be added later.
|--------------------------------------------------------------------------
*/

$adminName = $_SESSION['admin_name'] ?? 'Admin';


// ==========================================================
// DEMO BRANDS
// ==========================================================

$brands = [

    [
        'id' => 1,
        'name' => 'SSISS Studio',
        'slug' => 'ssiss-studio',
        'description' => 'SSISS original fashion collection.',
        'category' => 'Clothing',
        'products' => 148,
        'sales' => 42850,
        'status' => 'Active',
        'featured' => true
    ],

    [
        'id' => 2,
        'name' => 'Urban Core',
        'slug' => 'urban-core',
        'description' => 'Modern streetwear and everyday essentials.',
        'category' => 'Clothing',
        'products' => 96,
        'sales' => 31580,
        'status' => 'Active',
        'featured' => true
    ],

    [
        'id' => 3,
        'name' => 'Stride',
        'slug' => 'stride',
        'description' => 'Contemporary sneakers and footwear.',
        'category' => 'Shoes',
        'products' => 74,
        'sales' => 28640,
        'status' => 'Active',
        'featured' => true
    ],

    [
        'id' => 4,
        'name' => 'Chrono',
        'slug' => 'chrono',
        'description' => 'Minimal and classic watches.',
        'category' => 'Watches',
        'products' => 52,
        'sales' => 19420,
        'status' => 'Active',
        'featured' => false
    ],

    [
        'id' => 5,
        'name' => 'Vision',
        'slug' => 'vision',
        'description' => 'Modern eyewear and sunglasses.',
        'category' => 'Eyewear',
        'products' => 43,
        'sales' => 15780,
        'status' => 'Active',
        'featured' => false
    ],

    [
        'id' => 6,
        'name' => 'EcoThread',
        'slug' => 'ecothread',
        'description' => 'Sustainable fashion made with responsible materials.',
        'category' => 'Sustainable',
        'products' => 31,
        'sales' => 11250,
        'status' => 'Active',
        'featured' => true
    ],

    [
        'id' => 7,
        'name' => 'Vintage Vault',
        'slug' => 'vintage-vault',
        'description' => 'Curated vintage and pre-loved fashion.',
        'category' => 'Pre-Loved',
        'products' => 68,
        'sales' => 9420,
        'status' => 'Inactive',
        'featured' => false
    ]

];


// ==========================================================
// FILTERS
// ==========================================================

$search = trim($_GET['search'] ?? '');

$statusFilter = trim($_GET['status'] ?? '');


// ==========================================================
// FILTER BRANDS
// ==========================================================

$filteredBrands = array_filter(

    $brands,

    function ($brand) use ($search, $statusFilter) {

        if ($search !== '') {

            $searchText = strtolower(

                $brand['name'] . ' ' .
                $brand['slug'] . ' ' .
                $brand['description'] . ' ' .
                $brand['category']

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
            $brand['status'] !== $statusFilter
        ) {

            return false;

        }


        return true;

    }

);


// ==========================================================
// STATISTICS
// ==========================================================

$totalBrands = count($brands);

$activeBrands = count(

    array_filter(

        $brands,

        function ($brand) {

            return $brand['status'] === 'Active';

        }

    )

);

$featuredBrands = count(

    array_filter(

        $brands,

        function ($brand) {

            return $brand['featured'] === true;

        }

    )

);

$totalBrandProducts = array_sum(

    array_column(
        $brands,
        'products'
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
        Brands | SSISS Admin
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
                class="admin-nav-item active"
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


        <!-- ==================================================
             HEADER
        =================================================== -->

        <header class="admin-topbar">


            <div>

                <p class="admin-breadcrumb">
                    SSISS / Brands
                </p>


                <h1>
                    Brands
                </h1>


                <p class="admin-subtitle">
                    Manage fashion brands available on SSISS.
                </p>


            </div>


        </header>


        <!-- ==================================================
             PAGE ACTION
        =================================================== -->

        <section class="page-actions">


            <div>

                <h2>
                    Brand Management
                </h2>


                <p>
                    Manage brands, collections and their store presence.
                </p>


            </div>


            <button
                type="button"
                class="btn btn-primary"
                onclick="alert('Add brand form will be connected later.')"
            >
                + Add Brand
            </button>


        </section>


        <!-- ==================================================
             STATISTICS
        =================================================== -->

        <section class="stats-grid">


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ◇
                    </span>

                </div>


                <p>
                    Total Brands
                </p>


                <h2>
                    <?= number_format(
                        $totalBrands
                    ); ?>
                </h2>


                <small>
                    Brands registered
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ✓
                    </span>

                </div>


                <p>
                    Active Brands
                </p>


                <h2>
                    <?= number_format(
                        $activeBrands
                    ); ?>
                </h2>


                <small>
                    Currently active
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ✦
                    </span>

                </div>


                <p>
                    Featured Brands
                </p>


                <h2>
                    <?= number_format(
                        $featuredBrands
                    ); ?>
                </h2>


                <small>
                    Featured on store
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ◈
                    </span>

                </div>


                <p>
                    Brand Products
                </p>


                <h2>
                    <?= number_format(
                        $totalBrandProducts
                    ); ?>
                </h2>


                <small>
                    Products across brands
                </small>


            </div>


        </section>


        <!-- ==================================================
             FILTERS
        =================================================== -->

        <section class="dashboard-panel">


            <form
                method="GET"
                action="brands.php"
                class="filter-form"
            >


                <div class="form-group">


                    <label for="search">
                        Search Brands
                    </label>


                    <input
                        type="search"
                        id="search"
                        name="search"
                        value="<?= htmlspecialchars(
                            $search
                        ); ?>"
                        placeholder="Search brand name..."
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
                        href="brands.php"
                        class="btn btn-secondary"
                    >
                        Reset
                    </a>


                </div>


            </form>


        </section>


        <!-- ==================================================
             BRANDS TABLE
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        All Brands
                    </h3>


                    <p>

                        <?= count(
                            $filteredBrands
                        ); ?>

                        brand(s) found

                    </p>

                </div>


            </div>


            <div class="table-wrapper">


                <?php if (
                    !empty(
                        $filteredBrands
                    )
                ): ?>


                    <table class="admin-table">


                        <thead>

                            <tr>

                                <th>
                                    Brand
                                </th>

                                <th>
                                    Slug
                                </th>

                                <th>
                                    Category
                                </th>

                                <th>
                                    Products
                                </th>

                                <th>
                                    Sales
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
                            $filteredBrands
                            as $brand
                        ): ?>


                            <tr>


                                <!-- BRAND -->

                                <td>


                                    <strong>

                                        <?= htmlspecialchars(
                                            $brand['name']
                                        ); ?>

                                    </strong>


                                    <small class="table-subtext">

                                        <?= htmlspecialchars(
                                            $brand['description']
                                        ); ?>

                                    </small>


                                </td>


                                <!-- SLUG -->

                                <td>


                                    <code>

                                        <?= htmlspecialchars(
                                            $brand['slug']
                                        ); ?>

                                    </code>


                                </td>


                                <!-- CATEGORY -->

                                <td>

                                    <?= htmlspecialchars(
                                        $brand['category']
                                    ); ?>

                                </td>


                                <!-- PRODUCTS -->

                                <td>


                                    <strong>

                                        <?= number_format(
                                            $brand['products']
                                        ); ?>

                                    </strong>


                                </td>


                                <!-- SALES -->

                                <td>


                                    <strong>

                                        ₹<?= number_format(
                                            $brand['sales']
                                        ); ?>

                                    </strong>


                                </td>


                                <!-- FEATURED -->

                                <td>


                                    <?php if (
                                        $brand['featured']
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
                                        $brand['status'] ===
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
                                            href="edit-brand.php?id=<?= urlencode(
                                                $brand['id']
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
                            ◇
                        </div>


                        <h3>
                            No brands found
                        </h3>


                        <p>
                            Try changing your search or filters.
                        </p>


                        <a
                            href="brands.php"
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
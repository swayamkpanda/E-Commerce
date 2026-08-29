<?php

session_start();

/*
|--------------------------------------------------------------------------
| SSISS ADMIN - ADD PRODUCT
|--------------------------------------------------------------------------
| This page contains the product creation form.
| Database insertion will be connected later.
|--------------------------------------------------------------------------
*/

$adminName = $_SESSION['admin_name'] ?? 'Admin';


// ==========================================================
// DEFAULT VALUES
// ==========================================================

$productName = '';
$sku = '';
$brand = '';
$category = '';
$subcategory = '';
$price = '';
$discount = '';
$stock = '';
$description = '';

$condition = 'New';

$status = 'Active';

$gender = 'Unisex';

$featured = false;

$sustainable = false;

$preLoved = false;

$sizes = [];

$colors = [];

$styles = [];

$errors = [];

$success = '';


// ==========================================================
// FORM SUBMISSION
// ==========================================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Basic product information

    $productName = trim($_POST['product_name'] ?? '');

    $sku = trim($_POST['sku'] ?? '');

    $brand = trim($_POST['brand'] ?? '');

    $category = trim($_POST['category'] ?? '');

    $subcategory = trim($_POST['subcategory'] ?? '');

    $price = trim($_POST['price'] ?? '');

    $discount = trim($_POST['discount'] ?? '');

    $stock = trim($_POST['stock'] ?? '');

    $description = trim($_POST['description'] ?? '');


    // Product condition

    $condition = trim(
        $_POST['condition'] ?? 'New'
    );


    // Status

    $status = trim(
        $_POST['status'] ?? 'Active'
    );


    // Gender

    $gender = trim(
        $_POST['gender'] ?? 'Unisex'
    );


    // Sizes

    $sizes = $_POST['sizes'] ?? [];


    // Colors

    $colors = $_POST['colors'] ?? [];


    // Style / AI tags

    $styles = $_POST['styles'] ?? [];


    // Checkboxes

    $featured =
        isset($_POST['featured']);

    $sustainable =
        isset($_POST['sustainable']);

    $preLoved =
        isset($_POST['pre_loved']);


    // ======================================================
    // VALIDATION
    // ======================================================

    if ($productName === '') {

        $errors[] =
            'Product name is required.';

    }


    if ($sku === '') {

        $errors[] =
            'SKU is required.';

    }


    if ($brand === '') {

        $errors[] =
            'Brand is required.';

    }


    if ($category === '') {

        $errors[] =
            'Category is required.';

    }


    if ($subcategory === '') {

        $errors[] =
            'Subcategory is required.';

    }


    if (
        $price === '' ||
        !is_numeric($price) ||
        $price < 0
    ) {

        $errors[] =
            'Please enter a valid price.';

    }


    if (
        $discount !== '' &&
        (
            !is_numeric($discount) ||
            $discount < 0 ||
            $discount > 100
        )
    ) {

        $errors[] =
            'Discount must be between 0 and 100%.';

    }


    if (
        $stock === '' ||
        filter_var(
            $stock,
            FILTER_VALIDATE_INT
        ) === false ||
        $stock < 0
    ) {

        $errors[] =
            'Please enter a valid stock quantity.';

    }


    if ($description === '') {

        $errors[] =
            'Product description is required.';

    }


    if (empty($sizes)) {

        $errors[] =
            'Select at least one size.';

    }


    if (empty($colors)) {

        $errors[] =
            'Select at least one color.';

    }


    if (empty($styles)) {

        $errors[] =
            'Select at least one style/vibe.';

    }


    // ======================================================
    // DEMO SUCCESS
    // ======================================================

    if (empty($errors)) {

        /*
        |--------------------------------------------------------------------------
        | DATABASE INSERT WILL BE ADDED LATER
        |--------------------------------------------------------------------------
        |
        | Example future flow:
        |
        | INSERT INTO products (...)
        |
        */

        $success =
            'Product information is valid. Database connection will be added later.';

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
        Add Product | SSISS Admin
    </title>


    <!-- These CSS files will be created later -->

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
                    SSISS / Products / Add Product
                </p>


                <h1>
                    Add Product
                </h1>


                <p class="admin-subtitle">
                    Add a new product to the SSISS catalog.
                </p>

            </div>


        </header>


        <!-- ==================================================
             ALERTS
        =================================================== -->

        <?php if (!empty($errors)): ?>


            <div class="alert alert-danger">


                <strong>
                    Please fix the following:
                </strong>


                <ul>

                    <?php foreach ($errors as $error): ?>

                        <li>
                            <?= htmlspecialchars($error); ?>
                        </li>

                    <?php endforeach; ?>

                </ul>


            </div>


        <?php endif; ?>


        <?php if ($success !== ''): ?>


            <div class="alert alert-success">

                <?= htmlspecialchars($success); ?>

            </div>


        <?php endif; ?>


        <!-- ==================================================
             PRODUCT FORM
        =================================================== -->

        <form
            method="POST"
            action="add-product.php"
            enctype="multipart/form-data"
        >


            <!-- ==================================================
                 BASIC INFORMATION
            =================================================== -->

            <section class="dashboard-panel">


                <div class="panel-header">


                    <div>

                        <h3>
                            Basic Information
                        </h3>

                        <p>
                            Main details about the product.
                        </p>

                    </div>


                </div>


                <div class="form-grid">


                    <!-- PRODUCT NAME -->

                    <div class="form-group full-width">

                        <label for="product_name">
                            Product Name *
                        </label>

                        <input
                            type="text"
                            id="product_name"
                            name="product_name"
                            value="<?= htmlspecialchars($productName); ?>"
                            placeholder="e.g. Oversized Essential Tee"
                            required
                        >

                    </div>


                    <!-- SKU -->

                    <div class="form-group">

                        <label for="sku">
                            SKU *
                        </label>

                        <input
                            type="text"
                            id="sku"
                            name="sku"
                            value="<?= htmlspecialchars($sku); ?>"
                            placeholder="e.g. SST-TEE-001"
                            required
                        >

                    </div>


                    <!-- BRAND -->

                    <div class="form-group">

                        <label for="brand">
                            Brand *
                        </label>

                        <select
                            id="brand"
                            name="brand"
                            required
                        >

                            <option value="">
                                Select Brand
                            </option>

                            <option
                                value="SSISS Studio"
                                <?= $brand === 'SSISS Studio' ? 'selected' : ''; ?>
                            >
                                SSISS Studio
                            </option>

                            <option
                                value="Urban Core"
                                <?= $brand === 'Urban Core' ? 'selected' : ''; ?>
                            >
                                Urban Core
                            </option>

                            <option
                                value="Stride"
                                <?= $brand === 'Stride' ? 'selected' : ''; ?>
                            >
                                Stride
                            </option>

                            <option
                                value="Chrono"
                                <?= $brand === 'Chrono' ? 'selected' : ''; ?>
                            >
                                Chrono
                            </option>

                            <option
                                value="Vision"
                                <?= $brand === 'Vision' ? 'selected' : ''; ?>
                            >
                                Vision
                            </option>

                        </select>

                    </div>


                    <!-- CATEGORY -->

                    <div class="form-group">

                        <label for="category">
                            Category *
                        </label>

                        <select
                            id="category"
                            name="category"
                            required
                        >

                            <option value="">
                                Select Category
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

                            <option
                                value="Accessories"
                                <?= $category === 'Accessories' ? 'selected' : ''; ?>
                            >
                                Accessories
                            </option>

                        </select>

                    </div>


                    <!-- SUBCATEGORY -->

                    <div class="form-group">

                        <label for="subcategory">
                            Subcategory *
                        </label>

                        <input
                            type="text"
                            id="subcategory"
                            name="subcategory"
                            value="<?= htmlspecialchars($subcategory); ?>"
                            placeholder="e.g. T-Shirts"
                            required
                        >

                    </div>


                </div>


            </section>


            <!-- ==================================================
                 PRICE & INVENTORY
            =================================================== -->

            <section class="dashboard-panel">


                <div class="panel-header">

                    <div>

                        <h3>
                            Price & Inventory
                        </h3>

                        <p>
                            Configure pricing and available stock.
                        </p>

                    </div>

                </div>


                <div class="form-grid">


                    <!-- PRICE -->

                    <div class="form-group">

                        <label for="price">
                            Price (₹) *
                        </label>

                        <input
                            type="number"
                            id="price"
                            name="price"
                            value="<?= htmlspecialchars($price); ?>"
                            min="0"
                            step="0.01"
                            placeholder="699"
                            required
                        >

                    </div>


                    <!-- DISCOUNT -->

                    <div class="form-group">

                        <label for="discount">
                            Discount (%)
                        </label>

                        <input
                            type="number"
                            id="discount"
                            name="discount"
                            value="<?= htmlspecialchars($discount); ?>"
                            min="0"
                            max="100"
                            step="1"
                            placeholder="10"
                        >

                    </div>


                    <!-- STOCK -->

                    <div class="form-group">

                        <label for="stock">
                            Stock Quantity *
                        </label>

                        <input
                            type="number"
                            id="stock"
                            name="stock"
                            value="<?= htmlspecialchars($stock); ?>"
                            min="0"
                            step="1"
                            placeholder="50"
                            required
                        >

                    </div>


                    <!-- STATUS -->

                    <div class="form-group">

                        <label for="status">
                            Product Status
                        </label>

                        <select
                            id="status"
                            name="status"
                        >

                            <option
                                value="Active"
                                <?= $status === 'Active' ? 'selected' : ''; ?>
                            >
                                Active
                            </option>

                            <option
                                value="Draft"
                                <?= $status === 'Draft' ? 'selected' : ''; ?>
                            >
                                Draft
                            </option>

                            <option
                                value="Inactive"
                                <?= $status === 'Inactive' ? 'selected' : ''; ?>
                            >
                                Inactive
                            </option>

                        </select>

                    </div>


                </div>


            </section>


            <!-- ==================================================
                 PRODUCT DETAILS
            =================================================== -->

            <section class="dashboard-panel">


                <div class="panel-header">

                    <div>

                        <h3>
                            Product Details
                        </h3>

                        <p>
                            Help customers and AI understand the product.
                        </p>

                    </div>

                </div>


                <div class="form-grid">


                    <!-- CONDITION -->

                    <div class="form-group">

                        <label for="condition">
                            Condition
                        </label>

                        <select
                            id="condition"
                            name="condition"
                        >

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


                    <!-- GENDER -->

                    <div class="form-group">

                        <label for="gender">
                            Target
                        </label>

                        <select
                            id="gender"
                            name="gender"
                        >

                            <option
                                value="Unisex"
                                <?= $gender === 'Unisex' ? 'selected' : ''; ?>
                            >
                                Unisex
                            </option>

                            <option
                                value="Men"
                                <?= $gender === 'Men' ? 'selected' : ''; ?>
                            >
                                Men
                            </option>

                            <option
                                value="Women"
                                <?= $gender === 'Women' ? 'selected' : ''; ?>
                            >
                                Women
                            </option>

                        </select>

                    </div>


                    <!-- DESCRIPTION -->

                    <div class="form-group full-width">

                        <label for="description">
                            Description *
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="6"
                            placeholder="Describe the product, material, fit, features, etc."
                            required
                        ><?= htmlspecialchars($description); ?></textarea>

                    </div>


                </div>


            </section>


            <!-- ==================================================
                 SIZES
            =================================================== -->

            <section class="dashboard-panel">


                <div class="panel-header">

                    <div>

                        <h3>
                            Available Sizes
                        </h3>

                        <p>
                            Select all sizes available for this product.
                        </p>

                    </div>

                </div>


                <div class="checkbox-group">


                    <?php

                    $availableSizes = [
                        'XS',
                        'S',
                        'M',
                        'L',
                        'XL',
                        'XXL',
                        '28',
                        '30',
                        '32',
                        '34',
                        '36',
                        '38',
                        '40',
                        '42'
                    ];

                    ?>


                    <?php foreach (
                        $availableSizes
                        as $size
                    ): ?>


                        <label class="checkbox-item">


                            <input
                                type="checkbox"
                                name="sizes[]"
                                value="<?= htmlspecialchars($size); ?>"
                                <?= in_array(
                                    $size,
                                    $sizes,
                                    true
                                ) ? 'checked' : ''; ?>
                            >


                            <span>
                                <?= htmlspecialchars($size); ?>
                            </span>


                        </label>


                    <?php endforeach; ?>


                </div>


            </section>


            <!-- ==================================================
                 COLORS
            =================================================== -->

            <section class="dashboard-panel">


                <div class="panel-header">

                    <div>

                        <h3>
                            Colors
                        </h3>

                        <p>
                            Select the colors available.
                        </p>

                    </div>

                </div>


                <div class="checkbox-group">


                    <?php

                    $availableColors = [

                        'Black',
                        'White',
                        'Grey',
                        'Navy',
                        'Blue',
                        'Green',
                        'Brown',
                        'Beige',
                        'Red',
                        'Pink',
                        'Yellow',
                        'Purple'

                    ];

                    ?>


                    <?php foreach (
                        $availableColors
                        as $color
                    ): ?>


                        <label class="checkbox-item">


                            <input
                                type="checkbox"
                                name="colors[]"
                                value="<?= htmlspecialchars($color); ?>"
                                <?= in_array(
                                    $color,
                                    $colors,
                                    true
                                ) ? 'checked' : ''; ?>
                            >


                            <span>
                                <?= htmlspecialchars($color); ?>
                            </span>


                        </label>


                    <?php endforeach; ?>


                </div>


            </section>


            <!-- ==================================================
                 STYLE / AI TAGS
            =================================================== -->

            <section class="dashboard-panel">


                <div class="panel-header">

                    <div>

                        <h3>
                            Style & AI Tags
                        </h3>

                        <p>
                            These tags help the SSISS AI recommend this product.
                        </p>

                    </div>

                </div>


                <div class="checkbox-group">


                    <?php

                    $styleOptions = [

                        'Streetwear',
                        'Minimal',
                        'Old Money',
                        'Y2K',
                        'Grunge',
                        'Vintage',
                        'Formal',
                        'Casual',
                        'Sporty',
                        'Party',
                        'College',
                        'Smart Casual',
                        'Boho',
                        'Luxury'

                    ];

                    ?>


                    <?php foreach (
                        $styleOptions
                        as $style
                    ): ?>


                        <label class="checkbox-item">


                            <input
                                type="checkbox"
                                name="styles[]"
                                value="<?= htmlspecialchars($style); ?>"
                                <?= in_array(
                                    $style,
                                    $styles,
                                    true
                                ) ? 'checked' : ''; ?>
                            >


                            <span>
                                <?= htmlspecialchars($style); ?>
                            </span>


                        </label>


                    <?php endforeach; ?>


                </div>


            </section>


            <!-- ==================================================
                 PRODUCT FLAGS
            =================================================== -->

            <section class="dashboard-panel">


                <div class="panel-header">

                    <div>

                        <h3>
                            Product Settings
                        </h3>

                        <p>
                            Configure how this product behaves across SSISS.
                        </p>

                    </div>

                </div>


                <div class="settings-checkboxes">


                    <label class="checkbox-item">


                        <input
                            type="checkbox"
                            name="featured"
                            value="1"
                            <?= $featured ? 'checked' : ''; ?>
                        >


                        <div>

                            <strong>
                                Featured Product
                            </strong>

                            <small>
                                Show this product in featured sections.
                            </small>

                        </div>


                    </label>


                    <label class="checkbox-item">


                        <input
                            type="checkbox"
                            name="sustainable"
                            value="1"
                            <?= $sustainable ? 'checked' : ''; ?>
                        >


                        <div>

                            <strong>
                                Sustainable Product
                            </strong>

                            <small>
                                Mark this product as part of SSISS sustainability initiatives.
                            </small>

                        </div>


                    </label>


                    <label class="checkbox-item">


                        <input
                            type="checkbox"
                            name="pre_loved"
                            value="1"
                            <?= $preLoved ? 'checked' : ''; ?>
                        >


                        <div>

                            <strong>
                                Pre-Loved
                            </strong>

                            <small>
                                List this item as a pre-loved product.
                            </small>

                        </div>


                    </label>


                </div>


            </section>


            <!-- ==================================================
                 PRODUCT IMAGE
            =================================================== -->

            <section class="dashboard-panel">


                <div class="panel-header">

                    <div>

                        <h3>
                            Product Images
                        </h3>

                        <p>
                            Upload product photos.
                        </p>

                    </div>

                </div>


                <div class="form-group">


                    <label for="product_images">
                        Product Images
                    </label>


                    <input
                        type="file"
                        id="product_images"
                        name="product_images[]"
                        accept="image/jpeg,image/png,image/webp"
                        multiple
                    >


                    <small>
                        Recommended: square product images.
                    </small>


                </div>


            </section>


            <!-- ==================================================
                 FORM ACTIONS
            =================================================== -->

            <section class="page-actions">


                <a
                    href="products.php"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Create Product
                </button>


            </section>


        </form>


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
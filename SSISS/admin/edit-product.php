<?php

session_start();

/*
|--------------------------------------------------------------------------
| SSISS ADMIN - EDIT PRODUCT
|--------------------------------------------------------------------------
| Edit an existing product.
|
| IMPORTANT:
| This version uses demo data.
| MySQL UPDATE will be connected later.
|--------------------------------------------------------------------------
*/


// ==========================================================
// ADMIN
// ==========================================================

$adminName = $_SESSION['admin_name'] ?? 'Admin';


// ==========================================================
// DEMO PRODUCTS
// ==========================================================

$products = [

    1001 => [
        'id' => 1001,
        'name' => 'Oversized Essential Tee',
        'sku' => 'SST-TEE-001',
        'brand' => 'SSISS Studio',
        'category' => 'Clothing',
        'subcategory' => 'T-Shirts',
        'price' => 699,
        'discount' => 0,
        'stock' => 42,
        'condition' => 'New',
        'status' => 'Active',
        'gender' => 'Unisex',
        'description' => 'Premium oversized everyday t-shirt with a relaxed fit.',
        'sizes' => ['S', 'M', 'L', 'XL'],
        'colors' => ['Black', 'White', 'Grey'],
        'styles' => ['Streetwear', 'Casual', 'College'],
        'featured' => true,
        'sustainable' => true,
        'pre_loved' => false
    ],

    1002 => [
        'id' => 1002,
        'name' => 'Relaxed Cargo Pants',
        'sku' => 'UCR-CARGO-002',
        'brand' => 'Urban Core',
        'category' => 'Clothing',
        'subcategory' => 'Pants',
        'price' => 1299,
        'discount' => 10,
        'stock' => 18,
        'condition' => 'New',
        'status' => 'Active',
        'gender' => 'Unisex',
        'description' => 'Relaxed fit cargo pants designed for everyday streetwear.',
        'sizes' => ['28', '30', '32', '34', '36'],
        'colors' => ['Black', 'Brown', 'Green'],
        'styles' => ['Streetwear', 'Casual', 'College'],
        'featured' => true,
        'sustainable' => false,
        'pre_loved' => false
    ],

    1003 => [
        'id' => 1003,
        'name' => 'Classic Runner Sneakers',
        'sku' => 'STR-SNK-003',
        'brand' => 'Stride',
        'category' => 'Shoes',
        'subcategory' => 'Sneakers',
        'price' => 2499,
        'discount' => 5,
        'stock' => 7,
        'condition' => 'New',
        'status' => 'Active',
        'gender' => 'Unisex',
        'description' => 'Lightweight everyday sneakers with a clean modern silhouette.',
        'sizes' => ['7', '8', '9', '10', '11'],
        'colors' => ['White', 'Black', 'Grey'],
        'styles' => ['Sporty', 'Casual', 'Minimal'],
        'featured' => false,
        'sustainable' => true,
        'pre_loved' => false
    ]

];


// ==========================================================
// GET PRODUCT ID
// ==========================================================

$productId = isset($_GET['id'])
    ? (int) $_GET['id']
    : 0;


// ==========================================================
// CHECK PRODUCT
// ==========================================================

if (
    $productId === 0 ||
    !isset($products[$productId])
) {

    header('Location: products.php');

    exit;

}


// ==========================================================
// LOAD PRODUCT
// ==========================================================

$product = $products[$productId];


// ==========================================================
// FORM VARIABLES
// ==========================================================

$productName = $product['name'];

$sku = $product['sku'];

$brand = $product['brand'];

$category = $product['category'];

$subcategory = $product['subcategory'];

$price = $product['price'];

$discount = $product['discount'];

$stock = $product['stock'];

$condition = $product['condition'];

$status = $product['status'];

$gender = $product['gender'];

$description = $product['description'];

$sizes = $product['sizes'];

$colors = $product['colors'];

$styles = $product['styles'];

$featured = $product['featured'];

$sustainable = $product['sustainable'];

$preLoved = $product['pre_loved'];

$errors = [];

$success = '';


// ==========================================================
// FORM SUBMISSION
// ==========================================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // ------------------------------------------------------
    // BASIC INFORMATION
    // ------------------------------------------------------

    $productName =
        trim($_POST['product_name'] ?? '');

    $sku =
        trim($_POST['sku'] ?? '');

    $brand =
        trim($_POST['brand'] ?? '');

    $category =
        trim($_POST['category'] ?? '');

    $subcategory =
        trim($_POST['subcategory'] ?? '');


    // ------------------------------------------------------
    // PRICE & INVENTORY
    // ------------------------------------------------------

    $price =
        trim($_POST['price'] ?? '');

    $discount =
        trim($_POST['discount'] ?? '');

    $stock =
        trim($_POST['stock'] ?? '');

    $status =
        trim($_POST['status'] ?? 'Active');


    // ------------------------------------------------------
    // PRODUCT DETAILS
    // ------------------------------------------------------

    $condition =
        trim($_POST['condition'] ?? 'New');

    $gender =
        trim($_POST['gender'] ?? 'Unisex');

    $description =
        trim($_POST['description'] ?? '');


    // ------------------------------------------------------
    // OPTIONS
    // ------------------------------------------------------

    $sizes =
        $_POST['sizes'] ?? [];

    $colors =
        $_POST['colors'] ?? [];

    $styles =
        $_POST['styles'] ?? [];


    // ------------------------------------------------------
    // SETTINGS
    // ------------------------------------------------------

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
    // DEMO UPDATE
    // ======================================================

    if (empty($errors)) {

        /*
        |--------------------------------------------------------------------------
        | MYSQL UPDATE WILL BE ADDED LATER
        |--------------------------------------------------------------------------
        |
        | Example:
        |
        | UPDATE products
        | SET name = ?, sku = ?, ...
        | WHERE id = ?
        |
        */

        $success =
            'Product changes are valid. MySQL UPDATE will be connected later.';

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
        Edit Product | SSISS Admin
    </title>


    <!-- GLOBAL CSS -->

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

                    SSISS /
                    Products /
                    Edit Product

                </p>


                <h1>
                    Edit Product
                </h1>


                <p class="admin-subtitle">

                    Update product information and settings.

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

                            <?= htmlspecialchars(
                                $error
                            ); ?>

                        </li>

                    <?php endforeach; ?>

                </ul>


            </div>


        <?php endif; ?>


        <?php if ($success !== ''): ?>


            <div class="alert alert-success">

                <?= htmlspecialchars(
                    $success
                ); ?>

            </div>


        <?php endif; ?>


        <!-- ==================================================
             PRODUCT ID
        =================================================== -->

        <div class="product-edit-info">

            Editing product:

            <strong>

                #<?= htmlspecialchars(
                    $product['id']
                ); ?>

            </strong>

        </div>


        <!-- ==================================================
             FORM
        =================================================== -->

        <form
            method="POST"
            action="edit-product.php?id=<?= urlencode($productId); ?>"
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
                            Update the main product information.
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
                            value="<?= htmlspecialchars(
                                $productName
                            ); ?>"
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
                            value="<?= htmlspecialchars(
                                $sku
                            ); ?>"
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


                            <?php

                            $brands = [
                                'SSISS Studio',
                                'Urban Core',
                                'Stride',
                                'Chrono',
                                'Vision'
                            ];

                            ?>


                            <?php foreach (
                                $brands
                                as $brandOption
                            ): ?>


                                <option
                                    value="<?= htmlspecialchars(
                                        $brandOption
                                    ); ?>"
                                    <?= $brand ===
                                        $brandOption
                                        ? 'selected'
                                        : ''; ?>
                                >

                                    <?= htmlspecialchars(
                                        $brandOption
                                    ); ?>

                                </option>


                            <?php endforeach; ?>


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


                            <?php

                            $categories = [
                                'Clothing',
                                'Shoes',
                                'Watches',
                                'Eyewear',
                                'Accessories'
                            ];

                            ?>


                            <?php foreach (
                                $categories
                                as $categoryOption
                            ): ?>


                                <option
                                    value="<?= htmlspecialchars(
                                        $categoryOption
                                    ); ?>"
                                    <?= $category ===
                                        $categoryOption
                                        ? 'selected'
                                        : ''; ?>
                                >

                                    <?= htmlspecialchars(
                                        $categoryOption
                                    ); ?>

                                </option>


                            <?php endforeach; ?>


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
                            value="<?= htmlspecialchars(
                                $subcategory
                            ); ?>"
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
                            Update pricing and stock information.
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
                            value="<?= htmlspecialchars(
                                $price
                            ); ?>"
                            min="0"
                            step="0.01"
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
                            value="<?= htmlspecialchars(
                                $discount
                            ); ?>"
                            min="0"
                            max="100"
                            step="1"
                        >


                    </div>


                    <!-- STOCK -->

                    <div class="form-group">


                        <label for="stock">
                            Stock *
                        </label>


                        <input
                            type="number"
                            id="stock"
                            name="stock"
                            value="<?= htmlspecialchars(
                                $stock
                            ); ?>"
                            min="0"
                            step="1"
                            required
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


                            <option
                                value="Active"
                                <?= $status ===
                                    'Active'
                                    ? 'selected'
                                    : ''; ?>
                            >
                                Active
                            </option>


                            <option
                                value="Draft"
                                <?= $status ===
                                    'Draft'
                                    ? 'selected'
                                    : ''; ?>
                            >
                                Draft
                            </option>


                            <option
                                value="Inactive"
                                <?= $status ===
                                    'Inactive'
                                    ? 'selected'
                                    : ''; ?>
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
                            Update description and target audience.
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
                                <?= $condition ===
                                    'New'
                                    ? 'selected'
                                    : ''; ?>
                            >
                                New
                            </option>


                            <option
                                value="Pre-Loved"
                                <?= $condition ===
                                    'Pre-Loved'
                                    ? 'selected'
                                    : ''; ?>
                            >
                                Pre-Loved
                            </option>


                        </select>


                    </div>


                    <!-- TARGET -->

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
                                <?= $gender ===
                                    'Unisex'
                                    ? 'selected'
                                    : ''; ?>
                            >
                                Unisex
                            </option>


                            <option
                                value="Men"
                                <?= $gender ===
                                    'Men'
                                    ? 'selected'
                                    : ''; ?>
                            >
                                Men
                            </option>


                            <option
                                value="Women"
                                <?= $gender ===
                                    'Women'
                                    ? 'selected'
                                    : ''; ?>
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
                            required
                        ><?= htmlspecialchars(
                            $description
                        ); ?></textarea>


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
                            Update available sizes.
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
                        '42',

                        '7',
                        '8',
                        '9',
                        '10',
                        '11',
                        '12'

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
                                value="<?= htmlspecialchars(
                                    $size
                                ); ?>"
                                <?= in_array(
                                    $size,
                                    $sizes,
                                    true
                                )
                                    ? 'checked'
                                    : ''; ?>
                            >


                            <span>

                                <?= htmlspecialchars(
                                    $size
                                ); ?>

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
                            Update product colors.
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
                                value="<?= htmlspecialchars(
                                    $color
                                ); ?>"
                                <?= in_array(
                                    $color,
                                    $colors,
                                    true
                                )
                                    ? 'checked'
                                    : ''; ?>
                            >


                            <span>

                                <?= htmlspecialchars(
                                    $color
                                ); ?>

                            </span>


                        </label>


                    <?php endforeach; ?>


                </div>


            </section>


            <!-- ==================================================
                 AI STYLE TAGS
            =================================================== -->

            <section class="dashboard-panel">


                <div class="panel-header">


                    <div>

                        <h3>
                            Style & AI Tags
                        </h3>

                        <p>
                            Used by SSISS AI for outfit recommendations.
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
                                value="<?= htmlspecialchars(
                                    $style
                                ); ?>"
                                <?= in_array(
                                    $style,
                                    $styles,
                                    true
                                )
                                    ? 'checked'
                                    : ''; ?>
                            >


                            <span>

                                <?= htmlspecialchars(
                                    $style
                                ); ?>

                            </span>


                        </label>


                    <?php endforeach; ?>


                </div>


            </section>


            <!-- ==================================================
                 PRODUCT SETTINGS
            =================================================== -->

            <section class="dashboard-panel">


                <div class="panel-header">


                    <div>

                        <h3>
                            Product Settings
                        </h3>

                        <p>
                            Control how the product appears across SSISS.
                        </p>

                    </div>


                </div>


                <div class="settings-checkboxes">


                    <!-- FEATURED -->

                    <label class="checkbox-item">


                        <input
                            type="checkbox"
                            name="featured"
                            value="1"
                            <?= $featured
                                ? 'checked'
                                : ''; ?>
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


                    <!-- SUSTAINABLE -->

                    <label class="checkbox-item">


                        <input
                            type="checkbox"
                            name="sustainable"
                            value="1"
                            <?= $sustainable
                                ? 'checked'
                                : ''; ?>
                        >


                        <div>

                            <strong>
                                Sustainable Product
                            </strong>


                            <small>
                                Highlight this product as sustainable.
                            </small>

                        </div>


                    </label>


                    <!-- PRE-LOVED -->

                    <label class="checkbox-item">


                        <input
                            type="checkbox"
                            name="pre_loved"
                            value="1"
                            <?= $preLoved
                                ? 'checked'
                                : ''; ?>
                        >


                        <div>

                            <strong>
                                Pre-Loved Product
                            </strong>


                            <small>
                                Mark this product as pre-loved.
                            </small>

                        </div>


                    </label>


                </div>


            </section>


            <!-- ==================================================
                 IMAGES
            =================================================== -->

            <section class="dashboard-panel">


                <div class="panel-header">


                    <div>

                        <h3>
                            Product Images
                        </h3>


                        <p>
                            Upload new product images if required.
                        </p>

                    </div>


                </div>


                <div class="form-group">


                    <label for="product_images">
                        Replace / Add Images
                    </label>


                    <input
                        type="file"
                        id="product_images"
                        name="product_images[]"
                        accept="image/jpeg,image/png,image/webp"
                        multiple
                    >


                    <small>
                        Supported formats: JPG, PNG and WebP.
                    </small>


                </div>


            </section>


            <!-- ==================================================
                 ACTIONS
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
                    Save Changes
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
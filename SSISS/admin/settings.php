<?php

session_start();

/*
|--------------------------------------------------------------------------
| SSISS ADMIN - SETTINGS
|--------------------------------------------------------------------------
| Demo version.
| MySQL integration will be added later.
|--------------------------------------------------------------------------
*/

$adminName = $_SESSION['admin_name'] ?? 'Admin';


// ==========================================================
// DEMO SETTINGS
// ==========================================================

$settings = [

    // Store
    'store_name' => 'SSISS',
    'store_email' => 'support@ssiss.com',
    'store_phone' => '+91 98765 43210',
    'currency' => 'INR',
    'timezone' => 'Asia/Kolkata',

    // Store behaviour
    'maintenance_mode' => false,
    'new_user_registration' => true,
    'guest_checkout' => true,
    'product_reviews' => true,

    // Orders
    'minimum_order' => 499,
    'free_shipping' => 999,
    'shipping_charge' => 79,

    // Coins
    'coins_enabled' => true,
    'donation_coins' => 50,
    'resale_coins' => 30,
    'referral_coins' => 100,

    // AI
    'ai_enabled' => true,
    'image_analysis' => true,
    'vibe_ai' => true,
    'budget_stylist' => true,

    // Notifications
    'order_email' => true,
    'donation_email' => true,
    'coin_email' => true,
    'marketing_email' => false

];


// ==========================================================
// FORM SUBMISSION DEMO
// ==========================================================

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $message =
        'Settings saved successfully. '
        . 'MySQL connection will be added later.';

}


// ==========================================================
// HELPER
// ==========================================================

function checked($value)
{
    return $value ? 'checked' : '';
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
        Settings | SSISS Admin
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
                class="admin-nav-item"
            >
                <span>▥</span>
                Reports
            </a>


            <a
                href="settings.php"
                class="admin-nav-item active"
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
                    SSISS / Settings
                </p>


                <h1>
                    Settings
                </h1>


                <p class="admin-subtitle">
                    Configure your SSISS store, AI, rewards and notifications.
                </p>


            </div>


        </header>


        <!-- ==================================================
             SUCCESS MESSAGE
        =================================================== -->

        <?php if ($message !== ''): ?>


            <div class="dashboard-panel">


                <div class="success-message">

                    ✓

                    <?= htmlspecialchars(
                        $message
                    ); ?>

                </div>


            </div>


        <?php endif; ?>


        <form
            method="POST"
            action="settings.php"
        >


            <!-- ==================================================
                 STORE SETTINGS
            =================================================== -->

            <section class="dashboard-panel">


                <div class="panel-header">


                    <div>

                        <h3>
                            Store Settings
                        </h3>


                        <p>
                            Basic information about your SSISS store.
                        </p>

                    </div>


                </div>


                <div class="settings-grid">


                    <div class="form-group">


                        <label for="store_name">
                            Store Name
                        </label>


                        <input
                            type="text"
                            id="store_name"
                            name="store_name"
                            value="<?= htmlspecialchars(
                                $settings['store_name']
                            ); ?>"
                        >


                    </div>


                    <div class="form-group">


                        <label for="store_email">
                            Store Email
                        </label>


                        <input
                            type="email"
                            id="store_email"
                            name="store_email"
                            value="<?= htmlspecialchars(
                                $settings['store_email']
                            ); ?>"
                        >


                    </div>


                    <div class="form-group">


                        <label for="store_phone">
                            Store Phone
                        </label>


                        <input
                            type="text"
                            id="store_phone"
                            name="store_phone"
                            value="<?= htmlspecialchars(
                                $settings['store_phone']
                            ); ?>"
                        >


                    </div>


                    <div class="form-group">


                        <label for="currency">
                            Currency
                        </label>


                        <select
                            id="currency"
                            name="currency"
                        >


                            <option value="INR">
                                INR - Indian Rupee
                            </option>


                            <option value="USD">
                                USD - US Dollar
                            </option>


                            <option value="EUR">
                                EUR - Euro
                            </option>


                        </select>


                    </div>


                    <div class="form-group">


                        <label for="timezone">
                            Timezone
                        </label>


                        <select
                            id="timezone"
                            name="timezone"
                        >


                            <option value="Asia/Kolkata">
                                India - Asia/Kolkata
                            </option>


                            <option value="UTC">
                                UTC
                            </option>


                        </select>


                    </div>


                </div>


            </section>


            <!-- ==================================================
                 STORE CONTROLS
            =================================================== -->

            <section class="dashboard-panel">


                <div class="panel-header">


                    <div>

                        <h3>
                            Store Controls
                        </h3>


                        <p>
                            Enable or disable major store features.
                        </p>

                    </div>


                </div>


                <div class="settings-list">


                    <label class="setting-row">


                        <div>

                            <strong>
                                Maintenance Mode
                            </strong>


                            <small>
                                Temporarily disable customer access to the store.
                            </small>

                        </div>


                        <input
                            type="checkbox"
                            name="maintenance_mode"
                            <?= checked(
                                $settings['maintenance_mode']
                            ); ?>
                        >


                    </label>


                    <label class="setting-row">


                        <div>

                            <strong>
                                New User Registration
                            </strong>


                            <small>
                                Allow new customers to create accounts.
                            </small>

                        </div>


                        <input
                            type="checkbox"
                            name="new_user_registration"
                            <?= checked(
                                $settings['new_user_registration']
                            ); ?>
                        >


                    </label>


                    <label class="setting-row">


                        <div>

                            <strong>
                                Guest Checkout
                            </strong>


                            <small>
                                Allow customers to purchase without an account.
                            </small>

                        </div>


                        <input
                            type="checkbox"
                            name="guest_checkout"
                            <?= checked(
                                $settings['guest_checkout']
                            ); ?>
                        >


                    </label>


                    <label class="setting-row">


                        <div>

                            <strong>
                                Product Reviews
                            </strong>


                            <small>
                                Allow customers to review purchased products.
                            </small>

                        </div>


                        <input
                            type="checkbox"
                            name="product_reviews"
                            <?= checked(
                                $settings['product_reviews']
                            ); ?>
                        >


                    </label>


                </div>


            </section>


            <!-- ==================================================
                 ORDER SETTINGS
            =================================================== -->

            <section class="dashboard-panel">


                <div class="panel-header">


                    <div>

                        <h3>
                            Order & Shipping
                        </h3>


                        <p>
                            Configure checkout and shipping rules.
                        </p>

                    </div>


                </div>


                <div class="settings-grid">


                    <div class="form-group">


                        <label for="minimum_order">
                            Minimum Order Value
                        </label>


                        <input
                            type="number"
                            id="minimum_order"
                            name="minimum_order"
                            value="<?= $settings['minimum_order']; ?>"
                        >


                    </div>


                    <div class="form-group">


                        <label for="free_shipping">
                            Free Shipping Above
                        </label>


                        <input
                            type="number"
                            id="free_shipping"
                            name="free_shipping"
                            value="<?= $settings['free_shipping']; ?>"
                        >


                    </div>


                    <div class="form-group">


                        <label for="shipping_charge">
                            Standard Shipping Charge
                        </label>


                        <input
                            type="number"
                            id="shipping_charge"
                            name="shipping_charge"
                            value="<?= $settings['shipping_charge']; ?>"
                        >


                    </div>


                </div>


            </section>


            <!-- ==================================================
                 SSISS COINS
            =================================================== -->

            <section class="dashboard-panel">


                <div class="panel-header">


                    <div>

                        <h3>
                            🪙 SSISS Coins
                        </h3>


                        <p>
                            Configure how users earn SSISS Coins.
                        </p>

                    </div>


                </div>


                <div class="settings-list">


                    <label class="setting-row">


                        <div>

                            <strong>
                                Enable SSISS Coins
                            </strong>


                            <small>
                                Allow customers to earn and redeem coins.
                            </small>

                        </div>


                        <input
                            type="checkbox"
                            name="coins_enabled"
                            <?= checked(
                                $settings['coins_enabled']
                            ); ?>
                        >


                    </label>


                </div>


                <div class="settings-grid">


                    <div class="form-group">


                        <label for="donation_coins">
                            Coins Per Donation Item
                        </label>


                        <input
                            type="number"
                            id="donation_coins"
                            name="donation_coins"
                            value="<?= $settings['donation_coins']; ?>"
                        >


                    </div>


                    <div class="form-group">


                        <label for="resale_coins">
                            Coins Per Approved Resale
                        </label>


                        <input
                            type="number"
                            id="resale_coins"
                            name="resale_coins"
                            value="<?= $settings['resale_coins']; ?>"
                        >


                    </div>


                    <div class="form-group">


                        <label for="referral_coins">
                            Referral Bonus
                        </label>


                        <input
                            type="number"
                            id="referral_coins"
                            name="referral_coins"
                            value="<?= $settings['referral_coins']; ?>"
                        >


                    </div>


                </div>


            </section>


            <!-- ==================================================
                 AI SETTINGS
            =================================================== -->

            <section class="dashboard-panel">


                <div class="panel-header">


                    <div>

                        <h3>
                            🤖 AI Features
                        </h3>


                        <p>
                            Control SSISS AI-powered fashion features.
                        </p>

                    </div>


                </div>


                <div class="settings-list">


                    <label class="setting-row">


                        <div>

                            <strong>
                                AI Recommendations
                            </strong>


                            <small>
                                Enable AI product recommendations.
                            </small>

                        </div>


                        <input
                            type="checkbox"
                            name="ai_enabled"
                            <?= checked(
                                $settings['ai_enabled']
                            ); ?>
                        >


                    </label>


                    <label class="setting-row">


                        <div>

                            <strong>
                                Image Style Analysis
                            </strong>


                            <small>
                                Analyze uploaded user images for fashion recommendations.
                            </small>

                        </div>


                        <input
                            type="checkbox"
                            name="image_analysis"
                            <?= checked(
                                $settings['image_analysis']
                            ); ?>
                        >


                    </label>


                    <label class="setting-row">


                        <div>

                            <strong>
                                Vibe Dress AI
                            </strong>


                            <small>
                                Recommend outfits based on the user's selected vibe.
                            </small>

                        </div>


                        <input
                            type="checkbox"
                            name="vibe_ai"
                            <?= checked(
                                $settings['vibe_ai']
                            ); ?>
                        >


                    </label>


                    <label class="setting-row">


                        <div>

                            <strong>
                                Budget Stylist
                            </strong>


                            <small>
                                Generate recommendations according to user budget.
                            </small>

                        </div>


                        <input
                            type="checkbox"
                            name="budget_stylist"
                            <?= checked(
                                $settings['budget_stylist']
                            ); ?>
                        >


                    </label>


                </div>


            </section>


            <!-- ==================================================
                 NOTIFICATIONS
            =================================================== -->

            <section class="dashboard-panel">


                <div class="panel-header">


                    <div>

                        <h3>
                            Notifications
                        </h3>


                        <p>
                            Configure automated customer notifications.
                        </p>

                    </div>


                </div>


                <div class="settings-list">


                    <label class="setting-row">


                        <div>

                            <strong>
                                Order Emails
                            </strong>


                            <small>
                                Send customers order confirmation and updates.
                            </small>

                        </div>


                        <input
                            type="checkbox"
                            name="order_email"
                            <?= checked(
                                $settings['order_email']
                            ); ?>
                        >


                    </label>


                    <label class="setting-row">


                        <div>

                            <strong>
                                Donation Emails
                            </strong>


                            <small>
                                Send donation verification and delivery updates.
                            </small>

                        </div>


                        <input
                            type="checkbox"
                            name="donation_email"
                            <?= checked(
                                $settings['donation_email']
                            ); ?>
                        >


                    </label>


                    <label class="setting-row">


                        <div>

                            <strong>
                                Coin Emails
                            </strong>


                            <small>
                                Notify users when they earn or redeem coins.
                            </small>

                        </div>


                        <input
                            type="checkbox"
                            name="coin_email"
                            <?= checked(
                                $settings['coin_email']
                            ); ?>
                        >


                    </label>


                    <label class="setting-row">


                        <div>

                            <strong>
                                Marketing Emails
                            </strong>


                            <small>
                                Send promotional campaigns and product updates.
                            </small>

                        </div>


                        <input
                            type="checkbox"
                            name="marketing_email"
                            <?= checked(
                                $settings['marketing_email']
                            ); ?>
                        >


                    </label>


                </div>


            </section>


            <!-- ==================================================
                 SAVE
            =================================================== -->

            <section class="page-actions">


                <div>

                    <h2>
                        Save Changes
                    </h2>


                    <p>
                        These settings will be stored in MySQL after database integration.
                    </p>


                </div>


                <div class="form-actions">


                    <button
                        type="reset"
                        class="btn btn-secondary"
                    >
                        Reset
                    </button>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Save Settings
                    </button>


                </div>


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
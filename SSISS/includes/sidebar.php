<?php

/*
|--------------------------------------------------------------------------
| SSISS - Sidebar
|--------------------------------------------------------------------------
*/

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/*
|--------------------------------------------------------------------------
| Current User Role
|--------------------------------------------------------------------------
*/

$userRole = $_SESSION['user_role'] ?? 'user';


/*
|--------------------------------------------------------------------------
| Current Page
|--------------------------------------------------------------------------
*/

$currentPage = basename($_SERVER['PHP_SELF']);

?>

<aside class="sidebar" id="sidebar">


    <!-- SIDEBAR BRAND -->

    <div class="sidebar-brand">

        <a href="../index.php">
            SSISS
        </a>

    </div>


    <!-- USER MENU -->

    <?php if ($userRole === 'user'): ?>

        <nav class="sidebar-nav">

            <div class="sidebar-section">

                <h3>
                    My Account
                </h3>

                <a
                    href="../profile/index.php"
                    class="<?= $currentPage === 'index.php'
                        ? 'active'
                        : '' ?>"
                >
                    Profile
                </a>

                <a href="../orders/index.php">
                    My Orders
                </a>

                <a href="../rewards/index.php">
                    SSISS Rewards
                </a>

                <a href="../impact/my-impact.php">
                    My Impact
                </a>

            </div>


            <div class="sidebar-section">

                <h3>
                    Shopping
                </h3>

                <a href="../shop/index.php">
                    Shop
                </a>

                <a href="../marketplace/index.php">
                    Marketplace
                </a>

                <a href="../checkout/cart.php">
                    Cart
                </a>

            </div>


            <div class="sidebar-section">

                <h3>
                    Sustainability
                </h3>

                <a href="../donation/index.php">
                    Donate Clothes
                </a>

                <a href="../impact/index.php">
                    Our Impact
                </a>

                <a href="../impact/stories.php">
                    Impact Stories
                </a>

            </div>

        </nav>


    <!-- NGO MENU -->

    <?php elseif ($userRole === 'ngo'): ?>

        <nav class="sidebar-nav">

            <div class="sidebar-section">

                <h3>
                    NGO Dashboard
                </h3>

                <a href="../ngo/index.php">
                    Dashboard
                </a>

                <a href="../ngo/donations.php">
                    Donations
                </a>

                <a href="../ngo/verify.php">
                    Verify Donations
                </a>

            </div>


            <div class="sidebar-section">

                <h3>
                    Impact
                </h3>

                <a href="../ngo/impact.php">
                    Impact Records
                </a>

                <a href="../ngo/stories.php">
                    Impact Stories
                </a>

            </div>


            <div class="sidebar-section">

                <h3>
                    NGO Account
                </h3>

                <a href="../ngo/profile.php">
                    NGO Profile
                </a>

                <a href="../auth/logout.php">
                    Logout
                </a>

            </div>

        </nav>


    <!-- ADMIN MENU -->

    <?php elseif ($userRole === 'admin'): ?>

        <nav class="sidebar-nav">

            <div class="sidebar-section">

                <h3>
                    Administration
                </h3>

                <a href="../admin/index.php">
                    Dashboard
                </a>

                <a href="../admin/users.php">
                    Users
                </a>

                <a href="../admin/products.php">
                    Products
                </a>

            </div>


            <div class="sidebar-section">

                <h3>
                    Donations
                </h3>

                <a href="../admin/donations.php">
                    Donations
                </a>

                <a href="../admin/ngos.php">
                    NGOs
                </a>

                <a href="../admin/impact.php">
                    Impact
                </a>

            </div>


            <div class="sidebar-section">

                <h3>
                    Store
                </h3>

                <a href="../admin/orders.php">
                    Orders
                </a>

                <a href="../admin/categories.php">
                    Categories
                </a>

            </div>


            <div class="sidebar-section">

                <h3>
                    System
                </h3>

                <a href="../admin/reports.php">
                    Reports
                </a>

                <a href="../admin/settings.php">
                    Settings
                </a>

                <a href="../auth/logout.php">
                    Logout
                </a>

            </div>

        </nav>

    <?php endif; ?>


</aside>
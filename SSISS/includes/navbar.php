<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['user_id']);

$currentPage = basename($_SERVER['PHP_SELF']);

?>

<header class="site-header">

    <nav class="navbar">

        <!-- LOGO -->

        <a
            href="/ssiss/index.php"
            class="navbar-logo"
        >
            <span class="logo-icon">✦</span>
            SSISS
        </a>


        <!-- DESKTOP NAVIGATION -->

        <div class="nav-links">

            <a
                href="/ssiss/index.php"
                class="<?= $currentPage === 'index.php' ? 'active' : '' ?>"
            >
                Home
            </a>

            <a href="/ssiss/marketplace/index.php">
                Shop
            </a>

            <a href="/ssiss/ai/index.php">
                AI Stylist
            </a>

            <a href="/ssiss/impact/index.php">
                Impact
            </a>

            <a href="/ssiss/donation/index.php">
                Donate
            </a>

        </div>


        <!-- RIGHT SIDE -->

        <div class="nav-actions">


            <?php if ($isLoggedIn): ?>


                <!-- SSISS COINS -->

                <a
                    href="/ssiss/wallet/index.php"
                    class="coin-wallet"
                    title="SSISS Coins"
                >

                    <span>
                        🪙
                    </span>

                    <span class="coin-count">

                        <?php

                        if (
                            function_exists(
                                'getUserCoinBalance'
                            )
                        ) {

                            echo number_format(
                                getUserCoinBalance(
                                    $_SESSION['user_id']
                                )
                            );

                        } else {

                            echo '0';

                        }

                        ?>

                    </span>

                </a>


                <!-- CART -->

                <a
                    href="/ssiss/marketplace/cart.php"
                    class="cart-icon"
                    title="Shopping Cart"
                >
                    🛒
                </a>


                <!-- PROFILE -->

                <a
                    href="/ssiss/profile/index.php"
                    class="profile-link"
                >

                    <span class="profile-avatar">

                        <?php

                        $initial =
                            $_SESSION['user_name'][0]
                            ?? 'U';

                        echo htmlspecialchars(
                            strtoupper($initial)
                        );

                        ?>

                    </span>

                </a>


                <!-- LOGOUT -->

                <a
                    href="/ssiss/auth/logout.php"
                    class="logout-link"
                >
                    Logout
                </a>


            <?php else: ?>


                <a
                    href="/ssiss/auth/login.php"
                    class="login-link"
                >
                    Login
                </a>

                <a
                    href="/ssiss/auth/signup.php"
                    class="primary-btn nav-signup"
                >
                    Sign Up
                </a>


            <?php endif; ?>


        </div>


        <!-- MOBILE MENU -->

        <button
            type="button"
            class="mobile-menu-btn"
            id="mobileMenuBtn"
            aria-label="Open navigation"
        >
            ☰
        </button>

    </nav>


    <!-- MOBILE NAV -->

    <div
        class="mobile-nav"
        id="mobileNav"
    >

        <a href="/ssiss/index.php">
            Home
        </a>

        <a href="/ssiss/marketplace/index.php">
            Shop
        </a>

        <a href="/ssiss/ai/index.php">
            AI Stylist
        </a>

        <a href="/ssiss/impact/index.php">
            Impact
        </a>

        <a href="/ssiss/donation/index.php">
            Donate
        </a>


        <?php if ($isLoggedIn): ?>

            <a href="/ssiss/profile/index.php">
                My Profile
            </a>

            <a href="/ssiss/impact/my-impact.php">
                My Impact
            </a>

            <a href="/ssiss/wallet/index.php">
                🪙 My Coins
            </a>

            <a href="/ssiss/auth/logout.php">
                Logout
            </a>

        <?php else: ?>

            <a href="/ssiss/auth/login.php">
                Login
            </a>

            <a href="/ssiss/auth/signup.php">
                Create Account
            </a>

        <?php endif; ?>

    </div>

</header>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const menuButton =
            document.getElementById(
                'mobileMenuBtn'
            );

        const mobileNav =
            document.getElementById(
                'mobileNav'
            );

        if (
            menuButton &&
            mobileNav
        ) {

            menuButton.addEventListener(
                'click',
                function () {

                    mobileNav.classList.toggle(
                        'open'
                    );

                }
            );

        }

    }
);

</script>
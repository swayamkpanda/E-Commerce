<footer class="site-footer">

    <div class="footer-container">


        <!-- BRAND -->

        <div class="footer-brand">

            <a
                href="/ssiss/index.php"
                class="footer-logo"
            >
                <span>✦</span>
                SSISS
            </a>

            <p>
                Style smarter. Shop better.
                Create impact.
            </p>

            <p class="footer-tagline">
                Fashion with a purpose.
            </p>

        </div>


        <!-- SHOP -->

        <div class="footer-column">

            <h3>
                Shop
            </h3>

            <a href="/ssiss/marketplace/index.php">
                All Products
            </a>

            <a href="/ssiss/marketplace/index.php?category=clothing">
                Clothing
            </a>

            <a href="/ssiss/marketplace/index.php?category=shoes">
                Shoes
            </a>

            <a href="/ssiss/marketplace/index.php?category=watches">
                Watches
            </a>

            <a href="/ssiss/marketplace/index.php?category=eyewear">
                Eyewear
            </a>

        </div>


        <!-- AI -->

        <div class="footer-column">

            <h3>
                AI Style
            </h3>

            <a href="/ssiss/ai/index.php">
                AI Stylist
            </a>

            <a href="/ssiss/ai/vibe.php">
                Vibe Dress
            </a>

            <a href="/ssiss/ai/recommend.php">
                Personalized Picks
            </a>

        </div>


        <!-- IMPACT -->

        <div class="footer-column">

            <h3>
                Impact
            </h3>

            <a href="/ssiss/donation/index.php">
                Donate
            </a>

            <a href="/ssiss/impact/index.php">
                Our Impact
            </a>

            <a href="/ssiss/impact/stories.php">
                Impact Stories
            </a>

            <?php if (isset($_SESSION['user_id'])): ?>

                <a href="/ssiss/impact/my-impact.php">
                    My Impact
                </a>

            <?php endif; ?>

        </div>


        <!-- ACCOUNT -->

        <div class="footer-column">

            <h3>
                Account
            </h3>

            <?php if (isset($_SESSION['user_id'])): ?>

                <a href="/ssiss/profile/index.php">
                    My Profile
                </a>

                <a href="/ssiss/orders/index.php">
                    My Orders
                </a>

                <a href="/ssiss/wallet/index.php">
                    SSISS Coins
                </a>

            <?php else: ?>

                <a href="/ssiss/auth/login.php">
                    Login
                </a>

                <a href="/ssiss/auth/signup.php">
                    Sign Up
                </a>

            <?php endif; ?>

        </div>

    </div>


    <!-- BOTTOM -->

    <div class="footer-bottom">

        <p>
            © <?= date('Y') ?> SSISS.
            All rights reserved.
        </p>

        <div class="footer-bottom-links">

            <a href="/ssiss/pages/privacy.php">
                Privacy
            </a>

            <a href="/ssiss/pages/terms.php">
                Terms
            </a>

            <a href="/ssiss/pages/contact.php">
                Contact
            </a>

        </div>

    </div>

</footer>
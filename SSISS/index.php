<?php
$pageTitle = "YFF | TRYANGLE";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <meta name="description"
        content="SSISS - AI powered fashion, personalized styling and sustainable shopping.">

    <title><?php echo $pageTitle; ?></title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet"
        href="assets/css/home.css">

</head>

<body>


    <!-- =========================
         NAVBAR
    ========================== -->

    <header class="navbar">

        <a href="index.php" class="logo">
            YFF<span></span>
        </a>


        <nav class="nav-links">

            <a href="#home">Home</a>

            <a href="shop/index.php">Shop</a>

        

            <a href="ai/index.php">
                AI Stylist
                <span class="sparkle">✦</span>
            </a>

            <a href="ai/vibe.php">Vibes</a>

           <a href="marketplace/index.php">Pre-Loved</a>

            <a href="impact/index.php">Impact</a>

            <a href="admin/index.php" class="admin-link">
            Admin
            </a>
        </nav>


        <div class="nav-actions">

            <button class="icon-btn">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>

            <a href="rewards/wallet.php" class="coin-btn">

                <span>🪙</span>

                <span class="coin-text">
                    0
                </span>

            </a>

            <a href="wishlist/index.php"
                class="icon-btn">

                <i class="fa-regular fa-heart"></i>

            </a>

            <a href="cart/index.php"
                class="icon-btn cart-icon">

                <i class="fa-solid fa-bag-shopping"></i>

                <span class="cart-count">0</span>

            </a>


            <a href="auth/login.php"
                class="profile-btn">

                <i class="fa-regular fa-user"></i>

            </a>

        </div>


        <!-- Mobile Menu -->

        <button class="mobile-menu"
            id="mobileMenu">

            <i class="fa-solid fa-bars"></i>

        </button>

    </header>



    <!-- =========================
         HERO SECTION
    ========================== -->

    <main id="home">


        <section class="hero">


            <!-- LEFT CONTENT -->

            <div class="hero-content">

                <p class="hero-tag">

                    <span class="tag-line"></span>

                    AI-POWERED PERSONAL STYLE

                </p>


                <h1>

                    WEAR YOUR

                    <span>VIBE.</span>

                    <br>

                    WE'LL FIND

                    <em>THE FIT.</em>

                </h1>


                <p class="hero-description">

                    Discover fashion that understands you.
                    Tell us your vibe, budget and style —
                    and let SSISS build your perfect look.

                </p>


                <div class="hero-buttons">

                    <a href="ai/stylist.php"
                        class="primary-btn">

                        <span>✨</span>

                        STYLE ME

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>


                    <a href="shop/index.php"
                        class="secondary-btn">

                        SHOP NOW

                    </a>

                </div>


                <!-- Stats -->

                <div class="hero-stats">

                    <div>

                        <strong>10K+</strong>

                        <span>Style Matches</span>

                    </div>


                    <div>

                        <strong>500+</strong>

                        <span>Fashion Pieces</span>

                    </div>


                    <div>

                        <strong>100%</strong>

                        <span>Your Vibe</span>

                    </div>

                </div>

            </div>



            <!-- RIGHT IMAGE -->

            <div class="hero-image">

                <div class="image-bg"></div>


                <img
                    src="./assets/images/banners/pramod.png"
                    alt="SSISS Fashion">


                <!-- Floating Card -->

                <div class="floating-card card-one">

                    <div class="card-icon">

                        ✨

                    </div>

                    <div>

                        <small>AI MATCH</small>

                        <strong>98% Your Style</strong>

                    </div>

                </div>



                <div class="floating-card card-two">

                    <span>🪙</span>

                    <div>

                        <small>SSISS REWARDS</small>

                        <strong>Earn While You Shop</strong>

                    </div>

                </div>

            </div>


            <!-- Scroll -->

            <div class="scroll-down">

                <span>SCROLL TO EXPLORE</span>

                <div class="scroll-line"></div>

            </div>


        </section>



        <!-- =========================
             VIBE SECTION
        ========================== -->

        <section class="vibe-section">

            <div class="section-header">

                <p class="section-tag">
                    FIND YOUR STYLE
                </p>

                <h2>
                    WHAT'S YOUR
                    <span>VIBE?</span>
                </h2>

                <p>

                    Every mood deserves a different outfit.

                </p>

            </div>


            <div class="vibe-grid">


                <a href="ai/vibe.php?vibe=streetwear"
                    class="vibe-card">

                    <img
                        src="./assets/images/banners/sohan.png"
                        alt="Streetwear">

                    <div class="vibe-overlay">

                        <span>01</span>

                        <h3>STREETWEAR</h3>

                    </div>

                </a>



                <a href="ai/vibe.php?vibe=old-money"
                    class="vibe-card">

                    <img
                        src="./assets/images/banners/IRISH.png"
                        alt="Old Money">

                    <div class="vibe-overlay">

                        <span>02</span>

                        <h3>OLD MONEY</h3>

                    </div>

                </a>



                <a href="ai/vibe.php?vibe=y2k"
                    class="vibe-card">

                    <img
                        src="./assets/images/banners/swayam.png"
                        alt="Y2K">

                    <div class="vibe-overlay">

                        <span>03</span>

                        <h3>Y2K</h3>

                    </div>

                </a>



                <a href="ai/vibe.php?vibe=minimal"
                    class="vibe-card">

                    <img
                        src="https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=600&q=80"
                        alt="Minimal">

                    <div class="vibe-overlay">

                        <span>04</span>

                        <h3>MINIMAL</h3>

                    </div>

                </a>


            </div>

        </section>



        <!-- =========================
             AI SECTION
        ========================== -->

        <section class="ai-section">

            <div class="ai-visual">

                <div class="ai-circle circle-one"></div>

                <div class="ai-circle circle-two"></div>


                <div class="ai-card">

                    <div class="ai-icon">

                        ✨

                    </div>

                    <h3>AI STYLIST</h3>

                    <p>
                        Building your perfect look...
                    </p>


                    <div class="ai-loading">

                        <span></span>

                        <span></span>

                        <span></span>

                    </div>

                </div>

            </div>


            <div class="ai-content">

                <p class="section-tag">
                    PERSONAL FASHION AI
                </p>


                <h2>

                    YOUR PERSONAL

                    <span>AI STYLIST.</span>

                </h2>


                <p>

                    Upload your photo or tell us your preferences.
                    Our AI recommends outfits based on your vibe,
                    budget, occasion and style.

                </p>


                <ul>

                    <li>

                        <i class="fa-solid fa-check"></i>

                        Personalized outfit recommendations

                    </li>


                    <li>

                        <i class="fa-solid fa-check"></i>

                        Matches your selected budget

                    </li>


                    <li>

                        <i class="fa-solid fa-check"></i>

                        Products directly from SSISS

                    </li>


                    <li>

                        <i class="fa-solid fa-check"></i>

                        Discover your unique Style DNA

                    </li>

                </ul>


                <a href="ai/stylist.php"
                    class="primary-btn">

                    TRY AI STYLIST

                    <i class="fa-solid fa-arrow-right"></i>

                </a>

            </div>

        </section>



        <!-- =========================
             SUSTAINABILITY
        ========================== -->

        <section class="impact-banner">


            <div class="impact-content">

                <p>♻️ FASHION WITH PURPOSE</p>


                <h2>

                    GIVE YOUR CLOTHES

                    <span>A SECOND LIFE.</span>

                </h2>


                <p class="impact-text">

                    Sell pre-loved fashion or donate clothes
                    to NGOs and earn SSISS Coins.

                </p>


                <div class="impact-buttons">

                    <a href="marketplace/sell.php">

                        SELL CLOTHES

                    </a>


                    <a href="donation/donate.php"
                        class="outline-light">

                        DONATE & EARN 🪙

                    </a>

                </div>

            </div>


            <div class="impact-stats">

                <div>

                    <strong>♻️ 12K+</strong>

                    <span>Items Reused</span>

                </div>


                <div>

                    <strong>❤️ 50+</strong>

                    <span>NGO Partners</span>

                </div>


                <div>

                    <strong>🪙 100K+</strong>

                    <span>Coins Earned</span>

                </div>

            </div>


        </section>


    </main>



    <!-- =========================
         FOOTER
    ========================== -->

    <footer class="footer">

        <div>

            <a href="index.php"
                class="footer-logo">

                SSI<span>SS</span>

            </a>

            <p>
                Wear your vibe.
                Find your fit.
                Make an impact.
            </p>

        </div>


        <div>

            <h4>EXPLORE</h4>

            <a href="shop/index.php">Shop</a>

            <a href="ai/index.php">AI Stylist</a>

            <a href="marketplace/index.php">Pre-Loved</a>

        </div>


        <div>

            <h4>IMPACT</h4>

            <a href="donation/index.php">Donate</a>

            <a href="impact/index.php">Our Impact</a>

            <a href="rewards/index.php">SSISS Coins</a>

        </div>


        <div>

            <h4>ACCOUNT</h4>

            <a href="auth/login.php">Login</a>

            <a href="auth/register.php">Create Account</a>

        </div>

    </footer>


    <!-- JavaScript -->

    <script src="assets/js/main.js"></script>

</body>

</html>
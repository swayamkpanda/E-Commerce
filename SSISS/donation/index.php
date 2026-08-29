<?php
session_start();

require_once "../config/database.php";
require_once "../includes/functions.php";

$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Donate | SSISS</title>

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/donation.css">
</head>

<body>

<?php include "../includes/navbar.php"; ?>

<main>

    <!-- HERO SECTION -->
    <section class="donation-hero">

        <div class="donation-hero-content">

            <span class="eyebrow">
                STYLE WITH PURPOSE
            </span>

            <h1>
                Give your clothes<br>
                <span>a second life.</span>
            </h1>

            <p>
                Donate clothes you no longer need and help someone
                who does. Every meaningful donation can also earn
                you SSISS Coins.
            </p>

            <div class="hero-buttons">

                <?php if ($isLoggedIn): ?>

                    <a href="donate.php" class="btn btn-primary">
                        Donate Now
                    </a>

                    <a href="sell-donate.php" class="btn btn-secondary">
                        Sell & Donate
                    </a>

                <?php else: ?>

                    <a href="../auth/login.php" class="btn btn-primary">
                        Login to Donate
                    </a>

                    <a href="../auth/register.php" class="btn btn-secondary">
                        Create Account
                    </a>

                <?php endif; ?>

            </div>

        </div>

        <div class="donation-hero-visual">

            <div class="impact-circle">
                <span>♻</span>
                <strong>SECOND</strong>
                <small>LIFE</small>
            </div>

        </div>

    </section>


    <!-- HOW IT WORKS -->
    <section class="donation-section">

        <div class="section-heading">

            <span class="eyebrow">
                HOW IT WORKS
            </span>

            <h2>
                Donate in four simple steps.
            </h2>

            <p>
                Turn unused clothes into meaningful impact.
            </p>

        </div>


        <div class="donation-steps">

            <div class="step-card">

                <div class="step-number">
                    01
                </div>

                <div class="step-icon">
                    👕
                </div>

                <h3>
                    Select Items
                </h3>

                <p>
                    Choose clothes, shoes, watches or other
                    eligible items you want to donate.
                </p>

            </div>


            <div class="step-card">

                <div class="step-number">
                    02
                </div>

                <div class="step-icon">
                    📸
                </div>

                <h3>
                    Upload Details
                </h3>

                <p>
                    Add photos and basic information about
                    your items.
                </p>

            </div>


            <div class="step-card">

                <div class="step-number">
                    03
                </div>

                <div class="step-icon">
                    🚚
                </div>

                <h3>
                    Schedule Pickup
                </h3>

                <p>
                    Choose a convenient pickup time and let
                    our partner NGO handle the rest.
                </p>

            </div>


            <div class="step-card">

                <div class="step-number">
                    04
                </div>

                <div class="step-icon">
                    🪙
                </div>

                <h3>
                    Earn Coins
                </h3>

                <p>
                    Once your donation is verified, receive
                    SSISS Coins that can be used for discounts.
                </p>

            </div>

        </div>

    </section>


    <!-- DONATION OPTIONS -->
    <section class="donation-section donation-options-section">

        <div class="section-heading">

            <span class="eyebrow">
                CHOOSE YOUR WAY
            </span>

            <h2>
                Make an impact your way.
            </h2>

        </div>


        <div class="donation-options">


            <!-- DIRECT DONATION -->
            <div class="donation-option-card">

                <div class="option-icon">
                    ❤️
                </div>

                <h3>
                    Donate Clothes
                </h3>

                <p>
                    Give your gently used clothes directly
                    to our partnered NGO network.
                </p>

                <a href="<?php echo $isLoggedIn
                    ? 'donate.php'
                    : '../auth/login.php'; ?>"
                   class="option-link">

                    Start Donation →

                </a>

            </div>


            <!-- SELL & DONATE -->
            <div class="donation-option-card featured">

                <span class="featured-label">
                    POPULAR
                </span>

                <div class="option-icon">
                    💰
                </div>

                <h3>
                    Sell & Donate
                </h3>

                <p>
                    Sell your pre-loved item and send all
                    or part of the proceeds to an NGO.
                </p>

                <a href="<?php echo $isLoggedIn
                    ? 'sell-donate.php'
                    : '../auth/login.php'; ?>"
                   class="option-link">

                    Sell & Donate →

                </a>

            </div>


            <!-- PICKUP -->
            <div class="donation-option-card">

                <div class="option-icon">
                    🚚
                </div>

                <h3>
                    Request Pickup
                </h3>

                <p>
                    Already packed your clothes?
                    Schedule a pickup from your doorstep.
                </p>

                <a href="<?php echo $isLoggedIn
                    ? 'request-pickup.php'
                    : '../auth/login.php'; ?>"
                   class="option-link">

                    Request Pickup →

                </a>

            </div>

        </div>

    </section>


    <!-- SSISS COINS -->
    <section class="coins-banner">

        <div class="coins-content">

            <span class="eyebrow">
                REWARD FOR DOING GOOD
            </span>

            <h2>
                Your kindness earns
                <span>SSISS Coins.</span>
            </h2>

            <p>
                Donate eligible items, help reduce textile waste
                and earn coins that you can use for discounts
                on SSISS.
            </p>

            <a href="../rewards/index.php" class="btn btn-light">
                Explore Rewards
            </a>

        </div>


        <div class="coin-display">

            <div class="coin">
                🪙
            </div>

            <strong>
                +100
            </strong>

            <span>
                SSISS COINS
            </span>

        </div>

    </section>


    <!-- IMPACT -->
    <section class="donation-section impact-preview">

        <div class="section-heading">

            <span class="eyebrow">
                YOUR IMPACT
            </span>

            <h2>
                Small actions. Real change.
            </h2>

        </div>


        <div class="impact-stats">

            <div class="impact-stat">

                <strong>
                    12K+
                </strong>

                <span>
                    Items Reused
                </span>

            </div>


            <div class="impact-stat">

                <strong>
                    2.8K KG
                </strong>

                <span>
                    Textile Waste Reduced
                </span>

            </div>


            <div class="impact-stat">

                <strong>
                    25+
                </strong>

                <span>
                    NGO Partners
                </span>

            </div>


            <div class="impact-stat">

                <strong>
                    4.8K+
                </strong>

                <span>
                    Donors
                </span>

            </div>

        </div>


        <div class="impact-link-wrapper">

            <a href="../impact/index.php" class="text-link">
                See our full impact →
            </a>

        </div>

    </section>


    <!-- CTA -->
    <section class="donation-cta">

        <div>

            <span class="eyebrow">
                READY TO MAKE A DIFFERENCE?
            </span>

            <h2>
                Your old clothes<br>
                could mean something new.
            </h2>

        </div>

        <div>

            <a href="<?php echo $isLoggedIn
                ? 'donate.php'
                : '../auth/register.php'; ?>"
               class="btn btn-primary">

                Start Donating →

            </a>

        </div>

    </section>

</main>


<?php include "../includes/footer.php"; ?>

<script src="../assets/js/main.js"></script>
<script src="../assets/js/donation.js"></script>

</body>
</html>

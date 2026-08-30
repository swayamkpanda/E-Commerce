    <?php

$pageTitle = "My Rewards Profile | SSISS";


/* =========================================
   TEMPORARY USER DATA

   Later this data will come from MySQL.
========================================= */

$userName = "Alex Johnson";

$userCoins = 250;

$userLevel = "Eco Explorer";

$nextLevel = "Style Guardian";

$coinsForNextLevel = 500;

$totalEarned = 500;

$totalSpent = 250;

$totalClothesDonated = 12;

$totalDonations = 5;

$memberSince = "January 2026";


/* =========================================
   LEVEL PROGRESS
========================================= */

$progressPercentage =
    ($userCoins / $coinsForNextLevel) * 100;


if ($progressPercentage > 100) {

    $progressPercentage = 100;

}


/* =========================================
   USER BADGES

   Later these can come from MySQL.
========================================= */

$badges = [

    [
        "name" => "First Donation",
        "description" =>
            "Made your first clothing donation.",
        "icon" => "fa-heart",
        "status" => "unlocked"
    ],

    [
        "name" => "Eco Contributor",
        "description" =>
            "Donated more than 10 clothing items.",
        "icon" => "fa-shirt",
        "status" => "unlocked"
    ],

    [
        "name" => "Coin Collector",
        "description" =>
            "Earned more than 500 SSISS Coins.",
        "icon" => "fa-coins",
        "status" => "unlocked"
    ],

    [
        "name" => "Fashion Hero",
        "description" =>
            "Donate 25 clothing items.",
        "icon" => "fa-crown",
        "status" => "locked"
    ]

];


/* =========================================
   PROFILE ACHIEVEMENTS
========================================= */

$achievements = [

    [
        "title" => "Clothes Given a Second Life",
        "value" => $totalClothesDonated,
        "label" => "ITEMS",
        "icon" => "fa-recycle"
    ],

    [
        "title" => "Donations Completed",
        "value" => $totalDonations,
        "label" => "DONATIONS",
        "icon" => "fa-handshake"
    ],

    [
        "title" => "SSISS Coins Earned",
        "value" => $totalEarned,
        "label" => "COINS",
        "icon" => "fa-coins"
    ]

];

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

        <?php
        echo htmlspecialchars($pageTitle);
        ?>

    </title>


    <!-- GOOGLE FONTS -->

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet"
    >


    <!-- FONT AWESOME -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    >


    <!-- CSS -->

    <link
        rel="stylesheet"
        href="../assets/css/home.css"
    >

    <link
        rel="stylesheet"
        href="../assets/css/reward.css"
    >


</head>


<body>


<!-- =========================================
     NAVBAR
========================================= -->

<header class="navbar">


    <a
        href="../index.php"
        class="logo"
    >

        SSI<span>SS</span>

    </a>


    <nav class="nav-links">


        <a href="../index.php">

            Home

        </a>


        <a href="../shop/index.php">

            Shop

        </a>


        <a href="../ai/index.php">

            AI Stylist

            <span class="sparkle">
                ✦
            </span>

        </a>


        <a href="../wardrobe/index.php">

            Wardrobe

        </a>


        <a href="../marketplace/index.php">

            Pre-Loved

        </a>


        <a href="../impact/index.php">

            Impact

        </a>


    </nav>


    <div class="nav-actions">


        <a
            href="../shop/search.php"
            class="icon-btn"
        >

            <i class="fa-solid fa-magnifying-glass"></i>

        </a>


        <a
            href="../wishlist/index.php"
            class="icon-btn"
        >

            <i class="fa-regular fa-heart"></i>

        </a>


        <a
            href="../cart/index.php"
            class="icon-btn"
        >

            <i class="fa-solid fa-bag-shopping"></i>

        </a>


        <a
            href="../auth/login.php"
            class="profile-btn"
        >

            <i class="fa-regular fa-user"></i>

        </a>


    </div>


</header>



<!-- =========================================
     REWARD PROFILE PAGE
========================================= -->

<main class="reward-profile-page">


    <!-- PAGE HEADER -->

    <section class="profile-header">


        <a
            href="index.php"
            class="back-rewards"
        >

            <i class="fa-solid fa-arrow-left"></i>

            BACK TO REWARDS

        </a>


        <p class="section-tag">

            YOUR SUSTAINABLE JOURNEY

        </p>


        <h1>

            REWARD

            <span>PROFILE.</span>

        </h1>


        <p>

            Track your progress, unlock badges,
            and see the positive impact you are
            making through sustainable fashion.

        </p>


    </section>



    <!-- =====================================
         USER PROFILE CARD
    ====================================== -->

    <section class="reward-user-card">


        <div class="reward-user-main">


            <div class="reward-avatar">

                <i class="fa-solid fa-user"></i>

            </div>


            <div class="reward-user-info">


                <p>

                    SSISS MEMBER

                </p>


                <h2>

                    <?php
                    echo htmlspecialchars($userName);
                    ?>

                </h2>


                <span>

                    Member since

                    <?php
                    echo htmlspecialchars($memberSince);
                    ?>

                </span>


            </div>


        </div>


        <a
            href="../profile/index.php"
            class="edit-profile-btn"
        >

            <i class="fa-solid fa-pen"></i>

            EDIT PROFILE

        </a>


    </section>



    <!-- =====================================
         CURRENT LEVEL
    ====================================== -->

    <section class="reward-level-card">


        <div class="level-top">


            <div class="level-icon">

                <i class="fa-solid fa-leaf"></i>

            </div>


            <div class="level-info">


                <span>

                    CURRENT LEVEL

                </span>


                <h2>

                    <?php
                    echo htmlspecialchars($userLevel);
                    ?>

                </h2>


            </div>


            <div class="level-coins">


                <strong>

                    🪙

                    <?php
                    echo $userCoins;
                    ?>

                </strong>


                <span>

                    SSISS COINS

                </span>


            </div>


        </div>


        <!-- PROGRESS -->


        <div class="level-progress-section">


            <div class="level-progress-info">


                <span>

                    Progress to

                    <strong>

                        <?php
                        echo htmlspecialchars(
                            $nextLevel
                        );
                        ?>

                    </strong>

                </span>


                <span>

                    <?php
                    echo $userCoins;
                    ?>

                    /

                    <?php
                    echo $coinsForNextLevel;
                    ?>

                    COINS

                </span>


            </div>


            <div class="progress-bar">


                <div
                    class="progress-fill"
                    style="
                        width:
                        <?php
                        echo $progressPercentage;
                        ?>
                        %"
                    
                ></div>


            </div>


            <p>

                Earn

                <strong>

                    <?php
                    echo
                        $coinsForNextLevel -
                        $userCoins;
                    ?>

                    more coins

                </strong>

                to reach

                <?php
                echo htmlspecialchars(
                    $nextLevel
                );
                ?>

                level.

            </p>


        </div>


    </section>



    <!-- =====================================
         ACHIEVEMENTS
    ====================================== -->

    <section class="profile-achievements-section">


        <div class="section-heading">


            <div>


                <p class="section-tag">

                    YOUR IMPACT

                </p>


                <h2>

                    JOURNEY

                    <span>STATS.</span>

                </h2>


            </div>


        </div>


        <div class="achievement-grid">


            <?php foreach ($achievements as $achievement): ?>


                <article class="achievement-card">


                    <div class="achievement-icon">


                        <i
                            class="fa-solid <?php
                            echo htmlspecialchars(
                                $achievement["icon"]
                            );
                            ?>"
                        ></i>


                    </div>


                    <strong>

                        <?php
                        echo $achievement["value"];
                        ?>

                    </strong>


                    <span>

                        <?php
                        echo htmlspecialchars(
                            $achievement["label"]
                        );
                        ?>

                    </span>


                    <p>

                        <?php
                        echo htmlspecialchars(
                            $achievement["title"]
                        );
                        ?>

                    </p>


                </article>


            <?php endforeach; ?>


        </div>


    </section>



    <!-- =====================================
         BADGES
    ====================================== -->

    <section class="profile-badges-section">


        <div class="section-heading">


            <div>


                <p class="section-tag">

                    ACHIEVEMENTS

                </p>


                <h2>

                    MY

                    <span>BADGES.</span>

                </h2>


            </div>


        </div>


        <div class="badges-grid">


            <?php foreach ($badges as $badge): ?>


                <article
                    class="badge-card
                    <?php
                    echo htmlspecialchars(
                        $badge["status"]
                    );
                    ?>"
                >


                    <div class="badge-icon">


                        <i
                            class="fa-solid <?php
                            echo htmlspecialchars(
                                $badge["icon"]
                            );
                            ?>"
                        ></i>


                    </div>


                    <h3>

                        <?php
                        echo htmlspecialchars(
                            $badge["name"]
                        );
                        ?>

                    </h3>


                    <p>

                        <?php
                        echo htmlspecialchars(
                            $badge["description"]
                        );
                        ?>

                    </p>


                    <?php
                    if (
                        $badge["status"] ===
                        "locked"
                    ):
                    ?>


                        <span class="locked-badge">

                            <i class="fa-solid fa-lock"></i>

                            LOCKED

                        </span>


                    <?php else: ?>


                        <span class="unlocked-badge">

                            <i class="fa-solid fa-check"></i>

                            UNLOCKED

                        </span>


                    <?php endif; ?>


                </article>


            <?php endforeach; ?>


        </div>


    </section>



    <!-- =====================================
         QUICK LINKS
    ====================================== -->

    <section class="profile-reward-actions">


        <a
            href="wallet.php"
            class="profile-action-card"
        >

            <i class="fa-solid fa-wallet"></i>


            <div>

                <h3>

                    MY WALLET

                </h3>


                <p>

                    View your coins and rewards.

                </p>


            </div>


            <i class="fa-solid fa-arrow-right"></i>


        </a>



        <a
            href="history.php"
            class="profile-action-card"
        >

            <i class="fa-solid fa-clock-rotate-left"></i>


            <div>

                <h3>

                    REWARD HISTORY

                </h3>


                <p>

                    View all your transactions.

                </p>


            </div>


            <i class="fa-solid fa-arrow-right"></i>


        </a>



        <a
            href="redeem.php"
            class="profile-action-card"
        >

            <i class="fa-solid fa-gift"></i>


            <div>

                <h3>

                    REDEEM REWARDS

                </h3>


                <p>

                    Turn your coins into benefits.

                </p>


            </div>


            <i class="fa-solid fa-arrow-right"></i>


        </a>


    </section>



    <!-- =====================================
         CTA
    ====================================== -->

    <section class="profile-earn-cta">


        <div>


            <p class="section-tag">

                KEEP GROWING

            </p>


            <h2>

                MAKE MORE IMPACT.

                <span>EARN MORE.</span>

            </h2>


            <p>

                Donate clothes, reduce fashion waste,
                and unlock more rewards and badges.

            </p>


        </div>


        <a
            href="earn.php"
            class="generate-outfit-main-btn"
        >

            <i class="fa-solid fa-coins"></i>

            EARN SSISS COINS

        </a>


    </section>


</main>


<!-- JAVASCRIPT -->

<script src="../assets/js/reward.js"></script>


</body>

</html>
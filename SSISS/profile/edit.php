<?php

$pageTitle = "Edit Rewards Profile | SSISS";


/* =========================================
   TEMPORARY USER DATA

   Later this data will come from MySQL.
========================================= */

$userName = "Alex Johnson";

$userEmail = "alex@example.com";

$userLevel = "Eco Explorer";

$memberSince = "January 2026";


/* =========================================
   SUCCESS MESSAGE
========================================= */

$successMessage = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $userName = trim($_POST["user_name"]);

    $userEmail = trim($_POST["user_email"]);


    $successMessage =
        "Your rewards profile has been updated successfully.";

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
            <span class="sparkle">✦</span>
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
     EDIT PROFILE PAGE
========================================= -->

<main class="reward-edit-page">


    <!-- PAGE HEADER -->

    <section class="edit-profile-header">


        <a
            href="profile.php"
            class="back-rewards"
        >

            <i class="fa-solid fa-arrow-left"></i>

            BACK TO PROFILE

        </a>


        <p class="section-tag">

            PERSONALIZE YOUR EXPERIENCE

        </p>


        <h1>

            EDIT REWARD

            <span>PROFILE.</span>

        </h1>


        <p>

            Update your profile information and
            personalize your SSISS rewards experience.

        </p>


    </section>



    <!-- SUCCESS MESSAGE -->

    <?php if (!empty($successMessage)): ?>


        <div class="profile-success-message">


            <i class="fa-solid fa-circle-check"></i>


            <?php
            echo htmlspecialchars(
                $successMessage
            );
            ?>


        </div>


    <?php endif; ?>



    <!-- =====================================
         EDIT PROFILE FORM
    ====================================== -->

    <section class="edit-profile-container">


        <form
            method="POST"
            action="edit.php"
            class="edit-profile-form"
        >


            <!-- PROFILE IMAGE -->


            <div class="edit-avatar-section">


                <div class="edit-avatar">


                    <i class="fa-solid fa-user"></i>


                </div>


                <div>


                    <h3>

                        PROFILE PHOTO

                    </h3>


                    <p>

                        Your profile photo will be
                        used across your SSISS account.

                    </p>


                    <!-- Later this can support image upload -->

                    <button
                        type="button"
                        class="change-photo-btn"
                    >

                        <i class="fa-solid fa-camera"></i>

                        CHANGE PHOTO

                    </button>


                </div>


            </div>



            <!-- PERSONAL INFORMATION -->


            <div class="form-section">


                <h2>

                    PERSONAL INFORMATION

                </h2>


                <div class="form-grid">


                    <!-- NAME -->


                    <div class="form-group">


                        <label for="user_name">

                            FULL NAME

                        </label>


                        <input
                            type="text"
                            id="user_name"
                            name="user_name"
                            value="<?php
                            echo htmlspecialchars(
                                $userName
                            );
                            ?>"
                            required
                        >


                    </div>



                    <!-- EMAIL -->


                    <div class="form-group">


                        <label for="user_email">

                            EMAIL ADDRESS

                        </label>


                        <input
                            type="email"
                            id="user_email"
                            name="user_email"
                            value="<?php
                            echo htmlspecialchars(
                                $userEmail
                            );
                            ?>"
                            required
                        >


                    </div>


                </div>


            </div>



            <!-- REWARD INFORMATION -->


            <div class="form-section">


                <h2>

                    REWARD INFORMATION

                </h2>


                <div class="reward-info-grid">


                    <div class="reward-info-box">


                        <i class="fa-solid fa-leaf"></i>


                        <div>


                            <span>

                                CURRENT LEVEL

                            </span>


                            <strong>

                                <?php
                                echo htmlspecialchars(
                                    $userLevel
                                );
                                ?>

                            </strong>


                        </div>


                    </div>



                    <div class="reward-info-box">


                        <i class="fa-solid fa-calendar"></i>


                        <div>


                            <span>

                                MEMBER SINCE

                            </span>


                            <strong>

                                <?php
                                echo htmlspecialchars(
                                    $memberSince
                                );
                                ?>

                            </strong>


                        </div>


                    </div>


                </div>


            </div>



            <!-- PREFERENCES -->


            <div class="form-section">


                <h2>

                    REWARD PREFERENCES

                </h2>


                <p class="form-section-description">

                    Choose what type of reward updates
                    you would like to receive.

                </p>


                <div class="preference-options">


                    <label class="preference-option">


                        <input
                            type="checkbox"
                            name="notifications[]"
                            value="reward_updates"
                            checked
                        >


                        <span>


                            <i class="fa-solid fa-gift"></i>


                            <span>


                                <strong>

                                    Reward Updates

                                </strong>


                                <small>

                                    Get notified about new rewards.

                                </small>


                            </span>


                        </span>


                    </label>



                    <label class="preference-option">


                        <input
                            type="checkbox"
                            name="notifications[]"
                            value="donation_updates"
                            checked
                        >


                        <span>


                            <i class="fa-solid fa-heart"></i>


                            <span>


                                <strong>

                                    Donation Updates

                                </strong>


                                <small>

                                    Track your donation verification.

                                </small>


                            </span>


                        </span>


                    </label>



                    <label class="preference-option">


                        <input
                            type="checkbox"
                            name="notifications[]"
                            value="eco_challenges"
                        >


                        <span>


                            <i class="fa-solid fa-leaf"></i>


                            <span>


                                <strong>

                                    Eco Challenges

                                </strong>


                                <small>

                                    Receive sustainable fashion challenges.

                                </small>


                            </span>


                        </span>


                    </label>


                </div>


            </div>



            <!-- FORM ACTIONS -->


            <div class="edit-form-actions">


                <a
                    href="profile.php"
                    class="cancel-edit-btn"
                >

                    CANCEL

                </a>


                <button
                    type="submit"
                    class="save-profile-btn"
                >

                    <i class="fa-solid fa-floppy-disk"></i>

                    SAVE CHANGES

                </button>


            </div>


        </form>


    </section>


</main>


<!-- JAVASCRIPT -->

<script src="../assets/js/reward.js"></script>


</body>

</html>
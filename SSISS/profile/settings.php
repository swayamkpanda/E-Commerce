<?php

$pageTitle = "Settings | SSISS";

$successMessage = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $successMessage =
        "Your account settings have been updated.";

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

    <title><?php echo $pageTitle; ?></title>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    >

    <link
        rel="stylesheet"
        href="../assets/css/home.css"
    >

    <link
        rel="stylesheet"
        href="../assets/css/profile.css"
    >

</head>


<body>

<header class="navbar">

    <a href="../index.php" class="logo">
        SSI<span>SS</span>
    </a>

    <nav class="nav-links">

        <a href="../index.php">Home</a>
        <a href="../shop/index.php">Shop</a>
        <a href="../ai/index.php">AI Stylist ✦</a>
        <a href="../wardrobe/index.php">Wardrobe</a>
        <a href="../marketplace/index.php">Pre-Loved</a>
        <a href="../impact/index.php">Impact</a>

    </nav>

</header>



<main class="settings-page">

    <section class="profile-page-header">

        <a href="index.php" class="back-profile">

            <i class="fa-solid fa-arrow-left"></i>

            BACK TO PROFILE

        </a>


        <p class="section-tag">
            ACCOUNT CONTROL
        </p>


        <h1>
            ACCOUNT <span>SETTINGS.</span>
        </h1>


        <p>
            Manage your notifications,
            privacy and account preferences.
        </p>

    </section>



    <?php if ($successMessage): ?>

        <div class="profile-success-message">

            <i class="fa-solid fa-circle-check"></i>

            <?php echo $successMessage; ?>

        </div>

    <?php endif; ?>



    <form method="POST" class="settings-form">


        <section class="settings-group">

            <h2>
                NOTIFICATIONS
            </h2>


            <label class="settings-toggle">

                <span>

                    <strong>
                        Order Updates
                    </strong>

                    <small>
                        Receive updates about
                        your orders and deliveries.
                    </small>

                </span>

                <input
                    type="checkbox"
                    name="orders"
                    checked
                >

            </label>



            <label class="settings-toggle">

                <span>

                    <strong>
                        AI Style Recommendations
                    </strong>

                    <small>
                        Get personalized style
                        suggestions and recommendations.
                    </small>

                </span>

                <input
                    type="checkbox"
                    name="ai_recommendations"
                    checked
                >

            </label>



            <label class="settings-toggle">

                <span>

                    <strong>
                        Rewards & SSISS Coins
                    </strong>

                    <small>
                        Get notified about rewards,
                        challenges and new coins.
                    </small>

                </span>

                <input
                    type="checkbox"
                    name="rewards"
                    checked
                >

            </label>

        </section>



        <section class="settings-group">

            <h2>
                PRIVACY
            </h2>


            <label class="settings-toggle">

                <span>

                    <strong>
                        Personalized Recommendations
                    </strong>

                    <small>
                        Allow SSISS to use your
                        preferences for recommendations.
                    </small>

                </span>

                <input
                    type="checkbox"
                    name="personalization"
                    checked
                >

            </label>



            <label class="settings-toggle">

                <span>

                    <strong>
                        Profile Visibility
                    </strong>

                    <small>
                        Allow other marketplace users
                        to see your seller profile.
                    </small>

                </span>

                <input
                    type="checkbox"
                    name="visibility"
                >

            </label>

        </section>



        <section class="settings-group danger-zone">

            <h2>
                DANGER ZONE
            </h2>


            <div class="danger-setting">

                <div>

                    <strong>
                        Delete Account
                    </strong>

                    <p>
                        Permanently delete your
                        SSISS account and data.
                    </p>

                </div>


                <button
                    type="button"
                    class="delete-account-btn"
                >

                    DELETE ACCOUNT

                </button>

            </div>

        </section>



        <div class="profile-form-actions">

            <a
                href="index.php"
                class="cancel-edit-btn"
            >
                CANCEL
            </a>


            <button
                type="submit"
                class="save-profile-btn"
            >

                <i class="fa-solid fa-floppy-disk"></i>

                SAVE SETTINGS

            </button>

        </div>

    </form>

</main>


<script src="../assets/js/profile.js"></script>

</body>
</html>
<?php

$pageTitle = "Preferences | SSISS";

$successMessage = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $successMessage =
        "Your preferences have been saved successfully.";

}


$styles = [
    "Casual",
    "Minimal",
    "Streetwear",
    "Formal",
    "Vintage",
    "Sporty"
];


$occasions = [
    "College",
    "Work",
    "Party",
    "Travel",
    "Casual Outings",
    "Special Events"
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

</header>



<main class="preferences-page">

    <section class="profile-page-header">

        <a href="index.php" class="back-profile">

            <i class="fa-solid fa-arrow-left"></i>

            BACK TO PROFILE

        </a>


        <p class="section-tag">
            PERSONALIZATION
        </p>


        <h1>
            MY <span>PREFERENCES.</span>
        </h1>


        <p>
            Help SSISS and your AI Stylist
            understand your fashion taste better.
        </p>

    </section>



    <?php if ($successMessage): ?>

        <div class="profile-success-message">

            <i class="fa-solid fa-circle-check"></i>

            <?php echo $successMessage; ?>

        </div>

    <?php endif; ?>



    <form
        method="POST"
        class="preferences-form"
    >


        <section class="preference-section">

            <h2>
                FASHION <span>STYLE.</span>
            </h2>


            <p>
                Select the styles you enjoy.
            </p>


            <div class="preference-chip-grid">

                <?php foreach ($styles as $style): ?>

                    <label class="preference-chip">

                        <input
                            type="checkbox"
                            name="styles[]"
                            value="<?php echo htmlspecialchars($style); ?>"
                        >

                        <span>
                            <?php echo htmlspecialchars($style); ?>
                        </span>

                    </label>

                <?php endforeach; ?>

            </div>

        </section>



        <section class="preference-section">

            <h2>
                FAVORITE <span>OCCASIONS.</span>
            </h2>


            <p>
                Tell us where you usually need outfits.
            </p>


            <div class="preference-chip-grid">

                <?php foreach ($occasions as $occasion): ?>

                    <label class="preference-chip">

                        <input
                            type="checkbox"
                            name="occasions[]"
                            value="<?php echo htmlspecialchars($occasion); ?>"
                        >

                        <span>
                            <?php echo htmlspecialchars($occasion); ?>
                        </span>

                    </label>

                <?php endforeach; ?>

            </div>

        </section>



        <section class="preference-section">

            <h2>
                BUDGET <span>PREFERENCE.</span>
            </h2>


            <div class="form-group">

                <label for="budget">
                    PREFERRED BUDGET RANGE
                </label>


                <select
                    id="budget"
                    name="budget"
                >

                    <option value="low">
                        Budget Friendly
                    </option>

                    <option value="medium">
                        Mid Range
                    </option>

                    <option value="premium">
                        Premium
                    </option>

                    <option value="luxury">
                        Luxury
                    </option>

                </select>

            </div>

        </section>



        <section class="preference-section">

            <h2>
                SUSTAINABILITY <span>GOALS.</span>
            </h2>


            <label class="settings-toggle">

                <span>

                    <strong>
                        Prefer Sustainable Products
                    </strong>

                    <small>
                        Prioritize eco-friendly products
                        in recommendations.
                    </small>

                </span>

                <input
                    type="checkbox"
                    name="sustainable"
                    checked
                >

            </label>


            <label class="settings-toggle">

                <span>

                    <strong>
                        Show Pre-Loved Options
                    </strong>

                    <small>
                        Include second-hand fashion
                        in recommendations.
                    </small>

                </span>

                <input
                    type="checkbox"
                    name="preloved"
                    checked
                >

            </label>

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

                SAVE PREFERENCES

            </button>

        </div>

    </form>

</main>


<script src="../assets/js/profile.js"></script>

</body>
</html>
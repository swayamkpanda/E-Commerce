<?php

session_start();

/*
|--------------------------------------------------------------------------
| YFF AI - WHAT SUITS ME?
|--------------------------------------------------------------------------
| User uploads a photo and receives fashion recommendations.
|
| Current version:
| - PHP only
| - Upload validation
| - Demo AI result
|
| Later:
| - AI Vision API
| - MySQL user profile
| - Product matching
|--------------------------------------------------------------------------
*/

$userName = $_SESSION['user_name'] ?? 'Fashion Lover';


// ==========================================================
// VARIABLES
// ==========================================================

$uploaded = false;

$error = '';

$photoName = '';

$photoPath = '';

$gender = '';

$occasion = '';

$budget = '';

$style = '';


// ==========================================================
// ALLOWED FILE TYPES
// ==========================================================

$allowedTypes = [

    'image/jpeg',
    'image/png',
    'image/webp'

];


// ==========================================================
// HANDLE UPLOAD
// ==========================================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $gender = $_POST['gender'] ?? '';

    $occasion = $_POST['occasion'] ?? '';

    $budget = $_POST['budget'] ?? '';

    $style = $_POST['style'] ?? '';


    // ------------------------------------------------------
    // Check photo
    // ------------------------------------------------------

    if (
        !isset($_FILES['photo']) ||
        $_FILES['photo']['error'] !== UPLOAD_ERR_OK
    ) {

        $error =
            'Please select a valid photo.';

    } else {

        $photo = $_FILES['photo'];


        // --------------------------------------------------
        // Check MIME type
        // --------------------------------------------------

        $fileType =
            mime_content_type(
                $photo['tmp_name']
            );


        if (
            !in_array(
                $fileType,
                $allowedTypes
            )
        ) {

            $error =
                'Only JPG, PNG and WEBP images are allowed.';

        }


        // --------------------------------------------------
        // Check file size
        // --------------------------------------------------

        if (
            $photo['size'] > 5 * 1024 * 1024
        ) {

            $error =
                'Image must be smaller than 5 MB.';

        }


        // --------------------------------------------------
        // Save image
        // --------------------------------------------------

        if ($error === '') {

            $uploadDirectory =
                '../uploads/ai/';


            if (
                !is_dir(
                    $uploadDirectory
                )
            ) {

                mkdir(
                    $uploadDirectory,
                    0777,
                    true
                );

            }


            $extension =
                strtolower(
                    pathinfo(
                        $photo['name'],
                        PATHINFO_EXTENSION
                    )
                );


            $newFileName =
                'style_' .
                time() .
                '_' .
                bin2hex(
                    random_bytes(4)
                ) .
                '.' .
                $extension;


            $destination =
                $uploadDirectory .
                $newFileName;


            if (
                move_uploaded_file(
                    $photo['tmp_name'],
                    $destination
                )
            ) {

                $uploaded = true;

                $photoName =
                    $newFileName;

                $photoPath =
                    $destination;

            } else {

                $error =
                    'Unable to save the uploaded image.';

            }

        }

    }

}


// ==========================================================
// DEMO AI ANALYSIS
// ==========================================================

$analysis = null;


if ($uploaded) {

    $analysis = [

        'style' => 'Smart Casual',

        'palette' => [
            'Black',
            'White',
            'Navy',
            'Beige'
        ],

        'recommendation' =>
            'Your uploaded photo has been received. Based on the selected preferences, YFF recommends clean, versatile pieces with a balanced silhouette.',

        'top' => [
            'name' =>
                'Premium Relaxed Fit Shirt',
            'price' =>
                899
        ],

        'bottom' => [
            'name' =>
                'Straight Fit Trousers',
            'price' =>
                1099
        ],

        'shoes' => [
            'name' =>
                'Minimal White Sneakers',
            'price' =>
                1299
        ],

        'accessory' => [
            'name' =>
                'Classic Minimal Watch',
            'price' =>
                799
        ]

    ];

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
        What Suits Me? | YFF AI
    </title>

</head>


<body>


<!-- =========================================================
     HEADER
========================================================= -->

<header>

    <h1>
        📸 What Suits Me?
    </h1>


    <p>

        Welcome,
        <?= htmlspecialchars(
            $userName
        ); ?>

        👋

    </p>


    <p>
        Upload your photo and discover your personalized style.
    </p>

</header>


<hr>


<!-- =========================================================
     INTRO
========================================================= -->

<section>

    <h2>
        ✨ Let AI Discover Your Style
    </h2>


    <p>
        Upload a clear photo and YFF AI will eventually
        analyze your style preferences and recommend
        suitable fashion products.
    </p>


    <ul>

        <li>
            📸 Upload your photo
        </li>

        <li>
            🎨 Discover suitable colours
        </li>

        <li>
            👕 Get outfit recommendations
        </li>

        <li>
            👟 Find matching shoes
        </li>

        <li>
            ⌚ Find matching accessories
        </li>

        <li>
            🛍️ Shop the recommended products
        </li>

    </ul>

</section>


<hr>


<!-- =========================================================
     ERROR
========================================================= -->

<?php if ($error !== ''): ?>

    <section>

        <h3>
            ⚠️ Upload Error
        </h3>

        <p>

            <?= htmlspecialchars(
                $error
            ); ?>

        </p>

    </section>

    <hr>

<?php endif; ?>


<!-- =========================================================
     UPLOAD FORM
========================================================= -->

<section>

    <h2>
        1. Upload Your Photo
    </h2>


    <form
        method="POST"
        action="suits-me.php"
        enctype="multipart/form-data"
    >


        <div>

            <label for="photo">

                <strong>
                    Choose Photo:
                </strong>

            </label>


            <br><br>


            <input
                type="file"
                id="photo"
                name="photo"
                accept="image/jpeg,image/png,image/webp"
                required
            >


            <p>
                JPG, PNG or WEBP • Maximum 5 MB
            </p>

        </div>


        <hr>


        <!-- =================================================
             GENDER
        ================================================== -->

        <h2>
            2. Who Are We Styling?
        </h2>


        <select
            name="gender"
            required
        >

            <option value="">
                Select
            </option>

            <option value="men">
                Men
            </option>

            <option value="women">
                Women
            </option>

            <option value="unisex">
                Unisex
            </option>

        </select>


        <hr>


        <!-- =================================================
             OCCASION
        ================================================== -->

        <h2>
            3. What Are You Dressing For?
        </h2>


        <select
            name="occasion"
            required
        >

            <option value="">
                Select Occasion
            </option>

            <option value="college">
                College
            </option>

            <option value="casual">
                Casual Outing
            </option>

            <option value="date">
                Date
            </option>

            <option value="party">
                Party
            </option>

            <option value="wedding">
                Wedding
            </option>

            <option value="interview">
                Interview
            </option>

            <option value="festival">
                Festival
            </option>

            <option value="travel">
                Travel
            </option>

            <option value="business">
                Business
            </option>

        </select>


        <hr>


        <!-- =================================================
             BUDGET
        ================================================== -->

        <h2>
            4. Your Budget
        </h2>


        <select
            name="budget"
            required
        >

            <option value="">
                Select Budget
            </option>

            <option value="1000">
                Under ₹1,000
            </option>

            <option value="2000">
                ₹1,000 - ₹2,000
            </option>

            <option value="3000">
                ₹2,000 - ₹3,000
            </option>

            <option value="5000">
                ₹3,000 - ₹5,000
            </option>

            <option value="10000">
                ₹5,000 - ₹10,000
            </option>

            <option value="10000-plus">
                ₹10,000+
            </option>

        </select>


        <hr>


        <!-- =================================================
             STYLE
        ================================================== -->

        <h2>
            5. Your Preferred Style
        </h2>


        <select
            name="style"
        >

            <option value="">
                Let AI Decide
            </option>

            <option value="casual">
                Casual
            </option>

            <option value="streetwear">
                Streetwear
            </option>

            <option value="minimal">
                Minimal
            </option>

            <option value="old-money">
                Old Money
            </option>

            <option value="formal">
                Formal
            </option>

            <option value="party">
                Party
            </option>

            <option value="sporty">
                Sporty
            </option>

            <option value="korean">
                Korean
            </option>

            <option value="y2k">
                Y2K
            </option>

            <option value="traditional">
                Traditional
            </option>

        </select>


        <br><br>


        <button
            type="submit"
        >

            ✨ Analyze My Style

        </button>


    </form>

</section>


<hr>


<!-- =========================================================
     UPLOADED PHOTO
========================================================= -->

<?php if ($uploaded): ?>


<section>

    <h2>
        📸 Your Photo
    </h2>


    <p>

        Uploaded successfully:

        <strong>

            <?= htmlspecialchars(
                $photoName
            ); ?>

        </strong>

    </p>


    <img
        src="<?= htmlspecialchars(
            $photoPath
        ); ?>"
        alt="Uploaded style photo"
        width="300"
    >


</section>


<hr>


<!-- =========================================================
     DEMO AI ANALYSIS
========================================================= -->

<section>

    <h2>
        🤖 AI Style Analysis
    </h2>


    <p>

        <strong>
            Detected Style:
        </strong>

        <?= htmlspecialchars(
            $analysis['style']
        ); ?>

    </p>


    <p>

        <?= htmlspecialchars(
            $analysis['recommendation']
        ); ?>

    </p>


    <h3>
        🎨 Recommended Colour Palette
    </h3>


    <ul>

        <?php foreach (
            $analysis['palette']
            as $colour
        ): ?>

            <li>

                <?= htmlspecialchars(
                    $colour
                ); ?>

            </li>

        <?php endforeach; ?>

    </ul>


</section>


<hr>


<!-- =========================================================
     PRODUCT RECOMMENDATIONS
========================================================= -->

<section>

    <h2>
        🛍️ Products That May Suit You
    </h2>


    <!-- TOP -->

    <article>

        <h3>
            👕 <?= htmlspecialchars(
                $analysis['top']['name']
            ); ?>
        </h3>


        <p>

            ₹<?= number_format(
                $analysis['top']['price']
            ); ?>

        </p>


        <button
            type="button"
            onclick="alert('Real product will come from MySQL later.')"
        >
            View Product
        </button>

    </article>


    <br>


    <!-- BOTTOM -->

    <article>

        <h3>
            👖 <?= htmlspecialchars(
                $analysis['bottom']['name']
            ); ?>
        </h3>


        <p>

            ₹<?= number_format(
                $analysis['bottom']['price']
            ); ?>

        </p>


        <button
            type="button"
            onclick="alert('Real product will come from MySQL later.')"
        >
            View Product
        </button>

    </article>


    <br>


    <!-- SHOES -->

    <article>

        <h3>
            👟 <?= htmlspecialchars(
                $analysis['shoes']['name']
            ); ?>
        </h3>


        <p>

            ₹<?= number_format(
                $analysis['shoes']['price']
            ); ?>

        </p>


        <button
            type="button"
            onclick="alert('Real product will come from MySQL later.')"
        >
            View Product
        </button>

    </article>


    <br>


    <!-- WATCH -->

    <article>

        <h3>
            ⌚ <?= htmlspecialchars(
                $analysis['accessory']['name']
            ); ?>
        </h3>


        <p>

            ₹<?= number_format(
                $analysis['accessory']['price']
            ); ?>

        </p>


        <button
            type="button"
            onclick="alert('Real product will come from MySQL later.')"
        >
            View Product
        </button>

    </article>


</section>


<hr>


<!-- =========================================================
     PRIVACY NOTE
========================================================= -->

<section>

    <h3>
        🔒 Your Privacy
    </h3>


    <p>
        Your uploaded image is used only for the
        YFF styling experience.
    </p>


    <p>
        In the production version, image storage,
        deletion and AI processing rules will be
        handled securely.
    </p>

</section>


<hr>


<!-- =========================================================
     ACTIONS
========================================================= -->

<section>

    <h2>
        What's Next?
    </h2>


    <p>

        <button
            type="button"
            onclick="window.location.href='stylist.php'"
        >
            🤖 Ask AI Stylist
        </button>

    </p>


    <p>

        <button
            type="button"
            onclick="window.location.href='vibe.php'"
        >
            ✨ Try Vibe Stylist
        </button>

    </p>


    <p>

        <button
            type="button"
            onclick="window.location.href='suits-me.php'"
        >
            🔄 Analyze Another Photo
        </button>

    </p>

</section>


<?php endif; ?>


<hr>


<!-- =========================================================
     FOOTER
========================================================= -->

<footer>

    <p>

        <a href="index.php">
            ← AI Fashion Studio
        </a>

    </p>


    <p>

        <a href="../index.php">
            ← YFF Store
        </a>

    </p>

</footer>


</body>

</html>
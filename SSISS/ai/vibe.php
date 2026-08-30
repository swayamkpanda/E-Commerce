<?php

session_start();

/*
|--------------------------------------------------------------------------
| SSISS AI - VIBE STYLIST
|--------------------------------------------------------------------------
| Demo version
| AI API + MySQL product integration will be added later.
|--------------------------------------------------------------------------
*/

$userName = $_SESSION['user_name'] ?? 'Fashion Lover';


// ==========================================================
// VIBE DATA
// ==========================================================

$vibes = [

    'streetwear' => [
        'name' => 'Streetwear',
        'emoji' => '🔥',
        'description' => 'Bold, relaxed and urban.'
    ],

    'old-money' => [
        'name' => 'Old Money',
        'emoji' => '🥂',
        'description' => 'Elegant, timeless and sophisticated.'
    ],

    'minimal' => [
        'name' => 'Minimal',
        'emoji' => '🤍',
        'description' => 'Clean, simple and effortless.'
    ],

    'casual' => [
        'name' => 'Casual',
        'emoji' => '😎',
        'description' => 'Comfortable everyday style.'
    ],

    'party' => [
        'name' => 'Party',
        'emoji' => '🎉',
        'description' => 'Stand out and make an impression.'
    ],

    'formal' => [
        'name' => 'Formal',
        'emoji' => '👔',
        'description' => 'Sharp, professional and polished.'
    ],

    'sporty' => [
        'name' => 'Sporty',
        'emoji' => '🏃',
        'description' => 'Active, comfortable and energetic.'
    ],

    'y2k' => [
        'name' => 'Y2K',
        'emoji' => '💿',
        'description' => 'Retro-inspired modern fashion.'
    ],

    'korean' => [
        'name' => 'Korean',
        'emoji' => '✨',
        'description' => 'Modern Korean-inspired aesthetics.'
    ],

    'boho' => [
        'name' => 'Boho',
        'emoji' => '🌿',
        'description' => 'Relaxed, artistic and expressive.'
    ],

    'quiet-luxury' => [
        'name' => 'Quiet Luxury',
        'emoji' => '🖤',
        'description' => 'Premium-looking without being flashy.'
    ],

    'edgy' => [
        'name' => 'Edgy',
        'emoji' => '⚡',
        'description' => 'Bold, experimental and confident.'
    ]

];


// ==========================================================
// VARIABLES
// ==========================================================

$submitted = false;

$vibe = '';
$gender = '';
$budget = '';
$occasion = '';
$colour = '';
$season = '';


// ==========================================================
// HANDLE FORM
// ==========================================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $submitted = true;

    $vibe = $_POST['vibe'] ?? '';

    $gender = $_POST['gender'] ?? '';

    $budget = $_POST['budget'] ?? '';

    $occasion = $_POST['occasion'] ?? '';

    $colour = $_POST['colour'] ?? '';

    $season = $_POST['season'] ?? '';

}


// ==========================================================
// DEMO AI OUTFIT
// ==========================================================

$outfit = null;

if ($submitted) {

    $outfit = [

        'title' => 'Your '.$vibes[$vibe]['name'].' Look',

        'description' =>
            'SSISS AI created this look based on your selected vibe, occasion, colour preference and budget.',

        'top' => [
            'name' => 'Premium Relaxed Fit Shirt',
            'category' => 'Topwear',
            'price' => 999
        ],

        'bottom' => [
            'name' => 'Straight Fit Trousers',
            'category' => 'Bottomwear',
            'price' => 1199
        ],

        'shoes' => [
            'name' => 'Minimal Sneakers',
            'category' => 'Footwear',
            'price' => 1299
        ],

        'watch' => [
            'name' => 'Classic Minimal Watch',
            'category' => 'Watches',
            'price' => 899
        ],

        'spectacles' => [
            'name' => 'Modern Rectangle Frames',
            'category' => 'Eyewear',
            'price' => 699
        ]

    ];

}


// ==========================================================
// TOTAL PRICE
// ==========================================================

$total = 0;

if ($outfit) {

    foreach ($outfit as $key => $item) {

        if (
            is_array($item) &&
            isset($item['price'])
        ) {

            $total += $item['price'];

        }

    }

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
        Vibe Stylist | SSISS AI
    </title>

</head>


<body>


<!-- =========================================================
     HEADER
========================================================= -->

<header>

    <h1>
        ✨ SSISS Vibe Stylist
    </h1>


    <p>

        Welcome,

        <?= htmlspecialchars(
            $userName
        ); ?>

        👋

    </p>


    <p>
        Tell us your vibe. We'll build the look.
    </p>

</header>


<hr>


<!-- =========================================================
     INTRO
========================================================= -->

<section>

    <h2>
        What's Your Vibe?
    </h2>


    <p>

        Fashion isn't just about clothes.

        It's about how you want to feel.

        Choose your vibe and let SSISS AI
        create your complete look.

    </p>


    <ul>

        <li>
            🎭 Choose your vibe
        </li>

        <li>
            💰 Set your budget
        </li>

        <li>
            🎉 Choose your occasion
        </li>

        <li>
            🎨 Pick your colour preference
        </li>

        <li>
            🤖 Get an AI-generated outfit
        </li>

        <li>
            🛍️ Shop the complete look
        </li>

    </ul>

</section>


<hr>


<!-- =========================================================
     VIBE FORM
========================================================= -->

<section>

    <h2>
        🎭 Choose Your Vibe
    </h2>


    <form
        method="POST"
        action="vibe.php"
    >


        <!-- =================================================
             VIBES
        ================================================== -->

        <div>

            <?php foreach (
                $vibes as $key => $vibeData
            ): ?>


                <div>

                    <label>

                        <input
                            type="radio"
                            name="vibe"
                            value="<?= htmlspecialchars($key); ?>"
                            required
                        >

                        <?= $vibeData['emoji']; ?>

                        <strong>

                            <?= htmlspecialchars(
                                $vibeData['name']
                            ); ?>

                        </strong>

                    </label>


                    <p>

                        <?= htmlspecialchars(
                            $vibeData['description']
                        ); ?>

                    </p>

                </div>


            <?php endforeach; ?>

        </div>


        <hr>


        <!-- =================================================
             GENDER
        ================================================== -->

        <h2>
            👤 Who Are We Styling?
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
             BUDGET
        ================================================== -->

        <h2>
            💰 What's Your Budget?
        </h2>


        <select
            name="budget"
            required
        >

            <option value="">
                Select Budget
            </option>

            <option value="2000">
                Under ₹2,000
            </option>

            <option value="3000">
                ₹2,000 - ₹3,000
            </option>

            <option value="5000">
                ₹3,000 - ₹5,000
            </option>

            <option value="8000">
                ₹5,000 - ₹8,000
            </option>

            <option value="10000">
                ₹8,000 - ₹10,000
            </option>

            <option value="15000">
                ₹10,000+
            </option>

        </select>


        <hr>


        <!-- =================================================
             OCCASION
        ================================================== -->

        <h2>
            🎉 Occasion
        </h2>


        <select
            name="occasion"
            required
        >

            <option value="">
                Select Occasion
            </option>

            <option value="college">
                🎓 College
            </option>

            <option value="casual">
                ☀️ Casual Outing
            </option>

            <option value="date">
                ❤️ Date
            </option>

            <option value="party">
                🎉 Party
            </option>

            <option value="wedding">
                💍 Wedding
            </option>

            <option value="festival">
                🪔 Festival
            </option>

            <option value="interview">
                💼 Interview
            </option>

            <option value="travel">
                ✈️ Travel
            </option>

        </select>


        <hr>


        <!-- =================================================
             COLOUR
        ================================================== -->

        <h2>
            🎨 Colour Preference
        </h2>


        <select
            name="colour"
        >

            <option value="">
                AI Decides
            </option>

            <option value="black">
                🖤 Black
            </option>

            <option value="white">
                🤍 White
            </option>

            <option value="blue">
                💙 Blue
            </option>

            <option value="green">
                💚 Green
            </option>

            <option value="red">
                ❤️ Red
            </option>

            <option value="beige">
                🤎 Beige
            </option>

            <option value="pastel">
                🌸 Pastel
            </option>

            <option value="neutral">
                ⚪ Neutral
            </option>

        </select>


        <hr>


        <!-- =================================================
             SEASON
        ================================================== -->

        <h2>
            🌤️ Season
        </h2>


        <select
            name="season"
        >

            <option value="">
                AI Decides
            </option>

            <option value="summer">
                ☀️ Summer
            </option>

            <option value="monsoon">
                🌧️ Monsoon
            </option>

            <option value="winter">
                ❄️ Winter
            </option>

            <option value="spring">
                🌸 Spring
            </option>

            <option value="autumn">
                🍂 Autumn
            </option>

        </select>


        <br><br>


        <!-- =================================================
             SUBMIT
        ================================================== -->

        <button
            type="submit"
        >

            ✨ Generate My Vibe

        </button>


    </form>

</section>


<hr>


<!-- =========================================================
     RESULT
========================================================= -->

<?php if (
    $submitted &&
    $outfit &&
    isset($vibes[$vibe])
): ?>


<section>

    <h2>

        <?= $vibes[$vibe]['emoji']; ?>

        <?= htmlspecialchars(
            $outfit['title']
        ); ?>

    </h2>


    <p>

        <?= htmlspecialchars(
            $outfit['description']
        ); ?>

    </p>


    <!-- =====================================================
         PROFILE
    ====================================================== -->

    <h3>
        Your Selection
    </h3>


    <ul>

        <li>

            <strong>
                Vibe:
            </strong>

            <?= htmlspecialchars(
                $vibes[$vibe]['name']
            ); ?>

        </li>


        <li>

            <strong>
                Styling For:
            </strong>

            <?= htmlspecialchars(
                ucfirst($gender)
            ); ?>

        </li>


        <li>

            <strong>
                Occasion:
            </strong>

            <?= htmlspecialchars(
                ucfirst($occasion)
            ); ?>

        </li>


        <li>

            <strong>
                Budget:
            </strong>

            ₹<?= htmlspecialchars(
                $budget
            ); ?>

        </li>


        <li>

            <strong>
                Colour:
            </strong>

            <?= $colour
                ? htmlspecialchars(
                    ucfirst($colour)
                )
                : 'AI Selected'; ?>

        </li>


        <li>

            <strong>
                Season:
            </strong>

            <?= $season
                ? htmlspecialchars(
                    ucfirst($season)
                )
                : 'AI Selected'; ?>

        </li>

    </ul>


    <hr>


    <!-- =====================================================
         OUTFIT
    ====================================================== -->

    <h2>
        👗 Your Complete Look
    </h2>


    <!-- TOP -->

    <article>

        <h3>

            👕
            <?= htmlspecialchars(
                $outfit['top']['name']
            ); ?>

        </h3>


        <p>

            <?= htmlspecialchars(
                $outfit['top']['category']
            ); ?>

        </p>


        <p>

            ₹<?= number_format(
                $outfit['top']['price']
            ); ?>

        </p>


        <button
            type="button"
            onclick="alert('Real product will be loaded from MySQL later.')"
        >

            View Product

        </button>

    </article>


    <br>


    <!-- BOTTOM -->

    <article>

        <h3>

            👖
            <?= htmlspecialchars(
                $outfit['bottom']['name']
            ); ?>

        </h3>


        <p>

            <?= htmlspecialchars(
                $outfit['bottom']['category']
            ); ?>

        </p>


        <p>

            ₹<?= number_format(
                $outfit['bottom']['price']
            ); ?>

        </p>


        <button
            type="button"
            onclick="alert('Real product will be loaded from MySQL later.')"
        >

            View Product

        </button>

    </article>


    <br>


    <!-- SHOES -->

    <article>

        <h3>

            👟
            <?= htmlspecialchars(
                $outfit['shoes']['name']
            ); ?>

        </h3>


        <p>

            <?= htmlspecialchars(
                $outfit['shoes']['category']
            ); ?>

        </p>


        <p>

            ₹<?= number_format(
                $outfit['shoes']['price']
            ); ?>

        </p>


        <button
            type="button"
            onclick="alert('Real product will be loaded from MySQL later.')"
        >

            View Product

        </button>

    </article>


    <br>


    <!-- WATCH -->

    <article>

        <h3>

            ⌚
            <?= htmlspecialchars(
                $outfit['watch']['name']
            ); ?>

        </h3>


        <p>

            <?= htmlspecialchars(
                $outfit['watch']['category']
            ); ?>

        </p>


        <p>

            ₹<?= number_format(
                $outfit['watch']['price']
            ); ?>

        </p>


        <button
            type="button"
            onclick="alert('Real product will be loaded from MySQL later.')"
        >

            View Product

        </button>

    </article>


    <br>


    <!-- SPECTACLES -->

    <article>

        <h3>

            👓
            <?= htmlspecialchars(
                $outfit['spectacles']['name']
            ); ?>

        </h3>


        <p>

            <?= htmlspecialchars(
                $outfit['spectacles']['category']
            ); ?>

        </p>


        <p>

            ₹<?= number_format(
                $outfit['spectacles']['price']
            ); ?>

        </p>


        <button
            type="button"
            onclick="alert('Real product will be loaded from MySQL later.')"
        >

            View Product

        </button>

    </article>


    <hr>


    <!-- =====================================================
         TOTAL
    ====================================================== -->

    <h2>
        💰 Complete Look Price
    </h2>


    <p>

        <strong>

            ₹<?= number_format(
                $total
            ); ?>

        </strong>

    </p>


    <?php if (
        is_numeric($budget) &&
        $total <= intval($budget)
    ): ?>

        <p>
            ✅ This complete look fits your budget!
        </p>

    <?php else: ?>

        <p>
            ⚠️ AI will optimize the products to your
            exact budget after MySQL integration.
        </p>

    <?php endif; ?>


    <hr>


    <!-- =====================================================
         ACTIONS
    ====================================================== -->

    <h2>
        🛍️ What Do You Want To Do?
    </h2>


    <p>

        <button
            type="button"
            onclick="alert('Complete look will be added to cart after MySQL integration.')"
        >

            🛒 Add Complete Look To Cart

        </button>

    </p>


    <p>

        <button
            type="button"
            onclick="alert('Wishlist will be connected later.')"
        >

            ❤️ Save Look

        </button>

    </p>


    <p>

        <button
            type="button"
            onclick="window.location.href='vibe.php'"
        >

            🔄 Try Another Vibe

        </button>

    </p>


</section>


<?php endif; ?>


<hr>


<!-- =========================================================
     VIBE EXAMPLES
========================================================= -->

<section>

    <h2>
        💡 Need Inspiration?
    </h2>


    <ul>

        <li>
            🔥 Streetwear + Black + Party
        </li>

        <li>
            🥂 Old Money + Wedding
        </li>

        <li>
            🤍 Minimal + College
        </li>

        <li>
            💿 Y2K + Party
        </li>

        <li>
            ✨ Korean + Casual
        </li>

        <li>
            🖤 Quiet Luxury + Date
        </li>

        <li>
            🌿 Boho + Travel
        </li>

        <li>
            ⚡ Edgy + Concert
        </li>

    </ul>

</section>


<hr>


<!-- =========================================================
     FUTURE AI
========================================================= -->

<section>

    <h2>
        🤖 How Real SSISS AI Will Work
    </h2>


    <ol>

        <li>
            User selects a vibe.
        </li>

        <li>
            User gives budget and preferences.
        </li>

        <li>
            PHP sends the request to the AI API.
        </li>

        <li>
            AI understands the desired aesthetic.
        </li>

        <li>
            AI generates an outfit specification.
        </li>

        <li>
            PHP searches matching products in MySQL.
        </li>

        <li>
            SSISS displays real products.
        </li>

        <li>
            User can purchase the complete look.
        </li>

    </ol>

</section>


<hr>


<!-- =========================================================
     NAVIGATION
========================================================= -->

<footer>

    <p>

        <a href="index.php">
            ← AI Fashion Studio
        </a>

    </p>


    <p>

        <a href="../index.php">
            ← SSISS Store
        </a>

    </p>

</footer>


</body>

</html>
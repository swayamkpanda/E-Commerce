<?php

session_start();

/*
|--------------------------------------------------------------------------
| YFF AI - PERSONAL STYLIST
|--------------------------------------------------------------------------
| Demo version
| AI API + MySQL integration will be added later
|--------------------------------------------------------------------------
*/

$userName = $_SESSION['user_name'] ?? 'Fashion Lover';


// ==========================================================
// FORM DATA
// ==========================================================

$request = '';
$gender = '';
$budget = '';
$style = '';
$occasion = '';
$weather = '';
$submitted = false;


// ==========================================================
// HANDLE FORM
// ==========================================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $submitted = true;

    $request = trim($_POST['request'] ?? '');
    $gender = $_POST['gender'] ?? '';
    $budget = $_POST['budget'] ?? '';
    $style = $_POST['style'] ?? '';
    $occasion = $_POST['occasion'] ?? '';
    $weather = $_POST['weather'] ?? '';

}


// ==========================================================
// DEMO AI RESPONSE
// ==========================================================

$aiResponse = null;

if ($submitted) {

    $aiResponse = [

        'title' => 'Smart Casual Complete Look',

        'summary' =>
            'Based on your requirements, YFF AI recommends a clean, versatile outfit that balances comfort, style and your budget.',

        'top' => [
            'name' => 'Premium Oversized Cotton Shirt',
            'price' => 899,
            'reason' => 'Comfortable and easy to style.'
        ],

        'bottom' => [
            'name' => 'Relaxed Straight Fit Trousers',
            'price' => 1099,
            'reason' => 'Creates a balanced silhouette.'
        ],

        'shoes' => [
            'name' => 'Minimal White Sneakers',
            'price' => 1299,
            'reason' => 'Works with both casual and smart outfits.'
        ],

        'accessory' => [
            'name' => 'Minimal Classic Watch',
            'price' => 799,
            'reason' => 'Adds a subtle premium finish.'
        ]

    ];

}


// ==========================================================
// TOTAL
// ==========================================================

$total = 0;

if ($aiResponse) {

    $total =
        $aiResponse['top']['price'] +
        $aiResponse['bottom']['price'] +
        $aiResponse['shoes']['price'] +
        $aiResponse['accessory']['price'];

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
        AI Personal Stylist | YFF
    </title>

    <link rel="stylesheet" href="../assets/css/ai.css">

    

</head>


<body>


<!-- =========================================================
     HEADER
========================================================= -->

<header>

    <h1>
        🤖 YFF AI Personal Stylist
    </h1>

    <p>
        Welcome,
        <?= htmlspecialchars($userName); ?>
        👋
    </p>

    <p>
        Tell us what you want to wear. We'll do the styling.
    </p>

</header>


<hr>


<!-- =========================================================
     INTRO
========================================================= -->

<section>

    <h2>
        Your Personal AI Stylist
    </h2>

    <p>
        You don't need to know fashion terms.
        Just describe what you're looking for naturally.
    </p>

    <p>
        Example:
    </p>

    <blockquote>

        "I have a college farewell next week.
        I want something elegant and stylish,
        preferably black, and my budget is ₹4000."

    </blockquote>

</section>


<hr>


<!-- =========================================================
     STYLIST FORM
========================================================= -->

<section>

    <h2>
        ✨ Tell Me What You Need
    </h2>


    <form
        method="POST"
        action="stylist.php"
    >


        <!-- =================================================
             NATURAL LANGUAGE REQUEST
        ================================================== -->

        <div>

            <label for="request">

                <strong>
                    Describe your outfit:
                </strong>

            </label>

            <br><br>

            <textarea
                id="request"
                name="request"
                rows="7"
                cols="60"
                required
                placeholder="Example: I need a stylish outfit for a college party. I want something comfortable, dark coloured and under ₹3000..."
            ><?= htmlspecialchars($request); ?></textarea>

        </div>


        <br>


        <!-- =================================================
             GENDER
        ================================================== -->

        <div>

            <label for="gender">

                <strong>
                    Styling For:
                </strong>

            </label>

            <br>

            <select
                id="gender"
                name="gender"
                required
            >

                <option value="">
                    Select
                </option>

                <option
                    value="men"
                    <?= $gender === 'men'
                        ? 'selected'
                        : ''; ?>
                >
                    Men
                </option>

                <option
                    value="women"
                    <?= $gender === 'women'
                        ? 'selected'
                        : ''; ?>
                >
                    Women
                </option>

                <option
                    value="unisex"
                    <?= $gender === 'unisex'
                        ? 'selected'
                        : ''; ?>
                >
                    Unisex
                </option>

            </select>

        </div>


        <br>


        <!-- =================================================
             BUDGET
        ================================================== -->

        <div>

            <label for="budget">

                <strong>
                    Budget:
                </strong>

            </label>

            <br>

            <select
                id="budget"
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

        </div>


        <br>


        <!-- =================================================
             STYLE
        ================================================== -->

        <div>

            <label for="style">

                <strong>
                    Preferred Style:
                </strong>

            </label>

            <br>

            <select
                id="style"
                name="style"
            >

                <option value="">
                    Let AI decide
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

        </div>


        <br>


        <!-- =================================================
             OCCASION
        ================================================== -->

        <div>

            <label for="occasion">

                <strong>
                    Occasion:
                </strong>

            </label>

            <br>

            <select
                id="occasion"
                name="occasion"
            >

                <option value="">
                    Not specified
                </option>

                <option value="college">
                    College
                </option>

                <option value="wedding">
                    Wedding
                </option>

                <option value="date">
                    Date
                </option>

                <option value="party">
                    Party
                </option>

                <option value="interview">
                    Interview
                </option>

                <option value="casual">
                    Casual Outing
                </option>

                <option value="festival">
                    Festival
                </option>

                <option value="business">
                    Business
                </option>

                <option value="gym">
                    Gym
                </option>

                <option value="travel">
                    Travel
                </option>

            </select>

        </div>


        <br>


        <!-- =================================================
             WEATHER
        ================================================== -->

        <div>

            <label for="weather">

                <strong>
                    Weather:
                </strong>

            </label>

            <br>

            <select
                id="weather"
                name="weather"
            >

                <option value="">
                    Let AI decide
                </option>

                <option value="hot">
                    ☀️ Hot
                </option>

                <option value="warm">
                    🌤️ Warm
                </option>

                <option value="mild">
                    🌥️ Mild
                </option>

                <option value="cold">
                    ❄️ Cold
                </option>

                <option value="rainy">
                    🌧️ Rainy
                </option>

            </select>

        </div>


        <br><br>


        <!-- =================================================
             SUBMIT
        ================================================== -->

        <button
            type="submit"
        >

            ✨ Style Me

        </button>


    </form>

</section>


<hr>


<!-- =========================================================
     AI RESULT
========================================================= -->

<?php if ($submitted && $aiResponse): ?>


<section>

    <h2>
        🎯 Your AI Styling Recommendation
    </h2>


    <h3>

        <?= htmlspecialchars(
            $aiResponse['title']
        ); ?>

    </h3>


    <p>

        <?= htmlspecialchars(
            $aiResponse['summary']
        ); ?>

    </p>


    <!-- =====================================================
         USER REQUEST
    ====================================================== -->

    <h3>
        Your Request
    </h3>


    <blockquote>

        <?= nl2br(
            htmlspecialchars($request)
        ); ?>

    </blockquote>


    <!-- =====================================================
         OUTFIT
    ====================================================== -->

    <h2>
        👕 Complete Outfit
    </h2>


    <!-- TOP -->

    <article>

        <h3>
            👕 <?= htmlspecialchars(
                $aiResponse['top']['name']
            ); ?>
        </h3>

        <p>

            ₹<?= number_format(
                $aiResponse['top']['price']
            ); ?>

        </p>

        <p>

            💡 <?= htmlspecialchars(
                $aiResponse['top']['reason']
            ); ?>

        </p>

        <button
            type="button"
            onclick="alert('Product will be connected to MySQL later.')"
        >
            View Product
        </button>

    </article>


    <br>


    <!-- BOTTOM -->

    <article>

        <h3>
            👖 <?= htmlspecialchars(
                $aiResponse['bottom']['name']
            ); ?>
        </h3>

        <p>

            ₹<?= number_format(
                $aiResponse['bottom']['price']
            ); ?>

        </p>

        <p>

            💡 <?= htmlspecialchars(
                $aiResponse['bottom']['reason']
            ); ?>

        </p>

        <button
            type="button"
            onclick="alert('Product will be connected to MySQL later.')"
        >
            View Product
        </button>

    </article>


    <br>


    <!-- SHOES -->

    <article>

        <h3>
            👟 <?= htmlspecialchars(
                $aiResponse['shoes']['name']
            ); ?>
        </h3>

        <p>

            ₹<?= number_format(
                $aiResponse['shoes']['price']
            ); ?>

        </p>

        <p>

            💡 <?= htmlspecialchars(
                $aiResponse['shoes']['reason']
            ); ?>

        </p>

        <button
            type="button"
            onclick="alert('Product will be connected to MySQL later.')"
        >
            View Product
        </button>

    </article>


    <br>


    <!-- ACCESSORY -->

    <article>

        <h3>
            ⌚ <?= htmlspecialchars(
                $aiResponse['accessory']['name']
            ); ?>
        </h3>

        <p>

            ₹<?= number_format(
                $aiResponse['accessory']['price']
            ); ?>

        </p>

        <p>

            💡 <?= htmlspecialchars(
                $aiResponse['accessory']['reason']
            ); ?>

        </p>

        <button
            type="button"
            onclick="alert('Product will be connected to MySQL later.')"
        >
            View Product
        </button>

    </article>


    <hr>


    <!-- =====================================================
         TOTAL
    ====================================================== -->

    <h2>
        💰 Complete Look
    </h2>


    <p>

        Total:

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
            ✅ This look fits your selected budget.
        </p>

    <?php else: ?>

        <p>
            ⚠️ AI can optimize the products further
            once the real product database is connected.
        </p>

    <?php endif; ?>


    <!-- =====================================================
         ACTIONS
    ====================================================== -->

    <h3>
        What next?
    </h3>


    <p>

        <button
            type="button"
            onclick="alert('Cart functionality will be connected later.')"
        >
            🛍️ Add Complete Look
        </button>

    </p>


    <p>

        <button
            type="button"
            onclick="window.location.href='stylist.php'"
        >
            🔄 Try Another Style
        </button>

    </p>


    <p>

        <button
            type="button"
            onclick="alert('Save feature will be connected to MySQL later.')"
        >
            ❤️ Save Look
        </button>

    </p>

</section>


<?php endif; ?>


<hr>


<!-- =========================================================
     QUICK PROMPTS
========================================================= -->

<section>

    <h2>
        💡 Need Inspiration?
    </h2>


    <ul>

        <li>
            "Create an outfit for my college farewell under ₹3000."
        </li>

        <li>
            "I want an Old Money outfit for a wedding."
        </li>

        <li>
            "Give me a streetwear outfit for a night party."
        </li>

        <li>
            "I need a professional interview outfit under ₹5000."
        </li>

        <li>
            "Build me a Korean-inspired casual look."
        </li>

        <li>
            "I am going on a trip. Give me outfits for 5 days."
        </li>

    </ul>

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
            ← YFF Store
        </a>

    </p>

</footer>


</body>

</html>
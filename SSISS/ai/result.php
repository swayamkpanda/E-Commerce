<?php

session_start();

/*
|--------------------------------------------------------------------------
| YFF AI - RESULT PAGE
|--------------------------------------------------------------------------
| Demo AI recommendation result.
| Real AI API + MySQL products will be connected later.
|--------------------------------------------------------------------------
*/


// ==========================================================
// GET USER INPUT
// ==========================================================

$occasion = $_GET['occasion'] ?? 'casual';

$gender = $_GET['gender'] ?? 'unisex';

$budget = $_GET['budget'] ?? '3000';

$style = $_GET['style'] ?? 'casual';

$colour = $_GET['colour'] ?? '';


// ==========================================================
// OCCASION NAMES
// ==========================================================

$occasionNames = [

    'college' => 'College / University',
    'wedding' => 'Wedding',
    'date' => 'Date',
    'party' => 'Party',
    'interview' => 'Interview',
    'casual' => 'Casual Outing',
    'festival' => 'Festival',
    'business' => 'Business / Formal',
    'gym' => 'Gym / Workout',
    'travel' => 'Travel'

];


// ==========================================================
// STYLE NAMES
// ==========================================================

$styleNames = [

    'casual' => 'Casual',
    'streetwear' => 'Streetwear',
    'minimal' => 'Minimal',
    'old-money' => 'Old Money',
    'formal' => 'Formal',
    'party' => 'Party',
    'sporty' => 'Sporty',
    'korean' => 'Korean',
    'y2k' => 'Y2K',
    'traditional' => 'Traditional'

];


// ==========================================================
// DEMO AI RECOMMENDATION
// ==========================================================

$recommendations = [

    'top' => [
        'name' => 'Premium Relaxed Fit Shirt',
        'category' => 'Topwear',
        'price' => 999,
        'reason' => 'A clean silhouette that works well for your selected style.'
    ],

    'bottom' => [
        'name' => 'Classic Straight Fit Trousers',
        'category' => 'Bottomwear',
        'price' => 1199,
        'reason' => 'Balances the outfit while keeping the look sophisticated.'
    ],

    'shoes' => [
        'name' => 'Minimal White Sneakers',
        'category' => 'Footwear',
        'price' => 1299,
        'reason' => 'A versatile choice that works with multiple outfit combinations.'
    ],

    'watch' => [
        'name' => 'Classic Minimal Watch',
        'category' => 'Watches',
        'price' => 899,
        'reason' => 'Adds a subtle premium touch to the overall outfit.'
    ]

];


// ==========================================================
// TOTAL PRICE
// ==========================================================

$totalPrice = 0;

foreach ($recommendations as $product) {

    $totalPrice += $product['price'];

}


// ==========================================================
// BUDGET
// ==========================================================

$budgetValue = is_numeric($budget)
    ? intval($budget)
    : 3000;


// ==========================================================
// BUDGET STATUS
// ==========================================================

if ($totalPrice <= $budgetValue) {

    $budgetStatus = 'Within your budget';

} else {

    $budgetStatus = 'Above your selected budget';

}


// ==========================================================
// DISPLAY VALUES
// ==========================================================

$occasionDisplay =
    $occasionNames[$occasion]
    ?? ucfirst($occasion);


$styleDisplay =
    $styleNames[$style]
    ?? ucfirst($style);


$genderDisplay =
    ucfirst($gender);


$colourDisplay =
    $colour !== ''
        ? ucfirst($colour)
        : 'AI Selected';

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
        Your AI Outfit | YFF
    </title>

</head>


<body>


<!-- =========================================================
     HEADER
========================================================= -->

<header>

    <h1>
        ✨ Your YFF AI Look
    </h1>

    <p>
        Your personalized outfit recommendation is ready.
    </p>

</header>


<hr>


<!-- =========================================================
     REQUEST SUMMARY
========================================================= -->

<section>

    <h2>
        🎯 Your Style Profile
    </h2>


    <ul>

        <li>

            <strong>
                Occasion:
            </strong>

            <?= htmlspecialchars(
                $occasionDisplay
            ); ?>

        </li>


        <li>

            <strong>
                Styling For:
            </strong>

            <?= htmlspecialchars(
                $genderDisplay
            ); ?>

        </li>


        <li>

            <strong>
                Style:
            </strong>

            <?= htmlspecialchars(
                $styleDisplay
            ); ?>

        </li>


        <li>

            <strong>
                Colour:
            </strong>

            <?= htmlspecialchars(
                $colourDisplay
            ); ?>

        </li>


        <li>

            <strong>
                Budget:
            </strong>

            ₹<?= number_format(
                $budgetValue
            ); ?>

        </li>

    </ul>

</section>


<hr>


<!-- =========================================================
     AI SUMMARY
========================================================= -->

<section>

    <h2>
        🤖 AI Stylist Says
    </h2>


    <p>

        Based on your
        <strong>
            <?= htmlspecialchars(
                $styleDisplay
            ); ?>
        </strong>

        style for a

        <strong>
            <?= htmlspecialchars(
                $occasionDisplay
            ); ?>
        </strong>

        occasion, we've created a balanced outfit
        that matches your preferences.

    </p>


    <p>

        The recommended colour direction is:

        <strong>
            <?= htmlspecialchars(
                $colourDisplay
            ); ?>
        </strong>

    </p>

</section>


<hr>


<!-- =========================================================
     COMPLETE OUTFIT
========================================================= -->

<section>

    <h2>
        👕 Complete Look
    </h2>


    <!-- TOP -->

    <article>

        <h3>
            1. <?= htmlspecialchars(
                $recommendations['top']['name']
            ); ?>
        </h3>

        <p>

            Category:

            <?= htmlspecialchars(
                $recommendations['top']['category']
            ); ?>

        </p>

        <p>

            Price:

            ₹<?= number_format(
                $recommendations['top']['price']
            ); ?>

        </p>

        <p>

            💡
            <?= htmlspecialchars(
                $recommendations['top']['reason']
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
            2. <?= htmlspecialchars(
                $recommendations['bottom']['name']
            ); ?>
        </h3>

        <p>

            Category:

            <?= htmlspecialchars(
                $recommendations['bottom']['category']
            ); ?>

        </p>

        <p>

            Price:

            ₹<?= number_format(
                $recommendations['bottom']['price']
            ); ?>

        </p>

        <p>

            💡
            <?= htmlspecialchars(
                $recommendations['bottom']['reason']
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
            3. <?= htmlspecialchars(
                $recommendations['shoes']['name']
            ); ?>
        </h3>

        <p>

            Category:

            <?= htmlspecialchars(
                $recommendations['shoes']['category']
            ); ?>

        </p>

        <p>

            Price:

            ₹<?= number_format(
                $recommendations['shoes']['price']
            ); ?>

        </p>

        <p>

            💡
            <?= htmlspecialchars(
                $recommendations['shoes']['reason']
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


    <!-- WATCH -->

    <article>

        <h3>
            4. <?= htmlspecialchars(
                $recommendations['watch']['name']
            ); ?>
        </h3>

        <p>

            Category:

            <?= htmlspecialchars(
                $recommendations['watch']['category']
            ); ?>

        </p>

        <p>

            Price:

            ₹<?= number_format(
                $recommendations['watch']['price']
            ); ?>

        </p>

        <p>

            💡
            <?= htmlspecialchars(
                $recommendations['watch']['reason']
            ); ?>

        </p>


        <button
            type="button"
            onclick="alert('Product will be connected to MySQL later.')"
        >
            View Product
        </button>

    </article>

</section>


<hr>


<!-- =========================================================
     PRICE SUMMARY
========================================================= -->

<section>

    <h2>
        💰 Outfit Summary
    </h2>


    <p>

        Complete outfit:

        <strong>
            ₹<?= number_format(
                $totalPrice
            ); ?>
        </strong>

    </p>


    <p>

        Your budget:

        <strong>
            ₹<?= number_format(
                $budgetValue
            ); ?>
        </strong>

    </p>


    <p>

        Status:

        <strong>
            <?= htmlspecialchars(
                $budgetStatus
            ); ?>
        </strong>

    </p>


    <?php if (
        $totalPrice <= $budgetValue
    ): ?>

        <p>
            ✅ This outfit fits within your budget!
        </p>

    <?php else: ?>

        <p>
            ⚠️ We will optimize this outfit when the
            real AI + product database is connected.
        </p>

    <?php endif; ?>


</section>


<hr>


<!-- =========================================================
     AI ACTIONS
========================================================= -->

<section>

    <h2>
        What would you like to do?
    </h2>


    <p>

        <button
            type="button"
            onclick="alert('Add complete look to cart will be connected later.')"
        >
            🛍️ Add Complete Look to Cart
        </button>

    </p>


    <p>

        <button
            type="button"
            onclick="alert('AI regeneration will be connected later.')"
        >
            🔄 Generate Another Look
        </button>

    </p>


    <p>

        <button
            type="button"
            onclick="alert('Save outfit will be connected to user account later.')"
        >
            ❤️ Save This Look
        </button>

    </p>


    <p>

        <button
            type="button"
            onclick="alert('AI product matching will be connected to MySQL later.')"
        >
            ✨ Find Similar Products
        </button>

    </p>

</section>


<hr>


<!-- =========================================================
     AI EXPLANATION
========================================================= -->

<section>

    <h2>
        🧠 Why This Look?
    </h2>


    <ul>

        <li>
            Matches your selected occasion.
        </li>

        <li>
            Follows your preferred fashion style.
        </li>

        <li>
            Considers your selected budget.
        </li>

        <li>
            Combines clothing with accessories.
        </li>

        <li>
            Designed as a complete outfit instead of individual products.
        </li>

    </ul>

</section>


<hr>


<!-- =========================================================
     NAVIGATION
========================================================= -->

<footer>

    <p>

        <a href="occasion.php">
            ← Change Occasion
        </a>

    </p>


    <p>

        <a href="index.php">
            ← AI Fashion Studio
        </a>

    </p>


    <p>

        <a href="../index.php">
            ← Back to YFF Store
        </a>

    </p>

</footer>


</body>

</html>
<?php

session_start();

/*
|--------------------------------------------------------------------------
| SSISS AI - OCCASION STYLIST
|--------------------------------------------------------------------------
| Demo version
| AI API + MySQL integration will be added later
|--------------------------------------------------------------------------
*/

$userName = $_SESSION['user_name'] ?? 'Fashion Lover';


// ==========================================================
// OCCASIONS
// ==========================================================

$occasions = [

    'college' => [
        'name' => 'College / University',
        'icon' => '🎓',
        'description' => 'Look stylish, comfortable and effortless.'
    ],

    'wedding' => [
        'name' => 'Wedding',
        'icon' => '💍',
        'description' => 'Elegant looks for wedding celebrations.'
    ],

    'date' => [
        'name' => 'Date',
        'icon' => '❤️',
        'description' => 'Create a stylish and confident date look.'
    ],

    'party' => [
        'name' => 'Party',
        'icon' => '🎉',
        'description' => 'Stand out with a party-ready outfit.'
    ],

    'interview' => [
        'name' => 'Interview',
        'icon' => '💼',
        'description' => 'Professional and confident interview styling.'
    ],

    'casual' => [
        'name' => 'Casual Outing',
        'icon' => '☀️',
        'description' => 'Easy everyday fashion.'
    ],

    'festival' => [
        'name' => 'Festival',
        'icon' => '🪔',
        'description' => 'Celebrate with a fashionable festive look.'
    ],

    'business' => [
        'name' => 'Business / Formal',
        'icon' => '👔',
        'description' => 'Clean and sophisticated professional styling.'
    ],

    'gym' => [
        'name' => 'Gym / Workout',
        'icon' => '🏋️',
        'description' => 'Comfortable and performance-focused outfits.'
    ],

    'travel' => [
        'name' => 'Travel',
        'icon' => '✈️',
        'description' => 'Comfortable travel outfits that still look good.'
    ]

];


// ==========================================================
// CHECK IF FORM WAS SUBMITTED
// ==========================================================

$formSubmitted = false;

$selectedOccasion = '';
$gender = '';
$budget = '';
$style = '';
$colour = '';
$extraRequest = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $formSubmitted = true;

    $selectedOccasion =
        $_POST['occasion'] ?? '';

    $gender =
        $_POST['gender'] ?? '';

    $budget =
        $_POST['budget'] ?? '';

    $style =
        $_POST['style'] ?? '';

    $colour =
        $_POST['colour'] ?? '';

    $extraRequest =
        trim($_POST['extra_request'] ?? '');

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
        Occasion Stylist | SSISS AI
    </title>

</head>


<body>


<!-- =========================================================
     HEADER
========================================================= -->

<header>

    <h1>
        🎉 SSISS Occasion Stylist
    </h1>

    <p>
        Welcome,
        <?= htmlspecialchars($userName); ?>
        👋
    </p>

    <p>
        Tell us where you're going and we'll help build your look.
    </p>

</header>


<hr>


<!-- =========================================================
     INTRODUCTION
========================================================= -->

<section>

    <h2>
        Find Your Perfect Occasion Look
    </h2>

    <p>
        Whether it's a wedding, date, party, college,
        interview or trip, SSISS AI can create a complete look
        based on your occasion, budget and personal style.
    </p>

</section>


<hr>


<!-- =========================================================
     OCCASION SELECTION
========================================================= -->

<section>

    <h2>
        1. Choose Your Occasion
    </h2>


    <form
        method="POST"
        action="occasion.php"
    >


        <div>

            <?php foreach (
                $occasions as $key => $occasion
            ): ?>


                <div>

                    <label>

                        <input
                            type="radio"
                            name="occasion"
                            value="<?= htmlspecialchars($key); ?>"
                            required
                            <?= $selectedOccasion === $key
                                ? 'checked'
                                : ''; ?>
                        >

                        <?= $occasion['icon']; ?>

                        <strong>
                            <?= htmlspecialchars(
                                $occasion['name']
                            ); ?>
                        </strong>

                    </label>


                    <p>

                        <?= htmlspecialchars(
                            $occasion['description']
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
            2. Who Are We Styling?
        </h2>


        <label>

            <input
                type="radio"
                name="gender"
                value="men"
                required
                <?= $gender === 'men'
                    ? 'checked'
                    : ''; ?>
            >

            👨 Men

        </label>


        <br>


        <label>

            <input
                type="radio"
                name="gender"
                value="women"
                <?= $gender === 'women'
                    ? 'checked'
                    : ''; ?>
            >

            👩 Women

        </label>


        <br>


        <label>

            <input
                type="radio"
                name="gender"
                value="unisex"
                <?= $gender === 'unisex'
                    ? 'checked'
                    : ''; ?>
            >

            🧑 Unisex

        </label>


        <hr>


        <!-- =================================================
             BUDGET
        ================================================== -->

        <h2>
            3. What's Your Budget?
        </h2>


        <select
            name="budget"
            required
        >

            <option value="">
                Select your budget
            </option>

            <option
                value="1000"
                <?= $budget === '1000'
                    ? 'selected'
                    : ''; ?>
            >
                Under ₹1,000
            </option>

            <option
                value="2000"
                <?= $budget === '2000'
                    ? 'selected'
                    : ''; ?>
            >
                ₹1,000 - ₹2,000
            </option>

            <option
                value="3000"
                <?= $budget === '3000'
                    ? 'selected'
                    : ''; ?>
            >
                ₹2,000 - ₹3,000
            </option>

            <option
                value="5000"
                <?= $budget === '5000'
                    ? 'selected'
                    : ''; ?>
            >
                ₹3,000 - ₹5,000
            </option>

            <option
                value="10000"
                <?= $budget === '10000'
                    ? 'selected'
                    : ''; ?>
            >
                ₹5,000 - ₹10,000
            </option>

            <option
                value="10000-plus"
                <?= $budget === '10000-plus'
                    ? 'selected'
                    : ''; ?>
            >
                ₹10,000+
            </option>

        </select>


        <hr>


        <!-- =================================================
             STYLE
        ================================================== -->

        <h2>
            4. Choose Your Style
        </h2>


        <select
            name="style"
            required
        >

            <option value="">
                Select your preferred style
            </option>

            <option
                value="casual"
                <?= $style === 'casual'
                    ? 'selected'
                    : ''; ?>
            >
                Casual
            </option>

            <option
                value="streetwear"
                <?= $style === 'streetwear'
                    ? 'selected'
                    : ''; ?>
            >
                Streetwear
            </option>

            <option
                value="minimal"
                <?= $style === 'minimal'
                    ? 'selected'
                    : ''; ?>
            >
                Minimal
            </option>

            <option
                value="old-money"
                <?= $style === 'old-money'
                    ? 'selected'
                    : ''; ?>
            >
                Old Money
            </option>

            <option
                value="formal"
                <?= $style === 'formal'
                    ? 'selected'
                    : ''; ?>
            >
                Formal
            </option>

            <option
                value="party"
                <?= $style === 'party'
                    ? 'selected'
                    : ''; ?>
            >
                Party
            </option>

            <option
                value="sporty"
                <?= $style === 'sporty'
                    ? 'selected'
                    : ''; ?>
            >
                Sporty
            </option>

            <option
                value="korean"
                <?= $style === 'korean'
                    ? 'selected'
                    : ''; ?>
            >
                Korean
            </option>

            <option
                value="y2k"
                <?= $style === 'y2k'
                    ? 'selected'
                    : ''; ?>
            >
                Y2K
            </option>

            <option
                value="traditional"
                <?= $style === 'traditional'
                    ? 'selected'
                    : ''; ?>
            >
                Traditional
            </option>

        </select>


        <hr>


        <!-- =================================================
             COLOUR
        ================================================== -->

        <h2>
            5. Preferred Colour
        </h2>


        <select name="colour">

            <option value="">
                Let AI decide
            </option>

            <option
                value="black"
                <?= $colour === 'black'
                    ? 'selected'
                    : ''; ?>
            >
                Black
            </option>

            <option
                value="white"
                <?= $colour === 'white'
                    ? 'selected'
                    : ''; ?>
            >
                White
            </option>

            <option
                value="blue"
                <?= $colour === 'blue'
                    ? 'selected'
                    : ''; ?>
            >
                Blue
            </option>

            <option
                value="green"
                <?= $colour === 'green'
                    ? 'selected'
                    : ''; ?>
            >
                Green
            </option>

            <option
                value="red"
                <?= $colour === 'red'
                    ? 'selected'
                    : ''; ?>
            >
                Red
            </option>

            <option
                value="neutral"
                <?= $colour === 'neutral'
                    ? 'selected'
                    : ''; ?>
            >
                Neutral
            </option>

            <option
                value="pastel"
                <?= $colour === 'pastel'
                    ? 'selected'
                    : ''; ?>
            >
                Pastel
            </option>

        </select>


        <hr>


        <!-- =================================================
             EXTRA REQUEST
        ================================================== -->

        <h2>
            6. Anything Else?
        </h2>


        <textarea
            name="extra_request"
            rows="5"
            cols="50"
            placeholder="Example: I want something comfortable because I will be dancing..."
        ><?= htmlspecialchars(
            $extraRequest
        ); ?></textarea>


        <br><br>


        <button
            type="submit"
        >

            ✨ Generate My Look

        </button>


    </form>

</section>


<hr>


<!-- =========================================================
     DEMO SUBMISSION
========================================================= -->

<?php if ($formSubmitted): ?>


    <section>

        <h2>
            🎯 Your Styling Request
        </h2>


        <p>
            Form submitted successfully!
        </p>


        <p>
            The next step will send this information
            to the AI API.
        </p>


        <h3>
            Selected Details
        </h3>


        <ul>

            <li>

                <strong>
                    Occasion:
                </strong>

                <?= htmlspecialchars(
                    $occasions[$selectedOccasion]['name']
                    ?? $selectedOccasion
                ); ?>

            </li>


            <li>

                <strong>
                    Style For:
                </strong>

                <?= htmlspecialchars(
                    ucfirst($gender)
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
                    Style:
                </strong>

                <?= htmlspecialchars(
                    ucfirst(
                        str_replace(
                            '-',
                            ' ',
                            $style
                        )
                    )
                ); ?>

            </li>


            <li>

                <strong>
                    Preferred Colour:
                </strong>

                <?= $colour !== ''
                    ? htmlspecialchars(
                        ucfirst($colour)
                    )
                    : 'AI decides'; ?>

            </li>


            <?php if (
                $extraRequest !== ''
            ): ?>

                <li>

                    <strong>
                        Extra Request:
                    </strong>

                    <?= htmlspecialchars(
                        $extraRequest
                    ); ?>

                </li>

            <?php endif; ?>


        </ul>


        <br>


        <a
            href="result.php?occasion=<?= urlencode($selectedOccasion); ?>&gender=<?= urlencode($gender); ?>&budget=<?= urlencode($budget); ?>&style=<?= urlencode($style); ?>&colour=<?= urlencode($colour); ?>"
        >

            View Demo AI Result →

        </a>


    </section>


<?php endif; ?>


<hr>


<!-- =========================================================
     NAVIGATION
========================================================= -->

<footer>

    <a href="index.php">
        ← AI Fashion Studio
    </a>

    &nbsp;&nbsp;

    <a href="../index.php">
        ← SSISS Store
    </a>

</footer>


</body>

</html>
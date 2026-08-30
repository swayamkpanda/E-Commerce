<?php

session_start();

/*
|--------------------------------------------------------------------------
| SSISS AI FASHION STUDIO
|--------------------------------------------------------------------------
| Main AI features hub
| Demo version - API & MySQL will be connected later
|--------------------------------------------------------------------------
*/

$userName = $_SESSION['user_name'] ?? 'Fashion Lover';

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
        AI Fashion Studio | SSISS
    </title>

</head>


<body>


<!-- =========================================================
     HEADER
========================================================= -->

<header>

    <h1>
        SSISS AI Fashion Studio
    </h1>

    <p>
        Welcome, <?= htmlspecialchars($userName); ?> 👋
    </p>

    <p>
        Your AI-powered personal fashion assistant.
    </p>

</header>


<hr>


<!-- =========================================================
     AI INTRO
========================================================= -->

<section>

    <h2>
        ✨ Find Your Perfect Style
    </h2>

    <p>
        Tell us your vibe, occasion, budget or upload your photo.
        Our AI will help you discover outfits that match you.
    </p>

</section>


<hr>


<!-- =========================================================
     AI FEATURES
========================================================= -->

<section>

    <h2>
        Explore AI Features
    </h2>


    <!-- VIBE AI -->

    <article>

        <h3>
            ✨ Vibe Stylist
        </h3>

        <p>
            Choose your vibe and get a complete outfit recommendation.
        </p>

        <a href="vibe.php">
            Try Vibe Stylist →
        </a>

    </article>


    <br>


    <!-- WHAT SUITS ME -->

    <article>

        <h3>
            📸 What Suits Me?
        </h3>

        <p>
            Upload your photo and let AI suggest styles,
            colours and products that may suit your look.
        </p>

        <a href="suits-me.php">
            Find What Suits Me →
        </a>

    </article>


    <br>


    <!-- AI STYLIST -->

    <article>

        <h3>
            👔 AI Personal Stylist
        </h3>

        <p>
            Tell AI what you need and get a personalized outfit.
        </p>

        <a href="stylist.php">
            Ask AI Stylist →
        </a>

    </article>


    <br>


    <!-- OCCASION -->

    <article>

        <h3>
            🎉 Occasion Stylist
        </h3>

        <p>
            Get outfit recommendations for weddings,
            parties, college, interviews and more.
        </p>

        <a href="occasion.php">
            Choose Occasion →
        </a>

    </article>


    <br>


    <!-- TRIP STYLIST -->

    <article>

        <h3>
            ✈️ Trip Stylist
        </h3>

        <p>
            Planning a trip? AI can create outfits
            for every day of your journey.
        </p>

        <a href="trip-stylist.php">
            Plan My Trip →
        </a>

    </article>


    <br>


    <!-- TRY ON -->

    <article>

        <h3>
            🪞 Virtual Try-On
        </h3>

        <p>
            Experience how selected fashion items
            could look on you.
        </p>

        <a href="try-on.php">
            Try It On →
        </a>

    </article>


</section>


<hr>


<!-- =========================================================
     QUICK AI STYLING
========================================================= -->

<section>

    <h2>
        ⚡ Quick Style Generator
    </h2>

    <p>
        Want an outfit instantly?
    </p>


    <form
        action="result.php"
        method="GET"
    >


        <div>

            <label for="vibe">
                Your Vibe:
            </label>

            <select
                id="vibe"
                name="vibe"
                required
            >

                <option value="">
                    Select Vibe
                </option>

                <option value="casual">
                    Casual
                </option>

                <option value="streetwear">
                    Streetwear
                </option>

                <option value="old-money">
                    Old Money
                </option>

                <option value="minimal">
                    Minimal
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

                <option value="y2k">
                    Y2K
                </option>

                <option value="korean">
                    Korean
                </option>

            </select>

        </div>


        <br>


        <div>

            <label for="budget">
                Budget:
            </label>

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
                    ₹5,000+
                </option>

            </select>

        </div>


        <br>


        <div>

            <label for="gender">
                Style For:
            </label>

            <select
                id="gender"
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

        </div>


        <br>


        <button type="submit">

            ✨ Generate My Outfit

        </button>


    </form>

</section>


<hr>


<!-- =========================================================
     AI JOURNEY
========================================================= -->

<section>

    <h2>
        How SSISS AI Works
    </h2>


    <ol>

        <li>
            Tell us about your style
        </li>

        <li>
            Choose your vibe, occasion or budget
        </li>

        <li>
            Upload a photo if you want
        </li>

        <li>
            AI analyzes your requirements
        </li>

        <li>
            AI creates outfit recommendations
        </li>

        <li>
            SSISS finds matching products
        </li>

        <li>
            Add your favourite products to cart
        </li>

    </ol>

</section>


<hr>


<!-- =========================================================
     AI FEATURES COMING SOON
========================================================= -->

<section>

    <h2>
        🚀 More AI Features
    </h2>


    <ul>

        <li>
            👕 Complete Outfit Generator
        </li>

        <li>
            🎨 Colour Combination Finder
        </li>

        <li>
            👓 Spectacle Recommendation
        </li>

        <li>
            ⌚ Watch Recommendation
        </li>

        <li>
            👟 Shoe Matching
        </li>

        <li>
            💰 Budget Optimizer
        </li>

        <li>
            🧠 Personal Style Profile
        </li>

        <li>
            🔥 Trending Style Prediction
        </li>

        <li>
            ♻️ Sustainable Outfit Suggestions
        </li>

        <li>
            🛍️ Complete Look Shopping
        </li>

    </ul>

</section>


<hr>


<!-- =========================================================
     NAVIGATION
========================================================= -->

<footer>

    <p>
        SSISS AI Fashion Studio
    </p>

    <a href="../index.php">
        ← Back to Store
    </a>

</footer>


</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>YFF | Impact</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f3ee;
            color: #151515;
        }

        /* ================= NAVBAR ================= */

        .navbar {
            height: 78px;

            padding: 0 6%;

            background: white;

            border-bottom: 1px solid #ddd;

            display: flex;

            align-items: center;

            justify-content: space-between;

            position: sticky;

            top: 0;

            z-index: 100;
        }

        .logo {
            color: #151515;

            text-decoration: none;

            font-size: 30px;

            font-weight: 900;

            letter-spacing: 5px;
        }

        .nav-links {
            display: flex;

            gap: 28px;

            align-items: center;
        }

        .nav-links a {
            color: #555;

            text-decoration: none;

            font-size: 10px;

            letter-spacing: 1.5px;

            text-transform: uppercase;

            transition: .25s;
        }

        .nav-links a:hover {
            color: #151515;
        }

        .nav-links .active {
            color: #151515;

            font-weight: bold;
        }

        /* ================= HERO ================= */

        .hero {
            max-width: 1250px;

            margin: auto;

            padding: 90px 6% 60px;
        }

        .eyebrow {
            color: #777;

            font-size: 10px;

            letter-spacing: 4px;
        }

        .hero h1 {
            margin-top: 15px;

            font-size: clamp(55px, 9vw, 110px);

            line-height: .85;

            letter-spacing: -7px;
        }

        .hero h1 span {
            color: #55733d;
        }

        .hero-text {
            max-width: 600px;

            margin-top: 30px;

            color: #777;

            line-height: 1.8;

            font-size: 14px;
        }

        /* ================= STATS ================= */

        .stats {
            max-width: 1250px;

            margin: 20px auto 70px;

            padding: 0 6%;

            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 18px;
        }

        .stat {
            background: white;

            border: 1px solid #ddd9d0;

            padding: 30px;

            transition: .3s;
        }

        .stat:hover {
            transform: translateY(-6px);

            box-shadow:
                0 15px 30px
                rgba(0,0,0,.07);
        }

        .stat-number {
            font-size: 38px;

            font-weight: 800;

            letter-spacing: -2px;
        }

        .stat-label {
            margin-top: 10px;

            color: #777;

            font-size: 9px;

            letter-spacing: 2px;

            text-transform: uppercase;
        }

        .stat-icon {
            margin-bottom: 20px;

            font-size: 22px;
        }

        /* ================= IMPACT SECTION ================= */

        .impact-section {
            max-width: 1250px;

            margin: auto;

            padding: 0 6% 80px;
        }

        .section-title {
            margin-bottom: 25px;
        }

        .section-title small {
            color: #777;

            font-size: 9px;

            letter-spacing: 3px;
        }

        .section-title h2 {
            margin-top: 8px;

            font-size: 38px;

            letter-spacing: -2px;
        }

        /* ================= IMPACT CARDS ================= */

        .impact-grid {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 20px;
        }

        .impact-card {
            min-height: 260px;

            padding: 30px;

            background: #171717;

            color: white;

            position: relative;

            overflow: hidden;

            transition: .3s;
        }

        .impact-card:hover {
            transform: translateY(-6px);
        }

        .impact-card::after {
            content: "";

            position: absolute;

            width: 130px;

            height: 130px;

            right: -45px;

            bottom: -45px;

            border-radius: 50%;

            background: #33452b;
        }

        .impact-icon {
            font-size: 30px;

            margin-bottom: 35px;
        }

        .impact-card h3 {
            font-size: 28px;

            letter-spacing: -1px;
        }

        .impact-card p {
            margin-top: 10px;

            max-width: 260px;

            color: #aaa;

            line-height: 1.6;

            font-size: 11px;
        }

        /* ================= PROGRESS ================= */

        .progress-section {
            margin-top: 60px;

            background: white;

            border: 1px solid #ddd9d0;

            padding: 35px;
        }

        .progress-title {
            display: flex;

            justify-content: space-between;

            margin-bottom: 15px;
        }

        .progress-title strong {
            font-size: 12px;
        }

        .progress-title span {
            color: #55733d;

            font-size: 11px;

            font-weight: bold;
        }

        .progress-bar {
            width: 100%;

            height: 8px;

            background: #e3e1da;

            overflow: hidden;
        }

        .progress-fill {
            width: 76%;

            height: 100%;

            background: #55733d;

            animation: grow 1.5s ease;
        }

        @keyframes grow {

            from {
                width: 0;
            }

            to {
                width: 76%;
            }

        }

        /* ================= QUOTE ================= */

        .quote {
            max-width: 900px;

            margin: 80px auto;

            padding: 0 6%;

            text-align: center;
        }

        .quote h2 {
            font-size: clamp(30px, 5vw, 55px);

            line-height: 1.05;

            letter-spacing: -3px;
        }

        .quote span {
            color: #55733d;
        }

        /* ================= FOOTER ================= */

        footer {
            padding: 30px 6%;

            background: #151515;

            color: #888;

            display: flex;

            justify-content: space-between;

            font-size: 9px;

            letter-spacing: 1.5px;
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width: 900px) {

            .nav-links {
                gap: 12px;
            }

            .stats {
                grid-template-columns:
                    repeat(2, 1fr);
            }

            .impact-grid {
                grid-template-columns:
                    1fr 1fr;
            }

        }

        @media(max-width: 600px) {

            .navbar {
                padding: 0 5%;
            }

            .nav-links {
                display: none;
            }

            .hero {
                padding-top: 60px;
            }

            .hero h1 {
                letter-spacing: -4px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .impact-grid {
                grid-template-columns: 1fr;
            }

            footer {
                flex-direction: column;

                gap: 10px;
            }

        }

    </style>

</head>


<body>


<!-- ================= NAVBAR ================= -->

<header class="navbar">

    <a
        href="../index.php"
        class="logo"
    >
        YFF
    </a>


    <nav class="nav-links">

        <a href="../index.php">
            Home
        </a>

        <a href="../shop/index.php">
            Shop
        </a>

        <a href="../ai/stylist.php">
            AI Stylist
        </a>

        <a href="../ai/vibe.php">
            Vibes
        </a>

        <a href="../marketplace/index.php">
            Pre-Loved
        </a>

        <a
            href="index.php"
            class="active"
        >
            Impact
        </a>

    </nav>

</header>


<!-- ================= HERO ================= -->

<section class="hero">

    <div class="eyebrow">
        YFF • SUSTAINABILITY
    </div>

    <h1>
        STYLE THAT
        <span>
            MATTERS.
        </span>
    </h1>

    <p class="hero-text">

        Fashion should not end when you stop wearing it.
        YFF connects conscious shopping, pre-loved fashion,
        donations and rewards to create a more circular
        fashion ecosystem.

    </p>

</section>


<!-- ================= STATS ================= -->

<section class="stats">


    <div class="stat">

        <div class="stat-icon">
            ♻
        </div>

        <div class="stat-number">
            12,450+
        </div>

        <div class="stat-label">
            Clothes Donated
        </div>

    </div>


    <div class="stat">

        <div class="stat-icon">
            ♡
        </div>

        <div class="stat-number">
            8,560+
        </div>

        <div class="stat-label">
            People Helped
        </div>

    </div>


    <div class="stat">

        <div class="stat-icon">
            ◌
        </div>

        <div class="stat-number">
            2,340 KG
        </div>

        <div class="stat-label">
            CO₂ Reduced
        </div>

    </div>


    <div class="stat">

        <div class="stat-icon">
            ◎
        </div>

        <div class="stat-number">
            56+
        </div>

        <div class="stat-label">
            NGO Partners
        </div>

    </div>


</section>


<!-- ================= IMPACT ================= -->

<section class="impact-section">


    <div class="section-title">

        <small>
            OUR COMMUNITY
        </small>

        <h2>
            Every choice creates impact.
        </h2>

    </div>


    <div class="impact-grid">


        <div class="impact-card">

            <div class="impact-icon">
                ♻️
            </div>

            <h3>
                Give Fashion
                A Second Life
            </h3>

            <p>
                Resell or donate clothes instead of
                sending them to landfill.
            </p>

        </div>


        <div class="impact-card">

            <div class="impact-icon">
                🌱
            </div>

            <h3>
                Reduce
                Fashion Waste
            </h3>

            <p>
                Pre-loved fashion extends the life
                of garments and reduces unnecessary
                production.
            </p>

        </div>


        <div class="impact-card">

            <div class="impact-icon">
                🤝
            </div>

            <h3>
                Support
                Communities
            </h3>

            <p>
                Donations connect unused clothing
                with people and organizations that
                need them.
            </p>

        </div>


    </div>


    <!-- ================= PROGRESS ================= -->

    <div class="progress-section">

        <div class="progress-title">

            <strong>
                COMMUNITY CIRCULARITY GOAL
            </strong>

            <span>
                76%
            </span>

        </div>


        <div class="progress-bar">

            <div class="progress-fill"></div>

        </div>

    </div>


</section>


<!-- ================= QUOTE ================= -->

<section class="quote">

    <h2>

        “Look good.
        <span>
            Do good.
        </span>
        Make fashion last.”

    </h2>

</section>


<!-- ================= FOOTER ================= -->

<footer>

    <span>
        YFF • YOUR FASHION FUTURE
    </span>

    <span>
        DEMO / PROTOTYPE
    </span>

</footer>


</body>

</html>
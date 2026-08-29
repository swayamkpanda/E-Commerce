<?php

session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/functions.php';

$stats = [
    'items_reused' => 0,
    'textiles_saved' => 0,
    'people_helped' => 0,
    'donations_completed' => 0
];

$recentStories = [];

try {

    /*
    |--------------------------------------------------------------------------
    | Overall Impact Statistics
    |--------------------------------------------------------------------------
    */

    $stmt = $pdo->query("
        SELECT
            COUNT(*) AS donations_completed,
            COALESCE(SUM(quantity), 0) AS items_reused
        FROM donations
        WHERE status IN ('verified', 'completed', 'distributed')
    ");

    $donationStats = $stmt->fetch();

    if ($donationStats) {
        $stats['donations_completed'] =
            (int) $donationStats['donations_completed'];

        $stats['items_reused'] =
            (int) $donationStats['items_reused'];
    }


    /*
    |--------------------------------------------------------------------------
    | People Helped
    |--------------------------------------------------------------------------
    */

    $stmt = $pdo->query("
        SELECT COUNT(*) AS people_helped
        FROM impact_records
        WHERE status = 'completed'
    ");

    $impactStats = $stmt->fetch();

    if ($impactStats) {
        $stats['people_helped'] =
            (int) $impactStats['people_helped'];
    }


    /*
    |--------------------------------------------------------------------------
    | Estimated Textile Weight
    |--------------------------------------------------------------------------
    |
    | This is an estimate based on average textile weight.
    | We can make this configurable later.
    |
    */

    $stats['textiles_saved'] =
        round($stats['items_reused'] * 0.45, 1);


    /*
    |--------------------------------------------------------------------------
    | Recent Impact Stories
    |--------------------------------------------------------------------------
    */

    $stmt = $pdo->query("
        SELECT
            id,
            title,
            short_description,
            image,
            created_at
        FROM impact_stories
        WHERE status = 'published'
        ORDER BY created_at DESC
        LIMIT 3
    ");

    $recentStories = $stmt->fetchAll();

} catch (PDOException $e) {

    // Keep page usable even if impact tables aren't created yet.

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

    <title>Our Impact | SSISS</title>

    <link
        rel="stylesheet"
        href="../assets/css/style.css"
    >

    <link
        rel="stylesheet"
        href="../assets/css/impact.css"
    >

</head>

<body>

<?php include_once __DIR__ . '/../includes/navbar.php'; ?>


<main class="impact-page">


    <!-- HERO -->

    <section class="impact-hero">

        <div class="impact-hero-content">

            <span class="eyebrow">
                STYLE WITH PURPOSE ❤️
            </span>

            <h1>
                Fashion that<br>
                creates impact.
            </h1>

            <p>
                At SSISS, your clothes don't have to end
                their journey when you're done wearing them.
                Give them a second life and help someone
                along the way.
            </p>

            <div class="hero-actions">

                <a
                    href="../donation/donate.php"
                    class="primary-btn"
                >
                    Donate Clothes →
                </a>

                <a
                    href="stories.php"
                    class="secondary-btn"
                >
                    See Our Stories
                </a>

            </div>

        </div>


        <div class="impact-hero-card">

            <div class="impact-symbol">
                ♻️
            </div>

            <h3>
                WEAR.
                <br>
                REUSE.
                <br>
                IMPACT.
            </h3>

        </div>

    </section>


    <!-- STATS -->

    <section class="impact-stats">

        <div class="section-heading centered">

            <span class="eyebrow">
                OUR COLLECTIVE IMPACT
            </span>

            <h2>
                Small actions. Big difference.
            </h2>

        </div>


        <div class="stats-grid">


            <div class="impact-stat-card">

                <span class="stat-icon">
                    ♻️
                </span>

                <strong>
                    <?= number_format(
                        $stats['items_reused']
                    ) ?>
                </strong>

                <span>
                    Items Reused
                </span>

            </div>


            <div class="impact-stat-card">

                <span class="stat-icon">
                    🌱
                </span>

                <strong>
                    <?= number_format(
                        $stats['textiles_saved'],
                        1
                    ) ?>
                    kg
                </strong>

                <span>
                    Textiles Diverted
                </span>

            </div>


            <div class="impact-stat-card">

                <span class="stat-icon">
                    ❤️
                </span>

                <strong>
                    <?= number_format(
                        $stats['people_helped']
                    ) ?>
                </strong>

                <span>
                    People Helped
                </span>

            </div>


            <div class="impact-stat-card">

                <span class="stat-icon">
                    🤝
                </span>

                <strong>
                    <?= number_format(
                        $stats['donations_completed']
                    ) ?>
                </strong>

                <span>
                    Donations Completed
                </span>

            </div>


        </div>

    </section>


    <!-- HOW IT WORKS -->

    <section class="impact-process">

        <div class="section-heading centered">

            <span class="eyebrow">
                HOW IT WORKS
            </span>

            <h2>
                From your closet to someone's life.
            </h2>

        </div>


        <div class="process-grid">


            <div class="process-card">

                <span class="process-number">
                    01
                </span>

                <div class="process-icon">
                    👕
                </div>

                <h3>
                    You Donate
                </h3>

                <p>
                    Choose clothes or accessories you
                    no longer need.
                </p>

            </div>


            <div class="process-card">

                <span class="process-number">
                    02
                </span>

                <div class="process-icon">
                    🚚
                </div>

                <h3>
                    We Collect
                </h3>

                <p>
                    Request a pickup or drop your items
                    at a supported location.
                </p>

            </div>


            <div class="process-card">

                <span class="process-number">
                    03
                </span>

                <div class="process-icon">
                    🤝
                </div>

                <h3>
                    NGO Receives
                </h3>

                <p>
                    Verified NGO partners receive and
                    process your donation.
                </p>

            </div>


            <div class="process-card">

                <span class="process-number">
                    04
                </span>

                <div class="process-icon">
                    🪙
                </div>

                <h3>
                    You Earn
                </h3>

                <p>
                    Eligible donations earn SSISS Coins
                    after verification.
                </p>

            </div>


        </div>

    </section>


    <!-- STORIES -->

    <section class="impact-stories">

        <div class="section-heading">

            <span class="eyebrow">
                REAL STORIES
            </span>

            <h2>
                Where your clothes go.
            </h2>

            <p>
                Follow the journey beyond your wardrobe.
            </p>

        </div>


        <?php if (!empty($recentStories)): ?>

            <div class="stories-grid">

                <?php foreach ($recentStories as $story): ?>

                    <article class="story-card">

                        <?php if (!empty($story['image'])): ?>

                            <img
                                src="../<?= htmlspecialchars(
                                    $story['image']
                                ) ?>"
                                alt="<?= htmlspecialchars(
                                    $story['title']
                                ) ?>"
                            >

                        <?php else: ?>

                            <div class="story-placeholder">
                                ❤️
                            </div>

                        <?php endif; ?>


                        <div class="story-content">

                            <h3>
                                <?= htmlspecialchars(
                                    $story['title']
                                ) ?>
                            </h3>

                            <p>
                                <?= htmlspecialchars(
                                    $story['short_description']
                                ) ?>
                            </p>

                            <a
                                href="stories.php?id=<?= (int)$story['id'] ?>"
                            >
                                Read Story →
                            </a>

                        </div>

                    </article>

                <?php endforeach; ?>

            </div>

        <?php else: ?>

            <div class="empty-impact">

                <div>
                    🌱
                </div>

                <h3>
                    Our impact stories are coming soon.
                </h3>

                <p>
                    We're working with our NGO partners to
                    document the journey of every donation.
                </p>

            </div>

        <?php endif; ?>


        <div class="center-action">

            <a
                href="stories.php"
                class="secondary-btn"
            >
                View All Stories →
            </a>

        </div>

    </section>


    <!-- CTA -->

    <section class="impact-cta">

        <div>

            <span class="eyebrow">
                READY TO MAKE A DIFFERENCE?
            </span>

            <h2>
                Your closet can do more.
            </h2>

            <p>
                Give your unused clothes a second life.
            </p>

        </div>

        <a
            href="../donation/donate.php"
            class="primary-btn"
        >
            Start Donating →
        </a>

    </section>


</main>


<?php include_once __DIR__ . '/../includes/footer.php'; ?>

</body>
</html>
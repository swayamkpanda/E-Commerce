<?php

session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/functions.php';

$stories = [];
$selectedStory = null;

$story_id = (int) ($_GET['id'] ?? 0);

try {

    /*
    |--------------------------------------------------------------------------
    | Single Story
    |--------------------------------------------------------------------------
    */

    if ($story_id > 0) {

        $stmt = $pdo->prepare("
            SELECT
                id,
                title,
                short_description,
                content,
                image,
                location,
                created_at
            FROM impact_stories
            WHERE id = :id
            AND status = 'published'
            LIMIT 1
        ");

        $stmt->execute([
            ':id' => $story_id
        ]);

        $selectedStory = $stmt->fetch();

    }


    /*
    |--------------------------------------------------------------------------
    | All Stories
    |--------------------------------------------------------------------------
    */

    $stmt = $pdo->query("
        SELECT
            id,
            title,
            short_description,
            image,
            location,
            created_at
        FROM impact_stories
        WHERE status = 'published'
        ORDER BY created_at DESC
    ");

    $stories = $stmt->fetchAll();

} catch (PDOException $e) {

    $stories = [];

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
        <?= $selectedStory
            ? htmlspecialchars($selectedStory['title'])
            : 'Impact Stories' ?> | SSISS
    </title>

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


    <?php if ($selectedStory): ?>

        <!-- SINGLE STORY -->

        <section class="single-story">

            <a
                href="stories.php"
                class="back-link"
            >
                ← Back to Stories
            </a>


            <?php if (!empty($selectedStory['image'])): ?>

                <img
                    class="single-story-image"
                    src="../<?= htmlspecialchars(
                        $selectedStory['image']
                    ) ?>"
                    alt="<?= htmlspecialchars(
                        $selectedStory['title']
                    ) ?>"
                >

            <?php endif; ?>


            <div class="single-story-content">

                <span class="eyebrow">
                    IMPACT STORY
                </span>

                <h1>
                    <?= htmlspecialchars(
                        $selectedStory['title']
                    ) ?>
                </h1>


                <?php if (
                    !empty($selectedStory['location'])
                ): ?>

                    <div class="story-location">
                        📍
                        <?= htmlspecialchars(
                            $selectedStory['location']
                        ) ?>
                    </div>

                <?php endif; ?>


                <p class="story-lead">
                    <?= htmlspecialchars(
                        $selectedStory['short_description']
                    ) ?>
                </p>


                <div class="story-body">

                    <?= nl2br(
                        htmlspecialchars(
                            $selectedStory['content']
                        )
                    ) ?>

                </div>


                <small class="story-date">

                    Published
                    <?= htmlspecialchars(
                        date(
                            'd M Y',
                            strtotime(
                                $selectedStory['created_at']
                            )
                        )
                    ) ?>

                </small>

            </div>

        </section>


    <?php else: ?>


        <!-- ALL STORIES -->

        <section class="stories-header">

            <span class="eyebrow">
                BEYOND THE WARDROBE
            </span>

            <h1>
                Impact Stories ❤️
            </h1>

            <p>
                Real stories from the people, communities
                and organizations touched by your choices.
            </p>

        </section>


        <?php if (!empty($stories)): ?>

            <div class="stories-grid large">

                <?php foreach ($stories as $story): ?>

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

                            <span class="story-tag">
                                <?= !empty(
                                    $story['location']
                                )
                                    ? htmlspecialchars(
                                        $story['location']
                                    )
                                    : 'SSISS IMPACT'
                                ?>
                            </span>


                            <h2>
                                <?= htmlspecialchars(
                                    $story['title']
                                ) ?>
                            </h2>


                            <p>
                                <?= htmlspecialchars(
                                    $story[
                                        'short_description'
                                    ]
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

                <h2>
                    Stories are coming soon.
                </h2>

                <p>
                    Once our NGO partners begin publishing
                    verified impact stories, they'll appear here.
                </p>

            </div>

        <?php endif; ?>


    <?php endif; ?>


</main>


<?php include_once __DIR__ . '/../includes/footer.php'; ?>

</body>
</html>
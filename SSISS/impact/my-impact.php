<?php

session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$impact = [
    'items_donated' => 0,
    'donations' => 0,
    'people_helped' => 0,
    'textiles_saved' => 0,
    'coins_earned' => 0
];

$donations = [];
$impactRecords = [];

try {

    /*
    |--------------------------------------------------------------------------
    | User Donation Statistics
    |--------------------------------------------------------------------------
    */

    $stmt = $pdo->prepare("
        SELECT
            COUNT(*) AS donations,
            COALESCE(SUM(quantity), 0) AS items_donated
        FROM donations
        WHERE user_id = :user_id
        AND status IN (
            'verified',
            'completed',
            'distributed'
        )
    ");

    $stmt->execute([
        ':user_id' => $user_id
    ]);

    $stats = $stmt->fetch();

    if ($stats) {

        $impact['donations'] =
            (int) $stats['donations'];

        $impact['items_donated'] =
            (int) $stats['items_donated'];

    }


    /*
    |--------------------------------------------------------------------------
    | Personal Impact Records
    |--------------------------------------------------------------------------
    */

    $stmt = $pdo->prepare("
        SELECT
            id,
            donation_id,
            people_helped,
            textile_weight,
            description,
            created_at
        FROM impact_records
        WHERE user_id = :user_id
        ORDER BY created_at DESC
    ");

    $stmt->execute([
        ':user_id' => $user_id
    ]);

    $impactRecords = $stmt->fetchAll();


    foreach ($impactRecords as $record) {

        $impact['people_helped'] +=
            (int) $record['people_helped'];

        $impact['textiles_saved'] +=
            (float) $record['textile_weight'];

    }


    /*
    |--------------------------------------------------------------------------
    | Coin Transactions Related To Donations
    |--------------------------------------------------------------------------
    */

    $stmt = $pdo->prepare("
        SELECT
            COALESCE(SUM(amount), 0) AS coins_earned
        FROM coin_transactions
        WHERE user_id = :user_id
        AND transaction_type = 'donation_reward'
        AND amount > 0
    ");

    $stmt->execute([
        ':user_id' => $user_id
    ]);

    $coinStats = $stmt->fetch();

    if ($coinStats) {

        $impact['coins_earned'] =
            (int) $coinStats['coins_earned'];

    }


    /*
    |--------------------------------------------------------------------------
    | Donation Timeline
    |--------------------------------------------------------------------------
    */

    $stmt = $pdo->prepare("
        SELECT
            id,
            item_type,
            quantity,
            status,
            created_at
        FROM donations
        WHERE user_id = :user_id
        ORDER BY created_at DESC
        LIMIT 10
    ");

    $stmt->execute([
        ':user_id' => $user_id
    ]);

    $donations = $stmt->fetchAll();

} catch (PDOException $e) {

    // Keep dashboard available before all DB tables are created.

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

    <title>My Impact | SSISS</title>

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


    <!-- HEADER -->

    <section class="my-impact-header">

        <span class="eyebrow">
            YOUR CONTRIBUTION
        </span>

        <h1>
            My Impact 🌱
        </h1>

        <p>
            Every item you've given a second life is part
            of something bigger.
        </p>

    </section>


    <!-- PERSONAL STATS -->

    <section class="personal-impact-stats">


        <div class="personal-stat">

            <span>
                👕
            </span>

            <strong>
                <?= number_format(
                    $impact['items_donated']
                ) ?>
            </strong>

            <small>
                Items Donated
            </small>

        </div>


        <div class="personal-stat">

            <span>
                ♻️
            </span>

            <strong>
                <?= number_format(
                    $impact['donations']
                ) ?>
            </strong>

            <small>
                Successful Donations
            </small>

        </div>


        <div class="personal-stat">

            <span>
                ❤️
            </span>

            <strong>
                <?= number_format(
                    $impact['people_helped']
                ) ?>
            </strong>

            <small>
                People Helped
            </small>

        </div>


        <div class="personal-stat">

            <span>
                🌱
            </span>

            <strong>
                <?= number_format(
                    $impact['textiles_saved'],
                    1
                ) ?>
                kg
            </strong>

            <small>
                Textiles Diverted
            </small>

        </div>


        <div class="personal-stat coin-stat">

            <span>
                🪙
            </span>

            <strong>
                <?= number_format(
                    $impact['coins_earned']
                ) ?>
            </strong>

            <small>
                Coins Earned
            </small>

        </div>


    </section>


    <!-- IMPACT MESSAGE -->

    <section class="personal-impact-message">

        <div class="impact-message-icon">
            💚
        </div>

        <div>

            <span class="eyebrow">
                KEEP GOING
            </span>

            <h2>
                Your choices matter.
            </h2>

            <p>
                The more you reuse, donate and resell,
                the more you contribute to a circular
                fashion ecosystem.
            </p>

        </div>

    </section>


    <!-- DONATION TIMELINE -->

    <section class="impact-timeline">

        <div class="section-heading">

            <span class="eyebrow">
                YOUR JOURNEY
            </span>

            <h2>
                Donation History
            </h2>

        </div>


        <?php if (!empty($donations)): ?>

            <div class="timeline">

                <?php foreach ($donations as $donation): ?>

                    <div class="timeline-item">

                        <div class="timeline-dot">
                            ♻️
                        </div>


                        <div class="timeline-content">

                            <div class="timeline-top">

                                <h3>
                                    <?= htmlspecialchars(
                                        $donation[
                                            'item_type'
                                        ]
                                    ) ?>
                                </h3>

                                <span
                                    class="status-badge"
                                >
                                    <?= htmlspecialchars(
                                        ucfirst(
                                            str_replace(
                                                '_',
                                                ' ',
                                                $donation[
                                                    'status'
                                                ]
                                            )
                                        )
                                    ) ?>
                                </span>

                            </div>


                            <p>

                                <?= htmlspecialchars(
                                    $donation['quantity']
                                ) ?>

                                item(s)

                            </p>


                            <small>

                                <?= htmlspecialchars(
                                    date(
                                        'd M Y',
                                        strtotime(
                                            $donation[
                                                'created_at'
                                            ]
                                        )
                                    )
                                ) ?>

                            </small>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php else: ?>

            <div class="empty-impact">

                <div>
                    👕
                </div>

                <h3>
                    Your impact journey starts here.
                </h3>

                <p>
                    Donate your first item and watch your
                    personal impact grow.
                </p>

                <a
                    href="../donation/donate.php"
                    class="primary-btn"
                >
                    Donate Now →
                </a>

            </div>

        <?php endif; ?>

    </section>


    <!-- CTA -->

    <section class="impact-cta">

        <div>

            <span class="eyebrow">
                MAKE YOUR NEXT MOVE
            </span>

            <h2>
                Have clothes sitting unused?
            </h2>

            <p>
                Someone could use them.
            </p>

        </div>

        <a
            href="../donation/donate.php"
            class="primary-btn"
        >
            Donate →
        </a>

    </section>


</main>


<?php include_once __DIR__ . '/../includes/footer.php'; ?>

</body>
</html>
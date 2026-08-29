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

$donations = [];
$error = '';

try {

    $stmt = $pdo->prepare("
        SELECT
            id,
            item_type,
            quantity,
            item_condition,
            donation_type,
            preferred_date,
            status,
            created_at
        FROM donations
        WHERE user_id = :user_id
        ORDER BY created_at DESC
    ");

    $stmt->execute([
        ':user_id' => $user_id
    ]);

    $donations = $stmt->fetchAll();

} catch (PDOException $e) {

    $error =
        "Unable to load donation history right now.";
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

    <title>Donation History | SSISS</title>

    <link
        rel="stylesheet"
        href="../assets/css/style.css"
    >

    <link
        rel="stylesheet"
        href="../assets/css/donation.css"
    >

</head>

<body>

<?php include_once __DIR__ . '/../includes/navbar.php'; ?>

<main class="donation-page">

    <section class="history-section">

        <div class="section-heading">

            <span class="eyebrow">
                YOUR IMPACT
            </span>

            <h1>
                Donation History
            </h1>

            <p>
                Track everything you've given a second life.
            </p>

        </div>


        <?php if ($error): ?>

            <div class="form-alert error">

                <?= htmlspecialchars($error) ?>

            </div>

        <?php endif; ?>


        <?php if (empty($donations)): ?>

            <div class="empty-state">

                <div class="empty-icon">
                    ♻️
                </div>

                <h2>
                    No donations yet
                </h2>

                <p>
                    Your first donation could be the beginning
                    of someone's new story.
                </p>

                <a
                    href="donate.php"
                    class="primary-btn"
                >
                    Donate Now →
                </a>

            </div>

        <?php else: ?>


            <div class="donation-history">

                <?php foreach ($donations as $donation): ?>

                    <article class="donation-history-card">

                        <div class="history-icon">

                            <?php

                            $icon = '♻️';

                            if (
                                strtolower(
                                    $donation['item_type']
                                ) === 'shoes'
                            ) {
                                $icon = '👟';
                            } elseif (
                                strtolower(
                                    $donation['item_type']
                                ) === 'watches'
                            ) {
                                $icon = '⌚';
                            } elseif (
                                strtolower(
                                    $donation['item_type']
                                ) === 'eyewear'
                            ) {
                                $icon = '👓';
                            }

                            ?>

                            <?= $icon ?>

                        </div>


                        <div class="history-details">

                            <h3>
                                <?= htmlspecialchars(
                                    $donation['item_type']
                                ) ?>
                            </h3>

                            <p>
                                <?= htmlspecialchars(
                                    $donation['quantity']
                                ) ?>
                                item(s)
                                ·
                                <?= htmlspecialchars(
                                    $donation['item_condition']
                                ) ?>
                            </p>

                            <small>

                                Submitted
                                <?= htmlspecialchars(
                                    date(
                                        'd M Y',
                                        strtotime(
                                            $donation['created_at']
                                        )
                                    )
                                ) ?>

                            </small>

                        </div>


                        <div class="history-status">

                            <span
                                class="status-badge status-<?= htmlspecialchars(
                                    strtolower(
                                        $donation['status']
                                    )
                                ) ?>"
                            >

                                <?= htmlspecialchars(
                                    ucfirst(
                                        str_replace(
                                            '_',
                                            ' ',
                                            $donation['status']
                                        )
                                    )
                                ) ?>

                            </span>


                            <?php if (
                                !empty(
                                    $donation['preferred_date']
                                )
                            ): ?>

                                <small>

                                    Preferred:
                                    <?= htmlspecialchars(
                                        date(
                                            'd M Y',
                                            strtotime(
                                                $donation[
                                                    'preferred_date'
                                                ]
                                            )
                                        )
                                    ) ?>

                                </small>

                            <?php endif; ?>

                        </div>

                    </article>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </section>

</main>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>

</body>
</html>
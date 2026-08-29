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

$donation_id = (int) ($_GET['id'] ?? 0);
$listing_id = (int) ($_GET['listing_id'] ?? 0);

$donation = null;
$listing = null;


/*
|--------------------------------------------------------------------------
| Donation confirmation
|--------------------------------------------------------------------------
*/

if ($donation_id > 0) {

    try {

        $stmt = $pdo->prepare("
            SELECT *
            FROM donations
            WHERE id = :id
            AND user_id = :user_id
            LIMIT 1
        ");

        $stmt->execute([
            ':id' => $donation_id,
            ':user_id' => $user_id
        ]);

        $donation = $stmt->fetch();

    } catch (PDOException $e) {

        $donation = null;
    }
}


/*
|--------------------------------------------------------------------------
| Sell & Donate confirmation
|--------------------------------------------------------------------------
*/

if ($listing_id > 0) {

    try {

        $stmt = $pdo->prepare("
            SELECT *
            FROM resale_listings
            WHERE id = :id
            AND seller_id = :user_id
            LIMIT 1
        ");

        $stmt->execute([
            ':id' => $listing_id,
            ':user_id' => $user_id
        ]);

        $listing = $stmt->fetch();

    } catch (PDOException $e) {

        $listing = null;
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

    <title>Thank You | SSISS</title>

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

    <section class="donation-confirmation">

        <div class="confirmation-icon">
            ✓
        </div>


        <?php if ($donation): ?>

            <span class="eyebrow">
                DONATION SUBMITTED
            </span>

            <h1>
                Thank you for making an impact. ❤️
            </h1>

            <p>
                Your donation has been successfully submitted.
                Our team will review the items and coordinate
                with the NGO.
            </p>


            <div class="confirmation-card">

                <div>
                    <span>
                        Donation ID
                    </span>

                    <strong>
                        #<?= htmlspecialchars($donation['id']) ?>
                    </strong>
                </div>


                <div>
                    <span>
                        Item Type
                    </span>

                    <strong>
                        <?= htmlspecialchars($donation['item_type']) ?>
                    </strong>
                </div>


                <div>
                    <span>
                        Quantity
                    </span>

                    <strong>
                        <?= htmlspecialchars($donation['quantity']) ?>
                    </strong>
                </div>


                <div>
                    <span>
                        Status
                    </span>

                    <strong class="status-badge">
                        <?= htmlspecialchars(
                            ucfirst($donation['status'])
                        ) ?>
                    </strong>
                </div>

            </div>


            <div class="coin-info-box">

                <div class="coin-icon">
                    🪙
                </div>

                <div>

                    <strong>
                        SSISS Coins are coming!
                    </strong>

                    <p>
                        Once your donation is verified,
                        eligible SSISS Coins will be added
                        to your wallet.
                    </p>

                </div>

            </div>


        <?php elseif ($listing): ?>

            <span class="eyebrow">
                LISTING CREATED
            </span>

            <h1>
                Your item is ready for impact. 🌱
            </h1>

            <p>
                Your sell-and-donate listing has been submitted
                for review.
            </p>


            <div class="confirmation-card">

                <div>

                    <span>
                        Listing ID
                    </span>

                    <strong>
                        #<?= htmlspecialchars($listing['id']) ?>
                    </strong>

                </div>


                <div>

                    <span>
                        Item
                    </span>

                    <strong>
                        <?= htmlspecialchars($listing['title']) ?>
                    </strong>

                </div>


                <div>

                    <span>
                        Price
                    </span>

                    <strong>
                        ₹<?= number_format(
                            (float)$listing['price']
                        ) ?>
                    </strong>

                </div>


                <div>

                    <span>
                        Status
                    </span>

                    <strong>
                        Pending Review
                    </strong>

                </div>

            </div>


        <?php else: ?>

            <span class="eyebrow">
                SSISS
            </span>

            <h1>
                Request not found.
            </h1>

            <p>
                We couldn't find the requested donation.
            </p>

        <?php endif; ?>


        <div class="confirmation-actions">

            <a
                href="../donation/index.php"
                class="secondary-btn"
            >
                Back to Donations
            </a>

            <a
                href="../index.php"
                class="primary-btn"
            >
                Continue Shopping →
            </a>

        </div>

    </section>

</main>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>

</body>
</html>
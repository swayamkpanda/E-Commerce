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

$donation_id = (int) ($_GET['donation_id'] ?? 0);

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $donation_id = (int) ($_POST['donation_id'] ?? 0);

    $address = trim($_POST['address'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $pincode = trim($_POST['pincode'] ?? '');
    $pickup_date = trim($_POST['pickup_date'] ?? '');
    $pickup_time = trim($_POST['pickup_time'] ?? '');

    if ($donation_id <= 0) {
        $error = "Invalid donation.";
    } elseif ($address === '') {
        $error = "Please enter your pickup address.";
    } elseif ($city === '') {
        $error = "Please enter your city.";
    } elseif ($pincode === '') {
        $error = "Please enter your pincode.";
    } elseif ($pickup_date === '') {
        $error = "Please select a pickup date.";
    } elseif ($pickup_time === '') {
        $error = "Please select a pickup time.";
    } else {

        try {

            // Verify donation belongs to user
            $stmt = $pdo->prepare("
                SELECT id
                FROM donations
                WHERE id = :donation_id
                AND user_id = :user_id
                LIMIT 1
            ");

            $stmt->execute([
                ':donation_id' => $donation_id,
                ':user_id' => $user_id
            ]);

            $donation = $stmt->fetch();

            if (!$donation) {

                $error = "Donation not found.";

            } else {

                $stmt = $pdo->prepare("
                    INSERT INTO pickup_requests
                    (
                        donation_id,
                        user_id,
                        address,
                        city,
                        pincode,
                        pickup_date,
                        pickup_time,
                        status,
                        created_at
                    )
                    VALUES
                    (
                        :donation_id,
                        :user_id,
                        :address,
                        :city,
                        :pincode,
                        :pickup_date,
                        :pickup_time,
                        'requested',
                        NOW()
                    )
                ");

                $stmt->execute([
                    ':donation_id' => $donation_id,
                    ':user_id' => $user_id,
                    ':address' => $address,
                    ':city' => $city,
                    ':pincode' => $pincode,
                    ':pickup_date' => $pickup_date,
                    ':pickup_time' => $pickup_time
                ]);

                $stmt = $pdo->prepare("
                    UPDATE donations
                    SET status = 'pickup_requested'
                    WHERE id = :id
                    AND user_id = :user_id
                ");

                $stmt->execute([
                    ':id' => $donation_id,
                    ':user_id' => $user_id
                ]);

                header(
                    "Location: confirmation.php?id=" .
                    urlencode($donation_id)
                );

                exit;
            }

        } catch (PDOException $e) {

            $error =
                "Unable to request pickup right now.";
        }
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

    <title>Request Pickup | SSISS</title>

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

    <section class="donation-form-section">

        <div class="section-heading">

            <span class="eyebrow">
                PICKUP
            </span>

            <h1>
                We'll come to you 🚚
            </h1>

            <p>
                Enter your pickup details and we'll coordinate
                with our NGO partners.
            </p>

        </div>


        <?php if ($error): ?>

            <div class="form-alert error">
                <?= htmlspecialchars($error) ?>
            </div>

        <?php endif; ?>


        <form
            method="POST"
            class="donation-form"
        >

            <input
                type="hidden"
                name="donation_id"
                value="<?= htmlspecialchars($donation_id) ?>"
            >


            <div class="form-group">

                <label for="address">
                    Pickup Address
                </label>

                <textarea
                    id="address"
                    name="address"
                    rows="4"
                    placeholder="House number, street, area..."
                    required
                ></textarea>

            </div>


            <div class="form-row">

                <div class="form-group">

                    <label for="city">
                        City
                    </label>

                    <input
                        type="text"
                        id="city"
                        name="city"
                        placeholder="Your city"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="pincode">
                        Pincode
                    </label>

                    <input
                        type="text"
                        id="pincode"
                        name="pincode"
                        maxlength="6"
                        pattern="[0-9]{6}"
                        placeholder="560001"
                        required
                    >

                </div>

            </div>


            <div class="form-row">

                <div class="form-group">

                    <label for="pickup_date">
                        Preferred Date
                    </label>

                    <input
                        type="date"
                        id="pickup_date"
                        name="pickup_date"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="pickup_time">
                        Preferred Time
                    </label>

                    <select
                        id="pickup_time"
                        name="pickup_time"
                        required
                    >

                        <option value="">
                            Select time
                        </option>

                        <option value="09:00-12:00">
                            9 AM – 12 PM
                        </option>

                        <option value="12:00-15:00">
                            12 PM – 3 PM
                        </option>

                        <option value="15:00-18:00">
                            3 PM – 6 PM
                        </option>

                    </select>

                </div>

            </div>


            <button
                type="submit"
                class="primary-btn"
            >
                Request Pickup →
            </button>

        </form>

    </section>

</main>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>


<script>

const pickupDate =
    document.getElementById('pickup_date');

if (pickupDate) {

    const today =
        new Date().toISOString().split('T')[0];

    pickupDate.min = today;

}

</script>

</body>
</html>
<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/functions.php';

// User must be logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$errors = [];
$success = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $item_type = trim($_POST['item_type'] ?? '');
    $quantity = (int)($_POST['quantity'] ?? 0);
    $condition = trim($_POST['condition'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $donation_type = trim($_POST['donation_type'] ?? '');
    $preferred_date = trim($_POST['preferred_date'] ?? '');

    // Validation
    if ($item_type === '') {
        $errors[] = "Please select the type of item.";
    }

    if ($quantity <= 0) {
        $errors[] = "Please enter a valid quantity.";
    }

    if ($condition === '') {
        $errors[] = "Please select the condition of the items.";
    }

    if ($donation_type === '') {
        $errors[] = "Please select a donation method.";
    }

    if (empty($errors)) {

        /*
         * Database insertion will be connected once
         * the donations table is created in schema.sql.
         *
         * Expected fields:
         * user_id
         * item_type
         * quantity
         * condition
         * description
         * donation_type
         * preferred_date
         * status
         */

        try {

            $stmt = $pdo->prepare("
                INSERT INTO donations
                (
                    user_id,
                    item_type,
                    quantity,
                    item_condition,
                    description,
                    donation_type,
                    preferred_date,
                    status,
                    created_at
                )
                VALUES
                (
                    :user_id,
                    :item_type,
                    :quantity,
                    :item_condition,
                    :description,
                    :donation_type,
                    :preferred_date,
                    'pending',
                    NOW()
                )
            ");

            $stmt->execute([
                ':user_id' => $user_id,
                ':item_type' => $item_type,
                ':quantity' => $quantity,
                ':item_condition' => $condition,
                ':description' => $description,
                ':donation_type' => $donation_type,
                ':preferred_date' => $preferred_date ?: null
            ]);

            $donation_id = $pdo->lastInsertId();

            header(
                "Location: confirmation.php?id=" .
                urlencode($donation_id)
            );
            exit;

        } catch (PDOException $e) {

            // Don't expose database errors to users.
            $errors[] = "Unable to submit your donation right now. Please try again.";
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

    <title>Donate Clothes | SSISS</title>

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

    <!-- Hero -->

    <section class="donation-hero">

        <div class="donation-hero-content">

            <span class="eyebrow">
                ♻️ GIVE IT A SECOND LIFE
            </span>

            <h1>
                Your clothes can<br>
                help someone.
            </h1>

            <p>
                Donate clothes you no longer need and help
                create a more sustainable future while earning
                SSISS Coins.
            </p>

            <div class="donation-benefits">

                <div class="benefit">
                    <span>♻️</span>
                    <div>
                        <strong>Reduce waste</strong>
                        <small>Give clothes a second life</small>
                    </div>
                </div>

                <div class="benefit">
                    <span>❤️</span>
                    <div>
                        <strong>Help communities</strong>
                        <small>Your donation reaches an NGO</small>
                    </div>
                </div>

                <div class="benefit">
                    <span>🪙</span>
                    <div>
                        <strong>Earn SSISS Coins</strong>
                        <small>Use coins for future discounts</small>
                    </div>
                </div>

            </div>

        </div>

        <div class="donation-hero-visual">

            <div class="hero-card">

                <div class="hero-card-icon">
                    ♻️
                </div>

                <h3>
                    STYLE WITH PURPOSE
                </h3>

                <p>
                    Every donation creates another story.
                </p>

            </div>

        </div>

    </section>


    <!-- Donation Form -->

    <section class="donation-form-section">

        <div class="section-heading">

            <span class="eyebrow">
                DONATION DETAILS
            </span>

            <h2>
                Tell us about your donation
            </h2>

            <p>
                A few details help us make sure your items
                reach the right place.
            </p>

        </div>


        <?php if (!empty($errors)): ?>

            <div class="form-alert error">

                <?php foreach ($errors as $error): ?>

                    <p>
                        <?= htmlspecialchars($error) ?>
                    </p>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>


        <form
            method="POST"
            action=""
            class="donation-form"
            id="donationForm"
        >

            <!-- Item Type -->

            <div class="form-group">

                <label for="item_type">
                    What are you donating?
                </label>

                <select
                    name="item_type"
                    id="item_type"
                    required
                >

                    <option value="">
                        Select item type
                    </option>

                    <option value="Clothing">
                        👕 Clothing
                    </option>

                    <option value="Shoes">
                        👟 Shoes
                    </option>

                    <option value="Accessories">
                        👜 Accessories
                    </option>

                    <option value="Watches">
                        ⌚ Watches
                    </option>

                    <option value="Eyewear">
                        👓 Eyewear
                    </option>

                    <option value="Mixed">
                        📦 Mixed Items
                    </option>

                </select>

            </div>


            <!-- Quantity -->

            <div class="form-group">

                <label for="quantity">
                    Number of items
                </label>

                <input
                    type="number"
                    name="quantity"
                    id="quantity"
                    min="1"
                    max="100"
                    placeholder="Example: 5"
                    required
                >

            </div>


            <!-- Condition -->

            <div class="form-group">

                <label>
                    Condition of the items
                </label>

                <div class="condition-options">

                    <label class="condition-card">

                        <input
                            type="radio"
                            name="condition"
                            value="Excellent"
                            required
                        >

                        <span class="condition-content">

                            <strong>
                                Excellent
                            </strong>

                            <small>
                                Almost new / barely used
                            </small>

                        </span>

                    </label>


                    <label class="condition-card">

                        <input
                            type="radio"
                            name="condition"
                            value="Good"
                        >

                        <span class="condition-content">

                            <strong>
                                Good
                            </strong>

                            <small>
                                Used but well maintained
                            </small>

                        </span>

                    </label>


                    <label class="condition-card">

                        <input
                            type="radio"
                            name="condition"
                            value="Fair"
                        >

                        <span class="condition-content">

                            <strong>
                                Fair
                            </strong>

                            <small>
                                Visible signs of use
                            </small>

                        </span>

                    </label>

                </div>

            </div>


            <!-- Donation Method -->

            <div class="form-group">

                <label>
                    How would you like to donate?
                </label>

                <div class="donation-methods">

                    <label class="method-card">

                        <input
                            type="radio"
                            name="donation_type"
                            value="pickup"
                            required
                        >

                        <span>

                            <strong>
                                🚚 Request Pickup
                            </strong>

                            <small>
                                We'll arrange a pickup from your address.
                            </small>

                        </span>

                    </label>


                    <label class="method-card">

                        <input
                            type="radio"
                            name="donation_type"
                            value="dropoff"
                        >

                        <span>

                            <strong>
                                📍 Drop Off
                            </strong>

                            <small>
                                Take your items to a supported NGO location.
                            </small>

                        </span>

                    </label>

                </div>

            </div>


            <!-- Preferred Date -->

            <div class="form-group">

                <label for="preferred_date">
                    Preferred pickup/drop-off date
                </label>

                <input
                    type="date"
                    name="preferred_date"
                    id="preferred_date"
                >

            </div>


            <!-- Description -->

            <div class="form-group">

                <label for="description">
                    Additional details
                </label>

                <textarea
                    name="description"
                    id="description"
                    rows="5"
                    maxlength="500"
                    placeholder="Tell us anything important about your donation..."
                ></textarea>

                <div class="character-count">
                    <span id="charCount">0</span>/500
                </div>

            </div>


            <!-- Coin Info -->

            <div class="coin-info-box">

                <div class="coin-icon">
                    🪙
                </div>

                <div>

                    <strong>
                        Earn SSISS Coins
                    </strong>

                    <p>
                        Once your donation is verified by the NGO,
                        you'll receive SSISS Coins that can be used
                        for discounts on SSISS.
                    </p>

                </div>

            </div>


            <!-- Submit -->

            <button
                type="submit"
                class="primary-btn"
            >
                Submit Donation
                <span>→</span>
            </button>

        </form>

    </section>

</main>


<?php include_once __DIR__ . '/../includes/footer.php'; ?>


<script src="../assets/js/main.js"></script>

<script>

const description = document.getElementById('description');
const charCount = document.getElementById('charCount');

if (description && charCount) {

    description.addEventListener('input', function () {

        charCount.textContent = this.value.length;

    });

}


// Prevent selecting dates in the past

const dateInput = document.getElementById('preferred_date');

if (dateInput) {

    const today = new Date();

    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');

    dateInput.min = `${year}-${month}-${day}`;

}


// Basic submit protection

const form = document.getElementById('donationForm');

if (form) {

    form.addEventListener('submit', function () {

        const button = form.querySelector('button[type="submit"]');

        if (button) {

            button.disabled = true;
            button.innerHTML = 'Submitting...';

        }

    });

}

</script>

</body>
</html>
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

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $condition = trim($_POST['condition'] ?? '');
    $price = (float) ($_POST['price'] ?? 0);
    $description = trim($_POST['description'] ?? '');

    if ($title === '') {
        $error = "Please enter an item title.";
    } elseif ($category === '') {
        $error = "Please select a category.";
    } elseif ($condition === '') {
        $error = "Please select the condition.";
    } elseif ($price <= 0) {
        $error = "Please enter a valid price.";
    } else {

        try {

            /*
             * resale_listings table will be created in schema.sql.
             */

            $stmt = $pdo->prepare("
                INSERT INTO resale_listings
                (
                    seller_id,
                    title,
                    category,
                    item_condition,
                    price,
                    description,
                    donation_mode,
                    status,
                    created_at
                )
                VALUES
                (
                    :seller_id,
                    :title,
                    :category,
                    :item_condition,
                    :price,
                    :description,
                    'sell_and_donate',
                    'pending',
                    NOW()
                )
            ");

            $stmt->execute([
                ':seller_id' => $user_id,
                ':title' => $title,
                ':category' => $category,
                ':item_condition' => $condition,
                ':price' => $price,
                ':description' => $description
            ]);

            $listing_id = $pdo->lastInsertId();

            header(
                "Location: confirmation.php?listing_id=" .
                urlencode($listing_id)
            );

            exit;

        } catch (PDOException $e) {

            $error =
                "Unable to create your listing right now.";
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

    <title>Sell & Donate | SSISS</title>

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
                SELL FOR IMPACT
            </span>

            <h1>
                Turn your closet into impact. 🌱
            </h1>

            <p>
                List your pre-loved item. When it sells,
                the proceeds support our NGO impact program.
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

            <div class="form-group">

                <label for="title">
                    Item Name
                </label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    placeholder="Example: Oversized Denim Jacket"
                    required
                >

            </div>


            <div class="form-row">

                <div class="form-group">

                    <label for="category">
                        Category
                    </label>

                    <select
                        id="category"
                        name="category"
                        required
                    >

                        <option value="">
                            Select category
                        </option>

                        <option value="Clothing">
                            Clothing
                        </option>

                        <option value="Shoes">
                            Shoes
                        </option>

                        <option value="Watches">
                            Watches
                        </option>

                        <option value="Eyewear">
                            Eyewear
                        </option>

                        <option value="Accessories">
                            Accessories
                        </option>

                    </select>

                </div>


                <div class="form-group">

                    <label for="condition">
                        Condition
                    </label>

                    <select
                        id="condition"
                        name="condition"
                        required
                    >

                        <option value="">
                            Select condition
                        </option>

                        <option value="Excellent">
                            Excellent
                        </option>

                        <option value="Good">
                            Good
                        </option>

                        <option value="Fair">
                            Fair
                        </option>

                    </select>

                </div>

            </div>


            <div class="form-group">

                <label for="price">
                    Selling Price (₹)
                </label>

                <input
                    type="number"
                    id="price"
                    name="price"
                    min="1"
                    step="1"
                    placeholder="999"
                    required
                >

            </div>


            <div class="form-group">

                <label for="description">
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="5"
                    maxlength="500"
                    placeholder="Describe the item, size, brand, usage, etc."
                ></textarea>

            </div>


            <div class="coin-info-box">

                <div class="coin-icon">
                    ❤️
                </div>

                <div>

                    <strong>
                        100% Impact Mode
                    </strong>

                    <p>
                        When this item sells, the proceeds are
                        directed toward the SSISS NGO impact
                        program. You may also receive SSISS Coins
                        according to the current reward rules.
                    </p>

                </div>

            </div>


            <button
                type="submit"
                class="primary-btn"
            >
                List for Impact →
            </button>

        </form>

    </section>

</main>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>

</body>
</html>
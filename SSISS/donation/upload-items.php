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

$donation_id = isset($_GET['donation_id'])
    ? (int) $_GET['donation_id']
    : 0;

$message = '';
$error = '';

if ($donation_id <= 0) {
    $error = "Invalid donation request.";
}

/*
|--------------------------------------------------------------------------
| Upload images
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($error)) {

    $donation_id = (int) ($_POST['donation_id'] ?? 0);

    if ($donation_id <= 0) {
        $error = "Invalid donation ID.";
    } elseif (!isset($_FILES['item_images'])) {
        $error = "Please select at least one image.";
    } else {

        try {

            // Make sure donation belongs to current user
            $stmt = $pdo->prepare("
                SELECT id
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

            if (!$donation) {
                $error = "Donation not found.";
            } else {

                $uploadDirectory = __DIR__ . '/../uploads/donations/';

                if (!is_dir($uploadDirectory)) {
                    mkdir($uploadDirectory, 0755, true);
                }

                $files = $_FILES['item_images'];

                $allowedTypes = [
                    'image/jpeg',
                    'image/png',
                    'image/webp'
                ];

                $maxSize = 5 * 1024 * 1024;

                $uploadedCount = 0;

                for ($i = 0; $i < count($files['name']); $i++) {

                    if ($files['error'][$i] !== UPLOAD_ERR_OK) {
                        continue;
                    }

                    $tmpName = $files['tmp_name'][$i];
                    $originalName = $files['name'][$i];
                    $fileSize = $files['size'][$i];

                    $mimeType = mime_content_type($tmpName);

                    if (!in_array($mimeType, $allowedTypes, true)) {
                        continue;
                    }

                    if ($fileSize > $maxSize) {
                        continue;
                    }

                    $extension = strtolower(
                        pathinfo($originalName, PATHINFO_EXTENSION)
                    );

                    $newFileName =
                        'donation_' .
                        $donation_id .
                        '_' .
                        uniqid() .
                        '.' .
                        $extension;

                    $destination =
                        $uploadDirectory . $newFileName;

                    if (move_uploaded_file($tmpName, $destination)) {

                        /*
                         * The donation_images table will be created
                         * in database/schema.sql.
                         */

                        $stmt = $pdo->prepare("
                            INSERT INTO donation_images
                            (
                                donation_id,
                                image_path,
                                created_at
                            )
                            VALUES
                            (
                                :donation_id,
                                :image_path,
                                NOW()
                            )
                        ");

                        $stmt->execute([
                            ':donation_id' => $donation_id,
                            ':image_path' =>
                                'uploads/donations/' . $newFileName
                        ]);

                        $uploadedCount++;
                    }
                }

                if ($uploadedCount > 0) {

                    $message =
                        $uploadedCount .
                        " image(s) uploaded successfully.";

                } else {

                    $error =
                        "No valid images were uploaded. " .
                        "Use JPG, PNG or WEBP files under 5MB.";

                }
            }

        } catch (PDOException $e) {

            $error =
                "Unable to upload images right now.";
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

    <title>Upload Donation Items | SSISS</title>

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
                DONATION PHOTOS
            </span>

            <h1>
                Show us what you're donating
            </h1>

            <p>
                Upload clear photos of your clothes or other
                items so our team can verify them.
            </p>

        </div>


        <?php if ($message): ?>

            <div class="form-alert success">
                <?= htmlspecialchars($message) ?>
            </div>

        <?php endif; ?>


        <?php if ($error): ?>

            <div class="form-alert error">
                <?= htmlspecialchars($error) ?>
            </div>

        <?php endif; ?>


        <form
            method="POST"
            enctype="multipart/form-data"
            class="donation-form"
        >

            <input
                type="hidden"
                name="donation_id"
                value="<?= htmlspecialchars($donation_id) ?>"
            >


            <div class="upload-area">

                <div class="upload-icon">
                    📸
                </div>

                <h3>
                    Upload item photos
                </h3>

                <p>
                    JPG, PNG or WEBP · Maximum 5MB each
                </p>

                <input
                    type="file"
                    name="item_images[]"
                    id="item_images"
                    accept="image/jpeg,image/png,image/webp"
                    multiple
                    required
                >

                <label
                    for="item_images"
                    class="secondary-btn"
                >
                    Choose Photos
                </label>

                <div
                    id="preview"
                    class="image-preview"
                ></div>

            </div>


            <button
                type="submit"
                class="primary-btn"
            >
                Upload Photos →
            </button>

        </form>


        <div class="donation-note">

            <strong>
                💡 Tip
            </strong>

            <p>
                Take photos in good lighting and make sure the
                complete item is visible.
            </p>

        </div>

    </section>

</main>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>


<script>

const imageInput =
    document.getElementById('item_images');

const preview =
    document.getElementById('preview');

if (imageInput && preview) {

    imageInput.addEventListener('change', function () {

        preview.innerHTML = '';

        Array.from(this.files).forEach(file => {

            if (!file.type.startsWith('image/')) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {

                const image =
                    document.createElement('img');

                image.src = event.target.result;

                image.alt = 'Donation preview';

                preview.appendChild(image);

            };

            reader.readAsDataURL(file);

        });

    });

}

</script>

</body>
</html>
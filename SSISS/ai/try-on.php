<?php

session_start();

/*
|--------------------------------------------------------------------------
| SSISS AI - VIRTUAL TRY-ON
|--------------------------------------------------------------------------
| Demo version
| Real AI API and MySQL integration will be added later.
|--------------------------------------------------------------------------
*/

$userName = $_SESSION['user_name'] ?? 'Fashion Lover';

$submitted = false;
$error = '';

$photoName = '';
$photoPath = '';

$productId = 0;
$productName = '';
$productPrice = 0;
$productCategory = '';


// ==========================================================
// DEMO PRODUCTS
// ==========================================================

$products = [
    1 => [
        'name' => 'Oversized Black T-Shirt',
        'price' => 799,
        'category' => 'T-Shirts'
    ],

    2 => [
        'name' => 'Classic White Shirt',
        'price' => 999,
        'category' => 'Shirts'
    ],

    3 => [
        'name' => 'Premium Denim Jacket',
        'price' => 1999,
        'category' => 'Jackets'
    ],

    4 => [
        'name' => 'Relaxed Beige Hoodie',
        'price' => 1499,
        'category' => 'Hoodies'
    ],

    5 => [
        'name' => 'Streetwear Cargo Pants',
        'price' => 1299,
        'category' => 'Bottomwear'
    ]
];


// ==========================================================
// HANDLE FORM SUBMISSION
// ==========================================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ------------------------------------------------------
    // Get selected product
    // ------------------------------------------------------

    $productId = intval($_POST['product_id'] ?? 0);

    // ------------------------------------------------------
    // Validate product
    // ------------------------------------------------------

    if (!isset($products[$productId])) {

        $error = 'Please select a valid product.';

    }

    // ------------------------------------------------------
    // Validate uploaded photo
    // ------------------------------------------------------

    if (
        !isset($_FILES['photo']) ||
        $_FILES['photo']['error'] !== UPLOAD_ERR_OK
    ) {

        $error = 'Please upload a photo of yourself.';

    }

    // ------------------------------------------------------
    // Process uploaded photo
    // ------------------------------------------------------

    if ($error === '') {

        $photo = $_FILES['photo'];

        // Maximum file size = 5 MB
        $maxFileSize = 5 * 1024 * 1024;

        if ($photo['size'] > $maxFileSize) {

            $error = 'Photo must be smaller than 5 MB.';

        }

        // --------------------------------------------------
        // Detect MIME type
        // --------------------------------------------------

        if ($error === '') {

            $fileType = mime_content_type(
                $photo['tmp_name']
            );

            $allowedTypes = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];

            if (!in_array($fileType, $allowedTypes, true)) {

                $error =
                    'Only JPG, PNG and WEBP images are allowed.';

            }

        }

        // --------------------------------------------------
        // Save image
        // --------------------------------------------------

        if ($error === '') {

            $uploadDirectory = '../uploads/ai/';

            if (!is_dir($uploadDirectory)) {

                mkdir(
                    $uploadDirectory,
                    0777,
                    true
                );

            }

            $extension = strtolower(
                pathinfo(
                    $photo['name'],
                    PATHINFO_EXTENSION
                )
            );

            $newFileName =
                'tryon_' .
                time() .
                '_' .
                bin2hex(random_bytes(4)) .
                '.' .
                $extension;

            $destination =
                $uploadDirectory .
                $newFileName;

            if (
                move_uploaded_file(
                    $photo['tmp_name'],
                    $destination
                )
            ) {

                $submitted = true;

                $photoName = $newFileName;

                $photoPath = $destination;

                $productName =
                    $products[$productId]['name'];

                $productPrice =
                    $products[$productId]['price'];

                $productCategory =
                    $products[$productId]['category'];

            } else {

                $error =
                    'Unable to save the uploaded photo.';

            }

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

    <title>
        Virtual Try-On | SSISS AI
    </title>

</head>

<body>


<!-- =========================================================
     HEADER
========================================================= -->

<header>

    <h1>
        🪞 SSISS Virtual Try-On
    </h1>

    <p>
        Welcome,
        <?= htmlspecialchars($userName); ?>
        👋
    </p>

    <p>
        Try SSISS products virtually before buying.
    </p>

</header>


<hr>


<!-- =========================================================
     INTRODUCTION
========================================================= -->

<section>

    <h2>
        ✨ Try Before You Buy
    </h2>

    <p>
        Upload your photo and select a SSISS product.
        Our future AI system will generate a virtual
        preview of the selected item on you.
    </p>

    <ul>

        <li>
            📸 Upload your photo
        </li>

        <li>
            👕 Select a product
        </li>

        <li>
            🤖 AI processes your photo
        </li>

        <li>
            🪞 Generate virtual try-on
        </li>

        <li>
            🛒 Purchase if you like it
        </li>

    </ul>

</section>


<hr>


<!-- =========================================================
     ERROR MESSAGE
========================================================= -->

<?php if ($error !== ''): ?>

<section>

    <h2>
        ⚠️ Upload Error
    </h2>

    <p>
        <?= htmlspecialchars($error); ?>
    </p>

</section>

<hr>

<?php endif; ?>


<!-- =========================================================
     TRY-ON FORM
========================================================= -->

<section>

    <h2>
        📸 Upload Your Photo
    </h2>

    <form
        method="POST"
        action="try-on.php"
        enctype="multipart/form-data"
    >

        <!-- PHOTO -->

        <div>

            <label for="photo">

                <strong>
                    Select Your Photo
                </strong>

            </label>

            <br><br>

            <input
                type="file"
                id="photo"
                name="photo"
                accept="image/jpeg,image/png,image/webp"
                required
            >

            <p>
                JPG, PNG or WEBP. Maximum 5 MB.
            </p>

        </div>


        <hr>


        <!-- PRODUCT -->

        <div>

            <h2>
                👕 Select Product
            </h2>

            <label for="product_id">

                <strong>
                    Choose an item:
                </strong>

            </label>

            <br><br>

            <select
                id="product_id"
                name="product_id"
                required
            >

                <option value="">
                    Select Product
                </option>

                <?php foreach (
                    $products as $id => $product
                ): ?>

                    <option value="<?= $id; ?>">

                        <?= htmlspecialchars(
                            $product['name']
                        ); ?>

                        -
                        ₹<?= number_format(
                            $product['price']
                        ); ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </div>


        <br><br>


        <!-- SUBMIT -->

        <button type="submit">

            🪞 Try This On Me

        </button>

    </form>

</section>


<hr>


<!-- =========================================================
     RESULT
========================================================= -->

<?php if ($submitted): ?>

<section>

    <h2>
        ✨ Virtual Try-On Result
    </h2>

    <p>
        Your photo was uploaded successfully!
    </p>


    <!-- SELECTED PRODUCT -->

    <h3>
        👕 Selected Product
    </h3>

    <p>

        <strong>
            <?= htmlspecialchars($productName); ?>
        </strong>

    </p>

    <p>

        Category:

        <?= htmlspecialchars($productCategory); ?>

    </p>

    <p>

        Price:

        ₹<?= number_format($productPrice); ?>

    </p>


    <hr>


    <!-- USER PHOTO -->

    <h3>
        📸 Your Uploaded Photo
    </h3>

    <img
        src="<?= htmlspecialchars($photoPath); ?>"
        alt="Uploaded user photo"
        width="300"
    >


    <hr>


    <!-- DEMO AI RESULT -->

    <h3>
        🤖 AI Try-On Preview
    </h3>

    <div>

        <p>
            🪞
        </p>

        <p>
            <strong>
                Virtual Try-On Preview
            </strong>
        </p>

        <p>
            This is currently a demo.
        </p>

        <p>
            After we connect the real AI virtual
            try-on API, the generated image will
            appear here.
        </p>

    </div>


    <hr>


    <!-- ACTION BUTTONS -->

    <h3>
        🛍️ Product Actions
    </h3>


    <p>

        <button
            type="button"
            onclick="alert('Product page will be connected to MySQL later.')"
        >

            👀 View Product

        </button>

    </p>


    <p>

        <button
            type="button"
            onclick="alert('Cart functionality will be connected later.')"
        >

            🛒 Add To Cart

        </button>

    </p>


    <p>

        <button
            type="button"
            onclick="alert('Wishlist will be connected to MySQL later.')"
        >

            ❤️ Add To Wishlist

        </button>

    </p>

</section>


<hr>

<?php endif; ?>


<!-- =========================================================
     PRODUCTS
========================================================= -->

<section>

    <h2>
        🔥 Available Demo Products
    </h2>

    <p>
        These are temporary products.
        Later they will come from the MySQL database.
    </p>


    <?php foreach (
        $products as $id => $product
    ): ?>

        <article>

            <h3>

                <?= htmlspecialchars(
                    $product['name']
                ); ?>

            </h3>

            <p>

                Category:

                <?= htmlspecialchars(
                    $product['category']
                ); ?>

            </p>

            <p>

                ₹<?= number_format(
                    $product['price']
                ); ?>

            </p>

        </article>

        <br>

    <?php endforeach; ?>

</section>


<hr>


<!-- =========================================================
     HOW IT WORKS
========================================================= -->

<section>

    <h2>
        🧠 How SSISS Virtual Try-On Will Work
    </h2>

    <ol>

        <li>
            User uploads a clear photo.
        </li>

        <li>
            User selects a SSISS product.
        </li>

        <li>
            PHP validates the uploaded image.
        </li>

        <li>
            PHP sends the image and product
            information to the AI service.
        </li>

        <li>
            AI generates a virtual try-on image.
        </li>

        <li>
            SSISS displays the generated result.
        </li>

        <li>
            User can add the product to cart.
        </li>

    </ol>

</section>


<hr>


<!-- =========================================================
     FUTURE FEATURES
========================================================= -->

<section>

    <h2>
        🚀 Future Features
    </h2>

    <ul>

        <li>
            🤖 AI Virtual Try-On
        </li>

        <li>
            👕 Real MySQL Products
        </li>

        <li>
            👗 Try Multiple Clothing Items
        </li>

        <li>
            👟 Try Shoes
        </li>

        <li>
            👓 Try Spectacles
        </li>

        <li>
            ⌚ Try Watches
        </li>

        <li>
            🔄 Compare Different Looks
        </li>

        <li>
            ❤️ Save Try-On Results
        </li>

        <li>
            🛒 Add Product To Cart
        </li>

    </ul>

</section>


<hr>


<!-- =========================================================
     PRIVACY
========================================================= -->

<section>

    <h3>
        🔒 Privacy
    </h3>

    <p>
        Uploaded photos should be handled securely.
        In the production version, we will implement
        proper image storage, access control and deletion.
    </p>

</section>


<hr>


<!-- =========================================================
     NAVIGATION
========================================================= -->

<footer>

    <p>

        <a href="index.php">
            ← AI Fashion Studio
        </a>

    </p>

    <p>

        <a href="suits-me.php">
            📸 What Suits Me?
        </a>

    </p>

    <p>

        <a href="vibe.php">
            ✨ Vibe Stylist
        </a>

    </p>

    <p>

        <a href="../index.php">
            ← SSISS Store
        </a>

    </p>

</footer>


</body>

</html>
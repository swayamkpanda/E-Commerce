<?php

session_start();

/*
|--------------------------------------------------------------------------
| SSISS AI - VIRTUAL TRY-ON
|--------------------------------------------------------------------------
| Demo version
| Real AI virtual try-on API + MySQL products will be connected later.
|--------------------------------------------------------------------------
*/

$userName = $_SESSION['user_name'] ?? 'Fashion Lover';


// ==========================================================
// VARIABLES
// ==========================================================

$submitted = false;
$error = '';

$photoName = '';
$photoPath = '';

$productId = '';
$productName = '';
$productPrice = 0;


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
// HANDLE FORM
// ==========================================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $productId =
        intval($_POST['product_id'] ?? 0);


    // ------------------------------------------------------
    // Check product
    // ------------------------------------------------------

    if (!isset($products[$productId])) {

        $error =
            'Please select a valid product.';

    }


    // ------------------------------------------------------
    // Check photo
    // ------------------------------------------------------

    if (
        !isset($_FILES['photo']) ||
        $_FILES['photo']['error'] !== UPLOAD_ERR_OK
    ) {

        $error =
            'Please upload a photo of yourself.';

    }


    // ------------------------------------------------------
    // Process photo
    // ------------------------------------------------------

    if ($error === '') {

        $photo =
            $_FILES['photo'];


        $allowedTypes = [

            'image/jpeg',
            'image/png',
            'image/webp'

        ];


        $fileType =
            mime_content_type(
                $photo['tmp_name']
            );


        if (
            !in_array(
                $fileType,
                $allowedTypes
            )
        ) {

            $error =
                'Only JPG, PNG and WEBP images are allowed.';

        }


        if (
            $photo['size'] >
            5 * 1024 * 1024
        ) {

            $error =
                'Photo must be smaller than 5 MB.';

        }


        // --------------------------------------------------
        // Save photo
        // --------------------------------------------------

        if ($error === '') {

            $uploadDirectory =
                '../uploads/ai/';


            if (
                !is_dir(
                    $uploadDirectory
                )
            ) {

                mkdir(
                    $uploadDirectory,
                    0777,
                    true
                );

            }


            $extension =
                strtolower(
                    pathinfo(
                        $photo['name'],
                        PATHINFO_EXTENSION
                    )
                );


            $newFileName =
                'tryon_' .
                time() .
                '_' .
                bin2hex(
                    random_bytes(4)
                ) .
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

                $photoName =
                    $newFileName;

                $photoPath =
                    $destination;

                $productName =
                    $products[$productId]['name'];

                $productPrice =
                    $products[$productId]['price'];

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
        <?= htmlspecialchars(
            $userName
        ); ?>

        👋

    </p>


    <p>
        See how SSISS fashion could look on you.
    </p>

</header>


<hr>


<!-- =========================================================
     INTRO
========================================================= -->

<section>

    <h2>
        ✨ Try Before You Buy
    </h2>


    <p>
        Upload your photo, select a product and let
        AI create a virtual try-on experience.
    </p>


    <ul>

        <li>
            📸 Upload your photo
        </li>

        <li>
            👕 Select a fashion item
        </li>

        <li>
            🤖 AI processes both images
        </li>

        <li>
            🪞 Generate virtual try-on
        </li>

        <li>
            🛍️ Buy if you love the look
        </li>

    </ul>

</section>


<hr>


<!-- =========================================================
     ERROR
========================================================= -->

<?php if ($error !== ''): ?>

<section>

    <h3>
        ⚠️ Something went wrong
    </h3>


    <p>

        <?= htmlspecialchars(
            $error
        ); ?>

    </p>

</section>


<hr>

<?php endif; ?>


<!-- =========================================================
     TRY ON FORM
========================================================= -->

<section>

    <h2>
        1. Upload Your Photo
    </h2>


    <form
        method="POST"
        action="try-on.php"
        enctype="multipart/form-data"
    >


        <label for="photo">

            <strong>
                Your Photo
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
            JPG, PNG or WEBP • Maximum 5 MB
        </p>


        <hr>


        <!-- =================================================
             PRODUCT SELECTION
        ================================================== -->

        <h2>
            2. Choose a Product
        </h2>


        <select
            name="product_id"
            required
        >

            <option value="">
                Select Product
            </option>


            <?php foreach (
                $products as $id => $product
            ): ?>


                <option
                    value="<?= $id; ?>"
                >

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


        <br><br>


        <button
            type="submit"
        >

            🪞 Try This On Me

        </button>


    </form>

</section>


<hr>


<!-- =========================================================
     DEMO RESULT
========================================================= -->

<?php if ($submitted): ?>


<section>


    <h2>
        ✨ Your Virtual Try-On
    </h2>


    <p>
        Your photo has been uploaded successfully.
    </p>


    <h3>
        Selected Product
    </h3>


    <p>

        <strong>

            <?= htmlspecialchars(
                $productName
            ); ?>

        </strong>

    </p>


    <p>

        ₹<?= number_format(
            $productPrice
        ); ?>

    </p>


    <!-- =====================================================
         USER PHOTO
    ====================================================== -->

    <h3>
        📸 Uploaded Photo
    </h3>


    <img
        src="<?= htmlspecialchars(
            $photoPath
        ); ?>"
        alt="Your uploaded photo"
        width="300"
    >


    <hr>


    <!-- =====================================================
         DEMO AI RESULT
    ====================================================== -->

    <h3>
        🤖 AI Try-On Result
    </h3>


    <p>

        <strong>
            Demo Mode
        </strong>

    </p>


    <p>

        The real AI virtual try-on image will appear
        here after connecting the AI image-generation /
        virtual try-on API.

    </p>


    <div>

        <p>

            🪞

        </p>

        <p>

            Virtual Try-On Preview

        </p>

        <p>

            AI generated preview will appear here.

        </p>

    </div>


    <hr>


    <!-- =====================================================
         PRODUCT ACTIONS
    ====================================================== -->

    <h2>
        🛍️ Like This Product?
    </h2>


    <button
        type="button"
        onclick="alert('Product page will be connected to MySQL later.')"
    >

        View Product

    </button>


    <br><br>


    <button
        type="button"
        onclick="alert('Cart functionality will be connected later.')"
    >

        🛒 Add To Cart

    </button>


    <br><br>


    <button
        type="button"
        onclick="alert('Wishlist will be connected to MySQL later.')"
    >

        ❤️ Add To Wishlist

    </button>


</section>


<hr>


<!-- =========================================================
     MORE PRODUCTS
========================================================= -->

<section>

    <h2>
        🔥 Try Another Product
    </h2>


    <p>
        You can try different SSISS products on your photo.
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

                <?= htmlspecialchars(
                    $product['category']
                ); ?>

            </p>


            <p>

                ₹<?= number_format(
                    $product['price']
                ); ?>

            </p>


            <button
                type="button"
                onclick="alert('Select this product from the form above.')"
            >

                Try This

            </button>

        </article>


        <br>


    <?php endforeach; ?>


</section>


<hr>


<!-- =========================================================
     HOW IT WILL WORK
========================================================= -->

<section>

    <h2>
        🧠 How Virtual Try-On Will Work
    </h2>


    <ol>

        <li>
            User uploads their photo.
        </li>

        <li>
            User selects a SSISS product.
        </li>

        <li>
            PHP sends both images to the AI service.
        </li>

        <li>
            AI generates the virtual try-on result.
        </li>

        <li>
            Result is displayed to the user.
        </li>

        <li>
            User can save, wishlist or purchase the product.
        </li>

    </ol>

</section>


<hr>


<!-- =========================================================
     FUTURE INTEGRATION
========================================================= -->

<section>

    <h2>
        🚀 Future Integration
    </h2>


    <p>

        This page will eventually connect to:

    </p>


    <ul>

        <li>
            AI Virtual Try-On API
        </li>

        <li>
            MySQL Products
        </li>

        <li>
            User Accounts
        </li>

        <li>
            Wishlist
        </li>

        <li>
            Shopping Cart
        </li>

        <li>
            Orders
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

        Uploaded images should be handled securely
        and deleted according to your final privacy policy.

    </p>

</section>


<hr>


<!-- =========================================================
     FOOTER
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

        <a href="../index.php">
            ← SSISS Store
        </a>

    </p>

</footer>


</body>

</html>
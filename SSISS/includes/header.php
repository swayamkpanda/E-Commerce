<?php

/*
|--------------------------------------------------------------------------
| SSISS - Common Header
|--------------------------------------------------------------------------
*/

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/*
|--------------------------------------------------------------------------
| Default Page Settings
|--------------------------------------------------------------------------
*/

$pageTitle = $pageTitle ?? 'SSISS';
$pageDescription = $pageDescription
    ?? 'SSISS - Smart fashion, personalized style and sustainable impact.';

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="<?= htmlspecialchars(
            $pageDescription,
            ENT_QUOTES,
            'UTF-8'
        ) ?>"
    >

    <title>
        <?= htmlspecialchars(
            $pageTitle,
            ENT_QUOTES,
            'UTF-8'
        ) ?>
    </title>


    <!-- Main CSS files will be linked here later -->

    <link
        rel="stylesheet"
        href="../assets/css/style.css"
    >


</head>

<body>

<?php

/*
|--------------------------------------------------------------------------
| Navbar
|--------------------------------------------------------------------------
*/

$navbarPath = __DIR__ . '/navbar.php';

if (file_exists($navbarPath)) {
    require_once $navbarPath;
}

?>
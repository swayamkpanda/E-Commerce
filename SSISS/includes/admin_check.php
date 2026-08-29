<?php

/*
|--------------------------------------------------------------------------
| SSISS - Admin Authentication Check
|--------------------------------------------------------------------------
*/

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/*
|--------------------------------------------------------------------------
| Check if user is logged in
|--------------------------------------------------------------------------
*/

if (!isset($_SESSION['user_id'])) {

    $_SESSION['redirect_after_login'] =
        $_SERVER['REQUEST_URI'] ?? '/SSISS/index.php';

    header("Location: ../auth/login.php");

    exit;
}


/*
|--------------------------------------------------------------------------
| Check admin role
|--------------------------------------------------------------------------
*/

if (
    !isset($_SESSION['user_role']) ||
    $_SESSION['user_role'] !== 'admin'
) {

    http_response_code(403);

    header("Location: ../index.php");

    exit;
}

?>
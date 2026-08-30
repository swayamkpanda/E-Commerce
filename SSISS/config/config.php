<?php

/*
|--------------------------------------------------------------------------
| SSISS - Application Configuration
|--------------------------------------------------------------------------
*/

// ==========================================================
// DATABASE
// ==========================================================

define('DB_HOST', 'localhost');

// IMPORTANT:
// Change this to the exact database name you created
// in phpMyAdmin.
define('DB_NAME', 'ssiss');

define('DB_USER', 'root');

// XAMPP usually has an empty MySQL password by default.
define('DB_PASS', '');


// ==========================================================
// APPLICATION
// ==========================================================

define(
    'APP_NAME',
    'SSISS'
);

define(
    'APP_URL',
    'http://localhost/E-Commerce/SSISS'
);


// ==========================================================
// TIMEZONE
// ==========================================================

date_default_timezone_set(
    'Asia/Kolkata'
);

?>
<?php
// Check if constants are not defined before defining them
if (!defined('SITEURL')) {
    define('SITEURL', 'http://localhost/ASAX%20COMPANY/');
}

if (!defined('LOCALHOST')) {
    define('LOCALHOST', 'localhost');
}

if (!defined('DB_USERNAME')) {
    define('DB_USERNAME', 'root');
}

if (!defined('DB_PASSWORD')) {
    define('DB_PASSWORD', '');
}

if (!defined('DB_NAME')) {
    define('DB_NAME', 'asax-compny');
}

// Check if connection is not established before creating it
if (!isset($conn)) {
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

    // Selecting the correct database
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
}
?>

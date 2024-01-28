<?php
session_start();

if (!isset($_SESSION['user'])) {
    $_SESSION['log'] = "<div class='error text-center'>PLEASE LOGIN TO ACCESS ADMIN PANEL</div>";
    header('location: ' . SITEURL . 'admin/login.php');
    exit();
}

if (isset($_SESSION['last-time']) && (time() - $_SESSION['last-time']) > 500) {
    $_SESSION['time'] = "<div class='error text-center'> PLEASE LOGIN !!! </div>";
    header('location: ' . SITEURL . 'admin/login.php');
    exit();
}

$_SESSION['last-time'] = time();
?>

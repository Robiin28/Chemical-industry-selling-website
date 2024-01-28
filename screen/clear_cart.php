<?php
// Include necessary files
include('../config/constant.php');

// Start the session
session_start();

// Clear the cart session
$_SESSION['cart'] = array();

// Redirect to the home page or any other desired page
header('Location: ' . SITEURL . 'screen/confirmation.php');
exit();
?>

<?php
include('../config/constant.php');
session_start();

if (isset($_SESSION['billingInfo'])) {
    $billingInfo = $_SESSION['billingInfo'];
    echo json_encode($billingInfo);
} else {
    echo json_encode([]);
}
?>

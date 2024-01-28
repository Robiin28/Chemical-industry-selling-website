<?php
include('../config/constant.php');


include('./partials/login-check.php');

session_start();


if(isset($_GET['id']) && isset($_GET['bid']) && isset($_GET['sid'])) {
    $id = $_GET['id'];
    $bid = $_GET['bid'];
    $sid = $_GET['sid'];

    $sql2 = "DELETE FROM billing_tbl WHERE id=$bid";
    $res2 = mysqli_query($conn, $sql2);

    if($res2) {
        $deleteShipping = true;

        if($sid != 0) {
            $sql3 = "DELETE FROM shipping_tbl WHERE id=$sid";
            $res3 = mysqli_query($conn, $sql3);

            if(!$res3) {
                $_SESSION['delete-order'] = "<div class='text-danger  border p-3 text-center'>Failed to delete shipping: " . mysqli_error($conn) . "</div>";
                $deleteShipping = false;
            }
        }

        if($deleteShipping) {
            $sql = "DELETE FROM order_tbl WHERE id=$id";
            $res = mysqli_query($conn, $sql);

            if($res) {
                $_SESSION['delete-order'] = "<div class='text-success  border p-3 text-center'>Order deleted successfully</div>";
                header('location: ' . SITEURL . 'admin/order.php');
            } else {
                $_SESSION['delete-order'] = "<div class='text-danger border  border p-3 text-center'>Failed to delete order: " . mysqli_error($conn) . "</div>";
                header('location: ' . SITEURL . 'admin/order.php');
            }
        }
    } else {
        $_SESSION['delete-order'] = "<div class='text-danger  border p-3 text-center'>Failed to delete billing: " . mysqli_error($conn) . "</div>";
        header('location: ' . SITEURL . 'admin/order.php');
    }
} else {
    header('location: ' . SITEURL . 'admin/order.php');
}
?>

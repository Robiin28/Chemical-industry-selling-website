

<?php

include('../config/constant.php');


if (isset($_GET['id'])){
    $bid = $_GET['id'];
} else {
    header('Location: ' . SITEURL . 'admin/order.php');
    exit();
}

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $info = $_POST['status'];

$sql2 = "UPDATE order_tbl SET
order_info='$info'
 WHERE id='$id'
";
$res2 = mysqli_query($conn, $sql2);

if ($res2 == true) {
 $_SESSION['update_order'] = "<div class='text-success'>Order information Updated Successfully</div>";
 header('location:' . SITEURL . '/admin/order.php');
 ob_end_flush();
 exit();
} else {
 $_SESSION['update_order'] = "<div class='text-danger'>Failed to Update your order information</div>";
 header('location:' . SITEURL . '/admin/order.php');
 exit();
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.0/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Manage order</title>

    <style>
        /* Styling for radio buttons */
        .status-label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .status-radio {
            margin-right: 8px;
        }
    </style>


</head>
<body>
<?php
include('./partials/menu.php');
?>
  <div class="container-fluid bg-dark mb-5 p-5">
        <div class="fw-bold display-5 text-center text-white">
            Order basics
        </div>
</div>

<div class="container">
<div>
<div class="container border shadow-lg lead  p-5 ms-5">

<p class="text-start lead">
<div class="text-end">

<a href="<?php echo SITEURL; ?>admin/order.php" class="btn btn-lg btn-outline-primary text-end text-dark  me-3">back</a>

</div>


    <div class="row justify content center">
    <div class="col-12">
   

    <b>Select order condition:</b>
<br>


<form action="" method="post" class="ms-5">
    <label class="status-label">
        <input type="radio" name="status" value="called" class="status-radio">
        <i class='bx bxs-phone'></i> need to be Called again
    </label>

    <label class="status-label">
        <input type="radio" name="status" value="delivery requested" class="status-radio">
        <i class='bx bxs-package'></i> Delivery requested
    </label>

    <label class="status-label">
        <input type="radio" name="status" value="contacted" class="status-radio">
        <i class='bx bxs-chat'></i> Contacted
    </label>

    <label class="status-label">
        <input type="radio" name="status" value="transaction_finished" class="status-radio">
        <i class='bx bx-check-double'></i> Transaction Finished
    </label>

    <label class="status-label">
        <input type="radio" name="status" value="waiting" class="status-radio">
        <i class='bx bxs-hourglass'></i> Waiting
    </label>

    <label class="status-label">
        <input type="radio" name="status" value="ongoing" class="status-radio">
        <i class='bx bxs-time-five'></i> Ongoing
    </label>

    <input type="hidden" name="id" value="<?php echo $bid ?>" class="status-radio">
    <button type="submit" name="submit" class="btn btn-lg btn-outline-info ms-5 mt-2">Submit</button>
</form>





</div>

</div>

</p>
</div>
</div>
</div>
 <?php
include('./partials/footer.php');
?>
</body>
</html>
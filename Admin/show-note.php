

<?php

include('../config/constant.php');


if (isset($_GET['id'])){
    $id = $_GET['id'];
} else {
    header('Location: ' . SITEURL . 'admin/order.php');
    exit();
}

$sql = "SELECT * FROM order_tbl WHERE id=$id";
$res = mysqli_query($conn, $sql);

if ($res == true) {
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $note = $row['note'];
        $order_date=$row['order_date'];
    } else {
        header("location:" . SITEURL . 'admin/order.php');
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
    <title>Your Order</title>
</head>
<body>
<?php
include('./partials/menu.php');
?>
  <div class="container-fluid bg-dark mb-5 p-5">
        <div class="fw-bold display-5 text-center text-white">
             order info
        </div>
</div>

<div class="container">
<div>
<div class="container border shadow-lg lead  p-5 ms-5">

<p class="text-start">
<div class="text-end">

<a href="<?php echo SITEURL; ?>admin/order.php" class="btn btn-lg btn-outline-primary text-end text-dark  me-3">back</a>

</div>


    <div class="row justify content center">
    <div class="col-12">
   

    <b>company ordered to </b>
<p class="ms-5">
<?php
echo $note;
?>
</p>
<div class="text-end text-info">
<?php echo $order_date?>
</div>


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
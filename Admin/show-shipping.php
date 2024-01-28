

<?php

include('../config/constant.php');


if (isset($_GET['id'])){
    $bid = $_GET['id'];
} else {
    header('Location: ' . SITEURL . 'admin/order.php');
    exit();
}

$sql = "SELECT * FROM shipping_tbl WHERE id=$bid";
$res = mysqli_query($conn, $sql);

if ($res == true) {
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $address_nick = $row['address_nick'];
        $name = $row['company_name'];
        $title = $row['title'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $address1 = $row['address1'];
        $city = $row['city'];
        $country = $row['country'];
        $state = $row['state'];
        $email = $row['email'];
        $phone = $row['phone'];
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
    <title>Show billing info</title>
</head>
<body>
<?php
include('./partials/menu.php');
?>
  <div class="container-fluid bg-dark mb-5 p-5">
        <div class="fw-bold display-5 text-center text-white">
            Shipping detail
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
   

    <b>NAME:</b>
<span class="ms-3 "> <?php echo $title ?> </span><span class="ms-1"> <?php echo $first_name ?> </span><span class="ms-1 me-3"> <?php echo $last_name ?> </span>
<br>
<b>Company:</b><span class="ms-1 me-3  text-start"> <?php echo $name ?> </span><br>
<b>Country:</b><span class="ms-1 me-3  text-start"> <?php echo $country ?> </span><br>
<b>state</b><span class="ms-1 me-3  text-start"> <?php echo $state ?> </span><br>
<b>City:</b><span class="ms-1 me-3  text-start"> <?php echo $city ?> </span><br>
<b>Address</b><span class="ms-1 me-3  text-start"> <?php echo $address1 ?> </span><br>
<b>Address nick name</b><span class="ms-1 me-3  text-start"> <?php echo $address_nick ?> </span><br>
<b>Email:</b><span class="ms-1 me-3  text-start"> <?php echo $email ?> </span><br>
<b>phone</b><span class="ms-1 me-3  text-start"> <?php echo $phone?> </span>


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
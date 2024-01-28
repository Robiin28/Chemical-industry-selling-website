

<?php

include('../config/constant.php');


if (isset($_GET['id'])){
    $id = $_GET['id'];
} else {
    header('Location: ' . SITEURL . 'admin/reviews.php');
    exit();
}

$sql = "SELECT * FROM treview_tbl WHERE id=$id";
$res = mysqli_query($conn, $sql);

if ($res == true) {
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $message = $row['message'];
      
    } else {
        header("location:" . SITEURL . 'admin/reviews.php');
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
    <title>Show Message</title>
</head>
<body>
<?php
include('./partials/menu.php');
?>
  <div class="container-fluid bg-dark mb-5 p-5">
        <div class="fw-bold display-5 text-center text-white">
             message
        </div>
</div>

<div class="container">
<div>
<div class="container border shadow-lg lead  p-5 ms-5">

<p class="text-start">
<div class="text-end">

<a href="<?php echo SITEURL; ?>admin/reviews.php" class="btn btn-lg btn-outline-primary text-end text-dark  me-3">back</a>

</div>


    <div class="row justify content center">
    <div class="col-12">
   

    <b>Message received</b>
<p class="ms-5">
<?php
echo $message;
?>
</p>
<div class="text-center">
<a href="<?php echo SITEURL; ?>admin/delete-review.php?id=<?php echo $id; ?>"class="btn btn-danger text-center rounded mt-2 mb-2">Delete</a>

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
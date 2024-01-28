<?php
include('../config/constant.php');
include('../partials/nav.php');
?>


<?php
if (isset($_GET['id'])) {
    // Retrieve the ID
    $cid = $_GET['id'];
} else {
  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <title>Confirmation page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.0/css/boxicons.min.css">
    <style>
        .img-container {
            position: relative;
            width: 100%;
        }

        .star-rating {
            color: #FFD700;
            font-size: 24px;
        }
        .lead {
            color: black;
        }
        .img-padding{
            transition: transform 0.3s ease-in-out;
        }

        .img-padding:hover {
            transform: scale(1.1);
        }
        .lead {
            animation: slideInLeft 3s ease-in-out;
            font-family: Pacifico;
            font-size: 1.5rem;
            color: #555;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container-fluid bg-dark mb-5 p-5">
        <div class="fw-bold display-5 text-center text-white">
            Order Confirmation
        </div>
    </div>


    <br><br>
    <div class="container mb-5">

<div class="lead border shadow p-5 text-center ">
<Strong> 
<b> Confirm Message  </b>    
</Strong> <br>
Thank you for choosing us . you will be satisfied with our product 
<br>our contact center will contact you shortly.


</div>
</div>
<br><br>
    <?php 

include('../partials/footer.php');

?>
</body>
</html>

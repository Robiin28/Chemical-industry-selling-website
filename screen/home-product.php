
<?php
include('../config/constant.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.0/css/boxicons.min.css">
    <style>
        .navbar-nav .nav-item {
            margin-right: 10px;
        }

        .navbar-nav .nav-item a {
            color: black;
        }

        .navbar-nav .nav-item a:hover {
            background-color: blue;
            color: white;
        }

        .profile {
            border-radius: 50%;
        }

        .tbproduct tr td a {
            text-decoration: none;
            color: white;
        }

        body {
            overflow-x: hidden; /* Hide horizontal overflow */
        }
    </style>
    <title>Our Products</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-xxl">
        <img class="navbar-brand" src="../assets/ASAL-IMPEX-WEBSITE-LOGO-4.jpg" alt="logo " width="50" height="50">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- nav-->
        <div class="collapse navbar-collapse justify-content-end align-center" id="main-nav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link"  href="<?php echo SITEURL; ?>">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="<?php echo SITEURL; ?>screen/about_us.php">ABOUT US</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="<?php echo SITEURL; ?>screen/home-product.php">PRODUCTS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="<?php echo SITEURL; ?>screen/e_store.php">SHOP</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo SITEURL; ?>screen/contact_us.php" >CONTACT US</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid bg-dark mb-5 p-5">
<div class="fw-bold display-5 text-center text-white">
PRODUCTS
</div>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-2 col-md-9">
            <table class="table table-hover table-dark table-bordered table-primary ">
                <thead>
                <th scope="col" class="text-center">PRODUCTS</th>
                </thead>

                <?php
        $sql2 = "SELECT*FROM product_tbl";
        $res2 = mysqli_query($conn, $sql2);
        if ($res2 == TRUE) { 
            $count2 = mysqli_num_rows($res2);
            if ($count2 > 0) {
                while ($rows2 = mysqli_fetch_assoc($res2)) {
                    $id = $rows2['id'];
                    $pname = $rows2['pname'];
                ?>
                     <tbody class="text-white fw-bold tbproduct">

    <tr>
    <td>
        <input type="hidden" value="<?php echo $id ?>">
        <input type="hidden" value="<?php echo $pname ?>">
        <a href="<?php echo SITEURL; ?>screen/home-product.php?id=<?php echo $id; ?>&pname=<?php echo $pname; ?>"> <?php echo $pname ?></a>
    </td>
    </tr>
         </tbody>
        <?php
                }
            }
        }
        ?>
            </table>
            <?php
if (isset($_GET['id']) && isset($_GET['pname'])) {
    $id = $_GET['id'];
    $pname = $_GET['pname'];
} else {
    $sql = "SELECT id, pname FROM product_tbl LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $id = $row['id'];
            $pname = $row['pname'];
        } else {
            // Redirect or handle the case where no rows are found
            header('location:' . SITEURL . 'index.php');
            exit(); // Ensure script stops execution after redirect
        }
    } else {
        echo "Error in the query: " . mysqli_error($conn);
    }
}
?>

   
   
   
        </div>
        <div class="col-lg-8 ms-1 col-sm-9 text-sm-start">
            <div class="lead fw-bold ms-5 "><?php echo $pname ?></div>
            <table class="table table-bordered ps-5 pe-5 pt-o pb-0 ms-5 mt-o mb-5 table-hover table-responsive  table-sm-start">
                <thead class=" me-5 p-5">
                <th scope="col" class="text-center">No</th>
                <th scope="col" class="text-center">PRODUCT</th>
                <th scope="col" class="text-center">SPECIFICATION</th>
                <th scope="col" class="text-center">PACKING</th>
                <th scope="col" class="text-center">PRICE</th>
                </thead>
                <tbody>
                <tr class="table-primary">
                    <td colspan="5" class="fw-bold ms-4"><?php echo $pname ?></td>
                </tr>
                <?php
$sql3 = "SELECT * FROM chemical_tbl WHERE ptype='$id' AND active='YES'";
$res3 = mysqli_query($conn, $sql3);

if ($res3 == TRUE) {
    $sn = 1;
    $count3 = mysqli_num_rows($res3);

    if ($count3 > 0) {
        while ($rows3 = mysqli_fetch_assoc($res3)) {
            $cname = $rows3['cname'];
            $spec = $rows3['spec'];
            $price = $rows3['price'];
            $packing = $rows3['packing'];
            $ptype = $rows3['ptype'];
?>
            <tr>
                <th scope="row"><?php echo $sn++; ?></th>
                <td><?php echo $cname; ?></td>
                <td><?php echo $spec; ?></td>
                <td><?php echo $packing; ?></td>
                <td><?php echo $price; ?></td>
            </tr>
<?php
        }
    }
} else {
    echo 'Error in the query: ' . mysqli_error($conn);
}
?>

            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<?php  

include('../partials/footer.php');

?>
</body>
</html>

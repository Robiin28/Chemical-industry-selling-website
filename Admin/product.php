<?php   

include('../config/constant.php');



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.0/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>manage product</title>
</head>
<body>

<?php include('./partials/menu.php');

?>
<style>
    .bdy {
        margin: 0;
        padding: 0;
    }

    .container {
        margin-top: 5rem;
        margin-bottom: 5rem;
    }

    .table {
        text-align: center;
        border-collapse: collapse;
        width: 100%; 
        border: 2px solid #000;
    }

    th,
    td {
        border-bottom: 1px solid #dee2e6; 
        padding: 8px;
    }

    th:hover,
    td:hover {
        background-color: #5b5f63;
        color: rgb(253, 247, 247);
        transition: background-color 0.3s ease-in-out;
    }

    th:last-child,
    td:last-child {
        border-right: 1px solid #dee2e6;
    }

    .table tbody tr {
        margin-bottom: 10px;
    }
</style>
<div class="container-fluid bg-dark mb-5 p-5">
        <div class="fw-bold display-5 text-center text-white">
           Manage product
        </div>
    </div>

<div class="container p-5">

<?php
if(isset($_SESSION['remove-image']))
{
 echo $_SESSION['remove-image'];
 unset($_SESSION['remove-image']);//Redirect and message will be lost

}
if(isset($_SESSION['delete-product']))
{
 echo $_SESSION['delete-product'];
 unset($_SESSION['delete-product']);//Redirect and message will be lost

}
if(isset($_SESSION['update-product']))
{
 echo $_SESSION['update-product'];
 unset($_SESSION['update-product']);//Redirect and message will be lost
}
if(isset($_SESSION['add-product']))
{
 echo $_SESSION['add-product'];
 unset($_SESSION['add-product']);//Redirect and message will be lost
}

?>
<div class="text-start mb-5">
    <p class="lead">Manage Product</p>
<a href="<?php echo SITEURL; ?>admin/add-product.php" class="btn btn-lg btn-success">Add product</a>
<p class="text-danger fw-bold border text-center p-2 mt-3">Remember Deleting product will automatically delete chemicals under this product type</p>

</div>

    <table class="table text-center ">
        <thead>
            <tr>
                <th scope="col">.</th>
                <th scope="col">Product Name</th>
                <th scope="col">Image</th>
                <th scope="col">Description </th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <?php
        $sql = "SELECT*FROM product_tbl";
        $res = mysqli_query($conn, $sql);
        if ($res == TRUE) {
            $sn = 1; 
            $count = mysqli_num_rows($res); 
            if ($count > 0) {
                while ($rows = mysqli_fetch_assoc($res)) {
                    $id = $rows['id'];
                    $pname = $rows['pname'];
                    $pdesc = $rows['pdsc'];
                    $image = $rows['image'];
        ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $sn++; ?></th>
                            <td>
                                
                            
                            
                            <?php echo $pname; ?></td>
                            <td>
                                <?php
                                if ($image != "") {
                                ?>
                                    <img src="<?php echo SITEURL; ?>assets/products/<?php echo $image; ?>" width="200px" height="100" class="img-fluid p-2">
                                <?php
                                } else {
                                    echo "<div class='text-danger'>Image not added.</div>";
                                }
                                ?>
                            </td>
                            <td><?php echo $pdesc; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-product.php?id=<?php echo $id; ?>&image=<?php echo $image; ?>" class="btn btn-outline-primary text-center rounded mt-4 mb-4"> Update</a>
                                <br>
                                <a href="<?php echo SITEURL; ?>admin/delete-product.php?id=<?php echo $id; ?>&image=<?php echo $image; ?>" class="btn btn-outline-danger text-center rounded mt-2">Delete</a>
                            </td>
                        </tr>
                    </tbody>
        <?php
                }
            }
         }
        ?>


    </table>
</div>
<br><br>
<?php include('./partials/footer.php'); ?>
</body>
</html>


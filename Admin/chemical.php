<?php 


include('../config/constant.php');
include('./partials/menu.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.0/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Manage Chemical</title>
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
    .bd {
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
</head>

<body>

 <div class="container-fluid bg-dark mb-5 p-5">
        <div class="fw-bold display-5 text-center text-white">
            Manage chemicals
        </div>
    </div>

<div class="container-sm p-2 text-md-start">
    <br><br>
    <?php
if(isset($_SESSION['remove-chemimage']))
{
 echo $_SESSION['remove-chemimage'];
 unset($_SESSION['remove-chemimage']);

}
if(isset($_SESSION['delete-chemical']))
{
 echo $_SESSION['delete-chemical'];
 unset($_SESSION['delete-chemical']);

}
if(isset($_SESSION['update-chemical']))
{
 echo $_SESSION['update-chemical'];
 unset($_SESSION['update-chemical']);
}
if(isset($_SESSION['add-chemical']))
{
 echo $_SESSION['add-chemical'];
 unset($_SESSION['add-chemical']);
}
?>
<div class="text-start mb-5">
    <p class="lead">Manage Chemicals</p>
<a href="<?php echo SITEURL; ?>admin/add-chemical.php" class="btn btn-lg btn-success">Add Chemical</a>

</div>
    <table class="table-responsive  table-bordered text-center bd mb-5">
        <thead>
            <tr>
                <th scope="col">.</th>
                <th scope="col">C.Name</th>
                <th scope="col">Description</th>
                <th scope="col">pID</th>
                <th scope="col">Image</th>
                <th scope="col">Price</th>
                <th scope="col">Packing</th>
                <th scope="col">Active</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <?php
        $sql = "SELECT*FROM chemical_tbl";
        $res = mysqli_query($conn, $sql);
        if ($res == TRUE) {
            $sn = 1; 
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                while ($rows = mysqli_fetch_assoc($res)) {
                    $id = $rows['id'];
                    $cname = $rows['cname'];
                    $spec = $rows['spec'];
                    $image = $rows['image'];
                    $price = $rows['price'];
                    $packing = $rows['packing'];
                    $active = $rows['active'];
                    $ptype= $rows['ptype'];
        ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $sn++; ?></th>
                            <td><?php echo $cname; ?></td>
                            <td><?php echo $spec; ?></td>
                            <td><?php echo $ptype; ?></td>
                            <td>
                                <?php
                                if ($image != "") {
                                ?>
                                    <img src="<?php echo SITEURL; ?>assets/chemical/<?php echo $image; ?>" width="110px" height="100" class="img-fluid p-1">
                                <?php
                                } else {
                                    echo "<div class='text-danger'>Image not added.</div>";
                                }
                                ?>
                            </td>
                            <td><?php echo $price; ?></td>
                            <td><?php echo $packing; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-chemical.php?id=<?php echo $id; ?>&image=<?php echo $image; ?>" class="btn btn-outline-primary text-center rounded mt-5 mb-4"> Update</a>
                                <br>
                                <a href="<?php echo SITEURL; ?>admin/delete-chemical.php?id=<?php echo $id; ?>&image=<?php echo $image; ?>" class="btn btn-outline-danger text-center rounded mt-2 mb-2">Delete</a>
                                <br>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?php include('./partials/footer.php'); ?>
</body>

</html>

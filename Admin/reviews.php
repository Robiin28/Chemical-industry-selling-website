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
            Reviews about products
        </div>
 </div>

<div class="container p-5">

<?php

if(isset($_SESSION['delete-review']))
{
 echo $_SESSION['delete-review'];
 unset($_SESSION['delete-review']);//Redirect and message will be lost

}

?>



    <table class="table text-center">
        <thead>
            <tr>
                <th scope="col">.</th>
                <th scope="col"> Name</th>
                <th scope="col">PHONE</th>
                <th scope="col">EMAIL</th>
                <th scope="col">MESSAGE</th>
                <th scope="col">ACTION</th>
            </tr>
        </thead>
        <?php
        $sql = "SELECT*FROM treview_tbl";
        $res = mysqli_query($conn, $sql);
        if ($res == TRUE) {
            $sn = 1; 
            $count = mysqli_num_rows($res); 
            if ($count > 0) {
                while ($rows = mysqli_fetch_assoc($res)) {
                    $id = $rows['id'];
                    $name = $rows['name'];
                    $phone = $rows['phone'];
                    $email = $rows['email'];
                    $message = $rows['message'];
        ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $sn++; ?></th>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $phone; ?></td>
                            <td><?php echo $email; ?></td>
                            <td>
                            <a href="<?php echo SITEURL; ?>admin/msg-review.php?id=<?php echo $id; ?>"class="btn btn-outline-info text-center rounded mt-2 mb-2">Message</a>
                            </td>
                            <td>
                            <a href="<?php echo SITEURL; ?>admin/delete-review.php?id=<?php echo $id; ?>"class="btn btn-danger text-center rounded mt-2 mb-2">Delete</a>
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
<?php include('./partials/footer.php'); ?>
</body>
</html>


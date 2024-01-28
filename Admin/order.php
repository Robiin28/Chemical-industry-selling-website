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
    <title>manage order</title>
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
<body>
<?php include('./partials/menu.php');

?>
<div class="container-fluid bg-dark mb-5 p-5">
        <div class="fw-bold display-5 text-center text-white">
            Order Details
        </div>
    </div>

<div class="container-sm p-2 text-md-start">
    <br><br>
    <?php
if(isset($_SESSION['delete-order']))
{
 echo $_SESSION['delete-order'];
 unset($_SESSION['delete-order']);

}
if(isset($_SESSION['update-order']))
{
 echo $_SESSION['update-order'];
 unset($_SESSION['update-order']);
}
?>
<div class="text-start mb-5">
    <p class="lead">Manage order</p>


</div>
    <table class="table-responsive table-bordered text-center text-md-start mb-5 bd">
        <thead>
            <tr>
                <th scope="col">.</th>
                <th scope="col">Date</th>
                <th scope="col">Billing</th>
                <th scope="col">Shipping</th>
                <th scope="col">note</th>
                <th scope="col">Shipment option</th>
                <th scope="col">payment option</th>
                <th scope="col">Total Price</th>
                <th scope="col">Special request</th>
                <th scope="col">Order_info</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <?php
        $sql = "SELECT*FROM order_tbl";
        $res = mysqli_query($conn, $sql);
        if ($res == TRUE) {
            $sn = 1; 
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                while ($rows = mysqli_fetch_assoc($res)) {
                    $id = $rows['id'];
                    $bid = $rows['billing_id'];
                    $sid = $rows['shipping_id'];
                    $price = $rows['total_price'];
                    $shipment = $rows['shipment_option'];
                    $payment = $rows['payment_option'];
                    $note = $rows['note'];
                    $request= $rows['request'];
                    $order= $rows['order_info'];
                    $date= $rows['order_date'];
        ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $sn++; ?></th>
                            <td><?php echo $date; ?></td>
                            <td>
                            <a href="<?php echo SITEURL; ?>admin/show-billing.php?id=<?php echo $bid; ?>" class="btn btn-outline-info text-center rounded  ">personal info</a>
                            </td>
                            <td>
                                <?php   if($sid==0){
?>

<p class="text-danger">Same like billing info</p>
<?php
                                
                                }
                                else{
?>
                                    <a href="<?php echo SITEURL; ?>admin/show-shipping.php?id=<?php echo $sid; ?>" class="btn btn-outline-info text-center rounded  ">shipping info</a><br>
                              
                              <?php
                                }
                                           
                               ?>
                            </td>
                            <td>
                        
                        
                            <a href="<?php echo SITEURL; ?>admin/show-note.php?id=<?php echo $id; ?>" class="btn btn-outline-primary text-center rounded  ">ORDER</a><br>
                        
                        
                        </td>
                            <td><?php echo $shipment; ?></td>
                            <td><?php echo $payment; ?></td>
                            <td><?php echo $price; ?></td>
                            <td>
                            <?php  
                            if($request==NULL){

                              ?>
                           <p class="text-primary">No Special requst</p>
                           <?php

                            }
                            else{

                                echo $request;
                            }
                            
                            ?>
                            
                            
                            </td>
                            <td>
                            <p class="fw-bold text-danger">


                            <?php
                            if($order==null){
                               echo"new order";
                            }
                            else{
                                echo $order; 
                            }
                            ?>
                            </p>    
                            
                           </td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn btn-outline-primary text-center rounded mt-2 mb-4"> Update</a>
                                <br>
                               <a href="<?php echo SITEURL; ?>admin/delete-order.php?id=<?php echo $id; ?>&bid=<?php echo $bid; ?>&sid=<?php echo $sid; ?>" class="btn btn-outline-danger text-center rounded mt-2 mb-2">Delete</a>

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

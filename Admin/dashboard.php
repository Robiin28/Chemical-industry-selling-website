
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
    <title>Dashboard</title>
</head>
<body>

<?php
include('./partials/menu.php');
?>

<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-lg-4 col-sm-8">
            <div class="border bg-light shadow lg p-5">
                <p class="lead fw-bold ms-2"> TOTAL price earned <br> <span class="text-danger">Earned value</span> </p></p>
                <?php
                $sqlA = "SELECT SUM(total_price) AS total_sum FROM order_tbl WHERE order_info = 'transaction_finished'";
                $resultA = mysqli_query($conn, $sqlA);
                $rowA = mysqli_fetch_assoc($resultA);
                $totalSumA = $rowA['total_sum'];
                ?>
                <div class="text-end fw-bolder">
                    <?php echo $totalSumA; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-8 ">
            <div class="border bg-light shadow lg p-5">
                <p class="lead fw-bold ms-2">TOTAL price expected <br> <span class="text-danger">In progress</span> </p>
                <?php
                $sqlB = "SELECT SUM(total_price) AS total_sum FROM order_tbl ";
                $resultB = mysqli_query($conn, $sqlB);
                $rowB = mysqli_fetch_assoc($resultB);
                $totalSumB = $rowB['total_sum'];
                ?>
                <div class="text-end fw-bolder">
                    <?php echo $totalSumB; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-8">
            <div class="border bg-light shadow lg p-5">
                <p class="lead fw-bold ms-2">Total tax<br> <span class="text-danger">need to be payed</span> </p> </p>
                <?php
                $tax = 0.15 * $totalSumA;
                ?>
                <div class="text-end fw-bolder">
                    <?php echo $tax; ?>
                </div>
            </div>
        </div>

    </div>


    <div class="row justify-content-center mt-5">
        <div class="col-lg-8">
            <div class="border bg-light shadow lg p-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Order Date</th>
                            <th scope="col">Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sqlTableData = "SELECT DATE_FORMAT(order_date, '%Y-%m-%d') AS order_date, SUM(total_price) AS total_sum 
                                        FROM order_tbl 
                                        GROUP BY DATE_FORMAT(order_date, '%Y-%m-%d')
                                        ORDER BY DATE_FORMAT(order_date, '%Y-%m-%d')";
                        $resultTableData = mysqli_query($conn, $sqlTableData);

                        while ($rowTableData = mysqli_fetch_assoc($resultTableData)) {
                            echo "<tr>";
                            echo "<td>{$rowTableData['order_date']}</td>";
                            echo "<td>{$rowTableData['total_sum']}</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php
include('./partials/footer.php');
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

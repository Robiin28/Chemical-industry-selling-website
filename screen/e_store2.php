<?php
include('../config/constant.php');
include('../partials/nav.php');
?>


<?php
if (isset($_GET['id']) && isset($_GET['pname'])) {
    $cid = $_GET['id'];
    $pname = $_GET['pname'];
} else {
    header('Location: ' . SITEURL . 'screen/e_store.php');
    exit(); // Ensure script stops after redirect
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <title>E_store</title>
</head>
<body>
    <div class="container-fluid bg-dark mb-5 p-5">
        <div class="fw-bold display-5 text-center text-white">
            Store
        </div>
    </div>
<div class="container">
<div class="lead">
We have all kind of high quality<?php echo " " ?> <?php echo $pname ?> <?php echo " " ?>chemicals


</div>
</div>


    <div class="container mt-5">
        <div class="row">

            <?php
       $sql3 = "SELECT * FROM chemical_tbl WHERE active='YES' AND ptype='$cid'";

            $res3 = mysqli_query($conn, $sql3);
            if ($res3 == TRUE) {
                $count3 = mysqli_num_rows($res3);
                if ($count3 > 0) {
                    while ($rows3 = mysqli_fetch_assoc($res3)) {
                        $id = $rows3['id'];
                        $cname = $rows3['cname'];
                        $image = $rows3['image'];
                        $price = $rows3['price'];
                        $ptype = $rows3['ptype'];
                        $packing = $rows3['packing'];
                        $tax = $price * 15 * 0.01;
                        $orginal = $price - $tax;
                        ?>
                        <input type="hidden" value="<?php echo $id ?>">

                        <div class="col-lg-4 col-sm-8">
                            <div class="pt-3 bg-outline-primary text-light border text-center shadow-lg mb-5">
                                <div class="img-container">
                                    <div class="img-padding">
                                        <img src="<?php echo SITEURL; ?>assets/chemical/<?php echo $image; ?>"  class="img-fluid" alt="" height="350" width="400">
                                    </div>
                                    <div class="star-rating text-start p-2">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                                    <div class="lead text-primary fw-bold"> <?php echo $cname ?></div>
                                    <p class="text-dark text-start ms-2"> Packing:<?php echo $packing ?></p>
                                    <br>
                                    <p class="text-dark">
                                        Sales price:<?php echo $price ?>ETB
                                        <br> price without tax:<?php echo $orginal ?>ETB <br>
                                        tax:<?php echo $tax ?>ETB
                                    </p>
                                    <div class="input-group mb-3">
                                        <button class="btn btn-outline-secondary ms-5 plusBtn" type="button">&#10133;</button>
                                        <input type="text" class="form-control text-center ms-2 me-2 quantityInput" name="quantity" placeholder="1" aria-label="Quantity" aria-describedby="basic-addon2" value="1">
                                        <button class="btn btn-outline-secondary me-5 minusBtn" type="button">&#10134;</button>
                                    </div>
                                    <div class="btn btn-success text-white">
                                        <a href="#" class="text-white fw-bold text-decoration-none addToCartBtn" data-id="<?php echo $id;?>">ADD TO CART</a>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="btn btn-light border btn-lg ">
                                        <a href="<?php echo SITEURL; ?>screen/detail.php?id=<?php echo $id; ?>&ptype=<?php echo $ptype; ?>"  class="text-dark text-decoration-none " >PRODUCT DETAILS</a>
                                    </div>
                                </div>
                                <br><br>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            ?>
        </div>
    </div>

    <script>
        // JavaScript functions to handle quantity increment and decrement
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".plusBtn").forEach(function(button) {
                button.addEventListener("click", function() {
                    var quantityInput = this.closest(".img-container").querySelector(".quantityInput");
                    quantityInput.value = parseInt(quantityInput.value) + 1;
                });
            });

            document.querySelectorAll(".minusBtn").forEach(function(button) {
                button.addEventListener("click", function() {
                    var quantityInput = this.closest(".img-container").querySelector(".quantityInput");
                    if (parseInt(quantityInput.value) > 1) {
                        quantityInput.value = parseInt(quantityInput.value) - 1;
                    }
                });
            });

            document.querySelectorAll(".addToCartBtn").forEach(function(button) {
                button.addEventListener("click", function(e) {
                    e.preventDefault();
                    var id = this.getAttribute("data-id");
                    var quantityInput = this.closest(".img-container").querySelector(".quantityInput");
                    var quantity = parseInt(quantityInput.value);
                    window.location.href = "<?php echo SITEURL; ?>screen/cart.php?id=" + id + "&quantity=" + quantity;
                });
            });
        });
    </script>
    <?php  

include('../partials/footer.php');

?>
</body>
</html>

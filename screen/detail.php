<?php
include('../config/constant.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            font-family: 'Arial', sans-serif;
            font-size: 1.5rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .arrow-icon {
            font-size: 18px;
            margin: 0 4px;
        }

        .plusBtn,
        .minusBtn {
            font-size: 12px;
        }

        .img-padding {
            transition: transform 0.3s ease-in-out;
        }

        .img-padding:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
<?php
include('../partials/nav.php');
?>


<div class="container-fluid bg-dark mb-5 p-5">
        <div class="fw-bold display-5 text-center text-white">
            Product Detail
        </div>
    </div>
<div class="container mt-5">


    <div class="row justify-content-center">

        <?php
        $currentID = isset($_GET['id']) ? $_GET['id'] : null;
     
        $ptype = isset($_GET['ptype']) ? $_GET['ptype'] : null;
        $sql_current = "SELECT * FROM chemical_tbl WHERE id = '$currentID' AND ptype = '$ptype' AND active = 'YES'";
        $result_current = mysqli_query($conn, $sql_current);

        if ($result_current && mysqli_num_rows($result_current) > 0) {
            $row_current = mysqli_fetch_assoc($result_current);
        } else {
            $sql_first = "SELECT * FROM chemical_tbl WHERE ptype = '$ptype' AND active = 'YES' ORDER BY id ASC LIMIT 1";
            $result_first = mysqli_query($conn, $sql_first);

            if ($result_first && mysqli_num_rows($result_first) > 0) {
                $row_current = mysqli_fetch_assoc($result_first);
            } else {
                echo "No active chemicals found in the database with the specified ptype.";
                exit;
            }
        }

  
        $sql_ids = "SELECT id, cname FROM chemical_tbl WHERE ptype = '$ptype' AND active = 'YES' ORDER BY id ASC";
        $result_ids = mysqli_query($conn, $sql_ids);

        $chemData = [];
        while ($row_ids = mysqli_fetch_assoc($result_ids)) {
            $chemData[$row_ids['id']] = $row_ids['cname'];
        }

        $currentIndex = array_search($currentID, array_keys($chemData));

        $prevID = $currentIndex > 0 ? array_keys($chemData)[$currentIndex - 1] : null;
        $nextID = $currentIndex < count($chemData) - 1 ? array_keys($chemData)[$currentIndex + 1] : null;


        $cname = $row_current['cname'];
        $image = $row_current['image'];
        $spec = $row_current['spec'];
        $price = $row_current['price'];
        $packing = $row_current['packing'];
        $tax = $price * 13.04 * 0.01;
        $orginal = $price - $tax;
        ?>

        <div class="col-lg-6 col-sm-8">
            <div class="pt-3 text-light text-center mb-5">
                <div class="img-container">
                    <p class="text-dark text-start">
                        <?php if ($prevID !== null): ?>
                            <a class=" lead text-primary text-decoration-none" href="?id=<?php echo $prevID; ?>&ptype=<?php echo $ptype; ?>"><?php echo $chemData[$prevID]; ?><i class="fas fa-arrow-left arrow-icon text-decoration-none fw-bold text-dark"></i></a>
                        <?php endif; ?>
                    </p>
                    <p class="lead fw-bold text-dark text-start ms-2"><?php echo $cname; ?></p>
                    <div class="img-padding text-start">
                        <img src="<?php echo SITEURL; ?>assets/chemical/<?php echo $image; ?>" class="img-fluid" alt="" height="350" width="400">
                    </div>
                    <p class="text-dark text-start ms-2"> Description <br> Specification: <?php echo $spec; ?><br>Packing: <?php echo $packing; ?> </p>
                    <br><br>
                </div>
                <br><br>
            </div>
        </div>

        <div class="col-lg-5 col-sm-8">
            <p class="text-dark text-end">
                <?php if ($nextID !== null): ?>
                    <a class=" lead text-primary text-decoration-none"href="?id=<?php echo $nextID; ?>&ptype=<?php echo $ptype; ?>"><?php echo $chemData[$nextID]; ?><i class="fas fa-arrow-right arrow-icon text-decoration-none fw-bold text-dark"></i></a>
                <?php endif; ?>
                <a href="<?php echo SITEURL; ?>screen/e_store.php"class="btn btn-outline-success text-dark text-decoration-none ms-5"> Back to tanning chemicals </a>
            </p>
            <br><br>

            <div class="star-rating text-start p-2 ms-4 me-5">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="text-dark ms-5">
                Sales price: <?php echo $price; ?> ETB
                <br> Price without tax: <?php echo $orginal; ?> ETB <br>
                Tax: <?php echo $tax; ?> ETB
            </p>
            <div class="input-group mb-3 text-center">
                <button class="btn btn-outline-secondary ms-5 plusBtn" type="button">&#43;</button>
                <input type="text" class="form-control text-center ms-2 me-2 quantityInput" placeholder="1" aria-label="Quantity" aria-describedby="basic-addon2" value="1">
                <button class="btn btn-outline-secondary me-5 minusBtn" type="button">&#8211;</button>
            </div>
            <div class="btn btn-success text-white ms-5">
            <a href="#" class="text-white fw-bold text-decoration-none addToCartBtn" data-id="<?php echo $id;?>">ADD TO CART</a>
            </div>
        </div>

        <p>Reviews</p>
        <div class="col-12 border-top mb-5">
            <p>No reviews yet</p>
        </div>
    </div>
</div>
<?php  

include('../partials/footer.php');

?>
</body>
<script>
    // JavaScript functions to handle quantity increment and decrement
    document.querySelectorAll(".plusBtn").forEach(function(button) {
        button.addEventListener("click", function() {
            var quantityInput = this.parentNode.querySelector(".quantityInput");
            quantityInput.value = parseInt(quantityInput.value) + 1;
        });
    });

    document.querySelectorAll(".minusBtn").forEach(function(button) {
        button.addEventListener("click", function() {
            var quantityInput = this.parentNode.querySelector(".quantityInput");
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        });
    });

    document.querySelectorAll(".addToCartBtn").forEach(function(button) {
        button.addEventListener("click", function(e) {
            e.preventDefault();
            var id = "<?php echo $currentID; ?>";
            var quantityInput = this.closest(".col-lg-5").querySelector(".quantityInput");
            var quantity = parseInt(quantityInput.value);
            window.location.href = "<?php echo SITEURL; ?>screen/cart.php?id=" + id + "&quantity=" + quantity;
        });
    });
</script>

</html>

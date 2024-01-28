<?php


include('../config/constant.php');


if (isset($_POST['submit'])) {
    $pname = mysqli_real_escape_string($conn, $_POST['pname']);
    $pdsc = mysqli_real_escape_string($conn, $_POST['pdesc']);

    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        $ext = pathinfo($image_name, PATHINFO_EXTENSION);
        $image_name = "product_" . rand(000, 999) . '.' . $ext;
        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../assets/products/" . $image_name;

        if (!file_exists("../assets/products/")) {
            mkdir("../assets/products/", 0777, true);
        }

        $upload = move_uploaded_file($source_path, $destination_path);
        if (!$upload) {
            $image_name = "";
        }
    }
    $stmt = $conn->prepare("INSERT INTO product_tbl (pname, image, pdsc) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $pname, $image_name, $pdsc);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $_SESSION['add-product'] = "<div class='border text-success text-center'>  <b>  Product Added Successfully</b>  </div>";
        header('location: ' . SITEURL . 'admin/product.php');
        exit();
    } else {
        $_SESSION['add-product'] = "<div class='error'>Failed To Add Product</div>";
        header('location: ' . SITEURL . 'admin/add-product.php');
        exit();
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
    <title>Add product</title>
</head>
<body>
<?php include('./partials/menu.php');?>
<div class="container-fluid bg-dark mb-5 p-5">
        <div class="fw-bold display-5 text-center text-white">
            Add Product
        </div>
    </div>



    <div class="container">
        <?php
        if (isset($_SESSION['add-product'])) {
            echo $_SESSION['add-product'];
            unset($_SESSION['add-product']);
        }
        ?>
        <form class="text-lg-start text-md-start mt-5  " action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="pname"><b>  Product Name:</b> </label>
                <input  type="text" name="pname" id="pname" class="form-control ms-5" placeholder="Enter your product name"
                    required>
            </div>
            <br>
            <div class="form-group">
                <label   for="pdesc"><b>Description:</b></label>
                <textarea name="pdesc" id="pdesc" class="form-control ms-5" placeholder="Enter product description"
                    required></textarea>
            </div>
            <br>
            <div class="form-group">
                <label for="image"><b>Select Image:</b></label>
                <input type="file" name="image" id="image" class="form-control ms-5" required>
            </div>

            <br><br><br>
            <div class="form-group  text-center">
                <input type="submit" name="submit" class='btn btn-secondary' value="Add Product">
            </div>
        </form>
    </div>
    <br><br><br>

    <?php include('./partials/footer.php');?>


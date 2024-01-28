
<?php

include('../config/constant.php');

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $pname = $_POST['pname'];
    $pdesc = $_POST['pdesc'];
    $image1 = $_POST['image1'];

    if (isset($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];

        if ($image != "") {
            $tmp = explode('.', $image);
            $ext = end($tmp);
            $image = "product_" . rand(0000, 9999) . '.' . $ext;
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../assets/products/" . $image;
            $upload = move_uploaded_file($source_path, $destination_path);

            if (!$upload) {
                $_SESSION['upload_image'] = "<div class='text-danger'>Failed To Upload Updated Image </div>";
                header('location:' . SITEURL . '/admin/update-product.php');
                exit();
            }

            if ($image1 != "") {
                $remove_path = "../assets/products/" . $image1;
                $remove = unlink($remove_path);

                if (!$remove) {
                    $_SESSION['failed-remove'] = "<div class='text-danger'>Failed To remove current Image  </div>";
                    header('location:' . SITEURL . '/admin/update-product.php');
                    exit();
                }
            }
        } else {
            $image = $image1;
        }
    } else {
        $image = $image1;
    }

    $sql2 = "UPDATE product_tbl SET
       pname='$pname',
       pdsc='$pdesc',
       image='$image'
        WHERE id='$id'
    ";
    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == true) {
        $_SESSION['update_product'] = "<div class='text-success'>Your product Updated Successfully</div>";
        header('location:' . SITEURL . '/admin/product.php');
        ob_end_flush();
        exit();
    } else {
        $_SESSION['update_product'] = "<div class='text-danger'>Failed to Update your product</div>";
        header('location:' . SITEURL . '/admin/update-product.php');
        exit();
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM product_tbl WHERE id=$id";
$res = mysqli_query($conn, $sql);

if ($res == true) {
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $name = $row['pname'];
        $desc = $row['pdsc'];
        $image1 = $row['image'];
    } else {
        header("location:" . SITEURL . 'admin/product.php');
    }
}

include('./partials/menu.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.0/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Update product</title>

    <style>
        .display-5 {
            margin-left: 5rem;
            margin-top: 5rem;
            font-family: 'Roboto', sans-serif;
            font-weight: bold;
            color: #333;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .imgn {
            border-radius: 10px;
        }

        .lead {
            animation: slideInLeft 3s ease-in-out;
            font-family: 'Arial', sans-serif;
            font-size: 1.5rem;
            color: #555;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .lead:hover {
            color:blue;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
    
    <div class="container-fluid bg-dark mb-5 p-5">
        <div class="fw-bold display-5 text-center text-white">
            Update product information
        </div>
    </div>
    <div class="lead ms-5 mt-5">UPDATE PRODUCT</div>
    <br><br>
    <?php
      if (isset($_SESSION['upload_image'])) {
        echo $_SESSION['upload_image'];
        unset($_SESSION['upload_image']);
    }
    if (isset($_SESSION['update_product'])) {
        echo $_SESSION['update_product'];
        unset($_SESSION['update_product']);
    }

    if (isset($_SESSION['failed-remove'])) {
        echo $_SESSION['failed-remove'];
        unset($_SESSION['failed-remove']);
    }
    ?>

    <div class="container">
        <div class="text-center display-4 mt-5"><?php echo $name ?></div>
        <br><br>
        <div class="row justify-content-center mt-3">
            <div class="col-lg-6 col-md-4">
                <img src="<?php echo SITEURL; ?>assets/products/<?php echo $image1; ?>" alt="" class="img-fluid imgn"
                    height="600" width="700">
            </div>
            <div class="col-lg-6 col-md-4">
                <p class="lead"><?php echo $desc ?></p>
            </div>
            <div class="container">
            <form class="text-lg-start text-md-start mt-5  " action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="pname"><b>  Product Name:</b> </label>
                    <input type="text" name="pname" id="pname" class="form-control ms-5" value="<?php echo $name ?>"
                        placeholder="Enter your product name" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="pdesc"><b>Description:</b></label>
                    <textarea name="pdesc" id="pdesc" class="form-control ms-5"
                        placeholder="Enter product description" required><?php echo $desc ?></textarea>
                </div>
                <br>
                <div class="form-group">
                    <label for="image"><b>Select  new Image:</b></label>
                    <input type="file" name="image" id="image" class="form-control ms-5">
                </div>
                <br>
                <div class="form-group  text-center">
                    <input type="submit" name="submit" class='btn btn-secondary' value="update Product">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="image1" value="<?php echo $image1; ?>">
                </div>
                <br><br><br>
            </form>
        </div>
        </div>
      
    </div>



    <br><br>
    <?php include('./partials/footer.php'); ?>
</body>
</html>

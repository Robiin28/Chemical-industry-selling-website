<?php

include('../config/constant.php');


if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $cname = $_POST['cname'];
    $price = $_POST['price'];
    $ptype = $_POST['ptype'];
    $packing = $_POST['packing'];
    $spec = $_POST['spec'];
    $image1 = isset($_POST['image1']) ? $_POST['image1'] : "";
    
    if (isset($_POST['active'])) {
        $active = $_POST['active'];
    } else {
        $active = "NO";
    }

    if (isset($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];

        if ($image != "") {
            $tmp = explode('.', $image);
            $ext = end($tmp);
            $image = "chemical_" . rand(0000, 9999) . '.' . $ext;
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../assets/chemical/" . $image;
            $upload = move_uploaded_file($source_path, $destination_path);

            if (!$upload) {
                $_SESSION['upload_chemimage'] = "<div class='text-danger border fw-bold'>Failed To Upload Updated Image </div>";
                header('location:' . SITEURL . '/admin/update-chemical.php?id=' . $id);
                exit();
            }

            if ($image1 != "") {
                $remove_path = "../assets/chemical/" . $image1;
                $remove = unlink($remove_path);

                if (!$remove) {
                    $_SESSION['failed-chemremove'] = "<div class='text-danger border fw-bold'>Failed To remove current Image  </div>";
                    header('location:' . SITEURL . '/admin/update-chemical.php?id=' . $id);
                    exit();
                }
            }
        } else {
            $image = $image1;
        }
    } else {
        $image = $image1;
    }

    $sql2 = "UPDATE chemical_tbl SET
       cname='$cname',
       ptype='$ptype',
       price='$price',
       active='$active',
       packing='$packing',
       spec='$spec',
       image='$image'
        WHERE id='$id'
    ";
    $res2 = mysqli_query($conn, $sql2);
    if ($res2 == true) {
        $_SESSION['update_chemical'] = "<div class='text-success'>Your chemical Updated Successfully</div>";
        header('location:' . SITEURL . '/admin/chemical.php');
        ob_end_flush();
        exit();
    } else {
        $_SESSION['update_product'] = "<div class='text-danger'>Failed to Update your chemical</div>";
        header('location:' . SITEURL . '/admin/update-chemical.php?id=' . $id);
        exit();
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM chemical_tbl WHERE id=$id";
$res = mysqli_query($conn, $sql);

if ($res == true) {
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $name = $row['cname'];
        $desc = $row['spec'];
        $type = $row['ptype'];
        $prc = $row['price'];
        $act = $row['active'];
        $pak = $row['packing'];
        $image1 = $row['image'];
    } else {
        header("location:" . SITEURL . 'admin/chemical.php');
    }
}

$sql3 = "SELECT * FROM product_tbl WHERE id=$type";
$res3 = mysqli_query($conn, $sql3);

if ($res3 == true) {
    $count3 = mysqli_num_rows($res3);

    if ($count3 == 1) {
        $row3 = mysqli_fetch_assoc($res3);
        $pname = $row3['pname'];
    } else {
        header("location:" . SITEURL . 'admin/chemical.php');
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
    <title>Update Chemical</title>


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
            color: blue;
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
</head>

<body>
<div class="container-fluid bg-dark mb-5 p-5">
        <div class="fw-bold display-5 text-center text-white">
            Update Chemicals
        </div>
    </div>
    <div class="container">
        <div class="text-center display-4 mt-5"><?php echo $name ?></div>
        <br><br>
        <div class="row justify-content-center mt-3">
            <div class="col-lg-6 col-md-4">
                <img src="<?php echo SITEURL; ?>assets/chemical/<?php echo $image1; ?>" alt="" class="img-fluid imgn"
                    height="400" width="500">
            </div>
            <div class="col-lg-6 col-md-4">
                <p class="lead">Chemical name :<?php echo $name ?></p>
                <p class="lead">Type of product :<?php echo  $pname ?></p>
                <p class="lead">Specification :<?php echo  $desc ?></p>
                <p class="lead">Sold for :<?php echo $prc ?></p>
                <p class="lead">Packing type: <?php echo $pak ?></p>
                <p class="lead">Is it Active : <?php echo $act ?></p>
            </div>
        </div>

        <div class="container">
            <form class="text-lg-start text-md-start mt-5" action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label for="name"><b> Chemical Name:</b> </label>
                    <input type="text" name="cname" id="pname" class="form-control ms-5" value="<?php echo $name ?>"
                        placeholder="Enter your product name" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="spec"><b>Specification:</b></label>
                    <textarea name="spec" id="pdesc" class="form-control ms-5"
                        placeholder="Enter Chemical Specification" required><?php echo $desc ?></textarea>
                </div>
                <br>
                <div class="form-group">
                    <label for="ptype"><b> Product Type: </b> </label>
                    <select name='ptype'>
                        <?php
                        $sql5 = "SELECT * FROM product_tbl";
                        $res5 = mysqli_query($conn, $sql5);
                        $count5 = mysqli_num_rows($res5);
                        if ($count5 > 0) {
                            while ($row5 = mysqli_fetch_assoc($res5)) {
                                $pid = $row5['id'];
                                $pname = $row5['pname'];
                        ?>
                                <option value="<?php echo $pid; ?>" <?php if ($pid == $type) echo 'selected'; ?>><?php echo $pname; ?></option>
                        <?php
                            }
                        } else {
                        ?>
                            <option value="0">No product is added</option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label for="image"><b>Select New Image:</b></label>
                    <input type="file" name="image" id="image" class="form-control ms-5">
                    <input type="hidden" name="image1" value="<?php echo $image1; ?>">
                </div>
                <div class="form-group">
                    <label for="price"><b> Price:</b> </label>
                    <input type="text" value="<?php echo $prc ?>" name="price" id="pname" class="form-control ms-5"
                        placeholder="Enter your Chemical price" required>
                </div>
                <div class="form-group">
                    <label for="packing" "><b> Packing Terms:</b> </label>
                    <input type="text" name="packing" value="<?php echo $pak ?>" id="packing" class="form-control ms-5"
                        placeholder="Enter your Chemical packing terms" required>
                </div>
                <div class="form-group ">
                    <label class="fw-bold me-3"> Active: </label>
                    <input <?php if ($act == "YES") {
                                echo "checked";
                            } ?> type="radio" name="active" value="YES"><span class="me-3">YES</span>
                    <input <?php if ($act == "NO") {
                                echo "checked";
                            } ?> type="radio" name="active" value="NO"><span>NO</span>
                </div>
                <br><br><br>
                <div class="form-group text-center">
                    <input type="submit" name="submit" class='btn btn-secondary' value="Update Chemical">
                    <br><br>
                </div>
            </form>
        </div>
    </div>

    <br><br>
    <?php include('./partials/footer.php'); ?>
</body>

</html>

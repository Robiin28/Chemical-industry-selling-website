
<?php
ob_start(); // Start output buffering

include('../config/constant.php');
include('./partials/menu.php');

if (isset($_POST['submit'])) {
    $cname = $_POST['cname'];
    $spec = $_POST['spec'];
    $price = $_POST['price'];
    $packing = $_POST['packing'];
    $ptype = $_POST['ptype'];

    if (isset($_POST['active'])) {
        $active = $_POST['active'];
    } else {
        $active = "NO";
    }

    if (isset($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $dmp = explode('.', $image);
        $ext = end($dmp);
        $image = "chemical_" . rand(0000, 9999) . '.' . $ext;
        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../assets/chemical/" . $image;
        $upload = move_uploaded_file($source_path, $destination_path);

        if ($upload == false) {
            $image = "";
        }
    }

    $sql2 = "INSERT INTO chemical_tbl SET
    cname='$cname',
    image='$image',
    spec='$spec',
    ptype='$ptype',
    price='$price',
    packing='$packing',
    active='$active'";

    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == TRUE) {
        $_SESSION['add-chemical'] = "<div class='text-success border-1'>Chemical Added Successfully</div>'";
        header('location:' . SITEURL . 'admin/chemical.php');
        ob_end_flush(); // Flush the output buffer before the redirect
    } else {
        $_SESSION['add-chemical'] = "<div class='text-danger border-1'>Failed To Add Chemical</div>'";
        header('location:' . SITEURL . 'admin/add-chemical.php');
        ob_end_flush(); // Flush the output buffer before the redirect
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
    <title>Add Chemical</title>
</head>
<body>



<div class="container-fluid bg-dark mb-5 p-5">
        <div class="fw-bold display-5 text-center text-white">
            Add Chemical
        </div>
    </div>


    <div class="container">
        <?php
        if (isset($_SESSION['add-chemical'])) {
            echo $_SESSION['add-chemical'];
            unset($_SESSION['add-chemical']);
        }
        ?>
        <form class="text-lg-start text-md-start mt-5  " action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name"><b> Chemical Name:</b> </label>
                <input  type="text" name="cname" id="pname" class="form-control ms-5" placeholder="Enter your product name"
                    required>
            </div>
            <br>
            <div class="form-group">
                <label   for="spec"><b>Specification:</b></label>
                <textarea name="spec" id="pdesc" class="form-control ms-5" placeholder="Enter Chemical Specification"
                    required></textarea>
            </div>
            <br>
            <div class="form-group">
                    <td> <b> Product Type: </b> </td>
                    <td>
                        <select name='ptype'>
                    <?php    
                    $sql ="SELECT*FROM product_tbl";
                    $res=mysqli_query($conn,$sql);
                    $count=mysqli_num_rows($res);
                    if($count>0)
                    {
             while($row=mysqli_fetch_assoc($res))
             {
                $id=$row['id'];
                $pname=$row['pname'];
                ?>
                <option value="<?php echo $id; ?>"><?php echo $pname; ?></option> 
                <?php
             }
                    }
                    else
                    {
                      ?>
                      <option value="0">No product is added</option>
                      <?php
                    }
                    ?>
                    </select>
                    </td>
                    
            </div>
            <br>
            <div class="form-group">
                <label for="image"><b>Select Image:</b></label>
                <input type="file" name="image" id="image" class="form-control ms-5" required>
            </div>
            <div class="form-group">
                <label for="price"><b> Price:</b> </label>
                <input  type="text" name="price" id="pname" class="form-control ms-5" placeholder="Enter your Chemical price"
                    required>
            </div>
            <div class="form-group">
                <label for="pak"><b> Packing Terms:</b> </label>
                <input  type="text" name="packing" id="packing" class="form-control ms-5" placeholder="Enter your Chemical packing terms"
                    required>
            </div>
            <div class="form-group ">
                    <label class="fw-bold me-3"> Active: </label>
                        <input type="radio"  name="active" value="YES" ><span class="me-3">YES</span>
                        <input type="radio" name="active" value="NO" > <span>NO</span>
            </div>
            <br><br><br>
            <div class="form-group  text-center">
                <input type="submit" name="submit" class='btn btn-secondary' value="Add Chemical">
            </div>
        </form>
    </div>
    <br><br><br>

    <?php include('./partials/footer.php');?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

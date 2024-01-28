<?php
include('../config/constant.php');
include('./partials/login-check.php');

if (isset($_GET['id']) && isset($_GET['image'])) {
    $id = $_GET['id'];
    $productImage = $_GET['image'];

    // Delete product image
    if ($productImage != "") {
        $productImagePath = "../assets/products/" . $productImage;
        $removeProductImage = unlink($productImagePath);
        if ($removeProductImage === false) {
            $_SESSION['remove-image'] = "<div class='txt-danger border fw-bold'>Failed to remove product image</div>";
            header('location: ' . SITEURL . 'admin/product.php');
            die();
        }
    }

    // Delete chemical images
    $sqlSelectChemicals = "SELECT image FROM chemical_tbl WHERE ptype=$id";
    $resultSelectChemicals = mysqli_query($conn, $sqlSelectChemicals);

    while ($row = mysqli_fetch_assoc($resultSelectChemicals)) {
        $chemicalImage = $row['image'];
        if ($chemicalImage != "") {
            $chemicalImagePath = "../assets/chemicals/" . $chemicalImage;
            $removeChemicalImage = unlink($chemicalImagePath);
            // Handle errors if needed
        }
    }

    // Delete chemicals from the database
    $sqlDeleteChemicals = "DELETE FROM chemical_tbl WHERE ptype=$id";
    $resultDeleteChemicals = mysqli_query($conn, $sqlDeleteChemicals);
    if ($resultDeleteChemicals === false) {
        $_SESSION['delete-product'] = "<div class='text-danger border fw-bold'>Failed to delete chemicals</div>";
        header('location: ' . SITEURL . 'admin/product.php');
        die();
    }

    // Delete the product from the database
    $sqlDeleteProduct = "DELETE FROM product_tbl WHERE id=$id";
    $resultDeleteProduct = mysqli_query($conn, $sqlDeleteProduct);
    if ($resultDeleteProduct === true) {
        $_SESSION['delete-product'] = "<div class='text-success  border fw-bold'>Product deleted successfully</div>";
        header('location: ' . SITEURL . 'admin/product.php');
    } else {
        $_SESSION['delete-product'] = "<div class='text-danger  border fw-bold'>Failed to delete product</div>";
        header('location: ' . SITEURL . 'admin/product.php');
    }
} else {
    header('location: ' . SITEURL . 'admin/product.php');
}
?>

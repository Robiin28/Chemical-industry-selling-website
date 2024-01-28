<?php include('../config/constant.php');
include('./partials/login-check.php');

?>
<?php 
if(isset($_GET['id']) AND isset($_GET['image']))
   {
        $id=$_GET['id'];
        $image=$_GET['image'];
                if($image != "")
                {
                  $path="../assets/chemical/".$image;
                  $remove=unlink($path);
                  if($remove==false)
                      {
                          $_SESSION['remove-chemimage']="<div class='txt-danger border p-3 text-center'>Failed to remove image of chemical</div>";
                          header('location: ' . SITEURL . 'admin/chemical.php');
                          die();
                       } 
                   }
                $sql="DELETE FROM chemical_tbl WHERE id=$id";
                $res=mysqli_query($conn,$sql);
                if($res==true)
                {
                    $_SESSION['delete-chemical']="<div class=' border text-center text-success p-3'>Chemical deleted successfully</div>";
                    header('location: ' . SITEURL . 'admin/chemical.php');
                }
                else
                {
                    $_SESSION['delete-chemical']="<div class='text-danger border text-center p-3'>Failed to delete chemical</div>";
                    header('location: ' . SITEURL . 'admin/chemical.php');
                }
            }
else
{
    header('location: ' . SITEURL . 'admin/chemical.php');
}




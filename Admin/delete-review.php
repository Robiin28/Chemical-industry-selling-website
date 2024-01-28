<?php include('../config/constant.php');
include('./partials/login-check.php');


?>
<?php 
if(isset($_GET['id']))
   {
        $id=$_GET['id'];
                $sql="DELETE FROM treview_tbl WHERE id=$id";
                $res=mysqli_query($conn,$sql);
                if($res==true)
                {
                    $_SESSION['delete-review']="<div class='text-success'>review deleted successfully</div>";
                    header('location: ' . SITEURL . 'admin/reviews.php');
                }
                else
                {
                    $_SESSION['delete-review']="<div class='text-danger'>Failed to delete review</div>";
                    header('location: ' . SITEURL . 'admin/reviews.php');
                }
            }
else
{
    header('location: ' . SITEURL . 'admin/reviews.php');
}




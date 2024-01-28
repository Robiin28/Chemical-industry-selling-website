<?php

include('../config/constant.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $oldPassword = mysqli_real_escape_string($conn, $_POST['old_password']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $sql = "SELECT password FROM account_tbl WHERE username='admin'";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        $row = mysqli_fetch_assoc($res);
        $currentPassword = $row['password'];

        // Using password_verify for password verification
        if (password_verify($oldPassword, $currentPassword)) {
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $sqlUpdatePassword = "UPDATE account_tbl SET password='$hashedNewPassword' WHERE username='admin'";
            $resultUpdatePassword = mysqli_query($conn, $sqlUpdatePassword);

            if ($resultUpdatePassword) {
                echo '<div class="alert alert-success text-center p-5 border" role="alert">Password updated successfully!</div>';
            } else {
                echo '<div class="alert alert-danger p-5 text-center border" role="alert">Failed to update password.</div>';
            }
        } else {
            echo '<div class="alert alert-danger border text-center p-5" role="alert">Incorrect old password.</div>';
        }
    } else {
        echo '<div class="alert alert-danger border p-5 text-center" role="alert">Error fetching current password.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 600px;
        }

        .bg-dark {
            background-color: #343a40 !important;
        }

        .text-primary {
            color: #007bff !important;
        }

        .btn-outline-primary {
            color: #007bff;
            border-color: #007bff;
        }

        .btn-outline-primary:hover {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>

<?php
include('./partials/menu.php');
?>

<div class="container-fluid bg-dark mb-5 p-5">
    <div class="fw-bold display-5 text-center text-white">
        Admin setting
    </div>
</div>

<div class="container mb-5">
    <div class="container border shadow-lg lead p-4 ms-4">
        <div class="text-end">
            <a href="<?php echo SITEURL; ?>admin/dashboard.php" class="btn btn-lg btn-outline-primary text-dark me-3">Back</a>
        </div>

        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-3">Change Admin Credentials</h2>

                <div class="container p-5 ">
                    <form method="POST">
                        <div class="form-group">
                            <label for="old_password">Old Password</label>
                            <input type="password" name="old_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" name="new_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
include('./partials/footer.php');
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

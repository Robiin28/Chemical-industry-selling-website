<?php
include('../config/constant.php');
session_start(); 

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM account_tbl WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['password'];

            if (password_verify($password, $hashedPassword)) {

                $_SESSION['login']="<div class='success'> LOGIN SUCCESSFULLY </div>";
           
                $_SESSION['last-time']=time();
                $_SESSION['user']=$username;
                header("location:".SITEURL.'admin/dashboard.php');
                ob_end_flush();
            } else {
                $message = "Invalid username or password";
            }
        } else {
            $message = "Invalid username or password";
        }
    } else {
        $message = "Error executing query";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <style>
        body {
            background-color: #000;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 400px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-header {
            background-color: darkblue;
            color: white;
            text-align: center;
            padding: 10px;
        }

        .form-group {
            margin: 20px;
        }

        .login-btn {
            color: white;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .login-btn:hover {
            background-color: #0056b3;
        }

        .error-msg {
            color: #dc3545;
            margin-top: 10px;
        }

        .fa-lock {
            font-size: 24px;
            margin-right: 10px;
        }

        .fa-user {
            font-size: 24px;
            margin-right: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header text-start">
            <h4><i class="fas fa-lock"></i> Admin Login
                <br>
                <?php
                ob_start();
                if (isset($_SESSION['log'])) {
                    echo $_SESSION['log'];
                    unset($_SESSION['log']); 
                }
                if (isset($_SESSION['login'])) {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']); 
                }
                if (isset($_SESSION['time'])) {
                    echo $_SESSION['time'];
                    unset($_SESSION['time']); 
                }

                ?>
            </h4>
        </div>
        <div class="card-body">
            <?php if (!empty($message)): ?>
                <div class="alert alert-danger error-msg" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label for="username"><i class="fas fa-user"></i> Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn login-btn btn-success"><i class="fas fa-sign-in-alt"></i> Login</button>
                <div class="text-center mt-2"><a href="<?php echo SITEURL; ?>screen/contact_us.php" class="btn btn-lg btn-outline-danger">back</a></div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

</body>
</html>

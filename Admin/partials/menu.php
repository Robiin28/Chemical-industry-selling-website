<?php
include('../config/constant.php');
include('login-check.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.0/css/boxicons.min.css">
    <style>
        .navbar-nav .nav-item {
            margin-right: 10px;
        }

        .navbar-nav .nav-item a {
            color: black;
        }

        .navbar-nav .nav-item a:hover {
            background-color: blue;
            color: white;
        }
        .profile{

            border-radius: 50%;
        }
       
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container-fluid   ms-5 ">
            <img src="../assets/ASAL-IMPEX-WEBSITE-LOGO-4.jpg" alt="logo" height="50px" width="50px">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITEURL; ?>admin/dashboard.php">
                            <i class='bx bxs-home'></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="nav-link" href="<?php echo SITEURL; ?>admin/product.php">
                            <i class='bx bxs-package'></i>
                            <span>Product</span>
                            <p class="message">Manage product</p>
                        </a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="nav-link" href="<?php echo SITEURL; ?>admin/setting.php">
                            <i class='bx bxs-cog'></i>
                            <span>Setting</span>
                            <p class="message">Control web</p>
                        </a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="nav-link" href="<?php echo SITEURL; ?>admin/chemical.php">
                            <i class='bx bxs-flask'></i>
                            <span>Chemicals</span>
                            <p class="message">Manage Chemicals</p>
                        </a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="nav-link" href="<?php echo SITEURL; ?>admin/reviews.php">
                            <i class='bx bx-message'></i>
                            <span>Message</span>
                            <p class="message">Review message</p>
                        </a>
                    </li>


                    <li class="nav-item ms-2 me-5">
                        <a class="nav-link" href="<?php echo SITEURL; ?>admin/order.php">
                            <i class='bx bx-shopping-bag'></i>
                            <span>Order</span>
                            <p class="message">View Orders</p>
                        </a>
                    </li>

                    <li class="nav-item ">

                      <img class="profile" src="../assets/ASAL-IMPEX-Manager.jpg" alt=""  height="50px" width="50px">
                      <p class="message"><a class="nav-link" href="<?php echo SITEURL; ?>admin/logout.php">
                            <i class='bx bx-log-out me-2'></i>
                              <span>Logout</span>
                        </a></p>
                    </li> 
                </ul>
            </div>
        </div>
    </nav>
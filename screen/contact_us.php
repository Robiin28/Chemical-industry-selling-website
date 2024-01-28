<?php
include('../config/constant.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO treview_tbl (name, phone, email, message) VALUES ('$name', '$phone', '$email', '$message')";

    if (mysqli_query($conn, $sql)) {
        // Record inserted successfully, set success message
        $successMessage = 'Your message has been sent successfully. We will contact you as soon as possible.';
    } else {
        // Handle error if needed
        $errorMessage = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.0/css/boxicons.min.css">
    <style>
        /* Example styles for the input fields */
        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        input:focus,
        textarea:focus {
            border-color: #007bff; /* Change to your preferred focus color */
        }

        /* Hover effect for the image */
        .img-fluid:hover {
            transform: scale(1.1); /* Increase the scale factor for a more pronounced effect */
            transition: transform 0.3s ease;
        }

        /* Styles for the form container */
        .form-container {
            background-color: #f8f9fa; /* Change to your preferred background color */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .form-container:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        /* Styles for the sidebar */
        .sidebar {
            position: fixed;
            top: 200px;
            left: 0;
            height: 100vh;
            overflow-x: hidden;
        }

        .sidebar-item {
            width: 50px; /* Initial small width */
            background-color: black;
            transition: width 0.3s;
            overflow: hidden;
            white-space: nowrap;
        }

        .sidebar-icon {
            font-size: 30px;
            color: white;
            text-align: center;
            text-decoration: none;
            display: block;
            transition: font-size 0.3s, padding 0.3s;
            padding: 15px 0;
        }

        .sidebar-name {
             color:white;
            display: none;
            white-space: nowrap;
        }

        .sidebar-item:hover {
            width: 200px; /* Expanded width on hover */
        }

        .sidebar-item:hover .sidebar-icon {
            font-size: 20px;
        }

        .sidebar-item:hover .sidebar-name {
            display: inline;
            padding-left: 10px;
        }
    </style>
    <title>Contact Us</title>
</head>
<body>
    <?php
    include('../partials/nav.php');
    ?>
    <div class="container-fluid bg-dark mb-5 p-5">
        <div class="fw-bold display-5 text-center text-white">
            Store
        </div>
    </div>
     <div class="col-2 text-end sidebar">
                <div class="sidebar-item">
                    <a href="www.facebook.com" class="sidebar-icon"><i class='bx bxl-facebook'></i></a>
                    <span class="sidebar-name">Facebook</span>
                </div>
                <div class="sidebar-item">
                    <a href="www.twitter.com" class="sidebar-icon"><i class='bx bxl-twitter'></i></a>
                    <span class="sidebar-name">Twitter</span>
                </div>
                <div class="sidebar-item">
                    <a href="www.linkedin.com" class="sidebar-icon"><i class='bx bxl-linkedin'></i></a>
                    <span class="sidebar-name">LinkedIn</span>
                </div>
                <div class="sidebar-item">
                    <a href="<?php echo SITEURL; ?>admin/login.php" class="sidebar-icon"><i class='bx bx-user'></i></a>
                    <span class="sidebar-name">Admin</span>
                </div>
            </div>

   
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-5">
                            <img src="../assets/ASAL-IMPEX-MEETING-ROOM.jpg" class="img-fluid mb-5" alt="" height="500" width="500">
                        </div>
                        <div class="col-lg-6 col-sm-9 mb-5 form-container">
                            <form action="" method="post">
                                <input type="text" name="name" placeholder="Your Name" required>
                                <br>
                                <input type="tel" name="phone" placeholder="Your Phone Number" required>
                                <br>
                                <input type="email" name="email" placeholder="Your Email" required>
                                <br>
                                <textarea name="message" placeholder="Your Message" cols="30" rows="10" required></textarea>
                                <br>
                                <button type="submit" class="btn btn-lg  btn-outline-primary ms-5">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            
        <!-- Bootstrap Modal for Success -->
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">Success</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><?php echo $successMessage; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bootstrap Modal for Success -->
        
        <!-- Bootstrap Modal for Error -->
        <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
           
        
        <br><br>
        <div class="modal-dialog mt-5">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <h5 class="modal-title" id="errorModalLabel">Error</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><?php echo $errorMessage; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bootstrap Modal for Error -->
        
        <!-- Show modals based on conditions -->
        <?php
        if (isset($successMessage)) {
            echo '<script>$("#successModal").modal("show");</script>';
        }
        if (isset($errorMessage)) {
            echo '<script>$("#errorModal").modal("show");</script>';
        }
        ?>
    <?php
    include('../partials/footer.php');
    ?>

<script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script>
    <?php if (isset($successMessage)) : ?>
        $(document).ready(function () {
            $('#successModal').modal('show');
        });
    <?php endif; ?>

    <?php if (isset($errorMessage)) : ?>
        $(document).ready(function () {
            $('#errorModal').modal('show');
        });
    <?php endif; ?>
</script>





</body>


</html>

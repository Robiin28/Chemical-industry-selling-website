<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.0/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Additional CSS for adjusting form controls */
        .mb-3 {
            margin-bottom: 1.5rem;
        }

        .text-end {
            text-align: right;
        }
        .navbar-brand {
      animation: moveLeftAndRight 3s linear infinite alternate; /* Adjust duration and other properties as needed */
    }
  
    @keyframes moveLeftAndRight {
      0% {
        transform: translateX(0);
      }
      100% {
        transform: translateX(20px); /* Adjust the distance the image moves */
      }
    }
  
    .navbar-nav .nav-link {
      transition: color 0.3s ease; /* Add color transition */
    }
  
    .navbar-nav .nav-link:hover {
      color: #007bff;
    }
  
    @media (min-width: 992px) {
      .navbar-nav {
        margin-left: auto;
      }
  
      .navbar-nav .nav-item {
        margin-left: 15px;
      }
  
      .navbar-nav .nav-item:hover {
        font-weight: bold;
        font-size: 1.1rem;
      }
    }
  
    @media (max-width: 991px) {
      .navbar-collapse {
        justify-content: flex-end;
      }
  
      .navbar-nav .nav-item {
        margin: 0;
      }
  
      .navbar-toggler {
        margin-right: 15px;
      }
  
      .navbar-collapse {
        transition: all 0.3s ease;
        transform-origin: top right;
      }
  
      .navbar-toggler:hover {
        background-color: #007bff;
      }
  
      .navbar-toggler.collapsed:hover {
        background-color: transparent;
      }
  
      .navbar-collapse.collapsing {
        max-height: 200px; /* Set a maximum height for animation */
      }
  
      .navbar-collapse.show {
        animation: slideInRight 0.3s ease;
      }
  
      @keyframes slideInRight {
        from {
          transform: translateX(100%);
        }
        to {
          transform: translateX(0);
        }
      }
  
      .navbar-nav .nav-item:hover {
        font-weight: bold;
        font-size: 1.1rem;
      }
    }
    .bogn{
  background-color: rgb(227, 230, 233);
  
    }
  
    @media (max-width: 767px) {
      div.gallery img {
        width: 100%;
        margin-bottom: 20px;
      }
    }
    @media (max-width: 991px) {
      div.gallery img {
        display: none;
      }
    }
    .paragraph-box {
      border: 2px solid #007bff;
      padding: 20px;
      border-radius: 10px;
      margin-top: 20px;
    }
    .paragraph-entrance {
      animation: slideInFromRight 1s ease-out;
  }
  
  @keyframes slideInFromRight {
      0% {
          opacity: 0;
          transform: translateX(50px);
      }
      100% {
          opacity: 1;
          transform: translateX(0);
      }
  }
    </style>
</head>

<body>
    <?php
    include('../config/constant.php');

    // Initialize session
    session_start();

    // Define a function to sanitize and validate form inputs
    function sanitizeInput($input)
    {
        // Use appropriate sanitization and validation functions based on your requirements
        $sanitizedInput = trim($input); // Basic sanitization (remove extra spaces)
        $sanitizedInput = htmlspecialchars($sanitizedInput); // Convert special characters to HTML entities
        // You may add more sanitization or validation as needed
        return $sanitizedInput;
    }

    // Initialize billingInfo array
    $billingInfo = array();

    // Check if billingInfo is set in the session
    if (isset($_SESSION['billingInfo'])) {
        $billingInfo = $_SESSION['billingInfo'];
    }

    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Sanitize and validate each form input
        $billingInfo['companyName'] = sanitizeInput($_POST['companyName']);
        $billingInfo['tin'] = sanitizeInput($_POST['tin']);
        $billingInfo['title'] = sanitizeInput($_POST['title']);
        $billingInfo['firstName'] = sanitizeInput($_POST['firstName']);
        $billingInfo['lastName'] = sanitizeInput($_POST['lastName']);
        $billingInfo['address1'] = sanitizeInput($_POST['address1']);
        $billingInfo['city'] = sanitizeInput($_POST['city']);
        $billingInfo['country'] = sanitizeInput($_POST['country']);
        $billingInfo['state'] = sanitizeInput($_POST['state']);
        $billingInfo['email'] = sanitizeInput($_POST['email']);
        $billingInfo['phone'] = sanitizeInput($_POST['phone']);

        // Store billing information in the session
        $_SESSION['billingInfo'] = $billingInfo;

        // Redirect to cart.php
        header("Location: " . SITEURL . "screen/cart.php");
        exit();
    }
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-xxl">
      <img class="navbar-brand" src="../assets/ASAL-IMPEX-WEBSITE-LOGO-4.jpg" alt="logo " width="50" height="50">
      
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <!-- nav-->
      <div class="collapse navbar-collapse justify-content-end align-center" id="main-nav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo SITEURL; ?>">HOME</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo SITEURL; ?>screen/about_us.php">ABOUT US</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo SITEURL; ?>screen/home-product.php">PRODUCTS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo SITEURL; ?>screen/e_store.php">SHOP</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo SITEURL; ?>screen/contact_us.php">CONTACT US</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<div class="container-fluid bg-dark mb-5 p-5">
        <div class="fw-bold display-5 text-center text-white">
            Billing detail
        </div>
</div>
<div class="container">
        <p class="display-4 fw-bold text-center">Your account detail</p>
        <p class="lead fw-bold text-center">Add/Edit Billing Info</p>
      
        <div class="text-end">
        <a href="<?php echo SITEURL; ?>screen/cart.php" class="btn btn-lg btn-outline-info ms-5  ps-5 pe-5 pb-2 pt-2">Go to Cart</a>

        </div>  
     


            
    </div>

  
    <div class="container m-5 me-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="mb-3">
                        <label for="companyName" class="fw-bold">Company Name*</label>
                        <input type="text" class="ms-3 form-control" id="companyName" name="companyName"
                            value="<?php echo isset($billingInfo['companyName']) ? $billingInfo['companyName'] : ''; ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="tin" class="fw-bold">TIN No*</label>
                        <input type="text" class="ms-3 form-control" id="tin" name="tin"
                            value="<?php echo isset($billingInfo['tin']) ? $billingInfo['tin'] : ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="fw-bold">Title</label>
                        <select class="form-control ms-3" id="title" name="title">
                            <option value="" selected disabled>-- Select --</option>
                            <option value="Mr" <?php if (isset($billingInfo['title']) && $billingInfo['title'] == 'Mr') echo 'selected'; ?>>Mr</option>
                            <option value="Mrs" <?php if (isset($billingInfo['title']) && $billingInfo['title'] == 'Mrs') echo 'selected'; ?>>Mrs</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="firstName" class="fw-bold">First Name *</label>
                        <input type="text" class="form-control ms-3" id="firstName" name="firstName"
                            value="<?php echo isset($billingInfo['firstName']) ? $billingInfo['firstName'] : ''; ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="lastName" class="fw-bold">Last Name *</label>
                        <input type="text" class="form-control ms-3" id="lastName" name="lastName"
                            value="<?php echo isset($billingInfo['lastName']) ? $billingInfo['lastName'] : ''; ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="address1" class="fw-bold">Address*</label>
                        <input type="text" class="form-control ms-3" id="address1" name="address1"
                            value="<?php echo isset($billingInfo['address1']) ? $billingInfo['address1'] : ''; ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="city" class="fw-bold">City *</label>
                        <input type="text" class="form-control ms-3" id="city" name="city"
                            value="<?php echo isset($billingInfo['city']) ? $billingInfo['city'] : ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="country" class="fw-bold">Country *</label>
                        <select class="form-control ms-3" id="country" name="country" required>
                            <option value="" selected disabled>-- Select --</option>
                            <optgroup label="Country">
                                <option value="Ethiopia" <?php if (isset($billingInfo['country']) && $billingInfo['country'] == 'Ethiopia') echo 'selected'; ?>>Ethiopia</option>
                                <option value="United States" <?php if (isset($billingInfo['country']) && $billingInfo['country'] == 'United States') echo 'selected'; ?>>United States</option>
                                <!-- Add more options as needed -->
                            </optgroup>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="state" class="fw-bold">State / Province / Region *</label>
                        <select class="form-control ms-3" id="state" name="state"
                            <?php echo isset($billingInfo['country']) ? '' : 'disabled'; ?> required>
                            <option value="" selected disabled>-- Select --</option>
                            <?php
                            if (isset($billingInfo['country']) && isset($stateOptions[$billingInfo['country']])) {
                                foreach ($stateOptions[$billingInfo['country']] as $state) {
                                    echo '<option value="' . $state . '" ' . ((isset($billingInfo['state']) && $billingInfo['state'] == $state) ? 'selected' : '') . '>' . $state . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="fw-bold">E-Mail *</label>
                        <input type="email" class="form-control ms-3" id="email" name="email"
                            value="<?php echo isset($billingInfo['email']) ? $billingInfo['email'] : ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label fw-bold">Phone *</label>
                        <input type="tel" class="form-control ms-3" id="phone" name="phone"
                            value="<?php echo isset($billingInfo['phone']) ? $billingInfo['phone'] : ''; ?>" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-outline-success"> Save</button>
                        <a href="<?php echo SITEURL; ?>screen/cart.php" class="btn btn-outline-danger ms-5">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            // Define a mapping of countries to their respective states
            var stateOptions = {
                Ethiopia: ["Addis Ababa", "Dire Dawa", "Gondar", "Bahir Dar"],
                "United States": ["New York", "California", "Texas", "Florida"]
                // Add more countries and their states as needed
            };

            // Country dropdown change event
            $('#country').on('change', function () {
                var selectedCountry = $(this).val();
                var stateDropdown = $('#state');

                // Clear previous options
                stateDropdown.empty();

                // Add an empty option for the user to select a state
                stateDropdown.append($('<option>', {
                    value: "",
                    text: "-- Select --",
                    disabled: true,
                    selected: true
                }));

                // Populate states based on the selected country
                if (stateOptions[selectedCountry]) {
                    // Add an optgroup with the country name
                    stateDropdown.append($('<optgroup>', {
                        label: selectedCountry
                    }));

                    stateOptions[selectedCountry].forEach(function (state) {
                        // Append each state under the optgroup
                        stateDropdown.children('optgroup').append($('<option>', {
                            value: state,
                            text: state
                        }));
                    });

                    stateDropdown.prop('disabled', false); // Enable state dropdown
                } else {
                    stateDropdown.prop('disabled', true); // Disable state dropdown if no states available
                }
            });
        });
    </script>


<?php  

include('../partials/footer.php');

?>
</body>

</html>

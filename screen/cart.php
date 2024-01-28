
<?php
include('../config/constant.php');
session_start();




$sessionTimeout = 500;
if (!isset($_SESSION['start_time'])) {
    $_SESSION['start_time'] = time();
} else {
    $elapsedTime = time() - $_SESSION['start_time'];
    if ($elapsedTime > $sessionTimeout) {
        $_SESSION = array();
        session_destroy();
        session_start();
        $_SESSION['start_time'] = time();
    }}

function calculateTotalPrice($cart) {
    $totalPrice = 0;
    foreach ($cart as $chemical) {
        $totalPrice += ($chemical['price'] * $chemical['quantity']);
    }return $totalPrice;}
    $sessionTimeout = 300;
 function sanitizeInput($input) {
    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
}
if (isset($_POST['submit'])) {
    if (isset($_SESSION['billingInfo'])) {
             $billingInfo = $_SESSION['billingInfo'];
             $companyName = $billingInfo['companyName'];
             $tin = $billingInfo['tin'];
             $title = $billingInfo['title'];
             $firstName = $billingInfo['firstName'];
             $lastName = $billingInfo['lastName'];
             $address1 = $billingInfo['address1'];
             $city = $billingInfo['city'];
             $country = $billingInfo['country'];
             $state = $billingInfo['state'];
             $email = $billingInfo['email'];
             $phone = $billingInfo['phone'];
         } else {
             header('Location: ' . SITEURL . 'screen/billing.php');
             exit();
         }
     $sameAsBilling = isset($_POST['sameAsBilling']) && $_POST['sameAsBilling'] == 'on';
     $shippingId = 0;
         if (!$sameAsBilling) {
             if (isset($_SESSION['shippingInfo'])) {
            // Assign the shippingInfo to $shippingInfo variable
            $shippingInfo = $_SESSION['shippingInfo'];
            $address_nick = $shippingInfo['address_nick'];
            $companyName = $shippingInfo['companyName'];
            $title = $shippingInfo['title'];
            $firstName = $shippingInfo['firstName'];
            $lastName = $shippingInfo['lastName'];
            $address1 = $shippingInfo['address1'];
            $city = $shippingInfo['city'];
            $country = $shippingInfo['country'];
            $state = $shippingInfo['state'];
            $email = $shippingInfo['email'];
            $phone = $shippingInfo['phone'];


            $shippingInfo = $_SESSION['shippingInfo'];

            $sql = "INSERT INTO shipping_tbl (address_nick, company_name, title, first_name, last_name, address1, city, country, state, email, phone)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssssssssss', $shippingInfo['address_nick'],
              $shippingInfo['companyName'], $shippingInfo['title'], $shippingInfo['firstName'],
              $shippingInfo['lastName'], $shippingInfo['address1'], $shippingInfo['city'],
              $shippingInfo['country'], $shippingInfo['state'], $shippingInfo['email'], $shippingInfo['phone']);
            $stmt->execute();
            $shippingId = $stmt->insert_id;
            unset($_SESSION['shipping_info']);
            }
            else{
                header('Location: ' . SITEURL . 'screen/shipping.php');
                exit();
            }
        }
            else {
                // If sameAsBilling is checked, use billingInfo for shippingInfo
                $_SESSION['shippingInfo'] = $_SESSION['billingInfo'];
            }
            $billingInfo = $_SESSION['billingInfo'];

            $sql = "INSERT INTO billing_tbl (company_name, tin, title, first_name, last_name, address1, city, country, state, email, phone)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssssssss', $billingInfo['companyName'],
             $billingInfo['tin'], $billingInfo['title'], $billingInfo['firstName'], 
             $billingInfo['lastName'], $billingInfo['address1'], $billingInfo['city'], 
             $billingInfo['country'], $billingInfo['state'], $billingInfo['email'], $billingInfo['phone']);
             $stmt->execute();

        $billingId = $stmt->insert_id;
        unset($_SESSION['billing_info']);
        $orderInfo = [
            'billing_id' => $billingId,
            'shipping_id' => $shippingId,
            'total_price' => calculateTotalPrice($_SESSION['cart']),
            'shipment_option' => isset($_POST['shipment']) ? $_POST['shipment'] : null,
            'payment_option' => isset($_POST['payment']) ? $_POST['payment'] : null,
            'note' => generateOrderNote($_SESSION['cart']),
            'request' => isset($_POST['request']) ? $_POST['request'] : null,

        ];
        
        $sql4 = "INSERT INTO order_tbl (billing_id, shipping_id, total_price, shipment_option, payment_option, note,request)
                VALUES (?,?,?,?,?,?,?)";
        
        $stmt = $conn->prepare($sql4);
        $stmt->bind_param('iisssss', $orderInfo['billing_id'],
            $orderInfo['shipping_id'], $orderInfo['total_price'], $orderInfo['shipment_option'],
            $orderInfo['payment_option'], $orderInfo['note'], $orderInfo['request']);
        $stmt->execute();

header('Location: ' . SITEURL . 'screen/clear_cart.php');
exit();   
}

if (isset($_GET['id']) && isset($_GET['quantity'])) {
    $id = $_GET['id'];
    $quantity = $_GET['quantity'];
    $sql = "SELECT * FROM chemical_tbl WHERE id = '$id' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $chemical = mysqli_fetch_assoc($result);
        $vat = $chemical['price'] * 0.15;
        $_SESSION['cart'][] = [
            'id' => $chemical['id'],
            'cname' => $chemical['cname'],
            'ptype' => $chemical['ptype'],
            'price' => $chemical['price'],
            'vat' => $vat,
            'image' => $chemical['image'],
            'quantity' => $quantity,
        ];
        header('Location: ' . SITEURL . 'screen/cart.php');
        exit();
    }
}if (isset($_GET['key'])) {
    $key = $_GET['key'];
    if (isset($_SESSION['cart'][$key])) {
        unset($_SESSION['cart'][$key]); }
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
    exit();
}
if (isset($_GET['updateKey']) && isset($_GET['quantity'])) {
    $updateKey = $_GET['updateKey'];
    $newQuantity = $_GET['quantity'];
    if (isset($_SESSION['cart'][$updateKey])) {
        $_SESSION['cart'][$updateKey]['quantity'] = $newQuantity;
    }
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
    exit();
}
function generateOrderNote($cart) {
    $note = '';
    foreach ($cart as $chemical) {
        $note .= 'Chemical Name: ' . $chemical['cname'] . '(' . $chemical['id'] . ')......Product Type: ' . getProductDisplayName($chemical['ptype']) . ' ..... Number of Quantity ordered:... ' . $chemical['quantity'] . "\n";
    }
    return $note;
}

function getProductDisplayName($productId) {
    global $conn;

    $sqlProductName = "SELECT pname FROM product_tbl WHERE id = '$productId' LIMIT 1";
    $resultProductName = mysqli_query($conn, $sqlProductName);

    if ($resultProductName && mysqli_num_rows($resultProductName) > 0) {
        $productNameInfo = mysqli_fetch_assoc($resultProductName);
        return $productNameInfo['pname'];
    } else {
        return '';
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Shopping Cart</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .chemical-details img {
            max-width: 50px;
            max-height: 50px;
            margin-right: 10px;
        }

        .delete-icon {
            color: red;
            cursor: pointer;
        }

        .trash-icon,
        .refresh-icon {
            color: #dc3545;
            cursor: pointer;
            margin-left: 5px;
        }

        .quantity-input {
            width: 40px;
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
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="container-fluid bg-dark mb-5 p-5">
        <div class="fw-bold display-5 text-center text-white">
            Shopping Cart
        </div>
    </div>
<div class="container text-end">

<p class="lead mt-5"> Click thee button to add item to cart</p>

<a class="text-center btn btn-lg btn-outline-danger me-5 mb-5" href="<?php echo SITEURL; ?>screen/e_store.php">Continue shopping</a>
</div>


    <div class="container mt-1">
        <div class="row">
            <div class="col-6">
                <p><i class="fas fa-file-invoice"></i> Billing Info </p>
                <a href="<?php echo isset($_SESSION['billingInfo']) ? SITEURL . 'screen/billing.php?edit=1' : SITEURL . 'screen/billing.php'; ?>" class="btn btn-outline-info"> Add/Edit Billing Info</a>
            </div>
            <div class="col-6">
                <p><i class="fas fa-shipping-fast"></i> Shipping Details </p>



<input class="form-check-input ms-1" type="checkbox" id="Check2" name="sameAsBilling">
<label class="form-check-label" for="Check2">Same as billing address</label>



                <br>
                <a href="<?php echo isset($_SESSION['shippingInfo']) ? SITEURL . 'screen/shipping.php?edit=1' : SITEURL . 'screen/shipping.php'; ?>" class="btn btn-outline-info"> Add/Edit Shipping Info</a>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <?php if (!empty($_SESSION['cart'])) : ?>
        
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Chemical Details</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price with tax</th>
                        <th scope="col">VAT (15%)</th>
                        <th scope="col">Price without tax</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $key => $chemical) : ?>
                        <tr>
                            <td>
                                <div class="chemical-details">
                                    <img src="<?php echo SITEURL . 'assets/chemical/' . $chemical['image']; ?>" alt="Chemical Image">
                                    <span><?php echo $chemical['cname'] . ' (' . $chemical['id'] . ')'; ?></span>
                                </div>
                            </td>
                            <?php
                            // Fetch pname based on id from product_tbl
                            $productId = $chemical['ptype'];
                            $sqlProductName = "SELECT pname FROM product_tbl WHERE id = '$productId' LIMIT 1";
                            $resultProductName = mysqli_query($conn, $sqlProductName);

                            if ($resultProductName && mysqli_num_rows($resultProductName) > 0) {
                                $productNameInfo = mysqli_fetch_assoc($resultProductName);
                                echo '<td>' . $productNameInfo['pname'] . '</td>';
                            } else {
                                echo '<td>' . $chemical['ptype'] . '</td>';
                            }
                            ?>
                            <td><?php echo $chemical['price']; ?></td>
                            <td><?php echo $chemical['vat']; ?></td>
                            <td><?php echo $chemical['price'] - $chemical['vat']; ?></td>
                            <td>
                                <input type="number" id="quantity_<?php echo $key; ?>" class="quantity-input" value="<?php echo $chemical['quantity']; ?>">
                                <span class="delete-icon" onclick="removeItem(<?php echo $key; ?>)">🗑</span>
                                <span class="refresh-icon" onclick="refreshQuantity(<?php echo $key; ?>)">🔄</span>
                            </td>
                            <td><?php echo $chemical['price'] * $chemical['quantity']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="4" class="text-start">
                            <strong>Select Shipment</strong>
                            <br><br>
                            <div class="form-check form-check-inline ms-5">
                                <input class="form-check-input" type="radio" name="shipment" id="selfPickup" value="Self-pick up from source" required>
                                <label class="form-check-label" for="selfPickup">Self-pick up from source</label>
                            </div>
                            <br>
                            <div class="form-check form-check-inline ms-5">
                                <input class="form-check-input" type="radio" name="shipment" id="delivery" value="delivery"  required>
                                <label class="form-check-label" for="delivery">Or need delivery</label>
                            </div>
                            <p class="small text-primary">You will be charged an additional fee for delivery.</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-start">
                            <strong>Select Payment</strong>
                            <br><br>
                            <div class="form-check form-check-inline ms-5">
                                <input class="form-check-input" type="radio" name="payment" id="cash" value="cash" required>
                                <label class="form-check-label" for="selfPickup" >Cash on delivery</label>
                            </div>
                            <br>
                            <div class="form-check form-check-inline ms-5">
                                <input class="form-check-input" type="radio" name="payment" id="bank" value="bank" required>
                                <label class="form-check-label" for="delivery">Bank transfer</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-end"><strong>Total Price:</strong></td>
                        <td id="totalPrice"><?php echo calculateTotalPrice($_SESSION['cart']); ?></td>
                    </tr>
                </tbody>
            </table>
            <div>
                <p class="lead">Note and special request</p>
            </div>
            <div class="row">
                <div class="col-12">
                    <textarea class="form-control" name="request" id="" cols="1" rows="1"></textarea></div></div>
            <div class="form-check mt-2 custom-checkbox">
                <label class="form-check-label lead fw-bold ms-3" for="Check1">Terms of service</label><br>
                <span>
                    <i class="fas fa-file-alt ms-4" style="color: dimgray;" onclick="showInfo()"></i>
                    <a href="#" class="text-decoration-none ms-2" onclick="showInfo()"> Click here to read terms of service <b class="text-danger"> Make sure you read it </b></a>
                </span></div>
            <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document"> <div class="modal-content">
                        <div class=" text-end mt-2 me-2"><button type="button" class="close text-end" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
                        <div class="modal-body" id="infoModalBody"></div></div></div></div>
            <div class="text-end p-5 "><input type="submit" name="submit" style="background-color:darkblue;" class='btn btn-lg text-white' value="Check out now">  </div>
        <?php else : ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>
</form>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
    function updateQuantity(key, newQuantity) {
        var currentQuantity = <?php echo $_SESSION['cart'][$key]['quantity']; ?>;
        if (newQuantity == 0) {removeItem(key);
            return;
        }if (newQuantity != currentQuantity) {
            fetch('<?php echo SITEURL . 'screen/cart.php'; ?>?updateKey=' + key + '&quantity=' + newQuantity)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else {console.error(data.error);}}).catch(error => {
                    console.error('Error:', error);
                });}}
                function removeItem(key) {
        fetch('<?php echo SITEURL . 'screen/cart.php'; ?>?key=' + key)
            .then(response => response.json())
            .then(data => {if (data.success) {
                    window.location.reload();
                } else {console.error(data.error);
                }}) .catch(error => {
                console.error('Error:', error);
            });}
            function refreshQuantity(key) {
        var newQuantity = document.getElementById('quantity_' + key).value;
        fetch('<?php echo SITEURL . 'screen/cart.php'; ?>?updateKey=' + key + '&quantity=' + newQuantity)
            .then(response => response.json())
            .then(data => { if (data.success) {
                    window.location.reload();
                } else {
                    console.error(data.error);
                }}).catch(error => {
                console.error('Error:', error);
            });}
            function showInfo() {
            var modalBody = document.getElementById('infoModalBody');
            modalBody.innerHTML = `
                <p class="text-center text-danger fw-bold lead"><b>Terms of service</b></p>
                <p><strong>NOTE:</strong> This Check Out is not binding and does not initiate a payment for now.</p>
                <p>The Asal Impex sales department will receive your purchase order and subsequently contact you to establish the details of your payment conditions.</p> `;
            $('#infoModal').modal('show');
         }


    function sanitizeInput(input) {
        return input.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    }

</script>
<?php  

include('../partials/footer.php');

?>
</body></html>

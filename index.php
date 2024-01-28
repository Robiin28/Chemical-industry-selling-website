
<?php

include('./config/constant.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>ASAX CHEMICALS INDUSTRY</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>

<style>
  section {
    position: relative;
    background-image: url("assets/bagpic.jpg");
    background-size: cover;
    background-position: center;
    color: white;
    padding: 60px 0; /* Adjust padding as needed */
    overflow: hidden; /* Prevent text blur */
    background-attachment: fixed; /* Fixed background image */
}

.footer {
        background-color:rgba(0, 0, 57, 1);
        color: white;
        width: 100%;
        text-align: center;
        padding: 10px;
        margin-top: auto; /* Push the footer to the bottom */
    }

  section::before {
   
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 30, 0.5); /* Dark blue overlay with 50% opacity */
    z-index: -1; /* Place the overlay behind the content */
  }
  
  div.gallery img {
    margin-left: 50px;
    border-radius: 50%;
    animation: glow 2s infinite alternate, scale 2s infinite alternate;
    transition: transform 0.3s ease-in-out;
  }
  div.gallery img2 {
    margin-left: 100px;
    border-radius: 50%;
    animation: glow 2s infinite alternate, scale 2s infinite alternate;
    transition: transform 0.3s ease-in-out;
  }
  .imgn {
        transition: transform 0.3s ease-in-out;
    }

    .imgn:hover {
        transform: scale(1.1);
    }
  @keyframes glow {
    0% {
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.8);
    }
    100% {
      box-shadow: 0 0 20px rgba(0, 123, 255, 1);
    }
  }

  @keyframes scale {
    0% {
      transform: scale(1);
    }
    100% {
      transform: scale(1.1);
    }
  }

  .navbar-brand {
    animation: moveLeftAndRight 3s linear infinite alternate;
  }

  @keyframes moveLeftAndRight {
    0% {
      transform: translateX(0);
    }
    100% {
      transform: translateX(20px); 
    }
  }

  .navbar-nav .nav-link {
    transition: color 0.3s ease;
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
      max-height: 200px;
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

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-xxl">
    <img class="navbar-brand" src="assets/ASAL-IMPEX-WEBSITE-LOGO-4.jpg" alt="logo " width="50" height="50">
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
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

<section id="intro">
  <div class="container">
    <div class="row">
      <div class="col-md-8 text-center text-md-start">
        <h1>
          <div class="class display-3"> WELCOME TO ASAL IMPEX TRADING</div>
          <div class="display-4">  Are you looking for a reliable bulk and semi-bulk chemical supplier?</div>
        </h1>
        <div class="paragraph-box">
          <p class="lead my-4  text-start  paragraph-entrance">
            Look no further than Asal Impex Trading. Our high-quality chemicals distribution is backed by a proven track record of success and customer satisfaction. 
            We offer a wide range of chemicals in various grades, including ACS, reagent, USP, and NF grades, all of which are sourced from reputable manufacturers 
            and undergo strict quality control measures to ensure purity and potency. Our extensive product offerings and expertise make us the preferred choice for 
            both technical and laboratory-grade chemicals. Asals Impex Trading mission is to address the market gap in the industrial chemicals and raw materials supply 
            with a provision of high quality, safe and up to the standard products/services. We are always working and improving to achieve our goal of becoming a reliable 
            chemicals hub for major industries in Africa.
          </p>
        </div>
        <br><br>
        <a href="<?php echo SITEURL; ?>screen/e_store.php" class="btn btn-outline-primary  btn-lg  justify-content-center">Order now</a>
      </div>

      <div class="col-md-4 ">
        <div class="gallery ps-5">
          <img class="img" src="assets/ASAL-IMPEX-Manager.jpg" alt="image1" width="180" height="180">
          <img class="img ms-1" src="assets/ASAL-IMPEX-BG-4.jpg" alt="image2" width="150" height="150">
          <br><br><br>
          <img class="img2 ms-5 text-start" src="assets/Glass-Beads.jpg" alt="image3" width="250" height="250">
          <br><br>
          <img class="img2 ms-5 text-center" src="assets/Polyaluminium-Chloride.jpg" alt="image4" width="300" height="300">
        </div>
      </div>
      
    </div>
     <div class="container">

      <div>
        <div class="class display-3 text-center"> OUR CHEMICALS </div>

<p class="text-center">  High Quality products  </p>
  
 <p class="lead my-4 text-center">Our company import and distribute high quality chemicals for different proposes to use. Bundled with superior
  customer service through its team of highly skilled professionals. </p> 

      </div>


     </div>
  </div>
  <div class="container">
 
  <div class="row ">
    <?php
        $sql = "SELECT*FROM product_tbl";
        $res = mysqli_query($conn, $sql);
        if ($res == TRUE) {
            $count = mysqli_num_rows($res); 
            if ($count > 0) {
                while ($rows = mysqli_fetch_assoc($res)) {
                    $id = $rows['id'];
                    $pname = $rows['pname'];
                    $pdesc = $rows['pdsc'];
                    $image = $rows['image'];
        ?>



<div class="col-lg-4 col-md-8">
                <div class="p-5 bg-outline-primary text-light rounded border text-center">
                  <div class="class display-5   text-center "> <?php echo $pname; ?> </div>
                  <br>
                  <?php
                   if ($image != "") {
                    ?>
                    <p class=" text-start">
                    <img class=" rounded me-3 img-fluid" src="<?php echo SITEURL; ?>assets/products/<?php echo $image; ?>" alt="imagen" width="400" height="300">

                    </p>
                  
                
                 <?php
                } 
                else {
                 echo "<div class='text-danger'>Image not added.</div>";
                      }
                  ?>
                  <br><br><br>
                <?php 
                   $sql2 = "SELECT cname FROM chemical_tbl WHERE  active='YES' AND ptype='$id'   LIMIT 6";
$result = mysqli_query($conn, $sql2);
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        echo '<ul class="ms-3">';
        while ($row2 = mysqli_fetch_assoc($result)) {
            echo '<li>' . $row2['cname'] . '</li>';
        }
        echo '</ul>';
    } else {
        echo 'No chemicals found for the given ptype.';
    }
} else {
    echo 'Error in the query: ' . mysqli_error($conn);
}
?>
  
  <a href="<?php echo SITEURL; ?>screen/e_store2.php?id=<?php echo $id; ?>&pname=<?php echo $pname; ?>" class="btn btn-outline-primary  btn-lg  text-center" >  BUY NOW</a>

                 </div>
            </div>
        <?php
                }
            }
         }
        ?>

          
           </div>
<br><br><br>
<div class="container">
  <div class="row">
    <div class="col-lg-6   text-center text-md-start  col-md-12">
      <h1>
      
        <div class="display-5 text-center"> <b> WHO WE ARE?    </b></div>
      </h1>
      
        <p class="lead my-4  text-start   paragraph-entrance">
          Asal Impex Trading is a sister company of Raw-Net Business Enterprise Plc.
           This company established in 2014 with the aim of bringing the utmost satisfaction
            to the consumer and also its partners by serving with quality products and reliable service.
          Raw-Net Business export mainly molasses, pulses, fruits and mineral.
           The company also imports industrial chemicals, raw materials, vehicles, tire, stationary materials and tiles.

        <br><br>
          We managed to grow at fastest rate and able to register more than USD 20,000,000 net worth in nine years’ 
          time with our 35 employees working at our three offices in Ethiopia, Kenya and Republic of Djibouti. Continuing our
           moves towards new sectors we are now engaged in the cross boarder transport and establishing an edible oil factory 
           at the eastern part of the country that is expected to be operational in a year time.
        </p>
      <br><br>
      <a href="<?php echo SITEURL; ?>screen/home-product.php"  class="btn btn-outline-primary  btn-lg  justify-content-center">look our products </a>
    </div>

    <div class="col-lg-6 col-md-12">
    <br><br>
        <img class=" img-fluid shadow-lg mt-4 " src="./assets/ASAL-IMPEX-MEETING-ROOM.jpg" alt="image1" width="500" height="400">
        
      
    </div>
    
  </div>
</div> 

</section>

<style>
    body {
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        min-height: 100vh; /* Set minimum height to full viewport height */
    }
    
    .footer {
        background-color: black;
        color: white;
        width: 100%;
        text-align: center;
        padding: 10px;
        margin-top: auto; /* Push the footer to the bottom */
    }
    </style>
    
    <footer class="footer mb-0">
        <div class="container-fluid ">
          <div class="container">
<div class="row justify-content-center text-light">

<div class="col-lg-7 col-sm-9">

<p class="lead  ms-0 mt-5 mb-5 text-start">
    <strong class="text-center display-5 text-white">
    <a  href="<?php echo SITEURL; ?>screen/e_store.php" class="text-decoration-none ">    WORK WITH US </a>   
  
    </strong>
    <br>
    Partner with us today to improve your production output and elevate your product quality.
     We distinguish our self with fast and reliable service provider for a wide variety of markets.
    
    We work businesses with high quality bulk chemical suppliers, both domestically and internationally.
     Contact us today to learn more about our products and services and how we can help take your business to the next level.



</p>
</div>
<div class="col-lg-5 col-sm-8 ">
<img src="./assets/ASAL-IMPEX-Manager.jpg" class="img-fluid shadow-lg mt-5 mb-5" alt="">
</div>
<div class="col-lg-3 col-sm-12 text-start mt-2 ms-2">
<i class="fas fa-home fa "></i><b>  GET IN TOUCH</b><br>
  
    HEAD OFFICE: 
    <br>
    Bole 24 Sub-City, Behind Nyala Motors Addis Ababa, Ethiopia.

</div>
<div class="col-lg-3 col-sm-12 text-start mb-5 mt-2">

<i class="fas fa-phone me-4 fw-bold"></i> <b>    PHONES:</b><br>


    <span class="text-info ">

        +251 911 242327
        <br>
        +251 662 05265
        <br>
        +251 915 050801

    </span>
   
  
</div>

<div class="col-lg-3 col-sm-12 text-start mt-2">
  <p class="lead">
  <i class="fw-bold far fa-envelope me-4"></i> <b>

    EMAIL:
   </b><br>
 <span class="text-info ">
    rownet.op@gmail.com
    <br>
    sales@asalchemicals.com

</span>
  
  </p>

</div>
<div class="col-lg-2 col-sm-2 text-start mt-2">
<i class="fas fa-globe fw-bold me-4"></i> 
<a href="www.asalchemicals.com" class="text-decoration-none text-white">   www.asalchemicals.com</a>


</div>
<div class="col-12 border-top text-start mt-5">

<p class="mt-3">© 2023 ASAL IMPEX TRADING. All Rights Reserved. Design By RHO  Phone: +251 964485489</p>


</div>



</div>
          </div>
        </div>
    </footer>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</html>

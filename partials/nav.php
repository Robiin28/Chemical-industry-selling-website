
<style>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

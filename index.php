<?php
session_start();
if(!isset($_SESSION["CONFIG_SETUP"])){
 include_once("./config.php");
 // then set the config_setup as true
 $_SESSION["CONFIG_SETUP"] = 1;
}

if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $user_id = $_SESSION['user_id'];
    session_write_close();
} else {
    session_unset();
    session_write_close();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- font-awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
    />
    <!-- bootstrap 5 -->    

    <!-- styles css -->
    <link rel="stylesheet" href="styles.css" />
    <title>Home | eCycles</title>
  </head>
  <body>
    <!-- navbar -->
    <nav class="my-navbar">
      <div class="nav-center">
        <!-- links -->
        <div>
          <button class="toggle-nav">
            <i class="fas fa-bars"></i>
          </button>
          <ul class="my-nav-links">
            <li>
              <a href="index.php" class="nav-link-items"> home </a>
            </li>
            <li>
              <a href="shop.php" class="nav-link-items"> shop </a>
            </li>
            <li>
              <a href="about.php" class="nav-link-items"> about </a>
            </li>
            <li>
              <a href="contact.php" class="nav-link-items"> contact </a>
            </li>
            <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] == true):?>
              <li>
              <a href="admin" class="nav-link-items"> admin </a>
            </li>
            <?php endif?>
          </ul>
        </div>
        <!-- logo -->
        <p class="nav-logo2">eCycles</p>
      </div>
      <!-- login button -->
      <?php if(isset($username)):?>
        <p class="login-btn" style="margin-top: 1.3rem;"><?= $username?>
        </p>
          <a href="logout.php" class="login-btn">logout</a>   
        <?php else:?>
          '<a href="login.php" class="login-btn"
        >login   </a>'      
        <?php
          endif        
        ?>
        <!-- <form action="logout.php" method="post">
          <button type = 'submit' class="login-btn">logout</button>
        </form> -->

        <!-- <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          class="login-icon"
          stroke="currentColor"
          >
          <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
          />
        </svg> -->
   
      <!-- cart icon -->
      <div class="toggle-container">
        <button class="toggle-cart">
          <i class="fas fa-shopping-cart"></i>
        </button>
        <span class="cart-item-count">1</span>
      </div>
    </nav>

    <!-- hero -->
    <section class="hero">
      <div class="hero-container">
        <h1 class="text-slanted">rest, relax, unwind</h1>
        <h3>Get the bike of your choices - we provide</h3>
        <a href="shop.html" class="hero-btn"> shop now </a>
       
       <?php if(isset($_SESSION['username'])):?>
        <div></div>
        <?php else:?>
        <a
          href="signup.php"
          class="hero-primary-btn"
        >
          sign up
          <i class="fa fa-arrow-right" aria-hidden="true"></i>
        </a>
        <?php endif?>
      </div>
    </section>
    <!-- sidebar -->
    <div class="sidebar-overlay">
      <aside class="sidebar">
        <!-- close -->
        <button class="sidebar-close">
          <i class="fas fa-times"></i>
        </button>
        <!-- links -->
        <ul class="sidebar-links">
          <li>
            <a href="index.php" class="sidebar-link">
              <i class="fas fa-home fa-fw"></i>
              home
            </a>
          </li>
          <li>
            <a href="shop.php" class="sidebar-link">
              <i class="fas fa-couch fa-fw"></i>
              shop
            </a>
          </li>
          <li>
            <a href="about.php" class="sidebar-link">
              <i class="fas fa-book fa-fw"></i>
              about
            </a>
          </li>
          <li>
            <a href="contact.php" class="sidebar-link">
              <i class="fas fa-book fa-fw"></i>
              contact
            </a>
          </li>
        </ul>
      </aside>
    </div>

    <!-- cart -->
    <?php require 'cart.php'?>
    <!-- featured products -->
    <section class="section featured">
      <div class="title">
        <h2><span>/</span> featured</h2>
      </div>
      <div class="featured-center section-center">
        <h2 class="section-loading">loading...</h2>
        <!-- single product -->
        <!-- <article class="product">
          <div class="product-container">
            <img src="./images/main-bcg.jpeg" class="product-img img" alt="" />
           
            <div class="product-icons">
              <a href="product.html?id=1" class="product-icon">
                <i class="fas fa-search"></i>
              </a>
              <button class="product-cart-btn product-icon" data-id="1">
                <i class="fas fa-shopping-cart"></i>
              </button>
            </div>
          </div>
          <footer>
            <p class="product-name">name</p>
            <h4 class="product-email">$9.99</h4>
          </footer>
        </article> -->
        <!-- end of single product -->
      </div>
      <a href="shop.html" class="btn"> all products </a>
    </section>
    <section class="slider">
      <div class="reviews">
        <h2><span>/</span>reviews</h2>
      </div>
      <div class="slide-container">
        <!-- <article class="slide">
          <img
            src="https://res.cloudinary.com/diqqf3eq2/image/upload/c_scale,w_200/v1595959121/person-1_aufeoq.jpg"
            class="img"
            alt="peter doe"
          />
          <h4>peter doe</h4>
          <p class="text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem quo
            eius recusandae officia voluptas sint deserunt dicta nihil nam
            omnis?
          </p>
          <div class="quote-icon">
            <i class="fas fa-quote-right"></i>
          </div>
        </article> -->
      </div>
      <!-- buttons -->
      <!-- prev btn -->
      <button class="btn prev-btn">
        <i class="fas fa-chevron-left"></i>
      </button>
      <!-- next button -->
      <button class="btn next-btn">
        <i class="fas fa-chevron-right"></i>
      </button>
    </section>
    <section>
      <!-- modal -->
          <!-- 15% off modal -->
      <div class="modal fade offer" tabindex="-1" role="dialog" aria-labelledby="offer" aria-hidden="true" id='offer'>
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            get 15 % of for your first order
        </div>
      </div>        
    </section>
    <!-- bootstrapped js -->
    <!-- <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script> -->
    <!-- in project js -->

    <script type="module" src="index.js"></script>
    <script type="module" src="./src/makeOrder.js"></script>
    <script type="module" src="./src/offermodal.js"></script>
    <script type="module" src="./src/slider.js"></script>
  </body>
</html>

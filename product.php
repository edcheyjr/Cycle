<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Single Product</title>
    <!-- font-awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
    />

    <!-- styles css -->
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <!-- navbar -->
    <nav class="my-navbar page">
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
              <a href="shop.php" class="nav-link-items">shop </a>
            </li>
            <li>
              <a href="about.php" class="nav-link-items"> about </a>
            </li>
            <li>
              <a href="contact.php" class="nav-link-items"> contact </a>
            </li>
          </ul>
        </div>
        <!-- logo -->
        <p class="nav-logo2 black">eCycle</p>
        <!-- <img src="./images/logo-black.svg" class="nav-logo2" alt="logo" /> -->
        <!-- cart icon -->
        <div class="toggle-container">
          <button class="toggle-cart">
            <i class="fas fa-shopping-cart"></i>
          </button>
          <span class="cart-item-count">1</span>
        </div>
      </div>
    </nav>

    <!-- hero -->
    <section class="page-hero">
      <div class="section-center">
        <h3 class="page-hero-title">Home / Single Product</h3>
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
              <i class="fas fa-phone fa-fw"></i>
              contact
            </a>
          </li>
        </ul>
      </aside>
    </div>
    <!-- cart -->
    <?php require 'cart.php'?>
    </div>
    <!-- product info -->
    <section class="single-product">
      <div class="section-center single-product-center">
        <img
          src="./images/main-bcg.jpeg"
          class="single-product-img img"
          alt=""
        />
        <article class="single-product-info">
          <div>
            <h2 class="single-product-title">couch</h2>
            <p class="single-product-company text-slanted">by marcos</p>
            <p class="single-product-price">$30.00</p>
            <div class="single-product-colors"></div>
            <p class="single-product-desc">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id,
              modi? Minima libero doloremque necessitatibus! Praesentium
              recusandae quod nesciunt animi voluptatem!
            </p>
            <button class="addToCartBtn btn" data-id="id">add to cart</button>
          </div>
        </article>
      </div>
    </section>
    <div class="page-loading">
      <h2>loading...</h2>
    </div>
    <script type="module" src="./src/pages/singleProduct.js"></script>
    <script type="module" src="src/makeOrder.js"></script>

  </body>
</html>

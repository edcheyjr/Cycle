<?php
session_start();
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
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />

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
              <a href="shop.html" class="nav-link-items"> product </a>
            </li>
            <li>
              <a href="about.html" class="nav-link-items"> about </a>
            </li>
            <li>
              <a href="contact.html" class="nav-link-items"> contact </a>
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
      <?php if(isset($_SESSION["username"])):?>
        <p class="login-btn" style="margin-top: 1.3rem;"><?= $username?>
        </p>
          <a href="logout.php" class="login-btn">logout</a>   
        <?php else:?>
          '<a href="#" class="login-btn"
        data-bs-toggle="modal"
          data-bs-target="#loginModal"
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
        <a
          href="#"
          class="hero-primary-btn"
          data-bs-toggle="modal"
          data-bs-target="#signupModal"
        >
          sign up
          <i class="fa fa-arrow-right" aria-hidden="true"></i>
        </a>
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
            <a href="products.html" class="sidebar-link">
              <i class="fas fa-couch fa-fw"></i>
              products
            </a>
          </li>
          <li>
            <a href="about.html" class="sidebar-link">
              <i class="fas fa-book fa-fw"></i>
              about
            </a>
          </li>
          <li>
            <a href="contact.html" class="sidebar-link">
              <i class="fas fa-book fa-fw"></i>
              contact
            </a>
          </li>
        </ul>
      </aside>
    </div>

    <!-- cart -->
    <div class="cart-overlay">
      <aside class="cart">
        <button class="cart-close">
          <i class="fas fa-times"></i>
        </button>
        <header>
          <h3 class="text-slanted">your bag</h3>
        </header>
        <!-- cart items -->
        <div class="cart-items"></div>
        <!-- footer -->
        <footer>
          
          <h3 class="cart-total text-slanted">total : $12.99</h3>
          <!-- cart button to submit orders -->
          <?php if(isset($_SESSION['username'])):?>
          <form action="order.php" method="post" enctype="multipart/form-data" id ='order'>
          <p class="error-msg"></p>
          <p class="success-msg"></p>
          <input type="hidden" id="user_id" value="<?=$user_id?>">
          <button class="cart-checkout btn" type="submit">checkout</button>
        </form>
        <?php else:?>
        <button class="cart-checkout btn" data-bs-toggle="modal"
        data-bs-target="#loginModal" type="button">checkout</button>
        <?php endif?>
        </footer>
      </aside>
    </div>
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

      <!-- login modal -->
      <div
        class="modal fade"
        id="loginModal"
        tabindex="-1"
        aria-labelledby="login"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered ">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" id="modal-label" style="text-transform: none;">Welcome to eCycle, Login</h3>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body ">    
              <form
                  class="form"
                  action="login.php"
                  method="post"
                  enctype="multipart/form-data"
                >
              <?php if(isset($_SESSION['loginErr'])):?>
                  <p class="error-msg"><?= $_SESSION['loginErr']?></p>
                  <?php unset($_SESSION['loginErr'])?>
                  <?php endif?>
                    <?php if(isset($_SESSION['wrongCredentials'])):?>
                  <p class="error-msg"><?= $_SESSION['wrongCredentials']?></p>
                  <?php unset($_SESSION['wrongCredentials'])?>
                  <?php endif?>

                  <div class="form-group">
                    <label for="email" class="label">email</label>
                    <input
                      type="email"
                      aria-label="email"
                      class="form-control"
                      placeholder="example@gmail.com"
                      id="login_email"
                      name="login_email"
                      required
                    />
                  </div>
                    <div class="form-group">
                    <label for="password" class="label">password</label>
                    <input
                      type="password"
                      aria-label="password"
                      class="form-control"
                      id="login_password"
                      name="login_password"
                      required
                    />
                  </div>                
                  <button
                    type="submit"
                    id="#button"
                    class="btn form-control"
                    name="submit"
                  >
                    Login
                  </button>

                  
                </form>  
            </div>
          <div class="modal-footer">
            <p>Don't have an account ?<a href="#" class="secondary-btn" data-bs-target="#signupModal" data-bs-toggle="modal" data-bs-dismiss="modal">signup</a></p>
          </div>
            </div>
          </div>
        </div>
      <!-- sign up modal -->
      <div
        class="modal fade"
        id="signupModal"
        tabindex="-1"
        aria-labelledby="sign up"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered ">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" id="modal-label" style="text-transform: none;">Welcome to eCycle, Sign Up</h3>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body ">
              <form
              class="form"
              id="signup"
              action="signup.php"
              method="post"
              >
                 <?php if(isset($_SESSION['signupErr'])):?>
                  <p class="error-msg"><?=$_SESSION['signupErr']?></p>
                 <?php unset($_SESSION['signupErr'])?>
                  <?php elseif(isset($_SESSION['sucesss'])):?>
                  <p class="success-msg"></p>
                  <p class="error-msg"><?=$_SESSION['success']?></p>
                 <?php unset($_SESSION['success'])?>
                 <?php endif?>
                  <div class="form-group">
                    <label for="name" class="label">full name</label>
                    <input
                      type="text"
                      aria-label="name"
                      id="name"
                      class="form-control"
                      placeholder="name"
                      name="name"
                      required
                    />
                  </div>
                     <div class="form-group">
                    <label for="username" class="label">username</label>
                    <input
                      type="text"
                      aria-label="username"
                      id="username"
                      class="form-control"
                      placeholder="username"
                      name="username"
                      required
                    />
                  </div>
                  <div class="form-group">
                    <label for="email" class="label">email</label>
                    <input
                      type="email"
                      aria-label="email"
                      class="form-control"
                      placeholder="example@gmail.com"
                      id="email"
                      name="email"
                      required
                    />
                  </div>
                    <div class="form-group">
                    <label for="phone" class="label">Telephone number</label>
                    <input
                      type="tel"
                      aria-label="telephone"
                      class="form-control"
                      placeholder="070200000"
                      id="phone"
                      name="phone"
                      required
                    />
                  </div>
                  <div class="form-group">
                    <label for="dob" class="label">date of birth</label>
                    <input
                      type="date"
                      aria-label="dob"
                      class="form-control"
                      id="dob"
                      name="dob"
                      required
                    />
                  </div>
                    <div class="form-group">
                    <label for="postalAddress" class="label">postal address</label>
                    <input
                      type="text"
                      aria-label="postal "
                      class="form-control"
                      id="postalAddress"
                      name="postalAddress"
                      required
                    />
                  </div>  
                    <div class="form-group">
                    <label for="postalCode" class="label">postal code</label>
                    <input
                      type="text"
                      aria-label="postal code"
                      class="form-control"
                      id="postalCode"
                      name="postalCode"
                      required
                    />
                  </div> 
                    <div class="form-group">
                    <label for="password" class="label">password</label>
                    <input
                      type="password"
                      aria-label="password"
                      class="form-control"
                      id="password"
                      name="password"
                      required
                    />
                  </div> 
                  <div class="form-group">
                    <label for="password" class="label">confirm password</label>
                    <input
                      type="password"
                      aria-label="confirm password"
                      class="form-control"
                      id="corfirmPassword"
                      name="confirmPassword"
                      required
                    />
                  </div> 

                  <button
                    type="submit"
                    id="button"
                    class="btn form-control"
                    name="submit"
                  > Sign up
                  </button>
                </form>
                <div class="modal-footer">
                  <p>Have an account ?<a href="#" class="secondary-btn" data-bs-target="#loginModal" data-bs-toggle="modal" data-bs-dismiss="modal">login</a></p>
                </div>
          </div>
        </div>
      </div>
    </section>
    <!-- bootstrapped js -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <!-- in project js -->

    <script type="module" src="index.js"></script>
    <script type="module" src="./src/makeOrder.js"></script>
    <script type="module" src="./src/slider.js"></script>
  </body>
</html>

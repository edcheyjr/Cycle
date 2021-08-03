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
          <h3 class="cart-total text-slanted">total : KSH0.00</h3>
          <!-- cart button to submit orders -->
          <?php if(isset($_SESSION['username'])):?>
            <form action="order.php" method="post" enctype="multipart/form-data" id ='order'>
            <div class="success-msg">
            <!-- success -->
            </div>
            <div class="error-msg">
            <!-- error -->
            </div>
          <input type="hidden" id="user_id" value="<?=$user_id?>">
          <button id='cart-submit' class="cart-checkout btn" type="submit">checkout</button>
        </form>
        <?php else:?>
        <a class="cart-checkout btn"  href="login.php" type="button">checkout</a>
        <?php endif?>
        </footer>
      </aside>
    </div>
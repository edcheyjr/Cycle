 <?php if(isset($_SESSION["username"])):?>
        <p class="login-btn" style="margin-top: 1.3rem;"><?= $_SESSION['username']?>
        </p>
          <a href="logout.php" class="login-btn">logout</a>   
        <?php else:?>
          '<a href="login.php" class="login-btn"
        >login   </a>'      
        <?php
          endif        
        ?>
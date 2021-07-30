<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tabs</title>

    <!-- styles -->
    <link rel="stylesheet" href="../styles.css" />
  </head>
  <body>
   <?php require 'adminNav.php'?>

   <section class="page-hero">
      <div class="section-center">
        <h3 class="page-hero-title">Admin Panel \ eCycle</h3>
      </div>
    </section>
    <section class="section">
      <div class="about-center section-center">
        <article class="about">
          <!-- btn container -->
          <div class="btn-container">
            <button class="tab-btn active" data-id="history">users</button>
            <button class="tab-btn" data-id="vision">product</button>
            <button class="tab-btn" data-id="goals">goals</button>
          </div>
          <div class="about-content">
            <!-- single item -->
            <div class="content active" id="history">
              <h4>user</h4>
              <p>
                We are users
              </p>
            </div>
            <!-- end of single item -->
            <!-- single item -->
            <div class="content" id="vision">
              <h4>product</h4>
              <p>
               We are product
              </p>
            </div>
            <!-- end of single item -->
            <!-- single item -->
            <div class="content" id="goals">
              <h4>archive</h4>
              <p>
               We are archived product
              </p>
            </div>
            <!-- end of single item -->
          </div>
        </article>
      </div>
    </section>
    <!-- javascript -->
    <script type = "module" src="../src/pages/adminPanel.js"></script>
  </body>
</html>
<?php
require '../connect.php';
$target_url_original = 'http://localhost/ecycle/public/store/original/';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin panel | eCycle</title>

    <!-- styles -->
    <link rel="stylesheet" href="../styles.css" />
       <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" />
  
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
            <button class="tab-btn active" data-id="users">users</button>
            <button class="tab-btn " data-id="orders">orders</button>
            <button class="tab-btn " data-id="contacts">Contact us</button>
            <button class="tab-btn " data-id="products">products</button>
            <button class="tab-btn" data-id="archives">archive</button>
          </div>
          <div class="about-content">
            <!-- single item -->
            <div class="content " id="users">
              <h4>user</h4>
                          <table id="users" class="table table-secondary table-hover border border-dark ">
        <thead >
        <tr class="border border-dark">
            <th>ID</th>
            <th>fullname</th>
            <th>username</th>
            <th>email</th>
            <th>phone</th>
            <th>Date of Birth</th>
            <th>postal address</th>
            <th>postal code</th>

        </tr>
        </thead>
        <tbody>
        <?php

        $sql ="SELECT * FROM users ORDER BY id DESC ";
        $results = mysqli_query($connect,$sql);

        while ($row= mysqli_fetch_assoc($results))
        {
            extract($row);
            echo " 
         <tr>
            <td>$id</td>
            <td>$full_name</td>
            <td>$username</td>
            <td>$email</td>
            <td>$phone</td>
            <td>$dob</td>
            <td>$postal_address</td>                 
            <td>$postal_code</td>         
        </tr>";
        }
        ?>

        </tbody>
    </table>
      <script>
          $(document).ready(function() {
              $('#users').DataTable();
          } );
      </script>
            </div>
            <!-- end of single item -->
        <!-- single item -->
            <div class="content " id="orders">
              <h4>user</h4>
                          <table id="orders" class="table table-secondary table-hover border border-dark ">
        <thead >
        <tr class="border border-dark">
            <th>ID</th>
            <th>Order Number</th>
            <th>Order Quantity</th>
            <th>price</th>
            <th>total price</th>
            <th>user id</th>
            <th>product id</th>
            <th>remove order</th>

        </tr>
        </thead>
        <tbody>
        <?php

        $sql ="SELECT * FROM orders ORDER BY id DESC ";
        $results = mysqli_query($connect,$sql);

        while ($row= mysqli_fetch_assoc($results))
        {
            extract($row);
            echo " 
         <tr>
            <td>$id</td>
            <td>$order_number</td>
            <td>$quantity</td>
            <td>$price</td>
            <td>$total_price</td>
            <td>$user_id</td>
            <td>$$product_id</td>               
            <td><a href='delete.php?id=$id' class='btn btn-danger'>Remove</a></td>                 
        </tr>";
        }
        ?>

        </tbody>
    </table>
      <script>
          $(document).ready(function() {
              $('#orders').DataTable();
          } );
      </script>
            </div>
            <!-- end of single item -->
                    <!-- single item -->
            <div class="content " id="contacts">
              <h4>user</h4>
                          <table id="contacts" class="table table-secondary table-hover border border-dark ">
        <thead >
        <tr class="border border-dark">
            <th>ID</th>
            <th>fullname</th>
            <th>email</th>
            <th>subject</th>
            <th>message</th>

        </tr>
        </thead>
        <tbody>
        <?php

        $sql ="SELECT * FROM contacts ORDER BY id DESC ";
        $results = mysqli_query($connect,$sql);

        while ($row= mysqli_fetch_assoc($results))
        {
            extract($row);
            echo " 
         <tr>
            <td>$id</td>
            <td>$name</td>
            <td>$email</td>
            <td>$subject</td>
            <td>$message</td>       
        </tr>";
        }
        ?>

        </tbody>
    </table>
      <script>
          $(document).ready(function() {
              $('#contacts').DataTable();
          } );
      </script>
            </div>
            <!-- end of single item -->

            <!-- single item -->
    <div class="content active" id="products">
              <h4>product</h4>

    <table id="products" class="table table-secondary table-hover border border-dark ">
        <thead >
        <tr class="border border-dark">
            <th>ID</th>
            <th>Bicycle</th>
            <th>ImagePath</th>
            <th>Price</th>
            <th>Date Added</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $sql ="SELECT * FROM products ORDER BY id DESC ";
        $results = mysqli_query($connect,$sql) or die(mysqli_error($connect));

        while ($row= mysqli_fetch_assoc($results))
        {
            extract($row);
            $image_path = $target_url_original.$image_name;
            echo " 
         <tr>
            <td>$id</td>
            <td>$bicycle_name</td>
            <td>$image_path</td>
            <td>$price</td>
            <td>$date_added</td>     
            <td><a href='http://localhost/ecycle/admin/archive.php?id=$id' class='btn btn-warning'>Archive</a></td>         
            </tr>";
          }
          // <td><a href='update.php?id=$id' class='btn btn-success'>Update</a></td>        
        ?>

        </tbody>
    </table>
      <script>
          $(document).ready(function() {
              $('#products').DataTable();
          } );
      </script>
</div>
            <!-- end of single item -->
            <!-- single item -->
            <div class="content" id="archives">
              <h4>archive</h4>
               <table id="archive" class="table table-secondary table-hover border border-dark ">
        <thead >
        <tr class="border border-dark">
            <th>ID</th>
            <th>Bicycle</th>
            <th>ImagePath</th>
            <th>Price</th>
            <th>Date Added</th>
            <th>Delete</th>
            <th>Urchive</th>

        </tr>
        </thead>
        <tbody>
        <?php

        $sql ="SELECT * FROM archives ORDER BY id DESC ";
        $results = mysqli_query($connect,$sql);

        while ($row= mysqli_fetch_assoc($results))
        {
            extract($row);
            $image_path = $target_url_original.$image_name;
            echo " 
         <tr>
            <td>$id</td>
            <td>$bicycle_name</td>
            <td>$image_path</td>
            <td>$price</td>
            <td>$date_added</td>
            <td><a href='delete.php?id=$id' class='btn btn-danger'>Remove</a></td>                 
            <td><a href='unarchive.php?id=$id' class='btn btn-info'>Unarchive</a></td>         
        </tr>";
        }
        ?>

        </tbody>
    </table>
      <script>
          $(document).ready(function() {
              $('#archive').DataTable();
          } );
      </script>
            <!-- end of single item -->
          </div>
        </article>
      </div>
    </section>
    <!-- javascript --> 
    <script type = "module" src="../src/pages/adminPanel.js"></script>
    <!-- bootstrap -->
      <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  </body>
</html>
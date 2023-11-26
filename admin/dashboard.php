<?php

include '../components/connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>

   <?php include '../components/admin_header.php' ?>

   <!-- admin dashboard section starts  -->

   <style>
      .box {
         background-color: #fed330;
      }

      .box:hover {
         transition: all ease 0.5s;
         transform: scale(0.8);
      }
   </style>

   <section class="dashboard">
      <h1 class="heading">dashboard</h1>
      <div class="box-container">

         <div class="box">
            <h3>Welcome!</h3>
            <p>
               <?= $fetch_profile[0]['name']; ?>
            </p>
         </div>
      </div>
      <br>
      <div class="box-container">
         
         <div class="box">
            <?php
            $sql = "SELECT * FROM orders;";
            $select_orders = mysqli_query($conn, $sql);
            $fetch_orders = mysqli_fetch_all($select_orders, MYSQLI_ASSOC);
            $numbers_of_orders = count($fetch_orders);
            ?>
            <h3>
               <?= $numbers_of_orders; ?>
            </h3>
            <p>Total orders</p>
            <a href="placed_orders.php" class="btn">see orders</a>
         </div>

         <div class="box">
            <?php
            $sql = "SELECT * FROM products;";
            $select_products = mysqli_query($conn, $sql);
            $fetch_products = mysqli_fetch_all($select_products, MYSQLI_ASSOC);
            $numbers_of_products = count($fetch_products);
            ?>
            <h3>
               <?= $numbers_of_products; ?>
            </h3>
            <p>Products added</p>
            <a href="products.php" class="btn">see products</a>
         </div>

         <div class="box">
            <?php
            $sql = "SELECT * FROM users;";
            $select_users = mysqli_query($conn, $sql);
            $fetch_users = mysqli_fetch_all($select_users, MYSQLI_ASSOC);
            $numbers_of_users = count($fetch_users);
            ?>
            <h3>
               <?= $numbers_of_users; ?>
            </h3>
            <p>Users accounts</p>
            <a href="users_accounts.php" class="btn">see users</a>
         </div>


      </div>

   </section>


   <!-- font awesome link -->
   <script src="https://kit.fontawesome.com/848e0df24d.js" crossorigin="anonymous"></script>


   <!-- custom js file link  -->
   <script src="../js/admin_script.js"></script>

</body>

</html>
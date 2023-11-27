<?php
include '../components/connection.php';
session_start();

$admin_id = $_SESSION['admin_id'];
$admin_name = $_SESSION['admin_name'];

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
               Admin Id = <?= $admin_id; ?>
            </p>
         </div>
      </div>
      <br>

      <div class="box-container">

         <div class="box">
            <?php
            $total_pendings = 0;
            $sql = "SELECT * FROM orders WHERE payment_status = 'pending';";
            $select_pendings = mysqli_query($conn, $sql);
            $fetch_pendings = mysqli_fetch_all($select_pendings, MYSQLI_ASSOC);
            for ($i = 0; $i < count($fetch_pendings); $i++) {
               $total_pendings += $fetch_pendings[$i]['total_price'];
            }
            ?>
            <h3><span>$</span>
               <?= $total_pendings; ?><span>/-</span>
            </h3>
            <p>Total pendings</p>
            <a href="placed_orders.php" class="btn">see orders</a>
         </div>

         <div class="box">
            <?php
            $total_completes = 0;
            $sql = "SELECT * FROM orders WHERE payment_status = 'completed';";
            $select_completes = mysqli_query($conn, $sql);
            $fetch_completes = mysqli_fetch_all($select_completes, MYSQLI_ASSOC);
            for ($i = 0; $i < count($fetch_completes); $i++) {
               $total_completes += $fetch_completes[$i]['total_price'];
            }
            ?>
            <h3><span>&#8377;</span>
               <?= $total_completes; ?><span>/-</span>
            </h3>
            <p>Total completes</p>
            <a href="placed_orders.php" class="btn">see orders</a>
         </div>

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

         <div class="box">
            <?php
            $sql = "SELECT * FROM admin;";
            $select_admins = mysqli_query($conn, $sql);
            $fetch_admins = mysqli_fetch_all($select_admins, MYSQLI_ASSOC);
            $numbers_of_admins = count($fetch_admins);
            ?>
            <h3>
               <?= $numbers_of_admins; ?>
            </h3>
            <p>Admins</p>
            <a href="admin_accounts.php" class="btn">see admins</a>
         </div>

         <div class="box">
            <?php
            $sql = "SELECT * FROM messages;";
            $select_messages = mysqli_query($conn, $sql);
            $fetch_messages = mysqli_fetch_all($select_messages, MYSQLI_ASSOC);
            $numbers_of_messages = count($fetch_messages);
            ?>
            <h3>
               <?= $numbers_of_messages; ?>
            </h3>
            <p>New messages</p>
            <a href="messages.php" class="btn">see messages</a>
         </div>

      </div>

   </section>


   <!-- font awesome link -->
   <script src="https://kit.fontawesome.com/848e0df24d.js" crossorigin="anonymous"></script>


   <!-- custom js file link  -->
   <script src="../js/admin_script.js"></script>

</body>

</html>
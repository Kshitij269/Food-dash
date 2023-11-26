<?php

include '../components/connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>placed orders</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- placed orders section  -->
<section class="placed-orders">

   <h1 class="heading">placed orders</h1>

   <div class="box-container">

   <?php
      $sql = "SELECT * FROM orders;";
      $select_orders = mysqli_query($conn, $sql);
      $fetch_orders = mysqli_fetch_all($select_orders, MYSQLI_ASSOC);
      if(count($fetch_orders) > 0){
         for($i = 0; $i < count($fetch_orders); $i++){
   ?>
   <div class="box">
      <p> User id : <span><?= $fetch_orders[$i]['user_id']; ?></span> </p>
      <p> Placed on : <span><?= $fetch_orders[$i]['placed_on']; ?></span> </p>
      <p> Name : <span><?= $fetch_orders[$i]['name']; ?></span> </p>
      <p> Email : <span><?= $fetch_orders[$i]['email']; ?></span> </p>
      <p> Number : <span><?= $fetch_orders[$i]['number']; ?></span> </p>
      <p> Address : <span><?= $fetch_orders[$i]['address']; ?></span> </p>
      <p> Total products : <span><?= $fetch_orders[$i]['total_products']; ?></span> </p>
      <p> Total price : <span>$<?= $fetch_orders[$i]['total_price']; ?>/-</span> </p>
      <p> Payment method : <span><?= $fetch_orders[$i]['method']; ?></span> </p>
      
   </div>
   <?php
      }
   }
   else{
      echo '<p class="empty">No orders placed yet!</p>';
   }
   ?>
   </div>
</section>




<!-- font awesome link -->
<script src="https://kit.fontawesome.com/848e0df24d.js" crossorigin="anonymous"></script>


<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>
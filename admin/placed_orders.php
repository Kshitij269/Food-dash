<?php

include '../components/connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update_payment'])){

   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $sql = "UPDATE orders SET payment_status = '$payment_status' WHERE id = '$order_id'";
   $select_messages = mysqli_query($conn, $sql);
   $fetch_messages = mysqli_fetch_all($select_messages, MYSQLI_ASSOC);
   $message[] = 'Payment status updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $sql = "DELETE FROM orders WHERE id = '$delete_id';";
   $select_messages = mysqli_query($conn, $sql);
   header('location:placed_orders.php');
}

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
      <p> user id : <span><?= $fetch_orders[$i]['user_id']; ?></span> </p>
      <p> placed on : <span><?= $fetch_orders[$i]['placed_on']; ?></span> </p>
      <p> name : <span><?= $fetch_orders[$i]['name']; ?></span> </p>
      <p> email : <span><?= $fetch_orders[$i]['email']; ?></span> </p>
      <p> number : <span><?= $fetch_orders[$i]['number']; ?></span> </p>
      <p> address : <span><?= $fetch_orders[$i]['address']; ?></span> </p>
      <p> total products : <span><?= $fetch_orders[$i]['total_products']; ?></span> </p>
      <p> total price : <span>$<?= $fetch_orders[$i]['total_price']; ?>/-</span> </p>
      <p> payment method : <span><?= $fetch_orders[$i]['method']; ?></span> </p>
      <form action="" method="POST">
         <input type="hidden" name="order_id" value="<?= $fetch_orders[$i]['id']; ?>">
         <select name="payment_status" class="drop-down">
            <option value="" selected disabled><?= $fetch_orders[$i]['payment_status']; ?></option>
            <option value="pending">pending</option>
            <option value="completed">completed</option>
         </select>
         <div class="flex-btn">
            <input type="submit" value="update" class="btn" name="update_payment">
            <a href="placed_orders.php?delete=<?= $fetch_orders[$i]['id']; ?>" class="delete-btn" onclick="return confirm('Delete this order?');">Delete</a>
         </div>
      </form>
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
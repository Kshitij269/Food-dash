<?php

include '../components/connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $sql = "DELETE FROM users WHERE id = '$delete_id'";
   $delete_users = mysqli_query($conn, $sql);
   
   $sql = "DELETE FROM orders WHERE user_id = '$delete_id'";
   $delete_order = mysqli_query($conn, $sql);
   
   $sql = "DELETE FROM cart WHERE user_id = '$delete_id'";
   $delete_cart = mysqli_query($conn, $sql);
   header('location:users_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users accounts</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- user accounts section starts  -->

<section class="accounts">

   <h1 class="heading">users account</h1>

   <div class="box-container">

   <?php
      $sql = "SELECT * FROM users;";
      $select_account = mysqli_query($conn, $sql);
      $fetch_accounts = mysqli_fetch_all($select_account, MYSQLI_ASSOC);
      if(count($fetch_accounts) > 0){
         for($i = 0; $i < count($fetch_accounts); $i++){
   ?>
   <div class="box">
      <p> User id : <span><?= $fetch_accounts[$i]['id']; ?></span> </p>
      <p> Username : <span><?= $fetch_accounts[$i]['name']; ?></span> </p>
      <p> Email : <span><?= $fetch_accounts[$i]['email']; ?></span> </p>
      <p> Number : <span><?= $fetch_accounts[$i]['number']; ?></span> </p>
      <a href="users_accounts.php?delete=<?= $fetch_accounts[$i]['id']; ?>" class="delete-btn" onclick="return confirm('delete this account?');">Delete</a>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no accounts available</p>';
   }
   ?>

   </div>

</section>





   <!-- font awesome cdn link -->
   <script src="https://kit.fontawesome.com/848e0df24d.js" crossorigin="anonymous"></script>

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>
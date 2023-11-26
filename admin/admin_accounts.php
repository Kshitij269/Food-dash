<?php

include '../components/connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_admin = $conn->prepare("DELETE FROM `admin` WHERE id = ?");
   $delete_admin->execute([$delete_id]);
   header('location:admin_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admins accounts</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- admins accounts section starts  -->

<section class="accounts">

   <h1 class="heading">admins account</h1>

   <div class="box-container">

   <div class="box">
      <p>register new admin</p>
      <a href="register_admin.php" class="option-btn">register</a>
   </div>

   <?php
      $sql = "SELECT * FROM admin;";
      $select_account = mysqli_query($conn, $sql);
      $fetch_accounts = mysqli_fetch_all($select_account, MYSQLI_ASSOC);
         if(count($fetch_accounts) > 0){
            for($i = 0; $i < count($fetch_accounts); $i++){
   ?>
   <div class="box">
      <p> admin id : <span><?= $fetch_accounts[$i]['id']; ?></span> </p>
      <p> username : <span><?= $fetch_accounts[$i]['name']; ?></span> </p>
      <div class="flex-btn">
         <a href="admin_accounts.php?delete=<?= $fetch_accounts[$i]['id']; ?>" class="delete-btn" onclick="return confirm('Delete this account?');">delete</a>
         <?php
            if($fetch_accounts[$i]['id'] == $admin_id){
               echo '<a href="update_profile.php" class="option-btn">Update</a>';
            }
         ?>
      </div>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">No accounts available</p>';
   }
   ?>
   </div>

   <!-- font awesome link -->
   <script src="https://kit.fontawesome.com/848e0df24d.js" crossorigin="anonymous"></script>

   <!-- custom js file link  -->
   <script src="../js/admin_script.js"></script>

</section>

<!-- admins accounts section ends -->




















<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>
<?php

include '../components/connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $sql = "DELETE FROM messages WHERE id = '$delete_id';";
   $select_pendings = mysqli_query($conn, $sql);
   header('location:messages.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messages</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>


<!-- messages section  -->
<section class="messages">

   <h1 class="heading">messages</h1>

   <div class="box-container">

   <?php
      $sql = "SELECT * FROM messages;";
      $select_messages = mysqli_query($conn, $sql);
      $fetch_messages = mysqli_fetch_all($select_messages, MYSQLI_ASSOC);
      if(count($fetch_messages) > 0){
         for($i = 0; $i < count($fetch_messages); $i++){
   ?>
   <div class="box">
      <p> Name : <span><?= $fetch_messages[$i]['name']; ?></span> </p>
      <p> Number : <span><?= $fetch_messages[$i]['number']; ?></span> </p>
      <p> Email : <span><?= $fetch_messages[$i]['email']; ?></span> </p>
      <p> Message : <span><?= $fetch_messages[$i]['message']; ?></span> </p>
      <a href="messages.php?delete=<?= $fetch_messages[$i]['id']; ?>" class="delete-btn" onclick="return confirm('Delete this message?');">Delete</a>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">you have no messages</p>';
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
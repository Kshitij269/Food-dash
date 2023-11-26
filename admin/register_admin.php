<?php
include '../components/connection.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = $_POST['pass'];
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = $_POST['cpass'];
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $sql = "SELECT * FROM admin WHERE name = '$name';";
   $show_products = mysqli_query($conn, $sql);
   $fetch_products = mysqli_fetch_all($show_products, MYSQLI_ASSOC);
   
   if(count($fetch_products) > 0){
      $message[] = 'Username already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'Confirm passowrd not matched!';
      }else{
         $sql = "INSERT INTO admin(name, password) VALUES('$name', '$cpass');";
         $show_products = mysqli_query($conn, $sql);
         $message[] = 'New admin registered!';
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- register admin section -->
<section class="form-container">

   <form action="" method="POST">
      <h3>Register New</h3>
      <input type="text" name="name" maxlength="20" required placeholder="enter your username" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" maxlength="20" required placeholder="enter your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" maxlength="20" required placeholder="confirm your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="register now" name="submit" class="btn">
   </form>

</section>





<!-- font awesome link -->
<script src="https://kit.fontawesome.com/848e0df24d.js" crossorigin="anonymous"></script>


<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>
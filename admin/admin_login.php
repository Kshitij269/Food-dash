<?php

include '../components/connection.php';

session_start();

if (isset($_POST['submit'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = $_POST['pass'];
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $sql = "SELECT * FROM admin;";
   $select_admin = mysqli_query($conn, $sql);
   $fetch_admin_id = mysqli_fetch_all($select_admin, MYSQLI_ASSOC);

   if (count($fetch_admin_id) > 0) {
      $_SESSION['admin_id'] = $fetch_admin_id[0]['id'];
      header('location:dashboard.php');
   } else {
      $message[] = 'Incorrect username or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>

   <?php
   if (isset($message)) {
      foreach ($message as $message) {
         echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
      }
   }
   ?>

   <!-- admin login form section starts  -->
   <style>
      .form-box {
         background-color: rgba(0, 0, 0, 0.5);
         margin: auto auto;
         padding: 40px;
         border-radius: 5px;
         box-shadow: 0 0 10px #000;
         position: absolute;
         top: 0;
         bottom: 0;
         left: 0;
         right: 0;
         width: 500px;
         height: 430px;
      }

      .form-box:before {
         background-image: url("https://i.postimg.cc/8cnYLpfc/ddddd.jpg");
         width: 100%;
         height: 100%;
         background-size: cover;
         content: "";
         position: fixed;
         left: 0;
         right: 0;
         top: 0;
         bottom: 0;
         z-index: -1;
         display: block;
         filter: blur(2px);
      }

      .form-box .header-text {
         font-size: 32px;
         font-weight: 600;
         padding-bottom: 30px;
         text-align: center;
      }

      .form-box input {
         margin: 10px 0px;
         border: none;
         padding: 10px;
         border-radius: 5px;
         width: 100%;
         font-size: 18px;
         font-family: poppins;
      }

      .form-box input[type=checkbox] {
         display: none;
      }

      .form-box label {
         position: relative;
         margin-left: 5px;
         margin-right: 10px;
         top: 5px;
         display: inline-block;
         width: 20px;
         height: 20px;
         cursor: pointer;
      }

      .form-box label:before {
         content: "";
         display: inline-block;
         width: 20px;
         height: 20px;
         border-radius: 5px;
         position: absolute;
         left: 0;
         bottom: 1px;
         background-color: #ddd;
      }

      .form-box input[type=checkbox]:checked+label:before {
         content: "\2713";
         font-size: 20px;
         color: #000;
         text-align: center;
         line-height: 20px;
      }

      .form-box span {
         font-size: 14px;
      }

      .form-box button {
         background-color: deepskyblue;
         color: #fff;
         border: none;
         border-radius: 5px;
         cursor: pointer;
         width: 100%;
         font-size: 18px;
         padding: 10px;
         margin: 20px 0px;
      }

      span a {
         color: #BBB;
      }
   </style>

   <div class="form-box">
      <form action="" method="POST">
         <div class="header-text">
            Login Form
         </div>
         <input type="text" name="name" required placeholder="Enter your Username" class="box" maxlength="50"
            oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="pass" required placeholder="Enter your password" class="box" maxlength="50"
            oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="submit" value="Login now" name="submit" class="btn">
      </form>
   </div>

   <!-- admin login form section ends -->








   <!-- font awesome link -->
   <script src="https://kit.fontawesome.com/848e0df24d.js" crossorigin="anonymous"></script>

   <!-- custom js file link  -->
   <script src="../js/admin_script.js"></script>


</body>

</html>
<?php
include '../components/connection.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
};

if (isset($_POST['submit'])) {
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = $_POST['pass'];
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = $_POST['cpass'];
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $sql = "SELECT * FROM admin WHERE name = '$name';";
   $show_products = mysqli_query($conn, $sql);
   $fetch_products = mysqli_fetch_all($show_products, MYSQLI_ASSOC);

   if (count($fetch_products) > 0) {
      $message[] = 'Username already exists!';
   } else {
      if ($pass != $cpass) {
         $message[] = 'Confirm passowrd not matched!';
      } else {
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

   <!-- register admin section -->
   <div class="form-box">
      <form action="" method="POST">
         <div class="header-text">
            Register New
         </div>
         <input type="text" name="name" maxlength="20" required placeholder="Enter your username" class="box"
            oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="pass" maxlength="20" required placeholder="Enter your password" class="box"
            oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="cpass" maxlength="20" required placeholder="Confirm your password" class="box"
            oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="submit" value="Register now" name="submit" class="btn">
      </form>
   </div>

|
   <!-- font awesome link -->
   <script src="https://kit.fontawesome.com/848e0df24d.js" crossorigin="anonymous"></script>

   <!-- custom js file link  -->
   <script src="../js/admin_script.js"></script>

</body>

</html>
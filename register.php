<?php
    include('components/connection.php');

    session_start();

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }
    else{
        $user_id = '';
    }

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $number = $_POST['number'];
        $number = filter_var($number, FILTER_SANITIZE_STRING);
        $pass = $_POST['pass'];
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);
        $cpass = $_POST['cpass'];
        $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);


        $sql = "select * from users where email = '$email' OR number = '$number';";
        $select_user = mysqli_query($conn, $sql);
        $select_user = mysqli_fetch_all($select_user, MYSQLI_ASSOC);

        if(count($select_user) > 0){
            $message[] = 'Email or Number is already taken!';
        }
        elseif($pass != $cpass){
                $message[] = 'Confirm password not matched';
        }
        else{
            $sql = "Insert into users(name, email, number, password) values('$name', '$email', '$number', '$pass');";
            $select_user = mysqli_query($conn, $sql);
            
            $sql = "select * from `users` where email = '$email' and password = '$pass';";
            $confirm_user = mysqli_query($conn, $sql);
            $row = mysqli_fetch_all($confirm_user, MYSQLI_ASSOC);

            if(count($row) > 0){
                $_SESSION['user_id'] = $row[0]['id'];
                // header('location:home.php');
                $message[] = 'Registered Successfully!!';
            }
            else{
                $message[] = 'Some error';
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

    <!-- custom css file link -->
    <link rel="stylesheet" href="./CSS/style.css">
</head>

<body>
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
            height: 550px;
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


    <!-- header section -->
    <?php include('components/user_header.php'); ?>
    
    
    <!-- register section -->
    <div class="form-box">
        <form action="" method="post">
            <div class="header-text">
                Registration Form
            </div>
            <input type="text" name="name" required placeholder="Enter your name" class="box" maxlength="50">
            <input type="email" name="email" required placeholder="Enter your email" class="box" maxlength="50">
            <input type="number" name="number" required placeholder="Enter your number" class="box" min="0"
            max="9999999999" maxlength="10">
            <input type="password" name="pass" required placeholder="Enter your password" class="box" maxlength="50"
                oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="cpass" required placeholder="Confirm your password" class="box" maxlength="50"
                oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="Register Now" name="submit" class="btn">
            <center><h1><p>Already have an account? <a href="login.php">Login now</a></p></h1></center>
         </form>
    </div>

    <!-- <section class="form-container">
        <form action="" method="post">
            <h3>Register Now</h3>
            <input type="text" name="name" required placeholder="Enter your name" class="box" maxlength="50">
            <input type="email" name="email" required placeholder="Enter your email" class="box" maxlength="50">
            <input type="number" name="number" required placeholder="Enter your number" class="box" min="0"
            max="9999999999" maxlength="10">
            <input type="password" name="pass" required placeholder="Enter your password" class="box" maxlength="50"
                oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="cpass" required placeholder="Confirm your password" class="box" maxlength="50"
                oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="Register Now" name="submit" class="btn">
            <p>already have an account? <a href="login.php">login now</a></p>
        </form>
        
    </section> -->

    <!-- font awesome link -->
    <script src="https://kit.fontawesome.com/848e0df24d.js" crossorigin="anonymous"></script>

    <!-- Script -->
    <script src="./JS/script.js"></script>
</body>

</html>
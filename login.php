<?php
include('components/connection.php');

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = $_POST['pass'];
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    // echo $email."<br>".$pass."<br> inputs";

    $sql = "select * from users where email = '$email' and password = '$pass';";
    $select_user = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($select_user, MYSQLI_ASSOC);
    if (count($rows) > 0) {
        $_SESSION['user_id'] = $rows[0]['id'];
        header('location:home.php');
        // $message[] = 'Login Successful!';
    } else {
        $message[] = 'Incorrect email or password!';
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


    <!-- custom css file link -->
    <link rel="stylesheet" href="./CSS/style.css">
</head>

<body>
    <!-- header section -->
    <?php include('components/user_header.php'); ?>

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

    <!-- login section -->
    <div class="form-box">
        <form action="" method="post">
            <div class="header-text">
                Login Form
            </div>
            <input type="email" name="email" required placeholder="Enter your email" class="box" maxlength="50"
                oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="pass" required placeholder="Enter your password" class="box" maxlength="50"
                oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="Login now" name="submit" class="btn">
            <center><h1>Don't have an account? <a href="register.php">Register now</a></h1></center>
        </form>
    </div>




    <!-- footer section -->
    <!-- font awesome link -->
    <script src="https://kit.fontawesome.com/848e0df24d.js" crossorigin="anonymous"></script>

    <!-- Script -->
    <script src="./JS/script.js"></script>
</body>

</html>
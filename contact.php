<?php
include('components/connection.php');
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}


if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $msg = $_POST['msg'];
    $msg = filter_var($msg, FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM messages WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'";
    $select_message = mysqli_query($conn, $sql);
    $select_message = mysqli_fetch_all($select_message, MYSQLI_ASSOC);

    if (count($select_message) > 0) {
        $message[] = 'Already sent message!';
    } else {
        $sql = "INSERT INTO messages(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg');";
        $insert_message = mysqli_query($conn, $sql);
        $message[] = 'Sent message successfully!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>

    <!-- cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- custom css file link -->
    <link rel="stylesheet" href="./CSS/style.css">
</head>

<body>


    <!-- header section -->
    <?php include('components/user_header.php'); ?>






    <!-- heading sectiion -->
    <div class="heading">
        <h3>Contact us</h3>
        <p><a href="home.html">Home</a> <span> / Contact</span></p>
    </div>


    <!-- contact section -->
    <section class="contact">

        <div class="row">

            <div class="image">
                <img src="images/contact-img.svg" alt="">
            </div>

            <form action="" method="post">
                <h3>tell us something!</h3>
                <input type="text" name="name" maxlength="50" class="box" placeholder="Enter your name" required>
                <input type="number" name="number" min="0" max="9999999999" class="box" placeholder="Enter your number"
                    required maxlength="10">
                <input type="email" name="email" maxlength="50" class="box" placeholder="Enter your email" required>
                <textarea name="msg" class="box" required placeholder="Enter your message" maxlength="500" cols="30"
                    rows="10"></textarea>
                <input type="submit" value="Send message" name="send" class="btn">
            </form>

        </div>

    </section>

    <style>
        .box:hover{
            transform: scale(0.8);
        }
        .row{
            border-radius: 5px;
        }
    </style>



    <!-- footer section -->
    <footer class="footer">
        <section class="grid">
            <div class="box">
                <img src="./images/email-icon.png" alt="">
                <h3>our email</h3>
                <a href="mailto:jugnugupta@gmail.com">jugnugupta@gmail.com</a>
                <a href="mailto:jugnu@gmail.com">jugnu@gmail.com</a>
            </div>

            <div class="box">
                <img src="images/clock-icon.png" alt="">
                <h3>opening hours</h3>
                <p>Mon-Sat: 11AM - 12PM <br> Sunday: Closed</p>
            </div>

            <div class="box">
                <img src="images/map-icon.png" alt="">
                <h3>our address</h3>
                <a href="#">Flat No. 7, Bakauli village,<br> Narela, delhi - 110040</a>
            </div>

            <div class="box">
                <img src="images/phone-icon.png" alt="">
                <h3>our number</h3>
                <a href="tel:1234567890">123-456-7890</a>
                <a href="tel:1234567890">123-456-7890</a>
            </div>
        </section>

        <div class="credits">&copy; copyrights 2023 by <span>Jugnu Gupta</span> | all rights reserved</div>
    </footer>


    <div class="loader">
        <img src="images/loader.gif" alt="">
    </div>

    <!-- font awesome link -->
    <script src="https://kit.fontawesome.com/848e0df24d.js" crossorigin="anonymous"></script>


    <!-- Script -->
    <script src="./JS/script.js"></script>
</body>

</html>
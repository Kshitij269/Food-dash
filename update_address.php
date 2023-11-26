<?php
    include('components/connection.php');

    session_start();

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }
    else{
        $user_id = '';
        header('location:home.php');
    }

    if(isset($_POST['submit'])){
        $address = $_POST['flat_build'] .', '.$_POST['area_town'].', '. $_POST['city'] .', '. $_POST['state'] .', '. $_POST['country'] .' - '. $_POST['pin_code'];
        $address = filter_var($address, FILTER_SANITIZE_STRING);
        
        $sql = "UPDATE users set address = '$address' WHERE id = '$user_id';";
        $update_address = mysqli_query($conn, $sql);
        
        $message[] = 'Address saved!';
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Address</title>

    <!-- custom css file link -->
    <link rel="stylesheet" href="./CSS/style.css">
</head>

<body>
    <!-- header section -->
    <?php include('components/user_header.php'); ?>
    
    
    
    <!-- update profile section  -->
    <section class="form-container">

        <form action="" method="post">
            <h3>your address</h3>
            <input type="text" class="box" placeholder="flat no. and building no." required maxlength="50" name="flat_build">
            <input type="text" class="box" placeholder="area and town" required maxlength="50" name="area_town">
            <input type="text" class="box" placeholder="city name" required maxlength="50" name="city">
            <input type="text" class="box" placeholder="state name" required maxlength="50" name="state">
            <input type="text" class="box" placeholder="country name" required maxlength="50" name="country">
            <input type="number" class="box" placeholder="pin code" required max="999999" min="0" maxlength="6"
            name="pin_code">
            <input type="submit" value="save address" name="submit" class="btn">
        </form>
        
    </section>
    
    
    <!-- footer section -->
    <footer class="footer">
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
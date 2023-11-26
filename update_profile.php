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

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $number = $_POST['number'];
        $number = filter_var($number, FILTER_SANITIZE_STRING);
        
        if($name != ""){
            $sql = "UPDATE users SET name = '$name' WHERE id = '$user_id';";
            $update_name = mysqli_query($conn, $sql);
        }
        
        if($email != ""){
            $sql = "SELECT * FROM users WHERE email = '$email';";
            $select_email = mysqli_query($conn, $sql);
            $fetch_email = mysqli_fetch_all($select_email, MYSQLI_ASSOC);
            if(count($fetch_email) > 0){
                $message[] = 'Email already taken!';
            }
            else{
                $sql = "UPDATE users SET email = '$email' WHERE id = '$user_id';";
                $update_email = mysqli_query($conn, $sql);
            }
        }
        
        if($number != ""){
            $sql = "SELECT * FROM users WHERE number = '$number';";
            $select_number = mysqli_query($conn, $sql);
            $fetch_number = mysqli_fetch_all($select_number, MYSQLI_ASSOC);
            if(count($fetch_number) > 0){
                $message[] = 'Number already taken!';
            }
            else{
                $sql = "UPDATE `users` SET number = '$number' WHERE id = '$user_id';";
                $update_number = mysqli_query($conn, $sql);
            }
        }
        $sql = "SELECT password FROM users WHERE id = '$user_id';";
        $select_prev_pass = mysqli_query($conn, $sql);
        $fetch_prev_pass = mysqli_fetch_all($select_prev_pass, MYSQLI_ASSOC);
        $prev_pass = $fetch_prev_pass[0]['password'];
        $old_pass = $_POST['old_pass'];
        $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
        $new_pass = $_POST['new_pass'];
        $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
        $confirm_pass = $_POST['confirm_pass'];
        $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);
        
        if($confirm_pass != ""){
            if($old_pass != $prev_pass){
                $message[] = 'Old password not matched!';
            }
            elseif($new_pass != $confirm_pass){
                $message[] = 'Confirm password not matched!';
            }
            else{
                $sql = "UPDATE `users` SET password = '$confirm_pass' WHERE id = '$user_id';";
                $update_pass = mysqli_query($conn, $sql);
                $message[] = 'Password updated successfully!';
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
    <title>Update Profile</title>

    <!-- custom css file link -->
    <link rel="stylesheet" href="./CSS/style.css">
</head>

<body>


    <!-- header section -->
    <?php include('components/user_header.php'); ?>
    
    
    
    
    
    
    
    <!-- update profile section  -->
    <section class="form-container update-form">

        <form action="" method="post">
            <h3>update profile</h3>
            <input type="text" name="name" placeholder="<?= $fetch_profile[0]['name']; ?>" class="box" maxlength="50">
            <input type="email" name="email" placeholder="<?= $fetch_profile[0]['email']; ?>" class="box" maxlength="50"
                oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="number" name="number" placeholder="<?= $fetch_profile[0]['number']; ?>"" class=" box" min="0" 
                max="9999999999" maxlength="10">
            <input type="password" name="old_pass" placeholder="enter your old password" class="box" maxlength="50"
                oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="new_pass" placeholder="enter your new password" class="box" maxlength="50"
                oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="confirm_pass" placeholder="confirm your new password" class="box" maxlength="50" 
                oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="update now" name="submit" class="btn">
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
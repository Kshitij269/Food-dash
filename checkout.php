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
        $number = $_POST['number'];
        $number = filter_var($number, FILTER_SANITIZE_STRING);
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $method = $_POST['method'];
        $method = filter_var($method, FILTER_SANITIZE_STRING);
        $address = $_POST['address'];
        $address = filter_var($address, FILTER_SANITIZE_STRING);
        $total_products = $_POST['total_products'];
        $total_price = $_POST['total_price'];
        
        $sql = "SELECT * FROM cart WHERE user_id = '$user_id';";
        $check_cart = mysqli_query($conn, $sql);
        $check_cart = mysqli_fetch_all($check_cart, MYSQLI_ASSOC);
    
        if(count($check_cart) > 0){
            if($address == ''){
                $message[] = 'Please add your address!';
            }
            else{
                $sql = "INSERT INTO orders(user_id, name, number, email, method, address, total_products, total_price) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$total_price')";
                $check_cart = mysqli_query($conn, $sql);

                $sql = "DELETE FROM cart WHERE user_id ='$user_id';";
                $check_cart = mysqli_query($conn, $sql);

                $message[] = 'Order placed successfully!';
            }
        }
        else{
            $message[] = 'Your cart is empty';
        }
    
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <!-- custom css file link -->
    <link rel="stylesheet" href="./CSS/style.css">
</head>

<body>


    <!-- header section -->
    <?php include('components/user_header.php'); ?>
    
    
    
    
    
    
    <!-- heading -->
    <div class="heading">
        <h3>checkout</h3>
        <p><a href="home.php">Home</a> <span> / Checkout</span></p>
    </div>
    

    <!-- checkout section -->
    <section class="checkout">

        <h1 class="title">order summary</h1>

        <form action="" method="post">
            
            <div class="cart-items">
                <h3>Cart items</h3>
                <?php
                    $grand_total = 0;
                    $cart_items[] = '';
                    $sql = "SELECT * FROM cart WHERE user_id = '$user_id';";
                    $select_cart = mysqli_query($conn, $sql);
                    $fetch_cart = mysqli_fetch_all($select_cart, MYSQLI_ASSOC);
                    if(count($fetch_cart) > 0){
                        for($i = 0; $i < count($fetch_cart); $i++){
                            $cart_items[] = $fetch_cart[$i]['name'].' ('.$fetch_cart[$i]['price'].' x '. $fetch_cart[$i]['quantity'].') - ';
                            $total_products = implode($cart_items);
                            $grand_total += ($fetch_cart[$i]['price'] * $fetch_cart[$i]['quantity']);
                ?>
                <p><span class="name"><?= $fetch_cart[$i]['name']; ?></span><span class="price">
                &#8377;<?= $fetch_cart[$i]['price']; ?> x <?= $fetch_cart[$i]['quantity']; ?></span></p>
                <?php
                    }
                }
                else{
                    echo '<p class="empty">Your cart is empty!</p>';
                }
                ?>
                <p class="grand-total"><span class="name">Grand total :</span><span class="price">&#8377;<?= $grand_total; ?></span></p>
                <a href="cart.php" class="btn">Veiw cart</a>
            </div>

            <input type="hidden" name="total_products" value="<?= $total_products; ?>">
            <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
            <input type="hidden" name="name" value="<?= $fetch_profile[0]['name'] ?>">
            <input type="hidden" name="number" value="<?= $fetch_profile[0]['number'] ?>">
            <input type="hidden" name="email" value="<?= $fetch_profile[0]['email'] ?>">
            <input type="hidden" name="address" value="<?= $fetch_profile[0]['address'] ?>">

            <div class="user-info">
                <h3>Your info</h3>
                <p><i class="fas fa-user"></i><span><?= $fetch_profile[0]['name'] ?></span></p>
                <p><i class="fas fa-phone"></i><span><?= $fetch_profile[0]['number'] ?></span></p>
                <p><i class="fas fa-envelope"></i><span><?= $fetch_profile[0]['email'] ?></span></p>
                <a href="update_profile.php" class="btn">Update info</a>
                <h3>Delivery address</h3>
                <p><i class="fas fa-map-marker-alt"></i><span><?php if($fetch_profile[0]['email'] == ''){echo 'Please enter your address';}else{echo $fetch_profile[0]['address'];} ?></span></p>
                <a href="update_address.php" class="btn">Update address</a>
                <select name="method" class="box" required>
                    <option value="" disabled selected>Select payment method --</option>
                    <option value="cash on delivery">cash on delivery</option>
                    <option value="credit card">Online Payment</option>
                </select>

                <input type="submit" value="Place order"
                    class="btn <?html if($fetch_profile[0]['address'] == ''){echo 'disabled';} ?>"
                    style="width:100%; background:var(--red); color:var(--white);" name="submit">
            </div>

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
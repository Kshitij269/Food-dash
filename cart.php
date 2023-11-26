<?php
    include('components/connection.php');
    session_start();
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }
    else{
        $user_id = '';
    }


    if(isset($_POST['delete'])){
        $cart_id = $_POST['cart_id'];
        $sql = "DELETE FROM cart WHERE id = '$cart_id';";
        $delete_cart_item = mysqli_query($conn, $sql);
        $message[] = 'Cart item deleted!';
    }
    
    if(isset($_POST['delete_all'])){
        $sql = "DELETE FROM cart WHERE user_id = '$user_id';";
        $delete_cart_item = mysqli_query($conn, $sql);
        $message[] = 'Deleted all from cart!';
    }
    
    if(isset($_POST['update_qty'])){
        $cart_id = $_POST['cart_id'];
        $qty = $_POST['qty'];
        $qty = filter_var($qty, FILTER_SANITIZE_STRING);
        $sql = "UPDATE cart SET quantity = '$qty' WHERE id = '$cart_id';";
        $delete_cart_item = mysqli_query($conn, $sql);
        $message[] = 'cart quantity updated';
    }
    $grand_total = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>

    <!-- custom css file link -->
    <link rel="stylesheet" href="./CSS/style.css">
</head>

<body>


    <!-- header section -->
    <?php include('components/user_header.php'); ?>
    
    
    
    
    
    
    <!-- heading -->
    <div class="heading">
        <h3>Shopping cart</h3>
        <p><a href="home.php">Home</a> <span> / Cart</span></p>
    </div>

    <!-- shopping cart section  -->
    <section class="products">
        
        <h1 class="title">Your cart</h1>
        
        <div class="box-container">
            
            <?php
                $grand_total = 0;
                $sql = "SELECT * FROM cart WHERE user_id = '$user_id';";
                $select_cart = mysqli_query($conn, $sql);
                $fetch_cart = mysqli_fetch_all($select_cart, MYSQLI_ASSOC);
                if(count($fetch_cart) > 0){
                    for($i = 0; $i < count($fetch_cart); $i++){
            ?>
            <form action="" method="post" class="box">
                <input type="hidden" name="cart_id" value="<?= $fetch_cart[$i]['id']; ?>">
                <button type="submit" class="fas fa-times" name="delete" onclick="return confirm('Delete this item?');"></button>
                <img src="uploaded_img/<?= $fetch_cart[$i]['image']; ?>" alt="">
                <div class="name"><?= $fetch_cart[$i]['name']; ?></div>
                <div class="flex">
                    <div class="price"><span>₹</span><?= $fetch_cart[$i]['price']; ?></div>
                    <input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetch_cart[$i]['quantity']; ?>" maxlength="2">
                    <button type="submit" class="fas fa-edit" name="update_qty"></button>
                </div>
                <div class="sub-total"> Sub total : <span>₹<?= $sub_total = ($fetch_cart[$i]['price'] * $fetch_cart[$i]['quantity']); ?>/-</span> </div>
            </form>
            <?php
                $grand_total += $sub_total;
                }
            }
            else{
                echo '<p class="empty">Your cart is empty</p>';
            }
            ?>
        </div>

        <div class="cart-total">
            <p>Cart total : <span>₹<?= $grand_total; ?></span></p>
            <a href="checkout.php" class="btn <?= ($grand_total > 0)?'':'disabled'; ?>">Proceed to checkout</a>
        </div>

        <div class="more-btn">
            <form action="" method="post">
            <button type="submit" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" name="delete_all" 
                onclick="return confirm('Delete all from cart?');">Delete All</button>
            </form>
            <a href="menu.php" class="btn">Continue shopping</a>
        </div>
    </section>
    <style>
        .delete-btn{
            border-radius: 10px;
        }
    </style>
    
    
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
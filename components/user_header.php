<?php
    if(isset($message)){
        foreach($message as $message){
            echo '<div class="message">
                    <span>'.$message.'</span>
                    <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div>';
        }
    }
?>

<header class="header">
    <section class="flex">
        <a href="home.php" class="logo"><b>Food Dash</b></a>

        <nav class="navbar">
            <a href="home.php"><b>Home</b></a>
            <a href="about.php"><b>About</b></a>
            <a href="menu.php"><b>Menu</b></a>
            <a href="orders.php"><b>Order</b></a>
            <a href="contact.php"><b>Contact</b></a>
        </nav>

        <div class="icons">
            <?php
                $sql = "SELECT * FROM cart WHERE user_id = '$user_id';";
                $count_user_cart_items = mysqli_query($conn, $sql);
                $count_user_cart_items = mysqli_fetch_all($count_user_cart_items, MYSQLI_ASSOC);
                $total_user_cart_items = count($count_user_cart_items);
            ?>
            <a href="search.php"><i class="fa-solid fa-magnifying-glass"></i></a>
            <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i><span>(<?= $total_user_cart_items; ?>)</span></a>
            <div id="user-btn" onclick="userBtnClickHandler()" class="fa-solid fa-user"></div>
            <div id="menu-btn" onclick="menuBtnClickHandler()" class="fa-solid fa-bars"></div>
        </div>

        <div class="profile">
            <?php
                $sql = "select * from users where id = '$user_id';";
                $select_profile = mysqli_query($conn, $sql);
                $fetch_profile = mysqli_fetch_all($select_profile, MYSQLI_ASSOC);
                if(count($fetch_profile) > 0){
            ?>
            <p class="name"><?= $fetch_profile[0]['name']; ?></p>
            <div class="flex">
                <a href="profile.php" class="btn">Profile</a>
                <a href="components/user_logout.php" onclick="return confirm('logout from this website?');"
                    class="delete-btn">Logout</a>
            </div>
            <!-- <p class="account"><a href="register.php">Register</a> or <a href="login.php">Login</a></p> -->
            <?php
                }
                else{
                ?>
            <p class='name'>Please login first</p>
            <a href="login.php" class="btn">Login</a>
            <?php
                }
                ?>
        </div>
    </section>
</header>
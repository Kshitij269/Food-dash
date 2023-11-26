<?php
    include('components/connection.php');

    session_start();

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }
    else{
        $user_id = '';
    }

    include 'components/add_cart.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>

    <!-- custom css file link -->
    <link rel="stylesheet" href="./CSS/style.css">
</head>

<body>


    <!-- header section -->
    <?php include('components/user_header.php'); ?>
    
    
    
    
    
    
    
    <!-- heading sectiion -->
    <div class="heading">
        <h3>our menu</h3>
        <p><a href="home.php">Home</a> <span> / Menu</span></p>
    </div>
    
    
    <!-- menu section  -->
<section class="products">

<h1 class="title">latest dishes</h1>

<div class="box-container">
    <?php
        $sql = "SELECT * FROM products;";
        $select_products = mysqli_query($conn, $sql);
        $fetch_products = mysqli_fetch_all($select_products, MYSQLI_ASSOC);
        if(count($fetch_products) > 0){
            for ($i = 0; $i < count($fetch_products); $i++) {
    ?>
    <form action="" method="post" class="box">
        <input type="hidden" name="pid" value="<?= $fetch_products[$i]['id']; ?>">
        <input type="hidden" name="name" value="<?= $fetch_products[$i]['name']; ?>">
        <input type="hidden" name="price" value="<?= $fetch_products[$i]['price']; ?>">
        <input type="hidden" name="image" value="<?= $fetch_products[$i]['image']; ?>">
        <button type="submit" class="fas fa-plus" name="add_to_cart"></button>
        <img src="uploaded_img/<?= $fetch_products[$i]['image']; ?>" alt="">
        <a href="category.php?category=<?= $fetch_products[$i]['category']; ?>" class="cat"><?= $fetch_products[$i]['category']; ?></a>
        <div class="name"><?= $fetch_products[$i]['name']; ?></div>
        <div class="flex">
        <div class="price"><span>&#8377;</span><?= $fetch_products[$i]['price']; ?></div>
        <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
        </div>
    </form>
    <?php
        }
    }else{
        echo '<p class="empty">no products added yet!</p>';
    }
    ?>
</div>
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
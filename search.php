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
    <title>Search Page</title>

    <!-- custom css file link -->
    <link rel="stylesheet" href="./CSS/style.css">
</head>

<body>


    <!-- header section -->
    <?php include('components/user_header.php'); ?>
    
    
    <!-- search form section  -->
    
    <section class="search-form">
        <form method="post" action="">
            <input type="text" name="search_box" required placeholder="Search here..." 
                maxlength="100" class="box">
            <button type="submit" name="search_btn" class="fas fa-search"></button>
        </form>
    </section>
    
    
    
<!-- home section -->
<section class="products" style="padding-top:0px; min-height:50vh;">

<div class="box-container">

    <?php
        if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
        $search_box = $_POST['search_box'];

        $sql = "SELECT * FROM products WHERE name LIKE '%{$search_box}%';";
        $select_products = mysqli_query($conn, $sql);
        $fetch_products = mysqli_fetch_all($select_products, MYSQLI_ASSOC);
        if(count($fetch_products) > 0){
            for($i = 0; $i < count($fetch_products); $i++){
    ?>
    <form action="" method="post" class="box">
        <input type="hidden" name="pid" value="<?= $fetch_products[$i]['id']; ?>">
        <input type="hidden" name="name" value="<?= $fetch_products[$i]['name']; ?>">
        <input type="hidden" name="price" value="<?= $fetch_products[$i]['price']; ?>">
        <input type="hidden" name="image" value="<?= $fetch_products[$i]['image']; ?>">
        <a href="quick_view.php?pid=<?= $fetch_products[$i]['id']; ?>" class="fas fa-eye"></a>
        <button type="submit" class="fas fa-cart-shopping" name="add_to_cart"></button>
        <img src="uploaded_img/<?= $fetch_products[$i]['image']; ?>" alt="">
        <a href="category.php?category=<?= $fetch_products[$i]['category']; ?>" class="cat"><?= $fetch_products[$i]['category']; ?></a>
        <div class="name"><?= $fetch_products[$i]['name']; ?></div>
        <div class="flex">
        <div class="price"><span>$</span><?= $fetch_products[$i]['price']; ?></div>
        <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
        </div>
    </form>
    <?php
        }
    }
    else{
        echo '<p class="empty">No products found!</p>';
    }
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
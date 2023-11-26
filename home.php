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
    <title>Home</title>

    <!-- cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- custom css file link -->
    <link rel="stylesheet" href="./CSS/style.css">
</head>

<body>
    <?php include('components/user_header.php'); ?>

    <!-- hero section -->
    <section class="hero">
        <div class="swiper hero-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide slide">
                    <div class="content">
                        <span>Order Online</span>
                        <h3>Delicious pizza</h3>
                        <a href="menu.php" class="btn">See more</a>
                    </div>
                    <div class="image">
                        <img src="./images/home-img-1.png" alt="Pizza">
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <div class="content">
                        <span>Order online</span>
                        <h3>Chessy burger</h3>
                        <a href="menu.php" class="btn">See more</a>
                    </div>
                    <div class="image">
                        <img src="./images/home-img-2.png" alt="Pizza">
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <div class="content">
                        <span>Order online</span>
                        <h3>Roasted chicken</h3>
                        <a href="menu.php" class="btn">See more</a>
                    </div>
                    <div class="image">
                        <img src="./images/home-img-3.png" alt="Pizza">
                    </div>
                </div>
                
                <div class="swiper-slide slide">
                    <div class="content">
                        <span>Order Online</span>
                        <h3>Delicious Salad</h3>
                        <a href="menu.php" class="btn">See more</a>
                    </div>
                    <div class="image">
                        <img src="./images/home-salad.jpeg" alt="Pizza">
                    </div>
                </div>


            </div>
            <div class="swiper-pagination"></div>
            <div style="display: none;" class="autoplay-progress">
                <svg viewBox="0 0 48 48"></svg>
                <span></span>
            </div>
        </div>
    </section>


    <!-- category section -->
    <section class="category">
        <h1 class="title">food category</h1>

        <div class="box-container">
            <a href="category.php?category=fast food" class="box">
                <img src="images/cat-1.png" alt="">
                <h3>fast food</h3>
            </a>

            <a href="category.php?category=main dish" class="box">
                <img src="images/cat-2.png" alt="">
                <h3>main dishes</h3>
            </a>

            <a href="category.php?category=drink" class="box">
                <img src="images/cat-3.png" alt="">
                <h3>drinks</h3>
            </a>

            <a href="category.php?category=dessert" class="box">
                <img src="images/cat-4.png" alt="">
                <h3>desserts</h3>
            </a>
        </div>
    </section>


    <!-- home section -->
    <section class="products">

    <h1 class="title">latest dishes</h1>

    <div class="box-container">

        <?php
            $sql = "SELECT * FROM `products` LIMIT 6;";
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
            <div class="price"><span>₹</span><?= $fetch_products[$i]['price']; ?></div>
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
    <div class="more-btn">
        <a href="menu.php" class="btn">Veiw All</a>
    </div>
    </section>





    <!-- footer section -->
    <footer class="footer">
        <div class="credits">&copy; copyrights 2023 by <span>Jugnu Gupta</span> | all rights reserved</div>
    </footer>


    <div class="loader">
        <img src="images/loader.gif" alt="">
    </div>



    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        const progressCircle = document.querySelector(".autoplay-progress svg");
        const progressContent = document.querySelector(".autoplay-progress span");
        var swiper = new Swiper(".hero-slider", {
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            on: {
                autoplayTimeLeft(s, time, progress) {
                    progressCircle.style.setProperty("--progress", 1 - progress);
                    progressContent.textContent = `${Math.ceil(time / 1000)}s`;
                }
            }
        });
    </script>

    <!-- font awesome link -->
    <script src="https://kit.fontawesome.com/848e0df24d.js" crossorigin="anonymous"></script>

    <!-- custom js file link -->
    <script src="./JS/script.js"></script>
</body>

</html>
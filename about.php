<?php
include('components/connection.php');

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>

    <!-- cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- custom css file link -->
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body>


    <!-- header section -->
    <?php include('components/user_header.php'); ?>


    <!-- heading section -->
    <div class="heading">
        <h3>about us</h3>
        <p><a href="home.php">Home</a> <span> / About</span></p>
    </div>


    <!-- about section -->

    <section class="about">

        <div class="row">

            <div class="image">
                <img src="images/about-img.svg" alt="">
            </div>

            <div class="content">
                <h3>Why choose us?</h3>
                <p>At Food dash, we invite you to indulge in an unparalleled dining experience marked by excellence at
                    every turn. Our commitment to culinary mastery is evident in each dish, meticulously crafted with
                    passion and flair. The ambiance is a harmonious fusion of modern elegance and warm hospitality,
                    creating the perfect backdrop for intimate gatherings and celebrations. We take pride in our
                    dedication to using fresh, locally-sourced ingredients, ensuring a farm-to-table experience that is
                    both flavorful and sustainable. What sets us apart is not just our innovative menu, evolving with
                    culinary trends, but also our unwavering dedication to personalized service. Every visit is a
                    bespoke culinary journey, tailored to your preferences. Beyond the dining table, we are champions of
                    sustainability, from eco-friendly practices to minimizing food waste. Elevate your special occasions
                    with our expert event planning and catering services, creating moments that linger on the palate and
                    in memory. Don't just dine; join a community that celebrates exceptional culinary experiences at
                    Food dash.</p>
                <a href="menu.php" class="btn">Our Menu</a>
            </div>

        </div>

    </section>


    <!-- steps section  -->
    <style>
        .title {
            background-color: #fed330;
            padding: 5px 5px;
            border-radius: 5px;
        }

        .box {
            border: black 5px solid;
        }

        .box:hover {
            transform: scale(0.8);
        }
    </style>

    <section class="steps">
        <h1 class="title">simple steps</h1>
        <div class="box-container">

            <div class="box">
                <img src="images/step-1.png" alt="">
                <h3>Choose order</h3>
            </div>

            <div class="box">
                <img src="images/step-2.png" alt="">
                <h3>Fast delivery</h3>
            </div>

            <div class="box">
                <img src="images/step-3.png" alt="">
                <h3>Enjoy food</h3>
            </div>

        </div>

    </section>


    <!-- reviews section  -->
    <section class="reviews">

        <h1 class="title">Customer's reviews</h1>

        <div class="swiper reviews-slider">

            <div class="swiper-wrapper">

                <div class="swiper-slide slide">
                    <img src="images/pic-1.png" alt="">
                    <h3>john deo</h3>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p>"Who knew flavor could have a party in my mouth? Dining at Food Dash was like a culinary
                        adventure! The menu is a treasure map, and every dish is a delicious discovery. I'm still
                        dreaming about the unexpected combinations. Bravo!"</p>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/pic-2.png" alt="">
                    <h3>john deo</h3>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p>"I don't usually write reviews, but Food Dash deserves a standing ovation. The staff treated us
                        like royalty, and the food was a symphony of taste. It's official; I'm their number one fan.
                        Can't wait to bring all my friends here!"</p>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/pic-4.png" alt="">
                    <h3>john deo</h3>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p>"Food Dash is my happy place. The food is so good; I almost wanted to order a second stomach.
                        From the first bite to the last, every flavor danced on my taste buds. And the desserts? Pure
                        joy on a plate!"</p>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/pic-5.png" alt="">
                    <h3>john deo</h3>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p>"I've decided to move into Food Dash. I mean, why not? The staff is like a bunch of culinary
                        wizards, and the atmosphere is so cozy. I asked for recommendations, and they practically
                        created a personalized menu just for me. Can't wait to go back!"</p>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/pic-6.png" alt="">
                    <h3>john deo</h3>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p>"As a self-proclaimed food critic (in my own kitchen), Food Dash passed my rigorous standards
                        with flying colors. The attention to detail, the presentation, the flavors—every element is a
                        work of culinary art. Highly recommend!"</p>
                </div>

            </div>

            <div class="swiper-pagination"></div>

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
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".reviews-slider", {
            loop: true,
            grabCursor: true,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                700: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    </script>

    <!-- font awesome cdn link -->
    <script src="https://kit.fontawesome.com/848e0df24d.js" crossorigin="anonymous"></script>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>
</body>

</html>
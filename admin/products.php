<?php

include '../components/connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $sql = "SELECT * FROM products WHERE name = '$name'";
   $select_products = mysqli_query($conn, $sql);
   $fetch_products = mysqli_fetch_all($select_products, MYSQLI_ASSOC);
   
   if(count($fetch_products) > 0){
      $message[] = 'Product name already exists!';
   }else{
      if($image_size > 2000000){
         $message[] = 'Image size is too large';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);
         
         $sql = "INSERT INTO products(name, category, price, image) VALUES('$name', '$category', '$price', '$image')";
         $insert_product = mysqli_query($conn, $sql);
         
         $message[] = 'New product added!';
      }
   }
   
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];

   $sql = "SELECT * FROM products WHERE id = '$delete_id'";
   $delete_product_image = mysqli_query($conn, $sql);
   $fetch_delete_image = mysqli_fetch_all($delete_product_image, MYSQLI_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image[0]['image']);

   $sql = "DELETE FROM products WHERE id = '$delete_id';";
   $delete_product = mysqli_query($conn, $sql);

   $sql = "DELETE FROM cart WHERE pid = '$delete_id';";
   $delete_product = mysqli_query($conn, $sql);
   header('location:products.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- add products section starts-->
<section class="add-products">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>add product</h3>
      <input type="text" required placeholder="Enter product name" name="name" maxlength="100" class="box">
      <input type="number" min="0" max="9999999999" required placeholder="Enter product price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box">
      <select name="category" class="box" required>
         <option value="" disabled selected>Select category --</option>
         <option value="main dish">Main dish</option>
         <option value="fast food">Fast food</option>
         <option value="drinks">Drinks</option>
         <option value="desserts">Desserts</option>
      </select>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
      <input type="submit" value="add product" name="add_product" class="btn">
   </form>

</section>


<!-- show products section  -->
<section class="show-products" style="padding-top: 0;">

   <div class="box-container">

   <?php
      $sql = "SELECT * FROM products;";
      $show_products = mysqli_query($conn, $sql);
      $fetch_products = mysqli_fetch_all($show_products, MYSQLI_ASSOC);
      if(count($fetch_products) > 0){
         for($i = 0; $i < count($fetch_products); $i++){  
   ?>
   <div class="box">
      <img src="../uploaded_img/<?= $fetch_products[$i]['image']; ?>" alt="">
      <div class="flex">
         <div class="price"><span>&#8377;</span><?= $fetch_products[$i]['price']; ?><span>/-</span></div>
         <div class="category"><?= $fetch_products[$i]['category']; ?></div>
      </div>
      <div class="name"><?= $fetch_products[$i]['name']; ?></div>
      <div class="flex-btn">
         <a href="update_product.php?update=<?= $fetch_products[$i]['id']; ?>" class="option-btn">update</a>
         <a href="products.php?delete=<?= $fetch_products[$i]['id']; ?>" class="delete-btn" onclick="return confirm('Delete this product?');">Delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">No products added yet!</p>';
      }
   ?>
   </div>
</section>





<!-- font awesome link -->
<script src="https://kit.fontawesome.com/848e0df24d.js" crossorigin="anonymous"></script>


<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>
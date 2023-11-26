<?php

include '../components/connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);

   $sql = "UPDATE `products` SET name = '$name', category = '$category', price = '$price' WHERE id = '$pid'";
   $update_product = mysqli_query($conn, $sql);

   $message[] = 'product updated!';

   $old_image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'images size is too large!';
      }else{
         $sql = "UPDATE `products` SET image = '$image' WHERE id = '$pid'";
         $update_image = mysqli_query($conn, $sql);

         move_uploaded_file($image_tmp_name, $image_folder);
         unlink('../uploaded_img/'.$old_image);
         $message[] = 'image updated!';
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
   <title>update product</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- update product section  -->

<section class="update-product">

   <h1 class="heading">Update product</h1>

   <?php
      $update_id = $_GET['update'];
      $sql = "SELECT * FROM products WHERE id = '$update_id';";
      $show_products = mysqli_query($conn, $sql);
      $fetch_products = mysqli_fetch_all($show_products, MYSQLI_ASSOC);
      if(count($fetch_products) > 0){
         for($i = 0; $i < count($fetch_products); $i++){  
   ?>
   <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="pid" value="<?= $fetch_products[$i]['id']; ?>">
      <input type="hidden" name="old_image" value="<?= $fetch_products[$i]['image']; ?>">
      <img src="../uploaded_img/<?= $fetch_products[$i]['image']; ?>" alt="">
      <span>Update name</span>
      <input type="text" required placeholder="enter product name" name="name" maxlength="100" class="box" value="<?= $fetch_products[$i]['name']; ?>">
      <span>Update price</span>
      <input type="number" min="0" max="9999999999" required placeholder="enter product price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box" value="<?= $fetch_products[$i]['price']; ?>">
      <span>Update category</span>
      <select name="category" class="box" required>
         <option selected value="<?= $fetch_products[$i]['category']; ?>"><?= $fetch_products[$i]['category']; ?></option>
         <option value="main dish">main dish</option>
         <option value="fast food">fast food</option>
         <option value="drinks">drinks</option>
         <option value="desserts">desserts</option>
      </select>
      <span>Update image</span>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
      <div class="flex-btn">
         <input type="submit" value="update" class="btn" name="update">
         <a href="products.php" class="option-btn">go back</a>
      </div>
   </form>
   <?php
         }
      }
      else{
         echo '<p class="empty">No products added yet!</p>';
      }
   ?>

</section>





<!-- font awesome link -->
<script src="https://kit.fontawesome.com/848e0df24d.js" crossorigin="anonymous"></script>


<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>
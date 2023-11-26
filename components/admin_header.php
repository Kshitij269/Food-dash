<?php
if (isset($message)) {
   foreach ($message as $message) {
      echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
<style>
   .h1f{
      font-size: 3rem;
   }
</style>

<header class="header">

   <section class="flex">

      <h1 class="h1f">Food Dash</h1>

      <nav class="navbar">
         <a href="dashboard.php">Home</a>
         <a href="products.php">Products</a>
         <a href="placed_orders.php">Orders</a>
         <a href="users_accounts.php">Users</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
         $sql = "SELECT * FROM admin WHERE id = '$admin_id';";
         $select_profile = mysqli_query($conn, $sql);
         $fetch_profile = mysqli_fetch_all($select_profile, MYSQLI_ASSOC);
         ?>
         <p>
            <?= $fetch_profile[0]['name']; ?>
         </p>
         <div class="flex-btn">
            <a href="admin_login.php" class="option-btn">Login</a>
         </div>
         <a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');"
            class="delete-btn">Logout</a>
      </div>

   </section>

</header>
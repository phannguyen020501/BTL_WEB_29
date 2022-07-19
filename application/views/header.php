<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <!-- <div class="header-1">
      <div class="flex">
         <div class="share">
            <i href="#"  class="fa-light fa-book-open-cover"></i>
          
         </div>
         <p> <a href="login.php">Đăng nhập</a> | <a href="register.php">Đăng ký</a> </p>
      </div>
   </div> -->

   <div class="header-2">
      <div class="flex">
         <a href="home.php" class="logo">Book Store</a>

         <nav class="navbar">
            <a href="home.php">Trang chủ</a>
            <a href="about.php">Thông tin</a>
            <a href="shop.php">Cửa hàng</a>
            <a href="contact.php">Phản hồi</a>
            <a href="order.php">Đặt sách</a>
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
               require_once 'C:\xampp\htdocs\BTL_WEB_29\services\CartServices.php';
               $cartservice = new CartServices();

               $select_cart_number = $cartservice->get($user_id);
               $cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?>
            <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
         </div>

         <div class="user-box">
            <p>Tên người dùng : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>Email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            
            <a href="profile.php" class="option-btn">Tài khoản</a>
            <a href="logout.php" class="delete-btn">Đăng xuất</a>
         </div>
      </div>
   </div>

   <link rel="stylesheet" href="public/css/header.css">
   
   <script src="../../public/js/script.js"></script>
</header>
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

   <div class="flex">

      <a href="admin_page.php" class="logo">Admin</a>

      <nav class="navbar">
         <a href="admin_page.php">Trang chủ</a>
         <a href="admin_products.php">Sản phẩm</a>
         <a href="admin_orders.php">Đặt sách</a>
         <a href="admin_users.php">Người dùng</a>
         <a href="admin_contacts.php">Phản hồi</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>Tên : <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>Email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logout.php" class="delete-btn">Đăng xuất</a>
         <div> <a href="login.php">Đăng nhập</a> | <a href="register.php">Đăng ký</a></div>
      </div>

   </div>
   <link rel="stylesheet" href="../../public/css/admin_header.css">

</header>
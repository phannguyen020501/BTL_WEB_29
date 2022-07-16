<?php


session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="../../public/css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="title">Thống kê</h1>

   <div class="box-container">

      <div class="box">
         <?php
            $total_pendings = 0;
            require_once '../../services/OrderServices.php';
            $services = new OrderServices();
            $select_pending = $services->getTotalPrice("pending");

            if(mysqli_num_rows($select_pending) > 0){
               while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
                  $total_price = $fetch_pendings['total_price'];
                  $total_pendings += $total_price;
               };
            };
         ?>
         <h3>$<?php echo $total_pendings; ?>/-</h3>
         <p>Đang xử lý</p>
      </div>

      <div class="box">
         <?php
            require_once '../../services/OrderServices.php';
            $total_completed = 0;
            $services = new OrderServices();
            $select_completed = $services->getTotalPrice("completed");
            if(mysqli_num_rows($select_completed) > 0){
               while($fetch_completed = mysqli_fetch_assoc($select_completed)){
                  $total_price = $fetch_completed['total_price'];
                  $total_completed += $total_price;
               };
            };
         ?>
         <h3>$<?php echo $total_completed; ?>/-</h3>
         <p>Đã thanh toán</p>
      </div>

      <div class="box">
         <?php
            require_once '../../services/OrderServices.php';
            $services = new OrderServices();
            $select_orders = $services->getAll();
            $number_of_orders = mysqli_num_rows($select_orders);
         ?>
         <h3><?php echo $number_of_orders; ?></h3>
         <p>Đơn đặt hàng</p>
      </div>

      <div class="box">
         <?php 
            require_once '../../services/ProductServices.php';
            $products = new ProductServices();
            $select_products = $products->getAll(); 
            $number_of_products = mysqli_num_rows($select_products);
         ?>
         <h3><?php echo $number_of_products; ?></h3>
         <p>Sách đã thêm</p>
      </div>

      <div class="box">
         <?php 
            require_once '../../services/UserServices.php';
            $users = new UserServices();
            $select_users = $users->getAllByType("user");
            $number_of_users = mysqli_num_rows($select_users);
         ?>
         <h3><?php echo $number_of_users; ?></h3>
         <p>Người dùng</p>
      </div>

      <div class="box">
         <?php 
            require_once '../../services/ProductServices.php';
            $admins = new UserServices();
            $select_admins = $admins->getAllByType("admin");
            $number_of_admins = mysqli_num_rows($select_admins);
         ?>
         <h3><?php echo $number_of_admins; ?></h3>
         <p>Admin</p>
      </div>

      <div class="box">
         <?php 
            require_once '../../services/ProductServices.php';
            $accounts = new UserServices();
            $select_account = $accounts->getAll();
            $number_of_account = mysqli_num_rows($select_account);
         ?>
         <h3><?php echo $number_of_account; ?></h3>
         <p>Tổng số tài khoản</p>
      </div>

      <div class="box">
         <?php 
            require_once '../../services/MessageServices.php';
            $messages = new MessageServices();
            $select_messages = $messages->getAll();
            $number_of_messages = mysqli_num_rows($select_messages);
         ?>
         <h3><?php echo $number_of_messages; ?></h3>
         <p>Phản hồi mới</p>
      </div>

   </div>

</section>

<!-- admin dashboard section ends -->





<!-- custom admin js file link  -->
<script src="../../public/js/admin_script.js"></script>

</body>
</html>
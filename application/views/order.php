<?php

require_once 'C:\xampp\htdocs\BTL_WEB_29\config\config.php';
require_once 'C:\xampp\htdocs\BTL_WEB_29\services\OrderServices.php';
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đặt hàng</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="public/css/order.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Đơn hàng</h3>
</div>

<section class="placed-orders">

   <h1 class="title">Thông tin đặt hàng</h1>

   <div class="box-container">

      <?php
      
      require_once 'C:\xampp\htdocs\BTL_WEB_29\services\OrderServices.php';
      $orderServices = new OrderServices();
      $countOrders = $orderServices->getCountIdByUserId($user_id);
      $row = mysqli_fetch_assoc($countOrders);
      $total_records = $row['total'];

      $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
      $limit = 4;

      $total_page = ceil($total_records/$limit);
      if($current_page > $total_page){
         $current_page = $total_page;
      }
      else if($current_page<1){
         $current_page = 1;
      }

      $start = ($current_page - 1)*$limit;
      if($start<0){
         $start=0;
      }
      $result = $orderServices->getOrderByStartUser($start,$limit,$user_id);

      $services = new OrderServices();
      $select_orders = $services->getAll();


      $orderService = new OrderServices();
      $order_query = $orderService->getFromID($user_id); 

      if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($result)){
      ?>
      <div class="box">
         <p> Ngày đặt hàng : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> Tên  : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> Số điện thoại : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> Địa chỉ : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> Phương thức thanh toán : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <p> Sản phẩm : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> Tổng giá: <span><?php echo $fetch_orders['total_price']; ?> VND</span> </p>
         <p> Trạng thái: <span style="color:<?php if($fetch_orders['payment_status'] ==  'pending' || $fetch_orders['payment_status'] =='Chờ xác nhận'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>
         </div>
      <?php
       }
      }else{
         echo '<p class="empty">Không có sản phẩm yêu cầu!</p>';
      }
      ?>
   </div>

   <div style="text-align:center; font-size:2rem;">
   <?php
   if($current_page > 1 && $total_page > 1){
      echo '<a href="order.php&page=' .($current_page-1).'">Prev</a> | ';
   }
   for($i=1;$i<=$total_page;$i++){
      if($i == $current_page){
         echo '<span>'.$i.'</span> | ';
      }else{
         echo '<a href="order.php&page='.($i).'">'.$i.'</a> | ';
      }
   }
   if($current_page < $total_page&&$total_page >1){
      echo '<a href = "order.php&page='.($current_page+1).'">Next</a> |';
   }
   ?>
   </div>

</section>


<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="public/js/script.js"></script>

</body>
</html>
<?php

require_once 'C:\xampp\htdocs\BTL_WEB_29\config\config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['update_order'])){
   require_once 'C:\xampp\htdocs\BTL_WEB_29\services\OrderServices.php';
   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   
   $orderServices = new OrderServices();
   $orderServices->update($update_payment,$order_update_id);
   $message[] = 'Cập nhập trạng thái thành công!';

}

if(isset($_GET['delete'])){
   require_once 'C:\xampp\htdocs\BTL_WEB_29\services\OrderServices.php';
   $delete_id = $_GET['delete'];
   
   $orderServices = new OrderServices();
   $orderServices->delete($delete_id);
   header('location:admin_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đặt sách</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="public/css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="orders">

   <h1 class="title">Đặt sách</h1>

   <div class="box-container">
      <?php
      require_once 'C:\xampp\htdocs\BTL_WEB_29\services\OrderServices.php';
      $services = new OrderServices();
      $select_orders = $services->getAll();
      if(mysqli_num_rows($select_orders) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
      <div class="box">
         <p> Id: <span><?php echo $fetch_orders['user_id']; ?></span> </p>
         <p> Thời gian đặt sách : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> Tên : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> Số điện thoại : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> Địa chỉ : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> Tổng số lượng : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> Tổng giá : <span>$<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
         <p> Phương thức thanh toán : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <form action="" method="post">
            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
            <select name="update_payment">
               <!-- <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option> -->
               <option value="pending">Đang chờ xác nhận</option>
               <option value="completed">Đã xác nhận</option>
            </select>
            <input type="submit" value="Cập nhập" name="update_order" class="option-btn">
            <a href="admin_orders.php&delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('Bạn chắc chắn xóa sản phẩm này?');" class="delete-btn">Xóa</a>
         </form>
      </div>
      <?php 
         }
      }else{
         echo '<p class="empty">Không thể đặt sách!</p>';
      }
      ?>
   </div>

</section>




<!-- custom admin js file link  -->
<script src="public/js/admin_script.js"></script>

</body>
</html>
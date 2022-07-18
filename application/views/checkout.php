<?php

session_start();

$user_id = $_SESSION['user_id'];
require_once '../../services/CartServices.php';
require_once '../../services/OrderServices.php';
require_once '../models/Order.php';
$cartservice = new CartServices();
$orderservice = new OrderServices();

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, 'Số nhà '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = $cartservice->get($user_id);
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }
   require_once '../../services/ProductServices.php';
   require_once '../../services/OrderServices.php';
   $total_products = implode(', ',$cart_products);

   $order_query= $orderservice->getProductsss($name,$number,$email,$method,$address,$total_products,$cart_total);

   //$order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

   if($cart_total == 0){
      $message[] = 'Giỏ hàng trống';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'Giỏ hàng đã được thêm'; 
      }else{
         $order = new Order($user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on);
         $orderservice->insert($order);
         $cart_query1 = $cartservice->get($user_id);
         while($cart_item = mysqli_fetch_assoc($cart_query1)){
            $productServices = new ProductServices();
            $producti = $productServices->getFromName($cart_item['name']);
            $product1 = mysqli_fetch_assoc($producti);
            $quantityProduct = $product1['availability'];
            $updateAvailability = $quantityProduct - $cart_item['quantity'];
            // echo $updateAvailability;
            $productServices->updateAvailability($updateAvailability,$product1['id']);
         }
         $cartservice->deleteAll($user_id);
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
   <title>Đặt hàng</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../../public/css/checkout.css">
   <link rel="stylesheet" href="../../public/css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>checkout</h3>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = $cartservice->get($user_id);
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <!-- <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo '$'.$fetch_cart['price'].'/-'.' x '. $fetch_cart['quantity']; ?>)</span> </p> -->
   <?php
      }
   }else{
      echo '<p class="empty">Giỏ hàng trống</p>';
   }
   ?>
   <div class="grand-total"> Tổng: <span>$<?php echo $grand_total; ?>/-</span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3>Thông tin đặt hàng</h3>
      <div class="flex">
         <div class="inputBox">
            <span>Tên:</span>
            <input type="text" name="name" value="<?php echo $_SESSION['user_name']; ?>" required placeholder="Tên">
         </div>
         <div class="inputBox">
            <span>Số điện thoại:</span>
            <input type="number" name="number" value="<?php echo $_SESSION['user_phone']; ?>" required placeholder="Số điện thoại">
         </div>
         <div class="inputBox">
            <span>Email:</span>
            <input type="email" name="email" value="<?php echo $_SESSION['user_email']; ?>" required placeholder="Email">
         </div>
         <div class="inputBox">
            <span>Phương thức thanh toán:</span>
            <select name="method">
               <option value="cash on delivery">Thanh toán sau khi nhận hàng</option>
               <option value="credit card">Thanh toán thẻ</option>
               <option value="paypal">Paypal</option>
               <option value="paytm">Paytm</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Số nhà:</span>
            <input type="number" min="0" name="flat" required placeholder="Số nhà.">
         </div>

         <div class="inputBox">
            <span>Tên đường:</span>
            <input type="text" name="street" required placeholder="Tên đường">
         </div>
         <div class="inputBox">
            <span>Quận/Huyện: </span>
            <input type="text" name="city" required placeholder="Quận/Huyện">
         </div>
         <div class="inputBox">
            <span>Tỉnh/Thành phố: </span>
            <input type="text" name="state" required placeholder="Tỉnh/Thành phố">
         </div>
         <div class="inputBox">
            <span>Quốc gia:</span>
            <input type="text" name="country" required placeholder="Quốc gia">
         </div>
         <div class="inputBox">
            <span>Pin code:</span>
            <input type="number" min="0" name="pin_code" required placeholder="Pin code">
         </div>
      </div>
      <input type="submit" value="Đặt hàng ngay" class="btn" name="order_btn">
   </form>

</section>









<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="../../public/js/script.js"></script>

</body>
</html>
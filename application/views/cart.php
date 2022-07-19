<?php

require 'C:\xampp\htdocs\BTL_WEB_29\services\CartServices.php';

session_start();

$user_id = $_SESSION['user_id'];

$cartservice = new CartServices();

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['update_cart'])){
   $cart_id = $_POST['cart_id'];
   $cart_quantity = $_POST['cart_quantity'];

   $cartservice->update($cart_id, $cart_quantity);
   $message[] = 'Cập nhập số lượng!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $cartservice->delete($delete_id);
   header('location:cart.php');
}

if(isset($_GET['delete_all'])){
   $cartservice->deleteAll($user_id);
   header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="public/css/cart.css">
   <link rel="stylesheet" href="public/css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Giỏ hàng</h3>
</div>

<section class="shopping-cart">

   <h1 class="title">Sách đã thêm</h1>

   <div class="box-container">
      <?php
         $grand_total = 0;
         $select_cart = $cartservice->get($user_id);
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){   
      ?>
      <div class="box">
         <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('Xóa sách?');"></a>
         <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_cart['name']; ?></div>
         <div class="price"><?php echo $fetch_cart['price']; ?> VND</div>
         <form action="" method="post">
            <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
            <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
            <input type="submit" name="update_cart" value="Cập nhật" class="option-btn">
         </form>
         <div class="sub-total"> Tổng giá : <span><?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']); ?> VND</span> </div>
      </div>
      <?php
      $grand_total += $sub_total;
         }
      }else{
         echo '<p class="empty">Giỏ hàng trống</p>';
      }
      ?>
   </div>

   <div style="margin-top: 2rem; text-align:center;">
      <a href="cart.php?delete_all=<?php echo 1; ?>" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('Xóa tất cả sách?');">Xác nhận xóa</a>
   </div>

   <div class="cart-total">
      <p>Tổng đơn hàng : <span><?php echo $grand_total; ?> VND</span></p>
      <div class="flex">
         <a href="shop.php" class="option-btn">Tiếp tục mua sắm</a>
         <a href="checkout.php" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Điền thông tin đơn hàng</a>
      </div>
   </div>

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="public/js/script.js"></script>

</body>
</html>
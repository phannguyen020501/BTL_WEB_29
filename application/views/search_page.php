<?php

include 'C:\xampp\htdocs\BTL_WEB_29\config\config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   require_once 'C:\xampp\htdocs\BTL_WEB_29\services\CartServices.php';

   $searchService = new CartServices();
   $check_cart_numbers = $searchService->getNameID($product_name,$user_id);

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'Sản phẩm đã có trong giỏ hàng';
   }else{

      $searchService->insertProductToCart($user_id, $product_name, $product_price, $product_quantity, $product_image);
      $message[] = 'Đã thêm vào giỏ hàng';
   }

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Trang tìm kiếm</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="public/css/search_page.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Tìm kiếm</h3>
</div>

<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search" placeholder="Tìm sách.." class="box" onkeyup="myFunction()">
      <input type="submit" name="submit" value="Tìm kiếm" class="btn">
   </form>
</section>

<script>
function myFunction() {
   
}
</script>

<section class="products" style="padding-top: 0;">

   <div class="box-container">
   <?php
      if(isset($_POST['submit'])){
         $search_item = $_POST['search'];
         $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%{$search_item}%'") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
   ?>

   <form action="" method="post" class="box">
      <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="" class="image">
      <div class="name"><?php echo $fetch_product['name']; ?></div>
      <div class="price"><?php echo $fetch_product['price']; ?> VND</div>
      <input type="number"  class="qty" name="product_quantity" min="1" value="1">
      <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
      <input type="submit" class="btn" value="add to cart" name="add_to_cart">
   </form>
   <?php
            }
         }else{
            echo '<p class="empty">Không tìm thấy sách yêu cầu</p>';
         }
      }else{
         echo '<p class="empty">Tìm kiếm </p>';
      }
   ?>
   </div>
  

</section>






<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="public/js/script.js"></script>

</body>
</html>
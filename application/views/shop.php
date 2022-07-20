<?php

include 'C:\xampp\htdocs\BTL_WEB_29\config\config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   require_once 'C:\xampp\htdocs\BTL_WEB_29\services\CartServices.php';
   require_once 'C:\xampp\htdocs\BTL_WEB_29\services\ProductServices.php';
   $searchService = new CartServices();
   $check_cart_numbers = $searchService->getNameID($product_name,$user_id);

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'Sản phẩm đã có trong giỏ hàng!';
   }else{

      $searchService->insertProductToCart($user_id, $product_name, $product_price, $product_quantity, $product_image);
      $message[] = 'Sản phẩm thêm vào giỏ hàng thành công!';
   }
   

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cửa hàng</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="public/css/shop.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Cửa hàng</h3>
</div>

<section class="products">

   <h1 class="title">Sản phẩm mới nhất</h1>

   <div class="box-container">

      <?php  
         require_once 'C:\xampp\htdocs\BTL_WEB_29\services\ProductServices.php';
         $productServices = new ProductServices();
         $countProducts = $productServices->getCountId();
         $row = mysqli_fetch_assoc($countProducts);
         $total_records = $row['total'];
      
         $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
         $limit = 6;
      
         $total_page = ceil($total_records/$limit);
         if($current_page > $total_page){
            $current_page = $total_page;
         }
         else if($current_page<1){
            $current_page = 1;
         }
      
         $start = ($current_page - 1)*$limit;
         $result = $productServices->getProduct($start,$limit);
         
         $select = new ProductServices();
         $select_products = $select ->getAll();
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($result)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="public/uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price"><?php echo $fetch_products['price']; ?> VND</div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="Thêm vào giỏ hàng" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">Không có sách yêu cầu!!</p>';
      }
      ?>
   </div>
   <div style="text-align:center; font-size:2rem;">
   <?php
   if($current_page > 1 && $total_page > 1){
      echo '<a href="shop.php&page=' .($current_page-1).'">Prev</a> | ';
   }
   for($i=1;$i<=$total_page;$i++){
      if($i == $current_page){
         echo '<span>'.$i.'</span> | ';
      }else{
         echo '<a href="shop.php&page='.($i).'">'.$i.'</a> | ';
      }
   }
   if($current_page < $total_page&&$total_page >1){
      echo '<a href = "shop.php&page='.($current_page+1).'">Next</a> |';
   }
   ?>
   </div>

</section>






<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="public/js/script.js"></script>

</body>
</html>
<?php

require_once 'C:\xampp\htdocs\BTL_WEB_29\config\config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}
require_once 'C:\xampp\htdocs\BTL_WEB_29\services\ProductServices.php';
require_once 'C:\xampp\htdocs\BTL_WEB_29\services\CartServices.php';

$idProduct =  $_GET['id'];

$productServices = new ProductServices();
$product = $productServices->getFromID($idProduct);
$fetch_products = mysqli_fetch_assoc($product);


if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];
   if($product_quantity > $fetch_products['availability']){
      $message[] = 'Không còn đủ số lượng';
   }else{


   $cartservice = new CartServices();
   $check_cart_numbers = $cartservice->getByIdAndName($product_name, $user_id);

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'Đã thêm vào giỏ hàng';
   }else{
      
      $cartservice->addCart($user_id,$product_name,$product_price,$product_quantity,$product_image);
      $message[] = 'Sách đã thêm!';
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
   <title>Chi tiết sản phẩm</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="public/css/book_detail.css">

</head>
<body>
<?php include 'header.php'; ?>
<div class = "card-wrapper">
  <div class = "card">
    <!-- card left -->
    <div class = "product-imgs">
      <div class = "img-display">
        <div class = "img-showcase">

          <img src = "uploaded_img/<?php echo $fetch_products['image'];?>" alt = "shoe image" >
          <img src = "uploaded_img/<?php echo $fetch_products['image'];?>" alt = "shoe image">
          <img src = "uploaded_img/<?php echo $fetch_products['image'];?>" alt = "shoe image">
          <img src = "uploaded_img/<?php echo $fetch_products['image'];?>" alt = "shoe image">

        </div>
      </div>
      <div class = "img-select">
        <div class = "img-item">
          <a href = "#" data-id = "1">
            <img src = "public/uploaded_img/<?php echo $fetch_products['image'];?>"  alt = "shoe image" style="width:130px; height:125px">
          </a>
        </div>
        <div class = "img-item">
          <a href = "#" data-id = "2">
            <img src = "public/uploaded_img/<?php echo $fetch_products['image'];?>"  alt = "shoe image" style="width:130px; height:125px">
          </a>
        </div>
        <div class = "img-item">
          <a href = "#" data-id = "3">
            <img src = "public/uploaded_img/<?php echo $fetch_products['image'];?>"  alt = "shoe image" style="width:130px; height:125px">
          </a>
        </div>
        <div class = "img-item">
          <a href = "#" data-id = "4">
            <img src = "public/uploaded_img/<?php echo $fetch_products['image'];?>"  alt = "shoe image" style="width:130px; height:125px">
          </a>
        </div>
      </div>
    </div>
    <!-- card right -->
    <div class = "product-content">
      <h2 class = "product-title"><?php echo $fetch_products['name']; ?></h2>
      <div class style="font-size:2rem;" = "product-rating">
        <i class = "fas fa-star"></i>
        <i class = "fas fa-star"></i>
        <i class = "fas fa-star"></i>
        <i class = "fas fa-star"></i>
        <i class = "fas fa-star-half-alt"></i>
        <span>4.7(21)</span>
      </div>

      <div class = "product-price">
        <p style="font-size:2rem; class = "new-price">Giá: <span style="font-size:2rem;"><?php echo $fetch_products['price'];?> VND</span></p>
      </div>

      <div class = "product-detail">
        <h2 style="font-size: 3rem;">Mô tả: </h2>
        <p  style="font-size: 1.5rem;"><?php echo $fetch_products['summary']; ?>;</p>
        <ul>
          <li style="font-size: 1.5rem;">Tác giả: <span style="font-size: 1.5rem;"><?php echo $fetch_products['author']; ?></span></li>
          <li style="font-size: 1.5rem;">Số lượng còn lại: <span style="font-size: 1.5rem;"><?php echo $fetch_products['availability']; ?></span></li>
          <li style="font-size: 1.5rem;">Thể Loại: <span style="font-size: 1.5rem;"><?php echo $fetch_products['category']; ?></span></li>
          <li style="font-size: 1.5rem;">Nhà xuất bản: <span style="font-size: 1.5rem;"><?php echo $fetch_products['publisher']; ?></span></li>
          <li style="font-size: 1.5rem;">Năm xuất bản: <span style="font-size: 1.5rem;"><?php echo $fetch_products['year']; ?></span></li>
        </ul>
      </div>

      <div class = "purchase-info">
      <form action="" method="post" class="box">
      <input type ="number" name="product_quantity" min = "0" value = "1">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <!--<input type="submit" value="Thêm vào giỏ hàng" name="add_to_cart" class="btn">-->

        <button type="submit" class = "btn" name="add_to_cart" value="Thêm vào giỏ hàng">
          Thêm vào giỏ hàng <i class = "fas fa-shopping-cart"></i></button>
        </input>
        </form>
      </div>

    </div>
  </div>
</div>


<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="public/js/book_detail.js"></script>

</body>
</html>
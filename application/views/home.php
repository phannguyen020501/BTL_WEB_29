<?php

include '../../config/config.php';
include '../../services/CartServices.php';
include '../../services/ProductServices.php';

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

   //$check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   $cartservice = new CartServices();
   $check_cart_numbers = $cartservice->getByIdAndName($product_name, $user_id);
    $fetch_product = mysqli_fetch_assoc($check_cart_numbers);

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'Đã thêm vào giỏ hàng';
   }else{
      
      //mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      if($product_quantity > $fetch_product['availability']){
         $message[] = 'Vượt quá số lượng sách hiện có';
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
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../../public/css/home.css" >

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="home">

   <div class="content">
      <h3>Một cuốn sách là một giấc mơ mà bạn cầm trong tay. </h3>
      <!-- <p>Sách là kho báu vô tận, là đúc kết những tinh hoa, tri thức của cả nhân loại, là sự kết tinh của lớp lớp thế hệ. Sở hữu một cuốn sách hay chính là chìa khóa quyền năng để chúng ta có thể chinh phục được những khó khăn, thử thách phía trước nhằm vươn đến thành công. </p> -->
      <a href="about.php" class="white-btn">Khám phá </a>
   </div>

</section>

<section class="products">

   <h1 class="title">Sách mới nhất</h1>

   <div class="box-container">

      <?php  
         $productservice = new ProductServices();

        // $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
        $select_products = $productservice->getLimit(6);
        
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="Thêm vào giỏ hàng" name="add_to_cart" class="btn">
      <button class ="btn" ><a href="book_detail.php?id=<?php echo $fetch_products['id']; ?>" style="color:white;">book detail</a></button>
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">Không có sách phù hợp!! </p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">Tải thêm</a>
   </div>

</section>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="../../public/images/aboutbook.jpg" alt="">
      </div>

      <div class="content">
         <h3>Thông tin về chúng tôi</h3>
         <p>Cửa hàng luôn phục vụ với sự tận tâm và luôn cố gắng mang lại sự hài lòng nhất cho khách hàng</p>
         <p>Luôn đặt chất lượng lên đầu!!</p>
         <a href="about.php" class="btn">Xem thêm</a>
      </div>

   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h3>Thắc mắc cần giải đáp ?</h3>
      <a href="contact.php" class="white-btn">Liên hệ</a>
   </div>

</section>

   



<?php include 'footer.php'; ?>

<!-- custom js file link  -->

<script src="../../public/js/script.js"></script>

</body>
</html>
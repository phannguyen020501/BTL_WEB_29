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
   <link rel="stylesheet" href="public/css/search.css">



   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <style>
      
  </style>
   
</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Tìm kiếm</h3>
</div>

<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search" placeholder="Tìm sách.." class="box" id = "search" onkeyup="searchfunc()" >
      <input type="submit" name="submit" value="Tìm kiếm" class="btn">
        </form>
</section>

<table>
  <thead>
    <tr>
      <th scope="col">Tên</th>
      <th scope="col">Tác giả </th>
      <th scope="col">Thể loại</th>
      <th scope="col">Nhà xuất bản</th>
      <th scope="col">Chi tiết</th>
    </tr>
  </thead>
  <tbody id="output">
    
  </tbody>
</table>



<script type="text/javascript">
  $(document).ready(function(){
    $("#search").keyup(function(){
      $.ajax({
        type:'POST',
        url:'search.php',
        data:{
          name:$("#search").val(),
        },
        success:function(data){
          $("#output").html(data);
        }
      });
    });
  });

  
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
<?php

require_once '../../config/config.php';
require_once '../../services/ProductServices.php';
require_once '../models/Products.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = $_POST['price'];
   $author = $_POST['author'];
   $category = $_POST['category'];
   $publisher = $_POST['publisher'];
   $availability = $_POST['availability'];
   $summary = $_POST['summary'];
   $year = $_POST['year'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;


   $select_product_name = $productservice->getFromName($name);

   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'Đã tồn tại sách';
   }else{
      $product = new Products($name, $author, $category, $publisher, $availability, $price, $summary, $image, $year);
      $add_product_query = $productservice->insert($product);

      //if($add_product_query  == 1){
         if($image_size > 2000000){
            $message[] = 'Kích thước file quá lớn';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'Sách thêm thành công!';
         }
      // }else{
      //    $message[] = 'Sách thêm thất bại!';
      // }
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $productservice = new ProductServices();
   $delete_image_query = $productservice->getFromID($delete_id);

   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   $productservice->deleteFromID($delete_id);
   header('location:admin_products.php');
}

if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];
   $update_author = $_POST['update_author'];
   $update_category = $_POST['update_category'];
   $update_publisher = $_POST['update_publisher'];
   $update_availability = $_POST['update_availability'];
   $update_summary = $_POST['update_summary'];
   $update_year = $_POST['update_year'];


   $productservice = new ProductServices();

   $productservice->update($update_name, $update_author,$update_category,$update_publisher,$update_availability, $update_price, $update_summary,$update_year, $update_p_id);

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'Kích thước file quá lớn';
      }else{
        $productservice->updateImage($update_image, $update_p_id);
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/'.$update_old_image);
      }
   }

   header('location:admin_products.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sản phẩm</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="../../public/css/admin_products.css">
   <link rel="stylesheet" href="../../public/css/style.css">

</head>
<body>
   
<?php require_once 'admin_header.php'; ?>


<section class="add-products">

   <h1 class="title">Cửa hàng sách</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <h3>Thêm sách</h3>
      <input type="text" name="name" class="box" placeholder="Tên sách" required = true>
      <input type="text" name="author" class="box" placeholder="Tên tác giả" required = true>
      <input type="text" name="category" class="box" placeholder="Thể Loại" required = true>
      <input type="text" name="publisher" class="box" placeholder="Nhà xuất bản" required = true>
      <input type="number" name="availability" class="box" placeholder="Số lượng" required = true>
      <input type="number" min="0" name="price" class="box" placeholder="Giá sách" required = true>
      <input type="text" name="summary" class="box" placeholder="Mô tả" required = true>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required = true>
      <input type="number" min="0" name="year" class="box" placeholder="Năm xuất bản" required = true>
      <input type="submit" value="Thên sách" name="add_product" class="btn">
      
   </form>

</section>



<section class="show-products">

   <div class="box-container">

      <?php
         $productservice = new ProductServices();
         $select_products = $productservice->getAll();
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="box">
         <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
         <div class="name" ><?php echo $fetch_products['name']; ?></div>
         <!-- <div class="author"><?php echo $fetch_products['author']; ?></div>
         <div class="category"><?php echo $fetch_products['category']; ?></div>
         <div class="publisher"><?php echo $fetch_products['publisher']; ?></div>
         <div class="availability"><?php echo $fetch_products['availability']; ?></div> -->
         <div class="price">$<?php echo $fetch_products['price']; ?></div>
         <!-- <div class="summary"><?php echo $fetch_products['summary']; ?></div> -->
         <!-- <div class="year"><?php echo $fetch_products['year']; ?></div> -->
         <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">Cập nhập</a>
         <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Xóa sách?');">Xóa</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">Không có sách để thêm!</p>';
      }
      ?>
   </div>

</section>

<section class="edit-product-form" style="
   overflow: scroll;
    width: 100%;
    height: 50%;">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = $productservice->getFromID($update_id);
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form  method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
      <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="enter product name">
      <input type="text" name="update_author" value="<?php echo $fetch_update['author']; ?>" class="box" required placeholder="enter product author">
      <input type="text" name="update_category" value="<?php echo $fetch_update['category']; ?>" class="box" required placeholder="enter product category">
      <input type="text" name="update_publisher" value="<?php echo $fetch_update['publisher']; ?>" class="box" required placeholder="enter product publisher">
      <input type="number" name="update_availability" value="<?php echo $fetch_update['availability']; ?>" class="box" required placeholder="enter product publisher">
      <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="enter product price">
      <input type="summary" name="update_summary" value="<?php echo $fetch_update['summary']; ?>" min="0" class="box" required placeholder="enter product summary">
      <input type="number" name="update_year" value="<?php echo $fetch_update['year']; ?>" min="0" class="box" required placeholder="enter product year">
      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="cập nhập" name="update_product" class="btn">
      <input type ="submit" value="hủy" formaction="admin_products.php" id="close-update" class="option-btn">
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>

</section>







<!-- custom admin js file link  -->
<script src="../../public/js/admin_script.js"></script>

</body>
</html>
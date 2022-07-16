<?php

require_once '../../config/config.php';
require_once '../../services/MessageServices.php';



session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

$messageservice = new MessageServices();
$listMessage = $messageservice->getAll();



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Về chúng tôi</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../../public/css/about.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Về chúng tôi</h3>

</div>

<section class="about">

   <div class="flex">

      <div class="image" >
         <img src="../../public/images/aboutbook.jpg" alt="" style = 'height = 100px; '>
      </div>

      <div class="content" style = 'height = 100px; '>
         <h3>Tại sao lại chọn chúng tôi?</h3>
         <p>Cửa hàng luôn phục vụ với sự tận tâm và luôn cố gắng mang lại sự hài lòng nhất cho khách hàng</p>
         <p>Luôn đặt chất lượng lên đầu!!</p>
         <a href="contact.php" class="btn">Liên hệ</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">Phản hổi từ khách hàng</h1>

   <div class="box-container">
      
      <?php
         require_once '../../config/config.php';
         require_once '../../services/MessageServices.php';
         $messageservice = new MessageServices();
         $listMessage = $messageservice->getSomePhanHoi();
         $len = count($listMessage);
         
         if($len > 6){
            $len = 6;
         }
         for($i =0 ; $i <$len; $i++){
            $message = $listMessage[$i];
      ?>
            <div class="box">
               <h3>
               <?php
                  echo $message->getName();
                ?>
               </h3>
               <p><?php
                  echo $message->getMessage();
                ?></p>
               <?php
                  $star = $message ->getStar();
                  if($star == 1){
                     ?>
                     <div class="stars">
                        <i class="fas fa-star"></i>
                  </div>
                  <?php        
                  }
                  else if($star == 2){
                     ?>
                     <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                  </div>
                  <?php        
                  }

                  else if($star == 3){
                     ?>
                     <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>

                  </div>
                  <?php        
                  }

                  else if($star == 4){
                     ?>
                     <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>

                  </div>
                  <?php        
                  }

                  else if($star == 5){
                     ?>
                     <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>

                  </div>
                  <?php        
                  }
               ?>
              
              
            </div>
            <?php
         }
         ?>
      <!-- <div class="box">
         <img src="../../public/images/pic-2.png" alt="">
         <p>Tuyệt vời quá </p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Minh Anh</h3>
      </div>

      <div class="box">
         <img src="../../public/images/pic-3.png" alt="">
         <p>Rất hữu ích</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Quốc Khánh</h3>
      </div>

      <div class="box">
         <img src="../../public/images/pic-4.png" alt="">
         <p>Hệ thống ổn định</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Hồng Vân</h3>
      </div>

      <div class="box">
         <img src="../../public/images/pic-5.png" alt="">
         <p>Quá chất lượng</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Lê văn Đỗ</h3>
      </div>

      <div class="box">
         <img src="../../public/images/pic-6.png" alt="">
         <p>Cần đa dạng thêm sách</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Khánh dz</h3>
      </div> -->

   </div>

</section>


<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="../../public/js/script.js"></script>

</body>
</html>
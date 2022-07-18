<?php

include '../../config/config.php';
include '../../services/MessageServices.php';
include '../../services/UserServices.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['send'])){

   $userservice = new UserServices();
   $user = $userservice->getById($user_id);
   
   $name = $user->getName();
   $email = $user->getEmail();
   $number = $user->getNumber();

   $star = $_POST['star'];
   
   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   $select_message = new MessageServices();

   if($msg == null){
      $message[] = "vui lòng nhập đủ thông tin ";
   }else{
      $select_message->insert($user_id, $name, $email, $number,$msg,$star);
      $message[] = 'Phản hồi thành công!';
   }
   
   

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../../public/css/contact_css.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Liên hệ</h3>
</div>

<section class="contact">

   <form action="" method="post">
      <h3>Phản hồi</h3>
      <input type="number" name="star" required placeholder="Số sao" class="box" min = 1 max = 5>
      <textarea name="message" class="box" placeholder="Nhập phản hồi" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="Gửi phản hồi" name="send" class="btn">
   </form>

</section>



<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="../../public/js/script.js"></script>

</body>
</html>
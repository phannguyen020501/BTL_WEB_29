<?php
require_once 'C:\xampp\htdocs\BTL_WEB_29\config\config.php';


if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_type = $_POST['user_type'];
   $number = mysqli_real_escape_string($conn, md5($_POST['number']));
   require_once 'C:\xampp\htdocs\BTL_WEB_29\services\RegisterServices.php';
   
   $registerService = new RegisterServices();
   $select_users = $registerService->getNameEmail($email,$pass);
  
   
   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'Người dùng đã tồn tại!';
   }else{
      if($pass != $cpass){
         $message[] = 'Mật khẩu không hợp lệ!';
      }else{
         
         $select_users = $registerService->insertUser($name,$email,$pass,$user_type,$number);
         $message[] = 'Đăng ký thành công!';
         header('location:login.php');
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
   <title>Đăng ký</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="public/css/register.css">

</head>
<body>



<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Đăng ký</h3>
      <input type="text" name="name" placeholder="Tên người dùng" required class="box">
      <input type="email" name="email" placeholder="Email" required class="box">
      <input type="password" name="password" placeholder="Mật khẩu" required class="box">
      <input type="password" name="cpassword" placeholder="Xác nhận mật khẩu" required class="box">
      <input type="text" name="number" pattern="^((\+84)|0)\d{9,10}$" placeholder="Số điện thoại" required class="box">
      <input type= "hidden" name ="user_type" value = "user" >
      <!-- <select name="user_type" class="box">
         <option value="user">Người dùng</option>
      </select> -->
      <input type="submit" name="submit" value="Đăng ký" class="btn">
      <p>Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
   </form>

</div>

</body>
</html>
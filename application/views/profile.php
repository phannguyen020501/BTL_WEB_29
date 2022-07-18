<?php

include '../../config/config.php';
require_once '../../services/UserServices.php';

session_start();

$userservice = new UserServices();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['update_user'])) {
   $user_name = $_POST['update_name'];
   $user_phone = $_POST['update_phone'];
   $id = $_SESSION['user_id'];
   $_SESSION['user_name'] = $user_name;
   $_SESSION['user_phone'] = $user_phone;
   $userservice->updateNameAndPhone($user_name, $user_phone, $id);
   $message[] = 'Cập nhật thành công!';
}

if(isset($_POST['edit_pass'])) {
   $old_pass = mysqli_real_escape_string($conn, md5($_POST['old_pass']));
   $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
   $new2_pass = mysqli_real_escape_string($conn, md5($_POST['new2_pass']));
   $user_email = $_SESSION['user_email'];
   $check_password = $userservice->getByEmailAndPassword($user_email, $old_pass);
   if(mysqli_num_rows($check_password) == 0){
      $message[] = 'Mật khẩu cũ không chính xác!';
   }
   else {
      if ($new_pass != $new2_pass) {
         $message[] = 'Mật khẩu không trùng khớp!';
      }
      else if ($new_pass == $old_pass) {
         $message[] = 'Mật khẩu mới trùng với mật khẩu cũ!';
      }
      else {
         $userservice->updatePassword($user_email, $new_pass);
         $message[] = 'Cập nhật mật khẩu thành công!';
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
   <title>Profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../../public/css/profile.css">
   <link rel="stylesheet" href="../../public/css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Tài khoản của tôi</h3>
</div>

<section class="profile">

   <form method="post">
      <h3>ID Tài khoản: <span><?php echo $_SESSION['user_id'];?></span> </h3>
      <h3>Tên hiển thị: <span><?php echo $_SESSION['user_name'];?></span> </h3>
      <h3>Mật khẩu: <span>******</span></h3>
      <h3>Email: <span><?php echo $_SESSION['user_email'];?></span> </h3>
      <h3>Vai trò: <span>Người dùng</span> </h3>
      <h3>Số điện thoại: <span><?php echo $_SESSION['user_phone'];?></span></h3>
      <input type="submit" value="Sửa thông tin" name="editinfo" class="btn">
   </form>

</section>

<section class="edit-info">

   <?php
      if(isset($_POST['editinfo'])){
   ?>
   <form method="post" enctype="multipart/form-data">
      <h3>Tên hiển thị và SĐT</h3>
      <input type="text" name="update_name" value="<?php echo $_SESSION['user_name']; ?>" class="box" required placeholder="Tên hiển thị">
      <input type="text" name="update_phone" value="<?php echo $_SESSION['user_phone']; ?>" class="box" required placeholder="Số điện thoại">
      <input type="submit" value="cập nhật" name="update_user" class="btn">
      <input type="submit" value="hủy" id="close-update" class="option-btn">
   </form>
   <?php
         }
      else{
         echo '<script>document.querySelector(".edit-info").style.display = "none";</script>';
      }
   ?>

</section>

<section class="profile">
   <form method="post">
      <h3>Đổi mật khẩu</h3>
      <input type="password" name="old_pass" class="box" required placeholder="Mật khẩu cũ">
      <input type="password" name="new_pass" class="box" required placeholder="Mật khẩu mới">
      <input type="password" name="new2_pass" class="box" required placeholder="Nhập lại mật khẩu mới">
      <input type="submit" value="Đổi mật khẩu" name="edit_pass" class="delete-btn">
   </form>
</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="../../public/js/script.js"></script>

</body>
</html>
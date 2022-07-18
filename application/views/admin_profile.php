<?php


session_start();
require_once '../../services/UserServices.php';

$admin_id = $_SESSION['admin_id'];
$userservice = new UserServices();

if(!isset($admin_id)){
   header('location:login.php');
}


if(isset($_POST['update_user'])) {
   $admin_name = $_POST['update_name'];
   $admin_phone = $_POST['update_phone'];
   $id = $_SESSION['admin_id'];
   $_SESSION['admin_name'] = $admin_name;
   $_SESSION['admin_phone'] = $admin_phone;
   $userservice->updateNameAndPhone($admin_name, $admin_phone, $id);
   $message[] = 'Cập nhật thành công!';
}

if(isset($_POST['edit_pass'])) {
   $old_pass = mysqli_real_escape_string($conn, md5($_POST['old_pass']));
   $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
   $new2_pass = mysqli_real_escape_string($conn, md5($_POST['new2_pass']));
   $admin_email = $_SESSION['admin_email'];
   $check_password = $userservice->getByEmailAndPassword($admin_email, $old_pass);
   if(mysqli_num_rows($check_password) == 0){
      $message[] = 'Mật khẩu cũ không chính xác!';
   }
   else {
      if ($new_pass != $new2_pass) {
         $message[] = 'Mật khẩu không trùng khớp!';
      }
      else {
         $userservice->updatePassword($admin_email, $new_pass);
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
   <title></title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../../public/css/profile.css">
   <link rel="stylesheet" href="../../public/css/style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<div class="heading">
   <h3>Tài khoản của tôi</h3>
</div>

<section class="profile">

   <form method="post">
      <h3>ID Tài khoản: <span><?php echo $_SESSION['admin_id'];?></span> </h3>
      <h3>Tên hiển thị: <span><?php echo $_SESSION['admin_name'];?></span> </h3>
      <h3>Mật khẩu: <span>******</span></h3>
      <h3>Email: <span><?php echo $_SESSION['admin_email'];?></span> </h3>
      <h3>Vai trò: <span>Admin</span> </h3>
      <h3>Số điện thoại: <span><?php echo $_SESSION['admin_phone'];?></span></h3>
      <input type="submit" value="Sửa thông tin" name="edit_info" class="btn">
   </form>

</section>

<section class="edit-info">

   <?php
      if(isset($_POST['edit_info'])){
   ?>
   <form method="post" enctype="multipart/form-data">
      <h3>Tên hiển thị và SĐT</h3>
      <input type="text" name="update_name" value="<?php echo $_SESSION['admin_name']; ?>" class="box" required placeholder="Tên hiển thị">
      <input type="number" name="update_phone" value="<?php echo $_SESSION['admin_phone']; ?>" class="box" required placeholder="Số điện thoại">
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
<?php

require_once 'C:\xampp\htdocs\BTL_WEB_29\config\config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   require_once 'C:\xampp\htdocs\BTL_WEB_29\services\UserServices.php';

   $userservice = new UserServices();
   $select_users = $userservice->getByEmailAndPassword($email,$pass);

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         $_SESSION['admin_phone'] = $row['number'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         $_SESSION['user_phone'] = $row['number'];
         header('location:home.php');

      }

   }else{
      $message[] = 'Sai tên đăng nhập hoặc mật khẩu! Vui lòng nhập lại!!';
   }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đăng nhập</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="public/css/login_css.css">
   <link rel="stylesheet" href="public/css/style2.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

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

<body>
	<div class="container">
		<div class="top" style="height:200px;">
			<h1 id="title" class="hidden" style="max-width:600px;padding-top: 60px;" ><span id="logo" style="width:800px;">BOOK STORE</span></h1>
		</div>
		<div class="login-box animated fadeInUp">
			<form action="" method="post">
            <div class="box-header">
               <h2>Log In</h2>
            </div>
            <label for="username">Username</label>
            <br/>
            <input type="email" name="email" placeholder="Tên đăng nhập" required class="box" type="text" id="username">
            <br/>
            <label for="password">Password</label>
            <br/>
            <input type="password" name="password" placeholder="Mật khẩu" required class="box" type="password" id="password">
            <br/>
            <button type="submit" name="submit" value="Đăng nhập" class="btn">Sign In</button>
            <br/>
		      
		      <p>Chưa có tài khoản?<a href="register.php">Đăng ký </a></p>
		    </form>
		</div>
	</div>
</body>

<script>
	$(document).ready(function () {
    	$('#logo').addClass('animated fadeInDown');
    	$("input:text:visible:first").focus();
	});
	$('#username').focus(function() {
		$('label[for="username"]').addClass('selected');
	});
	$('#username').blur(function() {
		$('label[for="username"]').removeClass('selected');
	});
	$('#password').focus(function() {
		$('label[for="password"]').addClass('selected');
	});
	$('#password').blur(function() {
		$('label[for="password"]').removeClass('selected');
	});
</script>


</body>
</html>
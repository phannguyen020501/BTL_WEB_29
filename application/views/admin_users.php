<?php
require_once 'C:\xampp\htdocs\BTL_WEB_29\services\UserServices.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

$userservice = new UserServices();

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $userservice->delete($delete_id);
   header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Users</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="public/css/admin_users.css">
   <!-- <link rel="stylesheet" href="../../scripts/css/style.css"> -->

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="users">

   <h1 class="title"> Tài khoản người dùng </h1>

   <div class="box-container">
      <?php
         $select_users = $userservice->getAll();
         while($fetch_users = mysqli_fetch_assoc($select_users)){
      ?>
      <div class="box">
         <p> ID : <span><?php echo $fetch_users['id']; ?></span> </p>
         <p> Tên : <span><?php echo $fetch_users['name']; ?></span> </p>
         <p> Email : <span><?php echo $fetch_users['email']; ?></span> </p>
         <p> Chức vụ : <span style="color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'var(--orange)'; } ?>"><?php echo $fetch_users['user_type']; ?></span> </p>
         <a href="admin_users.php&delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('Xóa người dùng này?');" class="delete-btn">Xóa</a>
      </div>
      <?php
         };
      ?>
   </div>

</section>









<!-- custom admin js file link  -->
<script src="public/js/admin_script.js"></script>

</body>
</html>
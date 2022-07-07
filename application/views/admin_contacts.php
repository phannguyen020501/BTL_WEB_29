<?php

include '../../config/config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   require_once '../../services/MessageServices.php';
   $select_message = new MessageServices();
   $select_message->delete($delete_id);
   #mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_contacts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Phản hồi</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="../../public/css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="messages">

   <h1 class="title"> Phản hồi </h1>

   <div class="box-container">
   <?php

      require_once '../../services/MessageServices.php';
      $messageServices = new MessageServices();
      $select_message = $messageServices->getAll();
      #$select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
      if(mysqli_num_rows($select_message) > 0){
         while($fetch_message = mysqli_fetch_assoc($select_message)){
      
   ?>
   <div class="box">
      <p> ID người dùng : <span><?php echo $fetch_message['user_id']; ?></span> </p>
      <p> Tên : <span><?php echo $fetch_message['name']; ?></span> </p>
      <p> Số điện thoại : <span><?php echo $fetch_message['number']; ?></span> </p>
      <p> Email : <span><?php echo $fetch_message['email']; ?></span> </p>
      <p> Phản hồi : <span><?php echo $fetch_message['message']; ?></span> </p>
      <a href="admin_contacts.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('Xóa phản hồi?');" class="delete-btn">Xóa phản hồi</a>
   </div>
   <?php
      };
   }else{
      echo '<p class="empty">Không có phản hồi</p>';
   }
   ?>
   </div>

</section>



<!-- custom admin js file link  -->
<script src="../../public/js/admin_script.js"></script>

</body>
</html>
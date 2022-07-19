<?php

include 'C:\xampp\htdocs\BTL_WEB_29\config\config.php';

session_start();
session_unset();
session_destroy();

header('location:login.php');

?>
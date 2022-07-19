<?php

require_once  'C:\xampp\htdocs\BTL_WEB_29\application\controllers\RouteController.php';

$path_project = 'BTL_WEB_29';

$url = isset($_GET["url"]) ? $_GET["url"] : "/";

// echo  $_SERVER['REQUEST_URI'];

$route = new RouteController($url);

$route->show();


<?php
require_once 'C:\xampp\htdocs\BTL_WEB_29\config\config.php';
require_once 'MySqlConnect.php';

class OrderService extends MySqlConnect{

	// /**
    //  * The method support insert data to database
    //  * @param Product $product
    //  */

    public function getFromID($id) {
		$query = "select * from `orders` where id = '$id'";
		parent::addQuerry($query);
        $result = parent::executeQuery();
        return $result;
	}

}
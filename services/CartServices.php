<?php

require_once 'MySqlConnect.php';
class CartServices extends MySqlConnect{

	/**
     * The method support insert data to database
     * @param Order $order
     */
	public function insert($order){
		$query  = "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('"
		.$order->getUserId()."', '"
		.$order->getName()."', '"
		.$order->getNumber()."', '"
		.$order->getEmail()."', '"
		.$order->getMethod()."', '"
		.$order->getAddress()."', '"
		.$order->getTotalProduct()."', '"
		.$order->getTotalPrice()."', '"
		.$order->getPlacedOn()."')";
		echo $query;
		parent::addQuerry($query);
		parent::updateQuery($query);
	}
	
	public function get($user_id){
		$query = "select * from `cart` where user_id = '$user_id'";

		parent::addQuerry($query);
        $result = parent::executeQuery();
        return $result;
	}
	public function getNameID($name,$user_id){
		$query = "SELECT * FROM `cart` WHERE name = '$name' AND user_id = '$user_id'";
		parent::addQuerry($query);
        $result = parent::executeQuery();
        return $result;
	}
	public function update($id, $quantity){
		$query = "UPDATE `cart` SET quantity = '$quantity' WHERE id = '$id'";

		parent::addQuerry($query);
		parent::updateQuery($query);
	}
	public function addCart($user_id,$product_name,$product_price,$product_quantity,$product_image){
		$query = "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')";
		parent::addQuerry($query);
		parent::updateQuery($query);
	}
	public function getByIdAndName($product_name, $user_id){
		$query = "SELECT * FROM cart WHERE name = '$product_name' AND user_id = '$user_id'";
		parent::addQuerry($query);
        $result = parent::executeQuery();
        return $result;	
	}

    public function delete($id) {
        $query = "delete FROM `cart` WHERE id = $id";

        parent::addQuerry($query);
		parent::updateQuery($query);
    }

    public function deleteAll($user_id) {
        $query = "delete FROM `cart` WHERE user_id = $user_id";
        parent::addQuerry($query);
		parent::updateQuery($query);
    }
	
	public function insertProductToCart($user_id, $product_name,$product_price,$product_quantity, $product_image){
		$query = "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')";
		parent::addQuerry($query);
		parent::updateQuery($query);
		
	}
}
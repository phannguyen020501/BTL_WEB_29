<?php

require_once 'MySqlConnect.php';
class OrderServices extends MySqlConnect{

	public function insert($order){
		$user_id = $order->getUserId();
		$name = $order->getName();
		$number = $order->getNumber();
		$email = $order->getEmail();
		$method = $order->getMethod();
		$address = $order->getAddress();
		$total_products = $order->getTotalProduct();
		$total_price = $order->getTotalPrice();
		$placed_on = $order->getPlacedOn();
		$query="insert INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$total_price', '$placed_on')";
		echo $query;
		parent::addQuerry($query);
		parent::updateQuery();
	}
	public function getAll(){
		$listOrder = array();
		$query = "select * from `orders` where 1";
		parent::addQuerry($query);
        $result = parent::executeQuery();
        return $result;
	}
	public function getAll1($payment_status){
		$listOrder = array();
		$query = "select * from `orders` where payment_status like '%".$payment_status."%'";
		parent::addQuerry($query);
        $result = parent::executeQuery();
        return $result;
	}
	public function getTotalPrice($payment_status){
		$listOrder = array();
		$query = "select total_price from `orders` where payment_status like '%".$payment_status."%'";# ."or die('query failed')";
		parent::addQuerry($query);
        $result = parent::executeQuery();
        return $result;
	}
	public function delete($delete_id){
		$query = "delete FROM `orders` WHERE id = ".$delete_id;
		parent::addQuerry($query);
        $result = parent::executeQuery();
	}
	public function update($update_payment,$order_update_id){
		$query = "update `orders` set payment_status = '".$update_payment."' WHERE id = ".$order_update_id;
		parent::addQuerry($query);
        $result = parent::executeQuery();
	}
	public function getFromID($id) {
		$query = "select * from `orders` where user_id = $id";
		parent::addQuerry($query);
        $result = parent::executeQuery();
        return $result;
	}
}
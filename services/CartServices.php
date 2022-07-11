<?php

require_once 'MySqlConnect.php';
class CartServices extends MySqlConnect{

	/**
     * The method support insert data to database
     * @param Order $order
     */
	public function insert($order){
		$query  = "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES("
		.$order->getUserId().", "
		.$order->getName().", "
		.$order->getNumber().", "
		.$order->getEmail().", "
		.$order->getMethod().", "
		.$order->getAddress().", "
		.$order->getTotalProduct().", "
		.$order->getTotalPrice().", "
		.$order->getPlacedOn().")";

		parent::addQuerry($query);
		parent::updateQuery($query);
	}

	public function get($user_id){
		$query = "select * from `cart` where user_id = '$user_id'";

		parent::addQuerry($query);
        $result = parent::executeQuery();
        return $result;
	}

	public function update($id, $quantity){
		$query = "UPDATE `cart` SET quantity = '$quantity' WHERE id = '$id'";

		parent::addQuerry($query);
		parent::updateQuery($query);
	}

    public function delete($id) {
        $query = "DELETE FROM `cart` WHERE id = '$id'";

        parent::addQuerry($query);
		parent::updateQuery($query);
    }

    public function deleteAll($user_id) {
        $query = "DELETE FROM `cart` WHERE user_id = '$user_id'";

        parent::addQuerry($query);
		parent::updateQuery($query);
    }
}

<?php
require_once '../../application/models/Product.php';
require_once '../../config/config.php';

class ProductServices extends MySqlConnect{

	/**
     * The method support insert data to database
     * @param Product $product
     */
	public function insert($product){
		$query  = "insert into `products` (name, price, image) VALUES("
		.$product->getName().", "
		.$product->getPrice().", "
		.$product->getImage().")";

		parent::addQuerry($query);
		parent::updateQuery($query);
	}

	public function getAll(){
		$listProducts = array();
		$query = "select * from `products`";
		parent::addQuerry($query);
        $result = parent::executeQuery();
        return $result;
	}
}
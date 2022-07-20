<?php
require_once 'C:\xampp\htdocs\BTL_WEB_29\application\models\Products.php';
require_once 'C:\xampp\htdocs\BTL_WEB_29\config\config.php';
require_once 'MySqlConnect.php';

class ProductServices extends MySqlConnect{

	// /**
    //  * The method support insert data to database
    //  * @param Products $product
    //  */
	public function insert($product){
        $query  = "insert into products (name,author,category,publisher,availability, price,summary, image,year) VALUES('"
        .$product->getName()."', '"
        .$product->getAuthor()."', '"
        .$product->getCategory()."', '"
        .$product->getPublisher()."', '"
        .$product->getAvailability()."', '"
        .$product->getPrice()."', '"
        .$product->getSummary()."', '"
        .$product->getImage()."', '"
        .$product->getYear()."')";
 
        parent::addQuerry($query);
        parent::updateQuery($query);
		return 1;
    }


	// /**
    //  * The method support insert data to database
    //  * @param Product $product
    //  */
	public function update($name, $author, $category, $publisher, $availability, $price, $summary, $year, $id) {
		$query  = "UPDATE products SET name = '$name', author = '$author',
				 category='$category', publisher = '$publisher' , availability='$availability',
				  price = '$price', summary ='$summary', year = '$year' 
		 WHERE id = '$id'";

		

		parent::addQuerry($query);
		parent::updateQuery($query);
	}

	public function updateImage($image, $id) {
		$query  = "UPDATE products SET image = $image WHERE id = $id";

		parent::addQuerry($query);
		parent::updateQuery($query);
	}

	public function getAll(){
		$listProducts = array();
		$query = "select * from products";
		parent::addQuerry($query);
        $result = parent::executeQuery();
        return $result;
	}

	public function getFromName($name) {
		$query = "select * from products where name = '$name'";
		parent::addQuerry($query);
        $result = parent::executeQuery();
        return $result;
	}

	public function getFromID($id) {
		$query = "select * from products where id = '$id'";
		parent::addQuerry($query);
        $result = parent::executeQuery();
        return $result;
	}

	public function deleteFromID($id,) {
		$query = "delete from products where id = '$id'";

        parent::addQuerry($query);
		parent::updateQuery($query);
	}
	public function getLimit($limit){
		$listProducts = array();
		$query = "select * from products limit $limit";
		parent::addQuerry($query);
        $result = parent::executeQuery();
        return $result;
	}

	public function updateAvailability($availability,$id){
		$query = "update products set availability = $availability where id = $id";
		parent::addQuerry($query);
		parent::updateQuery($query);
	}
	public function getCountId(){
		$query = "select count(id) as total from products";
		parent::addQuerry($query);
        $result = parent::executeQuery();
		return $result;
	}
	public function getProduct($start,$limit){
		$query = "SELECT * FROM products LIMIT $start, $limit";
		parent::addQuerry($query);
        $result = parent::executeQuery();
		return $result;
	}
	
}
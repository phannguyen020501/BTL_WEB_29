<?php
class Cart{
    private $user_id ;
    private $name;
    private $price;
    private $quantity;
    private $image;

    public function __construct($user_id, $name, $price, $quantity, $image) {
		self::setUser_id($user_id);
        self::setName($name);
        self::setEmail($price);
        self::setNumber($quantity);
        self::setMessage($image);
    }
	public function getUser_id(){
		return $this->user_id;
	}
	public function getName(){
		return $this->name;
	}
	public function getPrice(){
		return $this->price;
	}
	public function getQuantity(){
		return $this->quantity;
	}
	public function getImage(){
		return $this->image;
	}
	
	public function setUser_id($user_id){
		$this->user_id = $user_id;
	}
	public function setName($name){
		$this->name = $name;
	}
	public function setPrice($price){
		$this->price = $price;
	}
	public function setQuantity($quantity){
		$this->quantity = $quantity;
	}
	public function setImage($image){
		$this->image = $image;
	}

}

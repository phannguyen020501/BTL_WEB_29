<?php

class Product{
	private $name;
	private $price;
	private $image;

	public function __construct($name, $price, $image) {
        self::setName($name);
        self::setPrice($price);
        self::setImage($image);
    }

	public function getName(){
		return $this->name;
	}
	public function getPrice(){
		return $this->price;
	}
	public function getImage(){
		return $this->image;
	}
	public function setName($name){
		$this->name = $name;
	}
	public function setPrice($price){
		$this->price = $price;
	}
	public function setImage($image){
		$this->image = $image;
	}
}
<?php

class Order{
	private $id; //int
	private $user_id; //int
	private $name;//String
	private $number;//String
	private $email;//String
	private $method;//String
	private $address;//String
	private $total_products;//String
	private $total_price;//int
	private $placed_on;//String
	private $payment_status;//String

	public function __construct{

	}
	public function getId(){
		return $this->id;
	}
	public function getUserId(){
		return $this->user_id;
	}
	public function getName(){
		return $this->name;
	}
	public function getNumber(){
		return $this->number;
	}
	public function getEmail(){
		return $this->email;
	}
	public function getMethod(){
		return $this->method;
	}
	public function getAddress(){
		return $this->address;
	}
	public function getTotalProduct(){
		return $this->total_products;
	}
	public function getTotalPrice(){
		return $this->total_price;
	}
	public function getPlacedOn(){
		return $this->placed_on;
	}
	public function getPaymentStatus(){
		return $this->payment_status;
	}
	public function setId($id){
		$this->id = $id;
	}
	public function setUserId($user_id){
		$this->user_id = $user_id;
	}
	public function setName($name){
		$this->name = $name;
	}public function setNumber($number){
		$this->number = $number;
	}
	public function setEmail($email){
		$this->email = $email;
	}
	public function setMethod($method){
		$this->method = $method;
	}
	public function setAddress($address){
		$this->address = $address;
	}
	public function setTotalProducts($total_products){
		$this->total_products = $total_products;
	}
	public function setTotalPrice($total_price){
		$this->total_price = $total_price;
	}
	public function setPlacedOn($placed_on){
		$this->placed_on = $placed_on;
	}
	public function setPaymentStatus($payment_status){
		$this->payment_status = $payment_status;
	}
}
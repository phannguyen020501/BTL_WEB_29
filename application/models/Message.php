<?php

class Message{
	private $user_id;
	private $name;
	private $email;
	private $number;
	private $message;
	public function __construct($user_id, $name, $email, $number, $message) {
		self::setUser_id($user_id);
        self::setName($name);
        self::setEmail($email);
        self::setNumber($number);
        self::setMessage($message);
    }
	public function getUser_id(){
		return $this->user_id;
	}
	public function getName(){
		return $this->name;
	}
	public function getEmail(){
		return $this->email;
	}
	public function getNumber(){
		return $this->number;
	}
	public function getMessage(){
		return $this->message;
	}
	
	public function setUser_id($user_id){
		$this->user_id = $user_id;
	}
	public function setName($name){
		$this->name = $name;
	}
	public function setPrice($email){
		$this->email = $email;
	}
	public function setNumber($number){
		$this->number = $number;
	}
	public function setMessage($message){
		$this->message = $message;
	}
	public function setEmail($email){
		$this->email = $email;
	}
}
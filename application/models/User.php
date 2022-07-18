<?php

class User{
	private $name;
	private $email;
	private $password;
	private $user_type;
    private $number;


	public function __construct($name, $email, $password, $user_type,$number) {
        self::setName($name);
        self::setEmail($email);
        self::setPassword($password);
        self::setUser_type($user_type);
        self::setNumber($number);
    }
    
	public function getName(){
        return $this->name;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getUser_type(){
        return $this->user_type;
    }
    public function getNumber(){
        return $this->number;
    }

    public function setName($name){
        $this->name = $name;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function setUser_type($user_type){
        $this->user_type = $user_type;
    }

    public function setNumber($number){
        $this->number = $number;
    }
}
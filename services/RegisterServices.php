<?php

require_once '../../application/models/User.php';
require_once '../../config/config.php';
require_once 'MySqlConnect.php';

class RegisterServices extends MySqlConnect{

	/**
     * The method support insert data to database
     * @param User $user
     */
	public function insertUser($name,$email,$pass,$tpye){
		$query = "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$pass', '$tpye')";
		//$query  = "insert into `users`(name, email, password, user_type) VALUES($name,$email,$pass,$tpye)";
		echo $query;
		parent::addQuerry($query);
		parent::updateQuery($query);

	}

    public function getAll(){
		$listProducts = array();
		$query = "select * from `users`";
		parent::addQuerry($query);
        $result = parent::executeQuery();
        return $result;
	}

	public function getNameEmail($email,$pass){
		$query = "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'";
		parent::addQuerry($query);
        $result = parent::executeQuery();
        return $result;
	}


    public function delete($id) {
        $query = "DELETE FROM `users` WHERE id = '$id'";

        parent::addQuerry($query);
		parent::updateQuery($query);
    }

    public function update($name, $email, $password,$id) {
		$query  = "UPDATE `users` SET name = $name, email = $price, password = $password  WHERE id = $id";
		parent::addQuerry($query);
		parent::updateQuery($query);
	}


	
}

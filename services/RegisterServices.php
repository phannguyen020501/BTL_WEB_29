<?php

require_once 'C:\xampp\htdocs\BTL_WEB_29\application\models\User.php';
require_once 'C:\xampp\htdocs\BTL_WEB_29\config\config.php';
require_once 'MySqlConnect.php';

class RegisterServices extends MySqlConnect{

	/**
     * The method support insert data to database
     * @param User $user
     */
	public function insertUser($name,$email,$pass,$tpye,$number){
		$query = "INSERT INTO `users`(name, email, password, user_type,number) VALUES('$name', '$email', '$pass', '$tpye','$number')";
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

	public function getNameEmail($email,$name){
		$query = "SELECT * FROM `users` WHERE email = '$email' AND name = '$name'";
		parent::addQuerry($query);
        $result = parent::executeQuery();
        return $result;
	}


    public function delete($id) {
        $query = "DELETE FROM `users` WHERE id = '$id'";

        parent::addQuerry($query);
		parent::updateQuery($query);
    }

    public function update($name, $email,  $password,$id) {
		$query  = "UPDATE `users` SET name = $name, email = $email, password = $password  WHERE id = $id";
		parent::addQuerry($query);
		parent::updateQuery($query);
	}


	
}

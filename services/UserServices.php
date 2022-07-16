<?php

require_once 'MySqlConnect.php';
require_once 'C:\xampp\htdocs\BTL_WEB_29\application\models\User.php';


class UserServices extends MySqlConnect{


	public function insert(){

	}

	public function getByEmailAndPassword($email, $pass){
		$query = "select * from `users` where email = '$email' and password = '$pass'";
		parent::addQuerry($query);
        $result = parent::executeQuery();
        return $result;
	}
	
	public function getAll(){
		$listOrder = array();
		$query = "select * from `users`";

		parent::addQuerry($query);
        $result = parent::executeQuery();
        return $result;
	}
	
	public function getAllByType($user_type){
		$listOrder = array();
		$query = "select * from `users` where user_type like '%".$user_type."%'";

		parent::addQuerry($query);
        $result = parent::executeQuery();
        return $result;
	}
	public function delete($id) {
		$query = "delete from `users` where id = '$id'";

        parent::addQuerry($query);
		parent::updateQuery($query);
	}

	public function getById($id){

		$query = "select * from `users` where  id = '$id'";
		parent::addQuerry($query);
        $result = parent::executeQuery();
		if($row = mysqli_fetch_array($result)){
			$id = $row['id'];
			$name = $row['name'];
			$email = $row['email'];
			$pass = $row['password'];
			$type = $row['user_type'];
			$number = $row['number'];
			$user = new User($name,$email,$pass,$type,$number);
			return $user;
		}
		return null;

	}
}

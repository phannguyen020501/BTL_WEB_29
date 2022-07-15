<?php

require_once 'MySqlConnect.php';
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

	
}

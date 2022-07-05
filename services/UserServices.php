<?php



class UserServices extends MySqlConnect{


	public function insert(){

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
}

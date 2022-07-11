<?php


require_once 'MySqlConnect.php';
class MessageServices extends MySqlConnect{


	public function insert($name, $email, $number,$msg){
		$query = "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'";
		
	}
	public function getAll(){
		$listOrder = array();
		$query = "select * from message";
		parent::addQuerry($query);
        $result = parent::executeQuery();
        return $result;
	}
	public function delete($message_id){
		$query = "DELETE FROM `message` WHERE id = ".$message_id;
		parent::addQuerry($query);
        $result = parent::executeQuery();
	}

}
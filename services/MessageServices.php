<?php


require_once 'MySqlConnect.php';
require_once 'C:\xampp\htdocs\BTL_WEB_29\application\models\Message.php';
class MessageServices extends MySqlConnect{


	public function insert($user_id, $name, $email, $number,$msg,$star){
		$query = "INSERT INTO `message`(user_id, name, email, number, message,star) VALUES('$user_id', '$name', '$email', '$number', '$msg','$star')";
		parent::addQuerry($query);
        parent::updateQuery($query);
	}

	public function getAll(){
		$query = "select * from message";
		parent::addQuerry($query);
        $result = parent::executeQuery();
		return $result;
	}


	public function getSomePhanHoi(){
		$listMessage = array();
		$query = "select * from message order by id desc";
		parent::addQuerry($query);
        $result = parent::executeQuery();


		while($row = mysqli_fetch_array($result)){
            $user_id = $row["user_id"];
            $name = $row["name"];
            $email= $row["email"];
            $number = $row["number"];
            $message = $row["message"];
            $star = $row["star"];

			$message = new Message($user_id, $name, $email,$number, $message,$star);

            array_push($listMessage, $message);
        }
		return $listMessage;


	}
	public function delete($message_id){
		$query = "DELETE FROM `message` WHERE id = ".$message_id;
		parent::addQuerry($query);
        $result = parent::executeQuery();
	}

	

}
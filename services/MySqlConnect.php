<?php

//require_once ROOT . DS . 'config' . DS . 'db_config.php';
//require_once ROOT . DS . 'services' . DS . 'ISqlConnect.php';
require_once 'ISqlConnect.php';
require_once 'C:\xampp\htdocs\BTL_WEB_29\config\config.php';

class MySqlConnect implements ISqlConnect {
    private $db;
    private $query;

    public function __construct(){
        $this->db = mysqli_connect('localhost','root','','shop_db',3308);

        // if($this->db){
        //     echo "connect successfully <br />";
        // } else {
        //     echo "connect fail! <br />";
        //     exit();
        // }
    }

    // add querry statement
    public function addQuerry($query){
        $this->query = $query;
    }

    // use with statement select
    public function executeQuery(){
        $result = mysqli_query($this->db, $this->query);

        if(!$result){
            echo "Thực hiện thất bại!";
            exit();
        }
        return $result;
    }


    // use with statement insert, delete, update,..
    public function updateQuery(){
        $result = mysqli_query($this->db, $this->query);
        // echo $this->query;
        if(!$result){
            echo "Cập nhật thất bại!";
            exit();
        }

        // no return result
    }

}

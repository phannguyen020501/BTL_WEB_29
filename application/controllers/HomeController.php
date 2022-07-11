<?php

require_once 'Controller.php';
require_once 'DefaultController.php';
class HomeController extends DefaultController implements Controller {
	public function __render(){
        //require_once ROOT . DS . 'mvc' . DS . 'views' . DS . 'admin.php';
        require_once '../views/home.php';
    }
}

<?php

require_once 'Controller.php';
require_once 'DefaultController.php';
class LoginController extends DefaultController implements Controller {
	public function __render(){
        require_once '../views/login.php';
    }
}

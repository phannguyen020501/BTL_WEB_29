<?php

require_once 'Controller.php';
require_once 'DefaultController.php';
class AdminController extends DefaultController implements Controller {
	public function __render(){
        require_once '../views/admin_page.php';
    }
}

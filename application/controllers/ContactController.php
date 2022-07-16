<?php

require_once 'Controller.php';
require_once 'DefaultController.php';
class ContactController extends DefaultController implements Controller {
	public function __render(){
        require_once '../views/contact.php';
    }
}

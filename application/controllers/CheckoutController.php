<?php

require_once 'Controller.php';
require_once 'DefaultController.php';
class CheckoutController extends DefaultController implements Controller {
	public function __render(){
        require_once 'C:\xampp\htdocs\BTL_WEB_29\application\views\checkout.php';
    }
}
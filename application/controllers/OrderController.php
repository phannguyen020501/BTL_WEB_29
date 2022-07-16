<?php

require_once 'Controller.php';
require_once 'DefaultController.php';
class OrderController extends DefaultController implements Controller {
	public function __render(){
        require_once '../views/order.php';
    }
}
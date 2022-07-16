<?php

require_once 'Controller.php';
require_once 'DefaultController.php';
class SearchController extends DefaultController implements Controller {
	public function __render(){
        require_once '../views/search_page.php';
    }
}
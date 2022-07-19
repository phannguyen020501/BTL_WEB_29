<?php

class RouteController {
    private $_url;
    private $_dispath;

    function __construct($url) {
        $this->_url = $url;
        self::parsingURL();
    }


    function parsingURL() {
        // call home page if path is '/'
        if(strcmp($this->_url, "/") == 0){
            require_once 'HomeController.php';
            $this->_dispath = new HomeController();
            return;
        }

        $urlArray = explode("/", $this->_url);
        $controller = $urlArray[0]; array_shift($urlArray);
        $id = -1;

        // check if details -> add id to url
        if(strcmp($controller, "details") == 0){
            $id = intval($urlArray[0]); array_shift($urlArray);
        }


        // if link is account-management => controller of link is AccountManagementController
        $controller = str_replace('_', ' ', $controller);
        $controller = ucwords($controller);
        $controller = str_replace(' ', '', $controller);
        
        $iparr = explode (".", $controller); 

        $controller = '';
        $controller.=$iparr[0];
        $controller .="Controller"; // example : AboutController, ContactController,...
        
       
        // include controller
        require_once $controller.'.php';

       
        $this->_dispath = new $controller($id);
        

    }

    function show() {
        $this->_dispath->__render();
    }
}

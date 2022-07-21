<?php

class RouteController {
    private $_url;
    private $_dispath;

    function __construct($url) {
        $this->_url = $url;
        self::parsingURL();
    }


    function parsingURL() {
        
        if(strcmp($this->_url, "/") == 0){
            require_once 'HomeController.php';
            $this->_dispath = new HomeController();
            return;
        }

        $urlArray = explode("/", $this->_url);
        $controller = $urlArray[0]; array_shift($urlArray);


        // admin_page.php -> AdminPageController.php
        $controller = str_replace('_', ' ', $controller);
        $controller = ucwords($controller);
        $controller = str_replace(' ', '', $controller);
        
        $iparr = explode (".", $controller); 

        $controller = '';
        $controller.=$iparr[0];
        $controller .="Controller"; 
        
       
        // include controller
        require_once $controller.'.php';

        $this->_dispath =new $controller();


    }

    function show() {
        $this->_dispath->__render();
    }
}

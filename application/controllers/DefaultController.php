<?php
class DefaultController {
  /*include header*/
  public function __header(){

  }

  /*include footer*/
	public function __footer(){
      require_once '../views/footer.php';
      // include ROOT . DS . 'mvc' . DS . 'views' . DS . 'footer.php';
    }
}

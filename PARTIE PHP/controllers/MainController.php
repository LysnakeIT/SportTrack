<?php
require('Controller.php');

class MainController implements Controller{

    public function handle($request){
        $_SESSION['message']= 'Hello World:';
    }
}
?>

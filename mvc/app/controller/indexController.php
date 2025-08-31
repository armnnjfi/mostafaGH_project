<?php
// include 'core/controller.php';
class indexController extends controller {
    public function __construct(){}

    public function home(){

        // echo $param1, "<br/>";
        // echo $param2, "<br/>";
        // include "app/view/home.php";
        $this->view("home");
    }

    public function search(){

        // include "app/view/search.php";
        $this->view("search");
    }
}

?>
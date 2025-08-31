<?php
class controller
{
    public $redirect_url = 'http://localhost/mvc/products';
    public function view($file_name, $data = '')
    {
        $this->nav('header');


        $new_csrf = new SecurityService();
        $new_csrf->getCSRFToken();
        include "app/view/" . $file_name . '.php';
    }
    public function nav($file_name)
    {
        include "app/view/Layout/" . $file_name . '.php';
    }
    public function check_auth()
    {
        if (isset($_SESSION['is_auth']) && $_SESSION['is_auth'] == 1) {
            return true;
        } else {
            return false;
        }
    }
}

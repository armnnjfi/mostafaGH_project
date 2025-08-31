<?php
require_once "init.php";
class AdminController extends controller
{
    public function dashboard()
    {
        if ($this->check_auth()) {
            $this->view("admin_dashboard");
        } else {
            header('location:' . Constants::BASE_URL . 'login');
            exit();
        }
    }
}

<?php
require_once "init.php";
class EmployeeController extends controller
{
    public function dashboard()
    {
        if ($this->check_auth()) {
            $this->view("employee_dashboard");
        } else {
            header('location:' . Constants::BASE_URL . 'login');
            exit();
        }
    }
}

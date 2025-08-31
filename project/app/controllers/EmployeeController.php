<?php
require_once "init.php";
class EmployeeController extends controller
{
    public function getEmployeesWithoutCompany()
    {
        $this->view('no_company_employees');
    }
}

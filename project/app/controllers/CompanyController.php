<?php
require_once "init.php";
class CompanyController extends controller
{
    public function addCompany()
    {
        $name = $_POST['companyName'];
        $new_company = new company();
        $new_company->insert($name);
        header('location: ' . Constants::BASE_URL . "dashboard/admin");
    }
    public function showPage()
    {
        $this->view('add_company');
    }
}

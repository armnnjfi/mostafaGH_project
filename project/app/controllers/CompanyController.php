<?php
require_once "init.php";
class CompanyController extends controller
{
    public function addCompany()
    {
        $csrf = new SecurityService();
        $csrf_token = $_POST['csrf-token'] ?? '';

        if (!$csrf->validate_token($csrf_token)) {
            die("Invalid CSRF token!");
        }

        $name = $_POST['companyName'];
        $new_company = new company();
        $new_company->insert($name);
        header('location: ' . Constants::BASE_URL . "dashboard/admin");
    }
    
    public function showPage()
    {
        $csrf = new SecurityService();
        $csrf->setCSRFToken();
        $this->view('add_company',['csrf_token' => $csrf->getCSRFToken()]);
    }
}

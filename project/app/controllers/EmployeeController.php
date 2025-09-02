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
    public function getEmployeesWithoutCompany()
    {
        if ($this->check_auth() && $this->is_admin()) {
            $employees = new Users();
            $noCompanyEmp = $employees->getNoCompanyEmployee();

            $company_obj = new Company();
            $companies = $company_obj->getCompanies();
            $csrf = new SecurityService();

            $this->view('no_company_employees', ['noCompanyEmp' => $noCompanyEmp, 'csrf_token' => $csrf->getCSRFToken(), 'companies' => $companies]);
        } else {
            header("location:" . Constants::BASE_URL . "login");
        }
    }

    public function setCompany()
    {
        if ($this->check_auth() && $this->is_admin()) {

            $new_csrf = new SecurityService();
            if (!$new_csrf->validate_token($_POST['csrf_token'])) {
                return var_dump('Error : CSRF Token invalid.');
            }
            $user_obj = new Users();
            foreach ($_POST['company_id'] as $user_id => $company_id) {
                if (empty($company_id)) {
                    continue;
                }
                $user_obj->userToEmployee($user_id, $company_id);

                $employee_obj = new Employee();
                $employee_obj->insert($user_id, $company_id);
            }

            header('Location: ' . Constants::BASE_URL . 'employee_list');
            exit();
        }
    }
}

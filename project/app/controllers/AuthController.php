<?php
require_once  "init.php";
class AuthController extends controller
{
    public function show_register_page()
    {
        if ($this->check_auth()) {
            if ($this->is_admin()) {
                header('location: ' . Constants::REDIRECT_ADMIN_URL);
                exit();
            } else {
                header('location: ' . Constants::REDIRECT_EMPLOYEE_URL);
                exit();
            }
        } else {
            $csrf = new SecurityService();
            $csrf->setCSRFToken();

            $this->view('register', ['csrf_token' => $csrf->getCSRFToken()]);
        }
    }

    public function save_user()
    {
        if (isset($_POST['register_button'])) {
            if (!empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['csrf-token'])) {
                $name = $_POST['name'];
                $password = $_POST['password'];
                $email = $_POST['email'];
                $csrf = $_POST['csrf-token'];

                $new_csrf = new SecurityService();
                if (!$new_csrf->validate_token($csrf)) {
                    return var_dump('Error : CSRF Token invalid.');
                }

                $new_user = new Users();
                echo $new_user->insert($name, $password, $email);

                header('location: ' . Constants::BASE_URL .  'login');
            } else {
                header('location: ' . Constants::BASE_URL .  'register');
            }
        }
    }


    public function show_login_page()
    {
        if ($this->check_auth()) {
            if ($this->is_admin()) {
                header('location: ' . Constants::REDIRECT_ADMIN_URL);
                exit();
            } else {
                header('location: ' . Constants::REDIRECT_EMPLOYEE_URL);
                exit();
            }
        } else {
            $csrf = new SecurityService();
            $this->view('login', ['csrf_token' => $csrf->getCSRFToken()]);
        }
    }



    public function user_login()
    {
        $csrf = new SecurityService();
        $csrf_token = $_POST['csrf-token'] ?? '';

        if (!$csrf->validate_token($csrf_token)) {
            die("Invalid CSRF token!");
        }

        $name = $_POST['Name'];
        $password = $_POST['password'];

        $user = new Users();
        $res = $user->find_user($name, $password);
        if ($res['response'] == 200) {
            $_SESSION['user_id'] = $res['message']['id'];
            $_SESSION['name'] = $res['message']['name'];
            $_SESSION['company_id'] = $res['message']['company_id'];
            $_SESSION['role'] = $res['message']['role'];
            $_SESSION['is_auth'] = 1;

            if ($this->is_admin()) {
                $this->view("admin_dashboard");
            } else {
                $this->view("employee_dashboard");
            }
        } else {
            header('location:' . Constants::BASE_URL . 'login');
            exit();
        }
    }

    public function logout()
    {
        session_destroy();
        header('location:' . Constants::BASE_URL . 'login');
        exit();
    }
}

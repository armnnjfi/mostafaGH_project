<?php

// include 'core/controller.php';

class AuthController extends controller {
    public function register() {
        if ($this->check_auth()) {
            header('location: '.$this->redirect_url);
            exit();
        } else {
            $this->view('register');
        }
    }

    public function storeUser() {
        $firstname = $_POST ['firstName'];
        $username = $_POST ['userName'];
        $password = $_POST ['password'];
        $email = $_POST['email'];
        $csrf = $_POST ['csrf-token'];

        $new_csrf = new SecurityService();
        if (!$new_csrf->validate_token($csrf)){
            return var_dump('Error : CSRF Token invalid.');
        }

        include 'app/model/user.php';
        $new_user = new user();
        echo $new_user->insert($firstname,$username,$password, $email);

        header('location: http://localhost/mvc/login');
    }

    public function activate_user($token){
        include 'app/model/user.php';
        $new_user = new user();
        $result = $new_user->activate_user($token);

        if ($result['response'] == 200) {
            header('location: http://localhost/mvc/login');
            exit();
        }
    }

    public function show_login() {
        if ($this->check_auth()) {
            header('location: '.$this->redirect_url);
            exit();
        } else {
            $this->view('login');
        }
    }

    public function login() 
    {

        
        $username = $_POST ['userName'];
        $password = $_POST ['password'];

        include 'app/model/user.php';
        $user = new user();
        $res = $user->find_user($username,$password);
        
        if ($res['response'] == 200) {
            $_SESSION['user_id'] = $res['message']['id'];
            $_SESSION['userName'] = $res['message']['username'];
            $_SESSION['firstName'] = $res['message']['name'];
            $_SESSION['type'] = $res['message']['type'];
            $_SESSION['is_auth'] = 1;
        } else {
            header('location: http://localhost/mvc/login');
            exit();
        }

        header('location: '.$this->redirect_url);
        exit();
    }
    public function logout() {
        session_destroy();
        header('location: http://localhost/mvc/login');
        exit();
    }
}

?>
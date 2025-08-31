<?php

class controller
{
    private $folderMap = [
        'register'  => 'auth',
        'login'     => 'auth',
        'employee_dashboard' => 'dashboard',
        'admin_dashboard' => 'dashboard',
    ];

    public function selectFolder($file_name)
    {
        return $this->folderMap[$file_name];
    }

    public function view($file_name, $data = '')
    {
        $folderName = $this->selectFolder($file_name);

        $this->nav('header');

        include "app/views/" . $folderName . "/" . $file_name . '.php';
    }

    public function nav($file_name)
    {
        include "app/views/layouts/" . $file_name . '.php';
    }


    public function check_auth()
    {
        if (isset($_SESSION['is_auth']) && $_SESSION['is_auth'] == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function is_admin()
    {
        if (isset($_SESSION['is_auth']) && $_SESSION['is_auth'] == 1 && $_SESSION['role'] == 'admin') {
            return true;
        }
        return false;
    }
}

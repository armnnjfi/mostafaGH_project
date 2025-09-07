<?php

class route
{
    public function __construct()
    {
        $url = $_GET['path'];
        $urls_arr = [
            //show register form
            [
                'url' => '/^register$/',
                'controller' => 'AuthController',
                'action' => 'show_register_page',
                'method' => 'GET'
            ],
            // register
            [
                'url' => '/^register$/',
                'controller' => 'AuthController',
                'action' => 'save_user',
                'method' => 'POST'
            ],
            //show login form
            [
                'url' => '/^login$/',
                'controller' => 'AuthController',
                'action' => 'show_login_page',
                'method' => 'GET'
            ],
            // login 
            [
                'url' => '/^login$/',
                'controller' => 'AuthController',
                'action' => 'user_login',
                'method' => 'POST'
            ],
            // Employee Dashboard
            [
                'url' => '#^dashboard/employee$#',
                'controller' => 'EmployeeController',
                'action' => 'dashboard',
                'method' => 'GET'
            ],
            // Admin Dashboard
            [
                'url' => '#^dashboard/admin$#',
                'controller' => 'AdminController',
                'action' => 'dashboard',
                'method' => 'GET'
            ],
            //Logout
            [
                'url' => '/^logout$/',
                'controller' => 'AuthController',
                'action' => 'logout',
                'method' => 'POST'
            ],
            //add new Company
            [
                'url' => '/^add_company$/',
                'controller' => 'CompanyController',
                'action' => 'addCompany',
                'method' => 'POST'
            ],

            //show add Company page
            [
                'url' => '/^add_company$/',
                'controller' => 'CompanyController',
                'action' => 'showPage',
                'method' => 'GET'
            ],
            //show employee list
            [
                'url' => '/^employee_list$/',
                'controller' => 'EmployeeController',
                'action' => 'getEmployeesWithoutCompany',
                'method' => 'GET'
            ],
            //set company for employees
            [
                'url' => '/^setCompanyForEmp$/',
                'controller' => 'EmployeeController',
                'action' => 'setCompany',
                'method' => 'POST'
            ],
            //check in / check out employees
            [
                'url' => '/^check_in_out$/',
                'controller' => 'AttendanceController',
                'action' => 'showForms',
                'method' => 'GET'
            ],
            // submit Attendance
            [
                'url' => '/^submit_Attendance$/',
                'controller' => 'AttendanceController',
                'action' => 'submitAttendance',
                'method' => 'POST'
            ],
            // show request form
            [
                'url' => '/^leave_form$/',
                'controller' => 'LeaveController',
                'action' => 'showForm',
                'method' => 'GET'
            ],
            // send request to admin
            [
                'url' => '/^leave_form$/',
                'controller' => 'LeaveController',
                'action' => 'leave',
                'method' => 'POST'
            ],

            // leave requests list
            [
                'url' => '/^leave_requests$/',
                'controller' => 'AdminController',
                'action' => 'showLeaveRequests',
                'method' => 'GET'
            ],
            // approve reject leave request
            [
                'url' => '/^approve_reject_request$/',
                'controller' => 'LeaveController',
                'action' => 'approve_reject_request',
                'method' => 'POST'
            ],
            // Attendance reports
            [
                'url' => '/^Attendance_reports$/',
                'controller' => 'AdminController',
                'action' => 'showAllAttendances',
                'method' => 'GET'
            ],

            // اضافه کردن به آرایه $urls_arr
            [
                'url' => '/^reports$/',
                'controller' => 'AdminController',
                'action' => 'reports',
                'method' => 'GET'
            ],
        ];
        $routing_fail = true;
        foreach ($urls_arr as $url_arr) {
            if (
                preg_match($url_arr['url'], $url, $matches) &&
                $url_arr['method'] == $_SERVER['REQUEST_METHOD']
            ) {
                $routing_fail = false;

                unset($matches[0]);
                include 'app/controllers/' . $url_arr['controller'] . '.php';
                $new_obj = new $url_arr['controller'];

                call_user_func_array([$new_obj, $url_arr['action']], array_values($matches));
            }
        }
        if ($routing_fail) {
            echo "(404) Page not found";
        }
    }
}

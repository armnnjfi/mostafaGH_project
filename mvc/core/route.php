<?php

class route
{
    public function __construct()
    {
        $url = $_GET['path'];
        $urls_array = [
            [
                'url' => '/^search$/',
                'controller' => 'indexController',
                'action' => 'search',
                'type' => 'GET'
            ],
            [
                'url' => '/^home$/',
                'controller' => 'indexController',
                'action' => 'home',
                'type' => 'GET'
            ],
            [
                'url' => '/^products$/',
                'controller' => 'productController',
                'action' => 'show_products',
                'type' => 'GET'
            ],
            [
                'url' => '/^product\/(.+)$/',
                'controller' => 'productController',
                'action' => 'show_product',
                'type' => 'GET'
            ],
            [
                'url' => '/^register$/',
                'controller' => 'authController',
                'action' => 'register',
                'type' => 'GET'
            ],
            [
                'url' => '/^register$/',
                'controller' => 'authController',
                'action' => 'storeUser',
                'type' => 'POST'
            ],
            [
                'url' => '/^login$/',
                'controller' => 'authController',
                'action' => 'show_login',
                'type' => 'GET'
            ],
            [
                'url' => '/^login$/',
                'controller' => 'authController',
                'action' => 'login',
                'type' => 'POST'
            ],
            [
                'url' => '/^logout$/',
                'controller' => 'authController',
                'action' => 'logout',
                'type' => 'POST'
            ],
            [
                'url' => '/^active-link\/(.+)$/',
                'controller' => 'authController',
                'action' => 'activate_user',
                'type' => 'GET'
            ]
        ];

        $route_fail = true;

        foreach ($urls_array as $url_arr) {
            if (
                preg_match($url_arr['url'], $url, $matches) &&
                $url_arr['type'] == $_SERVER['REQUEST_METHOD']
            ) {
                $route_fail = false;

                unset($matches[0]);
                include 'app/controller/' . $url_arr['controller'] . '.php';
                $new_obj = new $url_arr['controller'];

                call_user_func_array([$new_obj, $url_arr['action']], array_values($matches));
            }
        }
        if ($route_fail) {
            echo "(404) Page not found";
        }
    }
}

<?php

class Bootstrap
{
    function __construct()
    {

        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        // print_r($url);
        //if in root go to account page
        if (empty($url[0])) {
            require 'Controller/rankingController.php';
            $controller = new RankingController();
            $controller->index();
            return false;
        }

        $file = 'Controller/' . $url[0] . 'Controller.php';
        if (file_exists($file)) {
            require $file;
        } else {
            require 'Controller/errorController.php';
            new Error();
            return false;
        }

        $controllerClassName = $url[0] . 'Controller';
        $controller = new $controllerClassName;

        if (isset($url[1])) {
            if (isset($url[2])) {
                $controller->{$url[1]}($url[2]);
            } else {
                $controller->{$url[1]}();
            }
        } else {
            $controller->index();
        }
        /*
                require 'Controller/account.php';
                $controller = new Account();
                if (isset($url[1]) && $url[1] == 'login') {
                    $controller->login();
                } else {
                    $controller->index();
                }*/
        return false;


    }
}

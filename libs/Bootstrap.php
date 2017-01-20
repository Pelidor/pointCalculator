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

        $file = 'controllers/' . $url[0] . '.php';
        if (file_exists($file)) {
            require $file;
        } else {
            require 'controllers/error.php';
            new Error();
            return false;
        }


        $controller = new $url[0];

        if (isset($url[1])) {
            if (isset($url[2])) {
                $controller->{$url[1]}($url[2]);
            } else {
                $controller->{$url[1]}();
            }
        } else {
            $controller->index();
        }

        require 'controllers/account.php';
        $controller = new Account();
        if (isset($url[1]) && $url[1] == 'login') {
            $controller->login();
        } else {
            $controller->index();
        }
        return false;


    }
}
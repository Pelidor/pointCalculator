<?php

/**
 * Created by PhpStorm.
 * User: Stephan Hauff
 * Date: 03.03.2016
 * Time: 13:33
 */
class View
{
    function __construct()
    {
        //echo 'View construct<br>';
    }

    public function render($name, $data = array(), $pagename='Pagename')
    {
        require 'views/' . $name . '.phtml';
    }
}
<?php

class Model
{

    function __construct()
    {
        require_once "/env.php";
        $database_host = $var["database_host"];
        $database_name = $var["database_name"];
        $database_user = $var["database_user"];
        $database_pass = $var["database_pass"];

        $this->database = $pdo = new PDO("mysql:host=$database_host;dbname=$database_name", $database_user, $database_pass);
        if ($this->database->connect_error) {
            die('Connect Error (' . $this->database->connect_errno . ') '
                . $this->database->connect_error);
        }
    }
}
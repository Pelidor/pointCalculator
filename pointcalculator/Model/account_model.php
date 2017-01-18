<?php
/**
 * Created by PhpStorm.
 * User: Stephan Hauff
 * Date: 03.03.2016
 * Time: 14:47
 */
class Account_Model extends Model{
    function __construct()
    {
        parent::__construct();
    }
    function login_model($user){
        $stmt = $this->database->prepare("SELECT BID, Passwort FROM benutzer WHERE Name = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $res = $stmt->get_result();

        $row = $res->fetch_assoc();
        $user = Array();
        $user['BID'] = $row['BID'];
        $user['dbPasswort'] = $row['Passwort'];

        return $user;
    }
}
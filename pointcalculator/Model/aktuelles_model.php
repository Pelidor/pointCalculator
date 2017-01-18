<?php
/**
 * Created by PhpStorm.
 * User: Stephan Hauff
 * Date: 08.03.2016
 * Time: 11:51
 */
class Aktuelles_Model extends Model{
    function __construct()
    {
        parent::__construct();
    }
    public function getAktuelles(){
        $res = $this->database->query("SELECT 'Vorschlag' as Typ , v.Titel, v.time, b.Name FROM vorschlaege v, benutzer b WHERE v.BID = b.BID UNION SELECT 'Stimme', v.Titel, s.time, b.Name FROM vorschlaege v, benutzer b, stimmen s WHERE b.BID = s.BID AND v.VID = s.VID ORDER BY time DESC LIMIT 10");
        return $res;
    }
}
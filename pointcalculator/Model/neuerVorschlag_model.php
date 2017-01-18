<?php

/**
 * Created by PhpStorm.
 * User: Stephan Hauff
 * Date: 08.03.2016
 * Time: 08:51
 */
class NeuerVorschlag_Model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function insertNeuerVorschlag($bid, $title, $description)
    {
        $stmt = $this->database->prepare("INSERT INTO vorschlaege (BID, Titel, Beschreibung) VALUES (?, ?, ?);");
        $stmt->bind_param('iss', $bid,$title,$description);
        $res = $stmt->execute();
        return $res;
    }
}
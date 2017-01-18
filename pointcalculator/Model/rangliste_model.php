<?php

/**
 * Created by PhpStorm.
 * User: Stephan Hauff
 * Date: 08.03.2016
 * Time: 11:31
 */
class Rangliste_Model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getRangliste()
    {
        $res = $this->database->query("SELECT v.VID, b.Name, v.Titel, v.Beschreibung, v.votes, v.time FROM vorschlaege v, benutzer b WHERE v.BID = b.BID ORDER BY votes DESC");
        return $res;
    }

    public function getVotes($bid)
    {
        $stmt = $this->database->prepare("SELECT VID FROM stimmen WHERE BID = ?");
        $stmt->bind_param("i", $bid);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res;
    }

    public function upvote($vid, $bid)
    {
        $stmt = $this->database->prepare("INSERT INTO stimmen (VID, BID) VALUES ( ? , ? )");
        $stmt->bind_param("ii", $vid, $bid);
        $stmt->execute();
        $stmt->close();


        $stmt = $this->database->prepare("UPDATE vorschlaege SET votes = votes + 1 WHERE VID = ? ");
        $stmt->bind_param("i", $vid);
        $stmt->execute();
        $stmt->close();
    }

    public function downvote($vid, $bid)
    {
        $stmt = $this->database->prepare("DELETE FROM stimmen WHERE VID = ? AND BID = ?");
        $stmt->bind_param("ii", $vid, $bid);
        $stmt->execute();
        $stmt->close();


        $stmt = $this->database->prepare("UPDATE vorschlaege SET votes = votes - 1 WHERE VID = ?");
        $stmt->bind_param("i", $vid);
        $stmt->execute();
        $stmt->close();
    }


}
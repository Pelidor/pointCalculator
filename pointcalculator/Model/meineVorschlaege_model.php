<?php

/**
 * Created by PhpStorm.
 * User: Stephan Hauff
 * Date: 07.03.2016
 * Time: 14:30
 */
class MeineVorschlaege_Model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getMeineVorschlaege()
    {
        $bid = $_SESSION['BID'];
        if (!($stmt = $this->database->prepare("SELECT VID, Titel, Beschreibung, votes, time FROM vorschlaege WHERE BID = ? ORDER BY time DESC"))) {
            echo "Prepare failed: (" . $this->database->errno . ") " . $this->database->error;
        }
        if (!$stmt->bind_param("i", $bid)) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        $res = $stmt->get_result();

        $stmt->close();
        return $res;
    }

    public function delete($vid)
    {
        $this->database->query("SET foreign_key_checks = 0");
        //DELETE FROM vorschlaege
        if (!($stmt = $this->database->prepare("DELETE FROM vorschlaege WHERE VID = ?;"))) {
            echo "Prepare failed: (" . $this->database->errno . ") " . $this->database->error;
        } elseif (!$stmt->bind_param("i", $vid)) {
            echo "Binding failed: (" . $this->database->errno . ") " . $this->database->error;
        } elseif (!$stmt->execute()) {
            echo "Execute failed: (" . $this->database->errno . ") " . $this->database->error;
        }
        //DELETE FROM stimmen
        if (!($stmt = $this->database->prepare("DELETE FROM stimmen WHERE VID = ?;"))) {
            echo "Prepare failed: (" . $this->database->errno . ") " . $this->database->error;
        } elseif (!$stmt->bind_param("i", $vid)) {
            echo "Binding failed: (" . $this->database->errno . ") " . $this->database->error;
        } elseif (!$stmt->execute()) {
            echo "Execute failed: (" . $this->database->errno . ") " . $this->database->error;
        }
        $this->database->query("SET foreign_key_checks = 1");

    }
}
<?php

class Ranking extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getRanking()
    {
        $result = $this->database->query("SELECT d.DID,d.name,p.position FROM driver d JOIN position p ON p.DID = d.DID;");

        $ranking = array();
        foreach ($result->fetchAll() as $row) {
//            echo $row['name'] . " " . $row['position'] . '<br>';
            if (!isset($ranking[$row['name']])) {
                $ranking[$row['name']] = 0;
            }

            if ($row['position'] < 11) {
                switch ($row['position']) {
                    case 1:
                        $ranking[$row['name']] += 25;
                        break;
                    case 2:
                        $ranking[$row['name']] += 18;
                        break;
                    case 3:
                        $ranking[$row['name']] += 15;
                        break;
                    case 4:
                        $ranking[$row['name']] += 12;
                        break;
                    case 5:
                        $ranking[$row['name']] += 10;
                        break;
                    case 6:
                        $ranking[$row['name']] += 8;
                        break;
                    case 7:
                        $ranking[$row['name']] += 6;
                        break;
                    case 8:
                        $ranking[$row['name']] += 4;
                        break;
                    case 9:
                        $ranking[$row['name']] += 2;
                        break;
                    case 10:
                        $ranking[$row['name']] += 1;
                        break;
                }

            }
        }
        arsort($ranking);
        return $ranking;
    }
} 
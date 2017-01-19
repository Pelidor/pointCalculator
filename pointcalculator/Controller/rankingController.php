<?php

class RankingController extends Controller {
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        require 'Model/ranking.php';
        $ranking = new Ranking();
        $ranking->getRanking();

        echo "Ranking";

    }
}
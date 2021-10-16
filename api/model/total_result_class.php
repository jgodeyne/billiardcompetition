<?php

include_once("ppa/database_class.php");

class TotalResult {

    public $playerId;
    public $playerName;
    public $playerTsp;
    public $nbrOfMatches;
    public $points;
    public $innings;
    public $average;
    public $highestRun;
    public $matchpoints;
    public $bonuspoints;
    public $rankingpoints;
    public $avgpct;
    public $highestRunPct;

    public static function rankingList($competitionId) {
        $db = new Database();
        $db->connect();
        $query = "SELECT players.id as playerId"
                . ", name as playerName"
                . ", tsp as playerTsp"
                . ", count(results.id) as nbrOfMatches"
                . ", SUM(points) as points"
                . ", SUM(innings) as innings"
                . ", SUM(points)/SUM(innings) as average"
                . ", MAX(highest_run) as highestRun"
                . ", SUM(matchpoints) as matchpoints"
                . ", SUM(bonuspoints) as bonuspoints"
                . ", SUM(rankingpoints) as rankingpoints"
                . ", (SUM(points)/SUM(innings))/min * 100 as avgpct"
                . ", MAX(highest_run)/tsp * 100 as highestRunPct"
                . " from players"
                . " left join (results) on (players.id=results.player_id)"
                . " where competition_id = " . $competitionId
                . " group by players.id"
                . " order by rankingpoints desc, avgpct desc";
        //error_log($query);
        $result = $db->query($query);
        $objects = null;
        while ($object = $db->fetchObject($result, get_called_class())) {
            $objects[] = $object;
        }
        $db->disconnect();
        return $objects;
    }

    public static function rankingPlayer($playerId) {
        $db = new Database();
        $db->connect();
        $query = "SELECT players.id as playerId"
                . ", name as playerName"
                . ", count(results.id) as nbrOfMatches"
                . ", SUM(points) as points"
                . ", SUM(innings) as innings"
                . ", SUM(points)/SUM(innings) as average"
                . ", MAX(highest_run) as highestRun"
                . ", SUM(matchpoints) as matchpoints"
                . ", SUM(bonuspoints) as bonuspoints"
                . ", SUM(rankingpoints) as rankingpoints"
                . ", (SUM(points)/SUM(innings))/min * 100 as avgpct"
                . ", MAX(highest_run)/tsp * 100 as highestRunPct"
                . " from players"
                . " left join (results) on (players.id=results.player_id)"
                . " where players.id = " . $playerId
                . " group by players.id"
                . " order by results.rankingpoints desc";
        //error_log($query);
        $result = $db->query($query);
        $object = $db->fetchObject($result, get_called_class());
        $db->disconnect();
        return $object;
    }
}

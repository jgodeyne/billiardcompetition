<?php

include_once("ppa/entity_class.php");
include_once 'util/date_functions.php';
include_once 'player_class.php';
include_once 'result_class.php';
include_once 'competition_class.php';

class Match extends Entity implements EntityInterface {

    public $date;
    public $place;
    public $round;
    public $player_1_id;
    public $player_2_id;
    public $competition_id;
    public $player1;
    public $player2;
    public $result1;
    public $result2;

    public function getProperties() {
        return get_object_vars($this);
    }

    public function setFromPost($post) {
        $this->date = htmlspecialchars($post['date']);
        $this->place = htmlspecialchars($post['place']);
        $this->round = htmlspecialchars($post['round']);
        $this->player1Id = htmlspecialchars($post['player_1_id']);
        $this->player2Id = htmlspecialchars($post['player_2_id']);
        $this->competitionId = htmlspecialchars($post['competition_id']);
    }

    public static function findMatchesForThisWeek($competition_id) {
        $enddate = strtotime("Sunday"); //next Sunday
        $startdate = strtotime("-1 week", $enddate);
        $matches = Match::findAllByCriteriaOrdened("competition_id=" . $competition_id
                        . " and date>='" . date("Y-m-d", $startdate)
                        . "' and date<='" . date("Y-m-d", $enddate) . "'"
                        , "date asc, place, player_1_id");
        foreach ($matches as $match) {
            $match->player1=Player::findById($match->player_1_id);
            $match->player2=Player::findById($match->player_2_id);
            $match->result1=Result::findByMatchIdAndPlayerId($match->id, $match->player_1_id);
            $match->result2=Result::findByMatchIdAndPlayerId($match->id, $match->player_2_id);
        }
        return $matches;
    }

    public static function findMatchesPerRound($competition_id) {
        $competition = Competition::findById($competition_id);
        $rounds = array();
        //error_log($competition->getName() . " - " . $competition->rounds);
        if(null!=$competition) {
            for($i=0 ; $i<$competition->getRounds() ;$i++) {
                //error_log($competition->getName() . " - " . $i);
                $rounds[$i]= Match::findByRound($competition_id, $i+1);
            }
        }
        return $rounds;
    }

    public static function findByRound($competitionId, $round) {
        $matches = Match::findAllByCriteriaOrdened("competition_id=" . $competitionId
                        . " and round = " . $round, "date asc, place, player_1_id");
        foreach ($matches as $match) {
            $match->player1=Player::findById($match->player_1_id);
            $match->player2=Player::findById($match->player_2_id);
            $match->result1=Result::findByMatchIdAndPlayerId($match->id, $match->player_1_id);
            $match->result2=Result::findByMatchIdAndPlayerId($match->id, $match->player_2_id);
        }
        return $matches;
    }

    public static function findByPlayer($player_id) {
        $matches = Match::findAllByCriteriaOrdened("player_1_id = " . $player_id . " or player_2_id = "
                        . $player_id, "date asc, place, player_1_id");
        foreach ($matches as $match) {
            $match->player1=Player::findById($match->player_1_id);
            $match->player2=Player::findById($match->player_2_id);
            $match->result1=Result::findByMatchIdAndPlayerId($match->id, $match->player_1_id);
            $match->result2=Result::findByMatchIdAndPlayerId($match->id, $match->player_2_id);
        }
        return $matches;
    }
}

<?php

include_once("ppa/entity_class.php");
include_once("match_class.php");
include_once("player_class.php");

class Result extends Entity implements EntityInterface {

    public $points;
    public $innings;
    public $average;
    public $highest_run;
    public $matchpoints;
    public $bonuspoints;
    public $rankingpoints;
    public $player_id;
    public $match_id;
    public $opponent_player_id;
    public $opponent_player_name;

    public function getProperties() {
        return get_object_vars($this);
    }

    public function setFromPost($post) {
        $this->points = htmlspecialchars($post['points']);
        $this->innings = htmlspecialchars($post['innings']);
        $this->average = htmlspecialchars($post['average']);
        $this->highest_run = htmlspecialchars($post['highest_run']);
        $this->matchpoints = htmlspecialchars($post['matchpoints']);
        $this->bonuspoints = htmlspecialchars($post['bonuspoints']);
        $this->rankingpoints = htmlspecialchars($post['rankingpoints']);
        $this->player_id = htmlspecialchars($post['player_id']);
        $this->match_id = htmlspecialchars($post['match_id']);
    }

    public static function findByMatchIdAndPlayerId($match_id, $player_id) {
        $result = Result::findByCriteria("match_id = '" . $match_id . "' and player_id='" . $player_id . "'");
        $match = Match::findById($result->match_id);
        if ($match->player_1_id == $result->player_id) {
            $result->opponent_player_id = $match->player_2_id;
        } else {
            $result->opponent_player_id = $match->player_1_id;
        }
        $player = Player::findById($result->opponent_player_id);
        $result->opponent_player_name = $player->name;
        
        return $result;
    }

    public static function findByPlayerId($player_id) {
        $results = Result::findAllByCriteria("player_id='" . $player_id . "'");
        foreach ($results as $result) {
            $match = Match::findById($result->match_id);
            if ($match->player_1_id == $result->player_id) {
                $result->opponent_player_id = $match->player_2_id;
            } else {
                $result->opponent_player_id = $match->player_1_id;
            }
            $player = Player::findById($result->opponent_player_id);
            $result->opponent_player_name = $player->name;
        }
        return $results;
    }
}

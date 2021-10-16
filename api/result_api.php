<?php

require_once 'model/result_class.php';
require_once("model/match_class.php");
require_once("model/player_class.php");

try {
    if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "POST") {
        $match_id = filter_input_array(INPUT_POST, "match_id");
        $match = Match::findById($match_id);
        $player1 = Player::findById($match->player_1_id);
        $player2 = Player::findById($match->player_2_id);

        $innings = filter_input_array(INPUT_POST, "innings");
        $points1 = filter_input_array(INPUT_POST, "player_1_points");
        $highest_run1 = filter_input_array(INPUT_POST, "player_1_highest_run");
        $points2 = filter_input_array(INPUT_POST, "player_2_points");
        $highest_run2 = filter_input_array(INPUT_POST, "player_2_highest_run");

        $avg1 = $points1 / $innings;
        $avg2 = $points2 / $innings;

        $mp1 = 0;
        $mp2 = 0;
        if ($points1 == $player1->tsp && $points2 == $player2->tsp) {
            $mp1 = 1;
            $mp2 = 1;
        } else if ($points1 == $player1->tsp) {
            $mp1 = 2;
        } else {
            $mp2 = 2;
        }

        $bp1 = 0;
        if ($avg1 > $player1->max) {
            $bp1 = 3;
        } else if ($avg1 >= $player1->min) {
            $bp1 = 1;
        }

        $bp2 = 0;
        if ($avg2 > $player2->max) {
            $bp2 = 3;
        } else if ($avg2 >= $player2->min) {
            $bp2 = 1;
        }

        $rp1 = $mp1 + $bp1;
        $rp2 = $mp2 + $bp2;

        $result1 = new Result();
        $result1->match_id = $match_id;
        $result1->palyer_id = $match->player_1_id;
        $result1->points = $points1;
        $result1->innings = $innings;
        $result1->average = $avg1;
        $result1->highest_run = $highest_run1;
        $result1->matchpoints = $mp1;
        $result1->bonuspoints = $bp1;
        $result1->rankingpoints = $rp1;
        $result1->save();

        $result2 = new Result();
        $result2->match_id = $match_id;
        $result2->palyer_id = $match->player_2_id;
        $result2->points = $points2;
        $result2->innings = $innings;
        $result2->average = $avg2;
        $result2->highest_run = $highest_run2;
        $result2->matchpoints = $mp2;
        $result2->bonuspoints = $bp2;
        $result2->rankingpoints = $rp2;
        $result2->save();
    } else if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "GET") {
        if (null != filter_input(INPUT_GET, 'match_id') && (null != filter_input(INPUT_GET, 'player_id'))) {
            $match_id = filter_input(INPUT_GET, 'match_id');
            $player_id = filter_input(INPUT_GET, 'playe_id');
            $result = Result::findByMatchIdAndPlayerId($match_id, $player_id);
            $json = $results;
        } else if (null != filter_input(INPUT_GET, 'player_id')) {
            $player_id = filter_input(INPUT_GET, 'player_id');
            $results = Result::findByPlayerId($player_id);
            $json = $results;
        } else {
            $json = array("status" => 0, "msg" => "Request method not accepted");
        }
    } else {
        $json = array("status" => 0, "msg" => "Request method not accepted");
    }
} catch (Exception $ex) {
    $json = array("status" => 0, "msg" => $ex->getMessage());
}

/* Output header */
header('Content-type: application/json');
echo json_encode($json);

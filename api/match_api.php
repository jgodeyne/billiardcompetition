<?php

require_once 'model/match_class.php';

$json = "";
try {
    if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "POST") {
        // create match
        $match = new Match();
        $match->setFromPost(filter_input_array(INPUT_POST));
        $match->save();
    } else if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "PUT") {
        // update match
        if (null!=filter_input(INPUT_POST, 'id')) {
            $id = filter_input(INPUT_POST, 'id');
            $match = Match::findById($id);
            $match->setFromPost(filter_input_array(INPUT_POST));
            $match->save();
        }
    } else if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "DELETE") {
        if (null!=filter_input(INPUT_POST, 'id')) {
            $id = filter_input(INPUT_POST, 'id');
            $match = Match::findById($id);
            $match->delete();
        }
    } else if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "GET") {
        if (null!=filter_input(INPUT_GET, 'id')) {
            $id = filter_input(INPUT_GET, 'id');
            $match = Match::findById($id);
            if(null!=$match) {
                $json = $match;
            } else {
                $json = array("status" => 0, "msg" => "Match not found");
            }
        }elseif (null!=filter_input(INPUT_GET, 'competition_id')) {
            $id = filter_input(INPUT_GET, 'competition_id');
            if(null!= filter_input(INPUT_GET, 'round')) {
                $round= filter_input(INPUT_GET, 'round');
                $matches = Match::findByRound($id, $round);
                $json = $matches;      
            } else {
                $matches = Match::findMatchesForThisWeek($id);
                $json = $matches;            
           }
        } else if (null!=filter_input(INPUT_GET, 'player_id')) {
            $player_id = filter_input(INPUT_GET, 'player_id');
            $matches = Match::findByPlayer($player_id);
            $json = $matches;            
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

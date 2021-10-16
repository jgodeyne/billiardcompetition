<?php

require_once 'model/player_class.php';

try {
    if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "POST") {
        // create player
        $player = new Player();
        $player->setFromPost(filter_input_array(INPUT_POST));
        $player->save();
    } else if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "PUT") {
        // update player
        if (null!=filter_input(INPUT_POST, 'id')) {
            $id = filter_input(INPUT_POST, 'id');
            $player = Player::findById($id);
            $player->setFromPost(filter_input_array(INPUT_POST));
            $player->save();
        }
    } else if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "DELETE") {
        if (null!=filter_input(INPUT_POST, 'id')) {
            $id = filter_input(INPUT_POST, 'id');
            $player = Player::findById($id);
            $player->delete();
        }
    } else if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "GET") {
        if (null!=filter_input(INPUT_GET, 'id')) {
            $id = filter_input(INPUT_GET, 'id');
            $player = Player::findById($id);
            if(null!=$player) {
                $json = $player;
            } else {
                $json = array("status" => 0, "msg" => "Player not found");
            }
        } else {
            $players = Player::findAll();
            $json = $players;            
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

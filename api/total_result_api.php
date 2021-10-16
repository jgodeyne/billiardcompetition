<?php

require_once 'model/total_result_class.php';

try {
    if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "GET") {
        if (null!=filter_input(INPUT_GET, 'competition_id')) {
            $id = filter_input(INPUT_GET, 'competition_id');
            $total_results = TotalResult::rankingList($id);
            $json = $total_results;            
        } else if (null!=filter_input(INPUT_GET, 'player_id')) {
            $id = filter_input(INPUT_GET, 'player_id');
            $total_results = TotalResult::rankingPlayer($id);
            $json = $total_results;            
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

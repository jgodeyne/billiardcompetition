<?php

require_once 'model/competition_class.php';

try {
    if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "POST") {
        // create competition
        $competition = new Competition();
        $competition->setFromPost(filter_input_array(INPUT_POST));
        $competition->save();
    } else if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "PUT") {
        // update competition
        if (null!=filter_input(INPUT_POST, 'id')) {
            $id = filter_input(INPUT_POST, 'id');
            $competition = Competition::findById($id);
            $competition->setFromPost(filter_input_array(INPUT_POST));
            $competition->save();
        }
    } else if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "DELETE") {
        if (null!=filter_input(INPUT_POST, 'id')) {
            $id = filter_input(INPUT_POST, 'id');
            $competition = Competition::findById($id);
            $competition->delete();
        }
    } else if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "GET") {
        if (null!=filter_input(INPUT_GET, 'id')) {
            $id = filter_input(INPUT_GET, 'id');
            $competition = Competition::findById($id);
            if(null!=$competition) {
                $json = $competition;
            } else {
                $json = array("status" => 0, "msg" => "Competition not found");
            }
        } else {
            $competitions = Competition::findAll();
            $json = $competitions;            
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

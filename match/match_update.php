<?php
include_once("../common/session.php");
include_once("match_class.php");

$competition_id=$_POST["competition_id"];
$id = htmlspecialchars($_POST["match_id"]);
$match = Match::findById($id);
$match->setFromPost($_POST);
$match->save();

header("Location: ../match/match_list.php?competition_id=" . $competition_id);
exit(0);
?>	
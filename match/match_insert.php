<?php
include_once("../common/session.php");
include_once("match_class.php");

$competition_id = $_POST["competition_id"];
$match= new Match();
$match->setFromPost($_POST);
$match->save();

header("Location: match_list.php?competition_id=" . $competition_id);
exit(0);
?>	
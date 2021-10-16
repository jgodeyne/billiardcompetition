<?php
include_once("../common/session.php");
include_once("competition_class.php");

$id = htmlspecialchars($_POST['competition_id']);
$competition = Competition::findById($id);
$competition->setFromPost($_POST);
$competition->save();

header("Location: ../competition/competition_list.php");
exit(0);
?>	
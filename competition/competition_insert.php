<?php
include_once("../common/session.php");
include_once("competition_class.php");

$competition= new Competition();
$competition->setFromPost($_POST);
$competition->save();

header("Location: ../competition/competition_list.php");
exit(0);
?>	
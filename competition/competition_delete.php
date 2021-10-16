<?php
include_once("../common/session.php");
include_once("competition_class.php");
$id=htmlspecialchars($_GET["competition_id"]);
$competition=competition::findById($id);
$competition->delete();
header("Location: ../competition/competition_list.php");
exit(0);
?>
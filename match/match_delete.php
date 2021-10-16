<?php
include_once("../common/session.php");
include_once("match_class.php");
$competition_id=htmlspecialchars($_GET["competition_id"]);
$id=htmlspecialchars($_GET["match_id"]);
$match=Match::findById($id);
$match->delete();
header("Location: ../match/match_list.php?competition_id=" . $competition_id);
exit(0);
?>
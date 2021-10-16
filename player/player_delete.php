<?php
include_once("../common/session.php");
include_once("player_class.php");
$competition_id=htmlspecialchars($_GET["competition_id"]);
$id=htmlspecialchars($_GET["id"]);
$player=player::findById($id);
$player->delete();
header("Location: ../player/player_list.php?competition_id=" . $competition_id);
exit(0);
?>
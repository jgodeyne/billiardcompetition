<?php
include_once("../common/session.php");
include_once("player_class.php");

$competition_id=$_POST["competition_id"];
$id = htmlspecialchars($_POST['id']);
$player = Player::findById($id);
$player->setFromPost($_POST);
$player->save();

header("Location: ../player/player_list.php?competition_id=" . $competition_id);
exit(0);
?>	
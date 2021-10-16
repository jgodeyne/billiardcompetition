<?php
include_once("../common/session.php");
include_once("match_class.php");
include_once("../player/player_class.php");
include_once("../result/result_class.php");

$match_id = $_POST["match_id"];
$match = Match::findById($match_id);
$player1 = Player::findById($match->getPlayer1Id());
$player2 = Player::findById($match->getPlayer2Id());

$innings = $_POST["innings"];
$points1 = $_POST["player_1_points"];
$highest_run1 = $_POST["player_1_highest_run"];
$points2 = $_POST["player_2_points"];
$highest_run2 = $_POST["player_2_highest_run"];

$avg1 = $points1 / $innings;
$avg2 = $points2 / $innings;

$mp1 = 0;
$mp2 = 0;
if ($points1==$player1->getTsp() && $points2==$player2->getTsp()) {
	$mp1 = 1;
	$mp2 = 1;
} else if ($points1==$player1->getTsp()) {
	$mp1 = 2;
} else {
	$mp2 = 2;
}

$bp1=0;
if($avg1 > $player1->getMax()) {
	$bp1=3;
} else if ($avg1 >= $player1->getMin()) {
	$bp1=1;
}

$bp2=0;
if($avg2 > $player2->getMax()) {
	$bp2=3;
} else if ($avg2 >= $player2->getMin()) {
	$bp2=1;
}

$rp1 = $mp1 + $bp1;
$rp2 = $mp2 + $bp2;

$result1=new Result();
$result1->setMatchId($match_id);
$result1->setPlayerId($match->getPlayer1Id());
$result1->setPoints($points1);
$result1->setInnings($innings);
$result1->setAverage($avg1);
$result1->setHighestRun($highest_run1);
$result1->setMatchpoints($mp1);
$result1->setBonuspoints($bp1);
$result1->setRankingpoints($rp1);
$result1->save();

$result2=new Result();
$result2->setMatchId($match_id);
$result2->setPlayerId($match->getPlayer2Id());
$result2->setPoints($points2);
$result2->setInnings($innings);
$result2->setAverage($avg2);
$result2->setHighestRun($highest_run2);
$result2->setMatchpoints($mp2);
$result2->setBonuspoints($bp2);
$result2->setRankingpoints($rp2);
$result2->save();

header("Location: match_result_view.php?match_id=" . $match_id);
exit(0);
?>	

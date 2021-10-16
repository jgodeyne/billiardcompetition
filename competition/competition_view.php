<?php 
include_once("../common/session.php");
include_once("../common/html_head.php");
include_once("competition_class.php");
include_once("../result/result_class.php");
include_once("../result/total_result_class.php");
include_once("../player/player_class.php");
include_once("../match/match_class.php");
?>
<body>
<? include("../common/header.php"); ?>
<? include("../common/main_menu.php"); ?>
<div id="middle">
<div id="main">
<div id="klassement">
<?php
try {
$id=htmlspecialchars($_GET["competition_id"]);
$competition=competition::findById($id);
?>
<h1><?=$competition->getName()?></h1>
<h2>Klassement - <a href="#thisweek">Deze Week</a> - <a href="#schedule">Kalender</a></h2>
<table class="list">
<thead>
<tr>
<td>&nbsp;</td>
<td>Naam</td>
<td>&nbsp;</td>
<td>Aantal<br>Wedstrijden</td>
<td>Ranking<br>Punten</td>
<td>Match<br>Punten</td>
<td>Bonus<br>Punten</td>
<td>Punten</td>
<td>Beurten</td>
<td colspan="2">Gemiddelde</td>
<td>Hoogste<br>Reeks</td>
</tr>
</thead>
<tbody>
<?php 
$results = TotalResult::rankingList($id);
$rang = 0;
if(isset($results)) {
	foreach ($results as $result) {
		$player=Player::findById($result->getPlayerId());
		$rang = $rang + 1;
?>
<tr>
<td><?=$rang?></td>
<td><a href="../player/player_view.php?player_id=<?=$result->getPlayerId()?>"><?=$result->getPlayerName()?></a></td><td>(<?=$player->getTsp()?>)</td>
<td><?=$result->getNbrOfMatches()?></td>
<td><?=$result->getRankingpoints()?></td>
<td><?=$result->getMatchpoints()?></td>
<td><?=$result->getBonuspoints()?></td>
<td><?=$result->getPoints()?></td>
<td><?=$result->getInnings()?></td>
<td><?=number_format($result->getAverage(),2,",",".")?></td>
<td>(<?=number_format($result->getAvgPct(),2,",",".")?>%)</td>
<td><?=$result->getHighestRun()?></td>
</tr>
<?php } } ?>
</tbody>
</table>
</div>
<div id="thisweek">
<h2>Deze Week <a href="#klassement">&uarr;</a></h2>
<table class="list">
<thead>
<tr>
<td>Datum</td>
<td>Plaats</td>
<td>Speler 1</td>
<td>Speler 2</td>
<td>Uitslag</td>
</tr>
</thead>
<tbody>
<?php 
$matches = Match::findMatchesForThisWeek($id);

if(isset($matches)) {
	foreach ($matches as $match) {
		$player1 = Player::findById($match->getPlayer1Id());
		$player2 = Player::findById($match->getPlayer2Id());
?>
<tr>
<td><?=$match->getDate()?></td>
<td><?=$match->getPlace()?></td>
<td><?=$player1->getName()?> (<?=$player1->getTsp()?>)</td>
<td><?=$player2->getName()?> (<?=$player2->getTsp()?>)</td>
<td>
<?php 
$result1 = Result::findByMatchIdAndPlayerId($match->getId(), $player1->getId());
$result2 = Result::findByMatchIdAndPlayerId($match->getId(), $player2->getId());
$resultstr = "";
if($sec_level>0) {
	$resultstr = "<a href='../match/match_result_form.php?match_id=" . $match->getId() . "'>-</a>";
}
if (isset($result1) && isset($result2)) {
	$resultstr = "<a href='../match/match_result_view.php?match_id=" . $match->getId() . "'>" 
		. $result1->getRankingpoints() . " - " . $result2->getRankingpoints() . "</a>";
}
?>
<?=$resultstr?>
</td>
</tr>
<?php } } ?>
</tbody>
</table>
<tbody>
</div>
<div id="schedule">
<h2>Kalender <a href="#klassement">&uarr;</a></h2>
<?php 
for ($round = 1; $round <= $competition->getRounds(); $round++) {
?>
<a href="#ronde_<?=$round?>">Ronde <?=$round?></a>&nbsp;
<?php } ?>
<?php 
for ($round = 1; $round <= $competition->getRounds(); $round++) {
?>
<div id="ronde_<?=$round?>">
<h3>Ronde <?=$round?> <a href="#schedule">&uarr;</a></h3>
<table class="list">
<thead>
<tr>
<td>Datum</td>
<td>Plaats</td>
<td>Speler 1</td>
<td>Speler 2</td>
<td>Uitslag</td>
</tr>
</thead>
<tbody>
<?php
$matches = Match::findByRound($id, $round);
if(isset($matches)) {
foreach ($matches as $match) {
	$player1 = Player::findById($match->getPlayer1Id());
	$player2 = Player::findById($match->getPlayer2Id());
?>
<tr>
<td><?=$match->getDate()?></td>
<td><?=$match->getPlace()?></td>
<td><?=$player1->getName()?> (<?=$player1->getTsp()?>)</td>
<td><?=$player2->getName()?> (<?=$player2->getTsp()?>)</td>
<td>
<?php 
$result1 = Result::findByMatchIdAndPlayerId($match->getId(), $player1->getId());
$result2 = Result::findByMatchIdAndPlayerId($match->getId(), $player2->getId());
$resultstr = "";
if($sec_level>0) {
	$resultstr = "<a href='../match/match_result_form.php?match_id=" . $match->getId() . "'>-</a>";
}
if (isset($result1) && isset($result2)) {
	$resultstr = "<a href='../match/match_result_view.php?match_id=" . $match->getId() . "'>" 
		. $result1->getRankingpoints() . " - " . $result2->getRankingpoints() . "</a>";
}
?>
<?=$resultstr?>
</td>
</tr>
<?php } } ?>
</tbody>
</table>
</div>
<?php } 
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}?>
</div>
</div>
</div>
</body>
</html>
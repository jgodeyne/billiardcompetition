<?php 
include_once("../common/session.php");
include_once("../common/html_head.php");
include_once("../match/match_class.php");
include_once("../competition/competition_class.php");
include_once("player_class.php");
include_once("../result/result_class.php");
include_once("../result/total_result_class.php");
?>
<body>
<? include("../common/header.php"); ?>
<? include("../common/main_menu.php"); ?>
<div id="middle">
<div id="main">
<?php
try {
$player_id = htmlspecialchars($_GET["player_id"]);
$player = Player::findById($player_id);
$competition = Competition::findById($player->getCompetitionId());
?>
<p><a href="../competition/competition_view.php?competition_id=<?=$competition->getId()?>">Terug</a></p>
<h1><?=$competition->getName()?></h1>
<h2><?=$player->getName()?></h2>
<table>
<tbody>
<tr>
<td width="100px">Lic: <?=$player->getLic()?></td>
<td>Club: <?=$player->getClub()?></td>
</tr>
<tr>
<td>Tsp: <?=$player->getTsp()?></td>
<td>Gemiddelde: <?=$player->getMin()?> - <?=$player->getMax()?></td>
</tr>
</tbody>
</table>
<div id="schedule">
<h2>Kalender - <a href="#results">Resultaten</a></h2>
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
$matches = Match::findByPlayer($player_id);

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
<div id="results">
<h2>Resultaten <a href="#schedule">&uarr;</a></h2>
<table class="list">
<thead>
<tr>
<td>Tegenspeler</td>
<td>Punten</td>
<td>Beurten</td>
<td colspan="2">Gemiddelde</td>
<td>Hoogste<br>Reeks</td>
<td>Match<br>Punten</td>
<td>Bonus<br>Punten</td>
<td>Ranking<br>Punten</td>
</tr>
</thead>
<tbody>
<?php
$results = Result::findByPlayerId($player_id);
if(isset($results)) {
	foreach ($results as $result) {
		$match = Match::findById($result->getMatchId());
		if ($match->getPlayer1Id() == $player_id) {
			$player2 = Player::findById($match->getPlayer2Id());
		} else {
			$player2 = Player::findById($match->getPlayer1Id());
		}
?>
<tr>
<td><?=$player2->getName()?></td>
<td><?=$result->getPoints()?></td>
<td><?=$result->getInnings()?></td>
<td><?=number_format($result->getAverage(),2,",",".")?></td>
<td>(<?=number_format($result->getAverage()/$player->getMin()*100,2,",",".")?>%)</td>
<td><?=$result->getHighestRun()?></td>
<td><?=$result->getMatchpoints()?></td>
<td><?=$result->getBonuspoints()?></td>
<td><?=$result->getRankingpoints()?></td>
</tr>
<?php } } ?>
</tbody>
<?php 
$ranking = TotalResult::rankingPlayer($player_id);
if(isset($ranking)) {
?>
<tfoot>
<tr>
<td></td>
<td><?=$ranking->getPoints()?></td>
<td><?=$ranking->getInnings()?></td>
<td><?=number_format($ranking->getAverage(),2,",",".")?></td>
<td>(<?=number_format($ranking->getAvgPct(),2,",",".")?>%)</td>
<td><?=$ranking->getHighestRun()?></td>
<td><?=$ranking->getMatchpoints()?></td>
<td><?=$ranking->getBonuspoints()?></td>
<td><?=$ranking->getRankingpoints()?></td>
</tr>
</tfoot>
<?php } 
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}?>
</table>
</div>
</div>
</div>
</body>
</html>
<?php 
include_once("../common/session.php");
include_once("../common/html_head.php");
include_once("match_class.php");
include_once("../competition/competition_class.php");
include_once("../player/player_class.php");
include_once("../result/result_class.php");
?>
<body>
<? include("../common/header.php"); ?>
<? include("../common/main_menu.php"); ?>
<div id="middle">
<div id="main">
<?php
try {
$match_id = htmlspecialchars($_GET["match_id"]);
$match = Match::findById($match_id);
$competition = Competition::findById($match->getCompetitionId());
$player1 = Player::findById($match->getPlayer1Id());
$player2 = Player::findById($match->getPlayer2Id());
$result1 = Result::findByMatchIdAndPlayerId($match_id, $match->getPlayer1Id());
$result2 = Result::findByMatchIdAndPlayerId($match_id, $match->getPlayer2Id());
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}?>
<h1><?=$competition->getName()?></h1>
<h2>Wedstrijd Uitslag</h2>
<p>Datum: <?=$match->getDate()?></p>
<p>Locatie: <?=$match->getPlace()?></p>
<table class="list">
<thead>
<tr>
<td>Naam</td>
<td>TSP</td>
<td>Ranking<br>Punten</td>
<td>Match<br>Punten</td>
<td>Bonus<br>Punten</td>
<td>Punten</td>
<td>Beurten</td>
<td>Gemiddelde</td>
<td>Hoogste<br>Reeks</td>
</tr>
</thead>
<tbody>
<tr>
<td><?=$player1->getName()?></td>
<td><?=$player1->getTsp()?></td>
<td><?=$result1->getRankingpoints()?></td>
<td><?=$result1->getMatchpoints()?></td>
<td><?=$result1->getBonuspoints()?></td>
<td><?=$result1->getPoints()?></td>
<td><?=$result1->getInnings()?></td>
<td><?=number_format($result1->getAverage(),2,",",".")?></td>
<td><?=$result1->getHighestRun()?></td>
</tr>
<tr>
<td><?=$player2->getName()?></td>
<td><?=$player2->getTsp()?></td>
<td><?=$result2->getRankingpoints()?></td>
<td><?=$result2->getMatchpoints()?></td>
<td><?=$result2->getBonuspoints()?></td>
<td><?=$result2->getPoints()?></td>
<td><?=$result2->getInnings()?></td>
<td><?=number_format($result2->getAverage(),2,",",".")?></td>
<td><?=$result2->getHighestRun()?></td>
</tr>
</tbody>
</table>
<p><a href="../competition/competition_view.php?competition_id=<?=$competition->getId()?>">Terug</a></p>
</div>
</div>
</body>
</html>
<?php 
include_once("../common/session.php");
include_once("../common/html_head.php");
include_once("match_class.php");
include_once("../competition/competition_class.php");
include_once("../player/player_class.php");
?>
<body>
<? include("../common/header.php"); ?>
<? include("../common/admin_menu.php"); ?>
<div id="middle">
<div id="main">
<?php
try {
$competition_id = htmlspecialchars($_GET["competition_id"]);
$competition = Competition::findById($competition_id);
?>
<h1><?=$competition->getName()?></h1>
<h2>Wedstrijden</h2>
<table class="list">
<thead>
<tr>
<td>Ronde</td>
<td>Datum</td>
<td>Plaats</td>
<td>Speler 1</td>
<td>Speler 2</td>
<td align="center" valign="middle" colspan="2"><a href="match_form.php?competition_id=<?=$competition_id?>"><img border="0" alt="Toevoegen" src="../images/new.png" /></a></td>
</tr>
</thead>
<tbody>
<?php
$matches = Match::findAllByCriteria("competition_id=" . $competition_id);
if(isset($matches)) {
foreach ($matches as $match) {
	$player1 = Player::findById($match->getPlayer1Id());
	$player2 = Player::findById($match->getPlayer2Id());
?>
<tr>
<td><?=$match->getRound()?></td>
<td><?=$match->getDate()?></td>
<td><?=$match->getPlace()?></td>
<td><?=$player1->getName()?></td>
<td><?=$player2->getName()?></td>
<td align="center"><a href="match_form.php?competition_id=<?=$competition_id?>&match_id=<?=$match->getId()?>"><img border="0" alt="Wijzigen" src="../images/properties.png"></a></td>
<td align="center"><a href="../match/match_delete.php?competition_id=<?=$competition_id?>&match_id=<?=$match->getId()?>"><img border="0" alt="Verwijderen" src="../images/delete.png"></a></td>
</tr>
<?php } }
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
} ?>
</tbody>
</table>
</div>
</div>
</body>
</html>
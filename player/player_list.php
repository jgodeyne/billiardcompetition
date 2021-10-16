<?php 
include_once("../common/session.php");
include_once("../common/html_head.php");
include_once("player_class.php");
include_once("../competition/competition_class.php");
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
<h2>Spelers</h2>
<table class="list">
<thead>
<tr>
<td>Lic</td>
<td>Naam</td>
<td>Club</td>
<td>TSP</td>
<td align="center" valign="middle" colspan="2"><a href="player_form.php?competition_id=<?=$competition_id?>"><img border="0" alt="Toevoegen" src="../images/new.png" /></a></td>
</tr>
</thead>
<tbody>
<?php
$players = player::findAllByCriteria("competition_id=" . $competition_id);
if(isset($players)) {
	foreach ($players as $player) {
?>
<tr>
<td><?=$player->getLic()?></td>
<td><?=$player->getName()?></td>
<td><?=$player->getClub()?></td>
<td><?=$player->getTsp()?></td>
<td align="center"><a href="player_form.php?competition_id=<?=$competition_id?>&id=<?=$player->getId()?>"><img border="0" alt="Wijzigen" src="../images/properties.png"></a></td>
<td align="center"><a href="../player/player_delete.php?competition_id=<?=$competition_id?>&id=<?=$player->getId()?>"><img border="0" alt="Verwijderen" src="../images/delete.png"></a></td>
</tr>
<?php } } 
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}?>
</tbody>
</table>
</div>
</div>
</body>
</html>
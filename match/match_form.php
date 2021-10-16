<?php 
include_once("../common/session.php");
include_once("../common/html_head.php");
include_once("match_class.php");
include_once("../competition/competition_class.php");
include_once("../player/player_class.php");
include_once("../place/place_class.php");
?>
<body>
<? include("../common/header.php"); ?>
<? include("../common/admin_menu.php"); ?>
<div id="middle">
<div id="main">
<?php
try {
$disabled='';
$competition_id = $id=htmlspecialchars($_GET["competition_id"]);
$competition = Competition::findById($competition_id);
if(isset($_GET["match_id"])) {
	$match_id=htmlspecialchars($_GET["match_id"]);
	$match=Match::findById($match_id);
	$round= $match->getRound();
	$date = $match->getDate();
	$place = $match->getPlace();
	$player_1_id = $match->getPlayer1Id();
	$player_2_id = $match->getPlayer2Id();

	$title="Wijzig Wedstrijd";
	$action="match_update.php";
}
else {
	$round= 0;
	$date = null;
	$place = null;
	$player_1_id = null;
	$player_2_id = null;

	$title="Nieuwe Wedstrijd";
	$action="match_insert.php";
}
?>
<h1><?=$competition->getName()?></h1>
<h2><?=$title?></h2>
<form method="post" action="<?=$action?>" name="match_form">
<table class="form">
<tbody>
<tr>
<td>&nbsp;Ronde:</td>
<td>&nbsp;<input type="number"  maxlength="2" size="2" name="round" value="<?=$round?>" autofocus required /></td>
</tr>
<tr>
<td>&nbsp;Datum (dd/mm/yyyy):</td>
<td>&nbsp;<input type="date"  maxlength="10" size="10" name="date" value="<?=$date?>" pattern="\d{1,2}/\d{1,2}/\d{4}" required /></td>
</tr>
<tr>
<td>&nbsp;Locatie:</td>
<td>&nbsp;
<select name="place">
<?php
foreach (Place::findAll() as $place2) {
?>
<option value="<?=$place2->getName()?>" <?=$place2->getName()==$place?'selected="selected"':''?>><?=$place2->getName()?></option>
<?php } ?>
</select>
</td>
</tr>
<tr>
<td>&nbsp;Speler 1</td>
<td>&nbsp;
<select name="player_1_id">
<?php
foreach (Player::findAll() as $player) {
?>
<option value="<?=$player->getId()?>" <?=$player->getId()==$player_1_id?'selected="selected"':''?>><?=$player->getName()?></option>
<?php } ?>
</select>
</td>
</tr>
<tr>
<td>&nbsp;Speler 2:</td>
<td>&nbsp;
<select name="player_2_id">
<?php
foreach (Player::findAll() as $player) {
?>
<option value="<?=$player->getId()?>" <?=$player->getId()==$player_2_id?'selected="selected"':''?>><?=$player->getName()?></option>
<?php } ?>
</select>
</td>
</tr>
</tbody>
</table>
<p>
<input type="hidden" name="match_id" value="<?=$match_id?>"/>
<input type="hidden" name="competition_id" value="<?=$competition_id?>"/>
<input type="submit" value="Bewaren" name="bewaren"  class="button">
<INPUT TYPE="button" VALUE="Terug" onClick="window.location='match_list.php?competition_id=<?=$competition_id?>'" class="button">
</p>
</form>
</div>
</div>
<?php
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>
</body>
</html>
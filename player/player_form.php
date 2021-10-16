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
$disabled='';
$competition_id=htmlspecialchars($_GET["competition_id"]);
$competition=Competition::findById($competition_id);
$id="";
$lic = "";
$name = "";
$club = "";
$tsp = "";
$min = "";
$max = "";
if(isset($_GET["id"])) {
	$id=htmlspecialchars($_GET["id"]);
	$player=player::findById($id);
	$lic = $player->getLic();
	$name = $player->getName();
	$club = $player->getClub();
	$tsp = $player->getTsp();
	$min = $player->getMin();
	$max = $player->getMax();

	$title="Wijzig Speler";
	$action="player_update.php";
}
else {
	$title="Nieuwe Speler";
	$action="player_insert.php";
}
} catch (Exception $e) {
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}?>
<h1><?=$competition->getName()?></h1>
<h2><?=$title?></h2>
<form method="post" action="<?=$action?>" name="player_form">
<table class="form">
<tbody>
<tr>
<td>&nbsp;Lic:</td>
<td>&nbsp;<input type="text"  maxlength="10" size="10" name="lic" value="<?=$lic?>" autofocus required/></td>
</tr>
<tr>
<td>&nbsp;Naam:</td>
<td>&nbsp;<input type="text"  maxlength="50" size="50" name="name" value="<?=$name?>" required/></td>
</tr>
<tr>
<td>&nbsp;Club:</td>
<td>&nbsp;<input type="text"  maxlength="50" size="50" name="club" value="<?=$club?>" required/></td>
</tr>
<tr>
<td>&nbsp;Tsp:</td>
<td>&nbsp;<input type="number"  maxlength="3" size="3" name="tsp" value="<?=$tsp?>" required/></td>
</tr>
<tr>
<td>&nbsp;Min:</td>
<td>&nbsp;<input type="number"  maxlength="6" size="6" name="min" value="<?=$min?>" required/></td>
</tr>
<tr>
<td>&nbsp;Max:</td>
<td>&nbsp;<input type="number"  maxlength="6" size="6" name="max" value="<?=$max?>" required/></td>
</tr>
</tbody>
</table>
<p>
<input type="hidden" name="id" value="<?=$id?>"/>
<input type="hidden" name="competition_id" value="<?=$competition_id?>"/>
<input type="submit" value="Bewaren" name="bewaren"  class="button">
<INPUT TYPE="button" VALUE="Terug" onClick="window.location='player_list.php?competition_id=<?=$competition_id?>'" class="button">
</p>
</form>
</div>
</div>
</body>
</html>
<?php 
include_once("../common/session.php");
include_once("../common/html_head.php");
include_once("match_class.php");
include_once("../competition/competition_class.php");
include_once("../result/result_class.php");
include_once("../player/player_class.php");
?>
<body>
<? include("../common/header.php"); ?>
<? include("../common/admin_menu.php"); ?>
<div id="middle">
<div id="main">
<?php
try {
$disabled='';
$match_id=htmlspecialchars($_GET["match_id"]);
$match=Match::findById($match_id);
$competition=Competition::findById($match->getCompetitionId());
$player_1 = Player::findById($match->getPlayer1Id());
$player_2 = Player::findById($match->getPlayer2Id());
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}?>
<h1><?=$competition->getName()?></h1>
<h2>Wedstrijd Uitslag</h2>
<form method="post" action="match_result_insert.php" name="match_form">
<table class="form">
<thead>
<tr>
<td>Speler</td>
<td>Punten</td>
<td>Beurten</td>
<td>Hoogste<br>Reeks</td>
</tr>
</thead>
<tbody>
<tr>
<td><?=$player_1->getName()?> (<?=$player_1->getTsp()?>)</td>
<td>&nbsp;<input type="number"  maxlength="3" size="3" name="player_1_points" autofocus required/></td>
<td>&nbsp;<input type="number"  maxlength="3" size="3" name="innings" required /></td>
<td>&nbsp;<input type="number"  maxlength="3" size="3" name="player_1_highest_run" required /></td>
</tr>
<tr>
<td><?=$player_2->getName()?> (<?=$player_2->getTsp()?>)</td>
<td>&nbsp;<input type="number"  maxlength="3" size="3" name="player_2_points" required/></td>
<td>&nbsp;</td>
<td>&nbsp;<input type="number"  maxlength="3" size="3" name="player_2_highest_run" required/></td>
</tr>
</tbody>
</table>
<p>
<input type="hidden" name="match_id" value="<?=$match_id?>"/>
<input type="submit" value="Bewaren" name="bewaren"  class="button">
<INPUT TYPE="button" VALUE="Terug" onClick="window.location='../competition/competition_view.php?competition_id=<?=$competition->getId()?>'" class="button">
</p>
</form>
</div>
</div>
</body>
</html>
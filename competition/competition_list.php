<?php 
include_once("../common/session.php");
include_once("competition_class.php");
include_once("../common/html_head.php");
?>
<body>
<? include("../common/header.php"); ?>
<? include("../common/main_menu.php"); ?>
<div id="middle">
<div id="main">
<?php
try {
?>
<h1>Competities</h1>
<table class="list">
<thead>
<tr>
<td>Id</td>
<td>Naam</td>
<td align="center" valign="middle" colspan="4">
<?php if($sec_level==9) { ?>
<a href="competition_form.php"><img border="0" alt="Toevoegen" src="../images/new.png" /></a></td>
<?php } ?>
</tr>
</thead>
<tbody>
<?php 
$competitions = Competition::findAll();
if(isset($competitions)) {
	foreach ($competitions as $competition) {
?>
<tr>
<td><?=$competition->getId()?></td>
<td><a href="competition_view.php?competition_id=<?=$competition->getId()?>"><?=$competition->getName()?></a></td>
<td align="center">
<?php if($sec_level==9) { ?>
<a href="competition_form.php?competition_id=<?=$competition->getId()?>"><img border="0" alt="Wijzigen" src="../images/properties.png"></a>
<?php } ?>
</td>
<td align="center">
<?php if($sec_level==9) { ?>
<a href="competition_delete.php?competition_id=<?=$competition->getId()?>"><img border="0" alt="Verwijderen" src="../images/delete.png"></a>
<?php } ?>
</td>
<td align="center">
<?php if($sec_level==9) { ?>
<a href="../player/player_list.php?competition_id=<?=$competition->getId()?>">S</a>
<?php } ?>
</td>
<td align="center">
<?php if($sec_level==9) { ?>
<a href="../match/match_list.php?competition_id=<?=$competition->getId()?>">W</a>
<?php } ?>
</td>
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
<?php 
include_once("../common/session.php");
include_once("../common/html_head.php");
include_once("competition_class.php");
?>
<body>
<? include("../common/header.php"); ?>
<? include("../common/admin_menu.php"); ?>
<div id="middle">
<div id="main">
<?php
try {
$disabled='';
if(isset($_GET["competition_id"])) {
	$id=htmlspecialchars($_GET["competition_id"]);
	$competition=competition::findById($id);
	$name = $competition->getName();
	$rounds = $competition->getRounds();

	$title="Wijzig Competitie";
	$action="../competition/competition_update.php";
}
else {
	$name = "";
	$rounds = "";

	$title="Nieuwe Competitie";
	$action="../competition/competition_insert.php";
}
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}?>
<h1><?=$title?></h1>
<form method="post" action="<?=$action?>" name="competition_form">
<table class="form">
<tbody>
<tr>
<td>&nbsp;Naam:</td>
<td>&nbsp;<input type="text"  maxlength="50" size="50" name="name" value="<?=$name?>" required autofocus /></td>
</tr>
<tr>
<td>&nbsp;Rondes:</td>
<td>&nbsp;<input type="number"  maxlength="2" size="2" name="rounds" value="<?=$rounds?>" required /></td>
</tr>
</tbody>
</table>
<p>
<input type="hidden" name="competition_id" value="<?=$id?>"/>
<input type="submit" value="Bewaren" name="bewaren"  class="button">
<INPUT TYPE="button" VALUE="Terug" onClick="window.location='../competition/competition_list.php';" class="button">
</p>
</form>
</div>
</div>
</body>
</html>
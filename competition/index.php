<?
include_once("../common/session.php");
include_once("competition_class.php");
try {
$competitions = Competition::findAll();
if (isset($competitions) && count($competitions)==1) {
	header("Location: competition_view.php?competition_id=" . $competitions[0]->getId());
	exit;
} else {
	header("Location: competition_list.php");
	exit;
}
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}?>


<?php
session_start();
$_SESSION['authorized'] = false;
$_SESSION['userlevel'] = 0;
header("Location: ../competition/index.php");
exit;
?>

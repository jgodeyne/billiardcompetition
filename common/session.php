<?php 
session_start();
if (!isset($_SESSION['authorized']) || $_SESSION['authorized']==false) 
{
    $_SESSION['authorized'] = false;
	$_SESSION['userlevel']=0;	
}
$sec_level=$_SESSION['userlevel'];
?>

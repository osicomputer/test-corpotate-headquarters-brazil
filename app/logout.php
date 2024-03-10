<?php 
ob_start();
session_start();
include 'inc/config.php'; 

$statement = $pdo->prepare("UPDATE tbl_user SET status_session=0 WHERE id=?");
$statement->execute(array($_SESSION['user']['id']));

//$statement = $pdo->prepare("DROP TABLE IF EXISTS tbl_report_box_details".$_SESSION['user']['id']);
//$statement->execute();


unset($_SESSION['user']);
//$statement = null;
//$pdo = null;            	
header("location: login.php"); 
?>
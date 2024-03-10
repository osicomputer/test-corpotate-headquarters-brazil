
<?php 
include("admin/main_config.php");

if (isset($_SESSION['user']))
	header("location: app/".$DEFAULT_URL);	
else
	header("location: app/login.php");	

?>

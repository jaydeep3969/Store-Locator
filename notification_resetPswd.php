<!---Save New Password In DB--->

<?php
	session_start();
	
	if(isset($_POST['unm']))
	{
		$_SESSION['active'] = 2;
		header("location:homepage.php?msg=Please Fill Out Your Details First");
	}
?>

<?php

try{
	$dbhandler = new PDO("mysql:host=127.0.0.1;dbname=ownersdb","user1","user1");
	
	$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$unm = $_SESSION['unm'];
	$pswd = $_POST['pswd'];
	
	$sql = "UPDATE ownersdb.ownersdetails SET Password='$pswd' WHERE Username='$unm'";
	
	$query = $dbhandler->query($sql);
	
	$query->execute();
	
	header("location:myProfile.php?msg1=You Have Set New Password");
}
catch(PDOException $e)
{
	echo $e->getMessage();
	die();
}
?>
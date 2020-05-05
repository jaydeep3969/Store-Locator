<!---Adding New Store--->
<?php
	session_start();
	if(!isset($_SESSION['unm']))
	{
		$_SESSION['active'] = 2;
		header("location:homepage.php?msg=Please Login First");
	}
?>

<?php

try{
	
	
	$dbhandler = new PDO("mysql:host=127.0.0.1;dbname=ownersdb","user1","user1");
	
	$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$unm = $_SESSION['unm'];
  	$storenm = $_POST['storenm'];
	$storeCat = $_POST['storeCat'];
	$address = $_POST['address'];
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];
	$otime = $_POST['otime'];
	$ctime = $_POST['ctime'];
	$cday = $_POST['cday'];
	
	$sql = "INSERT into ownersdb.ownerstores (Username,Name,Category,Address,Lat,Lng,Open,Close,Closeday) values('$unm','$storenm','$storeCat','$address','$lat','$lng','$otime','$ctime','$cday')";
	
	$query = $dbhandler->query($sql);
	
	header("location:myStores.php?msg=You have added a New Store:".$_POST['storenm']." Successfully");
}
catch(PDOException $e)
{
	echo $e->getMessage();
	die();
}
?>
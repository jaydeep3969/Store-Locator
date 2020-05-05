<!---editing store database--->
<?php
	if(!isset($_SESSION['unm']))
	{
		$_SESSION['active'] = 2;
		header("location:homepage.php?msg=Please Login First");
	}
?>

<?php

session_start();

try{
	$dbhandler = new PDO("mysql:host=127.0.0.1;dbname=ownersdb","user1","user1");
	
	$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$unm = $_SESSION['unm'];
	$old_storenm = $_SESSION['old_storenm'];
  	$storenm = $_POST['storenm'];
	$storeCat = $_POST['storeCat'];
	$address = $_POST['address'];
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];
	$otime = $_POST['otime'];
	$ctime = $_POST['ctime'];
	$cday = $_POST['cday'];
	
	$sql = "UPDATE ownersdb.ownerstores SET Username='$unm',Name='$storenm',Category='$storeCat',Address='$address',Lat='$lat',Lng='$lng',Open='$otime',Close='$ctime',Closeday='$cday' WHERE Name='$old_storenm'";
	
	$query = $dbhandler->query($sql);
	
	//$query -> execute(array($unm,$old_storenm));
	
	$query -> execute();
	
	unset($_SESSION['old_storenm']);
	
	header("location:myStores.php?msg=You have Updated details of Store:".$_POST['storenm']." Successfully");
}
catch(PDOException $e)
{
	echo $e->getMessage();
	die();
}
?>
<!---Deleting a store--->
<?php
	
	session_start();
	if(!isset($_SESSION['unm']))
	{
		header("location:homepage.php?msg=Please Login First");
		$_SESSION['active'] = 2;
	}
?>

<?php


$unm = $_SESSION['unm'];
$storenm = $_GET['storenm'];

try{
	
	$dbhandler = new PDO("mysql:host=127.0.0.1;dbname=ownersdb","user1","user1");
	
	$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql = "DELETE  FROM ownersdb.ownerstores WHERE Username=? and Name=?";
	
	$query = $dbhandler->prepare($sql);
	
	$query -> execute(array($unm,$storenm));
	
	header("location:myStores.php?msg=You have deleted a store :".$storenm);
}
catch(PDOException $e)
{
	echo $e->getMessage();
	die();
}

?>
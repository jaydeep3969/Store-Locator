<!---Owenr Logout--->
<html>
<head>
<title>Logged Out</title>
</head>
<body>
<?php
	session_start();
	
	$_SESSION['active'] = 2;
	
	if(isset($_SESSION['unm']))
	{
		unset($_SESSION['unm']);
		
		header("location:homepage.php?msg=Successfully Logged Out");
	}
	else
	{
		header("location:homepage.php?msg=Please Login First");
	}
 ?>
 </body>
 </html>
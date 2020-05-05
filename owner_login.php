<!---checking owner credentials--->
<?php

	session_start();
	
	if(isset($_POST['unm']) && isset($_POST['pswd']))
	{
		try{
			$unm = $_POST['unm'];
			$pswd = $_POST['pswd'];
			
			if(!empty($unm) && !empty($pswd))
			{
			
				$dbhandler = new PDO("mysql:host=127.0.0.1;dbname=ownersdb","user1","user1");
	
				$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
				$sql = "SELECT * from ownersdb.ownersdetails where Username=? and Password=?";
			
				$query = $dbhandler->prepare($sql);
			
				$query->execute(array($unm,$pswd));
			
				if(($query->rowcount()) > 0)
				{
					$_SESSION['unm'] = $unm;
					header("location:myStores.php");
				}
				else
				{
					$_SESSION['active'] = 2;
					
					header("location:homepage.php?msg=Invalid Username or Password");
				}
			}
			else
			{
				$_SESSION['active'] = 2;
					
				header("location:homepage.php?msg=Please provide your Username and Password first");
			}
		} 
		catch(PDOException $e)
		{
			echo $e->getMessage();
			die();	
		}
	}
	else
	{
		$_SESSION['active'] = 2;
					
		header("location:homepage.php?msg=Please provide your Username and Password first");
	}
?>

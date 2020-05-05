<!---checking for forgot password--->

<?php

	session_start();
	
	if(isset($_POST['unm']))
	{
		try{
			$unm = $_POST['unm'];
			$sec_que = $_POST['sec_que'];
			$ans = $_POST['ans'];
			
			if(!empty($unm))
			{
			
				$dbhandler = new PDO("mysql:host=127.0.0.1;dbname=ownersdb","user1","user1");
	
				$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
				$sql = "SELECT * from ownersdb.ownersdetails WHERE Username=? AND SecQue=? AND Answer=?";
			
				$query = $dbhandler->prepare($sql);
			
				$query->execute(array($unm,$sec_que,$ans));
			
				if(($query->rowcount()) > 0)
				{
					$_SESSION['unm'] = $unm;
					header("location:reset_pswd.php");
				}
				else
				{	
					header("location:forgot_pswd.php?msg=Invalid Credentials");
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

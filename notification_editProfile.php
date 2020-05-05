<!---Edit Profile In DB--->
<?php
	if(!isset($_SESSION['unm']))
	{
		$_SESSION['active'] = 2;
		header("location:homepage.php?msg=Please Login First");
	}
?>

<?php

try{
	//echo "in notification.php";
	session_start();
	
	$old_unm = $_SESSION['unm'];
	
	$dbhandler = new PDO("mysql:host=127.0.0.1;dbname=ownersdb","user1","user1");
	
	$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$unm = $_POST['unm'];
	$pswd = $_POST['pswd'];
	$dob = $_POST['dob'];
	$nm = $_POST['nm'];
	$email = $_POST['email'];
	$mobno = $_POST['mno'];
	$sec_que = $_POST['sec_que'];
	$ans = $_POST['ans'];
	
	if($_POST['gender'] == "male")
	{
		$gender = "M";
	}
	else
	{
		$gender = "F";
	}
	
	/*if(!empty($__FILES["profile_pic"]["name"]))
	{
		$target_location = "profiles/".basename($_FILES["profile_pic"]["name"]);
		
		if(!(move_uploaded_file($_FILES["profile_pic"]["name"])$target_location))
		{
			echo "Error:".$_FILES["profile_pic"]["error"]."</br>";
		}
		else
		{
			$ext = pathinfo($target_location,PATHINFO_EXTENSION);
			$new = "profiles/".$unm.$ext;
			rename($target_location,$new)
		}
	}
	/*else
	{
		$target_location = "profiles/".basename($_FILES["profile_pic"]["name"]);
		
		if($_POST['gender'] == "male")
		{
			
		}
		else
		{
			$gender = "F";
		}
	}*/
	
	$sql = "SELECT * from ownersdb.ownersdetails where Username=?";
			
	$query = $dbhandler->prepare($sql);
			
	$query->execute(array($unm));
					
	if(($query->rowcount()) == 0 || (($query->rowcount()) > 0 && ($old_unm == $unm)))
	{ 

		$sql = "UPDATE ownersdb.ownersdetails SET Username='$unm',Password='$pswd',Name='$nm',Gender='$gender',DOB='$dob',Email='$email',Mobile='$mobno',SecQue='$sec_que',Answer='$ans' WHERE Username='$old_unm'";

		$sql1 = "UPDATE ownersdb.ownerstores SET Username='$unm' WHERE Username='$old_unm'";
	
		$query = $dbhandler->query($sql);
		$query1 = $dbhandler->query($sql1);
	
		$query -> execute();
		$query1 -> execute();
	
		$_SESSION['unm'] = $unm;
		$_SESSION['editP_noti'] = "You have Updated Your Profile Successfully";
		header("location:myProfile.php?msg1=You have Updated Your Profile Successfully");
	}
	else
	{
		header("location:edit_profile.php?msg=Username Already Exist");
	}
}
catch(PDOException $e)
{
	echo $e->getMessage();
	die();
}
?>
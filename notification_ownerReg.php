<!---Saving New Owner's Data--->
<?php
	//session_start();
	
	//if(isset($_POST['unm']))
	//{
	//	$_SESSION['active'] = 2;
	//	header("location:homepage.php?msg=Please Fill Out Your Details First");
	//}
?>

<?php

try{
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
	
	//echo "</br>".$_FILES["myfile"]["name"];

	/*if(!empty($_FILES["myfile"]["name"]))
	{
		$target_location = "C:/xampp/htdocs/project1/images/profiles/".basename($_FILES["myfile"]["name"]);
		
		//echo "</br>";
		//echo "target location:".$target_location;
		//echo "</br>";
		
		if(!(move_uploaded_file($_FILES["myfile"]["tmp_name"],$target_location)))
		{
			echo "Error:".$_FILES["myfile"]["error"]."</br>";
		}
		else
		{
			$ext = pathinfo($target_location,PATHINFO_EXTENSION);
			$new = "C:/xampp/htdocs/project1/images/profiles/".$_POST['unm'].".".$ext;
		//	echo "New Path:".$new;
			
			rename($target_location,$new);
		//	header("location:show.php");
		}
	}
	else
	{
		$target_location = "profiles/".basename($_FILES["profile_pic"]["name"]);
		
		if($_POST['gender'] == "male")
		{
			
		}
		else
		{
			
		}
	}*/

	$sql = "SELECT * from ownersdb.ownersdetails where Username=?";
			
	$query = $dbhandler->prepare($sql);
			
	$query->execute(array($unm));
					
	if(($query->rowcount()) == 0)
	{

		$sql = "INSERT into ownersdb.ownersdetails (Username,Password,Name,Gender,DOB,Email,Mobile,SecQue,Answer) values('$unm','$pswd','$nm','$gender','$dob','$email','$mobno','$sec_que','$ans')";
	
		$query = $dbhandler->query($sql);
	
		$_SESSION['unm'] = $unm;
		header("location:myStores.php");
	}
	else
	{
		header("location:registration.php?msg=Username Already Exist");
	}
}
catch(PDOException $e)
{
	echo $e->getMessage();
	die();
}
?>
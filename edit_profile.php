<!---edit profile of owner--->

<?php
	session_start();
	if(!isset($_SESSION['unm']))
	{
		$_SESSION['active'] = 2;
		header("location:homepage.php?msg=Please Login First");
	}
	$unm = $_SESSION['unm'];
?>

<html>
    <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    
	</body>
</html>

 <!-- Dropdown Structure -->
<ul id='dropdown1' class='dropdown-content'>
	<li>
		<a href="myProfile.php">
			<i class="material-icons">view_module</i>
			Show Profile
		</a>
	</li>
	<li>
		<a href="logout.php">
			<i class="material-icons">power_settings_new</i>
			LogOut
		</a>
	</li>
</ul>
  
<!---Navigation Bar--->
<html>
<head>
	<title>Edit Profile</title>	
</head>
<body>
<nav>
  <div class="nav-wrapper">
    <a href="#!" class="brand-logo">
		Store Locator
		<i class="material-icons prefix">store</i>
		<i class="material-icons prefix">location_on</i>
	</a>
    <ul class="right hide-on-med-and-down">
		<li>Hello <?php echo $unm;?> !   </li>
		<li><a href="myStores.php">My Stores</a></li>
		<!-- Dropdown Trigger -->
		<li>
			<a class="dropdown-button" href="#!" data-activates="dropdown1">
				My Profile
				<i class="material-icons right">arrow_drop_down</i>
			</a>
		</li>
    </ul>
  </div>
</nav>
</body>
</html>


<?php

$unm = $_SESSION['unm'];
//$storenm = $_GET['storenm'];

//try{
//	echo "in notification.php";
//	session_start();
	
	$dbhandler = new PDO("mysql:host=127.0.0.1;dbname=ownersdb","user1","user1");
	
	$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql = "SELECT * FROM ownersdb.ownersdetails WHERE Username=?";
	
	$query = $dbhandler->prepare($sql);
	
	$query -> execute(array($unm));
	
	$row = $query->fetch(PDO::FETCH_ASSOC)
	//header("location:stores.php?msg=You have Updated Details of store :".$storenm);

//catch(PDOException $e)
//{
//	echo $e->getMessage();
//	die();
//}

?>

<html>
<head>
	<title>Registration</title>

	<script>
		$(document).ready(function() {
		$('select').material_select();
		});
	</script>
	
	<script>
		function check_unm()
		{
			var pat_unm = /^.{6,11}$/;

			var unm = document.getElementById('unm');
		
			if (pat_unm.test(unm.value) == false) 
			{
				alert("Username must be of 6-11 characters");
				unm.focus();
				return false;
			}
			else
			{
				return true;
			}
		}
		
		function check_pass()
		{
			var pat_pswd = /^.{8,11}$/;

			var pswd = document.getElementById('pswd');
		
			if (pat_pswd.test(pswd.value) == false) 
			{
				alert("Password must be of 8-11 characters");
				pswd.focus();
				return false;
			}
			else
			{
				return true;
			}
		}
		
		function check_repass()
		{
			if (document.getElementById('pswd').value != document.getElementById('repswd').value)
			{
				alert("Reenter Password Doesn't Match");
				document.getElementById('repswd').focus();
				return false;
			}
			else 
			{
				return true;
			}
		}
		
		function check_mob_no()
		{
			var mob = /^(\+91)?[- ]?[9876]{1}[0-9]{9}$/;

			var mno = document.getElementById('mno');

			if (mob.test(mno.value) == false) 
			{
				alert("Please enter valid mobile number.");
				mno.focus();
				return false;
			}
			else
			{
				return true;
			}
		}
		
		function validateForm()
		{
			if(check_pass() && check_repass() && check_mob_no() && check_unm())
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	</script>
</head>

<body>

<div class="card-panel">
      <span class="blue-text text-darken-2">
			<h4 align="center"> Edit Your Profile </h4>
	  </span>
</div>

<h4 align="center">
	<?php
		if(isset($_GET['msg']))
			echo $_GET['msg'];
	?>
</h4>

<div class="container">
<form action="notification_editProfile.php" method="POST" onsubmit="return validateForm()" class="col s12">
		<div class="row">
			<div class="input-field col s6">
				<i class="material-icons prefix">account_circle</i>
				<input id="unm" name="unm" value="<?php echo $row['Username'];?>" type="text" onchange="check_unm()" required>
				<label for="unm">Username</label>
			</div>
		</div>
	
	<div class="row">
		<div class="input-field col s6">
			<i class="material-icons prefix">lock</i>
			<input id="pswd" name="pswd" type="password" value="<?php echo $row['Password'];?>" onchange="check_pswd()"class="validate" required>
			<label for="pswd">Password</label>
		</div>

		<div class="input-field col s6">
			<i class="material-icons prefix">lock</i>
			<input id="repswd" name="repswd" type="password" value="<?php echo $row['Password'];?>" class="validate" onchange="check_repass()" required>
			<label for="repswd">Reenter Password</label>
		</div>
	</div>

	<div class="row">
			<div class="input-field col s6">
				<i class="material-icons prefix">perm_identity</i>
				<input id="nm" name="nm" align="center" type="text" value="<?php echo $row['Name'];?>" class="validate" required>
				<label for="nm">Name</label>
			</div>
	</div>
	
	<div class="row">
			<div class="input-field col s6">
				<i class="material-icons prefix">supervisor_account</i>
				<input type="radio" id="m" name="gender" <?php if($row['Gender'] == "M") {echo "checked";}?> value="male">
				<label for="m">Male</label>
				<input type="radio" id="f" name="gender" <?php if($row['Gender'] == "F") {echo "checked";}?> value="female">
				<label for="f">Female</label>
			</div>
			<div class="input-field col s6">
				<i class="material-icons prefix">today</i>
				<input id="dob" name="dob" type="date" value="<?php echo $row['DOB'];?>" class="datepicker" required>
			</div>
	</div>
	
	<div class="row">
			<div class="input-field col s6">
				<i class="material-icons prefix">email</i>
				<input id="email" name="email" align="center" value="<?php echo $row['Email'];?>" type="email" class="validate">
				<label for="email">Email</label>
			</div>
	
			<div class="input-field col s6">
				<i class="material-icons prefix">call</i>
				<input id="mno" name="mno" align="center" type="tel" class="validate" value="<?php echo $row['Mobile'];?>" onchange="check_mob_no	()">
				<label for="mno">Mobile No.</label>
			</div>
	</div>

	<div class="row">
		<div class="file-field input-field">
			<div class="btn">
			<span>Upload Profile Pic</span>
			<input type="file" name="profile_pic">
		</div>
		<div class="file-path-wrapper">
			<input class="file-path validate" type="text">
		</div>
		</div>
	</div>
	
	<div class="row">
	<div class="input-field col s6">
		<i class="material-icons prefix">vpn_key</i>
		<select name="sec_que" required>
			<option value="1" <?php if($row['SecQue'] == 1) {echo "selected";}?>>What is your favourite color?</option>
			<option value="2" <?php if($row['SecQue'] == 2) {echo "selected";}?>>What is your nick name?</option>
			<option value="3" <?php if($row['SecQue'] == 3) {echo "selected";}?>>Who is your best friend?</option>
			<option value="4" <?php if($row['SecQue'] == 4) {echo "selected";}?>>What is the name of your favourite movie?</option>	
		</select>
		<label>Choose Your Security Question</label>
	</div>
	
		<div class="input-field col s6">
			<i class="material-icons prefix">label</i>
			<input id="ans" name="ans" value="<?php echo $row['Answer'];?>" type="text" class="validate" required>
			<label for="ans">Answer</label>
		</div>
	</div>
	
	<button class="btn waves-effect waves-light" type="submit" name="action">Update Profile
    <i class="material-icons right">send</i>
	</button>
	
	&nbsp;&nbsp;&nbsp;&nbsp;
	<button class="btn waves-effect waves-light" type="reset">Reset
    <i class="material-icons right">replay</i>
	</button>
	
</form>
</div>
</div>
</body>
</html>
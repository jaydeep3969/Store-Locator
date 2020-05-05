<!----New User Registration--->

<!---linking css classes--->
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

<!---Navigation Bar--->
<html>
<body>
<nav>
  <div class="nav-wrapper">
	<a href="" class="brand-logo">
		Store Locator
		<!--<img src="images/logo.png">-->
		<i class="material-icons prefix">store</i>
		<i class="material-icons prefix">location_on</i>
	</a>
  </div>
</nav>
</body>
</html>


<html>
<head>

	<title>Registration</title>

	<script>
		$(document).ready(function() {
		$('select').material_select();
		});
	</script>
	
    <script>
	
		/*function unm_exist()
		{
			//var unm = document.getElementById('unm');
			//document.cookie = "unm = " + unm;
			
			<?php
				//$unm = $_COOKIE['unm'];
				
			try
			{
				if(!empty($unm))
				{
			
					$dbhandler = new PDO("mysql:host=127.0.0.1;dbname=ownersdb","user1","user1");
	
					$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
					$sql = "SELECT * from ownersdb.ownersdetails where Username=?";
			
					$query = $dbhandler->prepare($sql);
			
					$query->execute(array($unm));
			
					if(($query->rowcount()) > 0)
					{
						echo "alert(\"Provided Username is Already Exist\");";
						echo "unm.focus();";
						echo "return true;";
					}
					else
					{
						echo "alert('Provided Username".$unm."');";
						echo "return false;";
					}
				}
				else
				{
					echo "alert('Provided Username');";
				}
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
				die();	
			}

			?>
		}*/
		
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
			<h4 align="center"> Registration </h4>
	  </span>
</div>

<h4 align="center">
	<?php
		if(isset($_GET['msg']))
			echo $_GET['msg'];
	?>
</h4>

<div class="container">
<form action="notification_ownerReg.php" onsubmit="return validateForm()" method="POST" class="col s12">
		
	<div class="row">
		<div class="input-field col s6">
			<i class="material-icons prefix">account_circle</i>
			<input id="unm" name="unm" type="text" onchange="check_unm()" placeholder="Username must be of 6-11 characters" class="validate" required>
			<label for="unm">Username</label> 
		</div>
	</div>
	
	<div class="row">
		<div class="input-field col s6">
			<i class="material-icons prefix">lock</i>
			<input id="pswd" name="pswd" type="password" placeholder="Password must be of 8-11 characters" onchange="check_pass()" class="validate" required>
			<label for="pswd">Password</label>
		</div>

		<div class="input-field col s6">
			<i class="material-icons prefix">lock</i>
			<input id="repswd" name="repswd" type="password" class="validate" onchange="check_repass()" required>
			<label for="repswd">Reenter Password</label>
		</div>
	</div>

	<div class="row">
			<div class="input-field col s6">
				<i class="material-icons prefix">perm_identity</i>
				<input id="nm" name="nm" align="center" type="text" class="validate" required>
				<label for="nm">Name</label>
			</div>
	</div>
	
	<div class="row">
			<div class="input-field col s6">
				<i class="material-icons prefix">supervisor_account</i>
				<input type="radio" id="m" name="gender" value="male" checked>
				<label for="m">Male</label>
				<input type="radio" id="f" name="gender" value="female">
				<label for="f">Female</label>
			</div>
			<div class="input-field col s6">
				<i class="material-icons prefix">today</i>
				<input id="dob" name="dob" type="date" class="datepicker" required>
			</div>
	</div>
	
	<div class="row">
			<div class="input-field col s6">
				<i class="material-icons prefix">email</i>
				<input id="email" name="email" align="center" type="email" class="validate">
				<label for="email">Email</label>
			</div>
	
			<div class="input-field col s6">
				<i class="material-icons prefix">call</i>
				<input id="mno" name="mno" align="center" type="tel" class="validate" onchange="check_mob_no	()">
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
			<option value="" disabled selected>Choose Your Security Question</option>
			<option value="1">What is your favourite color?</option>
			<option value="2">What is your nick name?</option>
			<option value="3">Who is your best friend?</option>
			<option value="4">What is the name of your favourite movie?</option>	
		</select>
		<label>Choose Your Security Question</label>
	</div>
	
		<div class="input-field col s6">
			<i class="material-icons prefix">label</i>
			<input id="ans" name="ans" type="text" class="validate" required>
			<label for="ans">Answer</label>
		</div>
	</div>
	
	<button class="btn waves-effect waves-light" type="submit" name="action">
		Submit
		<i class="material-icons right">send</i>
	</button>
	
	&nbsp;&nbsp;&nbsp;&nbsp;
	<button class="btn waves-effect waves-light" type="reset">
		Reset
		<i class="material-icons right">replay</i>
	</button>
	
	&nbsp;&nbsp;&nbsp;&nbsp;
	<a class="waves-effect waves-light btn" href="homepage.php">
		<i class="material-icons right">store</i>
		Home
	</a>
</form>

</div>
</div>

</body>
</html>
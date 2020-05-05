<!----Reset Password--->
<?php
	session_start();
	if(!isset($_SESSION['unm']))
	{
		$_SESSION['active'] = 2;
		header("location:homepage.php?msg=Please Login First");
	}
	//$unm = $_SESSION['unm'];
?>

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

	<style>
	.centered {
				position: fixed;
				top: 50%;
				left: 50%;
				margin-top: -100px;
				margin-left: -240px;
			  }
	</style>
	
	<script>
		$(document).ready(function() {
		$('select').material_select();
		});
	</script>
	
	<script>
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
		
		function validateForm()
		{
			if(check_pass() && check_repass())
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

<h1 align="center">Set New Password</h1>
	
<h4 align="center">
	<?php
		if(isset($_GET['msg']))
			echo $_GET['msg'];
	?>
</h4>

<div class="centered">
<form action="notification_resetPswd.php" onsubmit="return validateForm()" method="POST" class="col s6">
	<table class='centered' border='1' align='center'>
	<div class="row">
	<tr>
		<div class="input-field col s6">
			<i class="material-icons prefix">lock</i>
			<input id="pswd" name="pswd" type="password" onchange="check_pass()" placeholder="Password must be of 8-11 characters" class="validate" required>
			<label for="pswd">New Password</label> 
		</div>
	</tr>
	</div>

	<div class="row">
	<tr>
		<div class="input-field col s6">
			<i class="material-icons prefix">lock</i>
			<input id="repswd" name="repswd" type="password" onchange="check_repass()" class="validate" required>
			<label for="repswd">Re-enter Password</label> 
		</div>
	</tr>
	</div>
	
	</table>
	
	&nbsp;&nbsp;&nbsp;&nbsp;
	<button class="btn waves-effect waves-light" type="submit" name="action">Set New Password
    <i class="material-icons right">send</i>
	</button>
	
	&nbsp;&nbsp;&nbsp;&nbsp;
	<button class="btn waves-effect waves-light" type="reset">Reset
    <i class="material-icons right">replay</i>
	</button>
	
	&nbsp;&nbsp;&nbsp;&nbsp;
</form>
</div>

</body>
</html>
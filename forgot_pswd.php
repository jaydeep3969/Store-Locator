<!----Forgot Password--->

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
				margin-left: -180px;
			  }
	</style>
	
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
		
		function validateForm()
		{
			if(check_unm())
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

<h1 align="center">Forgot Password</h1>
	
<h4 align="center">
	<?php
		if(isset($_GET['msg']))
			echo $_GET['msg'];
	?>
</h4>

<div class="centered">
<form action="notification_forgotPswd.php" onsubmit="return validateForm()" method="POST" class="col s6">
	<table class='centered' border='1' align='center'>
	<div class="row">
	<tr>
		<div class="input-field col s6">
			<i class="material-icons prefix">account_circle</i>
			<input id="unm" name="unm" type="text" onchange="check_unm()" placeholder="Username must be of 6-11 characters" class="validate" required>
			<label for="unm">Username</label> 
		</div>
	</tr>
	</div>

	<div class="row">
	<tr>
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
	</tr>
	</div>
	
	<div class="row">
	<tr>
		<div class="input-field col s6">
			<i class="material-icons prefix">label</i>
			<input id="ans" name="ans" type="text" class="validate" required>
			<label for="ans">Answer</label>
		</div>
	</tr>
	</div>
	
	</table>
	
	&nbsp;&nbsp;&nbsp;&nbsp;
	<button class="btn waves-effect waves-light" type="submit" name="action">LogIn
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
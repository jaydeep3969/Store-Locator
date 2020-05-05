<!---My Profile--->
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
	<li><a href="myProfile.php"><i class="material-icons">view_module</i>Show Profile</a></li>
	<li><a href="logout.php"><i class="material-icons">power_settings_new</i>LogOut</a></li>
</ul>
  
<!---Navigation Bar--->
<html>
<head>
	<title>My Profile</title>	
</head>
<body>
<nav>
  <div class="nav-wrapper">
    <a href="#!" class="brand-logo">Store Locator
		<i class="material-icons prefix">store</i>
		<i class="material-icons prefix">location_on</i>
	</a>
    <ul class="right hide-on-med-and-down">
		<li>Hello <?php echo $unm;?> !   </li>
		<li><a href="myStores.php">My Stores</a></li>
	</ul>
  </div>
</nav>
</body>
</html>

<div id="my-profile" class="col s12">

	<h4 align="center">
	<?php
		if(isset($_GET['msg1']))
			echo $_GET['msg1'];
	?>
	</h4>
	
	</br></br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;
	<a class="waves-effect waves-light btn" href="logout.php">
		<i class="material-icons right">power_settings_new</i>
		Log Out
	</a>
	
	&nbsp;&nbsp;&nbsp;&nbsp;
	<a class="waves-effect waves-light btn" href="edit_profile.php">
		<i class="material-icons right">mode_edit</i>
		Edit Profile
	</a>
	
	</br></br>

<div class="col s12">
	<?php
	
		if(!empty($unm))
		{
			try{			
				$dbhandler = new PDO("mysql:host=127.0.0.1;dbname=ownersdb","user1","user1");

				$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
				$sql = "SELECT * from ownersdb.ownersdetails where Username=?";
		
				$query = $dbhandler->prepare($sql);
			
				$query->execute(array($unm));
							
				if(($query->rowcount()) > 0)
				{
					$row = $query->fetch(PDO::FETCH_ASSOC);
					
					if($row['Gender'] == "M")
					{
						$gender = "Male";
					}
					else
					{
						$gender = "Female";
					}
					
					if($row['SecQue'] == 1)
					{
						$sec_que = "What is your favourite color?"; 
					}
					else if($row['SecQue'] == 2) 
					{
						$sec_que = "What is your nick name?";
					}
					else if($row['SecQue'] == 3)
					{
						$sec_que = "Who is your best friend?";
					}
					else
					{
						$sec_que = "What is the name of your favourite movie?";
					}
					
					
					//echo "<div class='card-panel teal lighten-2'><h3 align='center'>My Stores</h3></div>";
					echo "<table class='striped'>
							
							<tr>
								<th align='center'>Name</th>
								<td  align='center'>".$row["Name"]."</td>
							</tr>
							<tr>
								<th align='center'>Gender</th>
								<td  align='center'>".$gender."</td>
							</tr>
							<tr>
								<th align='center'>DOB</th>
								<td  align='center'>".$row["DOB"]."</td>
							</tr>
							<tr>
								<th align='center'>Email</th>
								<td  align='center'>".$row["Email"]."</td>
							</tr>
							<tr>
								<th align='center'>Mobile No.</th>
								<td  align='center'>".$row["Mobile"]."</td>
							</tr>
							<tr>
								<th align='center'>Security Que.</th>
								<td  align='center'>".$sec_que."</td>
							</tr>
							<tr>
								<th align='center'>Answer</th>
								<td  align='center'>".$row["Answer"]."</td>
							</tr>
							";	
					echo "</table>";
				}
				else
				{
					echo "<h3>Owner Information Is Not Available</h3>";
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
			header("location:homepage.php?msg=Please Login First");
		}
	?>
</div>
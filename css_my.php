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
	<title>My Stores</title>	
</head>
<body>
<nav>
  <div class="nav-wrapper">
    <a href="#!" class="brand-logo">Store Locator</a>
    <ul class="right hide-on-med-and-down">
		<li>Hello <?php echo $unm;?> !   </li>
		<!-- Dropdown Trigger -->
		<li><a class="dropdown-button" href="#!" data-activates="dropdown1">My Profile<i class="material-icons right">arrow_drop_down</i></a></li>
    </ul>
  </div>
</nav>
</body>
</html>

  
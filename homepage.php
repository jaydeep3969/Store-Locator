<!---home page--->

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
<head>
	<title>Home Page</title>	
</head>
<body>
	<nav>
		<div class="nav-wrapper">
			<a href="" class="brand-logo">Store Locator
				<!--<img src="images/logo.png">-->
				<i class="material-icons prefix">store</i>
				<i class="material-icons prefix">location_on</i>
			</a>
		</div>
	</nav>
</body>
</html>

<?php
	//for active tab
	session_start();
	
	if(isset($_SESSION['active']))
	{
		$active = $_SESSION['active'];
		
		unset($_SESSION['active']);
	}
	else
	{
		$active = 1;
	}
?>

<!---Tabs--->
<ul id="tabs-swipe-demo" class="tabs">
    <li class="tab col s3">
		<a <?php if($active == 1) { echo "class=\"active\"";}?> href="#find-stores">
			Find Stores
		</a>
	</li>
    <li class="tab col s3">
		<a <?php if($active == 2) { echo "class=\"active\"";}?> href="#owner-login">
			Owner LogIn
		</a>
	</li>
</ul>


<!---Tab 1:Find Stores--->
<div id="find-stores">

<html>
<head>

	<script>
		$(document).ready(function() {
		$('select').material_select();
		});
	</script>
	
<script>
	// for map

  var geocoder;
  var map;

   //initializing map
  function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(-34.397, 150.644);
    var mapOptions = {
      zoom: 12,
      center: latlng
    }
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
  }

  //function for converting address into lat_lng
  function codeAddress() {
    var address = document.getElementById('location').value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == 'OK') {
	  
		var latlng = results[0].geometry.location;
		document.getElementById('lat').value = results[0].geometry.location.lat();
		document.getElementById('lng').value = results[0].geometry.location.lng();

        map.setCenter(latlng);
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
		});
		

		var contentString = "Current Location";
		
		var infowindow = new google.maps.InfoWindow();
		google.maps.event.addListener(marker,'click', (function(infowindow,mark,contentStr) {
						return function() {
							infowindow.setContent(contentStr);
							infowindow.open(map, mark);
						};
						})(infowindow,marker,contentString));
      } else {
        alert('Please Enter Correct Address');
		document.getElementById('lat').value = 0.0;
		document.getElementById('lng').value = 0.0;
      }
    });
  }
</script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAp8N0owYgNP2m2vTZgaunlTRsANum1pms&callback=initMap">
</script>

</head>

<body onload="initialize()">

<div class="row">
<div class="col s9">
<h4 align="center">
	<?php
		if(isset($_GET['msg1']))
			echo $_GET['msg1'];
	?>
</h4>

<div class="container">
	<form action="findStores.php" class="col s12" method="POST">
	<div>
		<div class="input-field col s12">
			<i class="material-icons prefix">my_location</i>
			<textarea id="location" name="location" class="materialize-textarea" onchange="codeAddress()" required></textarea>
			<label for="location">Your Location</label>
        </div>
	</div>
	
	<div class="row">
		<div class="input-field col s6">
			<input id="lat" name="lat" type="text" value="0.0" class="validate" readonly>
			<label for="lat">Latitude</label>
		</div>

		<div class="input-field col s6">
			<input id="lng" name="lng" type="text" value="0.0" class="validate" readonly>
			<label for="lng">Longitude</label>
		</div>
	</div>
	
	<div class="row">	
	<div class="input-field col s12">
		<select name="storeCat" required>
			<option value="" disabled selected>Choose Store Category</option>
			<option value="Hotel">Hotel</option>
			<option value="Medical Store">Medical Store</option>
			<option value="Tailor">Tailor</option>
			<option value="General Store">General Store</option>
			<option value="Hospital">Hospital</option>
			<option value="Grocery Shop">Grocery Shop</option>
			<option value="Parlour">Parlour</option>
			<option value="Clothes Shop">Clothes Shop</option>
			<option value="Electronics">Electronics</option>
			<option value="Bakery">Bakery</option>
			<option value="Stationery">Stationery</option>
		</select>
		<label>Choose Store Category</label>
	</div>
	</div>
	
	<div class="row">
		<div class="input-field col s6">
			<i class="material-icons prefix">av_timer</i>
			<input id="rad" name="rad" type="text" class="validate" required>
			<label for="rad">Radius(In Km.)</label>
		</div>
	</div>
	
	<button class="btn waves-effect waves-light" type="submit" name="action">
		Find Stores
		<i class="material-icons right">location_on</i>
	</button>
	
	&nbsp;&nbsp;&nbsp;&nbsp;
	<button class="btn waves-effect waves-light" type="reset">
		Reset
		<i class="material-icons right">replay</i>
	</button>
	
	</form>
</div>   <!---ENDING CONTAINER--->
</div> <!---ending col--->

<div class="col s3">
	<div id="map"  align="center" style="width: 320px; height: 480px;"></div>
</div>   <!---ENDING col--->
</div>	   <!---ENDING row--->

</body>
</html>

</div>
	
<!---Tab 2: Owner LogIn--->
<div id="owner-login" class="col s12">

<html>
</head>
	<style>
	.centered {
				position: fixed;
				top: 50%;
				left: 50%;
				margin-top: -30px;
				margin-left: -230px;
			  }
	</style>
</head>

<body>

<h1 align="center">Owners LogIn</h1>
	
<h4 align="center">
	<?php
		if(isset($_GET['msg']))
			echo $_GET['msg'];
	?>
</h4>

<div class="centered">
<form action="owner_login.php" method="POST" class="col s6">
	<table class='centered' border='1' align='center'>
		<div class="row">
		<tr>
			<div class="input-field col s6">
				<i class="material-icons prefix">account_circle</i>
				<input id="unm" name="unm" align="center" type="text" class="validate" required>
				<label for="unm">Username</label>
			</div>
		</tr>
	</div>
	
	<div class="row">
	<tr>
		<div class="input-field col s6">
			<i class="material-icons prefix">lock</i>
			<input id="pswd" name="pswd" type="password" class="validate" required>
			<label for="pswd">Password</label>
		</div>
	</tr>
	</div>
	
	
	</table>
	
	<button class="btn waves-effect waves-light" type="submit" name="action">LogIn
    <i class="material-icons right">send</i>
	</button>
	
	&nbsp;&nbsp;&nbsp;&nbsp;
	<button class="btn waves-effect waves-light" type="reset">Reset
    <i class="material-icons right">replay</i>
	</button>
	
	&nbsp;&nbsp;&nbsp;&nbsp;
	<a class="waves-effect waves-light btn green" href="registration.php">
		<i class="material-icons right">perm_identity</i>
		New User?
	</a>
	
	</br>
	</br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a class="waves-effect waves-light btn red" href="forgot_pswd.php">
		<i class="material-icons right"></i>
		Forgot Password?
	</a>
</form>

</div>
</div>

</body>
</html>

</div>

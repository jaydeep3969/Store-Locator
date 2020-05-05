<!---Editing a store--->

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
	<title>Edit Store</title>	
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
		<li><a class="dropdown-button" href="#!" data-activates="dropdown1">My Profile<i class="material-icons right">arrow_drop_down</i></a></li>
    </ul>
  </div>
</nav>
</body>
</html>


<?php

$unm = $_SESSION['unm'];
$storenm = $_GET['storenm'];

//try{
//	echo "in notification.php";
//	session_start();
	
	$dbhandler = new PDO("mysql:host=127.0.0.1;dbname=ownersdb","user1","user1");
	
	$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql = "SELECT * FROM ownersdb.ownerstores WHERE Username=? and Name=?";
	
	$query = $dbhandler->prepare($sql);
	
	$query -> execute(array($unm,$storenm));
	
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
	<title>Edit Store</title>
	<script>
		$(document).ready(function() {
		$('select').material_select();
		});
	</script>
	

<script>
  var geocoder;
  var map;
  function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(<?php echo $row['Lat'];?>, <?php echo $row['Lng'];?>);
    var mapOptions = {
      zoom: 12,
      center: latlng
    }
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
	map.setCenter(latlng);
	var marker = new google.maps.Marker({
            map: map,
            position: latlng
        });
  }

  function codeAddress() {
    var address = document.getElementById('address').value;
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

<div class="card-panel">
      <span class="blue-text text-darken-2">
			<h4 align="center"> Edit Store </h4>
	  </span>
</div>

<div class="row">
<div class="col s9">

<div class="container">
<form action="notification_editStore.php" method="POST" class="col s12">

	<?php $_SESSION['old_storenm'] = $row['Name'];?>
	
	<div class="row">
		<div class="input-field col s6">
			<i class="material-icons prefix">payment</i>
			<input id="storenm" name="storenm" type="text" value="<?php echo $row['Name'];?>" class="validate" required>
			<label for="storenm">Store Name</label>
		</div>
		
	<div class="input-field col s6">
		<select name="storeCat" required>
			<option value="Hotel" <?php if($row['Category'] == "Hotel") {echo "selected";}?>>Hotel</option>
			<option value="Medical Store" <?php if($row['Category'] == "Medical Store") {echo "selected";}?>>Medical Store</option>
			<option value="Tailor" <?php if($row['Category'] == "Tailor") {echo "selected";}?>>Tailor</option>
			<option value="General Store" <?php if($row['Category'] == "General Store") {echo "selected";}?>>General Store</option>
			<option value="Hospital" <?php if($row['Category'] == "Hospital") {echo "selected";}?>>Hospital</option>
			<option value="Grocery Shop" <?php if($row['Category'] == "Grocery Shop") {echo "selected";}?>>Grocery Shop</option>
			<option value="Parlour" <?php if($row['Category'] == "Parlour") {echo "selected";}?>>Parlour</option>
			<option value="Clothes Shop" <?php if($row['Category'] == "Clothes Shop") {echo "selected";}?>>Clothes Shop</option>
			<option value="Electronics" <?php if($row['Category'] == "Electronics") {echo "selected";}?>>Electronics</option>
			<option value="Bakery" <?php if($row['Category'] == "Bakery") {echo "selected";}?>>Bakery</option>
			<option value="Stationery"<?php if($row['Category'] == "Stationery") {echo "selected";}?>>Stationery</option>
		</select>
		<label>Choose Store Category</label>
	</div>
	</div>
	
	<div>
		<div class="input-field col s12">
			<div>Address</div>
			<i class="material-icons prefix">business</i>
			<textarea  id="address" name="address" class="materialize-textarea" onchange="codeAddress()" required><?php echo $row['Address'];?></textarea>
        </div>
	</div>
	
	<div class="row">
		<div class="input-field col s6">
			<input id="lat" name="lat" type="text" value="<?php echo $row['Lat'];?>" class="validate" readonly>
			<label for="lat">Latitude</label>
		</div>

		<div class="input-field col s6">
			<input id="lng" name="lng" type="text" value="<?php echo $row['Lng'];?>" class="validate" readonly>
			<label for="lng">Longitude</label>
		</div>
	</div>
	
	<div class="row">
		<div class="input-field col s6">
			<div>Opening Time:</div>
			<i class="material-icons prefix">schedule</i>
			<input id="otime" name="otime" type="time" value="<?php echo $row['Open'];?>" class="validate" required>
		</div>

		<div class="input-field col s6">
			<div>Closing Time:</div>
			<i class="material-icons prefix">schedule</i>
			<input id="ctime" name="ctime" type="time" value="<?php echo $row['Close'];?>" class="validate" required>
		</div>
	</div>
	
	
	<div class="row">	
	<div class="input-field col s6">
		<select name="cday" required>
			<option value="Sunday" <?php if($row['Closeday'] == "Sunday") {echo "selected";}?>>Sunday</option>
			<option value="Monday" <?php if($row['Closeday'] == "Monday") {echo "selected";}?>>Monday</option>
			<option value="Tuesday" <?php if($row['Closeday'] == "Tuesday") {echo "selected";}?>>Tuesday</option>
			<option value="Wednesday" <?php if($row['Closeday'] == "Wednesday") {echo "selected";}?>>Wednesday</option>
			<option value="Thursday" <?php if($row['Closeday'] == "Thursday") {echo "selected";}?>>Thursday</option>
			<option value="Friday" <?php if($row['Closeday'] == "Friday") {echo "selected";}?>>Friday</option>
			<option value="Saturday" <?php if($row['Closeday'] == "Saturday") {echo "selected";}?>>Saturday</option>
			<option value="None"<?php if($row['Closeday'] == "None") {echo "selected";}?>>None</option>
		</select>
		<label>Choose Closing Day</label>
	</div>
	</div>
	
	<button class="btn waves-effect waves-light" type="submit" name="action">Update Store
    <i class="material-icons right">send</i>
	</button>
	
	&nbsp;&nbsp;&nbsp;&nbsp;
	<button class="btn waves-effect waves-light" type="reset">Reset
    <i class="material-icons right">replay</i>
	</button>
</form>
</div>
</div>

<div class="col s3">
</br></br>
<div id="map"  align="center" style="width: 320px; height: 480px;"></div>
</div>

</div>
</body>
</html>
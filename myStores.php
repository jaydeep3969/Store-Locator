<!---home page--->
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

<?php
	session_start();
	$unm = $_SESSION['unm'];
?>


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
	<title>My Stores</title>	
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


<!---Tabs--->
<ul id="tabs-swipe-demo" class="tabs">
    <li class="tab col s3">
		<a class="active" href="#my-stores-on-map">
			My Stores On Map
		</a>
	</li>
    <li class="tab col s3">
		<a href="#my-stores">
			My Stores
		</a>
	</li>
</ul>



	
	
<!---Tab 2: My Stores Table--->
<div id="my-stores" class="col s12">
<body onload="initMap()">

	&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="addNewStore.php" class="btn-floating btn-large waves-effect waves-light red" >
		<i class="material-icons">add</i>
		<!--<class="btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="I am tooltip">-->
	</a>
	
	<h2 align="center">
	<?php
		if(isset($_GET['msg']))
			echo $_GET['msg'];
	?>
	</h2>
	
	<div class="col s12">
	<?php

		if(!empty($unm))
		{
			$locations = array();
			
			try{			
				$dbhandler = new PDO("mysql:host=127.0.0.1;dbname=ownersdb","user1","user1");

				$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
				$sql = "SELECT * from ownersdb.ownerstores where Username=?";
		
				$query = $dbhandler->prepare($sql);
			
				$query->execute(array($unm));
							
				if(($query->rowcount()) > 0)
				{
					//echo "<div class='card-panel teal lighten-2'><h3 align='center'>My Stores</h3></div>";
					echo "<table class='striped' border='1' align='center'>
							<thead>
							<tr>
								<th>StoreName</th>
								<th align='center'>Category</th>
								<th align='center'>Address</th>
								<th align='center'>Latitude</th>
								<th align='center'>Longitude</th>
								<th align='center'>Opening Time</th>
								<th align='center'>Closing Time</th>
								<th align='center'>Closed On</th>
							</tr>
							</thead>
							<tbody>";
					while($row = $query->fetch(PDO::FETCH_ASSOC))
					{
						echo "<tr>
								<td  align='center'>".$row["Name"]."</td>
								<td align='center'>".$row["Category"]."</td>
								<td align='center'>".$row["Address"]."</td>
								<td align='center'>".$row["Lat"]."</td>
								<td align='center'>".$row["Lng"]."</td>
								<td align='center'>".$row["Open"]."</td>
								<td align='center'>".$row["Close"]."</td>
								<td align='center'>".$row["Closeday"]."</td>
								<td align='center'><a href='edit_store.php?storenm=".$row['Name']."'><i class='small material-icons'>mode_edit</i></a></td>
								<td align='center'><a href='delete_store.php?storenm=".$row['Name']."'><i class='small material-icons'>delete</i></a></td>
								</tr>";
		

							$locations[] = array('name'=>$row['Name'],'cat'=>$row['Category'],'lat'=>$row['Lat'],'lng'=>$row['Lng'],'open'=>$row['Open'],'close'=>$row['Close'],'closeday'=>$row['Closeday']);
					}	
					echo "</tbody>
						  </table>
						  </div>";
  
				/* Convert data to json */
					$markers = json_encode( $locations );
				}
				else
				{
					echo "<h3>No Entry of Any Store Available</h3>";
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

</body>
</div>



<!---Tab 1:My Stores On Map--->
<div id="my-stores-on-map">
	
	<script>
		<?php
			echo "var markers =".$markers.";\n";
		?>
	
		//initialize map
		function initMap() 
		{
			var latlng = {lat: 23.022505, lng: 72.57136209999999};
			var map = new google.maps.Map(document.getElementById('map'), 
				 {
					zoom: 12,
					center : latlng
				 });
	  
			var i=0 ;

			var latlngbounds = new google.maps.LatLngBounds();
			
			for(i=0; i<markers.length; i++)
			{	
				var data = markers[i]
				var latlng = new google.maps.LatLng(data.lat , data.lng);
			
				//positioning marker
				marker = new google.maps.Marker
						({
							position: latlng,
							map: map,
							title: data.name
						 });
						 
				//setting content for marker
				var contentString = "<b>Store Name: "+data.name+"</b>"
									+"</br>Category: "+data.cat
									+"</br>Opening Time: "+data.open
									+"</br>Closing Time: "+data.close
									+"</br>Closed On: "+data.closeday;
				
				//infowindow for Marker
				var infowindow = new google.maps.InfoWindow();
				google.maps.event.addListener(marker,'click', (function(infowindow,mark,contentStr) {
								return function() {
									infowindow.setContent(contentStr);
									infowindow.open(map, mark);
								};
								})(infowindow,marker,contentString));
				
				latlngbounds.extend(marker.position);
			}
			map.setCenter(latlngbounds.getCenter());
            map.fitBounds(latlngbounds);
			
		}	
	</script>
	
	<script async defer
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAp8N0owYgNP2m2vTZgaunlTRsANum1pms&callback=initMap">
    </script>	
	
	<div class="col s12">
	<div id="map" style="width: 100% ; height: 100%;"></div>
	</div>	
	
	
</div>
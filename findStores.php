<!---find stores--->

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
	<title>Available Stores</title>
</head>
<body>
<nav>
  <div class="nav-wrapper">
    <a href="" class="brand-logo">
		Store Locator
		<!--<img src="images/logo.png">-->
		<i class="material-icons prefix">store</i>
		<i class="material-icons prefix">location_on</i>
	</a>
	<ul id="nav-mobile" class="right hide-on-med-and-down">
		<li><a href="homepage.php" >Home</a></li>
    </ul>
  </div>
</nav>
</body>
</html>



<!---Tabs--->
<ul id="tabs-swipe-demo" class="tabs">
    <li class="tab col s3">
		<a class="active" href="#available-stores-on-map">
			Available Stores On Map
		</a>
	</li>
    <li class="tab col s3">
		<a href="#available-stores">
			Available Stores
		</a>
	</li>
</ul>


	
<!---Tab 2: Available Stores Table--->
<div id="available-stores" class="col s12">

<body onload="initMap()">

	<?php

		session_start();
		
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];
		$rad = $_POST['rad'];
		$cat = $_POST['storeCat'];
		$locations = array();
		
		$locations[] = array('name'=>'Current Location','lat'=>$lat,'lng'=>$lng);
		
		try{			
			$dbhandler = new PDO("mysql:host=127.0.0.1;dbname=ownersdb","user1","user1");

			$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
			$sql = "SELECT Username,Name,Address,Lat,Lng,Open,Close,Closeday, ( 6371 * acos( cos( radians(?) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(?) ) + sin( radians(?) ) * sin( radians( lat ) ) ) ) AS distance FROM ownersdb.ownerstores where Category=? HAVING distance < ? ORDER BY distance LIMIT 0 , 20";
			
			$query = $dbhandler->prepare($sql);
			
			$query->execute(array($lat,$lng,$lat,$cat,$rad));
						
			if(($query->rowcount()) > 0)
			{
				//Available Stores Table
				echo "<table class='striped' border='1' align='center'>
						<thead>
						<tr>
							<th align='center'><b>StoreName</b></th>
							<th align='center'><b>Address</b></th>
							<th align='center'><b>Latitude</b></th>
							<th align='center'><b>Longitude</b></th>
							<th align='center'><b>Opening Time</b></th>
							<th align='center'><b>Closing Time</b></th>
							<th align='center'><b>Closed On</b></th>
							<th align='center'><b>Email</b></th>
							<th align='center'><b>Mobile</b></th>
						</tr>
						</thead>
						<tbody>";
				while($row = $query->fetch(PDO::FETCH_ASSOC))
				{
					
					$sql1 = "SELECT * from ownersdb.ownersdetails where Username=?";
		
					$query1 = $dbhandler->prepare($sql1);
			
					$query1->execute(array($row["Username"]));
				
					$row1 = $query1->fetch(PDO::FETCH_ASSOC);
					
					echo "<tr>
							<td  align='center'>".$row["Name"]."</td>
							<td align='center'>".$row["Address"]."</td>
							<td align='center'>".$row["Lat"]."</td>
							<td align='center'>".$row["Lng"]."</td>
							<td align='center'>".$row["Open"]."</td>
							<td align='center'>".$row["Close"]."</td>
							<td align='center'>".$row["Closeday"]."</td>
							<td align='center'>".$row1["Email"]."</td>
							<td align='center'>".$row1["Mobile"]."</td>
						  </tr>";
		

						$locations[] = array('name'=>$row['Name'],'lat'=>$row['Lat'],'lng'=>$row['Lng'],'open'=>$row['Open'],'close'=>$row['Close'],'closeday'=>$row['Closeday'],'email'=>$row1['Email'],'mob'=>$row1['Mobile']);
				}	
				echo "</tbody>
					  </table>";
				
				/* Convert data to json */
				$markers = json_encode( $locations );
			}
			else
			{
				$_SESSION['active'] = 1;
				header("location:homepage.php?msg1=No ".$cat." Nearby You/Your Address");
			}				
		}	 
		catch(PDOException $e)
		{
			echo $e->getMessage();
			die();	
		}
	?>
</body>
</div>


<!---Tab 1:Available Stores On Map--->
<div id="available-stores-on-map">
	
		<script>
		<?php
			echo "var markers =".$markers.";\n";
		?>
	
		function initMap() 
		{
			var latlng = {lat: <?php echo $_POST['lat'];?>, lng: <?php echo $_POST['lng'];?>};
			var map = new google.maps.Map(document.getElementById('map'), 
				 {
					zoom: 12,
					center : latlng
				 });
			
			map.setCenter(latlng);

			var i ;

			var latlngbounds = new google.maps.LatLngBounds();

			for(i=0; i<markers.length; i++)
			{
				var data = markers[i]
				var latlng = new google.maps.LatLng(data.lat , data.lng);
			
				marker = new google.maps.Marker
						({
							position: latlng,
							map: map,
							title: data.name
						 });
				
				latlngbounds.extend(marker.position);
				
				//setting content for marker
				if(i != 0)
				{
				var contentString = "<b>Store Name: "+data.name+"</b>"
									+"</br>Opening Time: "+data.open
									+"</br>Closing Time: "+data.close
									+"</br>Closed On: "+data.closeday
									+"</br>Email: "+data.email
									+"</br>Mobile No.: "+data.mob;
				}
				else
				{
					var contentString = "Current Location";
				}

				//infowindow for Marker
				var infowindow = new google.maps.InfoWindow();
				google.maps.event.addListener(marker,'click', (function(infowindow,mark,contentStr) {
								return function() {
									infowindow.setContent(contentStr);
									infowindow.open(map, mark);
								};
								})(infowindow,marker,contentString));
			}
			
			map.setCenter(latlngbounds.getCenter());
            map.fitBounds(latlngbounds);
		}	
	</script>
	
	<script async defer
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAp8N0owYgNP2m2vTZgaunlTRsANum1pms&callback=initMap">
    </script>	

	<div id="map" style="width: 100% ; height: 100%;"></div>

</div>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <script type="text/javascript" src="//maps.google.com/maps/api/js?key=AIzaSyA4lEFTH1RF7Oo-WUbHkxHDLZl_CRj5MOA"></script>
  <script src="gmaps.js"></script>
  <style type="text/css">
    #map {
      width: 1100px;
      height: 700px;
    }
  </style>
</head>
<body>
  <div id="map"></div>
  <script>
    var map = new GMaps({
      el: '#map',
      lat: 0,
      lng: 0,
	  zoom: 2
    });
	
	<?php 
	$array = array("#ff0000","#ff4000","#ff8000","#ffbf00","#ffff00","#bfff00","#80ff00","#40ff00","#00ff00","#00ff40","#00ff80","#00ffbf","#00ffff","#00bfff","#0080ff.#0040ff","#0000ff","#4000ff","#8000ff","#bf00ff","#ff00ff","#ff00bf","#ff0080","#ff0040","#ff0000");
	$file = file_get_contents('data.json');
	$arrayData = json_decode($file, true);
	$pathName=0;
	foreach ($arrayData as $data){
		if (isset($data['Routes']) && isset($data['Routes']['Estancia'])){
			echo "path".$pathName." = [";
			$primer=false;
			foreach ($data['Routes']['Estancia'] as $data2){
				if (!$primer)
					$primer=true;
				else
					echo ",";
				echo "[".$data2['Latitude'].",".$data2['Longitude']."]";
			}
			echo "];";
			
			echo "map.drawPolyline({";
			echo "path: path".$pathName.",";
			if ($pathName==0)
				echo "strokeColor: '".$array[0]."',";
			else
				echo "strokeColor: '".$array[($pathName%25)]."',";
			echo "strokeOpacity: 0.6,";
			echo "strokeWeight: 6";
			echo "});";
			$pathName++;
		}	
	}
	
	
	?>
	
	path = [[-12.044012922866312, -77.02470665341184], [-12.05449279282314, -77.03024273281858], [-12.055122327623378, -77.03039293652341], [-12.075917129727586, -77.02764635449216], [-12.07635776902266, -77.02792530422971], [-12.076819390363665, -77.02893381481931], [-12.088527520066453, -77.0241058385925], [-12.090814532191756, -77.02271108990476]];

map.drawPolyline({
  path: path,
  strokeColor: '#131540',
  strokeOpacity: 0.6,
  strokeWeight: 6
});
	<?php	
	
	$file = file_get_contents('data.json');
	$arrayData = json_decode($file, true);
	foreach ($arrayData as $data){
		if (isset($data['Routes']) && isset($data['Routes']['Estancia'])){
			foreach ($data['Routes']['Estancia'] as $data2){
				echo "map.addMarker({";
				echo "lat: " . $data2['Latitude'] . ",";
				echo "lng: " . $data2['Longitude'] . ",";
				echo "icon: \"geo/IconoRojo.png\"";
				echo "});";
			}
		}	
	}
	?>
	
	
	/* for ($i=0; $i<5; $i++)
	{
	echo "map.addMarker({";
  echo "lat: 37.8036291,";
  echo "lng: -12".$i.".2716803999999,";
  echo "icon: \"geo/IconoRojo.png\"";
  echo "});";
	}
	?> */
  </script>
</body>
</html>


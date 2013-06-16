<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>NextBus</title>
    
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>
	<script type="text/javascript">	
    var marker;
    var infowindow;

    function initialize() {
      var latlng = new google.maps.LatLng(7.0910,79.9994);
      var options = {
        zoom: 13,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      }
      var map = new google.maps.Map(document.getElementById("map-canvas"), options);
	  
	  
	  
        $(document).ready(function(){
                $.getJSON('viewhalts.php', function(data) {
                        $.each(data, function(key, val) {
                                $('ul').append('<li id="' + key + '">' + val.name + ' ' + val.long + ' ' + val.lati + '</li>');
                       
								var maploct = new google.maps.LatLng(val.lati,val.long);
								var marker=new google.maps.Marker({
								position:maploct,
								title:val.name
								});
								marker.setMap(map);
								});
                });

        });		  
      var html = "<table>" +
                 "<tr><td>Halt Name:</td> <td><input type='text' id='name'/> </td> </tr>" +
                 "<tr><td></td><td><input type='button' value='Save' onclick='saveData()'/></td></tr>";
    infowindow = new google.maps.InfoWindow({
     content: html
    });
 
    google.maps.event.addListener(map, "click", function(event) {
        marker = new google.maps.Marker({
          position: event.latLng,
          map: map
        });
        google.maps.event.addListener(marker, "click", function() {
          infowindow.open(map, marker);
        });
    });
    }

    function saveData() {
		var name = escape(document.getElementById("name").value);
		var latlng = marker.getPosition();
 
		var url = "rowadder.php?name=" + name + "&lat=" + latlng.lat() + "&lng=" + latlng.lng();
		downloadUrl(url, function(data, responseCode) {
		infowindow.close();	
		  alert('Halt Added');
		 //document.getElementById("message").innerHTML = "Halt added.";
        if (responseCode == 200 && data.length <= 1) {
          infowindow.close();
			
        }
      });
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request.responseText, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}
    </script>
    
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap responsive -->
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <!-- Font awesome - iconic font with IE7 support --> 
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/font-awesome-ie7.css" rel="stylesheet">
    <!-- Bootbusiness theme -->
    <link href="css/boot-business.css" rel="stylesheet">
    
  </head>

  <body style="margin:0px; padding:0px;" onload="initialize()">
    
            <div id="map-canvas" style="width: 800px; height: 600px"></div>
            <div id="message"></div>
            
  </body>

</html>
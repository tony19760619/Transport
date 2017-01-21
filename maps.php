    <!--<textarea id='pac-input-<?php echo $map; ?>' class='controls' wrap='soft' rows='4' id='PickUpPoint' style='width:240px'></textarea><br> -->
    
    <div id="<?php echo $map; ?>" style="width: 1100px; height: 480px"></div>
    <input id="pac-input-<?php echo $map; ?>" class="controls" type="text" placeholder="Search Box" size="50" /><br>
    <script type="text/javascript">
    
    //--------------------------------------------------------------------------
    //-- Map global variables
    //--------------------------------------------------------------------------
    var CurrentLocationLat = -30.000000;
    var CurrentLocationLng = 25.000000;

    var bottomLeftLng;
    var bottomLeftLat;
    var topRightLng;
    var topRightLat;
  
  
    var <?php echo $map; ?> = new google.maps.Map(document.getElementById("<?php echo $map; ?>"), {
        center: new google.maps.LatLng(CurrentLocationLat, CurrentLocationLng),
        zoom: 5,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });  
   
    var CustomIcons = {
      PickUp: {
        icon: 'images/Map-Marker-Green.png'
      },
      DropOff: {
        icon: 'images/Map-Marker-Red.png'
      }
    };
    
    var markers = [];
    var spaceoutgroups = [];
    var clusters = [];
        
    var infoWindow = new google.maps.InfoWindow;

    // Create the search box and link it to the UI element.
    var input = document.getElementById('pac-input-<?php echo $map; ?>');
    var searchBox = new google.maps.places.SearchBox(input);
    <?php echo $map; ?>.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    
    //--------------------------------------------------------------------------
    //-- Current location functions
    //--------------------------------------------------------------------------
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(geosuccess, geoerror);
    } else {
      alert('error: geolocation not supported');
    }

    function geosuccess(geoposition) {
      CurrentLocationLat = geoposition.coords.latitude;
      CurrentLocationLng = geoposition.coords.longitude;
      
      <?php echo $map; ?>.setCenter({lat: CurrentLocationLat, lng: CurrentLocationLng})
      <?php echo $map; ?>.setZoom(10);
      
        var mapbounds = <?php echo $map; ?>.getBounds();
        
        var southWest = mapbounds.getSouthWest();
        var northEast = mapbounds.getNorthEast();
        bottomLeftLng = southWest.lng();
        bottomLeftLat = southWest.lat();
        topRightLng   = northEast.lng();
        topRightLat   = northEast.lat();
        
        //alert('['+ bottomLeftLng + ':'+ bottomLeftLat+']['+ topRightLng + ':'+ topRightLat+']');    

        load();
        return true;
        
    }

    function geoerror(msg) {
      alert('error: ' + msg +'['+msg.code+']'+msg.message);
    }
    
  //----------------------------------------------------------------------------
  //-- Each time the map is moved this is fired, we need a timeout to see where user is interested
  //----------------------------------------------------------------------------
  <?php echo $map; ?>.addListener('bounds_changed', (function () {
    var timer;
    return function() {
        clearTimeout(timer);
        timer = setTimeout(function() {
            
            var mapbounds = <?php echo $map; ?>.getBounds();
            searchBox.setBounds(mapbounds);

            var southWest = mapbounds.getSouthWest();
            var northEast = mapbounds.getNorthEast();
            bottomLeftLng = southWest.lng();
            bottomLeftLat = southWest.lat();
            topRightLng   = northEast.lng();
            topRightLat   = northEast.lat();
            
            //alert('['+ bottomLeftLng + ':'+ bottomLeftLat+']['+ topRightLng + ':'+ topRightLat+']');    

            load();
            return true;
        }, 2000);
    }
  }()));


//------------------------------------------------------------------------------
//-- Functions to handle searchbox input of interested location
//------------------------------------------------------------------------------
  searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    markers.forEach(function(marker) {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
      var icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      markers.push(new google.maps.Marker({
        map: <?php echo $map; ?>,
        icon: icon,
        title: place.name,
        position: place.geometry.location
      }));

      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    <?php echo $map; ?>.fitBounds(bounds);
  });

//------------------------------------------------------------------------------
//-- Load points from db onto map
//------------------------------------------------------------------------------
    var loaded_dbmarkers = [];
    function load() {
      // Change this depending on the name of your PHP file
      downloadUrl("phpsqlajax_genxml.php?bottomLeftLng='"+bottomLeftLng+"'&bottomLeftLat='"+bottomLeftLat+"'&topRightLng='"+topRightLng+"'&topRightLat='"+topRightLat+"'", function(data) {

        var xml = data.responseXML;
        var dbmarkers = xml.documentElement.getElementsByTagName("marker");
             
        for (var i = 0; i < dbmarkers.length; i++) {
          var ID = dbmarkers[i].getAttribute("ID");
          var Type = dbmarkers[i].getAttribute("Type");
          var Lat = dbmarkers[i].getAttribute("Lat");
          var Lng = dbmarkers[i].getAttribute("Lng");
          
          //--------------------------------------------------------------------
          //-- Set Previously loaded variable
          //--------------------------------------------------------------------
          var PreviouslyLoaded = false;
          if(loaded_dbmarkers[ID+'-'+Type+'-'+Lat+'-'+Lng]==null){
            //not loaded
            loaded_dbmarkers[ID+'-'+Type+'-'+Lat+'-'+Lng]=1;
            previouslly_loaded = false;
          }else{
            //previously loaded
            previouslly_loaded = true;
            continue;
          }
                    
          var PickUpPoint = dbmarkers[i].getAttribute("PickUpPoint");
          var DropOffPoint = dbmarkers[i].getAttribute("DropOffPoint");
          PickUpPoint = showNewLines(PickUpPoint);
          DropOffPoint = showNewLines(DropOffPoint);
          var Distance = dbmarkers[i].getAttribute("Distance");
          
          var point = new google.maps.LatLng(
              parseFloat(dbmarkers[i].getAttribute("Lat")),
              parseFloat(dbmarkers[i].getAttribute("Lng")));
              
              
          recowner = dbmarkers[i].getAttribute("recowner");
          loggedin = dbmarkers[i].getAttribute("loggedin");
  
          if(loggedin == ''){
              litype = 3;
          }else if(recowner == loggedin){
              litype = 1;
          }else{
              litype = 2;
          }
              
          var html = "<table><tr><th>ID:</th><th>"+ID+"</th></tr>"+
                  "<tr><td>Pick Up Point:</td><td><textarea wrap='soft' rows='4' style='width:280px' readonly>"+ PickUpPoint + "</textarea></td></tr>"+
                  "<tr><td>Drop Off Point:</td><td><textarea wrap='soft' rows='4' style='width:280px' readonly>" + DropOffPoint + "</textarea></td></tr>"+
                  "<tr><td>Distance:</td><td>" + Distance + "</td></tr>"+
                  "<tr><td>Details, Bid and Messages:</td><td>"+
                  "<input type='button' value='  Details  ' onclick='getdetailsclick("+ID+","+litype+","+'recowner'+","+'loggedin'+");' /></td></tr>"+
                  "</table>";
          var icon = CustomIcons[Type] || {};
          
          if(spaceoutgroups[Lat+'-'+Lng] == null){
              spaceoutgroups[Lat+'-'+Lng] = 0;
          } else{
              spaceoutgroups[Lat+'-'+Lng] += 1;
          } 
            
          point = new google.maps.LatLng(
                   parseFloat(Lat),(
                   parseFloat(Lng)+ (parseFloat(spaceoutgroups[Lat+'-'+Lng])*0.00005)));
                      
          var marker = new google.maps.Marker({
            map: <?php echo $map; ?>,
            position: point,
            icon: icon.icon
          });
          clusters.push(marker);
          bindInfoWindow<?php echo $map; ?>(marker, <?php echo $map; ?>, infoWindow, html);
        }
        var markerCluster = new MarkerClusterer(<?php echo $map; ?>, clusters);
        
      });
    }

    function bindInfoWindow<?php echo $map; ?>(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}

  </script>
  <script>load()</script>
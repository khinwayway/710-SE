<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Cache-control" content="no-cache">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet/nestscout.css">
    <script src="map/onemap-leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="">
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/fetch.js" type="text/javascript"></script>
    <title>NestScout</title>
    <link rel="stylesheet" href="map/leaflet.css" />
  					<script src="map/leaflet.js"></script>
  					<!--This leaflet-providers is modified to include One Map 2.0 maps-->
  					<script src="map/leaflet-providers-added-onemap.js"></script>
  				</head>
	<body onload="fetchTowns(); fetchType(); fetchModel();">

    <nav class="navbar navbar-expand-lg nestbar">
      <img src="img/nestscout.png" style="padding:1%;" width="200" alt="">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.html">Search <span class="sr-only"></span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="browseCat.html">Browse by Category</a>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="nav-item">
            <a class="nav-link" href="signup.html">Sign Up</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.html">Log In</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container-left" style="overflow-y: scroll; overflow-x: hidden;">
      <form>
        <label class="catLabel">Town</label>
          <div class="townCheck">
            <div id="townDefault"></div>
            <div class="collapse-group collapse" id="townExpand">

            </div>
            <p><a class="btn" data-toggle="collapse" data-target="#townExpand" href="#townExpand" >show more.. &raquo;</a></p>
          </div>
        <label class="catLabel">Flat Type</label>
          <div id="typeCheck">
            <div id="typeDefault"></div>

            <div class="collapse-group collapse" id="typeExpand">
            </div>
              <p><a class="btn" data-toggle="collapse" data-target="#typeExpand" href="#typeExpand">show more.. &raquo;</a></p>
            </div>

            <label class="catLabel">Flat Model</label>
              <div class="modelCheck">
                <div id="modelDefault"></div>

                <div class="collapse-group collapse" id="modelExpand">

                </div>
                  <p><a class="btn" data-toggle="collapse" data-target="#modelExpand" href="#modelExpand">show more.. &raquo;</a></p>
              </div>
              <label class="catLabel">Price Range</label>
              <div class="form-check" id="minPrice">
                <input class="form-check-input" value="" placeholder="Minimum">
                <label>min</label>
              </div>
              <div class="form-check" id="maxPrice">
                <input class="form-check-input" value="" placeholder="Maximum">
                <label>max</label>
              </div>
              <br>
              <button class="btn btn-sm btn-primary btn-block" name="submit" id="submit" type="button" style="background-color:#DBA97A; width:40%; float:right; position=fixed; display:block;" onclick="submitForm()">Submit</button>
            </form>
      </div>
    </div>
    <div class="container-right">
      <div style='height:30em; width:100%; float:left;'>
        <div class="row" id="results">
        </div>
        <div id="map" class="propertyDisplay active">
          <div id="mapid" style="width: 600px; height: 400px; position: relative;" class="leaflet-container leaflet-touch leaflet-retina leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0"></div>
        </div>
        <div id="property" class="propertyDisplay">
        </div>
      </div>
      <button class="dot pagebtn"></button>
      <button class="dot pagebtn"></button>
      <button class="dot pagebtn"></button>
    </div>
    <script type="text/javascript">
      $(document).ready(function () {
        $('.btn').click(function () {
          var type=[];
          var town=[];
          var model=[];
          $("input[name='typelist[]']:checked").each(function(){
              type.push(this.value);
          });

          $("input[name='townlist[]']:checked").each(function(){
              town.push(this.value);
          });
          $("input[name='modellist[]']:checked").each(function(){
              model.push(this.value);
          });

          $.ajax({
              type: "POST",
              url: "browseResult.php",
              data: { typelist:type, townlist:town, modellist:model },
              success: function(data){
              }
          })
          $('#results').load('browseResult.php', { typelist:type, townlist:town, modellist:model } );
        });
      });
    </script>

<script>
  $('.pagebtn').click(function() {
    var cur = $('.pagebtn').index($(this));
    $('.propertyDisplay').removeClass('active');
    $('.propertyDisplay').eq(cur).addClass('active');
  });
</script>

<script>
	var input=document.querySelector('.chosenProperty').id;

	Cloud(input);

	function ShowMap(lat,lng){
	var mymap = L.map('mapid').setView([lat, lng], 13);


	L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1
	}).addTo(mymap);

	L.marker([lat, lng]).addTo(mymap);
	/*
	L.circle([lat, lng], {
		color: 'red',
		fillColor: '#f03',
		fillOpacity: 0.5,
		radius: 500
	}).addTo(mymap);*/
	}

	function Cloud(Input){
		var data = {
			searchVal : Input,
			returnGeom : 'Y',
			getAddrDetails : 'Y',
			pageNum : 1
		}
        $.ajax({
        url: 'https://developers.onemap.sg/commonapi/search',
		data : data,
        success: function(result){

			var result0 = result.results[0];

			//var location = '['+result0.LONGITUDE+','+result0.LATITUDE+']';
			ShowMap(result0.LATITUDE,result0.LONGITUDE);

            }});

  	       }
</script>


  </body>
</html>

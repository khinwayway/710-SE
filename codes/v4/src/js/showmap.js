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

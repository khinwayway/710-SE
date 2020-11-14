function fetchTowns(){
       var townlist = [];
       var towncount = 0;

		  var data = {
        limit: 5000,
			  resource_id: '42ff9cfe-abe5-4b54-beda-c88f9bb438ee' // the resource id
		    };
		  $.ajax({
			url: 'https://data.gov.sg/api/action/datastore_search',
			data: data,
			dataType: 'json',
			success: function(data) {
        console.log(data.result)
        //alert('Total results found: ' + data.result.total)
        for (i = 0; i < 5000; i++) {
          if(townlist.includes(data.result.records[i].town)){

            console.log("count");
          }
          else{
            townlist[towncount] = data.result.records[i].town;
            towncount++;
          }
        }

        for (i = 0; i < 2; i++) {
          var form = document.createElement('div');
          form.className = "form-check";
          var input = document.createElement('input');
          input.className = "form-check-input";
          input.type = "checkbox";
          input.value = townlist[i];
          input.name = "townlist[]";
          var label = document.createElement('label');
          label.className = "form-check-label";
          var townDefault = document.getElementById("townDefault");
          townDefault.appendChild(form);
          form.appendChild(input);
          form.appendChild(label);
          town = townlist[i].toLowerCase();
          town = town.charAt(0).toUpperCase() + town.slice(1);
          label.innerHTML = town.replace(/\s(.)/g, function(a) {
                    return a.toUpperCase();
              }) ;
            }


        for (i = 2; i < townlist.length; i++) {
          var townExpand = document.getElementById("townExpand");
          var form = document.createElement('div');
          form.className = "form-check";
          var input = document.createElement('input');
          input.className = "form-check-input";
          input.type = "checkbox";
          input.value = townlist[i];
          input.name = "townlist[]";
          var label = document.createElement('label');
          label.className = "form-check-label";
          townExpand.appendChild(form);
          form.appendChild(input);
          form.appendChild(label);
          town = townlist[i].toLowerCase();
          town = town.charAt(0).toUpperCase() + town.slice(1);
          label.innerHTML = town.replace(/\s(.)/g, function(a) {
                    return a.toUpperCase();
                }) ;
        }


			}
	  });
  }

function fetchType(){
       var typelist = [];
       var typecount = 0;

		  var data = {
        limit: 500,
			  resource_id: '42ff9cfe-abe5-4b54-beda-c88f9bb438ee' // the resource id
		    };
		  $.ajax({
			url: 'https://data.gov.sg/api/action/datastore_search',
			data: data,
			dataType: 'json',
			success: function(data) {
        console.log(data.result)
      for (i = 0; i < 500; i++) {
        if(typelist.includes(data.result.records[i].flat_type)){
          console.log("count");
        }
        else{
          typelist[typecount] = data.result.records[i].flat_type;
          typecount++;
        }
      }

      for (i = 0; i < 2; i++) {
        var form = document.createElement('div');
        form.className = "form-check";
        var input = document.createElement('input');
        input.className = "form-check-input";
        input.type = "checkbox";
        input.value = typelist[i];
        input.name = "typelist[]";
        var label = document.createElement('label');
        label.className = "form-check-label";
        var typeDefault = document.getElementById("typeDefault");
        typeDefault.appendChild(form);
        form.appendChild(input);
        form.appendChild(label);
        type = typelist[i].toLowerCase();
        type = type.charAt(0).toUpperCase() + type.slice(1);
        label.innerHTML = type.replace(/\s(.)/g, function(a) {
                  return a.toUpperCase();
            }) ;
          }

      for (i = 2; i < typelist.length; i++) {
        var form = document.createElement('div');
        form.className = "form-check";
        var input = document.createElement('input');
        input.className = "form-check-input";
        input.type = "checkbox";
        input.value = typelist[i];
        input.name = "typelist[]";
        var label = document.createElement('label');
        label.className = "form-check-label";
        var typeExpand = document.getElementById("typeExpand");
        typeExpand.appendChild(form);
        form.appendChild(input);
        form.appendChild(label);
        type = typelist[i].toLowerCase();
        type = type.charAt(0).toUpperCase() + type.slice(1);
        label.innerHTML = type.replace(/\s(.)/g, function(a) {
                  return a.toUpperCase();
            }) ;
          }
        }
      });
  }

function fetchModel(){
     var modellist = [];
     var modelcount = 0;

	  var data = {
      limit: 5000,
		  resource_id: '42ff9cfe-abe5-4b54-beda-c88f9bb438ee' // the resource id
	    };
	  $.ajax({
		url: 'https://data.gov.sg/api/action/datastore_search',
		data: data,
		dataType: 'json',
		success: function(data) {
      console.log(data.result)
    for (i = 0; i < 5000; i++) {
      if(modellist.includes(data.result.records[i].flat_model)){
        console.log("count");
      }
      else{
        modellist[modelcount] = data.result.records[i].flat_model;
        modelcount++;
      }
    }

    for (i = 0; i < 2; i++) {
      var form = document.createElement('div');
      form.className = "form-check";
      var input = document.createElement('input');
      input.className = "form-check-input";
      input.type = "checkbox";
      input.value = modellist[i];
      input.name = "modellist[]";
      var label = document.createElement('label');
      label.className = "form-check-label";
      var modelDefault = document.getElementById("modelDefault");
      modelDefault.appendChild(form);
      form.appendChild(input);
      form.appendChild(label);
      model = modellist[i].toLowerCase();
      model = model.charAt(0).toUpperCase() + model.slice(1);
      label.innerHTML = model.replace(/\s(.)/g, function(a) {
                return a.toUpperCase();
          }) ;
        }
    for (i = 2; i < modellist.length; i++) {
      var form = document.createElement('div');
      form.className = "form-check";
      var input = document.createElement('input');
      input.className = "form-check-input";
      input.type = "checkbox";
      input.value = modellist[i];
      input.name = "modellist[]";
      var label = document.createElement('label');
      label.className = "form-check-label";
      var modelExpand = document.getElementById("modelExpand");
      modelExpand.appendChild(form);
      form.appendChild(input);
      form.appendChild(label);
      model = modellist[i].toLowerCase();
      model = model.charAt(0).toUpperCase() + model.slice(1);
      label.innerHTML = model.replace(/\s(.)/g, function(a) {
                return a.toUpperCase();
          }) ;
        }
      }
    });
}

function recPrice(){
  var data = {
    resource_id: '42ff9cfe-abe5-4b54-beda-c88f9bb438ee', // the resource id
    limit: 500, // get 5 results
    q: '4' // query for 'jones'
  };
  $.ajax({
    url: 'https://data.gov.sg/api/action/datastore_search',
    data: data,
    dataType: 'json',
    success: function(data) {
      console.log('Total results found: ' + data.result.total)
    }
  });
}

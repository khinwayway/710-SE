<?php
include_once 'dbconnect.php';
session_start();

?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Cache-control" content="no-cache">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="src/stylesheet/nestscout.css">
    <script src="map/onemap-leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="">
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="src/js/fetch.js" type="text/javascript"></script>
    <script src="src/js/showmap.js"></script>
    <title>NestScout</title>
    <link rel="stylesheet" href="map/leaflet.css" />
  					<script src="map/leaflet.js"></script>
  					<!--This leaflet-providers is modified to include One Map 2.0 maps-->
  					<script src="map/leaflet-providers-added-onemap.js"></script>
  				</head>
	<body onload="fetchTowns(); fetchType(); fetchModel();">

    <nav class="navbar navbar-expand-lg nestbar">
      <img src="src/images/nestscout.png" style="padding:1%;" width="200" alt="">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Search <span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="browseCat.php">Browse by Category</a>
          </li>
        </ul>

        <?php
        if(!isset($_SESSION['usr_name'])){
        ?>
          <ul class="nav navbar-nav navbar-right">
            <li class="nav-item">
              <a class="nav-link" href="account/signup.php">Sign Up</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="account/login.php">Log In</a>
            </li>
          </ul>
      <?php } ?>
      <?php
      if (isset($_SESSION['usr_name']) and $_SESSION['usr_name']!=''){
      ?>
      <ul class="nav navbar-nav navbar-right">
        <li class="nav-item">
          <a class="nav-link" href="account/profile.php">
          <?php  echo($_SESSION['usr_name'])?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="account/logout.php?logout">Logout</a>
        </li>
      </ul>
    <?php } ?>
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

              <button class="btn btn-sm btn-primary btn-block sub" name="submit" id="submit" type="button" style="background-color:#DBA97A; width:40%; float:right; position=fixed; display:block;" onclick="submitForm()">Submit</button>
              <button class="btn-sm btn-primary " name="clear" id="clar" type="button" style="background-color:#DBA97A; width:40%; float:left; position=fixed; display:block;" onclick="window.location.reload();">Clear</button>

            </form>
      </div>
    </div>
    <div class="container-right">
      <div style='height:31em; width:100%; float:left;'>
        <div class="row" id="results">
        </div>
        <div id="map" class="propertyDisplay active">
          <div id="mapid" style="width: 1200px; height: 500px; z-index:1;"></div>
        </div>
        <div id="property" class="propertyDisplay">
        </div>
      </div>
      <div class="buttonspage" id="buttonspage" style="margin-bottom:0px; margin-left:50%; display:block;">
        <button class="dot pagebtn" style="border:none; margin-bottom:0px; height: 10px;width: 5px; border-radius: 50%; display: inline-block;z-index: 100;"></button>
        <button class="dot pagebtn" style="border:none; margin-bottom:0px; height: 10px;width: 5px; border-radius: 50%; display: inline-block;z-index: 100;"></button>
      </div>

    </div>

    <script type="text/javascript">
      $(document).ready(function () {
        $('#buttonspage').hide();
        $('.sub').click(function () {
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
              url: "property/browseResult.php",
              data: { typelist:type, townlist:town, modellist:model },
              success: function(data){
              }
          })
          $('#results').load('property/browseResult.php', { typelist:type, townlist:town, modellist:model } );
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




  </body>
</html>

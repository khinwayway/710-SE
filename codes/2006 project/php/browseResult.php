<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Cache-control" content="no-cache">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet/nestscout.css">
    <script src="map/onemap-leaflet.js"></script>
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
      <form action="browseResult.php" method="POST">
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
              <button class="btn btn-sm btn-primary btn-block" name="submit" id="submit" type="submit" style="background-color:#DBA97A; width:40%; float:right; position=fixed; display:block;" onclick="myFunction()">Submit</button>
            </form>
      </div>
    </div>
    <div class="container-right">
      <div id='propertyResults' style='height:30em; width:100%; float:left;'>
        <div class="row">
          <?php
          mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $servername = "localhost";
            $username = "root";
            $password ="";
            $dbname = "nestscout";
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            if(isset($_POST['townlist'])){
                $townarray = $_POST['townlist'];
                $townsql = implode("','", $townarray);
            }

            if(isset($_POST['typelist'])){
                $typearray = $_POST['typelist'];
                $typesql = implode("','", $typearray);
            }

            if (isset($_POST['modellist'])){
                $modelarray = $_POST['modellist'];
                $modelsql = implode("','", $modelarray);
            }

            if (isset($_POST['modellist'], $_POST['townlist'], $_POST['typelist'])){
              $sql = ("SELECT * FROM `properties`
                WHERE `town` IN ('$townsql')
                AND `flat_type` IN ('$typesql')
                AND `flat_model` IN ('$modelsql')");
              $result = $conn->query($sql);
            }

            else if ((isset($_POST['townlist'], $_POST['typelist'])) && !isset($_POST['modellist'])){
              $sql = ("SELECT * FROM `properties`
                WHERE `town` IN ('$townsql')
                AND `flat_type` IN ('$typesql')");
              $result = $conn->query($sql);
            }

            else if ((isset($_POST['modellist'], $_POST['typelist'])) && !isset($_POST['townlist'])){
              $sql = ("SELECT * FROM `properties`
                WHERE `flat_type` IN ('$typesql')
                AND `flat_model` IN ('$modelsql')");
              $result = $conn->query($sql);
            }

            else if (isset($_POST['townlist']) && !isset($_POST['typelist'],$_POST['modellist'])){
              $sql = ("SELECT * FROM `properties`
                WHERE `town` IN ('$townsql')");
              $result = $conn->query($sql);
            }

            else if (isset($_POST['typelist']) && !isset($_POST['townlist'],$_POST['modellist'])){
              $sql = ("SELECT * FROM `properties`
                WHERE `flat_type` IN ('$typesql')");
              $result = $conn->query($sql);
            }

            else if (isset($_POST['modellist']) && !isset($_POST['townlist'],$_POST['typelist'])){
              $sql = ("SELECT * FROM `properties`
                WHERE `flat_model` IN ('$modelsql')");
              $result = $conn->query($sql);
            }

            else{
              $sql = ("SELECT * FROM `properties`");
              $result = $conn->query($sql);
            }

            while($row = $result->fetch_assoc()) {
                echo "<br> id: ". $row["list_id"]. " - Name: ". $row["town"]. " " . $row["flat_type"] . "<br>";
                echo "<div id='".$row['list_id']."' class='propertyItem col-sm'>";
                echo "<div>".$row['town']."</div>";
                echo "<div>".$row['flat_type']."</div>";
                echo "<div>".$row['flat_model']."</div>";
                echo "<div>".$row['street_name']."</div>";
                echo "</div>";
                echo "<br />";
            }

            $conn->close();
          ?>

        </div>
        <div class="row">
          <div class='propertyContainer col-sm' id='propertyItem'>test</div>
          <div class='propertyContainer col-sm' id='propertyItem'>test</div>
          <div class='propertyContainer col-sm' id='propertyItem'>test</div>
        </div>
      </div>
      <div id='mapdiv' style='height:40em; width:1000px; opacity: 0; float:left; position:absolute;'></div>
    </div>

  <script>

    var baseMaps = {
            "Default": L.tileLayer.provider('OneMap.Default'),
            "Original": L.tileLayer.provider('OneMap.Original'),
            "Night": L.tileLayer.provider('OneMap.Night'),
            "Grey": L.tileLayer.provider('OneMap.Grey')
             };

    var center = L.bounds([1.56073, 104.11475], [1.16, 103.502]).getCenter();

    var map = L.map('mapdiv').setView([center.x, center.y],13);

    L.tileLayer.provider('OneMap.Default').addTo(map);

    L.control.layers(baseMaps).addTo(map);


    function myFunction() {
      var x = document.getElementById("propertyResults");
      var y = document.getElementById("propertyItem");
      if (x.style.opacity === "0") {
        x.style.opacity = "1";
        y.style.opacity = "0";
      } else {
        x.style.opacity = "0";
        y.style.opacity = "1";
      }

      map.invalidateSize();
    }
  </script>


  </body>
</html>

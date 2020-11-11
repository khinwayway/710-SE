<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet/nestscout.css">
    <script src="map/onemap-leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/fetch.js" type="text/javascript"></script>
    <title>NestScout</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg nestbar">
      <img src="img\nestscout.png" style="padding:1%;" width="200" alt="">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.html">Search <span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="browseCat.php">Browse by Category</a>
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

    <div class="container-left" style="overflow-y: scroll; overflow-x: hidden; width:26%;">
      <?php
      mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $servername = "localhost";
        $username = "root";
        $password ="";
        $dbname = "nestscout";
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

      $name = $_POST['search'];
      // Check connection
      if (mysqli_connect_errno())
        {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

      $result = mysqli_query($conn, "SELECT * FROM properties
          WHERE town LIKE '%{$name}%' OR flat_type LIKE '%{$name}%' OR flat_model LIKE '%{$name}%' OR street_name LIKE '%{$name}%' OR block LIKE '%{$name}%' OR remaining_lease LIKE '%{$name}%'");

          while($row = $result->fetch_assoc()) {
              echo "<div id='".$row['list_id']."' class='propertyItem col-sm'>";
              echo "<button class='propertySelect' name='list_id' value='".$row['list_id']."' style='background: rgba(200, 200, 200, 0); border:none; cursor: pointer;'>";
              echo "<div class='image-placeholder rounded'></div>";
              echo "<div>".$row['block']." ".$row['street_name']."</div>";
              echo "<div> $".$row['price']."</div>";
              echo "</button></div>";
              echo "<br />";
          }
          mysqli_close($conn);
      ?>
    </div>
    <div class="container-right" id="result" style="width:74%;">
    </div>

    <script type="text/javascript">
      $(document).ready(function () {
        $('.propertySelect').click(function () {
          var id = jQuery(this).attr("value");
          $.ajax({
              type: "POST",
              url: 'searchedProperty.php',
              data: {newid : id},
              success: function(data){
                  console.log(data);
              }
          });
        $('#result').load('searchedProperty.php', { newid : id } );
        })
        });
    </script>


  </body>
</html>

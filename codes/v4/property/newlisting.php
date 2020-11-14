<?php
include_once '../dbconnect.php';
session_start();

?>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../src/stylesheet/nestscout.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

  <title>NestScout</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg nestbar">
      <img src="../src/images/nestscout.png" style="padding:1%;" width="200" alt="">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Search <span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../browseCat.php">Browse by Category</a>
          </li>
        </ul>

        <?php
        if(!isset($_SESSION['usr_name'])){
        ?>
          <ul class="nav navbar-nav navbar-right">
            <li class="nav-item">
              <a class="nav-link" href="../account/signup.php">Sign Up</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../account/login.php">Log In</a>
            </li>
          </ul>
      <?php } ?>
      <?php
      if (isset($_SESSION['usr_name']) and $_SESSION['usr_name']!=''){
      ?>
      <ul class="nav navbar-nav navbar-right">
        <li class="nav-item">
          <a class="nav-link active" href="../account/profile.php">
          <?php  echo($_SESSION['usr_name'])?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../account/logout.php?logout">Logout</a>
        </li>
      </ul>
    <?php } ?>
      </div>
    </nav>


    <div class="container-left" style="overflow-y: scroll; overflow-x: hidden;">
      <ul class="nav flex-column m-3" style="font-size: 20px;">
        <li class="nav-item m-3">
          <a class="nav-link " id="profile" href="../account/profile.php">Profile</a>
        </li>
        <li class="nav-item m-3">
          <a class="nav-link" href="#" id="saved">Saved</a>
        </li>
        <li class="nav-item m-3">
            <a class="nav-link active" id="listing" name=listing href="#">Listings</a>
        </li>
        <li class="nav-item m-3">
          <a class="nav-link " href="#" id="appointments">Appointments</a>
        </li>
      <!--  <li class="nav-item" style="font-size: 12px; margin-top:130px; margin-left:40px;">
          <input type=button class="nav-link " href="#" name="seller" onclick="enableButton2()">become a seller!</input>
        </li>  -->
      </ul>
  </div>

    <div class="container-right">
      <form action="" method="POST">
        <div class="row justify-content-md-left">
          <div class="form-group  col-5">
            <label for="address">Block</label>
            <input type="test" class="form-control" id="block" name="block" placeholder="e.g. 16E" required>
          </div>
          <div class="form-group  col-5">
            <label for="address">Address</label>
            <input type="test" class="form-control" id="address" name="address" placeholder="e.g. 50 Nanyang Walk Singapore 639929" required>
          </div>
          <div class="form-group col-3">
            <label for="town">Town</label>
            <select class="form-control" id="town" name="town">
              <option>Ang Mo Kio</option>
              <option>Bedok</option>
              <option>Yishun</option>
              <option>Bishan</option>
              <option>Bukit Batok</option>
              <option>Bukit Panjang</option>
              <option>Bukit Merah</option>
              <option>Central Area</option>
              <option>Geylang</option>
              <option>Bukit Timah</option>
              <option>Choa Chu Kang</option>
              <option>Clementi</option>
              <option>Punggol</option>
              <option>Hougang</option>
              <option>Jurong East</option>
              <option>Jurong West</option>
              <option>Queenstown</option>
              <option>Kallang/whampoa</option>
              <option>Marine Parade</option>
              <option>Pasir Ris</option>
              <option>Sembawang</option>
              <option>Sengkang</option>
              <option>Serangoon</option>
              <option>Tampines</option>
              <option>Toa Payoh</option>
              <option>Woodlands</option>

            </select>
          </div>
        </div>
  <div class="row justify-content-md-left">

    <div class="form-group col-3">
      <label for="model">Flat Model</label>
      <select class="form-control" id="model" name="model">
        <option>Model A</option>
        <option>Dbss</option>
        <option>Standard</option>
        <option>Improved</option>
        <option>Simplified</option>
        <option>Apartment</option>
        <option>Premium Apartment</option>
        <option>Adjoined Flat</option>
        <option>Model A-maisonette</option>
        <option>Maisonette</option>
        <option>Multi Generation</option>
        <option>Type S1</option>
        <option>Model A2</option>
        <option>Type S2</option>
        <option>Terrace</option>
      </select>
    </div>
    <div class="form-group col-2">
      <label for="type">Room Type</label>
      <select class="form-control" id="type" name="type">
        <option>2 Room</option>
        <option>3 Room</option>
        <option>4 Room</option>
        <option>5 Room</option>
        <option>Executive</option>
        <option>Multigeneration</option>
      </select>
    </div>
    <div class="form-group col-2">
      <label for="lease">Remaining Lease</label>
      <input class="form-control" type="number" id="lease" name="lease" min="1" max="99" placeholder="1 to 99 years" required>
      </input>
    </div>

  </div>
    <div class="row justify-content-md-left">
  <div class="form-group col-8">
    <label for="Amenities">About</label>
    <textarea class="form-control" id="about" name="about" rows="3" placeholder="Write a short description about your house! (not required)"></textarea>
  </div>
      </div>
      <div class="row justify-content-md-left">
      <div class="form-group col-2">
        <label for="price">Resale Price (S$)</label>
        <input class="form-control" type="text" id="price" name="price" required>
        </input>
        <button class="btn btn-lg btn-primary btn-block picit" type="button" name="picit" style="font-size:12px; background-color:#3E9DCA; margin-top:5%;">Recommend a Price</button>

      </div>
    </div>
  <button class="btn btn-lg btn-primary btn-block createListing col-2" type="submit" name="createListing" style="background-color:#3E9DCA; margin-top:0%;">Create Listing</button>

</form>

  </div>
  <script type="text/javascript">
    $('.picit').click(function() {
        var address = document.getElementById("address").value;
        var town = document.getElementById("town").value;
        var type = document.getElementById('type').value;
        var model = document.getElementById("model").value;
        var lease = document.getElementById("lease").value;
        var data = {
          resource_id: '42ff9cfe-abe5-4b54-beda-c88f9bb438ee', // the resource id
          limit: 500, // get 5 results
          q: town + " " + type + " " + model + " " + address + " " + lease + " years"// query for 'jones'
        };
        $.ajax({
          url: 'https://data.gov.sg/api/action/datastore_search',
          data: data,
          dataType: 'json',
          success: function(data) {
            console.log(data.result)
            var total=0;
            var final;
            for (i = 0; i < 20; i++){
              total = total + parseInt(data.result.records[i].resale_price);
              console.log(total);
            }
            final = total/20
            document.getElementById('price').value  =  final;
          }
        });
      });


  </script>

  <?php
    if(isset($_POST['createListing'])){
        $sql = "INSERT INTO properties (Town, Flat_type, Flat_model, Block, Address, Lease, Price, UserID)
        VALUES ('".$_POST["town"]."','".$_POST["type"]."','".$_POST["model"]."','".$_POST["block"]."','".$_POST["address"]."','".$_POST["lease"]."','".$_POST["price"]."','".$_SESSION["usr_id"]."')";
        $result = mysqli_query($con,$sql);
    }

    ?>

  </body>
</html>

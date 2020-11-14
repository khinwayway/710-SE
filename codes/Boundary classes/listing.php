<?php
session_start();

include_once '../dbconnect.php';
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
              <a class="nav-link" href="signup.php">Sign Up</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Log In</a>
            </li>
          </ul>
      <?php } ?>
      <?php
      if (isset($_SESSION['usr_name']) and $_SESSION['usr_name']!=''){
      ?>
      <ul class="nav navbar-nav navbar-right">
        <li class="nav-item">
          <a class="nav-link active" href="profile.php">
          <?php  echo($_SESSION['usr_name'])?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php?logout">Logout</a>
        </li>
      </ul>
    <?php } ?>
      </div>
    </nav>


    <div class="container-left" style="overflow-y: scroll; overflow-x: hidden;">
      <ul class="nav flex-column m-3" style="font-size: 20px;">
        <li class="nav-item m-3">
          <a class="nav-link " id="profile" href="profile.php">Profile</a>
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
	<a class="nav-link " href="../property/newlisting.php">Create new listing</a>
      <?php

        $seller_id = $_SESSION['usr_id'];
        $sql = ("SELECT * FROM `properties`
          WHERE `UserID` = '$seller_id'");
        $result = $con->query($sql);

        while($row = $result->fetch_assoc()) {
            echo "<h2>" . $row['Block'] ." ".$row['Address'] . "</h2>";
            echo "</br>";
            echo "<div class='row justify-content-md-left'><h5 class='col-5'></h5></div><div class='row justify-content-md-left'><h5 class='col-3'>Town</h5><h5 class='col-3'>Model</h5></div><div class='row justify-content-md-left'><p class='col-3'>" . $row['Town']."</p><p class='col-3'>".$row['Flat_Model'] . "</p></div><div class='row justify-content-md-left'><h5 class='col-3'>Type</h5><h5 class='col-3'>Lease</h5></div><div class='row justify-content-md-left'><p class='col-3'>". $row['Flat_Type']."</p><p class='col-3'>".$row['Lease']." years</p></div><div class='row justify-content-md-left'><h5 class='col-3'>Price</h5></p></div><div class='row justify-content-md-left'><p class='col-3'>".$row['Price']."</p></div><form action='listing.php' method='POST'><div class='row justify-content-md-left'><button class='btn btn-sm btn-primary btn-block del' name='delete' id='".$row['PropertyID']."' type='submit' style='margin-left: 10px; background-color:#DBA97A; width:10%; position=relative; display:block;' onclick='deleteid(".$row['PropertyID'].")'>Delete Listing</button></div></form><hr>";
        }
      ?>


      
    </div>
  <script type="text/javascript">

		function deleteid(id) {
			//alert(newid);
          /*$.ajax({
              type: "POST",
              url: 'deletelist.php',
              data: {id : newid},
              success: function(data){
                  console.log(newid);
              }
		})*/
		$.ajax({
		  type: "POST",
		  url: 'deletelist.php',
		  data: {id: id},
		});
		alert("property deleted");}

    </script>


  </body>
</html>

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
            <a class="nav-link active" id="profile" href="#">Profile</a>
          </li>
          <li class="nav-item m-3">
            <a class="nav-link" href="#" id="saved">Saved</a>
          </li>
          <li class="nav-item m-3">
              <a class="nav-link" id="listing" name=listing href="listing.php">Listings</a>
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
          <div class="form-group  col-3">
            <label for="address">Display Name</label>
            <input type="text" class="form-control" id="displayname" name="displayname">
          </div>
          <div class="form-group  col-3">
            <label for="address">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
          </div>
          <div class="form-group  col-3">
            <label for="address">Email</label>
            <input type="text" class="form-control" id="email" name="email" required>
          </div>
        </div>
  <div class="row justify-content-md-left">

    <div class="form-group  col-3">
      <label for="address">Birthdate</label>
      <input type="text" class="form-control" id="birthdate" name="birthdate">
    </div>
    <div class="form-group  col-1">
      <label for="address">Gender</label>
      <input type="text" class="form-control" id="gender" name="gender">
    </div>
    <div class="form-group  col-5">
      <label for="address">Address</label>
      <input type="test" class="form-control" id="address" name="address" placeholder="e.g. 50 Nanyang Walk Singapore 639929">
    </div>

  </div>
  <button class="btn btn-lg btn-primary btn-block update col-2" type="submit" name="update" style="background-color:#3E9DCA; margin-top:0%;">Update</button>

</form>

  </div>

    <?php
      if(isset($_POST['update']))
      {

        //$query="select * from users where Username='".$_POST['inputUser']."' and Password='".md5($_POST['inputPassword'])."'";
		echo"<script>console.log(1)</script>";
      	$sql = "UPDATE users SET PhoneNumber='".$_POST["phone"]."', Email='".$_POST["email"]."', Birthdate='".$_POST["birthdate"]."', Gender='".$_POST["gender"]."', CurrentAddress='".$_POST["address"]."', Type=2 WHERE UserID =".$_SESSION['usr_id'];
      	mysqli_query($con, $sql);
      }
    ?>


  </body>
</html>

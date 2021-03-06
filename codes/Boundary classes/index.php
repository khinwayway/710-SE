<?php
include_once 'dbconnect.php';
session_start();

?>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="src/stylesheet/nestscout.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

  <title>NestScout</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg nestbar">
      <img src="src/images/nestscout.png" style="padding:1%;" width="200" alt="">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link active" href="index.php">Search <span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="browseCat.php">Browse by Category</a>
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

    <h1 class="texthead Display-3 text-center " style="margin-top:2%;">Buy, rent or sell your property!</h1>

    <div class="mastercontainer rounded">
        <h2> Search for a place! </h2>
        <h4> Where do you intend to live?</h4>
        <form class="form-row" action="property/searchResults.php" method="POST">
          <div class="col-md">
            <input type="text" class="form-control" id="locationInput" name="search" placeholder="Location"/>
          </div>
          <button type="submit" class="btn btn-md" name="submit">Search</button>
        </form>
    </div>

  <script>
    /*    $(document).ready(function() {
          $('#navbarText').load('nav.php');
      }); */
    </script>


  </body>
</html>

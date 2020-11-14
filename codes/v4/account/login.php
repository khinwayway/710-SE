<?php
session_start();

include_once '../dbconnect.php';

//check if form is submitted
if (isset($_POST['Login'])) {


    if (isset($_POST['Login']) && !empty($_POST['username'])
         && !empty($_POST['password'])) {
         $username = mysqli_real_escape_string($con, $_POST['username']);
         $password = mysqli_real_escape_string($con, $_POST['password']);
         $result = mysqli_query($con, "SELECT * FROM users WHERE Username = '" . $username. "' and Password = '" . md5($password) . "'");
         echo (mysqli_fetch_array($result));
          if ($row = mysqli_fetch_array($result)) {
              $_SESSION['usr_id'] = $row['UserID'];
              $_SESSION['usr_name'] = $row['Username'];
              $_SESSION['usr_type'] = $row['Type'];
              $_SESSION['mobile'] = $row['PhoneNumber'];

              header("Location: ../index.php");
          } else {
              $errormsg = "Incorrect Username or Password!!!";
          }
        }
}
?>

<?php
     if(@$_GET['Empty']==true)
     {
 ?>
     <div class="alert-light text-danger text-center py-3"><?php echo $_GET['Empty'] ?></div>
 <?php
     }
 ?>


 <?php
     if(@$_GET['Invalid']==true)
     {
 ?>
     <div class="alert-light text-danger text-center py-3"><?php echo $_GET['Invalid'] ?></div>
 <?php
     }
 ?>

<!DOCTYPE html>
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
          <a class="nav-link" href="profile.php">
          <?php  echo($_SESSION['usr_name'])?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php?logout">Logout</a>
        </li>
      </ul>
    <?php } ?>
      </div>
    </nav>
    <div class="container">
      <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
          <div class="card card-signin my-5">
            <div class="card-body">
              <h5 class="card-title text-center">Log In</h5>
              <form class="form-signin" action="process.php" method="post">
                <div class="form-label-group">
                  <input type="text" name="inputUser" class="form-control" placeholder="Username or Email address" required autofocus>
                </div>
                <br>
                <div class="form-label-group">
                  <input type="password" name="inputPassword" class="form-control" placeholder="Password" required>
                </div>
                <a href="#" style="font-size:10px;">Forget Password?</a>

                <div class="custom-control custom-checkbox mb-3" style="margin-top:3%; font-size:14px;">
                  <input type="checkbox" class="custom-control-input" id="customCheck1">
                  <label class="custom-control-label" for="customCheck1">Remember password</label>
                </div>
                <input class="btn btn-lg btn-primary btn-block log" type="submit" name="Login" style="background-color:#ACD9E3;" value="Log In"></input>
                <hr class="my-4">
                <p style="font-weight:bold;">Don't have an account?<a href="signup.html" style="font-weight:600; color:#DBA97A;"> Sign up here.</a></p>
              </form>
              <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
    /*  $('.log').click(function() {
        alert(document.getElementById("inputUser").value);
          var username = document.getElementById("inputUser").value;
          var password = document.getElementById("inputPassword").value;
          alert(password);
          $.ajax({
              type: "POST",
              url: 'login.php',
              data: {username : inputUser,
              password : inputPassword,},
              success: function(data){
                  console.log(data);
                  alert(data);
              }
          });
          window.location="index.html";
        });           */

    </script>
  </body>
</html>

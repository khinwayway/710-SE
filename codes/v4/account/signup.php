<?php
include_once '../dbconnect.php';
session_start();

if(isset($_SESSION['usr_id'])) {
    header("Location: ../index.php");
}


//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    //name can contain only alpha characters and space
    if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        $error = true;
        $name_error = "Name must contain only alphabets and space";
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "Please Enter Valid Email ID";
    }
    if(strlen($password) < 6) {
        $error = true;
        $password_error = "Password must be minimum of 6 characters";
    }
    if (!$error) {
        if(mysqli_query($con, "INSERT INTO users(Username,Email,Password) VALUES('" . $name . "', '" . $email . "', '" . md5($password) . "')")) {
            $successmsg = "Successfully Registered! <a href='login.php'>Click here to Login</a>";
        } else {
            $errormsg = "Error in registering...Please try again later!";
        }
    }
}
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
              <a class="nav-link active" href="signup.php">Sign Up</a>
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
              <h5 class="card-title text-center">Sign Up</h5>
              <br><br>
               <form method="POST" action="">
                <div class="form-label-group">
                  <input type="text" id="username" class="form-control" placeholder="Username" required autofocus value="<?php if($error) echo $name; ?>" class="form-control" />
                  <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
                </div>
                <br>
                <div class="form-label-group">
                  <input type="email" id="email" class="form-control" placeholder="Email address" required autofocusvalue="<?php if($error) echo $email; ?>" class="form-control" />
                  <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
                </div>
                <br>
                <div class="form-label-group">
                  <input type="password" id="password" class="form-control" name="" placeholder="Password" required>
                  <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
              </div>
                <br>
                <div class="form-label-group form-inline" style="display:inline-block;">
                  <input type="text" id="mobile" class="form-control" placeholder="Mobile Number" style="width:330px;" required>
                  <button type="submit" class="btn btn-md orangeBtn">Verify</button>
                  <span class="text-danger"><?php if (isset($mobile_error)) echo $mobile_error; ?></span>
              </div>

                <button class="btn btn-lg btn-primary btn-block reg" type="button" name="reg_user" style="background-color:#ACD9E3; margin-top:5%;">Sign Up</button>
                <hr class="my-4">
                <p style="font-weight:bold;">Already have an account?<a href="login.html" style="font-weight:600; color:#DBA97A;"> Log in here.</a></p>
              </form>
              <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
              <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $('.reg').click(function() {
        alert(document.getElementById("username").value+" successfully registered");
          var username = document.getElementById("username").value;
          var email = document.getElementById('email').value;
          var password = document.getElementById("password").value;
          var mobile = document.getElementById("mobile").value;

          $.ajax({
              type: "POST",
              url: 'server.php',
              data: {username : username,
              email : email,
              password : password,
              mobile : mobile},
              success: function(data){
                  console.log(data);
              }
          });
        });

    </script>
  </body>

</html>

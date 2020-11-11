<nav class="navbar navbar-inverse" style="border-radius: 0px;">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Your WebSite Name</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">About</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
    <?php  if(!$_SESSION['usr_name']) {?>s
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <?php } else { ?>
         <li><a href="#">Welcome, <?php echo $_SESSION['admin'];?></a></li>
         <?php } ?>
    </ul>
  </div>
</nav>

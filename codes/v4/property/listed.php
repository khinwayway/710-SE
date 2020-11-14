<?php
include_once '../dbconnect.php';
session_start();
?>
<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  $servername = "localhost";
  $username = "root";
  $password ="";
  $dbname = "nestscout";
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  $seller_id = $_SESSION['usr_id'];
  $sql = ("SELECT * FROM `properties`
    WHERE `UserID` = '$seller_id'");
  $result = $conn->query($sql);

  while($row = $result->fetch_assoc()) {
      echo "<h2>" . $row['Block'] ." ".$row['Address'] . "</h2>";
      echo "</br>";
      echo "<div class='row justify-content-md-left'><h5 class='col-5'>ListID</h5></div><div class='row justify-content-md-left'><h5 class='col-3'>Town</h5><h5 class='col-3'>Model</h5></div><div class='row justify-content-md-left'><p class='col-3'>" . $row['Town']."</p><p class='col-3'>".$row['Flat_model'] . "</p></div><div class='row justify-content-md-left'><h5 class='col-3'>Type</h5><h5 class='col-3'>Lease</h5></div><div class='row justify-content-md-left'><p class='col-3'>". $row['Flat_Type']."</p><p class='col-3'>".$row['Lease']." years</p></div><div class='row justify-content-md-left'><h5 class='col-3'>Price</h5></p></div><div class='row justify-content-md-left'><p class='col-3'>".$row['Price']."</p></div>";
  }

  $conn->close();
?>

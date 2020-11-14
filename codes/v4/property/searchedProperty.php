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

  $list_id = $_POST['newid'];
  $sql = ("SELECT Town, Block, Address, Flat_Model, Flat_Type, Lease, Price, Username, PhoneNumber, Email FROM `properties` p, `users` u
    WHERE `PropertyID` = '$list_id' AND p.UserID = u.UserID");
  $result = $conn->query($sql);

  while($row = $result->fetch_assoc()) {
      echo "<h2>" . $row['Block'] ." ".$row['Address'] . "</h2>";
      echo "</br>";
      echo "<div class='row justify-content-md-left'><h4 class='col-5'>Features</h4></div><div class='row justify-content-md-left'><h5 class='col-3'>Town</h5><h5 class='col-3'>Model</h5></div><div class='row justify-content-md-left'><p class='col-3'>" . $row['Town']."</p><p class='col-3'>".$row['Flat_Model'] . "</p></div><div class='row justify-content-md-left'><h5 class='col-3'>Type</h5><h5 class='col-3'>Lease</h5></div><div class='row justify-content-md-left'><p class='col-3'>". $row['Flat_Type']."</p><p class='col-3'>".$row['Lease']." years</p></div><div class='row justify-content-md-left'><h5 class='col-3'>Price (S$)</h5></p></div><div class='row justify-content-md-left'><p class='col-3'>".$row['Price']."</p></div><div class='row justify-content-md-left'><h4 class='col-3'>Contact Seller</h4></p></div><div class='row justify-content-md-left'><p class='col-3'>Contact Person: ".$row['Username']."</p></div><div class='row justify-content-md-left'><p class='col-3'>HP: ".$row['PhoneNumber']."</p></div><div class='row justify-content-md-left'><p class='col-3'>Email: ".$row['Email']."</p></div>";
  }

  $conn->close();
?>

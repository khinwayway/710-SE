<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  $errors = array();
  $servername = "localhost";
  $username = "root";
  $password ="";
  $dbname = "nestscout";
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $id = $_POST["id"];

  $sql = "DELETE FROM properties WHERE PropertyID = '".$id."'";

  if ($conn->query($sql) === TRUE) {
    echo "Deleted successfully";
  } else {
    echo "Error deleting record: " . $conn->error;
  }

  $conn->close();
?>
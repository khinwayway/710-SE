
          <?php
          mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $servername = "localhost";
            $username = "root";
            $password ="";
            $dbname = "nestscout";
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            $list_id = $_POST['list_id'];
            $sql = ("SELECT * FROM `properties`
              WHERE `list_id`= $list_id");
            $result = $conn->query($sql);

            while($row = $result->fetch_assoc()) {
                echo "<h2 class='chosenProperty' id= '".$row['street_name']."'>" . $row['block'] ." ".$row['street_name'] . "</h2>";
                echo "</br>";
                echo "<h4>Features</h4><h5>Town</h5>" ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;". "<h5>Model</h5><br>" . $row['town']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row['flat_model'] . "<br><br><h5>Type</h5> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <h5>Lease</h5><br>". $row['flat_type']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row['remaining_lease']."<br><br><h5>Price</h5><br>".$row['price'];
            }

            $conn->close();
          ?>

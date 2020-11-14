
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
              WHERE `PropertyID`= $list_id");
            $result = $conn->query($sql);

            while($row = $result->fetch_assoc()) {
                echo "<h2 class='chosenProperty' id= '".$row['Address']."'>" . $row['Block'] ." ".$row['Address'] . "</h2>";
                echo "</br>";
                echo "<h4>Features</h4><h5>Town</h5>" ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;". "<h5>Model</h5><br>" . $row['Town']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row['Flat_Model'] . "<br><br><h5>Type</h5> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <h5>Lease</h5><br>". $row['Flat_Type']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row['Lease']."<br><br><h5>Price</h5><br>".$row['Price'];
            }

            $conn->close();
          ?>

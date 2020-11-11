
          <?php
          mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $servername = "localhost";
            $username = "root";
            $password ="";
            $dbname = "nestscout";
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            if(isset($_POST['townlist'])){
                $townarray = $_POST['townlist'];
                $townsql = implode("','", $townarray);
            }

            if(isset($_POST['typelist'])){
                $typearray = $_POST['typelist'];
                $typesql = implode("','", $typearray);
            }

            if (isset($_POST['modellist'])){
                $modelarray = $_POST['modellist'];
                $modelsql = implode("','", $modelarray);
            }

            if (isset($_POST['modellist'], $_POST['townlist'], $_POST['typelist'])){
              $sql = ("SELECT * FROM `properties`
                WHERE `town` IN ('$townsql')
                AND `flat_type` IN ('$typesql')
                AND `flat_model` IN ('$modelsql')");
              $result = $conn->query($sql);
            }

            else if ((isset($_POST['townlist'], $_POST['typelist'])) && !isset($_POST['modellist'])){
              $sql = ("SELECT * FROM `properties`
                WHERE `town` IN ('$townsql')
                AND `flat_type` IN ('$typesql')");
              $result = $conn->query($sql);
            }

            else if ((isset($_POST['modellist'], $_POST['typelist'])) && !isset($_POST['townlist'])){
              $sql = ("SELECT * FROM `properties`
                WHERE `flat_type` IN ('$typesql')
                AND `flat_model` IN ('$modelsql')");
              $result = $conn->query($sql);
            }

            else if (isset($_POST['townlist']) && !isset($_POST['typelist'],$_POST['modellist'])){
              $sql = ("SELECT * FROM `properties`
                WHERE `town` IN ('$townsql')");
              $result = $conn->query($sql);
            }

            else if (isset($_POST['typelist']) && !isset($_POST['townlist'],$_POST['modellist'])){
              $sql = ("SELECT * FROM `properties`
                WHERE `flat_type` IN ('$typesql')");
              $result = $conn->query($sql);
            }

            else if (isset($_POST['modellist']) && !isset($_POST['townlist'],$_POST['typelist'])){
              $sql = ("SELECT * FROM `properties`
                WHERE `flat_model` IN ('$modelsql')");
              $result = $conn->query($sql);
            }

            else{
              $sql = ("SELECT * FROM `properties`");
              $result = $conn->query($sql);
            }

            while($row = $result->fetch_assoc()) {
                echo "<form>";
                echo "<div id='".$row['list_id']."' class='propertyItem col-sm'>";
                echo "<button class='propertySelect' name='list_id' type='button' value='".$row['list_id']."' style='background: rgba(200, 200, 200, 0); border:none; cursor: pointer;'>";
                echo "<div class='image-placeholder rounded'></div>";
                echo "<div>".$row['block']." ".$row['street_name']."</div>";
                echo "<div> $".$row['price']."</div>";
                echo "</button></div>";
                echo "</form>";
                echo "<br />";
                echo "<script type='text/javascript'>
                      $(document).ready(function () {
                        $('.propertySelect').click(function () {
                          var id = jQuery(this).attr('value');
                          $.ajax({
                              type: 'POST',
                              url: 'searchedProperty.php',
                              data: {newid : id},
                              success: function(data){
                                  console.log(data);
                              }
                          });
                          $('#results').empty();
                        $('#property').load('searchedProperty.php', { newid : id } );
                        })
                      });
                    </script>";
            }

            $conn->close();
          ?>

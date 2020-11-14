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
                WHERE `Town` IN ('$townsql')
                AND `Flat_Type` IN ('$typesql')
                AND `Flat_Model` IN ('$modelsql')");
              $result = $conn->query($sql);
            }

            else if ((isset($_POST['townlist'], $_POST['typelist'])) && !isset($_POST['modellist'])){
              $sql = ("SELECT * FROM `properties`
                WHERE `Town` IN ('$townsql')
                AND `Flat_Type` IN ('$typesql')");
              $result = $conn->query($sql);
            }

            else if ((isset($_POST['modellist'], $_POST['typelist'])) && !isset($_POST['townlist'])){
              $sql = ("SELECT * FROM `properties`
                WHERE `Flat_Type` IN ('$typesql')
                AND `Flat_Model` IN ('$modelsql')");
              $result = $conn->query($sql);
            }

            else if (isset($_POST['townlist']) && !isset($_POST['typelist'],$_POST['modellist'])){
              $sql = ("SELECT * FROM `properties`
                WHERE `Town` IN ('$townsql')");
              $result = $conn->query($sql);
            }

            else if (isset($_POST['typelist']) && !isset($_POST['townlist'],$_POST['modellist'])){
              $sql = ("SELECT * FROM `properties`
                WHERE `Flat_type` IN ('$typesql')");
              $result = $conn->query($sql);
            }

            else if (isset($_POST['modellist']) && !isset($_POST['townlist'],$_POST['typelist'])){
              $sql = ("SELECT * FROM `properties`
                WHERE `Flat_Model` IN ('$modelsql')");
              $result = $conn->query($sql);
            }

            else{
              $sql = ("SELECT * FROM `properties`");
              $result = $conn->query($sql);
            }

            while($row = $result->fetch_assoc()) {
              $street = $row['Address'];
                echo "<form>";
                echo "<div id='".$row['PropertyID']."' class='propertyItem col-sm'>";
                echo "<script> function Cloud1(){Cloud('$street');}</script>";
                echo "<button class='propertySelect' name='PropertyID' type='button' value='".$row['PropertyID']."' style='background: rgba(200, 200, 200, 0); border:none; cursor: pointer;' onclick='Cloud1()'>";
                echo "<div class='image-placeholder rounded'></div>";
                echo "<div>".$row['Block']." ".$row['Address']."</div>";
                echo "<div> $".$row['Price']."</div>";
                echo "</button></div>";
                echo "</form>";
                echo "<br />";
                echo "<script type='text/javascript'>
                      $(document).ready(function () {
                        $('.propertySelect').click(function () {
                          $('#buttonspage').show();
                          var id = jQuery(this).attr('value');
                          $.ajax({
                              type: 'POST',
                              url: 'property/searchedProperty.php',
                              data: {newid : id},
                              success: function(data){
                                  console.log(data);
								  console.log(1);
                              }
                          });
                          $('#results').empty();
                        $('#property').load('property/searchedProperty.php', { newid : id } );
                        })
                      });
                    </script>";
            }

            $conn->close();
          ?>

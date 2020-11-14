<?php
require_once('../dbconnect.php');
session_start();
    if(isset($_POST['Login']))
    {
       if(empty($_POST['inputUser']) || empty($_POST['inputPassword']))
       {
            alert(md5($_POST['inputPassword']));
            header("location:../index.php?Empty= Please Fill in the Blanks");
       }
       else
       {
            //$query="select * from users where Username='".$_POST['inputUser']."' and Password='".md5($_POST['inputPassword'])."'";
			$query="select * from users where Username='".$_POST['inputUser']."'";
            $result=mysqli_query($con,$query);

            if($row = mysqli_fetch_array($result))
            {
              $_SESSION['usr_id'] = $row['UserID'];
              $_SESSION['usr_name'] = $row['Username'];
              $_SESSION['usr_type'] = $row['Type'];
              $_SESSION['mobile'] = $row['PhoneNumber'];
              header("location:../index.php");
            }
            else
            {
                $message = "Please Enter Correct User Name and Password ";
				echo "<script type='text/javascript'>alert('$message');</script>";
				header("refresh:0; location:login.php");
            }
       }
    }
    else
    {
        echo 'Not Working Now Guys';
    }

?>

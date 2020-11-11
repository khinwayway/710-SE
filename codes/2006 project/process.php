<?php
require_once('dbconnect.php');
session_start();
    if(isset($_POST['Login']))
    {
       if(empty($_POST['inputUser']) || empty($_POST['inputPassword']))
       {
            alert(md5($_POST['inputPassword']));
            header("location:index.php?Empty= Please Fill in the Blanks");
       }
       else
       {
            $query="select * from users where username='".$_POST['inputUser']."' and password='".md5($_POST['inputPassword'])."'";
            $result=mysqli_query($con,$query);

            if(mysqli_fetch_assoc($result))
            {
                $_SESSION['usr_name']=$_POST['inputUser'];
                header("location:index.php");
            }
            else
            {
                header("location:index.php?Invalid= Please Enter Correct User Name and Password ");
            }
       }
    }
    else
    {
        echo 'Not Working Now Guys';
    }

?>

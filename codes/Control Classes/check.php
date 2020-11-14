<?php
include('server.php');
session_start();
$loginst = 0;
if ($_SESSION['username']){

$user_check = $_SESSION['username'];

$ses_sql = mysqli_query($db,"SELECT Username FROM users WHERE Username='$user_check' ");

$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

$login_user=$row['Username'];

if(!empty($login_user))
{
   $loginst = 1;
}
}

?>

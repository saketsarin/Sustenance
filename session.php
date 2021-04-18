<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysqli_connect("localhost", "u630298647_bruh", "Stonks@404");
// Selecting Database
$db = mysqli_select_db($connection, "u630298647_tangled");
$conn = mysqli_connect("localhost", "u630298647_bruh", "Stonks@404", "u630298647_tangled");
session_start();
$user_check=$_SESSION['login_user'];
echo $user_check;
$ses_sql=mysqli_query($conn,"select * from sustenance where username='$user_check'");
echo mysqli_num_rows($ses_sql);
if (mysqli_num_rows($ses_sql) > 0) {
  while($row = mysqli_fetch_assoc($ses_sql)) {
    $_SESSION['name'] = $row['Name'];
  	$_SESSION['dob'] = $row['dob'];
  	$_SESSION['email'] = $row['Email'];
  	$_SESSION['pic'] = $row['pic'];
  }
}
$login_session = $row['username'];
if(!isset($login_session))
{
mysqli_close($connection);
}
?>
<?php
session_start();
$error='';
$servername = "localhost";
$username = "u630298647_bruh";
$password = "Stonks@404";
$dbname = "u630298647_tangled";
$x=$_POST['user2'];
$y=$_POST['pass2'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM sustenance WHERE Username='$x' AND Password='$y'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $_SESSION['login_user']=$x;
    // output data of each row
    
    header("location: profile.php");
    while($row = $result->fetch_assoc()) {
        echo "Hey there";
    }
} else {
    echo "Incorrect Email/Password";
}
$conn->close();
?>

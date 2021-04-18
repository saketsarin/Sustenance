<?php
$link = mysqli_connect("localhost", "u630298647_bruh", "Stonks@404", "u630298647_tangled");
if($link === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$name = mysqli_real_escape_string($link, $_REQUEST['name']);
$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$pass = mysqli_real_escape_string($link, $_REQUEST['pass']);
$user = mysqli_real_escape_string($link, $_REQUEST['user']);
$age = mysqli_real_escape_string($link, $_REQUEST['dob']);
$ssn = mysqli_real_escape_string($link, $_REQUEST['ssn']);
$pic = mysqli_real_escape_string($link, $_REQUEST['the_file']);

$sql = "INSERT INTO sustenance (Name, Email, Username, Password, dob, ssn, pic) VALUES ('$name', '$email', '$user', '$pass', '$age', '$ssn', '$pic');";
if(isset($_POST['submit'])) {
if(mysqli_query($link, $sql))
{
	$currentDirectory = getcwd();
    $uploadDirectory = "/images/";

    $errors = [];

    $fileExtensionsAllowed = ['jpeg','jpg','png']; 

    $fileName = $_FILES['the_file']['name'];
    $fileSize = $_FILES['the_file']['size'];
    $fileTmpName  = $_FILES['the_file']['tmp_name'];
    $fileType = $_FILES['the_file']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));

    $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 

    if (isset($_POST['submit'])) {

      if (! in_array($fileExtension,$fileExtensionsAllowed)) {
        $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
      }

      if ($fileSize > 4000000) {
        $errors[] = "File exceeds maximum size (4MB)";
      }

      if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload) {
          echo "The file " . basename($fileName) . " has been uploaded";
        $sql2 = "UPDATE sustenance set pic = '$fileName' where Username = '$user';";
        if(mysqli_query($link, $sql2)) {
        	echo "done2";
        }
        else {
        	echo "noo";
        }
        } else {
          echo "An error occurred. Please contact the administrator.";
        }
      } else {
        foreach ($errors as $error) {
          echo $error . "These are the errors" . "\n";
        }
      }

    }
    echo "done";
} 
else
{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
}
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sustenance</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <div class="container">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="showLogin()">Log In</button>
                <button type="button" class="toggle-btn" onclick="showRegister()">Register</button>
            </div>

            <div class="icon">
                <a href="#"><img src="./images/Sustenance.png" alt="logo" width="150px" height="150px"></a>
            </div>
            <form id="login" class="input-group" method = "post" action = "login.php">
                <input type="text" name = "user2" class="input-field" placeholder="Username" autocomplete="username" required />
                <input type="password" name = "pass2" class="input-field" placeholder="Enter Password" autocomplete="current-password" required />
                <input type="checkbox" class="check-box" /><span>Remember Password</span>
                <button type="submit" class="submit-btn">Log In</button>
            </form>

            <form id="register" method = "post" action = "index.php" class="input-group" enctype="multipart/form-data">
                <input type="text" class="input-field" placeholder="Name" name = "name" autocomplete="name" required />
                <input type="email" class="input-field" placeholder="Enter Email" name = "email" required />
            	<input type="text" class="input-field" placeholder="Username" name = "user" autocomplete="username" required />
                <input id="pass" name = "pass" type="password" class="input-field" placeholder="Enter Password" autocomplete="new-password" required />
            	<input type="checkbox" class="check-box" onclick="showPass()"/>Show Password
            	<input type="date" class="input-field" name = "dob" autocomplete="dob" required />
            	<input type="text" class="input-field" placeholder="Social Security Number" name = "ssn" autocomplete="ssn" required />
            	<input type = "file" placeholder = "pic" name="the_file" id="fileToUpload">
                <button type="submit" class="submit-btn" name = "submit">Register</button>
            </form>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>

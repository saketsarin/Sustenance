<?php
include('session.php');

$link = mysqli_connect("localhost", "u630298647_bruh", "Stonks@404", "u630298647_tangled");

$username = $_SESSION['login_user'];
$name = $_SESSION['name'];
$dob = $_SESSION['dob'];
$email = $_SESSION['email'];
$pic = $_SESSION['pic'];
if(isset($_POST['user_ch'])) {
	$new_user = mysqli_real_escape_string($link, $_REQUEST['new_user']);
	$q = "UPDATE sustenance SET Username = '$new_user' where Username = '$username';";
    if(mysqli_query($link, $q))
    {
        $_SESSION['login_user'] = $new_user;
    }
}
if(isset($_POST['user_ch'])) {
	$new_user = mysqli_real_escape_string($link, $_REQUEST['new_user']);
	$q = "UPDATE sustenance SET Username = '$new_user' where Username = '$username';";
    if(mysqli_query($link, $q))
    {
        $_SESSION['login_user'] = $new_user;
    }
}

if(isset($_POST['pass_ch'])) {
	$new_pass = mysqli_real_escape_string($link, $_REQUEST['new_pass']);
	$q = "UPDATE sustenance SET Password = '$new_pass' where Username = '$username';";
    if(mysqli_query($link, $q))
    {
        echo "Password Changed Successfully!";
    }
}
if(isset($_POST['delete'])) {
	$q = "DELETE FROM sustenance where Username = '$username';";
    if(mysqli_query($link, $q))
    {
        echo "Your account has been deleted. We're sorry to see you go! :(";
    	header("location: index.php");
    }
}
if(isset($_POST['submit2'])) {
	$currentDirectory = getcwd();
    $uploadDirectory = "/feats/";

    $errors = []; // Store errors here

    $fileExtensionsAllowed = ['mp4','mp3','vid']; // These will be the only file extensions allowed 

    $fileName = $_FILES['the_file']['name'];
    $fileSize = $_FILES['the_file']['size'];
    $fileTmpName  = $_FILES['the_file']['tmp_name'];
    $fileType = $_FILES['the_file']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));

    $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 

    if (isset($_POST['submit2'])) {

      if (! in_array($fileExtension,$fileExtensionsAllowed)) {
        $errors[] = "This file extension is not allowed. Please upload a valid file.";
      }

      if ($fileSize > 400000000) {
        $errors[] = "File exceeds maximum size (400MB)";
      }

      if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload) {
        	$q = "Insert into feats (username, path, claps) values ('$username', '$fileName', 0);";
        if(mysqli_query($link, $q)) { echo "done"; }
          echo "The file " . basename($fileName) . " has been uploaded";
        } else {
          echo "An error occurred. Please contact the administrator.";
        }
      } else {
        foreach ($errors as $error) {
          echo $error . "These are the errors" . "\n";
        }
      }

    }
}

echo '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sustenance - Feed</title>
    <link rel="stylesheet" href="css/feed.css">
    <link rel="stylesheet" href="css/hamburgers.css" >
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>

    <!-- referenced this for sidenav: https://www.w3schools.com/howto/howto_js_sidenav.asp -->
    <div id="mySidenav" class="sidenav">
        <span id="menu-title">Settings</span>

        <div class="settings">
            <!-- TODO -->
            <!-- display profile pic -->
            <img src="images/'.$pic.'" class="profile-pic" />
            <form style="margin: 8px;" id="changePic" method="post">
                <input type = "file" name = "pic" placeholder = "pic">
            </form>
            <!-- display name -->
            <span id="name">Name: '.$name.'</span>
            <!-- display dob -->
            <span id="dob">Birthdate: '.$dob.'</span>
            <!-- display email -->
            <span id="currentEmail">Email: '.$email.'</span>
            <!-- display username -->
            <span id="currentUsername">Username: ' .$username.'</span>
            <form id="changeUsername" method="post">
                <input id="username" class="input-field" type="text" name="new_user" placeholder="New Username">
                <br/>
                <input type="submit" value="Update Username" class="change" name = "user_ch">
            </form>
            <form id="changePassword" method="post">
                <input id="password" class="input-field" type="password" name="new_pass" placeholder="New Password">
                <br/>
                <input type="submit" value="Update Password" class="change" name = "pass_ch">
            </form>
            <div class="buttons">
                <form method = "post"><button style="background-color:red;" onclick="deleteAccount()" class="change" name = "delete">Delete Account</button></form>
                <a href="logout.php" class="change">Log Out</a>
            </div>
        </div>

    </div>

    <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
    <div id="main">
        <!-- open the sidenav -->
        <button class="hamburger hamburger--spring" type="button" onclick="toggle()">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
        <img src="images/sustenance.png">
        <h1>Sustenance Feed</h1>
        <form method="post" enctype="multipart/form-data" class="fileUpload">
        Upload a Feat:
        <input type="file" name="the_file" id="fileToUpload">
        <input type="submit" name="submit2" value="Upload my feat!">
    	</form>
        <div id="feed">';
$feats = "SELECT * FROM feats;";
$result = mysqli_query($link, $feats);

if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
  $id = $row['id'];
    echo "By: " . $row["username"]. " <br>Time: " . $row["time"]. "<br>Efforts:" . $row["claps"]. "<br>";
  	echo ' <video width="320" height="240" controls>
  <source src="feats/'.$row['path'].'">
</video> <form method = "post"><button name = '.$id.'>Effort +</button></form><br>';
  if(isset($_POST["$id"])) {
  		$sql_2 = "UPDATE feats set claps = claps + 1 where id = $id";
  		if(mysqli_query($link, $sql_2)) {
        	echo "Effort Added";
        }
  }
  }
} else {
  echo "0 results";
}
            echo '
        </div>
    </div>

    <script src="js/feed.js"></script>
</body>

</html>';
?>

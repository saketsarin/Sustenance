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
            <img src="images/Sustenance.png" class="profile-pic" />
            <form style="margin: 8px;" id="changePic" method="post">
                <input type = "file" name = "pic" placeholder = "pic">
            </form>
            <!-- display name -->
            <span id="name">Name: John Doe</span>
            <!-- display dob -->
            <span id="dob">Birthdate: 06/09/1969</span>
            <!-- display email -->
            <span id="currentEmail">Email: johndoe@email.com</span>
            <!-- display username -->
            <span id="currentUsername">Username: johndoe</span>
            <form id="changeUsername" method="post">
                <input id='username' class="input-field" type='text' name='username' placeholder="New Username">
                <br/>
                <input type='submit' value='Update Username' class="change">
            </form>
            <form id="changePassword" method="post">
                <input id='password' class="input-field" type='password' name='password' placeholder="New Password">
                <br/>
                <input type='submit' value='Update Password' class="change">
            </form>
            <div class="buttons">
                <button style="background-color:red;" onclick="deleteAccount()" class="change">Delete Account</button>
                <button onclick="logOut()" class="change">Log Out</button>
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
        <h1>Sustenance Feed</h1>
        <div id="feed">
            INSERT REELS BELOW
        </div>
    </div>

    <script src="js/feed.js"></script>
</body>

</html>
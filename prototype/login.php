<?php
$servername = "localhost";
$username = "201609_481_g06";
$password = "HKECNHGTYHQKJZFGHWCLD";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$pwHash = password_hash("password", PASSWORD_BCRYPT);
$pwHash2 = password_hash("password", PASSWORD_BCRYPT);
echo "Connected successfully\n";
echo $pwHash."\n";
echo $pwHash2."\n";

if(password_verify("password", $pwHash))
{
  echo "TRUE";
} else {
  echo "FALSE";
}
?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="./CSS/global.css">
</head>
  <body>
    <div id="container">
      <div id="header"><span id="title">Honors Advising Portal</span>
      </div>
    </div>
    <div id="login">
      <div style="text-align: center;">
        <span><b>Login</b></span>
      </div>
      <p>NetID</p>
      <input type="text"/>
      <p>Password</p>
      <input type="text"/><br/>
      <div style="text-align: center; padding-top: 5px;">
        <button onclick="window.location.href='home.html'">Login</button>
      </div>
    </div>
  </body>
</html>

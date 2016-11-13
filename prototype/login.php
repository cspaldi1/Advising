<?php
$servername = "localhost";
$username = "201609_481_g06";
$password = "HKECNHGTYHQKJZFGHWCLD";

// Create connection
$conn = mysqli_connect($servername, $username, $password, "201609_481_g06");

// Check connection
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully\n";

$query = "SELECT hashedPassword
          FROM ADVISOR
          WHERE advisorNetID = 'admin'";

$result = mysqli_query($conn, $query);
$row=mysqli_fetch_assoc($result);
var_dump($row);
if(false)
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

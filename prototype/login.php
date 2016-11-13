<?php

if($_POST['netID'] && $_POST['password'])
{
  $servername = "localhost";
  $username = "201609_481_g06";
  $password = "HKECNHGTYHQKJZFGHWCLD";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, "201609_481_g06");

  // Check connection
  if (mysqli_connect_errno()) {
      die("Connection failed: " . mysqli_connect_error());
  }

  $query = "SELECT hashedPassword
            FROM ADVISOR
            WHERE advisorNetID = 'admin'";

  $result = mysqli_query($conn, $query);
  $row=mysqli_fetch_assoc($result);

  if(password_verify($_POST['password'], $row['hashedPassword']))
  {
    header("Location: home.html");
    die();
  } else {
    echo "FALSE";
  }
} else if($_POST['netID'] || $_POST['password']){

} else {
  
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
    <form action="login.php" method="post">
      <div id="login">
        <div style="text-align: center;">
          <span><b>Login</b></span>
        </div>
        <p>NetID</p>
        <input type="text" name="netID"/>
        <p>Password</p>
        <input type="text" name="password"/><br/>
        <div style="text-align: center; padding-top: 5px;">
          <input type="Submit" value="Submit">Login</button>
        </div>
      </div>
    </form>
  </body>
</html>

<?php

if($_POST['netID'] && $_POST['password'])
{
  include("sensitive.php");

  // Check connection
  if (mysqli_connect_errno()) {
      die("Connection failed: " . mysqli_connect_error());
  }

  $query = "SELECT *
            FROM ADVISOR
            WHERE advisorNetID = '".$_POST['netID']."'";

  $result = mysqli_query($conn, $query);
  $row=mysqli_fetch_assoc($result);

  if(password_verify($_POST['password'], $row['hashedPassword']))
  {
    session_start();
    $_SESSION['user']['netID'] = $row['advisorNetID'];
    $_SESSION['user']['fname'] = $row['firstName'];
    $_SESSION['user']['lname'] = $row['lastName'];

    header("Location: home.php");
    die();
  } else {
    //give some false error here
  }
} else if($_POST['netID'] || $_POST['password']){
  //tell user password/username combo failed.
} else {
  //clear pre-existing session variables here.
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
        <input type="password" name="password"/><br/>
        <div style="text-align: center; padding-top: 5px;">
          <input type="Submit" value="Submit"/>
        </div>
      </div>
    </form>
  </body>
</html>

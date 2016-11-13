<?php
  session_start();

  if($_SESSION['user']['username'] != "")
  {
    //do session things here, like get admin permission
  } else {
    header("Location: login.php");
    die();
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
    <div><span>Hello, <?=$_SESSION['user']['fname']?></span></div>
    <div id="login">
      <div style="text-align: center;">
        <span><b>Advising Session</b></span>
      </div>
      <div style="text-align: center; padding-top: 5px;">
        <button onclick="window.location.href='student-info.html'">Start</button>
      </div>
    </div>
    <div id="login">
      <div style="text-align: center;">
        <span><b>Detailed Course Enrollment Information</b></span>
      </div>
      <div style="text-align: center; padding-top: 5px;">
        <button onclick="window.location.href='course-overview.html'">Continue</button>
      </div>
    </div>
    <div id="login">
      <div style="text-align: center;">
        <span><b>Manage Users</b></span>
      </div>
      <div style="text-align: center; padding-top: 5px;">
        <button onclick="window.location.href='users.html'">Manage</button>
      </div>
    </div>
  </body>
</html>

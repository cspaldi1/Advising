<?php
  session_start();

  if($_SESSION['user']['netID'])
  {
    //do session things here, like get admin permission
  } else {
    //if nobody is logged in, send to login page
    header("Location: login.php");
    die();
  }

 ?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="./CSS/foundation.css">
  <link rel="stylesheet" type="text/css" href="./CSS/foundation.min.css">
  <link rel="stylesheet" type="text/css" href="./CSS/global.css">
</head>
  <body>
    <div id="container" class="row">
      <div id="header" class="large-4 columns"><span id="title">Honors Advising Portal</span></div>
	  <div class="large-4 right columns"><h4>Hello, <?=$_SESSION['user']['fname']?></h4></div>
    </div>
	<div id="container" class="row">
		<div id="login">
		  <div style="text-align: center;">
			<span><b>Advising Session</b></span>
		  </div>
		  <div style="text-align: center; padding-top: 5px;">
			<button onclick="window.location.href='student-info.php'">Start</button>
		  </div>
		</div>
		<div id="login">
		  <div style="text-align: center;">
			<span><b>Detailed Course Enrollment Information</b></span>
		  </div>
		  <div style="text-align: center; padding-top: 5px;">
			<button onclick="window.location.href='course-overview.php'">Continue</button>
		  </div>
		</div>
		<div id="login">
		  <div style="text-align: center;">
			<span><b>Manage Users</b></span>
		  </div>
		  <div style="text-align: center; padding-top: 5px;">
			<button onclick="window.location.href='users.php'">Manage</button>
		  </div>
		</div>
	 </div>
	 <div id="container" class="row">
		
	 </div>
  </body>
</html>

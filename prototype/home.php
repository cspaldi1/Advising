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
  <script src="../foundation-6/js/vendor/jquery.js"></script>
  <script src="../foundation-6/js/vendor/foundation.min.js"></script>
  <link rel="stylesheet" type="text/css" href="./CSS/foundation.css">
  <link rel="stylesheet" type="text/css" href="./CSS/foundation.min.css">
  <link rel="stylesheet" type="text/css" href="./CSS/global.css">
</head>
  <body>
    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="#">Honors Advising Portal</a></h1>
        </li>
         <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
      </ul>

      <section class="top-bar-section">
        <!-- Right Nav Section -->
        <!--<ul class="right">
          <li class="active"><a href="#">Right Button Active</a></li>
          <li class="has-dropdown">
            <a href="#">Right Button Dropdown</a>
            <ul class="dropdown">
              <li><a href="#">First link in dropdown</a></li>
              <li class="active"><a href="#">Active link in dropdown</a></li>
            </ul>
          </li>
        </ul> -->

        <!-- Left Nav Section -->
        <!--<ul class="left">
          <li><a href="#">Left Nav Button</a></li>
        </ul>-->
      </section>
    </nav>
    <div id="container" class="row">
	     <div class="large-4 columns"><h4>Hello, <?=$_SESSION['user']['fname']?></h4></div>
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

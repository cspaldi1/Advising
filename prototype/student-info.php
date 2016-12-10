<?php
  session_start();
?>

<html>
<?php
	include("sensitive.php");
?>
<head>
  <link rel="stylesheet" type="text/css" href="./CSS/foundation.css">
  <link rel="stylesheet" type="text/css" href="./CSS/foundation.min.css">
  <link rel="stylesheet" type="text/css" href="./CSS/global.css">
</head>
  <body>
    <div id="container" class="row">
      <div id="header" class="large-12 columns"><span id="title">Honors Advising Portal</span></div>
    </div>
    <div id="login" class="row" style="border:none;">
      <div style="text-align: center; padding-bottom: 10px;" class="large-12 columns">
        <span><b>Student Advising Information</b></span>
      </div>
	</div>
	<form action="select-courses.php" method="post" id="student-info" style="text-align:left;">
      <div class="row"> 
	    <div class="large-offset-4 large-4 columns">
            <label> <b>EID:</b> </label>
            <input type="text" name="eid"/>
		</div>
      </div>
      <div class="row"> 
	    <div class="large-offset-4 large-4 columns">
			<label> <b>First Name:</b> </label>
            <input type="text" name="fname"/>
        </div>
      </div>
      <div class="row"> 
	    <div class="large-offset-4 large-4 columns">
	      <label> <b>Last Name:</b> </label>
          <input type="text" name="lname"/>
        </div>
      </div>
      <div class="row"> 
	    <div class="large-offset-4 large-4 columns">
          <label> <b>Emich Email:</b> </label>
          <input type="text" name="emich"/>
        </div>
      </div>
      <div style="text-align: center; padding-top: 5px;" >
          <input type="submit" value="Continue"/>
        </div>
      </form>
	</div>
  </body>
</html>

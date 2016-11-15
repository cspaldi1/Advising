<?php session_start();

  include("sensitive.php");

  // Check connection
  if (mysqli_connect_errno()) {
      die("Connection failed: " . mysqli_connect_error());
  }

  $query = "SELECT *
            FROM STUDENT
            WHERE EID = '".$_SESSION['student']['eid']."'";

  $result = mysqli_query($conn, $query);
  if (mysql_num_rows($result)==0)
  {
    $query = "INSERT INTO STUDENT
              VALUES ('".$_SESSION['student']['eid']."','".$_SESSION['student']['fname']."',
              '".$_SESSION['student']['lname']."', '".$_SESSION['student']['emich']."')";
    mysqli_query($conn, $query);
  }

  $query = "INSERT INTO SCHEDULE
            (scheduleDate, EID, advisorNetID)
            VALUES ('".date('Y-m-d')."','".$_SESSION['student']['eid']."',
            '".$_SESSION['user']['netID']."')";

  mysqli_query($conn, $query);
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
    <h1>Advising Session Complete!</h1>
      <div style="width: 50%; margin: auto;">
        <span>The student will receive an email shortly regarding the details of their advised schedule.</span>
      </div>
    <div style="margin-top: 10px;">
      <button onclick='window.location.href="home.html"'>Home</button>
    </div>
  </body>
</html>

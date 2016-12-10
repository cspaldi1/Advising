<?php session_start();

  include("sensitive.php");

  if(isset($_SESSION['student']['eid']) && $_SESSION['student']['eid'] != "")
  {
    /*// Check connection
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
      $query = mysqli_real_escape_string($conn, strip_tags($query));
      mysqli_query($conn, $query);
    }

    $query = "INSERT INTO SCHEDULE
              (scheduleDate, EID, advisorNetID)
              VALUES ('".date('Y-m-d')."','".$_SESSION['student']['eid']."',
              '".$_SESSION['user']['netID']."')";

    mysqli_query($conn, $query);*/



    //unset the student session
    unset($_SESSION['student']);
  } else {
    header("Location: home.php");
    die();
  }
  include("header.php");
?>
  <div class="row">
    <div class="large-6 large-centered columns">
      <h3>Advising Session Complete!</h3>
    </div>
  </div>
  <div class="row">
      <div class="large-6 large-centered columns">
        <span>The student will receive an email shortly regarding the details of their advised schedule.</span>
      </div>
  </div>
  <div class="row">
    <div class="large-6 large-centered columns" style="margin-top: 10px;">
      <button onclick='window.location.href="home.php"'>Home</button>
    </div>
  </div>
  </body>
</html>

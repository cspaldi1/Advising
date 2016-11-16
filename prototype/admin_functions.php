<?php
include("sensitive.php");

// Check connection
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}

$action = $_POST['action'];

switch($action) {
  case 'status':
    $admin = $_POST['admin'];
    $netID = $_POST['netID'];
    $query = "UPDATE ADVISOR
              SET isAdmin=".$admin."
              WHERE advisorNetID='".$netID."'";

    mysqli_query($conn, $query);
    return true;
    break;
  case 'addAdvisor':
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $password = password_hash($_POST['password']);
    $netID = $_POST['netID'];
    $query = "INSERT INTO ADVISOR
              VALUES ('".$netID."', '".mysqli_escape_string($fname)."',
              '".mysqli_escape_string($lname)."', 0,'".mysqli_escape_string($password)."')";

    mysqli_query($conn, $query);
    return true;
    break;
}



 ?>

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
}



 ?>

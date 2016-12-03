<?php session_start();

if(isset($_POST['action']) && $_POST['action'] != "")
{
  echo $_POST['action'];
  include("sensitive.php");

  // Check connection
  if (mysqli_connect_errno()) {
      die("Connection failed: " . mysqli_connect_error());
  }

  switch($_POST['action'])
  {
    case "schedule":
      if(isset($_POST['array_str']) && $_POST['array_str'] != "")
      {
        $schedule_arr = json_decode(stripslashes($_POST['array_str']), true);
        foreach($schedule_arr as $key=>$val)
        {
          echo $val['CRN'];
        }
        break;
      } else {
        echo "Array string not set.";
        break;
      }
      break;
  }

}
?>

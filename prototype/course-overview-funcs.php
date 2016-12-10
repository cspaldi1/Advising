<?php session_start();

if(isset($_POST['course_overview_fetch']) && $_POST['course_overview_fetch'] != "")
{
  //echo $_POST['action'];
  include("sensitive.php");

  // Check connection
  if (mysqli_connect_errno()) {
      die("Connection failed: " . mysqli_connect_error());
  }

  switch($_POST['action'])
  {
    case "get_distince_course_prefixes":
      //connection is named $conn
      $course_prefixes_sql = "SELECT DISTINCT coursePrefix FROM COURSE;";
      $result = mysqli_query($conn, $sql);
      $results_string = implode('\t', $result);
      echo $results_string;
    /*
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
      */
      break;
  }

}
?>

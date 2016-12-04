<?php session_start();

if(isset($_POST['action']) && $_POST['action'] != "")
{
  include("sensitive.php");

  switch($_POST['action'])
  {
    case "prefix":
      if(isset($_POST['prefix']) && $_POST['prefix'] != "")
      {
        // Check connection
        if (mysqli_connect_errno()) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $courseNo = array();

        $query = "SELECT DISTINCT courseNO
                  FROM COURSE
                  WHERE coursePrefix = '".$_POST['prefix']."'";

        $result = mysqli_query($conn, $query);
        while($row=mysqli_fetch_assoc($result))
        {
          $courseNo[] = $row['courseNO'];
        }
        sort($courseNo, SORT_STRING);

        echo json_encode($courseNo);
        break;
      } else {
        echo "Prefix string not set.";
        break;
      }
      break;

    case "courseNO":
      if(isset($_POST['courseNO']) && $_POST['courseNO'] != "")
      {
        // Check connection
        if (mysqli_connect_errno()) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $courseInfo = array();

        $query = "SELECT DISTINCT days
                  FROM COURSE
                  WHERE coursePrefix = '".$_POST['prefix']."' AND courseNO = '".$_POST['courseNO']."'";

        $result = mysqli_query($conn, $query);
        while($row=mysqli_fetch_assoc($result))
        {
          $days[] = $row['days'];
        }

        $query = "SELECT DISTINCT timeStart, timeEnd
                  FROM COURSE
                  WHERE coursePrefix = '".$_POST['prefix']."' AND courseNO = '".$_POST['courseNO']."'";

        $result = mysqli_query($conn, $query);
        while($row=mysqli_fetch_assoc($result))
        {
          $times[] = $row['timeStart']." - ".$row['timeEnd'];
        }

        $query = "SELECT DISTINCT CRN
                  FROM COURSE
                  WHERE coursePrefix = '".$_POST['prefix']."' AND courseNO = '".$_POST['courseNO']."'";

        $result = mysqli_query($conn, $query);
        while($row=mysqli_fetch_assoc($result))
        {
          $crn[] = $row['CRN'];
        }
        $result_arr = array("days"=>$days, "times"=>$times, "crns"=>$crn);

        echo json_encode($result_arr);
        break;
      } else {
        echo "Course number string not set.";
        break;
      }
    break;

    case "CRN":
      if(isset($_POST['CRN']))
      {
        // Check connection
        if (mysqli_connect_errno()) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $courseInfo = array();

        $query = "SELECT DISTINCT days
                  FROM COURSE
                  WHERE coursePrefix = '".$_POST['prefix']."' AND courseNO = '".$_POST['courseNO']."'";

        if($_POST['CRN'] != "")
        {
          $query = $query." AND CRN='".$_POST['CRN']."'";
        }
        $result = mysqli_query($conn, $query);
        while($row=mysqli_fetch_assoc($result))
        {
          $days[] = $row['days'];
        }

        $query = "SELECT DISTINCT timeStart, timeEnd
                  FROM COURSE
                  WHERE coursePrefix = '".$_POST['prefix']."' AND courseNO = '".$_POST['courseNO']."'";

        if($_POST['CRN'] != "")
        {
          $query = $query." AND CRN='".$_POST['CRN']."'";
        }
        $result = mysqli_query($conn, $query);
        while($row=mysqli_fetch_assoc($result))
        {
          $times[] = $row['timeStart']." - ".$row['timeEnd'];
        }
        $result_arr = array("days"=>$days, "times"=>$times);

        echo json_encode($result_arr);
        break;
      } else {
        echo "CRN string not set.";
        break;
      }
      break;

    case "days":
      if(isset($_POST['days']))
      {
        // Check connection
        if (mysqli_connect_errno()) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $courseInfo = array();

        $query = "SELECT DISTINCT CRN
                  FROM COURSE
                  WHERE coursePrefix = '".$_POST['prefix']."' AND courseNO = '".$_POST['courseNO']."'";

        if($_POST['days'] != "")
        {
          $query = $query." AND days='".$_POST['days']."'";
        }
        $result = mysqli_query($conn, $query);
        while($row=mysqli_fetch_assoc($result))
        {
          $crns[] = $row['CRN'];
        }

        $query = "SELECT DISTINCT timeStart, timeEnd
                  FROM COURSE
                  WHERE coursePrefix = '".$_POST['prefix']."' AND courseNO = '".$_POST['courseNO']."'";
        if($_POST['days'] != "")
        {
          $query = $query." AND days='".$_POST['days']."'";
        }
        $result = mysqli_query($conn, $query);
        while($row=mysqli_fetch_assoc($result))
        {
          $times[] = $row['timeStart']." - ".$row['timeEnd'];
        }
        $result_arr = array("crns"=>$crns, "times"=>$times);

        echo json_encode($result_arr);
        break;
      } else {
        echo "Days string not set.";
        break;
      }
      break;
  }

}
?>

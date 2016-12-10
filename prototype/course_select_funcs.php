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

        $query = "SELECT DISTINCT isHonors
                  FROM COURSE
                  WHERE coursePrefix = '".$_POST['prefix']."' AND courseNO = '".$_POST['courseNO']."'";

        $result = mysqli_query($conn, $query);
        while($row=mysqli_fetch_assoc($result))
        {
          $honors[] = $row['isHonors'];
        }

        $query = "SELECT DISTINCT credits
                  FROM COURSE
                  WHERE coursePrefix = '".$_POST['prefix']."' AND courseNO = '".$_POST['courseNO']."'";

        $result = mysqli_query($conn, $query);
        while($row=mysqli_fetch_assoc($result))
        {
          $credits[] = $row['credits'];
        }

        $result_arr = array("days"=>$days, "times"=>$times, "crns"=>$crn, "isHonors"=>$honors, 'credits'=>$credits);

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
        if(isset($_POST['times']) && $_POST['times'] != "")
        {
          $time_arr = explode(" - ", $_POST['times']);
          $query = $query." AND timeStart='".$time_arr[0]."' AND timeEnd='".$time_arr[1]."'";
        }
        if($_POST['isHonors'] != "")
        {
          $query = $query." AND isHonors=".$_POST['isHonors'];
        }
        if(isset($_POST['credits']) && $_POST['credits'] != "")
        {
          $query = $query." AND credits=".$_POST['credits'];
        }
        $result = mysqli_query($conn, $query);
        $days=array();
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
        if(isset($_POST['days']) && $_POST['days'] != "")
        {
          $query = $query." AND days='".$_POST['days']."'";
        }
        if($_POST['isHonors'] != "")
        {
          $query = $query." AND isHonors=".$_POST['isHonors'];
        }
        if(isset($_POST['credits']) && $_POST['credits'] != "")
        {
          $query = $query." AND credits=".$_POST['credits'];
        }
        $result = mysqli_query($conn, $query);
        $times = array();
        while($row=mysqli_fetch_assoc($result))
        {
          $times[] = $row['timeStart']." - ".$row['timeEnd'];
        }

        $query = "SELECT DISTINCT isHonors
                  FROM COURSE
                  WHERE coursePrefix = '".$_POST['prefix']."' AND courseNO = '".$_POST['courseNO']."'";

        if($_POST['CRN'] != "")
        {
          $query = $query." AND CRN='".$_POST['CRN']."'";
        }
        if(isset($_POST['days']) && $_POST['days'] != "")
        {
          $query = $query." AND days='".$_POST['days']."'";
        }
        if(isset($_POST['times']) && $_POST['times'] != "")
        {
          $time_arr = explode(" - ", $_POST['times']);
          $query = $query." AND timeStart='".$time_arr[0]."' AND timeEnd='".$time_arr[1]."'";
        }
        if(isset($_POST['credits']) && $_POST['credits'] != "")
        {
          $query = $query." AND credits=".$_POST['credits'];
        }
        $result = mysqli_query($conn, $query);
        $honors = array();
        while($row=mysqli_fetch_assoc($result))
        {
          $honors[] = $row['isHonors'];
        }

        $query = "SELECT DISTINCT credits
                  FROM COURSE
                  WHERE coursePrefix = '".$_POST['prefix']."' AND courseNO = '".$_POST['courseNO']."'";
        if($_POST['CRN'] != "")
        {
          $query = $query." AND CRN='".$_POST['CRN']."'";
        }
        if(isset($_POST['days']) && $_POST['days'] != "")
        {
          $query = $query." AND days='".$_POST['days']."'";
        }
        if(isset($_POST['times']) && $_POST['times'] != "")
        {
          $time_arr = explode(" - ", $_POST['times']);
          $query = $query." AND timeStart='".$time_arr[0]."' AND timeEnd='".$time_arr[1]."'";
        }
        if($_POST['isHonors'] != "")
        {
          $query = $query." AND isHonors=".$_POST['isHonors'];
        }
        $result = mysqli_query($conn, $query);
        while($row=mysqli_fetch_assoc($result))
        {
          $credits[] = $row['credits'];
        }

        $result_arr = array("days"=>$days, "times"=>$times, "isHonors"=>$honors, 'credits'=>$credits);

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
        if(isset($_POST['times']) && $_POST['times'] != "")
        {
          $time_arr = explode(" - ", $_POST['times']);
          $query = $query." AND timeStart='".$time_arr[0]."' AND timeEnd='".$time_arr[1]."'";
        }
        if($_POST['isHonors'] != "")
        {
          $query = $query." AND isHonors=".$_POST['isHonors'];
        }
        if(isset($_POST['credits']) && $_POST['credits'] != "")
        {
          $query = $query." AND credits=".$_POST['credits'];
        }
        $result = mysqli_query($conn, $query);
        $crns = array();
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
        if($_POST['isHonors'] != "")
        {
          $query = $query." AND isHonors=".$_POST['isHonors'];
        }
        if(isset($_POST['credits']) && $_POST['credits'] != "")
        {
          $query = $query." AND credits=".$_POST['credits'];
        }
        $result = mysqli_query($conn, $query);
        $times = array();
        while($row=mysqli_fetch_assoc($result))
        {
          $times[] = $row['timeStart']." - ".$row['timeEnd'];
        }
        $query = "SELECT DISTINCT isHonors
                  FROM COURSE
                  WHERE coursePrefix = '".$_POST['prefix']."' AND courseNO = '".$_POST['courseNO']."'";
        if($_POST['time'] != "")
        {
          $query = $query." AND timeStart='".$time_arr[0]."' AND timeEnd='".$time_arr[1]."'";
        }
        if(isset($_POST['days']) && $_POST['days'] != "")
        {
          $query = $query." AND days='".$_POST['days']."'";
        }
        if(isset($_POST['credits']) && $_POST['credits'] != "")
        {
          $query = $query." AND credits=".$_POST['credits'];
        }
        $result = mysqli_query($conn, $query);
        while($row=mysqli_fetch_assoc($result))
        {
          $honors[] = $row['isHonors'];
        }

        $query = "SELECT DISTINCT credits
                  FROM COURSE
                  WHERE coursePrefix = '".$_POST['prefix']."' AND courseNO = '".$_POST['courseNO']."'";

        if(isset($_POST['days']) && $_POST['days'] != "")
        {
          $query = $query." AND days='".$_POST['days']."'";
        }
        if(isset($_POST['times']) && $_POST['times'] != "")
        {
          $time_arr = explode(" - ", $_POST['times']);
          $query = $query." AND timeStart='".$time_arr[0]."' AND timeEnd='".$time_arr[1]."'";
        }
        if($_POST['isHonors'] != "")
        {
          $query = $query." AND isHonors=".$_POST['isHonors'];
        }
        $result = mysqli_query($conn, $query);
        while($row=mysqli_fetch_assoc($result))
        {
          $credits[] = $row['credits'];
        }
        $result_arr = array("crns"=>$crns, "times"=>$times, 'isHonors'=>$honors, 'credits'=>$credits);

        echo json_encode($result_arr);
        break;
      } else {
        echo "Days string not set.";
        break;
      }
      break;
    case "time":
      if(isset($_POST['time']))
      {
        // Check connection
        if (mysqli_connect_errno()) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $time_arr = explode(" - ", $_POST['time']);
        $courseInfo = array();

        $query = "SELECT DISTINCT CRN
                  FROM COURSE
                  WHERE coursePrefix = '".$_POST['prefix']."' AND courseNO = '".$_POST['courseNO']."'";

        if($_POST['time'] != "")
        {
          $query = $query." AND timeStart='".$time_arr[0]."' AND timeEnd='".$time_arr[1]."'";
        }
        if(isset($_POST['days']) && $_POST['days'] != "")
        {
          $query = $query." AND days='".$_POST['days']."'";
        }
        if($_POST['isHonors'] != "")
        {
          $query = $query." AND isHonors=".$_POST['isHonors'];
        }
        if(isset($_POST['credits']) && $_POST['credits'] != "")
        {
          $query = $query." AND credits=".$_POST['credits'];
        }
        $result = mysqli_query($conn, $query);
        while($row=mysqli_fetch_assoc($result))
        {
          $crns[] = $row['CRN'];
        }

        $query = "SELECT DISTINCT days
                  FROM COURSE
                  WHERE coursePrefix = '".$_POST['prefix']."' AND courseNO = '".$_POST['courseNO']."'";
        if($_POST['time'] != "")
        {
          $query = $query." AND timeStart='".$time_arr[0]."' AND timeEnd='".$time_arr[1]."'";
        }
        if($_POST['isHonors'] != "")
        {
          $query = $query." AND isHonors=".$_POST['isHonors'];
        }
        if(isset($_POST['credits']) && $_POST['credits'] != "")
        {
          $query = $query." AND credits=".$_POST['credits'];
        }
        $result = mysqli_query($conn, $query);
        while($row=mysqli_fetch_assoc($result))
        {
          $days[] = $row['days'];
        }

        $query = "SELECT DISTINCT isHonors
                  FROM COURSE
                  WHERE coursePrefix = '".$_POST['prefix']."' AND courseNO = '".$_POST['courseNO']."'";
        if($_POST['time'] != "")
        {
          $query = $query." AND timeStart='".$time_arr[0]."' AND timeEnd='".$time_arr[1]."'";
        }
        if(isset($_POST['days']) && $_POST['days'] != "")
        {
          $query = $query." AND days='".$_POST['days']."'";
        }
        if(isset($_POST['credits']) && $_POST['credits'] != "")
        {
          $query = $query." AND credits=".$_POST['credits'];
        }
        $result = mysqli_query($conn, $query);
        while($row=mysqli_fetch_assoc($result))
        {
          $honors[] = $row['isHonors'];
        }

        $query = "SELECT DISTINCT credits
                  FROM COURSE
                  WHERE coursePrefix = '".$_POST['prefix']."' AND courseNO = '".$_POST['courseNO']."'";

        if(isset($_POST['days']) && $_POST['days'] != "")
        {
          $query = $query." AND days='".$_POST['days']."'";
        }
        if(isset($_POST['time']) && $_POST['time'] != "")
        {
          $time_arr = explode(" - ", $_POST['time']);
          $query = $query." AND timeStart='".$time_arr[0]."' AND timeEnd='".$time_arr[1]."'";
        }
        if($_POST['isHonors'] != "")
        {
          $query = $query." AND isHonors=".$_POST['isHonors'];
        }
        $result = mysqli_query($conn, $query);
        while($row=mysqli_fetch_assoc($result))
        {
          $credits[] = $row['credits'];
        }
        $result_arr = array("crns"=>$crns, "days"=>$days, "isHonors"=>$honors, "credits"=>$credits);


        echo json_encode($result_arr);
        break;
      } else {
        echo "Time string not set.";
        break;
      }
      break;
    case "honors":
      if(isset($_POST['isHonors']))
      {
        // Check connection
        if (mysqli_connect_errno()) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $query = "SELECT DISTINCT CRN
                  FROM COURSE
                  WHERE coursePrefix = '".$_POST['prefix']."' AND courseNO = '".$_POST['courseNO']."'";

        if($_POST['isHonors'] != "")
        {
          $query = $query." AND isHonors=".$_POST['isHonors'];
        }
        if(isset($_POST['days']) && $_POST['days'] != "")
        {
          $query = $query." AND days='".$_POST['days']."'";
        }
        if(isset($_POST['times']) && $_POST['times'] != "")
        {
          $time_arr = explode(" - ", $_POST['times']);
          $query = $query." AND timeStart='".$time_arr[0]."' AND timeEnd='".$time_arr[1]."'";
        }
        if(isset($_POST['credits']) && $_POST['credits'] != "")
        {
          $query = $query." AND credits=".$_POST['credits'];
        }
        $result = mysqli_query($conn, $query);
        $crns=array();
        while($row=mysqli_fetch_assoc($result))
        {
          $crns[] = $row['CRN'];
        }

        $query = "SELECT DISTINCT days
                  FROM COURSE
                  WHERE coursePrefix = '".$_POST['prefix']."' AND courseNO = '".$_POST['courseNO']."'";
        if($_POST['isHonors'] != "")
        {
          $query = $query." AND isHonors=".$_POST['isHonors'];
        }
        if(isset($_POST['times']) && $_POST['times'] != "")
        {
          $time_arr = explode(" - ", $_POST['times']);
          $query = $query." AND timeStart='".$time_arr[0]."' AND timeEnd='".$time_arr[1]."'";
        }
        if(isset($_POST['credits']) && $_POST['credits'] != "")
        {
          $query = $query." AND credits=".$_POST['credits'];
        }
        $result = mysqli_query($conn, $query);
        $days = array();
        while($row=mysqli_fetch_assoc($result))
        {
          $days[] = $row['days'];
        }
        $query = "SELECT DISTINCT timeStart, timeEnd
                  FROM COURSE
                  WHERE coursePrefix = '".$_POST['prefix']."' AND courseNO = '".$_POST['courseNO']."'";
        if($_POST['isHonors'] != "")
        {
          $query = $query." AND isHonors=".$_POST['isHonors'];
        }
        if(isset($_POST['days']) && $_POST['days'] != "")
        {
          $query = $query." AND days='".$_POST['days']."'";
        }
        if(isset($_POST['credits']) && $_POST['credits'] != "")
        {
          $query = $query." AND credits=".$_POST['credits'];
        }
        $result = mysqli_query($conn, $query);
        $times = array();
        while($row=mysqli_fetch_assoc($result))
        {
          $times[] = $row['timeStart']." - ".$row['timeEnd'];
        }

        $query = "SELECT DISTINCT credits
                  FROM COURSE
                  WHERE coursePrefix = '".$_POST['prefix']."' AND courseNO = '".$_POST['courseNO']."'";

        if(isset($_POST['days']) && $_POST['days'] != "")
        {
          $query = $query." AND days='".$_POST['days']."'";
        }
        if(isset($_POST['times']) && $_POST['times'] != "")
        {
          $time_arr = explode(" - ", $_POST['times']);
          $query = $query." AND timeStart='".$time_arr[0]."' AND timeEnd='".$time_arr[1]."'";
        }
        if($_POST['isHonors'] != "")
        {
          $query = $query." AND isHonors=".$_POST['isHonors'];
        }
        $result = mysqli_query($conn, $query);
        while($row=mysqli_fetch_assoc($result))
        {
          $credits[] = $row['credits'];
        }
        $result_arr = array("crns"=>$crns, "days"=>$days, "times"=>$times, 'credits'=>$credits);


        echo json_encode($result_arr);
        break;
      } else {
        echo "Honors string not set.";
        break;
      }
      break;

      case "credits":
        if(isset($_POST['credits']))
        {
          // Check connection
          if (mysqli_connect_errno()) {
              die("Connection failed: " . mysqli_connect_error());
          }

          $query = "SELECT DISTINCT CRN
                    FROM COURSE
                    WHERE coursePrefix = '".$_POST['prefix']."' AND courseNO = '".$_POST['courseNO']."'";

          if($_POST['credits'] != "")
          {
            $query = $query." AND credits=".$_POST['credits'];
          }
          if(isset($_POST['isHonors']) && $_POST['isHonors'] != "")
          {
            $query = $query." AND isHonors=".$_POST['isHonors'];
          }
          if(isset($_POST['days']) && $_POST['days'] != "")
          {
            $query = $query." AND days='".$_POST['days']."'";
          }
          if(isset($_POST['times']) && $_POST['times'] != "")
          {
            $time_arr = explode(" - ", $_POST['times']);
            $query = $query." AND timeStart='".$time_arr[0]."' AND timeEnd='".$time_arr[1]."'";
          }
          $result = mysqli_query($conn, $query);
          $crns=array();
          while($row=mysqli_fetch_assoc($result))
          {
            $crns[] = $row['CRN'];
          }

          $query = "SELECT DISTINCT days
                    FROM COURSE
                    WHERE coursePrefix = '".$_POST['prefix']."' AND courseNO = '".$_POST['courseNO']."'";

          if($_POST['credits'] != "")
          {
            $query = $query." AND credits=".$_POST['credits'];
          }
          if(isset($_POST['isHonors']) && $_POST['isHonors'] != "")
          {
            $query = $query." AND isHonors=".$_POST['isHonors'];
          }
          if(isset($_POST['times']) && $_POST['times'] != "")
          {
            $time_arr = explode(" - ", $_POST['times']);
            $query = $query." AND timeStart='".$time_arr[0]."' AND timeEnd='".$time_arr[1]."'";
          }
          $result = mysqli_query($conn, $query);
          $days = array();
          while($row=mysqli_fetch_assoc($result))
          {
            $days[] = $row['days'];
          }
          $query = "SELECT DISTINCT timeStart, timeEnd
                    FROM COURSE
                    WHERE coursePrefix = '".$_POST['prefix']."' AND courseNO = '".$_POST['courseNO']."'";

          if($_POST['credits'] != "")
          {
            $query = $query." AND credits=".$_POST['credits'];
          }
          if(isset($_POST['isHonors']) && $_POST['isHonors'] != "")
          {
            $query = $query." AND isHonors=".$_POST['isHonors'];
          }
          if(isset($_POST['days']) && $_POST['days'] != "")
          {
            $query = $query." AND days='".$_POST['days']."'";
          }
          $result = mysqli_query($conn, $query);
          $times = array();
          while($row=mysqli_fetch_assoc($result))
          {
            $times[] = $row['timeStart']." - ".$row['timeEnd'];
          }

          $query = "SELECT DISTINCT isHonors
                    FROM COURSE
                    WHERE coursePrefix = '".$_POST['prefix']."' AND courseNO = '".$_POST['courseNO']."'";

          if($_POST['credits'] != "")
          {
            $query = $query." AND credits=".$_POST['credits'];
          }
          if(isset($_POST['days']) && $_POST['days'] != "")
          {
            $query = $query." AND days='".$_POST['days']."'";
          }
          if(isset($_POST['times']) && $_POST['times'] != "")
          {
            $time_arr = explode(" - ", $_POST['times']);
            $query = $query." AND timeStart='".$time_arr[0]."' AND timeEnd='".$time_arr[1]."'";
          }
          $result = mysqli_query($conn, $query);
          while($row=mysqli_fetch_assoc($result))
          {
            $honors[] = $row['isHonors'];
          }
          $result_arr = array("crns"=>$crns, "days"=>$days, "times"=>$times, 'isHonors'=>$honors);


          echo json_encode($result_arr);
          break;
        } else {
          echo "Credits string not set.";
          break;
        }
        break;
  }

}
?>

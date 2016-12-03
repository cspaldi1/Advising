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
          $courseNo[] = $row['courseNo'];
        }
        sort($courseNo, SORT_STRING);

        print_r($courseNo);
        break;
      } else {
        echo "Prefix string not set.";
        break;
      }
      break;
  }

}
?>

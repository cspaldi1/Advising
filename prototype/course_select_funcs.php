<?php session_start();

if(isset($_POST['action']) && $_POST['action'] != "")
{
  include("sensitive.php");

  switch($_POST['action'])
  {
    case "prefix":
      if(isset($_POST['prefix_str']) && $_POST['prefix_str'] != "")
      {
        $prefixArr = json_decode(stripslashes($_POST['prefix_str']), true);
        // Check connection
        if (mysqli_connect_errno()) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $courseNoArr = array();
        foreach ($prefixArr as $key=>$prefix)
        {
          $courseNo = array();
          
          $query = "SELECT DISTINCT courseNO
                    FROM COURSE
                    WHERE coursePrefix = '".$prefix."'";

          $result = mysqli_query($conn, $query);
          while($row=mysqli_fetch_assoc($result))
          {
            $courseNo[] = $row['courseNo'];
          }
          sort($courseNo, SORT_STRING);
          $courseNoArr[] = $courseNo;
        }

        print_r($courseNoArr);
        break;
      } else {
        echo "Prefix string not set.";
        break;
      }
      break;
  }

}
?>

<?php session_start();

include("sensitive.php");

// Check connection
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = array();
for($i=0; $i<count($_POST['prefix']); $i++)
{
  $q_temp = "SELECT *
          FROM COURSE
          WHERE ";
  $query_array = array();
  if($_POST['prefix'][$i] != "")
  {
    $query_array[] = "coursePrefix='".$_POST['prefix'][$i]."'";
  }
  if($_POST['courseNo'][$i] != "")
  {
    $query_array[] = "courseNO='".$_POST['courseNo'][$i]."'";
  }
  if($_POST['honors'][$i] != "")
  {
    $query_array[] = "isHonors=".$_POST['honors'][$i];
  }
  if($_POST['crn'][$i] != "")
  {
    $query_array[] = "CRN='".$_POST['crn'][$i]."'";
  }
  if($_POST['days'][$i] != "")
  {
    $query_array[] = "days='".$_POST['days'][$i]."'";
  }

  $conditions = implode(" AND ", $query_array);
  $q_temp = $q_temp.$conditions;
  $query[] = $q_temp;
}

$classes = array();
$courseCount = 0;
foreach($query as $key=>$sql)
{
  $result = mysqli_query($conn, $sql);
  $courses = array();
  while($row = mysqli_fetch_assoc($result))
  {
    $courses[] = $row;
  }
  $classes[] = $courses;
}

$schedules2 = array();

function decideFit($courseArr, $stackArr) {
  foreach($stackArr as $key=>$stackCourse) {
    $courseDays = str_split($courseArr["days"]);
    $stackDays = str_split($stackCourse["days"]);
    if(!empty(array_intersect($stackDays, $courseDays)) && $stackCourse['days'] != "")
    {
      if(strtotime($courseArr["timeStart"]) >= strtotime($stackCourse["timeStart"]) && strtotime($courseArr["timeStart"]) <= strtotime($stackCourse["timeEnd"]))
      {
        return false;
      }
      if(strtotime($courseArr["timeEnd"]) >= strtotime($stackCourse["timeStart"]) && strtotime($courseArr["timeEnd"]) <= strtotime($stackCourse["timeEnd"]))
      {
        return false;
      }
    }
  }
  return true;
}

function makeSchedule($length, $tempArray = array())
{
  //base case
  if($length == count($GLOBALS['classes'])-1)
  {
    for($j = 0; $j < count($GLOBALS['classes'][$length]); $j++)
    {
      if($GLOBALS['courseCount'] < 500)
      {
        if(decideFit($GLOBALS['classes'][$length][$j], $tempArray))
        {
            $tempArray[] = $GLOBALS['classes'][$length][$j];
            $GLOBALS['schedules2'][] = $tempArray;
            array_pop($tempArray);
            $GLOBALS['courseCount']++;
        }
      } else {
        break;
      }
    }
  //recursive case
  } else {
    for($i = 0; $i < count($GLOBALS['classes'][$length]); $i++)
    {
      if($GLOBALS['courseCount'] < 500)
      {
        if(decideFit($GLOBALS['classes'][$length][$i], $tempArray))
        {
            $tempArray[] = $GLOBALS['classes'][$length][$i];
            makeSchedule($length+1, $tempArray);
            array_pop($tempArray);
        }
      } else {
        break;
      }
    }
  }
}

//call the recursive function to schedule
makeSchedule(0);
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
    <div class="page">
      <span><b>Student Schedule for <?=$_SESSION['student']['fname']?></b></span>
      <table>
        <tr>
          <th>Prefix</th>
          <th>Course No.</th>
          <th>Honors</th>
          <th>CRN</th>
          <th>Days</th>
          <th>Time</th>
          <th>Credits</th>
        </tr>
        <?php
        for($j = 0; $j < count($schedules2); $j++)
        {
          for($i=0; $i<count($schedules2[$j]); $i++)
          { ?>
            <tr>
              <td><?=$schedules2[$j][$i]['coursePrefix']?></td>
              <td><?=$schedules2[$j][$i]['courseNO']?></td>
              <td><?=$schedules2[$j][$i]['isHonors']?></td>
              <td><?=$schedules2[$j][$i]['CRN']?></td>
              <td><?=$schedules2[$j][$i]['days']?></td>
              <td><?=$schedules2[$j][$i]['timeStart']?></td>
              <td><?=$schedules2[$j][$i]['credits']?></td>
            </tr>
          <?php
            }
          }?>
        <tr>
          <td colspan="6" style="text-align: right; border: none;">Total Credits:</td>
          <td style="text-align: left; border: none;"></td>
        </tr>
      </table>
    </div>
    <div>
      <div style="margin-top: 10px;">
        <button onclick="window.location.href='complete.php'">Choose Schedule and Submit</button>
      </div>
      <div style="width: 50%; margin: auto; padding-top: 20px;">
        <span style="float: left;"><< Back</span>
        <span style="float: center;">Showing Schedule 1 of <?=count($schedules2)?></span>
        <span style="float: right;"> Forward>></span>
      </div>
    </div>
  </body>
</html>

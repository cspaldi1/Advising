<?php
include("sensitive.php");

// Check connection
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = array();
$classes = array();
$query[] =  "SELECT *
          FROM COURSE
          WHERE coursePrefix='COSC' AND courseNo='111'";

$query[] = "SELECT *
          FROM COURSE
          WHERE coursePrefix='ACC' AND courseNo='240'";

$query[] = "SELECT *
          FROM COURSE
          WHERE coursePrefix='MATH' AND courseNo='120'";
$query[] = "SELECT *
          FROM COURSE
          WHERE coursePrefix='PSY' AND courseNo='101' AND days='MW'";

$query[] = "SELECT *
          FROM COURSE
          WHERE coursePrefix='PSY' AND courseNo='103' AND CRN='21846'";

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

  //call the recursive function
  makeSchedule(0);
   ?>

  <html>
    <table>
      <tr>
        <?php for ($i = 1; $i <= count($query); $i++)
        {?>
          <th>Course <?=$i?></th>
          <th>CRN</th>
          <th>Prefix</th>
          <th>Course No.</th>
          <th>Days</th>
          <th>Start</th>
          <th>End</th>
      <?php  } ?>
      </tr>
    <?php foreach($schedules2 as $key2=> $schedule2)
    { ?>
      <tr>
        <?php
          foreach($schedule2 as $key3=>$section2) { ?>
            <td></td>
              <td><?=$section2["CRN"]?></td>
              <td><?=$section2["coursePrefix"]?></td>
              <td><?=$section2["courseNO"]?></td>
              <td><?=$section2["days"]?></td>
              <td><?=$section2["timeStart"]?></td>
              <td><?=$section2["timeEnd"]?></td>
          <?php }
          ?>
      </tr>
  <?php  } ?>
    </table>
  </html>

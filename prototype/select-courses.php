<?php
$myfile = fopen("./winter.txt", "r") or die("Unable to open file!");
while (!feof ($myfile)) {
	$array = array();
    $line = fgets($myfile);
	$array = explode(";", $line);
	if(count($array) == 31)
	{
		if(!$classArr[trim($array[4])])
			$classArr[trim($array[4])] = array();
		if(!$classArr[trim($array[4])][trim($array[5])])
			$classArr[trim($array[4])][trim($array[5])] = array();

		$days = trim($array[19]).trim($array[20]).trim($array[21]).trim($array[22]).trim($array[23]).trim($array[24]).trim($array[25]);
		$classArr[trim($array[4])][trim($array[5])][trim($array[7])] = array("start"=>trim($array[17]),
	 		"end"=>trim($array[18]),
	  		"days"=>trim($days));
	}
}
fclose($myfile);
ksort($classArr);
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
    <h1>Select Student Courses</h1>
    <div>
      <table>
        <tr>
          <th>Prefix</th>
          <th>Course No.</th>
          <th>Honors</th>
          <th>CRN</th>
          <th>Days</th>
          <th>Time</th>
        </tr>
        <tr>
          <td>
            <select>
							<?php foreach($classArr as $prefix=>$course_info) { ?>
								<option><?=$prefix?></option>
							<?php } ?>
            </select>
          </td>
          <td>
            <select disabled>
              <option>Select</option>
            </select>
          </td>
          <td>
            <select disabled>
              <option>Both</option>
            </select>
          </td>
          <td>
            <select disabled>
              <option>CRN</option>
            </select>
          </td>
          <td>
            <select disabled>
              <option>Day</option>
            </select>
          </td>
          <td>
            <select disabled>
              <option>Time</option>
            </select>
          </td>
        </tr>
      </table>
      <div style="margin-top: 10px;">
        <button>Add Another Course</button>
        <button onclick="window.location.href='schedule.html'">See Schedule(s)</button>
      </div>
    </div>
  </body>
</html>

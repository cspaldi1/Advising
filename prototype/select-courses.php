<?php
session_start();

foreach($_POST as $key=>$val)
{
	$_SESSION['student'][$key] = $val;
}

$myfile = fopen("./wi2016.txt", "r") or die("Unable to open file!");
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
//var_dump($_SESSION['Student']);
?>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="./CSS/global.css">
	<script src="./JS/jquery-3.1.1.min.js"></script>
</head>
  <body>
    <div id="container">
      <div id="header"><span id="title">Honors Advising Portal</span>
      </div>
    </div>
    <h1>Select Student Courses</h1>
    <div>
			<form action="schedule.php" method="post" id="schedule">
	      <table>
	        <tr>
	          <th>Prefix</th>
	          <th>Course No.</th>
	          <th>Honors</th>
	          <th>CRN</th>
	          <th>Days</th>
	          <th>Time</th>
	        </tr>
	        <tr id="row1">
	          <td>
	            <select id="prefix1" onchange="changeCourseNo(1);" name="prefix[]" >
								<option value="">Select</option>
								<?php foreach($classArr as $prefix=>$course_info) { ?>
									<option value="<?=$prefix?>"><?=$prefix?></option>
								<?php } ?>
	            </select>
	          </td>
	          <td>
	            <select id="courseNo1" onchange="changeCRN(1);" name ="courseNo[]" disabled>
	              <option value = "">Course No.</option>
	            </select>
	          </td>
	          <td>
	            <select name="honors[]">
	              <option value = "">Both</option>
								<option value= "1">Yes</option>
								<option value= "0">No</option>
	            </select>
	          </td>
	          <td>
	            <select id="crn1" onchange="changeRest(1);" name="crn[]" disabled>
	              <option>CRN</option>
	            </select>
	          </td>
	          <td>
	            <select id="days1" name="days[]" disabled>
	              <option>Day</option>
	            </select>
	          </td>
	          <td>
	            <select id="time1" name="time[]" disabled>
	              <option>Time</option>
	            </select>
	          </td>
	        </tr>
	      </table>
				</form>
	      <div style="margin-top: 10px;">
	        <button onclick="addCourseLine();">Add Another Course</button>
	        <input type="button" onclick="validatePreSuf();" value="See Schedule(s)"/>
	      </div>
			</div>
    </div>
  </body>

	<script>
		var classArray = JSON.parse('<?=json_encode($classArr)?>');
		var courses = 1;

		function validatePreSuf() {
			var prefixes = document.getElementsByName("prefix[]");
			var courses = document.getElementsByName("courseNo[]");
			var valid = true;
			for(var i = 0; i < prefixes.length; i++)
			{
				if(prefixes[i].value == "" || courses[i].value == "") valid = false;
			}
			if(valid)
				document.getElementById('schedule').submit();
		}

		function changeCourseNo(number)
		{
			var valSelected = $("#prefix"+number).val();
			if(valSelected != "")
			{
				var sections = classArray[valSelected];
				var sectionKeys = Object.keys(sections);
				var replaceStr = "<option value=''> Select </option> ";
				for(var i = 0; i < sectionKeys.length; i++)
				{
					replaceStr += " <option value='"+sectionKeys[i]+"'>"+sectionKeys[i]+"</option> ";
				}
				$("#courseNo"+number).prop('disabled', false);
				$("#courseNo"+number).html(replaceStr);
			} else {
				$("#courseNo"+number).prop('disabled', "disabled");
			}
		}

		function changeCRN(number) {
			var valSelected = $("#courseNo"+number).val();
			var courseSelected = $("#prefix"+number).val();
			if(valSelected != "")
			{
				var sections = classArray[courseSelected][valSelected];
				var sectionKeys = Object.keys(sections);
				var replaceStr = "<option value=''> Select </option> ";
				for(var i = 0; i < sectionKeys.length; i++)
				{
					replaceStr += " <option value='"+sectionKeys[i]+"'>"+sectionKeys[i]+"</option> ";
				}
				$("#crn"+number).prop('disabled', false);
				$("#crn"+number).html(replaceStr);
			} else {
				$("#crn"+number).prop('disabled', "disabled");
			}
		}

		function changeRest(number) {
			var valSelected = $("#crn"+number).val();
			var courseSelected = $("#prefix"+number).val();
			var noSelected = $("#courseNo"+number).val();
			if(valSelected != "")
			{
				var sections = classArray[courseSelected][noSelected][valSelected];
				var sectionKeys = Object.keys(sections);
				var dayStr = "<option value=''> Select </option> ";
				dayStr += "<option value='"+sections["days"]+"'>"+sections["days"]+"</option>";

				var timeStr = "<option value=''> Select </option> ";
				timeStr += "<option value='"+sections["start"]+"-"+sections['end']+"'>"+sections["start"]+"-"+sections['end']+"</option>";

				$("#days"+number).prop('disabled', false);
				$("#time"+number).prop('disabled', false);
				$("#days"+number).html(dayStr);
				$("#time"+number).html(timeStr);
			} else {
				$("#days"+number).prop('disabled', "disabled");
				$("#time"+number).prop('disabled', "disabled");
			}
		}

		function addCourseLine()
		{
			courses++;
			var addStr = '<tr id="row'+courses+'">'+
				'<td>'+
					'<select id="prefix'+courses+'" onchange="changeCourseNo('+courses+');" name="prefix[]" >'+
						'<option value="">Select</option>'+
						'<?php foreach($classArr as $prefix=>$course_info) { ?>'+
							'<option value="<?=$prefix?>"><?=$prefix?></option>'+
						'<?php } ?>'+
					'</select>'+
				'</td>'+
				'<td>'+
					'<select id="courseNo'+courses+'" onchange="changeCRN('+courses+');" name ="courseNo[]" disabled>'+
						'<option value = "">Course No.</option>'+
					'</select>'+
				'</td>'+
				'<td>'+
					'<select name="honors[]">'+
						'<option value = "">Both</option>'+
						'<option value= "1">Yes</option>'+
						'<option value= "0">No</option>'+
					'</select>'+
				'</td>'+
				'<td>'+
					'<select id="crn'+courses+'" onchange="changeRest('+courses+');" name="crn[]" disabled>'+
						'<option>CRN</option>'+
					'</select>'+
				'</td>'+
				'<td>'+
					'<select id="days'+courses+'" name="days[]" disabled>'+
						'<option>Day</option>'+
					'</select>'+
				'</td>'+
				'<td>'+
					'<select id="time'+courses+'" name="time[]" disabled>'+
						'<option>Time</option>'+
					'</select>'+
				'</td>'+
			'</tr>';

			$(addStr).insertAfter($("#row"+(courses-1)));
		}
	</script>
</html>

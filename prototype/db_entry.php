<?php

include('sensitive.php');

// Check connection
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
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

    if(trim($array[8]) == 'H')
    {
      $honors = 1;
    } else {
      $honors = 0;
    }
    $credits = ltrim($array[30]);
    if(!$credits) $credits = 0;
		$days = trim($array[19]).trim($array[20]).trim($array[21]).trim($array[22]).trim($array[23]).trim($array[24]).trim($array[25]);
		$classArr[trim($array[4])][trim($array[5])][trim($array[7])] = array("start"=>trim($array[17]),
	 		"end"=>trim($array[18]),
	  	"days"=>trim($days),
      "honors"=>$honors,
      "cap"=>ltrim($array[12], '0'),
      "actual"=>ltrim($array[14], '0'),
      "term"=>trim($array[0]),
      "title"=> trim($array[9]),
      "credits"=>$credits);
	}
}

fclose($myfile);
ksort($classArr);
//var_dump($classArr["ACC"]);
foreach ($classArr as $prefix=>$courses)
{
	foreach($courses as $courseNo=>$sections)
	{
		foreach($sections as $CRN=>$details)
		{
      if($details['cap'] == "") $details['cap'] = 0;
      if($details['actual'] == "") $details['actual'] = 0;
      if(!isset($details['credits']) || $details['credits'] == "") $details['credits'] = 0;
      if($details['honors'] == "") $details['honors'] = 0;

			$sql = "INSERT INTO COURSE
        			(CRN, title, courseNO, coursePrefix, term, timeEnd, timeStart, days, capacity, actual, credits, isHonors)
        			VALUES ('".$CRN."', '".mysqli_real_escape_string($conn, $details['title'])."', '".$courseNo."', '".$prefix."', '".$details['term']."', '".$details['end']."',
        			'".$details['start']."', '".$details['days']."', ".$details['cap'].", ".$details['actual'].", ".$details['credits'].", ".$details['honors'].")";
        	if(!mysqli_query($conn, $sql)) {
            echo $sql."<br/>";
            print_r($details);
            echo("Error description: " . mysqli_error($conn)."<br/><br/>");
          }
		}
	}
}

?>

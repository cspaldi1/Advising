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
		$days = trim($array[19]).trim($array[20]).trim($array[21]).trim($array[22]).trim($array[23]).trim($array[24]).trim($array[25]);
		$classArr[trim($array[4])][trim($array[5])][trim($array[7])] = array("start"=>trim($array[17]),
	 		"end"=>trim($array[18]),
	  	"days"=>trim($days),
      "honors"=>$honors,
      "cap"=>ltrim($array[12], '0'),
      "actual"=>ltrim($array[14], '0'),
      "term"=>trim($array[0]),
      "title"=> trim($array[9]));
	}
}
fclose($myfile);
ksort($classArr);
var_dump($classArr);

?>

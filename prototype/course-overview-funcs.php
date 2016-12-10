<?php session_start();
if(isset($_POST['action']) && $_POST['action'] != "")
{
  include("sensitive.php");

  // Check connection
  if (mysqli_connect_errno()) {
      die("Connection failed: " . mysqli_connect_error());
  }

	switch($_POST['action']) {
		case "fetch_course_prefixes":
			//connection is named $conn
			$course_prefixes_sql = 'SELECT DISTINCT coursePrefix FROM COURSE';
			$result = mysqli_query($conn, $course_prefixes_sql);
			$rows_arr = array();
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$rows_arr[] = $row["coursePrefix"];
				}
				$results_json = json_encode($rows_arr);
	        		echo $results_json;
			}
			break;
		case "fetch_course_numbers":
			$course_prefix = $_POST['course_prefix'];
			$course_numbers_sql = "SELECT DISTINCT courseNO FROM COURSE WHERE coursePrefix='" . $course_prefix . "'";
			//$course_numbers_sql = "SELECT DISTINCT courseNO FROM COURSE WHERE coursePrefix='ACLA'";
			$result = mysqli_query($conn, $course_numbers_sql);

			$rows_arr = array();
      if($result->num_rows > 0){
              while($row = $result->fetch_assoc()){
                      $rows_arr[] = $row["courseNO"];
              }
              $results_json = json_encode($rows_arr);
              echo $results_json;

      }else{
				echo "no rows";
			}

			break;

	/*
	case "fetch_course_numbers":
		echo 'enter';
		$course_prefix = $_POST['course_prefix'];
		$course_numbers_sql = "SELECT DISTINCT courseNO FROM COURSE WHERE coursePrefix='" . $course_prefix . "'";
		$result = msqli_query($conn, $course_numbers_sql);
		$rows_arr = array();
		if($result->num_rows > 0){
			while($row = result->fetch_assoc()){
				$rows_arr[] = $row["courseNO"];
			}
			$results_json = json_encode($rows_arr);
			echo $results_json;
		}
		break;
	*/
  }

}
?>

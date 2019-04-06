<?php
	require_once("db_config.php");
  
		$query = "SELECT Rest_Name FROM Restaurant";
		$result = mysqli_query($db, $query);
    
		$Rest = array();
		$i = 0;
    
		while ($row=mysqli_fetch_array($result)){
			$Rest[$i] = $row['name'];
       			$i = $i + 1;
		}
    
		$json = array();
    
	for($x = 1; $x <= $i; $x++)
	{
		$temp_query_1 = "SELECT AVG(`Rating_1`) FROM `Restaurant Rate` WHERE `RestID`= $x";
		$temp_qr_1 = mysqli_query($db, $temp_query_1);
		$temp_result_1 =	mysqli_fetch_assoc($temp_qr_1);
    
		$temp_query_2 = "SELECT AVG(`Rating_2`) FROM `Restaurant Rate` WHERE `RestID`= $x";
		$temp_qr_2 = mysqli_query($db, $temp_query_2);
		$temp_result_2 =	mysqli_fetch_assoc($temp_qr_2);
    
		$temp_query_3 = "SELECT AVG(`Rating_3`) FROM `Restaurant Rate` WHERE `RestID`= $x";
		$temp_qr_3 = mysqli_query($db, $temp_query_3);
		$temp_result_3 =	mysqli_fetch_assoc($temp_qr_3);
    
		$temp_query_4 = "SELECT AVG(`Rating_4`) FROM `Restaurant Rate` WHERE `RestID`= $x";
		$temp_qr_4 = mysqli_query($db, $temp_query_4);
		$temp_result_4 =	mysqli_fetch_assoc($temp_qr_4);
    
		$temp_array = array(
			"rating_1"=>(int) $temp_result_1["AVG(`Rating_1`)"],
			"rating_2"=>(int) $temp_result_2["AVG(`Rating_2`)"],
			"rating_3"=>(int) $temp_result_3["AVG(`Rating_3`)"],
			"rating_4"=>(int) $temp_result_4["AVG(`Rating_4`)"],
			"Restname"=>$Rest[$x-1],
			"id"=>strval($x),
		);
		array_push($json, $temp_array);
	}
  
		echo json_encode($json);
?>

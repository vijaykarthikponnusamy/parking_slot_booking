<?php
//DB connection
include('../database.php');

//Get Time
if(isset($_POST['bookingAreaId']))
{
	$bookingAreaId = $_POST['bookingAreaId'];
	$sql = $conn->query("SELECT * FROM parking_list WHERE id='$bookingAreaId'");
	$row = $sql->fetch_assoc();
	$cutoff = $row['cutoff_time'];

	echo "<option>Select Available Time</option>";
	for($i=1; $i<=$cutoff; $i++)
	{
	   echo "<option value=".$i.">".$i." hrs</option>";
	}
}


//Chk Data
if(isset($_POST['ChkData1']) && isset($_POST['ChkData2']))
{
	$Area = $_POST['ChkData1'];
	$Type = $_POST['ChkData2'];
	$sql = $conn->query("SELECT * FROM parking_list WHERE area='$Area' AND vehicle_type='$Type'");

        if($sql->num_rows > 0)
	{
		echo "success";
	}
}

?>

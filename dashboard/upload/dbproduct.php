<?php
session_start();
include('db.php');

header('Content-type: text/html; charset=utf-8');
header("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");

if(isset($_SESSION['csv_file_name']))
{
	$file_data = fopen('junkupload/' . $_SESSION['csv_file_name'], 'r');
	$batch = $_SESSION['batch'];

	$query = "INSERT INTO dbproduct(mdccode,itemcode,description,category,vendor,dmpicode,dmpipack,dmpiclassification,uom,active,batch) VALUES";

	fgetcsv($file_data);
	while($row = fgetcsv($file_data))
	{
		$mdccode = $row[0];
		$itemcode = $row[1];
		$description = utf8_encode($row[2]);
		$category = $row[3];
		$vendor = $row[4];
		$dmpicode = $row[5];
		$dmpipack = $row[6];
		$dmpiclassification = $row[7];
		$uom = $row[8];
		$active = '1';

		$insert[] = "('$mdccode','$itemcode','$description','$category','$vendor','$dmpicode','$dmpipack','$dmpiclassification','$uom','$active','$batch')";
	}
	$query .= join(',',$insert);
	mysqli_query($conn,$query);
}

$conn->close();
?>
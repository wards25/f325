<?php
session_start();
include('db.php');

header('Content-type: text/html; charset=utf-8');
header("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");

if(isset($_SESSION['csv_file_name']))
{
	$file_data = fopen('junkupload/'.$_SESSION['csv_file_name'], 'r');
	$batch = $_SESSION['batch'];

	fgetcsv($file_data);
	while($row = fgetcsv($file_data))
	{
		$code = $row[0];
		$branchname = utf8_encode(str_replace("'", "''", $row[1]));
		$shipping = utf8_encode(str_replace("'", "''", $row[2]));
		$billing = utf8_encode(str_replace("'", "''", $row[3]));
		$franchise = utf8_encode(str_replace("'", "''", $row[4]));
		$region = utf8_encode(str_replace("'", "''", $row[5]));
		$cluster = utf8_encode(str_replace("'", "''", $row[6]));
		$location = utf8_encode(str_replace("'", "''", $row[7]));
		$deducttype = utf8_encode(str_replace("'", "''", $row[8]));
		$status = '1';

		$query = "INSERT INTO dbcensus(code,branchname,shipping,billing,franchise,region,cluster,location,deducttype,status,batch) VALUES ('$code','$branchname','$shipping','$billing','$franchise','$region','$cluster','$location','$deducttype','$status','$batch')";
		mysqli_query($conn,$query);
	}
}

$conn->close();
?>
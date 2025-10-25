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

	$query = "INSERT INTO dbdmpireason(reasoncode,reason,baginbox,can,drum,foil,glassbottle,glassjars,hdpe,multiple,petbottle,pillowpack,plasticbottle,sachet,sup,tetra,batch) VALUES";

	fgetcsv($file_data);
	while($row = fgetcsv($file_data))
	{
		$reasoncode = $row[0];
		$reason = $row[1];
		$baginbox = $row[2];
		$can = $row[3];
		$drum = $row[4];
		$foil = $row[5];
		$glassbottle = $row[6];
		$glassjars = $row[7];
		$hdpe = $row[8];
		$multiple = $row[9];
		$petbottle = $row[10];
		$pillowpack = $row[11];
		$plasticbottle = $row[12];
		$sachet = $row[13];
		$sup = $row[14];
		$tetra = $row[15];


		$insert[] = "('$reasoncode','$reason','$baginbox','$can','$drum','$foil','$glassbottle','$glassjars','$hdpe','$multiple','$petbottle','$pillowpack','$plasticbottle','$sachet','$sup','$tetra','$batch')";
	}
	$query .= join(',',$insert);
	mysqli_query($conn,$query);
}

$conn->close();
?>
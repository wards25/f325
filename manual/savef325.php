<?php
session_start();
require_once('require/returnlogin.php');
require_once('require/nocache.php');
include('db.php');

date_default_timezone_set("Asia/Manila");
$dateprocessed = date("Y-m-d");
$timeprocessed = date("H:i:s");

$username = $_SESSION['fname'];
$ordernumber = $_POST['ordernumber'];


// check f325 if exist
$check_query = mysqli_query($conn,"SELECT * FROM dbf325number WHERE f325number='$ordernumber' ");
$fetch_check = mysqli_fetch_array($check_query);

if (is_array($fetch_check))
{
	echo "true";
}
else
{
	$code = $_POST['code'];
	// branch detail
	$census_query = mysqli_query($conn,"SELECT * FROM dbcensus WHERE code='$code' ");
	$fetch_census = mysqli_fetch_array($census_query);

	$cluster = $fetch_census['cluster'];
	$location = $fetch_census['location'];
	$deducttype = $fetch_census['deducttype'];

	$tmnumber = $_POST['tmnumber'];
	$company = $_POST['company'];
	$emaildate = $_POST['emaildate'];
	$driver = strtoupper($_POST['driver']);
	$issued = utf8_encode(str_replace("'", "''", $_POST['issued']));
	$prepared = utf8_encode(str_replace("'", "''", $_POST['prepared']));
	$platenumber = strtoupper($_POST['platenumber']);

	$orderdate = $_POST['orderdate'];
	// $status = $_POST['status'];

	mysqli_query($conn,"INSERT INTO dbf325number(f325number,brcode,preparedby,issuedby,emaildate,f325date,vendor,tmnumber,drivername,platenumber,datesched,datecleared,arnumber,pageno,printremarks,logisticremarks,clearingremarks,cluster,location,deducttype,status,process,verificationdate,verificationreason,ilrno,stamped,cleared_time) VALUES ('$ordernumber','$code','$prepared','$issued','$emaildate','$orderdate','$company','$tmnumber','$driver','$platenumber','0000-00-00','0000-00-00','','','','','','$cluster','$location','$deducttype','CLEARED','MANUAL','0000-00-00','','','','$timeprocessed')");

	// insert in dbhistory
	$processed = 'F325 Created';
	mysqli_query($conn,"INSERT INTO dbhistory(processnumber,name,processed,dateprocessed,timeprocessed) VALUES ('$ordernumber','$username','$processed','$dateprocessed','$timeprocessed')");

	echo "false";
}

$conn->close();
?>
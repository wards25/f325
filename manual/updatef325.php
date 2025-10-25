<?php
session_start();
require_once('require/returnlogin.php');
require_once('require/nocache.php');
include('db.php');

date_default_timezone_set("Asia/Manila");
$dateprocessed = date("Y-m-d");
$timeprocessed = date("H:i:s");

$username = $_SESSION['fname'];
$id = $_POST['id'];
$ordernumber = $_POST['ordernumber'];
$oldordernumber = $_POST['oldordernumber'];
$code = $_POST['code'];
$tmnumber = $_POST['tmnumber'];
$company = $_POST['company'];
$emaildate = $_POST['emaildate'];
$driver = strtoupper($_POST['driver']);
$issued = utf8_encode(str_replace("'", "''", $_POST['issued']));
$prepared = utf8_encode(str_replace("'", "''", $_POST['prepared']));
$platenumber = strtoupper($_POST['platenumber']);
$orderdate = $_POST['orderdate'];
$status = $_POST['status'];
// $cleared_time = date('H:i:s');

// get branch detail
$branch_query = mysqli_query($conn,"SELECT * FROM dbcensus WHERE code='$code' ");
$fetch_branch = mysqli_fetch_array($branch_query);

if (is_array($fetch_branch))
{
	$cluster = $fetch_branch['cluster'];
	$location = $fetch_branch['location'];
	$deducttype = $fetch_branch['deducttype'];
}
else
{
	$cluster = "For Fill-up";
	$location = "For Fill-up";
	$deducttype = "For Fill-up";
}

// check order number if exist
$check_query = mysqli_query($conn,"SELECT * FROM dbf325number WHERE f325number='$ordernumber' ");
$fetch_check = mysqli_fetch_array($check_query);

if (is_array($fetch_check))
{
	// if same id and f325number
	if ($fetch_check['id'] == $id && $fetch_check['f325number'] == $ordernumber)
	{
		// update f325
		mysqli_query($conn,"UPDATE dbf325number SET f325number='$ordernumber',brcode='$code',preparedby='$prepared',issuedby='$issued',emaildate='$emaildate',f325date='$orderdate',vendor='$company',tmnumber='$tmnumber',drivername='$driver',platenumber='$platenumber',cluster='$cluster',location='$location',deducttype='$deducttype',status='$status' WHERE id='$id'  ");

		// change old ordernumber ot new
		mysqli_query($conn,"UPDATE dbhistory SET processnumber='$ordernumber' WHERE processnumber='$oldordernumber' ");

		// insert in dbhistory
		$processed = 'Update';
		mysqli_query($conn,"INSERT INTO dbhistory(processnumber,name,processed,dateprocessed,timeprocessed) VALUES ('$ordernumber','$username','$processed','$dateprocessed','$timeprocessed')");

		echo "false";
	}
	else
	{
		echo "true";
	}
}
else
{
	// update f325
	mysqli_query($conn,"UPDATE dbf325number SET f325number='$ordernumber',brcode='$code',preparedby='$prepared',issuedby='$issued',emaildate='$emaildate',f325date='$orderdate',vendor='$company',tmnumber='$tmnumber',drivername='$driver',platenumber='$platenumber,cluster='$cluster',location='$location',deducttype='$deducttype',',status='$status' WHERE id='$id'  ");

	// change old ordernumber ot new
	mysqli_query($conn,"UPDATE dbhistory SET processnumber='$ordernumber' WHERE processnumber='$oldordernumber' ");

	// insert in dbhistory
	$processed = 'Update';
	mysqli_query($conn,"INSERT INTO dbhistory(processnumber,name,processed,dateprocessed,timeprocessed) VALUES ('$ordernumber','$username','$processed','$dateprocessed','$timeprocessed')");

	echo "false";
}

$conn->close();
?>
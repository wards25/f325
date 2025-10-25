<?php
session_start();
require_once('require/returnlogin.php');
require_once('require/nocache.php');
include('db.php');

date_default_timezone_set("Asia/Manila");
$dateprocessed = date("Y-m-d");
$timeprocessed = date("H:i:s");

$username = $_SESSION['fname'];
$reference = $_POST['reference'];
$dmpiclass = $_POST['dmpiclass'];
$transact = $_POST['transact'];
$status = $_POST['status'];

//check if reference number is exist
$check_query = mysqli_query($conn,"SELECT * FROM dbdmpi WHERE reference='$reference' ");
$fetch_check = mysqli_fetch_array($check_query);

if (is_array($fetch_check))
{
	echo "true";
}
else
{
	// insert data
	mysqli_query($conn,"INSERT INTO dbdmpi(reference,classification,transactnumber,processby,status) VALUES ('$reference','$dmpiclass','$transact','$username','$status')");

	// insert in dbhistory
	$processed = 'Summary Created';
	mysqli_query($conn,"INSERT INTO dbhistory(processnumber,name,processed,dateprocessed,timeprocessed) VALUES ('$reference','$username','$processed','$dateprocessed','$timeprocessed')");

	echo 'Successfully added!';
}

$conn->close();
?>
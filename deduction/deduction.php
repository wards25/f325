<?php
session_start();
require_once('require/returnlogin.php');
include('db.php');

date_default_timezone_set("Asia/Manila");
$timeprocessed = date("H:i:s");

$username = $_SESSION['fname'];
$principal = $_POST['principal'];
$company = $_POST['company'];
$preparedby = $_POST['preparedby'];
$reference = $_POST['reference'];
$dateprocessed = $_POST['dateprocessed'];
$status = $_POST['status'];
$refcode = $_POST['refcode'];
$remarks = $_POST['remarks'];

//check if reference number is exist
$check_query = mysqli_query($conn,"SELECT * FROM dbfordeduction WHERE reference='$reference' ");
$fetch_check = mysqli_fetch_array($check_query);

if (is_array($fetch_check))
{
	echo "true";
}
else
{
	mysqli_query($conn,"INSERT INTO dbfordeduction(reference,refcode,principal,company,preparedby,dateprocessed,apvnumber,remarks,apremarks,status) VALUES ('$reference','$refcode','$principal','$company','$preparedby','$dateprocessed','','$remarks','','$status')");

	// insert in dbhistory
	$processed = 'Summary Created';
	mysqli_query($conn,"INSERT INTO dbhistory(processnumber,name,processed,dateprocessed,timeprocessed) VALUES ('$reference','$username','$processed','$dateprocessed','$timeprocessed')");

	echo "Deducted successfully";
}

$conn->close();
?>
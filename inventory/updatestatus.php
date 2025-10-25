<?php
session_start();
require_once('require/returnlogin.php');
require_once('require/nocache.php');
include('db.php');

$id = $_POST['id'];
$mdccode = $_POST['mdccode'];
$status = $_POST['status'];

// date and time
date_default_timezone_set("Asia/Manila");
$dateprocessed = date("Y-m-d");
$timeprocessed = date("H:i:s");

$username = $_SESSION['fname'];

// update status
mysqli_query($conn,"UPDATE dbproduct SET active='$status' WHERE id='$id' ");

if ($status == '1')
{
	// insert in dbhistory
	$processed = 'Activate';
	mysqli_query($conn,"INSERT INTO dbproducthistory(mdccode,name,processed,dateprocessed,timeprocessed) VALUES ('$mdccode','$username','$processed','$dateprocessed','$timeprocessed')");
	echo "Activate successfully.";
}
else
{
	// insert in dbhistory
	$processed = 'Deactivate';
	mysqli_query($conn,"INSERT INTO dbproducthistory(mdccode,name,processed,dateprocessed,timeprocessed) VALUES ('$mdccode','$username','$processed','$dateprocessed','$timeprocessed')");
	echo "Deactivate successfully.";
}

$conn->close();
?>
<?php
session_start();
include('db.php');

$mdccode = $_POST['mdccode'];
$barcode = $_POST['barcode'];

// check bacode if exist
$check_query = mysqli_query($conn,"SELECT * FROM dbbarcode WHERE barcodenumber='$barcode' ");
$row = mysqli_num_rows($check_query);

if ($row >= '1')
{
	echo "Already exist.";
}
else
{
	// insert in dbbarcode
	mysqli_query($conn,"INSERT INTO dbbarcode(mdccode,barcodenumber) VALUES ('$mdccode','$barcode')");
	// date and time
	date_default_timezone_set("Asia/Manila");
	$dateprocessed = date("Y-m-d");
	$timeprocessed = date("H:i:s");

	$username = $_SESSION['fname'];

	// insert in dbhistory
	$processed = 'Add Barcode';
	mysqli_query($conn,"INSERT INTO dbproducthistory(mdccode,name,processed,dateprocessed,timeprocessed) VALUES ('$mdccode','$username','$processed','$dateprocessed','$timeprocessed')");
	echo "Added successfully!";
}

$conn->close();
?>
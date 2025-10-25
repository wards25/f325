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
$category = $_POST['category'];
$status = 'CANCELLED';

// category
if ($category == 'DMPI')
{
	$statusout = 'UPLOADED';
}
else
{
	$statusout = 'CLEARED';
}

// update status in dbfordeduction
mysqli_query($conn,"UPDATE dbpullout SET status='$status' WHERE reference='$reference' ");

// update status in dbstock
mysqli_query($conn,"UPDATE dbraw SET statusout='$statusout',pulloutref='' WHERE pulloutref='$reference' ");

$filelocation = $_SERVER['DOCUMENT_ROOT'].'/filepicture/dbpullout/'.$reference.'.jpg';

// check if file exist
if (file_exists($filelocation))
{
	// unlink file
	unlink($filelocation);
}

// insert in dbhistory
$processed = 'Cancelled';
mysqli_query($conn,"INSERT INTO dbhistory(processnumber,name,processed,dateprocessed,timeprocessed) VALUES ('$reference','$username','$processed','$dateprocessed','$timeprocessed')");

echo 'Cancelled successfully!';

$conn->close();
?>
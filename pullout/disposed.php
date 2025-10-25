<?php
session_start();
include('db.php');

date_default_timezone_set("Asia/Manila");
$dateprocessed = date("Y-m-d");
$timeprocessed = date("H:i:s");

$username = $_SESSION['fname'];

$droot = $_SERVER['DOCUMENT_ROOT'];
$directory = "/filepicture";
$junkfile = "/junkfile/";
$dbfile = "/dbpullout/";

$allowed_ext = array('jpeg','jpg','png');
$file_array = explode(".", $_FILES["files"]["name"]);
$extension = end($file_array);

if (in_array($extension, $allowed_ext))
{
	$files = $_FILES['files']['name'];
	$reference = $_POST['reference'];

	$filelocation = $droot.$directory.$junkfile.$files;

	// move upload file
	move_uploaded_file($_FILES['files']['tmp_name'],$filelocation);

	// rename file
	rename($filelocation, $droot.$directory.$junkfile.$reference.'.jpg');

	$newnamefile = $reference.'.'.$extension;

	// check if file is exist in folder
	if (file_exists($droot.$directory.$dbfile.$newnamefile))
	{
		echo "File exist!";
	}
	else
	{
		// copy file from junkfile
		copy($droot.$directory.$junkfile.$newnamefile, $droot.$directory.$dbfile.$newnamefile);

		// remove file from junkfile
		unlink($droot.$directory.$junkfile.$newnamefile);

		$status = 'DISPOSED';

		// update status in dbpullout
		mysqli_query($conn,"UPDATE dbpullout SET status='$status' WHERE reference='$reference' ");

		// update status in dbraw
		mysqli_query($conn,"UPDATE dbraw SET statusout='$status' WHERE pulloutref='$reference' ");

		// insert in dbhistory
		$processed = 'Disposed';
		mysqli_query($conn,"INSERT INTO dbhistory(processnumber,name,processed,dateprocessed,timeprocessed) VALUES ('$reference','$username','$processed','$dateprocessed','$timeprocessed')");

		echo "Update successfully!";
	}
}

$conn->close();
?>
<?php
session_start();
include('db.php');

date_default_timezone_set("Asia/Manila");
$dateprocessed = date("Y-m-d");
$timeprocessed = date("H:i:s");
$username = $_SESSION['fname'];

$f325number = $_POST['f325number'];
$tmnumber = $_POST['tmnumber'];
$drivername = $_POST['drivername'];
$platenumber = $_POST['platenumber'];
$datesched = $_POST['datesched'];
$remarks = $_POST['remarks'];
$status = "SCHEDULED";
$beforestatus = "PRINTED";

// update data in dbf325number
mysqli_query($conn,"UPDATE dbf325number SET tmnumber='$tmnumber',drivername='$drivername',platenumber='$platenumber',datesched='$datesched',logisticremarks='$remarks',status='$status' WHERE f325number='$f325number' AND status='$beforestatus' ");

// update data in dbraw
mysqli_query($conn,"UPDATE dbraw SET status='$status' WHERE f325number='$f325number' ");

// insert in dbhistory
$processed = 'Scheduled';
mysqli_query($conn,"INSERT INTO dbhistory(processnumber,name,processed,dateprocessed,timeprocessed) VALUES ('$f325number','$username','$processed','$dateprocessed','$timeprocessed')");

$conn->close();
?>
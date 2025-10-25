<?php
session_start();
require_once('require/returnlogin.php');
require_once('require/nocache.php');
include('db.php');

date_default_timezone_set("Asia/Manila");
$dateprocessed = date("Y-m-d");
$timeprocessed = date("H:i:s");

$username = $_SESSION['fname'];
$status = 'OKFORDEDUCT';
$f325number = $_POST['f325number'];
$pageno = $_POST['pageno'];

// update in dbf325number
mysqli_query($conn,"UPDATE dbf325number SET pageno='$pageno',status='$status' WHERE f325number='$f325number' ");

// insert in dbhistory
$processed = 'OK for Deduct';
mysqli_query($conn,"INSERT INTO dbhistory(processnumber,name,processed,dateprocessed,timeprocessed) VALUES ('$f325number','$username','$processed','$dateprocessed','$timeprocessed')");

echo 'Update successfully!';

$conn->close();
?>
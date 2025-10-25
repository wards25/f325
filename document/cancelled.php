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
$status = 'CANCELLED';

// update status in dbfordeduction
mysqli_query($conn,"UPDATE dbfordeduction SET status='$status' WHERE reference='$reference' ");

// update status in dbraw
mysqli_query($conn,"UPDATE dbraw SET status='OKFORDEDUCT',deductref='' WHERE deductref='$reference' ");

// update status in dbmdcdeduction
mysqli_query($conn,"UPDATE dbmdcdeduction SET status='OPEN',dbreference='' WHERE dbreference='$reference' ");

// insert in dbhistory
$processed = 'Cancelled';
mysqli_query($conn,"INSERT INTO dbhistory(processnumber,name,processed,dateprocessed,timeprocessed) VALUES ('$reference','$username','$processed','$dateprocessed','$timeprocessed')");

$conn->close();
?>
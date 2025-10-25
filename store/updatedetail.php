<?php
session_start();
require_once('require/returnlogin.php');
require_once('require/nocache.php');
include('db.php');

$id = $_POST['id'];
$code = $_POST['code'];
$branchname = $_POST['branchname'];
$shipping = $_POST['shipping'];
$billing = $_POST['billing'];
$franchise = $_POST['franchise'];
$region = $_POST['region'];
$cluster = $_POST['cluster'];
$deducttype = $_POST['deducttype'];
$location = $_POST['location'];

// update detail
mysqli_query($conn,"UPDATE dbcensus SET code='$code',branchname='$branchname',shipping='$shipping',billing='$billing',franchise='$franchise',region='$region',cluster='$cluster',location='$location',deducttype='$deducttype' WHERE id='$id' ");

// date and time
date_default_timezone_set("Asia/Manila");
$dateprocessed = date("Y-m-d");
$timeprocessed = date("H:i:s");

$username = $_SESSION['fname'];

// insert in dbhistory
$processed = 'Update';
mysqli_query($conn,"INSERT INTO dbcustomerhistory(customerid,name,processed,dateprocessed,timeprocessed) VALUES ('$id','$username','$processed','$dateprocessed','$timeprocessed')");


echo "Update successfully.";

$conn->close();
?>
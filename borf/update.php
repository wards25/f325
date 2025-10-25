<?php
session_start();
require_once('require/returnlogin.php');
require_once('require/nocache.php');
include('db.php');

date_default_timezone_set("Asia/Manila");
$dateprocessed = date("Y-m-d");
$timeprocessed = date("H:i:s");

$username = $_SESSION['fname'];
$f325number = $_POST['f325number'];
$remarks = $_POST['remarks'];
$status = "PRINTED";

// update in dbborflist
mysqli_query($conn,"UPDATE dbborflist SET printremarks='$remarks',status='$status' WHERE f325number='$f325number' ");

// update in dbborfraw
mysqli_query($conn,"UPDATE dbborfraw SET status='$status' WHERE f325number='$f325number' ");

// insert into dbf325number
mysqli_query($conn,"INSERT INTO dbf325number(f325number,brcode,preparedby,issuedby,emaildate,f325date,vendor,tmnumber,drivername,platenumber,datesched,datecleared,arnumber,pageno,printremarks,logisticremarks,clearingremarks,cluster,location,status,process) SELECT f325number,brcode,preparedby,issuedby,emaildate,f325date,vendor,tmnumber,drivername,platenumber,datesched,datecleared,arnumber,pageno,printremarks,logisticremarks,clearingremarks,cluster,location,status,process FROM dbborflist WHERE f325number='$f325number' ");

// inser into dbraw
mysqli_query($conn,"INSERT INTO dbraw(f325number,mdccode,category,dmpiclass,quantity,expiration,unitcost,costextended,reasoncode,arnumber,arreason,dmpireason,rcvdqty,dmpiref,deductref,deductqty,deductcostextended,datecleared,pulloutref,location,status,statusout,paymentstatus) SELECT f325number,mdccode,category,dmpiclass,quantity,expiration,unitcost,costextended,reasoncode,arnumber,arreason,dmpireason,rcvdqty,dmpiref,deductref,deductqty,deductcostextended,datecleared,pulloutref,location,status,statusout,paymentstatus FROM dbborfraw WHERE f325number='$f325number' ");

// insert in dbhistory
$processed = 'Printed';
mysqli_query($conn,"INSERT INTO dbhistory(processnumber,name,processed,dateprocessed,timeprocessed) VALUES ('$f325number','$username','$processed','$dateprocessed','$timeprocessed')");

echo 'Update successfully!';

$conn->close();
?>
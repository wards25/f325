<?php
session_start();
include('db.php');

date_default_timezone_set("Asia/Manila");
$dateprocessed = date("Y-m-d");
$timeprocessed = date("H:i:s");

$username = $_SESSION['fname'];
$reference = $_POST['reference'];
$transact = $_POST['transact'];
$status = 'UPLOADED';

// update detail in dbdmpi
mysqli_query($conn,"UPDATE dbdmpi SET transactnumber='$transact',status='$status' WHERE reference='$reference' ");

// update detail in dbraw
mysqli_query($conn,"UPDATE dbraw SET status='$status',statusout='$status' WHERE dmpiref='$reference' ");

// insert in dbhistory
$processed = 'Update';
mysqli_query($conn,"INSERT INTO dbhistory(processnumber,name,processed,dateprocessed,timeprocessed) VALUES ('$reference','$username','$processed','$dateprocessed','$timeprocessed')");

echo 'Successfully update!';

$conn->close();
?>
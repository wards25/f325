<?php
session_start();
include('db.php');

$id = $_POST['id'];
$mdccode = $_POST['mdccode'];

// delete barcode
mysqli_query($conn,"DELETE FROM dbbarcode WHERE id='$id' ");
// date and time
date_default_timezone_set("Asia/Manila");
$dateprocessed = date("Y-m-d");
$timeprocessed = date("H:i:s");

$username = $_SESSION['fname'];

// insert in dbhistory
$processed = 'Delete Barcode';
mysqli_query($conn,"INSERT INTO dbproducthistory(mdccode,name,processed,dateprocessed,timeprocessed) VALUES ('$mdccode','$username','$processed','$dateprocessed','$timeprocessed')");

echo "Delete successfully!";

$conn->close();
?>
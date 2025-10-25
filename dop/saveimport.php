<?php
session_start();
include('db.php');

$dopnumber = $_POST['dopnumber'];
$user = $_SESSION['fname'];

// update status
mysqli_query($conn,"UPDATE dbdop SET status='UPLOADED' WHERE uploadnumber='$dopnumber' ");

//transfer upload
mysqli_query($conn,"INSERT INTO dbmdcdeduction(dbreference,collection,f325number,brcode,vendorcode,mdccode,category,quantity,unitcost,month,year,dopreference,status) SELECT dbreference,collection,f325number,brcode,vendorcode,mdccode,category,quantity,unitcost,month,year,dopreference,status FROM dbdopupload WHERE user='$user' AND dopreference='$dopnumber' ");

echo "Save successfully!";


$conn->close();
?>
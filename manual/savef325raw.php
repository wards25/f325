<?php
session_start();
require_once('require/returnlogin.php');
require_once('require/nocache.php');
include('db.php');

$ordernumber = $_POST['ordernumber'];
$code = $_POST['code'];
$vendorcode = $_POST['vendorcode'];
$mdccode = $_POST['mdccode'];
$bbd = $_POST['bbd'];
$reasoncode = strtoupper($_POST['reasoncode']);
$quantity = $_POST['quantity'];
$unitcost = $_POST['unitcost'];
$costextended = ($quantity * $unitprice);
// $cleared_time = date('H:i:s');

// get branch detail
$branch_query = mysqli_query($conn,"SELECT * FROM dbcensus WHERE code='$code' ");
$fetch_branch = mysqli_fetch_array($branch_query);
$location = $fetch_branch['location'];
$deducttype = $fetch_branch['deducttype'];

mysqli_query($conn,"INSERT INTO dbraw(f325number,mdccode,category,vendorcode,deducttype,dmpiclass,quantity,expiration,unitcost,costextended,reasoncode,arnumber,arreason,dmpireason,rcvdqty,dmpiref,deductref,deductqty,deductcostextended,datecleared,pulloutref,location,status,statusout,paymentstatus,skustatus,slstatus,skutype)VALUES('$ordernumber','$mdccode','','$vendorcode','$deducttype','','$quantity','$bbd','$unitcost','$costextended','$reasoncode','','','0','0','','','0','0','0000-00-00','','$location','CLEARED','','','0','','')");

$conn->close();
?>
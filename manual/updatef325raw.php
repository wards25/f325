<?php
session_start();
require_once('require/returnlogin.php');
require_once('require/nocache.php');
include('db.php');

$id = $_POST['id'];
$del = $_POST['del'];
$ordernumber = $_POST['ordernumber'];
$code = $_POST['code'];
$vendorcode = $_POST['vendorcode'];
$mdccode = $_POST['mdccode'];
$bbd = $_POST['bbd'];
$reasoncode = strtoupper($_POST['reasoncode']);
$quantity = $_POST['quantity'];
$unitcost = $_POST['unitcost'];
$costextended = ($quantity * $unitprice);

// get category
$category_query = mysqli_query($conn,"SELECT * FROM dbproduct WHERE mdccode='$mdccode' ");
$fetch_category = mysqli_fetch_array($category_query);
$category = $fetch_category['category'];

// get branch detail
$branch_query = mysqli_query($conn,"SELECT * FROM dbcensus WHERE code='$code' ");
$fetch_branch = mysqli_fetch_array($branch_query);
$location = $fetch_branch['location'];
$deducttype = $fetch_branch['deducttype'];

if ($id == '0')
{
	// insert into draw
	mysqli_query($conn,"INSERT INTO dbraw(f325number,mdccode,category,vendorcode,deducttype,dmpiclass,quantity,expiration,unitcost,costextended,reasoncode,arnumber,arreason,dmpireason,rcvdqty,dmpiref,deductref,deductqty,deductcostextended,datecleared,pulloutref,location,status,statusout,paymentstatus)VALUES('$ordernumber','$mdccode','$category','$vendorcode','$deducttype','','$quantity','$bbd','$unitcost','$costextended','$reasoncode','','','0','0','','','0','0','0000-00-00','','$location','CLEARED','','')");
}
else if($del == '1')
{
	// delete in dbraw
	mysqli_query($conn,"DELETE FROM dbraw WHERE id='$id' ");
}
else
{
	// update in dbraw
	mysqli_query($conn,"UPDATE dbraw SET f325number='$ordernumber',mdccode='$mdccode',quantity='$quantity',expiration='$bbd',unitcost='$unitcost',reasoncode='$reasoncode' WHERE id='$id' ");
}


$conn->close();
?>
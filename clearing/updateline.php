<?php
session_start();
require_once('require/returnlogin.php');
require_once('require/nocache.php');
include('db.php');

date_default_timezone_set("Asia/Manila");
$dateprocessed = date("Y-m-d");
$cleared_time = date('H:i:s');
$id = $_POST['id'];
$del = $_POST['del'];
$brcode = $_POST['brcode'];
$vcode = $_POST['vcode'];
$location = $_POST['loc'];
$f325number = $_POST['f325number'];
$mdccode = $_POST['mdccode'];
$expiration = $_POST['expiration'];
$reasoncode = $_POST['reasoncode'];
$quantity = $_POST['quantity'];
$rcvdqty = $_POST['rcvdqty'];
$unitcost = $_POST['unitcost'];
$costextended = $_POST['costextended'];
$arreason = $_POST['arreason'];
$status = 'CLEARED';

if ($_POST['arreason'] == ''){$arnumber = '';}else{$arnumber = $_POST['arnumber'];}
if (empty($_POST['dmpireason'])){$dmpireason = '0';}else{$dmpireason = $_POST['dmpireason'];}

// get category
$category_query = mysqli_query($conn,"SELECT * FROM dbproduct WHERE mdccode='$mdccode' AND vendor='$vcode' AND active='1' ");
$fetch_category = mysqli_fetch_array($category_query);
if (is_array($fetch_category))
{
	$category = $fetch_category['category'];
	$dmpiclass = $fetch_category['dmpiclassification'];
}
else
{
	$category = '';
	$dmpiclass = '';
}

if ($id == '0')
{
	// insert into draw
	mysqli_query($conn,"INSERT INTO dbraw(f325number,mdccode,category,vendorcode,deducttype,dmpiclass,quantity,expiration,unitcost,costextended,reasoncode,arnumber,arreason,dmpireason,rcvdqty,dmpiref,deductref,deductqty,deductcostextended,datecleared,pulloutref,location,status,statusout,paymentstatus,skustatus,slstatus,skutype) VALUES ('$f325number','$mdccode','$category','$vcode','$brcode','$dmpiclass','$quantity','$expiration','$unitcost','$costextended','$reasoncode','$arnumber','$arreason','$dmpireason','$rcvdqty','','','0','0.00','$dateprocessed','','$location','$status','$status','','0','','')");
}
elseif ($del == '1')
{
	// delete into dbraw
	mysqli_query($conn,"DELETE FROM dbraw WHERE id='$id' ");
}
else
{
	// update in dbraw
	mysqli_query($conn,"UPDATE dbraw SET category='$category',arnumber='$arnumber',arreason='$arreason',mdccode='$mdccode',expiration='$expiration',dmpireason='$dmpireason',dmpiclass='$dmpiclass',reasoncode='$reasoncode',quantity='$quantity',rcvdqty='$rcvdqty',unitcost='$unitcost',costextended='$costextended',datecleared='$dateprocessed',status='$status',statusout='$status' WHERE id='$id' ");
}


$conn->close();
?>
<?php
session_start();
require_once('require/returnlogin.php');
require_once('require/nocache.php');
include('db.php');

date_default_timezone_set("Asia/Manila");
$dateprocessed = date("Y-m-d");

$id = $_POST['id'];
$rcvdqty = $_POST['rcvdqty'];
$expiration = $_POST['expiration'];
$dmpireason = $_POST['dmpireason'];
$reasoncode = $_POST['reasoncode'];
$arreason = $_POST['arreason'];
$status = "FOR PAYMENT";

if ($_POST['arreason'] == '')
{
	$arreason = '';
	$paymentstatus = '';
}
else
{
	$arnumber = $_POST['arnumber'];
	$paymentstatus = "FOR PAYMENT";
}

// update in dbraw
mysqli_query($conn,"UPDATE dbraw SET status='$status',arnumber='$arnumber',arreason='$arreason',paymentstatus='$paymentstatus',expiration='$expiration',dmpireason='$dmpireason',reasoncode='$reasoncode',rcvdqty='$rcvdqty' WHERE id='$id' ");

$conn->close();
?>
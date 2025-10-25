<?php
session_start();
require_once('require/returnlogin.php');
require_once('require/nocache.php');
include('db.php');

date_default_timezone_set("Asia/Manila");
$dateprocessed = date("Y-m-d");

$id = $_POST['id'];
$dmpireason = $_POST['dmpireason'];
$reasoncode = $_POST['reasoncode'];
$quantity = $_POST['quantity'];
$unitcost = $_POST['unitcost'];
$costextended = $_POST['costextended'];
$status = 'OKFORDEDUCT';

// update in dbraw
mysqli_query($conn,"UPDATE dbraw SET dmpireason='$dmpireason',reasoncode='$reasoncode',quantity='$quantity',unitcost='$unitcost',costextended='$costextended',status='$status' WHERE id='$id' ");


$conn->close();
?>
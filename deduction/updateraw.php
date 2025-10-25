<?php
session_start();
require_once('require/returnlogin.php');
include('db.php');

$id = $_POST['id'];
$reference = $_POST['reference'];
$f325number = $_POST['f325number'];
$mdccode = $_POST['mdccode'];
$quantity = $_POST['quantity'];
$unitcost = $_POST['unitcost'];
$status = $_POST['status'];

// update in dbf325number
mysqli_query($conn,"UPDATE dbf325number SET status='DEDUCTED' WHERE f325number='$f325number' ");

// update dbraw
mysqli_query($conn,"UPDATE dbraw SET deductref='$reference',deductqty='$quantity',deductcostextended='$unitcost',status='$status' WHERE id='$id' ");

// update dbmdcdeduction
mysqli_query($conn,"UPDATE dbmdcdeduction SET status='$status',dbreference='$reference' WHERE f325number='$f325number' AND mdccode='$mdccode' ");


$conn->close();
?>
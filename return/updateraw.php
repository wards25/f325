<?php
require_once('require/returnlogin.php');
require_once('require/nocache.php');
include('db.php');

$id = $_POST['id'];
$reference = $_POST['reference'];
$status = $_POST['status'];

// update dbstock
mysqli_query($conn,"UPDATE dbraw SET pulloutref='$reference',statusout='$status' WHERE id='$id' ");

$conn->close();
?>
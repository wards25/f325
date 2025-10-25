<?php
session_start();
require_once('require/returnlogin.php');
require_once('require/nocache.php');
include('db.php');

$id = $_POST['id'];
$status = 'FOR PAYMENT';

// update in dbraw
mysqli_query($conn,"UPDATE dbraw SET status='$status',paymentstatus='$status' WHERE id='$id' ");

$conn->close();
?>
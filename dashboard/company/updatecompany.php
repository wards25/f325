<?php
include('db.php');

$id = $_POST['id'];
$name = strtoupper($_POST['name']);
$nickname = strtoupper($_POST['nickname']);
$vendorcode = $_POST['vendorcode'];
$referencecode = $_POST['referencecode'];
$address = $_POST['address'];

if (isset($_POST['bypass'])){$bypass = $_POST['bypass'];}else{$bypass = '0';}

if (isset($_POST['active'])){$active = $_POST['active'];}else{$active = '0';}

// update dbcompany
mysqli_query($conn,"UPDATE dbcompany SET name='$name',nickname='$nickname',vendorcode='$vendorcode',refcode='$referencecode',address='$address',bypass='$bypass',active='$active' WHERE id='$id' ");

$conn->close();
?>
<?php
include('db.php');

$id = $_POST['id'];
$msg = $_POST['msg'];
if (isset($_POST['session'])){$session = '1';}else{$session = '0';}
if (isset($_POST['announcement'])){$announcement = '1';}else{$announcement = '0';}


// update location
mysqli_query($conn,"UPDATE dbmaintenance SET sessiondestroy='$session',announcementactive='$announcement',systemmsg='$msg' WHERE id='$id' ");

echo "Update successfully!";

$conn->close();
?>
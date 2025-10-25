<?php
include('db.php');

$username = $_POST['username'];
$newpassword = $_POST['newpassword'];

// change password
mysqli_query($conn,"UPDATE dbuser SET password='$newpassword' WHERE username='$username' ");

$conn->close();
?>
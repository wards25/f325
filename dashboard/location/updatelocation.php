<?php
include('db.php');

$id = $_POST['id'];
$value = $_POST['value'];
if (isset($_POST['active'])){$active = '1';}else{$active = '0';}


// update location
mysqli_query($conn,"UPDATE dblocation SET location='$value',active='$active' WHERE id='$id' ");

$conn->close();
?>
<?php
session_start();
include('db.php');

$value = $_POST['dataType'];
$batch = $_SESSION['batch'];

$row_query = mysqli_query($conn,"SELECT count(*) as totalrow FROM $value WHERE batch='$batch' ");
$fetch_row = mysqli_fetch_assoc($row_query);

echo $fetch_row['totalrow'];
?>
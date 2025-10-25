<?php
session_start();
include('db.php');

$user = $_SESSION['fname'];

$delquery = mysqli_query($conn,"DELETE FROM dbdopupload WHERE user='$user' ");

$alterquery = mysqli_query($conn,"ALTER TABLE dbdopupload AUTO_INCREMENT = 0");

$conn->close();
?>
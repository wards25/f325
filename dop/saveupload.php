<?php
session_start();
include('db.php');

$uploadnumber = $_POST['uploadnumber'];
$month = $_POST['month'];
$company = $_POST['company'];
$year = $_POST['year'];
$crnumber = $_POST['crnumber'];
$user = $_SESSION['fname'];
$status = $_POST['status'];

// check if CR number is already exist
$check_query = mysqli_query($conn,"SELECT collectionnumber,vendorcode,month,year FROM dbdop WHERE collectionnumber='$crnumber' AND vendorcode='$company' AND month='$month' AND year='$year' AND (status='UPLOADED' OR status='DRAFT') ");
$fetch_check = mysqli_fetch_array($check_query);

if (is_array($fetch_check))
{
	echo 'This DOP is exist.';
}
else
{
	// insert data
	$insert_query = mysqli_query($conn,"INSERT INTO dbdop(uploadnumber,collectionnumber,vendorcode,month,year,uploadby,status) VALUES ('$uploadnumber','$crnumber','$company','$month','$year','$user','$status') ");
}

$conn->close();
?>
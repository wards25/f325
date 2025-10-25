<?php
include('db.php');

$id = $_POST['id'];
$reference = $_POST['reference'];
$status = $_POST['status'];

// get f325number by id
$get_query = mysqli_query($conn,"SELECT id,f325number FROM dbraw WHERE id='$id' ");
$fetch_get = mysqli_fetch_array($get_query);

if (is_array($fetch_get))
{
	$f325number = $fetch_get['f325number'];

	// update db f325number
	mysqli_query($conn,"UPDATE dbf325number SET status='DEDUCTED' WHERE f325number='$f325number' ");
}

// update raw
mysqli_query($conn,"UPDATE dbraw SET dmpiref='$reference',status='$status',statusout='$status' WHERE id='$id' ");


$conn->close();
?>
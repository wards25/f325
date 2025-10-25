<?php
include('db.php');

$id = $_POST['id'];

// get detail
$detail_query = mysqli_query($conn,"SELECT * FROM dbdop WHERE id='$id' ");
$fetch_detail = mysqli_fetch_array($detail_query);

$dopnumber = $fetch_detail['uploadnumber'];
$crnumber = $fetch_detail['collectionnumber'];
$vendorcode = $fetch_detail['vendorcode'];
$month = $fetch_detail['month'];
$year = $fetch_detail['year'];
$uploadby = $fetch_detail['uploadby'];
$status = $fetch_detail['status'];

echo json_encode(array(
	'dopnumber' => $dopnumber,
	'vendorcode' => $vendorcode,
	'month' => $month,
	'year' => $year,
	'uploadby' => $uploadby,
	'crnumber' => $crnumber,
	'status' => $status
));

$conn->close();
?>
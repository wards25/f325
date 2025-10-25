<?php
include('db.php');

$id = $_POST['id'];

$detail_query = mysqli_query($conn,"SELECT * FROM dbcensus WHERE id='$id' ");
$fetch_detail = mysqli_fetch_array($detail_query);

$id = $fetch_detail['id'];
$code = $fetch_detail['code'];
$branchname = $fetch_detail['branchname'];
$shipping = $fetch_detail['shipping'];
$billing = $fetch_detail['billing'];
$franchise = $fetch_detail['franchise'];
$region = $fetch_detail['region'];
$cluster = $fetch_detail['cluster'];
$deducttype = $fetch_detail['deducttype'];
$location = $fetch_detail['location'];
$status = $fetch_detail['status'];

echo json_encode(array(
	'id' => $id,
	'code' => $code,
	'branchname' => $branchname,
	'shipping' => $shipping,
	'billing' => $billing,
	'franchise' => $franchise,
	'region' => $region,
	'cluster' => $cluster,
	'deducttype' => $deducttype,
	'location' => $location,
	'status' => $status
));

$conn->close();
?>
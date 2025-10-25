<?php
include('db.php');

$id = $_POST['id'];

// get detail
$detail_query = mysqli_query($conn,"SELECT * FROM dbfordeduction WHERE id='$id'");
$fetch_detail = mysqli_fetch_array($detail_query);

$reference = $fetch_detail['reference'];
$principal = $fetch_detail['principal'];
$vcode = $fetch_detail['company'];

// get vendor
$vname_query = mysqli_query($conn,"SELECT * FROM dbcompany WHERE vendorcode='$vcode' ");
$fetch_vname = mysqli_fetch_array($vname_query);
$vendorname = $fetch_vname['name'];

$preparedby = $fetch_detail['preparedby'];
$dateprocessed = $fetch_detail['dateprocessed'];
$remarks = $fetch_detail['remarks'];
$status = $fetch_detail['status'];

echo json_encode(array(
	'reference' => $reference,
	'principal' => $principal,
	'company' => $vendorname,
	'vcode' => $vcode,
	'preparedby' => $preparedby,
	'dateprocessed' => $dateprocessed,
	'remarks' => $remarks,
	'status' => $status
));

$conn->close();
?>
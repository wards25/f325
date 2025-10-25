<?php
require_once('require/nocache.php');
include('db.php');

$id = $_POST['id'];

$detail_query = mysqli_query($conn,"SELECT * FROM dbf325number WHERE id='$id' ");
$fetch_detail = mysqli_fetch_array($detail_query);

$f325number = $fetch_detail['f325number'];
$f325date = $fetch_detail['f325date'];
$emaildate = $fetch_detail['emaildate'];

$brcode = $fetch_detail['brcode'];
// get branch name
$brname_query = mysqli_query($conn,"SELECT * FROM dbcensus WHERE code='$brcode' ");
$fetch_brname = mysqli_fetch_array($brname_query);
if (is_array($fetch_brname))
{
	$branchname = $fetch_brname['franchise'].' '.$brcode.' - '.$fetch_brname['branchname'];
}
else
{
	$branchname = $brcode;
}


$vcode = $fetch_detail['vendor'];
// get vendor
$vname_query = mysqli_query($conn,"SELECT * FROM dbcompany WHERE vendorcode='$vcode' ");
$fetch_vname = mysqli_fetch_array($vname_query);
$vendorname = $fetch_vname['name'];

$preparedby = $fetch_detail['preparedby'];
$issuedby = $fetch_detail['issuedby'];
$tmnumber = $fetch_detail['tmnumber'];
$driver = $fetch_detail['drivername'];
$platenumber = $fetch_detail['platenumber'];
$arnumber = $fetch_detail['arnumber'];
$pageno = $fetch_detail['pageno'];
$remarks = $fetch_detail['clearingremarks'];
$location = $fetch_detail['location'];
$status = $fetch_detail['status'];

echo json_encode(array(
	'f325number' => $f325number,
	'f325date' => $f325date,
	'emaildate' => $emaildate,
	'branchname' => $branchname,
	'vendorname' => $vendorname,
	'vcode' => $vcode,
	'preparedby' => $preparedby,
	'issuedby' => $issuedby,
	'tmnumber' => $tmnumber,
	'driver' => $driver,
	'platenumber' => $platenumber,
	'arnumber' => $arnumber,
	'pageno' => $pageno,
	'remarks' => $remarks,
	'location' => $location,
	'status' => $status
));

$conn->close();
?>
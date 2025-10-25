<?php
require_once('require/nocache.php');
include('db.php');

$refcode = $_POST['refcode'];

// get last reference number
$last_reference = mysqli_query($conn,"SELECT * FROM dbpullout WHERE refcode='$refcode' ORDER BY id DESC LIMIT 1");
$fetch_last_reference = mysqli_fetch_array($last_reference);

if (is_array($fetch_last_reference))
{
	$last_number = explode('-', $fetch_last_reference['reference']);
	echo date("y").'-'.($last_number[count($last_number)-1]+1);
}
else
{
	echo date("y").'-'.$refcode.'001';
}

$conn->close();
?>
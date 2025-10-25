<?php
include('db.php');

// get last reference number
$last_reference = mysqli_query($conn,"SELECT * FROM dbdmpi ORDER BY id DESC LIMIT 1");
$fetch_last_reference = mysqli_fetch_array($last_reference);

if (is_array($fetch_last_reference))
{
	$last_number = explode('-', $fetch_last_reference['reference']);
	echo 'B-'.date("Ymd").'-'.($last_number[count($last_number)-1]+1);
}
else
{
	echo 'B-'.date("Ymd").'-1';
}

$conn->close();
?>
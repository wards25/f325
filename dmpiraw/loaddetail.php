<?php
include('db.php');

$id = $_POST['id'];

// load detail
$detail_query = mysqli_query($conn,"SELECT * FROM dbdmpi WHERE id='$id'");
$fetch_detail = mysqli_fetch_array($detail_query);

$reference = $fetch_detail['reference'];
$classification = $fetch_detail['classification'];
$transactnumber = $fetch_detail['transactnumber'];
$status = $fetch_detail['status'];

echo json_encode(array(
	'reference' => $reference,
	'classification' => $classification,
	'transactnumber' => $transactnumber,
	'status' => $status
));


$conn->close();
?>
<?php
include('db.php');

$id = $_POST['id'];

$detail_query = mysqli_query($conn,"SELECT * FROM dbproduct WHERE id='$id' ");
$fetch_detail = mysqli_fetch_array($detail_query);

$id = $fetch_detail['id'];
$mdccode = $fetch_detail['mdccode'];
$itemcode = $fetch_detail['itemcode'];
$description = $fetch_detail['description'];
$category = $fetch_detail['category'];
$vendor = $fetch_detail['vendor'];
$dmpicode = $fetch_detail['dmpicode'];
$dmpipack = $fetch_detail['dmpipack'];
$dmpiclass = $fetch_detail['dmpiclassification'];
$uom = $fetch_detail['uom'];
$status = $fetch_detail['active'];

echo json_encode(array(
	'id' => $id,
	'mdccode' => $mdccode,
	'itemcode' => $itemcode,
	'description' => $description,
	'category' => $category,
	'vendor' => $vendor,
	'dmpicode' => $dmpicode,
	'dmpipack' => $dmpipack,
	'dmpiclass' => $dmpiclass,
	'uom' => $uom,
	'status' => $status
));

$conn->close();
?>
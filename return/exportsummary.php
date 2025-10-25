<?php
session_start();
include('db.php');

//mime type
header('Content-Type: text/csv');
//tell browser what's the file name
header('Content-Disposition: attachment; filename="Pull Out Summary as of '.date('m-d-Y').'.csv"');
//no cache
header('Cache-Control: max-age=0');

$output = fopen('php://output', 'w');

fputcsv($output,array('BRANCH NAME','F325 NUMBER','DESCRIPTION','QUANTITY','UOM','COST EXTENDED'));

date_default_timezone_set("Asia/Manila");

$startdate = "2019-01-01";
$enddate = date('Y-m-d',(strtotime ( '-1 day' ,strtotime (date("Y-m-d")))));

$category = $_POST['export_category'];
if ($category == 'DMPI')
{
	$status = "UPLOADED";
}
else
{
	$status = "CLEARED";
}

$stockcount_query = "SELECT * FROM dbraw WHERE category='$category' AND statusout='$status' AND datecleared BETWEEN '$startdate' AND '$enddate' ";

// get location
if (strlen($_POST['export_location']) >= '1')
{
	$location = $_POST['export_location'];

	$stockcount_query .= "AND location='$location' ";
}
else
{
	// location
	$location = "location='' ";

	for ($i=1; $i <= 10 ; $i++)
	{ 
		// get location
		$list_query = mysqli_query($conn,"SELECT * FROM dblocation WHERE id='$i' ");
		$fetch_list = mysqli_fetch_array($list_query);

		if($_SESSION['loc'.$fetch_list['id']]){$location .= "OR location='".$fetch_list['location']."'";}
	}

	$stockcount_query .= "AND (".$location.") ";
}

$stockcount_query .= "ORDER BY f325number ASC";

// get dbraw
$stock_query = mysqli_query($conn,$stockcount_query);
while ($fetch_stock = mysqli_fetch_array($stock_query))
{
	$f325number = $fetch_stock['f325number'];
	// get f325 detail
	$f325_query = mysqli_query($conn,"SELECT * FROM dbf325number WHERE f325number='$f325number' ");
	$fetch_f325number = mysqli_fetch_array($f325_query);

	if (is_array($fetch_f325number)){$brcode = $fetch_f325number['brcode'];}else{$brcode = 'BR Code not Found!';}

	// branch detail
	$branch_query = mysqli_query($conn,"SELECT * FROM dbcensus WHERE code='$brcode' ");
	$fetch_branch = mysqli_fetch_array($branch_query);

	if (is_array($fetch_branch)){$branchname = $fetch_branch['franchise'].' '.$fetch_branch['code'].' - '.$fetch_branch['branchname'];}else{$branchname = 'Branch Detail not found.';}

	$mdccode = $fetch_stock['mdccode'];

	// product detail
	$product_query = mysqli_query($conn,"SELECT * FROM dbproduct WHERE mdccode='$mdccode' ");
	$fetch_product = mysqli_fetch_array($product_query);

	if (is_array($fetch_product)){$productdetail = $fetch_product['mdccode'].' -- '.$fetch_product['description'];}else{$productdetail = "Product Detail not found";}

	$quantity = $fetch_stock['quantity'];

	if ($quantity >= '2'){$uom = 'PCS';}else{$uom = 'PC';}

	fputcsv($output, array($branchname,"'".$f325number,$productdetail,$quantity,$uom,$fetch_stock['costextended']));
}

fclose($output);

$conn->close();
?>
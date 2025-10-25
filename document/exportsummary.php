<?php
session_start();
include('db.php');

$reference = $_POST['export_reference'];
$vcode = $_POST['export_vcode'];
//mime type
header('Content-Type: text/csv');
//tell browser what's the file name
header('Content-Disposition: attachment; filename="REF # '.$reference.' Summary.csv"');
//no cache
header('Cache-Control: max-age=0');

$output = fopen('php://output', 'w');

fputcsv($output,array('Month','BR CODE','BRANCH NAME','REGION','F325 NUMBER','MDC CODE','DESCRIPTION','BBD','REASON CODE','QUANTITY','UOM','COST EXTENDED'));

// dbraw
$raw_query = mysqli_query($conn,"SELECT * FROM dbraw WHERE deductref='$reference' ");
while ($fetch_raw = mysqli_fetch_array($raw_query))
{
	$f325number = $fetch_raw['f325number'];
	$bbd = $fetch_raw['expiration'];
	$reasoncode = $fetch_raw['reasoncode'];
	$quantity = $fetch_raw['deductqty'];
	$cost_extend = $fetch_raw['deductcostextended'];

	// get month in dbmdcdeduction
	$deduction_query = mysqli_query($conn,"SELECT * FROM dbmdcdeduction WHERE f325number='$f325number' ");
	$fetch_deduction = mysqli_fetch_array($deduction_query);
	if (is_array($fetch_deduction))
	{
		$monthyear = date("M", mktime(0, 0, 0, $fetch_deduction['month'], 10)).'-'.$fetch_deduction['year'];
	}
	else
	{
		$monthyear = '';
	}

	// get f325 detail
	$detail_query = mysqli_query($conn,"SELECT * FROM dbf325number WHERE f325number='$f325number' ");
	$fetch_detail = mysqli_fetch_array($detail_query);
	$brcode = $fetch_detail['brcode'];

	// get region and branch name
	$census_query = mysqli_query($conn,"SELECT code,branchname,region FROM dbcensus WHERE code='$brcode' ");
	$fetch_census = mysqli_fetch_array($census_query);
	$branchname = $fetch_census['branchname'];
	$region = $fetch_census['region'];

	$mdccode = $fetch_raw['mdccode'];
	$product_query = mysqli_query($conn,"SELECT * FROM dbproduct WHERE mdccode='$mdccode' AND vendor='$vcode' AND active='1' ");
	$fetch_product = mysqli_fetch_array($product_query);
	if (is_array($fetch_product))
	{
		$description = $fetch_product['description'];
		$uom = $fetch_product['uom'];
	}
	else
	{
		$description = "Fill up";
		$uom = "";
	}

	if ($quantity >= 2)
	{
		$unit = $uom.'S';
	}
	else
	{
		$unit = $uom;
	}

	fputcsv($output, array($monthyear,$brcode,$branchname,$region,"'".$f325number,$mdccode,$description,$bbd,$reasoncode,$quantity,$unit,$cost_extend));
}

fclose($output);

$conn->close();
?>
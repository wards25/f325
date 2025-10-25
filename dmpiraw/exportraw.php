<?php 
include('db.php');

$reference = $_GET['reference'];

//mime type
header('Content-Type: text/csv');
//tell browser what's the file name
header('Content-Disposition: attachment; filename="DMPI Raw'.$reference.'.csv"');
//no cache
header('Cache-Control: max-age=0');

$output = fopen('php://output', 'w');

fputcsv($output, array('DMPI CODE','QUANTITY','REASON','EXPIRATION'));

// dbraw
$export_query = mysqli_query($conn,"SELECT * FROM dbraw WHERE dmpiref='$reference' ");
while ($fetch_export = mysqli_fetch_array($export_query))
{
	$mdccode = $fetch_export['mdccode'];
	$expiration = str_replace(array('/','-'),' ', $fetch_export['expiration']);

	// get dmpi code
	$prd_query = mysqli_query($conn,"SELECT * FROM dbproduct WHERE mdccode='$mdccode' ");
	$fetch_prd = mysqli_fetch_array($prd_query);

	fputcsv($output,array($fetch_prd['dmpicode'],$fetch_export['quantity'],$fetch_export['dmpireason'],$expiration));
}

fclose($output);

$conn->close();
?>
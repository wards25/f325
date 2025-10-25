<?php
include('db.php');

$id = $_POST['id'];

if ($id == 'addnew')
{
	$username = '';
	$password = '';
	$fname = '';
	$admin = '';
	$semiadmin = '';
	$comp1 = '';
	$comp2 = '';
	$comp3 = '';
	$comp4 = '';
	$comp5 = '';
	$comp6 = '';
	$comp7 = '';
	$comp8 = '';
	$comp9 = '';
	$comp10 = '';
	$loc1 = '';
	$loc2 = '';
	$loc3 = '';
	$loc4 = '';
	$loc5 = '';
	$loc6 = '';
	$loc7 = '';
	$loc8 = '';
	$loc9 = '';
	$loc10 = '';
	$store = '';
	$inventory = '';
	$import = '';
	$importdop = '';
	$print = '';
	$schedule = '';
	$clearing = '';
	$manual = '';
	$fordeduct = '';
	$borfapps = '';
	$dmpiraw = '';
	$deduction = '';
	$deductdoc = '';
	$paiddeduction = '';
	$payment = '';
	$rts = '';
	$pulloutdoc = '';
	$report = '';
	$syssetting = '';
	$active = '';
}
else
{
	$detail_query = mysqli_query($conn,"SELECT * FROM dbuser WHERE id='$id' ");
	$fetch_detail = mysqli_fetch_array($detail_query);

	$username = $fetch_detail['username'];
	$password = $fetch_detail['password'];
	$fname = $fetch_detail['fname'];
	$admin = $fetch_detail['admin'];
	$semiadmin = $fetch_detail['semiadmin'];
	$comp1 = $fetch_detail['comp1'];
	$comp2 = $fetch_detail['comp2'];
	$comp3 = $fetch_detail['comp3'];
	$comp4 = $fetch_detail['comp4'];
	$comp5 = $fetch_detail['comp5'];
	$comp6 = $fetch_detail['comp6'];
	$comp7 = $fetch_detail['comp7'];
	$comp8 = $fetch_detail['comp8'];
	$comp9 = $fetch_detail['comp9'];
	$comp10 = $fetch_detail['comp10'];
	$loc1 = $fetch_detail['loc1'];
	$loc2 = $fetch_detail['loc2'];
	$loc3 = $fetch_detail['loc3'];
	$loc4 = $fetch_detail['loc4'];
	$loc5 = $fetch_detail['loc5'];
	$loc6 = $fetch_detail['loc6'];
	$loc7 = $fetch_detail['loc7'];
	$loc8 = $fetch_detail['loc8'];
	$loc9 = $fetch_detail['loc9'];
	$loc10 = $fetch_detail['loc10'];
	$store = $fetch_detail['store'];
	$inventory = $fetch_detail['inventory'];
	$import = $fetch_detail['import'];
	$importdop = $fetch_detail['importdop'];
	$print = $fetch_detail['print'];
	$schedule = $fetch_detail['schedule'];
	$clearing = $fetch_detail['clearing'];
	$manual = $fetch_detail['manual'];
	$fordeduct = $fetch_detail['fordeduct'];
	$borfapps = $fetch_detail['borfapps'];
	$dmpiraw = $fetch_detail['dmpiraw'];
	$deduction = $fetch_detail['deduction'];
	$deductdoc = $fetch_detail['deductdoc'];
	$paiddeduction = $fetch_detail['paiddeduction'];
	$payment = $fetch_detail['payment'];
	$rts = $fetch_detail['returntosupplier'];
	$pulloutdoc = $fetch_detail['pulloutdoc'];
	$report = $fetch_detail['report'];
	$syssetting = $fetch_detail['syssetting'];
	$active = $fetch_detail['active'];
}

echo json_encode(array(
	'username' => $username,
	'password' => $password,
	'fname' => $fname,
	'admin' => $admin,
	'semiadmin' => $semiadmin,
	'comp1' => $comp1,
	'comp2' => $comp2,
	'comp3' => $comp3,
	'comp4' => $comp4,
	'comp5' => $comp5,
	'comp6' => $comp6,
	'comp7' => $comp7,
	'comp8' => $comp8,
	'comp9' => $comp9,
	'comp10' => $comp10,
	'loc1' => $loc1,
	'loc2' => $loc2,
	'loc3' => $loc3,
	'loc4' => $loc4,
	'loc5' => $loc5,
	'loc6' => $loc6,
	'loc7' => $loc7,
	'loc8' => $loc8,
	'loc9' => $loc9,
	'loc10' => $loc10,
	'store' => $store,
	'inventory' => $inventory,
	'import' => $import,
	'importdop' => $importdop,
	'print' => $print,
	'schedule' => $schedule,
	'clearing' => $clearing,
	'manual' => $manual,
	'fordeduct' => $fordeduct,
	'borfapps' => $borfapps,
	'dmpiraw' => $dmpiraw,
	'deduction' => $deduction,
	'deductdoc' => $deductdoc,
	'paiddeduction' => $paiddeduction,
	'payment' => $payment,
	'rts' => $rts,
	'pulloutdoc' => $pulloutdoc,
	'report' => $report,
	'syssetting' => $syssetting,
	'active' => $active
));

$conn->close();
?>
<?php
include('db.php');

$reference = $_GET['reference'];

// get reference detail
$reference_query = mysqli_query($conn,"SELECT * FROM dbpullout WHERE reference='$reference' ");
$fetch_reference = mysqli_fetch_array($reference_query);
$company = $fetch_reference['company'];

// get vendor
$vname_query = mysqli_query($conn,"SELECT * FROM dbcompany WHERE vendorcode='$company' ");
$fetch_vname = mysqli_fetch_array($vname_query);
$vendorname = $fetch_vname['name'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="expires" content="Sun, 01 Jan 2014 00:00:00 GMT"/>
	<meta http-equiv="pragma" content="no-cache" />
	<title>Print Pull-Out Summary</title>
	<link rel="icon" type="img/png" href="icon/rsdi.png">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/index.js"></script>
</head>
<body>
	<input type="hidden" class="input-reference" value="<?php echo $reference; ?>">
	<input type="hidden" class="input-vcode" value="<?php echo $company; ?>">
	<table class="tbl-border">
		<tr>
			<th class="tbl-border-th">PULL-OUT SUMMARY</th>
		</tr>
		<tr>
			<td class="tbl-border-td1">
				<table class="tbl-supplier">
					<tr>
						<th class="tbl-supplier-th">Principal Name:</th>
						<td class="tbl-supplier-td"><?php echo $fetch_reference['principal'];?></td>
					</tr>
					<tr>
						<th class="tbl-supplier-th">Company:</th>
						<td class="tbl-supplier-td"><?php echo $vendorname;?></td>
					</tr>
					<tr>
						<th class="tbl-supplier-th">Prepared By:</th>
						<td class="tbl-supplier-td"><?php echo $fetch_reference['preparedby'];?></td>
					</tr>
				</table>
				<table class="tbl-reference">
					<tr>
						<th class="tbl-reference-th">Reference #:</th>
						<td class="tbl-reference-td"><?php echo $reference ?></td>
					</tr>
					<tr>
						<th class="tbl-reference-th">Date Processed:</th>
						<td class="tbl-reference-td"><?php echo date("m-d-Y",strtotime($fetch_reference['dateprocessed'])); ?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<hr>
			</td>
		</tr>
		<tr>
			<td class="tbl-border-td2">
				<table class="tbl-sku">
					<tr>
						<th class="tbl-sku-th tbl-sku-th1">Branch Name</th>
						<th class="tbl-sku-th tbl-sku-th2">F325 Number</th>
						<th class="tbl-sku-th tbl-sku-th3">Description</th>
						<th class="tbl-sku-th tbl-sku-th4">Quantity</th>
						<th class="tbl-sku-th tbl-sku-th5">UoM</th>
						<th class="tbl-sku-th tbl-sku-th6">Cost Extended</th>
					</tr>
					<tbody class="tbl-sku-list"></tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<hr>
			</td>
		</tr>
		<tr>
			<td class="tbl-border-td3">
				<table class="tbl-subtotal">
					<tr>
						<th class="tbl-subtotal-th1" rowspan="3">Remarks:</th>
						<td class="tbl-subtotal-td1" rowspan="3">
							<textarea class="textarea-style" disabled="disabled"><?php echo $fetch_reference['remarks'];?></textarea>
						</td>
						<td style="width: 5vw;" rowspan="3"></td>
						<th class="tbl-subtotal-th">Subtotal:</th>
						<td class="tbl-subtotal-td">
							<input type="text" class="input-withBorder input-subtotal" disabled="disabled">
						</td>
					</tr>
					<tr>
						<th class="tbl-subtotal-th">Total Qty:</th>
						<td class="tbl-subtotal-td">
							<input type="text" class="input-withBorder input-totalqty" disabled="disabled">
						</td>
					</tr>
					<tr>
						<th class="tbl-subtotal-th"></th>
						<td class="tbl-subtotal-td"></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td class="tbl-border-td4">
				<table class="tbl-acknowledge">
					<tr>
						<td class="tbl-acknowledge-td1"></td>
					</tr>
					<tr>
						<td>
							<input type="text" class="input-drivername" disabled="disabled">
						</td>
					</tr>
					<tr>
						<td class="tbl-acknowledge-td2">Name of Driver</td>
					</tr>
					<tr>
						<td>
							<input type="text" class="input-plateno" disabled="">
						</td>
					</tr>
					<tr>
						<td class="tbl-acknowledge-td2">Plate #</td>
					</tr>
				</table>
				<br/>
			</td>
		</tr>
	</table>
</body>
</html>
<?php $conn->close();?>
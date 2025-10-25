<?php
session_start();
require_once('require/returnlogin.php');
require_once('require/sessiondestroy.php');
include('db.php');
require_once('require/access.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="expires" content="Sun, 01 Jan 2014 00:00:00 GMT"/>
	<meta http-equiv="pragma" content="no-cache" />
	<title>Print Deduction</title>
	<link rel="icon" type="img/png" href="icon/rsdi.png">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/index.js"></script>
</head>
<body>
	<table class="tbl-border">
		<tr>
			<td class="tbl-border-td1 tbl-border-menu">
				<button type="button" class="button-style button-menu"></button>
				<span class="span-text-menu">Menu</span>
				<div class="div-menu-list">
					<button type="button" class="button-style-menu-list" onclick="window.location.href='/dashboard'">DASHBOARD</button>
					<button type="button" class="button-style-menu-list" onclick="window.location.href='logout.php'">LOGOUT</button>
				</div>
			</td>
			<td class="tbl-border-td1"></td>
		</tr>
		<tr>
			<td class="tbl-border-td2" colspan="2">
				<label class="lbl-style">Company:</label>
				<select class="select-withBorder select-company" onchange="LoadList();">
					<option value="">All</option>
					<?php
					$company_query = "SELECT * FROM dbcompany WHERE active='1' ";

					// company
					$company = "vendorcode='' ";

					for ($i = 1; $i <= 10; $i++)
					{
						//get vendor code of company
						$vendorcode_query = mysqli_query($conn,"SELECT * FROM dbcompany WHERE id='$i' ");
						$fetch_vendorcode = mysqli_fetch_array($vendorcode_query);

						if ($_SESSION['comp'.$fetch_vendorcode['id']]){$company .= "OR vendorcode='".$fetch_vendorcode['vendorcode']."'";} 
					}

					$company_query .= "AND (".$company.") ";

					$vendor_query = mysqli_query($conn,$company_query);
					while ($fetch_vendor = mysqli_fetch_array($vendor_query))
					{
						?>
						<option value="<?php echo $fetch_vendor['vendorcode']; ?>"><?php echo $fetch_vendor['name']; ?></option>
						<?php
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="tbl-border-td3" colspan="2">
				<div class="div-list-scroll">
					<table class="tbl-list-order">
						<tr>
							<th class="tbl-list-order-th1">Reference #</th>
							<th class="tbl-list-order-th2">Principal</th>
							<th class="tbl-list-order-th3">Company</th>
							<th class="tbl-list-order-th4">Prepared By</th>
							<th class="tbl-list-order-th5">Date Processed</th>
							<th class="tbl-list-order-th6">Status</th>
						</tr>
						<tbody class="tbody-list-order"></tbody>
				</table>
				</div>
			</td>
		</tr>
		<tr>
			<td class="tbl-border-td4" colspan="2">
				<span class="span-username">
					Connected remotely to <b style="color: #ed9121;font-style: italic;">Ramosco_Server</b> as: <b>
					<?php
					if (isset($_SESSION['fname']))
					{
						echo $_SESSION['fname'];
					}
					else
					{
						echo "Please Login.";
					}
					?></b>
				</span>
			</td>
		</tr>
	</table>

	<!-- View Order Detail -->
	<div class="div-bg">
		<div class="div-form">
			<form class="form-export" method="POST" action="exportsummary.php">
				<input type="hidden" class="export-reference" name="export_reference">
				<input type="hidden" class="export-vcode" name="export_vcode">
				<button class="button-withBorder button-summary-export">Export CSV</button>
			</form>
			<form class="form-order-detail">
				<table class="tbl-form-detail">
					<tr>
						<td class="tbl-form-detail-td1" colspan="4">
							<button type="button" class="button-withBorder button-form-menu button-printsummary" onclick="">Print Summary</button>
							<button type="button" class="button-withBorder button-form-menu button-cancelled" onclick="CancelledReference();">Cancelled</button>
							<button type="button" class="button-withBorder button-form-menu button-forcovering" onclick="Deduction();">For Billed</button>
							<?php
							if($_SESSION['admin'] == 1 || $_SESSION['semiadmin'] == 1)
							{
								?>
								<button type="button" class="button-withBorder button-form-menu button-reopen" onclick="CancelledReference();">Authorize Cancel</button>
								<?php
							}
							?>
							<button type="button" class="button-withBorder button-form-menu button-history">History</button>
							<div class="div-history">
								<div class="div-history-scroll">
									<table class="tbl-history">
										<tr>
											<th class="tbl-history-th1">Name</th>
											<th class="tbl-history-th2">Processed</th>
											<th class="tbl-history-th3">Date and Time</th>
										</tr>
										<tbody class="tbody-history-list"></tbody>
									</table>
								</div>
							</div>
							<button type="button" class="button-withBorder button-style-form button-close" onclick="CloseForm();">X Close</button>
						</td>
					</tr>
					<tr>
						<td class="tbl-form-detail-td2" colspan="4">
							<table class="tbl-vendor-detail">
								<tr>
									<th class="tbl-vendor-detail-th1">Principal:</th>
									<td class="tbl-vendor-detail-td1">
										<input type="text" class="input-withBorder input-customer" disabled="disabled">
									</td>
								</tr>
								<tr>
									<th class="tbl-vendor-detail-th1">Company:</th>
									<td class="tbl-vendor-detail-td1">
										<input type="text" class="input-withBorder input-company" vcode="" disabled="disabled">
									</td>
								</tr>
								<tr>
									<th class="tbl-vendor-detail-th1">Prepared By:</th>
									<td class="tbl-vendor-detail-td1">
										<input type="text" class="input-withBorder input-prepared" disabled="disabled">
									</td>
								</tr>
							</table>
							<table class="tbl-reference">
								<tr>
									<th class="tbl-reference-th1">Reference #</th>
									<td class="tbl-reference-td1">
										<input type="text" class="input-withBorder input-ordernumber" disabled="disabled">
									</td>
								</tr>
								<tr>
									<th class="tbl-reference-th1">Date</th>
									<td class="tbl-reference-td1">
										<input type="date" class="input-withBorder input-orderdate" value="" disabled="disabled">
									</td>
								</tr>
								<tr>
									<th class=" tbl-reference-th1">Status</th>
									<td class="tbl-reference-td1">
										<input type="text" class="input-withBorder input-status" value="" disabled="disabled">
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td class="tbl-form-detail-td3" colspan="4">
							<div class="div-scroll div-scroll-sku">
								<table class="tbl-order-detail">
									<tr>
										<th class="tbl-order-detail-th9">Month</th>
										<th class="tbl-order-detail-th10">BR Code</th>
										<th class="tbl-order-detail-th12">Branch Name</th>
										<th class="tbl-order-detail-th2">Region</th>
										<th class="tbl-order-detail-th11">F325 Number</th>
										<th class="tbl-order-detail-th1">MDC Code</th>
										<th class="tbl-order-detail-th3">Description</th>
										<th class="tbl-order-detail-th8">BBD</th>
										<th class="tbl-order-detail-th4">Reason Code</th>
										<th class="tbl-order-detail-th5">Quantity</th>
										<th class="tbl-order-detail-th6">UoM</th>
										<th class="tbl-order-detail-th7">Cost Extended</th>
									</tr>
									<img class="img-loader loader-sku-list" src="icon/loader.gif">
									<tbody class="tbl-order-list"></tbody>
								</table>
							</div>
						</td>
					</tr>
					<tr>
						<td class="tbl-vendor-detail-td4"></td>
						<td class="tbl-vendor-detail-td4"></td>
						<td class="tbl-vendor-detail-td4 tbl-vendor-detail-remarks">
							<table class="tbl-remarks">
								<tr>
									<th class="tbl-remarks-th1">Remarks :</th>
									<td>
										<textarea class="textarea-withBorder input-remarks" disabled="disabled"></textarea>
									</td>
								</tr>
							</table>
						</td>
						<td class="tbl-vendor-detail-td4 tbl-vendor-detail-subtotal">
							<table class="tbl-subtotal">
								<tr>
									<th class="tbl-subtotal-th1">Subtotal :</th>
									<td class="tbl-subtotal-td1">
										<input type="text" class="input-withBorder input-subtotal" disabled="disabled">
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>

	<!-- notify alert -->
	<span class="span-notify-alert"></span>

	<!-- submit confirmation -->
	<div class="div-confirm">
		<div class="div-confirm-border">
			<h4 class="h4-header">Are you sure? This is for covering?</h4>
			<button type="button" class="button-confirm-style" onclick="ForCovering();">Yes</button>
			<button type="button" class="button-confirm-style" onclick="$('.div-confirm').hide();">No</button>
		</div>
	</div>
</body>
</html>
<?php $conn->close(); ?>
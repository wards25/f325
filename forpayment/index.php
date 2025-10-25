<?php
session_start();
require_once('require/returnlogin.php');
include('db.php');
require_once('require/sessiondestroy.php');
require_once('require/access.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="expires" content="Sun, 01 Jan 2014 00:00:00 GMT"/>
	<meta http-equiv="pragma" content="no-cache" />
	<title>For Payment</title>
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
				<label class="lbl-style">Search:</label>
				<input type="text" class="input-withBorder input-search" onkeyup="LoadList();" placeholder="AR Number..." value="">
				<label class="lbl-style">Status:</label>
				<select class="select-withBorder select-status" onchange="LoadList();">
					<option class="FOR PAYMENT">For Payment</option>
					<option class="SETTLED">Settled</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="tbl-border-td3" colspan="2">
				<div class="div-list-scroll">
					<table class="tbl-list-order">
						<tr>
							<th class="tbl-list-order-th1">F325 #</th>
							<th class="tbl-list-order-th7">AR #</th>
							<th class="tbl-list-order-th2">Branch Name</th>
							<th class="tbl-list-order-th3">Email Date</th>
							<th class="tbl-list-order-th4">F325 Date</th>
							<th class="tbl-list-order-th5">Vendor</th>
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
			<form class="form-order-detail">
				<table class="tbl-form-detail">
					<tr>
						<td class="tbl-form-detail-td1" colspan="4">
							<button type="button" class="button-withBorder button-form-menu button-reopen" onclick="ReOpen();">Re-Open</button>
							<button type="button" class="button-withBorder button-form-menu button-setteled" onclick="UpdateStatus();">Settled</button>
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
							<button type="button" class="button-withBorder button-style-form" onclick="CloseForm();">X Close</button>
						</td>
					</tr>
					<tr>
						<td class="tbl-form-detail-td2" colspan="4">
							<table class="tbl-vendor-detail">
								<tr>
									<th class="tbl-vendor-detail-th1">Branch:</th>
									<td class="tbl-vendor-detail-td1">
										<input type="text" class="input-withBorder input-customer" disabled="disabled">
									</td>
									<th class="tbl-vendor-detail-th1">TM #:</th>
									<td class="tbl-vendor-detail-td1">
										<input type="text" class="input-withBorder input-tmnumber" disabled="disabled">
									</td>
									<th class="tbl-vendor-detail-th1">Company:</th>
									<td class="tbl-vendor-detail-td1">
										<input type="text" class="input-withBorder input-company" vcode="" disabled="disabled">
									</td>
									<th class="tbl-vendor-detail-th1">AR #:</th>
									<td class="tbl-vendor-detail-td1">
										<input type="text" class="input-withBorder input-arnumber" disabled="disabled">
									</td>
								</tr>
								<tr>
									<th class="tbl-vendor-detail-th1">Email Date:</th>
									<td class="tbl-vendor-detail-td1">
										<input type="date" class="input-withBorder input-emaildate" disabled="disabled">
									</td>
									<th class="tbl-vendor-detail-th1">Driver Name:</th>
									<td class="tbl-vendor-detail-td1">
										<input type="text" class="input-withBorder input-driver" disabled="disabled">
									</td>
									<th class="tbl-vendor-detail-th1">Issued By:</th>
									<td class="tbl-vendor-detail-td1">
										<input type="text" class="input-withBorder input-issued" disabled="disabled">
									</td>
								</tr>
								<tr>
									<th class="tbl-vendor-detail-th1">Prepared By:</th>
									<td class="tbl-vendor-detail-td1">
										<input type="text" class="input-withBorder input-prepared" disabled="disabled">
									</td>
									<th class="tbl-vendor-detail-th1">Plate #:</th>
									<td class="tbl-vendor-detail-td1">
										<input type="text" class="input-withBorder input-platenumber" disabled="disabled">
									</td>
									<th class="tbl-vendor-detail-th1">Date Sched:</th>
									<td class="tbl-vendor-detail-td1">
										<input type="date" class="input-withBorder input-datesched" disabled="disabled">
									</td>
								</tr>
							</table>
							<table class="tbl-reference">
								<tr>
									<th class="tbl-reference-th1">F325 #</th>
									<td class="tbl-reference-td1">
										<input type="text" class="input-withBorder input-ordernumber" disabled="disabled">
									</td>
								</tr>
								<tr>
									<th class="tbl-reference-th1">F325 Date</th>
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
							<div class="div-scroll">
								<table class="tbl-order-detail">
									<tr>
										<th class="tbl-order-detail-th1">MDC Code</th>
										<th class="tbl-order-detail-th2">Item Code</th>
										<th class="tbl-order-detail-th3">Description</th>
										<th class="tbl-order-detail-th9">BBD</th>
										<th class="tbl-order-detail-th4">Reason Code</th>
										<th class="tbl-order-detail-th10">Quantity</th>
										<th class="tbl-order-detail-th11">Rcvd Qty</th>
										<th class="tbl-order-detail-th5">Short Qty</th>
										<th class="tbl-order-detail-th6">UoM</th>
										<th class="tbl-order-detail-th7">Unit Price</th>
										<th class="tbl-order-detail-th8">Sub-Total</th>
									</tr>
									<tbody class="tbl-order-list"></tbody>
								</table>
							</div>
						</td>
					</tr>
					<tr>
						<td class="tbl-vendor-detail-td4"></td>
						<td class="tbl-vendor-detail-td4"></td>
						<td class="tbl-vendor-detail-td4"></td>
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
</body>
</html>
<?php $conn->close(); ?>
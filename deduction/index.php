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
	<title>Deduction</title>
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
				<label class="lbl-style">Month:</label>
				<select class="select-withBorder select-monthyear" onchange="LoadList();">
					<option value="" year="<?php echo date('Y'); ?>">This Year</option>
					<option value="" year="<?php echo date('Y')-1; ?>">Last Year</option>
					<?php
						$start = strtotime('2020-12-01');
						$end = $month = strtotime(date('Y-m-d'));
						while($month > $start)
						{
							?>
							<option value="<?php echo date('m', $month); ?>" year="<?php echo date('Y', $month); ?>">
								<?php
								echo date('F Y', $month);
								?>
							</option>
							<?php
							$month = strtotime("-1 month", $month);
						}
						?>
				</select>
				<label class="lbl-style">Location:</label>
				<select class="select-withBorder select-location" onchange="LoadList();">
					<?php
					$location_query = "SELECT * FROM dblocation WHERE active='1'";

					// location
					$location = "location='' ";

					for ($i=1; $i <= 10 ; $i++)
					{ 
						// get location
						$list_query = mysqli_query($conn,"SELECT * FROM dblocation WHERE id='$i' ");
						$fetch_list = mysqli_fetch_array($list_query);

						if($_SESSION['loc'.$fetch_list['id']]){$location .= "OR location='".$fetch_list['location']."'"; }
					}

					$location_query .= "AND (".$location.")";

					$location_list_query = mysqli_query($conn,$location_query);
					while ($fetch_location_list = mysqli_fetch_array($location_list_query))
					{
						?>
						<option value="<?php echo $fetch_location_list['location']; ?>"><?php echo $fetch_location_list['location']; ?></option>
						<?php
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="tbl-border-td3" colspan="2">
				<div class="div-list-scroll div-scroll-sku">
					<table class="tbl-list-order">
						<tr>
							<th class="tbl-list-order-th1">Principal</th>
							<th class="tbl-list-order-th2">Company</th>
							<th class="tbl-list-order-th3">MDC Deducted</th>
							<th class="tbl-list-order-th3">Amount Deduction (P)</th>
							<th class="tbl-list-order-th3">Amount for Deduct</th>
							<th class="tbl-list-order-th4">% Deduction</th>
						</tr>
						<img class="img-loader loader-list" src="icon/loader.gif">
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
			<form class="form-order-detail" onsubmit="return Deduction();">
				<table class="tbl-form-detail">
					<tr>
						<td class="tbl-form-detail-td1" colspan="4">
							<button class="button-withBorder button-form-menu button-fordeduct">For Billing</button>
							<button type="button" class="button-withBorder button-form-menu button-bypassdeduct" onclick="AllowBypass();">Bypass Deduct</button>
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
									<th class="tbl-vendor-detail-th1">Deduct Type:</th>
									<td class="tbl-vendor-detail-td1">
										<select class="select-withBorder input-deducttype">
											<?php
											$deduct_type_query = mysqli_query($conn,"SELECT deducttype FROM dbcensus GROUP BY deducttype ORDER BY deducttype ASC");
											while ($fetch_deduct_type = mysqli_fetch_array($deduct_type_query))
											{
												?>
												<option value="<?php echo $fetch_deduct_type['deducttype']; ?>"><?php echo $fetch_deduct_type['deducttype']; ?></option>
												<?php
											}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<th class="tbl-vendor-detail-th1">Company:</th>
									<td class="tbl-vendor-detail-td1">
										<input type="text" class="input-withBorder input-company" companycode="" refcode="" disabled="disabled">
									</td>
								</tr>
								<tr>
									<th class="tbl-vendor-detail-th1">Prepared By:</th>
									<td class="tbl-vendor-detail-td1">
										<input type="text" class="input-withBorder input-prepared" value="<?php echo $_SESSION['fname']; ?>" disabled="disabled">
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
										<input type="date" class="input-withBorder input-orderdate" value="<?php echo date('Y-m-d'); ?>" disabled="disabled">
									</td>
								</tr>
								<tr>
									<th class=" tbl-reference-th1">Status</th>
									<td class="tbl-reference-td1">
										<input type="text" class="input-withBorder input-status" value="FOR BILLING" disabled="disabled">
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
										<th class="tbl-order-detail-th9">
											<input type="checkbox" class="input-check input-all-check" onclick="CheckUncheck();">
										</th>
										<th class="tbl-order-detail-th1">F325 Number</th>
										<th class="tbl-order-detail-th10">CR #</th>
										<th class="tbl-order-detail-th2">MDC Code</th>
										<th class="tbl-order-detail-th4">Description</th>
										<th class="tbl-order-detail-th5">Reason Code</th>
										<th class="tbl-order-detail-th6">Quantity</th>
										<th class="tbl-order-detail-th7">UoM</th>
										<th class="tbl-order-detail-th3">MDC Deduct</th>
										<th class="tbl-order-detail-th8">Cost Extended</th>
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
										<textarea class="textarea-withBorder input-remarks"></textarea>
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
			<h4 class="h4-header">Are you sure? You want to deduct this transaction?</h4>
			<button type="button" class="button-confirm-style" onclick="ProcessDeduct();">Yes</button>
			<button type="button" class="button-confirm-style" onclick="$('.div-confirm').hide();">No</button>
		</div>
	</div>
</body>
</html>
<?php $conn->close(); ?>
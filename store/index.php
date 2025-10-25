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
	<title>Store List</title>
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
					<button type="button" class="button-style-menu-list" onclick="window.location.href='/dashboard'">Dashboard</button>
					<button type="button" class="button-style-menu-list" onclick="window.location.href='logout.php'">Logout</button>
				</div>
			</td>
			<td class="tbl-border-td1"></td>
			<td class="tbl-border-td1" colspan="2"></td>
		</tr>
		<tr>
			<td class="tbl-border-td2" colspan="4">
				<table class="tbl-design">
					<tr>
						<td class="tbl-design-td1">
							<table class="tbl-filter">
								<tr>
									<th class="tbl-filter-th1">Search:</th>
									<td class="tbl-filter-td1">
										<input type="text" class="input-TableWithBorder-Style input-search" onkeyup="LoadBranch();" placeholder="Search...">
									</td>
								</tr>
								<tr>
									<th class="tbl-filter-th1">Location:</th>
									<td class="tbl-filter-td1">
										<select class="select-TableWithBorder-Style select-location" onchange="LoadBranch();LoadRegion();"></select>
									</td>
								</tr>
								<tr>
									<th class="tbl-filter-th1">Region:</th>
									<td class="tbl-filter-td1">
										<select class="select-TableWithBorder-Style select-region" onchange="LoadBranch();"></select>
									</td>
								</tr>
								<tr>
									<th class="tbl-filter-th1">Status:</th>
									<td class="tbl-filter-td1">
										<select class="select-TableWithBorder-Style select-status" onchange="LoadBranch();">
											<option value="1">ACTIVE</option>
											<option value="0">DEACTIVATE</option>
										</select>
									</td>
								</tr>
								<tr>
									<td class="tbl-filter-td2" colspan="2">
										<div class="div-scroll div-list-scroll">
											<table class="tbl-list">
												<tr>
													<th class="tbl-list-th1">Code</th>
													<th class="tbl-list-th2">Branch Name</th>
												</tr>
												<tbody class="tbody-list"></tbody>
											</table>
										</div>
									</td>
								</tr>
							</table>
						</td>
						<td class="tbl-design-td2">
							<form class="form-new-store" onsubmit="return AddNewCustomer();">
								<input type="hidden" class="input-id">
								<table class="tbl-view-detail">
									<tr>
										<td class="tbl-view-detail-td1" colspan="2">
											<button type="button" class="button-Table-Style button-customer-new" onclick="NewForm();" disabled="disabled">New</button>
											<button class="button-Table-Style button-customer-save">Save</button> | 
											<button type="button" class="button-Table-Style button-customer-status" status="" onclick="ActivateDeactivate();">Activate</button>
											<button type="button" class="button-Table-Style button-customer-history" disabled="disabled">History</button>
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
										</td>
									</tr>
									<tr>
										<td class="tbl-view-detail-td2">
											<table class="tbl-customer-detail">
												<tr>
													<th class="tbl-customer-detail-th" colspan="3">Customer Info</th>
												</tr>
												<tr>
													<th class="tbl-customer-detail-th1">Code:</th>
													<td class="tbl-customer-detail-td1" colspan="2">
														<input type="text" class="input-TableWithBorder-Style input-code" maxlength="6" style="width: 5vw;text-align: center;" required="required">
													</td>
												</tr>
												<tr>
													<th class="tbl-customer-detail-th2">Branch Name:</th>
													<td class="tbl-customer-detail-td2" colspan="2">
														<textarea class="textarea-TableWithBorder-Style input-branchname" required="required"></textarea>
													</td>
												</tr>
												<tr>
													<th class="tbl-customer-detail-th2">Shipping Address:</th>
													<td class="tbl-customer-detail-td2" colspan="2">
														<textarea class="textarea-TableWithBorder-Style input-shippingaddress" required="required"></textarea>
													</td>
												</tr>
												<tr>
													<th class="tbl-customer-detail-th2">Billing Address:</th>
													<td class="tbl-customer-detail-td2" colspan="2">
														<textarea class="textarea-TableWithBorder-Style input-billingaddress" required="required"></textarea>
													</td>
												</tr>
												<tr>
													<th class="tbl-customer-detail-th" colspan="3">Customer Detail</th>
												</tr>
												<tr>
													<th class="tbl-customer-detail-th1">Franchise:</th>
													<td class="tbl-customer-detail-td1 tbl-customer-detail-blank">
														<input type="text" class="input-TableWithBorder-Style input-detail input-franchise" column="franchise" required="required">
														<div class="div-list div-category-scroll div-franchise">
															<table class="tbl-list-category">
																<tbody class="tbody-list-franchise"></tbody>
															</table>
														</div>
													</td>
													<td></td>
												</tr>
												<tr>
													<th class="tbl-customer-detail-th1">Region:</th>
													<td class="tbl-customer-detail-td1 tbl-customer-detail-blank">
														<input type="text" class="input-TableWithBorder-Style input-detail input-region" column="region" required="required">
														<div class="div-list div-category-scroll div-region">
															<table class="tbl-list-category">
																<tbody class="tbody-list-region"></tbody>
															</table>
														</div>
													</td>
													<td></td>
												</tr>
												<tr>
													<th class="tbl-customer-detail-th1">Cluster:</th>
													<td class="tbl-customer-detail-td1 tbl-customer-detail-blank">
														<input type="text" class="input-TableWithBorder-Style input-detail input-cluster" column="cluster" required="required">
														<div class="div-list div-category-scroll div-cluster">
															<table class="tbl-list-category">
																<tbody class="tbody-list-cluster"></tbody>
															</table>
														</div>
													</td>
													<td></td>
												</tr>
												<tr>
													<th class="tbl-customer-detail-th1">Deduct Type:</th>
													<td class="tbl-customer-detail-td1 tbl-customer-detail-blank">
														<input type="text" class="input-TableWithBorder-Style input-detail input-deducttype" column="deducttype" required="required">
														<div class="div-list div-category-scroll div-deducttype">
															<table class="tbl-list-category">
																<tbody class="tbody-list-deducttype"></tbody>
															</table>
														</div>
													</td>
													<td></td>
												</tr>
												<tr>
													<th class="tbl-customer-detail-th1">Location:</th>
													<td class="tbl-customer-detail-td1 tbl-customer-detail-blank">
														<input type="text" class="input-TableWithBorder-Style input-detail input-location" column="location" required="required">
														<div class="div-list div-category-scroll div-location">
															<table class="tbl-list-category">
																<tbody class="tbody-list-location"></tbody>
															</table>
														</div>
													</td>
													<td></td>
												</tr>
											</table>
										</td>
										<td class="tbl-view-detail-td3"></td>
									</tr>
								</table>
							</form>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td class="tbl-border-td3" colspan="4">
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

	<!-- notify alert -->
	<span class="span-notify-alert"></span>
</body>
</html>
<?php $conn->close(); ?>
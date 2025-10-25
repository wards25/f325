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
	<title>Inventory Stock</title>
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
										<input type="text" class="input-TableWithBorder-Style input-search" onkeyup="LoadProduct();" placeholder="Search...">
									</td>
								</tr>
								<tr>
									<th class="tbl-filter-th1">Category:</th>
									<td>
										<select class="select-TableWithBorder-Style select-category" onchange="LoadProduct();">
											<option value="">ALL</option>
											<?php
											// get category
											$category_query = mysqli_query($conn,"SELECT category FROM dbproduct GROUP BY category ORDER BY category ASC");
											while ($fetch_category = mysqli_fetch_array($category_query))
											{
												?>
												<option value="<?php echo $fetch_category['category']; ?>"><?php echo $fetch_category['category']; ?></option>
												<?php
											}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<th class="tbl-filter-th1">Company:</th>
									<td class="tbl-filter-td1">
										<select class="select-TableWithBorder-Style select-company" onchange="LoadProduct();">
											<option value="">ALL</option>
											<?php
											// get company
											$company_query = mysqli_query($conn,"SELECT nickname,vendorcode FROM dbcompany WHERE active='1' ORDER BY nickname ASC ");
											while ($fetch_company = mysqli_fetch_array($company_query))
											{
												?>
												<option value="<?php echo $fetch_company['vendorcode']; ?>"><?php echo $fetch_company['nickname']; ?></option>
												<?php
											}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<th class="tbl-filter-th1">Status:</th>
									<td class="tbl-filter-td1">
										<select class="select-TableWithBorder-Style select-status" onchange="LoadProduct();">
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
													<th class="tbl-list-th1">MDC Code</th>
													<th class="tbl-list-th2">Description</th>
												</tr>
												<tbody class="tbody-list"></tbody>
											</table>
										</div>
									</td>
								</tr>
							</table>
						</td>
						<td class="tbl-design-td2">
							<form class="form-new-store" onsubmit="return AddNewProduct();">
								<input type="hidden" class="input-id">
								<table class="tbl-view-detail">
									<tr>
										<td class="tbl-view-detail-td1" colspan="2">
											<button type="button" class="button-Table-Style button-prd-new" onclick="NewForm();" disabled="disabled">New</button>
											<button class="button-Table-Style button-prd-save">Save</button> | 
											<button type="button" class="button-Table-Style button-prd-status" status="" onclick="ActivateDeactivate();">Activate</button>
											<button type="button" class="button-Table-Style button-prd-history" disabled="disabled">History</button>
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
											<button type="button" class="button-Table-Style button-prd-barcode" onclick="OpenBarcodeForm();" style="display:none;" disabled="disabled">Barcode</button>
										</td>
									</tr>
									<tr>
										<td class="tbl-view-detail-td2">
											<table class="tbl-prd-detail">
												<tr>
													<th class="tbl-prd-detail-th" colspan="3">Product Info</th>
												</tr>
												<tr>
													<th class="tbl-prd-detail-th1">MDC Code:</th>
													<td class="tbl-prd-detail-td1" colspan="2">
														<input type="text" class="input-TableWithBorder-Style input-mdccode" oldmdccode="" maxlength="8" style="width: 8vw;text-align: center;" required="required">
													</td>
												</tr>
												<tr>
													<th class="tbl-prd-detail-th1">Item Code:</th>
													<td class="tbl-prd-detail-td1" colspan="2">
														<input type="text" class="input-TableWithBorder-Style input-itemcode" maxlength="50" style="width: 8vw;text-align: center;">
													</td>
												</tr>
												<tr>
													<th class="tbl-prd-detail-th2">Description:</th>
													<td class="tbl-prd-detail-td2" colspan="2">
														<textarea class="textarea-TableWithBorder-Style input-description" required="required"></textarea>
													</td>
												</tr>
												<tr>
													<th class="tbl-prd-detail-th" colspan="3">Product Detail</th>
												</tr>
												<tr>
													<th class="tbl-prd-detail-th1">Category:</th>
													<td class="tbl-prd-detail-td1 tbl-prd-detail-blank">
														<input type="text" class="input-TableWithBorder-Style input-detail input-category" oldcategory="" column="category" required="required">
														<div class="div-list div-category-scroll div-category">
															<table class="tbl-list-category">
																<tbody class="tbody-list-category"></tbody>
															</table>
														</div>
													</td>
													<td></td>
												</tr>
												<tr>
													<th class="tbl-prd-detail-th1">UoM:</th>
													<td class="tbl-prd-detail-td1 tbl-prd-detail-blank">
														<input type="text" class="input-TableWithBorder-Style input-detail input-uom" column="uom" required="required">
														<div class="div-list div-category-scroll div-uom">
															<table class="tbl-list-category">
																<tbody class="tbody-list-uom"></tbody>
															</table>
														</div>
													</td>
													<td></td>
												</tr>
												<tr>
													<th class="tbl-prd-detail-th1">Company:</th>
													<td class="tbl-prd-detail-td1">
														<select class="select-TableWithBorder-Style select-prd-company" oldvendor="">
															<option></option>
															<?php
															// get company
															$company_query = mysqli_query($conn,"SELECT nickname,vendorcode FROM dbcompany WHERE active='1' ORDER BY nickname ASC ");
															while ($fetch_company = mysqli_fetch_array($company_query))
															{
																?>
																<option value="<?php echo $fetch_company['vendorcode']; ?>"><?php echo $fetch_company['nickname']; ?></option>
																<?php
															}
															?>
														</select>
													</td>
													<td></td>
												</tr>
												<tr class="tbl-prd-detail-dmpi-tr">
													<th class="tbl-prd-detail-th" colspan="3">DMPI Detail</th>
												</tr>
												<tr class="tbl-prd-detail-dmpi-tr">
													<th class="tbl-prd-detail-th1">DMPI Code:</th>
													<td class="tbl-prd-detail-td1">
														<input type="text" class="input-TableWithBorder-Style input-dmpi-code">
													</td>
													<td></td>
												</tr>
												<tr class="tbl-prd-detail-dmpi-tr">
													<th class="tbl-prd-detail-th1">DMPI Pack:</th>
													<td class="tbl-prd-detail-td1">
														<select class="select-TableWithBorder-Style select-dmpi-pack">
															<option value=""></option>
															<option value="BAG INBOX">BAG INBOX</option>
															<option value="CAN">CAN</option>
															<option value="DRUM">DRUM</option>
															<option value="FOIL">FOIL</option>
															<option value="GLASS BOTTLE">GLASS BOTTLE</option>
															<option value="GLASS JARS">GLASS JARS</option>
															<option value="HDPE">HDPE</option>
															<option value="MULTIPLE">MULTIPLE</option>
															<option value="PET BOTTLE">PET BOTTLE</option>
															<option value="PILLOW PACK">PILLOW PACK</option>
															<option value="PLASTIC BOTTLE">PLASTIC BOTTLE</option>
															<option value="SACHET">SACHET</option>
															<option value="SUP">SUP</option>
															<option value="TETRA">TETRA</option>
														</select>
													</td>
													<td></td>
												</tr>
												<tr class="tbl-prd-detail-dmpi-tr">
													<th class="tbl-prd-detail-th1">DMPI Pack:</th>
													<td class="tbl-prd-detail-td1">
														<select class="select-TableWithBorder-Style select-dmpi-classification">
															<?php
															// get classification
															$class_query = mysqli_query($conn,"SELECT dmpiclassification FROM dbproduct GROUP BY dmpiclassification ORDER BY dmpiclassification ASC");
															while ($fetch_class = mysqli_fetch_array($class_query))
															{
																?>
																<option value="<?php echo $fetch_class['dmpiclassification']; ?>"><?php echo $fetch_class['dmpiclassification']; ?></option>
																<?php
															}
															?>
														</select>
													</td>
													<td></td>
												</tr>
											</table>
										</td>
										<td class="tbl-view-detail-td3">
											<table class="tbl-stock">
												<tr>
													<th class="tbl-stock-th1">Stock Location</th>
												</tr>
												<tr>
													<td class="tbl-stock-td1">
														<div class="div-scroll">
															<table class="tbl-stock-location">
																<tr>
																	<th class="tbl-stock-location-th1">Warehouse Location</th>
																	<th class="tbl-stock-location-th2">On Stock</th>
																	<th class="tbl-stock-location-th3">For Pick-Up</th>
																</tr>
																<tbody class="tbody-stock-location"></tbody>
															</table>
														</div>
													</td>
												</tr>
												<tr>
													<td class="tbl-stock-td2">
														<div class="div-scroll">
															
														</div>
													</td>
												</tr>
											</table>
										</td>
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

	<!-- barcode -->
	<div class="div-bg-barcode">
		<div class="div-form-barcode">
			<input type="hidden" class="input-prd-mdccode">
			<table class="tbl-barcode-design">
				<tr>
					<th class="tbl-barcode-design-th1" colspan="3">Barcode</th>
				</tr>
				<tr>
					<td class="tbl-barcode-design-td1" colspan="3">
						<div class="div-scroll">
							<table class="tbl-list-barcode">
								<tbody class="tbody-list-barcode"></tbody>
							</table>
						</div>
					</td>
				</tr>
				<tr>
					<td class="tbl-barcode-design-td2">
						<input type="text" class="input-TableWithNoBorder-Style input-barcode" onchange="$(this).select();" onclick="$(this).select();"  placeholder="Type or Scan your barcode here....">
					</td>
					<td class="tbl-barcode-design-td3">
						<button type="button" class="button-WithBorder-Style" onclick="AddBarcode();">Add</button>
					</td>
					<td class="tbl-barcode-design-td3">
						<button type="button" class="button-WithBorder-Style" onclick="CloseBarcodeForm();">Cancel</button>
					</td>
				</tr>
			</table>
		</div>
	</div>

	<!-- notify alert -->
	<span class="span-notify-alert"></span>
</body>
</html>
<?php $conn->close(); ?>
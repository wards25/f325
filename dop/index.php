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
	<title>Detail of Payment</title>
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
				<button type="button" class="button-upload-style" onclick="ShowUploadForm();">New Upload</button>
			</td>
		</tr>
		<tr>
			<td class="tbl-border-td3" colspan="2">
				<div class="div-scroll-upload">
					<table class="tbl-upload-list">
						<tr>
							<th class="tbl-upload-list-th tbl-upload-list-th1">Upload Number</th>
							<th class="tbl-upload-list-th tbl-upload-list-th2">Company</th>
							<th class="tbl-upload-list-th tbl-upload-list-th6">DOP vs. BILLED</th>
							<th class="tbl-upload-list-th tbl-upload-list-th3">Month Coverage</th>
							<th class="tbl-upload-list-th tbl-upload-list-th4">Upload By</th>
							<th class="tbl-upload-list-th tbl-upload-list-th5">Status</th>
						</tr>
						<tbody class="tbody-upload-list"></tbody>
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

	<!-- view upload -->
	<div class="div-upload-detail-bg">
		<form class="form-upload" onsubmit="return SaveImport();">
			<table class="tbl-upload">
				<tr>
					<td class="tbl-upload-td1">
						<table class="tbl-upload-detail">
							<tr>
								<th class="tbl-upload-detail-th1">Upload #:</th>
								<td class="tbl-upload-detail-td1">
									<input type="text" class="input-upload-style input-upload-number" disabled="disabled">
								</td>
								<th class="tbl-upload-detail-th1">Upload By:</th>
								<td class="tbl-upload-detail-td1">
									<input type="text" class="input-upload-style input-uploadby" value="<?php echo $_SESSION['fname']; ?>" disabled="disabled">
								</td>
								<th class="tbl-upload-detail-th1">Status:</th>
								<td class="tbl-upload-detail-td1">
									<input type="text" class="input-upload-style input-import-status" value="DRAFT" disabled="disabled">
								</td>
							</tr>
							<tr>
								<th class="tbl-upload-detail-th1">Month:</th>
								<td class="tbl-upload-detail-td1">
									<select class="select-upload-style select-month" onchange="EnabledUpload();">
										<option value=""></option>
										<?php
										$start = 1;
										$last = 12;

										for ($i = $start; $i <= $last; $i++)
										{ 
											?>
											<option value="<?php if (strlen($i) == 1) {echo '0'.$i;}else{echo $i;} ?>"><?php echo date('F', mktime(0, 0, 0, $i, 10)); ?></option>
											<?php
										}
										?>
									</select>
								</td>
								<th class="tbl-upload-detail-th1">Company:</th>
								<td class="tbl-upload-detail-td1">
									<select class="select-upload-style select-company" onchange="EnabledUpload();">
										<option value=""></option>
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
								<th class="tbl-upload-detail-th1">Year:</th>
								<td class="tbl-upload-detail-td1">
									<select class="select-upload-style select-year" onchange="EnabledUpload();">
										<option value=""></option>
										<?php
										$start = date('Y');
										$last = 2021;

										for ($i = $start; $i >= $last; $i--)
										{
											?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
											<?php
										}
										?>
									</select>
								</td>
								<th class="tbl-upload-detail-th1">CR #:</th>
								<td class="tbl-upload-detail-td1">
									<input type="text" class="input-upload-style input-cr-number" onkeyup="EnabledUpload();">
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="tbl-upload-td2">
						<button type="button" class="button-upload-style button-create-upload" onclick="CreateUpload();" disabled="disabled">Create</button>
						<button type="button" class="button-upload-style button-cancel-upload" onclick="CancelledUpload();">Cancelled</button>
						<button type="button" class="button-upload-style button-upload-data" onclick="ClickUpload();">Import Data</button>
						<input type="file" class="input-file-style input-file-upload" accept=".csv" onchange="return UploadData();">
					</td>
				</tr>
				<tr>
					<td class="tbl-upload-td3">
						<div class="div-upload-data-scroll">
							<table class="tbl-data">
								<tr>
									<th class="tbl-data-th tbl-data-th1">F325 Number</th>
									<th class="tbl-data-th tbl-data-th2">BR Code</th>
									<th class="tbl-data-th tbl-data-th3">Branch Name</th>
									<th class="tbl-data-th tbl-data-th4">MDC Code</th>
									<th class="tbl-data-th tbl-data-th5">Description</th>
									<th class="tbl-data-th tbl-data-th6">Category</th>
									<th class="tbl-data-th tbl-data-th7">Quantity</th>
									<th class="tbl-data-th tbl-data-th8">Unit Cost</th>
									<th class="tbl-data-th tbl-data-th9">Ref. #</th>
									<th class="tbl-data-th tbl-data-th10">Status</th>
									<th class="tbl-data-th tbl-data-th11"></th>
								</tr>
								<tbody class="tbody-load-data"></tbody>
								<img class="img-loader" src="icon/loader.gif">
							</table>
						</div>
					</td>
				</tr>
				<tr>
					<td class="tbl-upload-td4">
						<!-- Pagenation -->
						<span class="span-pagenation">
							<button type="button" class="button-pagenation button-page-prev" disabled="disabled">
								<i class="arrow left"></i>
							</button>
							<input type="text" class="input-pagenumber" value="1" totalpage="" disabled="disabled">
							<button type="button" class="button-pagenation button-page-next">
								<i class="arrow right"></i>
							</button>
							<label class="lbl-style">Limit per page</label>
							<select class="select-per-page">
								<option value="200">200</option>
								<option value="500">500</option>
								<option value="1000">1000</option>
							</select>
						</span>

						<button class="button-upload-style button-save-upload" disabled="disabled">Save</button>
						<button type="button" class="button-upload-style button-close-upload" onclick="HideUploadForm();">Close</button>
					</td>
				</tr>
			</table>
		</form>
	</div>

	<!-- notify alert -->
	<span class="span-notify-alert"></span>
</body>
</html>
<?php $conn->close(); ?>
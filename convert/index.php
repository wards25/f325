<?php
session_start();
require_once('require/returnlogin.php');
include('db.php');
require_once('require/sessiondestroy.php');
require_once('require/access.php');
require_once('createfolder.php');

if ($_SERVER['REMOTE_ADDR'] == '::1')
{
	$ipaddress = str_replace("::", "", $_SERVER['REMOTE_ADDR']);
}
else
{
	$ipaddress = str_replace(".", "", $_SERVER['REMOTE_ADDR']);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="expires" content="Sun, 01 Jan 2014 00:00:00 GMT"/>
	<meta http-equiv="pragma" content="no-cache" />
	<title>Import</title>
	<link rel="icon" type="img/png" href="icon/rsdi.png">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/index.js"></script>
</head>
<body>
	<div class="container" >
		<table class="tbl-border">
			<tr>
				<td class="tbl-border-td1 tbl-border-menu">
					<button type="button" class="button-menu-style button-menu"></button>
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
				<td class="tbl-border-td2" colspan="3">
					<input type="file" name="file" class="file" multiple="uploadfile">
					<!-- Drag and Drop container-->
					<div class="upload-area"  id="uploadfile">
						<table class="tbl-list">
							<tr>
								<th class="tbl-list-th1">
									F325 Name
								</th>
								<th class="tbl-list-th2">
									Rename to
								</th>
							</tr>
							<tbody class="tbody-list"></tbody>
						</table>
					</div>
				</td>
				<td class="tbl-border-td3">
					<table class="tbl-button">
						<tr>
							<td class="tbl-button-td1">
								<button type="button" class="button-style add-file">Add File</button>
							</td>
							<td class="tbl-button-td1">
								<button type="button" class="button-style check-file" onclick="VerrifyPO();" disabled="disabled">Verify</button>
							</td>
							<td class="tbl-button-td1">
								<button type="button" class="button-style convert-file" onclick="ConvertFile();" disabled="disabled">Convert / Import</button>
							</td>
							<td class="tbl-button-td1">
								<button type="button" class="button-style clear-file" onclick="FileDelete();" disabled="disabled">Clear</button>
							</td>
						</tr>
						<tr>
							<td class="tbl-button-td4" colspan="4">
								<div class="div-scroll">
									<table class="tbl-duplicate">
										<tr>
											<th class="tbl-duplicate-th1">Duplicate / Not Register Vendor</th>
											<th class="tbl-duplicate-th2">Process</th>
										</tr>
										<tbody class="tbody-duplicate"></tbody>
									</table>
								</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="tbl-border-td4" colspan="4">
					<span class="span-total-text"><b style="color: #ed9121;">Total PO: </b><span class="span-total-upload">0 / 300</span></span>
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
	</div>

	<!-- Loading scree -->
	<div class="loaderscreen">
		<div class="loader-message"><img class="loader-formessage" src="icon/loader.gif"><span class="span-loadingmessage"></span></div>
	</div>

	<!-- email date -->
	<div class="div-emaildate">
		<label class="lbl-email">Email Date:</label>
		<input type="date" class="input-emaildate" value="<?php echo date("Y-m-d"); ?>">
	</div>

	<!-- notify alert -->
	<span class="span-notify-alert"></span>
</body>
</html>
<?php $conn->close(); ?>
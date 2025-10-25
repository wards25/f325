<?php
session_start();
require_once('require/returnlogin.php');
include('db.php');
require_once('require/sessiondestroy.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="expires" content="Sun, 01 Jan 2014 00:00:00 GMT"/>
	<meta http-equiv="pragma" content="no-cache" />
	<title>Dashboard</title>
	<link rel="icon" type="img/png" href="image/rsdilogo.png">
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
					<?php
					if (isset($_SESSION['admin']) || isset($_SESSION['semiadmin']))
					{
						if ($_SESSION['admin'] == 1 || $_SESSION['semiadmin'] == 1)
						{
							?>
							<button type="button" class="button-style-menu-list" onclick="ShowImport();">Import Data</button>
							<?php
						}
					}
					?>
					<button type="button" class="button-style-menu-list" onclick="ShowPassword();">Personal Setting</button>
					<button type="button" class="button-style-menu-list" onclick="window.location.href='logout.php'">Logout</button>
				</div>
			</td>
			<td class="tbl-border-td1"></td>
			<td class="tbl-border-td1" colspan="2"></td>
		</tr>
		<tr>
			<td class="tbl-border-td2" colspan="3">
				<div class="div-scroll">
					<table class="tbl-icon">
						<tr>
							<td class="tbl-icon-td img-icon" folder="search" active="1">
								<img class="img-src" src="image/search.png">
								<span class="icon-name">Search F325</span>
							</td>
							<td class="tbl-icon-td img-icon" folder="borf" active="<?php if(isset($_SESSION['borfapps'])){echo $_SESSION['borfapps'];} ?>">
								<img class="img-src" src="image/borf.png">
								<span class="icon-name">BORF Apps</span>
							</td>
							<td class="tbl-icon-td img-icon" folder="store" active="<?php if(isset($_SESSION['store'])){echo $_SESSION['store'];} ?>">
								<img class="img-src" src="image/storelist.png">
								<span class="icon-name">Store List</span>
							</td>
							<td class="tbl-icon-td img-icon" folder="inventory" active="<?php if(isset($_SESSION['inventory'])){echo $_SESSION['inventory'];} ?>">
								<img class="img-src" src="image/inventory.png">
								<span class="icon-name">Product List</span>
							</td>
						</tr>
						<tr>
							<th class="tbl-icon-header" colspan="10">Process</th>
						</tr>
						<tr>
							<td class="tbl-icon-td img-icon" folder="print" active="<?php if(isset($_SESSION['print'])){echo $_SESSION['print'];} ?>">
								<img class="img-src" src="image/printer.png">
								<span class="icon-name">Print Notepad</span>
							</td>
							<td class="tbl-icon-td img-icon" folder="logistic" active="<?php if(isset($_SESSION['schedule'])){echo $_SESSION['schedule'];} ?>">
								<img class="img-src" src="image/schedule.png">
								<span class="icon-name">Schedule</span>
							</td>
							<td class="tbl-icon-td img-icon" folder="clearing" active="<?php if(isset($_SESSION['clearing'])){echo $_SESSION['clearing'];} ?>">
								<img class="img-src" src="image/verify.png">
								<span class="icon-name">Clearing</span>
							</td>
							<td class="tbl-icon-td img-icon" folder="manual" active="<?php if(isset($_SESSION['manual'])){echo $_SESSION['manual'];} ?>">
								<img class="img-src" src="image/adddocument.png">
								<span class="icon-name">Add Manual</span>
							</td>
							<td class="tbl-icon-td img-icon" folder="fordeduct" active="<?php if(isset($_SESSION['fordeduct'])){echo $_SESSION['fordeduct'];} ?>">
								<img class="img-src" src="image/checking.png">
								<span class="icon-name">Ready for Deduct</span>
							</td>
							<td class="tbl-icon-td img-icon" folder="dmpiraw" active="<?php if(isset($_SESSION['dmpiraw'])){echo $_SESSION['dmpiraw'];} ?>">
								<img class="img-src" src="image/dmpi.png">
								<span class="icon-name">DMPI Raw</span>
							</td>
						</tr>
						<tr>
							<th class="tbl-icon-header" colspan="10">Deduction / Payment</th>
						</tr>
						<tr>
							<td class="tbl-icon-td img-icon" folder="deduction" active="<?php if(isset($_SESSION['deduction'])){echo $_SESSION['deduction'];} ?>">
								<img class="img-src" src="image/fordeduction.png">
								<span class="icon-name">Deduction</span>
							</td>
							<td class="tbl-icon-td img-icon" folder="document" active="<?php if(isset($_SESSION['document'])){echo $_SESSION['document'];} ?>">
								<img class="img-src" src="image/printdoc.png">
								<span class="icon-name">Deduct Summary</span>
							</td>
							<td class="tbl-icon-td img-icon" folder="paid" active="<?php if(isset($_SESSION['paiddeduction'])){echo $_SESSION['paiddeduction'];} ?>">
								<img class="img-src" src="image/paid.png">
								<span class="icon-name">Paid Deduction</span>
							</td>
							<td class="tbl-icon-td img-icon" folder="forpayment" active="<?php if(isset($_SESSION['payment'])){echo $_SESSION['payment'];} ?>">
								<img class="img-src" src="image/payment.png">
								<span class="icon-name">For Payment</span>
							</td>
						</tr>
						<tr>
							<th class="tbl-icon-header" colspan="10">Return to Supplier</th>
						</tr>
						<tr>
							<td class="tbl-icon-td img-icon" folder="return" active="<?php if(isset($_SESSION['returntosupplier'])){echo $_SESSION['returntosupplier'];} ?>">
								<img class="img-src" src="image/supplier.png">
								<span class="icon-name">Return to Supplier</span>
							</td>
							<td class="tbl-icon-td img-icon" folder="pullout" active="<?php if(isset($_SESSION['pulloutdoc'])){echo $_SESSION['pulloutdoc'];} ?>">
								<img class="img-src" src="image/printdoc.png">
								<span class="icon-name">Pull-out Summary</span>
							</td>
						</tr>
					</table>
				</div>
			</td>
			<td class="tbl-border-td3">
				<table class="tbl-sub-menu">
					<?php
					// import DOP
					if (isset($_SESSION['importdop']))
					{
						if ($_SESSION['importdop'] == 1)
						{
							?>
							<tr>
								<td class="tbl-sub-menu-td img-icon" folder="dop" active="<?php echo $_SESSION['importdop']; ?>">
									<img class="img-src-sub-menu" src="image/upload.png">
									Import DOP Portal
								</td>
							</tr>
							<?php
						}
					}

					// import Notepad and convert
					if (isset($_SESSION['import']))
					{
						if ($_SESSION['import'] == 1)
						{
							?>
							<tr>
								<td class="tbl-sub-menu-td img-icon" folder="convert" active="<?php echo $_SESSION['import']; ?>">
									<img class="img-src-sub-menu" src="image/import.png">
									Convert / Import Notepad
								</td>
							</tr>
							<?php
						}
					}

					// report
					if (isset($_SESSION['report']))
					{
						if ($_SESSION['report'] == 1)
						{
							?>
							<tr>
								<td class="tbl-sub-menu-td img-icon" folder="report" active="<?php echo $_SESSION['report']; ?>">
									<img class="img-src-sub-menu" src="image/report.png">
									Report
								</td>
							</tr>
							<?php
						}
					}

					// system setting
					if (isset($_SESSION['syssetting']))
					{
						if ($_SESSION['syssetting'] == 1)
						{
							?>
							<tr>
								<td class="tbl-sub-menu-td img-icon" folder="formsetting" active="<?php echo $_SESSION['syssetting']; ?>">
									<img class="img-src-sub-menu" src="image/setting.png">
									System Setting
								</td>
							</tr>
							<?php
						}
					}
					?>
				</table>
			</td>
		</tr>
		<tr>
			<td class="tbl-border-td4" colspan="4">
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

	<!-- form setting -->
	<div class="div-system-bg">
		<div class="div-system-form">
			<button type="button" class="button-setting-close" onclick="$('.div-system-bg').hide();">X Close</button>
			<table class="tbl-setting">
				<tr>
					<td class="tbl-setting-td1">
						<table class="tbl-button-menu">
							<?php
							if (isset($_SESSION['admin']) || isset($_SESSION['semiadmin']))
							{
								if ($_SESSION['admin'] == '1' || $_SESSION['semiadmin'] == '1')
								{
									?>
									<tr>
										<td class="tbl-button-menu-td" category="company">
											<img class="img-icon-setting" src="image/company.png">
											COMPANY
										</td>
									</tr>
									<tr>
										<td class="tbl-button-menu-td" category="user">
											<img class="img-icon-setting" src="image/user.png">
											</br>
											USER
										</td>
									</tr>
									<?php
								}

								if ($_SESSION['admin'] == '1')
								{
									?>
									<tr>
										<td class="tbl-button-menu-td" category="location">
											<img class="img-icon-setting" src="image/location.png">
											LOCATION
										</td>
									</tr>
									<tr>
										<td class="tbl-button-menu-td" category="maintenance">
											<img class="img-icon-setting" src="image/maintenance.png">
											</br>
											MAINTENANCE
										</td>
									</tr>
									<?php
								}
							}
							?>
						</table>
					</td>
					<td rowspan="5" class="tbl-setting-td2">
						<div class="div-load-data"></div>
					</td>
				</tr>
			</table>
		</div>
	</div>

	<!-- import data -->
	<div class="div-import-bg">
		<div class="div-form-import">
			<form class="FormImport" onsubmit="return UploadCSV();">
				<table class="tbl-import-form">
					<tr>
						<th class="tbl-import-form-th1" colspan="3">Import Data</th>
					</tr>
					<tr>
						<td class="tbl-import-form-space" colspan="3"></td>
					</tr>
					<tr>
						<th class="tbl-import-form-th2">Type Data:</th>
						<td class="tbl-import-form-td1" colspan="2">
							<select class="select-withBorder select-datatype">
								<option value="dbcensus">Store Detail</option>
								<option value="dbproduct">Product List</option>
								<option value="dbdmpireason">DMPI Reason</option>
							</select>
						</td>
					</tr>
					<tr>
						<th class="tbl-import-form-th2">Mode Process:</th>
						<td class="tbl-import-form-td1" colspan="2">
							<select class="select-withBorder select-process">
								<option value="1">Delete and Import</option>
								<option value="0">Import Only</option>
							</select>
						</td>
					</tr>
					<tr>
						<th class="tbl-import-form-th2">Select File:</th>
						<td class="tbl-import-form-td1">
							<input type="text" class="input-withBorder input-path" totalline="" style="cursor: context-menu;" readonly="readonly">
							<input type="file" class="input-file-style UploadCsvFile" onchange="FileLocation();" accept=".csv">
						</td>
						<td class="tbl-import-form-td2">
							<button type="button" class="button-tableWithBorder-style input-browse" onclick="SelectFile();">Browse</button>
						</td>
					</tr>
					<tr>
						<td class="tbl-import-form-td4" colspan="3">
							<div class="div-loading-bar">0%</div>
						</td>
					</tr>
					<tr>
						<td class="tbl-import-form-td3" colspan="3">
							<button class="button-tableBottom-Style button-importdata">Import</button>
							<button type="button" class="button-tableBottom-Style button-importcancel" onclick="CloseImport();">Cancel</button>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>

	<!-- change password -->
	<div class="div-bg-change-password">
		<form class="form-change-pass" onsubmit="return ChangePassword();">
			<table class="tbl-form-change">
				<tr>
					<th class="tbl-form-change-th1" colspan="2">Change Password</th>
				</tr>
				<tr>
					<th class="tbl-form-change-th2">Username:</th>
					<td class="tbl-form-change-td1">
						<input type="text" class="input-change-pass-style input-username" value="<?php echo $_SESSION['username']; ?>" readonly="readonly">
					</td>
				</tr>
				<tr>
					<td class="tbl-form-change-space" colspan="2"></td>
				</tr>
				<tr>
					<th class="tbl-form-change-th2">Name:</th>
					<td class="tbl-form-change-td1">
						<input type="text" class="input-change-pass-style" value="<?php echo $_SESSION['fname']; ?>" readonly="readonly">
					</td>
				</tr>
				<tr>
					<td class="tbl-form-change-space" colspan="2"></td>
				</tr>
				<tr>
					<th class="tbl-form-change-th2">New Password:</th>
					<td class="tbl-form-change-td1">
						<input type="password" class="input-change-pass-style input-newpassword" minlength="5" maxlength="10" required="required">
					</td>
				</tr>
				<tr>
					<td class="tbl-form-change-space" colspan="2"></td>
				</tr>
				<tr>
					<td class="tbl-form-change-td2" colspan="2">
						<button class="button-change-style">Save</button>
						<button type="button" class="button-change-style" onclick="HidePassword();">Cancel</button>
					</td>
				</tr>
			</table>
		</form>
	</div>

	<!-- access notify -->
	<div class="div-notify-bg">
		<div class="div-form">
			<button type="button" class="button-denied">X</button>
			<span class="span-alert-message">
				Sorry, you don't have permission to perform this action! Please ask your system administrator to adjust your access rights.
			</span>
			<br>
			<button type="button" class="button-access-style" onclick="$('.div-notify-bg').hide();">OK</button>
		</div>
	</div>

	<!-- notify alert -->
	<span class="span-notify-alert"></span>
</body>
</html>
<?php $conn->close(); ?>
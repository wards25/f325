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
	<title>DMPI Raw</title>
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
				<button type="button" class="button-withBorderBg" onclick="ShowForm();">CREATE</button>
			</td>
		</tr>
		<tr>
			<td class="tbl-border-td3" colspan="2">
				<div class="div-list-scroll">
					<table class="tbl-list-order">
						<tr>
							<th class="tbl-list-order-th1">Reference #</th>
							<th class="tbl-list-order-th2">Transac #</th>
							<th class="tbl-list-order-th3">Classification</th>
							<th class="tbl-list-order-th4">Created By</th>
							<th class="tbl-list-order-th5">Status</th>
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

	<!-- form raw -->
	<div class="div-form-bg">
		<form class="div-form" onsubmit="return SaveRaw();">
			<table class="tbl-form">
				<tr>
					<td class="tbl-form-td1">
						<button class="button-withBorderBg button-save">SAVE</button>
						<button type="button" class="button-withBorderBg button-discard" onclick="CloseForm();">DISCARD</button>
						<button type="button" class="button-withBorderBg button-export-csv">EXPORT CSV</button>
						<button type="button" class="button-withBorderBg button-history">HISTORY</button>
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
					<th class="tbl-form-th1" reference=""></th>
				</tr>
				<tr>
					<td class="tbl-form-td2">
						<label class="lbl-class">Classification:</label>
						<select class="select-withBorder select-class" onchange="ShowResult();">
							<?php
							$class_query = mysqli_query($conn,"SELECT dmpiclassification FROM dbproduct GROUP BY dmpiclassification ORDER BY dmpiclassification ASC");
							while ($fetch_class = mysqli_fetch_array($class_query))
							{
								if (empty($fetch_class['dmpiclassification']))
								{
									// code...
								}
								else
								{
									?>
									<option value="<?php echo $fetch_class['dmpiclassification']; ?>"><?php echo $fetch_class['dmpiclassification']; ?></option>
									<?php
								}
							}
							?>
						</select>
						<label class="lbl-class">Transact #:</label>
						<input type="text" class="input-withBorder input-form-transact" onkeyup="" disabled="disabled">
						<label class="lbl-class">Status:</label>
						<input type="text" class="input-withBorder input-form-status" value="FOR UPLOAD" disabled="disabled">
					</td>
				</tr>
				<tr>
					<td class="tbl-form-td3">
						<div class="div-list-scroll">
							<table class="tbl-raw">
								<tr>
									<th class="tbl-raw-th1">MDC Code</th>
									<th class="tbl-raw-th2">DMPI Code</th>
									<th class="tbl-raw-th3">Description</th>
									<th class="tbl-raw-th4">Quantity</th>
									<th class="tbl-raw-th5">Reason</th>
									<th class="tbl-raw-th6">Expiry</th>
								</tr>
								<tbody class="tbody-list-raw"></tbody>
							</table>
						</div>
					</td>
				</tr>
			</table>
		</form>
	</div>

	<!-- notify alert -->
	<span class="span-notify-alert">Successfully added!</span>
</body>
</html>
<?php $conn->close(); ?>
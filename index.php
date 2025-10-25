<?php
session_start();
include('db.php');
require_once('require/unset.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="expires" content="Sun, 01 Jan 2014 00:00:00 GMT"/>
	<meta http-equiv="pragma" content="no-cache" />
	<title>F325 Login</title>
	<link rel="icon" type="img/png" href="image/rsdilogo.png">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/index.js"></script>
</head>
<body>
	<?php
	// check session if destroy for maintenance

	$check_query = mysqli_query($conn,"SELECT * FROM dbmaintenance");
	$fetch_check = mysqli_fetch_array($check_query);

	if ($fetch_check['sessiondestroy'] == '1')
	{
		?>
		<span class="span-maintenance-msg">
			<p class="p-message">We'll Be Right Back!</p>
			<p1 class="p1-message">Sorry, we are down for maintenance but will be back in soon!</p1>
		</span>
		<?php
	}
	else
	{
		?>
		<form class="form-login" onsubmit="return Login();">
			<table class="tbl-login">
				<tr>
					<th colspan="2" class="tbl-login-th">B.O. Monitoring</th>
				</tr>
				<tr>
					<th class="login-lbl-header">Username:</th>
					<td class="login-lbl-td">
						<input type="text" class="input-withBorder input-username" maxlength="15">
					</td>
				</tr>
				<tr>
					<th class="login-lbl-header">Password:</th>
					<td class="login-lbl-td">
						<input type="password" class="input-withBorder input-password" maxlength="10" required="required">
					</td>
				</tr>
				<tr>
					<td class="login-button" colspan="2">
						<button class="button-login">Login</button>
					</td>
				</tr>
				<tr>
					<td></td>
				</tr>
			</table>
		</form>
		<?php
	}
	?>

	<!-- notify alert -->
	<span class="span-notify-alert"></span>
</body>
</html>
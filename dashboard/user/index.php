<?php include('db.php'); ?>
<script type="text/javascript">
	$(document).ready(function(){
		CheckAdmin();
	});
</script>
<form class="form-user" onsubmit="return NewUser();">
	<table class="tbl-user">
		<tr>
			<th class="tbl-user-th" colspan="4">User Account</th>
		</tr>
		<tr>
			<td class="tbl-user-td1">Select User:</td>
			<td class="tbl-user-td2">
				<select class="select-withBorder select-user" onchange="SelectUser();OnsubmitUserValue();">
					<option value="addnew">Add New...</option>
					<?php
					$user_query = mysqli_query($conn,"SELECT * FROM dbuser ORDER BY fname ASC ");
					while ($fetch_user = mysqli_fetch_array($user_query))
					{
						?>
						<option value="<?php echo $fetch_user['id']; ?>"><?php echo $fetch_user['fname']; ?></option>
						<?php
					}
					?>
				</select>
			</td>
			<td class="tbl-user-td1">Name:</td>
			<td class="tbl-user-td2">
				<input type="text" class="input-withBorder input-form-field input-fname" required="required">
			</td>
		</tr>
		<tr>
			<td class="tbl-user-td1">Username:</td>
			<td class="tbl-user-td2">
				<input type="text" class="input-withBorder input-form-field input-username" maxlength="15" required="required">
			</td>
			<td class="tbl-user-td1">Password:</td>
			<td class="tbl-user-td2">
				<input type="password" class="input-withBorder input-form-field input-password" maxlength="10" required="required">
			</td>
		</tr>
		<tr>
			<td class="tbl-user-td3" colspan="4">
				<div style="overflow-y: auto;height: 100%;width: 100%;">
					<table class="tbl-user-access">
						<tr>
							<th class="tbl-user-access-th" colspan="10">Super User Access</th>
						</tr>
						<tr>
							<td class="tbl-user-access-td1">
								<input type="checkbox" class="input-checkbox input-admin" value="1">
							</td>
							<td class="tbl-user-access-td2">Full Admin</td>
							<td class="tbl-user-access-td1">
								<input type="checkbox" class="input-checkbox input-form-field input-active" value="1">
							</td>
							<td class="tbl-user-access-td2">Active</td>
							<td class="tbl-user-access-td1">
								<input type="checkbox" class="input-checkbox input-form-field input-semiadmin" value="1">
							</td>
							<td class="tbl-user-access-td2">Semi-Admin</td>
							<td class="tbl-user-access-td1"></td>
							<td class="tbl-user-access-td2"></td>
							<td class="tbl-user-access-td1"></td>
							<td class="tbl-user-access-td2"></td>
						</tr>
						<tr>
							<th class="tbl-user-access-th" colspan="10">Company Access</th>
						</tr>
						<tr>
							<?php
							for ($icomp1 = 1; $icomp1 <= 5 ; $icomp1++)
							{
								// get company nickname
								$nickname_query = mysqli_query($conn,"SELECT * FROM dbcompany WHERE id='$icomp1' ");
								$fetch_nickname = mysqli_fetch_array($nickname_query);
								?>
								<td class="tbl-user-access-td1">
									<input type="checkbox" class="input-checkbox input-form-field input-comp<?php echo $fetch_nickname['id']; ?>" value="1">
								</td>
								<td class="tbl-user-access-td2"><?php echo $fetch_nickname['nickname']; ?></td>
								<?php
							}
							?>
						</tr>
						<tr>
							<?php
							for ($icomp2 = 6; $icomp2 <= 10 ; $icomp2++)
							{
								// get company nickname
								$nickname_query = mysqli_query($conn,"SELECT * FROM dbcompany WHERE id='$icomp2' ");
								$fetch_nickname = mysqli_fetch_array($nickname_query);
								?>
								<td class="tbl-user-access-td1">
									<input type="checkbox" class="input-checkbox input-form-field input-comp<?php echo $fetch_nickname['id']; ?>" value="1">
								</td>
								<td class="tbl-user-access-td2"><?php echo $fetch_nickname['nickname']; ?></td>
								<?php
							}
							?>
						</tr>
						<tr>
							<th class="tbl-user-access-th" colspan="10">Location Access</th>
						</tr>
						<tr>
							<?php
							for ($iloc1 = 1; $iloc1 <= 5 ; $iloc1++)
							{ 
								// get location name
								$location_query = mysqli_query($conn,"SELECT * FROM dblocation WHERE id='$iloc1'");
								$fetch_location = mysqli_fetch_array($location_query);
								?>
								<td class="tbl-user-access-td1">
									<input type="checkbox" class="input-checkbox input-form-field input-loc<?php echo $fetch_location['id']; ?>" value="1">
								</td>
								<td class="tbl-user-access-td2"><?php echo $fetch_location['location']; ?></td>
								<?php
							}
							?>
						</tr>
						<tr>
							<?php
							for ($iloc2 = 6; $iloc2 <= 10 ; $iloc2++)
							{ 
								// get location name
								$location_query = mysqli_query($conn,"SELECT * FROM dblocation WHERE id='$iloc2'");
								$fetch_location = mysqli_fetch_array($location_query);
								?>
								<td class="tbl-user-access-td1">
									<input type="checkbox" class="input-checkbox input-form-field input-loc<?php echo $fetch_location['id']; ?>" value="1">
								</td>
								<td class="tbl-user-access-td2"><?php echo $fetch_location['location']; ?></td>
								<?php
							}
							?>
						</tr>
						<tr>
							<th class="tbl-user-access-th" colspan="10">Process Access</th>
						</tr>
						<tr>
							<td class="tbl-user-access-td1">
								<input type="checkbox" class="input-checkbox input-form-field input-print" value="1">
							</td>
							<td class="tbl-user-access-td2">Print</td>
							<td class="tbl-user-access-td1">
								<input type="checkbox" class="input-checkbox input-form-field input-schedule" value="1">
							</td>
							<td class="tbl-user-access-td2">Schedule</td>
							<td class="tbl-user-access-td1">
								<input type="checkbox" class="input-checkbox input-form-field input-clearing" value="1">
							</td>
							<td class="tbl-user-access-td2">Clearing</td>
							<td class="tbl-user-access-td1">
								<input type="checkbox" class="input-checkbox input-form-field input-manual" value="1">
							</td>
							<td class="tbl-user-access-td2">Manual</td>
							<td class="tbl-user-access-td1">
								<input type="checkbox" class="input-checkbox input-form-field input-dmpiraw" value="1">
							</td>
							<td class="tbl-user-access-td2">DMPI Raw</td>
						</tr>
						<tr>
							<td class="tbl-user-access-td1">
								<input type="checkbox" class="input-checkbox input-form-field input-fordeduct" value="1">
							</td>
							<td class="tbl-user-access-td2">For Deduct</td>
							<td class="tbl-user-access-td1">
								<input type="checkbox" class="input-checkbox input-form-field input-borfapps" value="1">
							</td>
							<td class="tbl-user-access-td2">BORF Apps</td>
							<td class="tbl-user-access-td1"></td>
							<td class="tbl-user-access-td2"></td>
							<td class="tbl-user-access-td1"></td>
							<td class="tbl-user-access-td2"></td>
							<td class="tbl-user-access-td1"></td>
							<td class="tbl-user-access-td2"></td>
						</tr>
						<tr>
							<th class="tbl-user-access-th" colspan="10">Deduction / Payment Access</th>
						</tr>
						<tr>
							<td class="tbl-user-access-td1">
								<input type="checkbox" class="input-checkbox input-form-field input-deduction" value="1">
							</td>
							<td class="tbl-user-access-td2">Deduction</td>
							<td class="tbl-user-access-td1">
								<input type="checkbox" class="input-checkbox input-form-field input-deductdoc" value="1">
							</td>
							<td class="tbl-user-access-td2">Deduction Doc.</td>
							<td class="tbl-user-access-td1">
								<input type="checkbox" class="input-checkbox input-form-field input-paiddeduction" value="1">
							</td>
							<td class="tbl-user-access-td2">Paid Deduction</td>
							<td class="tbl-user-access-td1">
								<input type="checkbox" class="input-checkbox input-form-field input-payment" value="1">
							</td>
							<td class="tbl-user-access-td2">Payment</td>
						</tr>
						<tr>
							<th class="tbl-user-access-th" colspan="10">Return to Principal Access</th>
						</tr>
						<tr>
							<td class="tbl-user-access-td1">
								<input type="checkbox" class="input-checkbox input-form-field input-rts" value="1">
							</td>
							<td class="tbl-user-access-td2">RTS</td>
							<td class="tbl-user-access-td1">
								<input type="checkbox" class="input-checkbox input-form-field input-pulloutdoc" value="1">
							</td>
							<td class="tbl-user-access-td2">Pull-Out Doc.</td>
						</tr>
						<tr>
							<th class="tbl-user-access-th" colspan="10">Import / System Access</th>
						</tr>
						<tr>
							<td class="tbl-user-access-td1">
								<input type="checkbox" class="input-checkbox input-form-field input-import" value="1">
							</td>
							<td class="tbl-user-access-td2">Import</td>
							<td class="tbl-user-access-td1">
								<input type="checkbox" class="input-checkbox input-form-field input-importdop" value="1">
							</td>
							<td class="tbl-user-access-td2">Import DOP</td>
							<td class="tbl-user-access-td1">
								<input type="checkbox" class="input-checkbox input-form-field input-report" value="1">
							</td>
							<td class="tbl-user-access-td2">Report</td>
							<td class="tbl-user-access-td1">
								<input type="checkbox" class="input-checkbox input-form-field input-syssetting" value="1">
							</td>
							<td class="tbl-user-access-td2">System</td>
							<td class="tbl-user-access-td1"></td>
							<td class="tbl-user-access-td2"></td>
							<td class="tbl-user-access-td1"></td>
							<td class="tbl-user-access-td2"></td>
						</tr>
						<tr>
							<td class="tbl-user-access-td1">
								<input type="checkbox" class="input-checkbox input-form-field input-store" value="1">
							</td>
							<td class="tbl-user-access-td2">Store List</td>
							<td class="tbl-user-access-td1">
								<input type="checkbox" class="input-checkbox input-form-field input-inventory" value="1">
							</td>
							<td class="tbl-user-access-td2">Inventory</td>
							<td class="tbl-user-access-td1"></td>
							<td class="tbl-user-access-td2"></td>
							<td class="tbl-user-access-td1"></td>
							<td class="tbl-user-access-td2"></td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
		<tr>
			<td class="tbl-user-td1" colspan="4" style="text-align:right;">
				<button class="button-user button-user-save">Save</button>
				<button type="button" class="button-user" onclick="UnloadUser();">Cancel</button>
			</td>
		</tr>
	</table>
</form>

<?php $conn->close(); ?>
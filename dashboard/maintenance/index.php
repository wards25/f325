<form class="form-maintenance" onsubmit="return MaintenanceUpdate();">
	<input type="hidden" class="input-maintenance-id">
	<table class="tbl-maintenance">
		<tr>
			<th class="tbl-maintenance-th1" colspan="10">System Maintenance</th>
		</tr>
		<tr>
			<th class="tbl-maintenance-th-menu">All Session Destroy</th>
			<td>
				<input type="checkbox" class="input-checkbox input-maintenance-checkbox input-maintenance-session" value="1">
			</td>
			<th class="tbl-maintenance-th-menu">Announcement Active</th>
			<td>
				<input type="checkbox" class="input-checkbox input-maintenance-checkbox input-maintenance-announcement" value="1">
			</td>
			<th></th>
			<td></td>
			<th></th>
			<td></td>
			<th></th>
			<td></td>
		</tr>
		<tr>
			<th class="tbl-maintenance-th1" colspan="10">System Message</th>
		</tr>
		<tr>
			<th class="tbl-maintenance-th2">Announcement:</th>
			<td colspan="8">
				<textarea class="textarea-withBorder textarea-msg" onclick="$(this).select();" disabled="disabled"></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="10">
				<button class="button-withBorder">Update</button>
			</td>
		</tr>
	</table>
</form>
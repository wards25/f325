<form class="form-company" onsubmit="return UpdateCompany();">
	<table class="tbl-company">
	<tr>
		<th colspan="4" class="tbl-company-th">Company</th>
	</tr>
	<tr>
		<td class="tbl-company-td1">Company:</td>
		<td class="tbl-company-td2" colspan="3">
			<select class="select-withBorder select-company select-list-company" onchange="SelectCompany();"></select>
		</td>
	</tr>
	<tr>
		<td class="tbl-company-td1">Name:</td>
		<td class="tbl-company-td2" colspan="3">
			<input type="text" class="input-withBorder input-companyname" required="required">
		</td>
	</tr>
	<tr>
		<td class="tbl-company-td1">Nickname:</td>
		<td class="tbl-company-td2">
			<input type="text" class="input-withBorder input-nickname" required="required">
		</td>
		<td class="tbl-company-td1"></td>
		<td class="tbl-company-td2"></td>
	</tr>
	<tr>
		<td class="tbl-company-td1">Ref. Code:</td>
		<td class="tbl-company-td2">
			<input type="text" class="input-withBorder input-referencecode" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required="required">
		</td>
		<td class="tbl-company-td1">Vendor Code:</td>
		<td class="tbl-company-td2">
			<input type="text" class="input-withBorder input-vendorcode" required="required">
		</td>
	</tr>
	<tr>
		<td class="tbl-company-td3">Company Address:</td>
		<td class="tbl-company-td4" colspan="3">
			<textarea class="textarea-withBorder textarea-address"></textarea>
		</td>
	</tr>
	<tr>
		<td class="tbl-company-td5" colspan="4">
			<div style="overflow-y: auto;height: 100%;width: 100%;">
				<table class="tbl-company-process">
					<tr>
						<th class="tbl-company-process-th" colspan="8">Process</th>
					</tr>
					<tr>
						<td class="tbl-company-process-td1">
							<input type="checkbox" class="input-checkbox input-active" value="1">
						</td>
						<td class="tbl-company-process-td2">Active</td>
						<td class="tbl-company-process-td1">
							<input type="checkbox" class="input-checkbox input-bypass" value="1">
						</td>
						<td class="tbl-company-process-td2">Bypass Deduct</td>
						<td class="tbl-company-process-td1"></td>
						<td class="tbl-company-process-td2"></td>
						<td class="tbl-company-process-td1"></td>
						<td class="tbl-company-process-td2"></td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
	<tr>
		<td class="tbl-company-td1" colspan="4" style="text-align:right;">
			<button class="button-company">Update</button>
			<button type="button" class="button-company" onclick="UnloadCompany();">Cancel</button>
		</td>
	</tr>
</table>
</form>
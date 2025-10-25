<script type="text/javascript">
	$(document).ready(function(){
		LoadLocation();
	});
</script>
<form class="form-location" onsubmit="return UpdateLocation();">
	<table class="tbl-location">
		<tr>
			<th class="tbl-location-th">Location</th>
		</tr>
		<tr>
			<td class="tbl-location-td1">
				<div style="overflow-y: auto;height: 100%;width: 100%;">
					<table class="tbl-list-location">
						<tbody class="tbody-list-location"></tbody>
					</table>
				</div>
			</td>
		</tr>
		<tr>
			<td class="tbl-location-td2">
				<button class="button-location-style">Save</button>
				<button type="button" class="button-location-style" onclick="UnloadLocation();">Cancel</button>
			</td>
		</tr>
	</table>
</form>
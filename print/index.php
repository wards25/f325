<?php
session_start();
require_once('require/nocache.php');
include('db.php');

$username = $_SESSION['user'];
$usertype = $_SESSION['usertype'];
$size = $_SESSION['storesize'];
$code = $_POST['code'];
$brcode = $_SESSION['code'];

if ($_SESSION['company'] == 'unilever') {
	$vendor = $_POST['vendor'];
	$prd_query = mysqli_query($conn, "SELECT * FROM custom WHERE company='$vendor' GROUP BY tagging ORDER BY tagging ASC ");
} else if ($_SESSION['company'] == 'clutch') {
	$vendor = $_POST['vendor'];
	$prd_query = mysqli_query($conn, "SELECT * FROM productlist WHERE company='$vendor' AND osaorder>='1' GROUP BY bu ORDER BY bu ASC ");
} else if ($_SESSION['company'] == 'carbon') {
	if ($usertype == 'bmssw') {
		$vendor = 'CARBON';
		$prd_query = mysqli_query($conn, "SELECT * FROM custom WHERE company='$vendor' AND osa>='1' ORDER BY header ASC ");
	} else {
		$vendor = 'GASCON';
		$prd_query = mysqli_query($conn, "SELECT * FROM custom WHERE company='$vendor' AND osa>='1' ORDER BY header ASC ");
	}
} else {
	$vendor = $_POST['vendor'];
	$prd_query = mysqli_query($conn, "SELECT * FROM custom WHERE company='$vendor' AND osa>='1' ORDER BY header ASC ");
}

$row = mysqli_num_rows($prd_query);

if ($row >= 1) {
	while ($fetch_prd = mysqli_fetch_array($prd_query)) {

		?>
		<tr>
			<td colspan="2">
				<table class="tbl-custom">
					<?php
					$header = isset($fetch_prd['header']) ? $fetch_prd['header'] : null;
					$bu = isset($fetch_prd['bu']) ? $fetch_prd['bu'] : null;
					$tagging = isset($fetch_prd['tagging']) ? $fetch_prd['tagging'] : null;

					// census detail
					$census_query = mysqli_query($conn, "SELECT region FROM census WHERE code='$code' ");
					$fetch_census = mysqli_fetch_array($census_query);

					if (is_array($fetch_census)) {
						$region = $fetch_census['region'];
						// GMA AND EXPANDED GMA
						if (($region == 'GMA' || $region == 'EXPANDED GMA') && ($header == 'SNAIL WHITE' || $header == 'OXECURE' || $header == 'SPARKLE' || $header == 'TRIZIE' || $header == 'SOLA' || $header == 'VITANATURE' || $header == 'TROPICANA') && $usertype == 'bmssw') {
							$getprd_query = mysqli_query($conn, "SELECT * FROM productlist WHERE tagging='$tagging' AND category='$header' AND company='$vendor' AND mcl='1' AND storesize LIKE '%$size%' ORDER BY osaorder ASC ");

							$count = mysqli_num_rows($getprd_query);

							if ($count >= 1) {
								?>
								<tr>
									<th class="th-custom" colspan="5"><?php echo $fetch_prd['header']; ?></th>
								</tr>
								<tr>
									<th class="th-custom1 tbl-th-design" rowspan="2">Description</th>
									<th class="th-custom2 tbl-th-design" rowspan="2">AVAIL</th>
									<th class="th-custom3 tbl-th-design" rowspan="2">OOS</th>
									<th class="th-custom3 tbl-th-design" colspan="4"><i>(IF OOS)</i></th>
								<tr>
									<th class="th-custom3 tbl-th-design">NO STOCKS DC</th>
									<th class="th-custom3 tbl-th-design">NO STOCK TRANSFER FROM DC TO STORE</th>
									<th class="th-custom3 tbl-th-design">LOW PROMO OFF TAKE</th>
								</tr>
					</tr>
					<?php
					$avail = 1;
					$oos = 0;
					$option1 = 'A';
					$option2 = 'B';
					$option3 = 'C';
					while ($fetch_getprd = mysqli_fetch_array($getprd_query)) {
						?>
						<tr class="tr-prd-list">
							<td class="td-description"><?php echo $fetch_getprd['mdccode'] . ' - ' . $fetch_getprd['description']; ?></td>
							<input type="hidden" name="mdccode[<?php echo $fetch_getprd['id']; ?>]"
								value="<?php echo $fetch_getprd['mdccode']; ?>">
							<td class="td-custom">
								<input type="radio" class="avail" name="choice[<?php echo $fetch_getprd['id']; ?>]"
									value="<?php echo $avail; ?>" required>
							</td>
							<td class="td-custom">
								<input type="radio" class="oos" name="choice[<?php echo $fetch_getprd['id']; ?>]" value="<?php echo $oos; ?>"
									required>
							</td>
							<!-- options if OOS -->
							<td class="td-custom">
								<input type="radio" class="option1" name="option[<?php echo $fetch_getprd['id']; ?>]"
									value="<?php echo $option1; ?>" disabled>
							</td>
							<td class="td-custom">
								<input type="radio" class="option2" name="option[<?php echo $fetch_getprd['id']; ?>]"
									value="<?php echo $option2; ?>" disabled>
							</td>
							<td class="td-custom">
								<input type="radio" class="option3" name="option[<?php echo $fetch_getprd['id']; ?>]"
									value="<?php echo $option3; ?>" disabled>
							</td>
						</tr>
						<?php
					}
							}
						} elseif ($region == 'NORTH LUZON' || $region == 'SOUTH LUZON' || $region == 'VISAYAS' || $region == 'MINDANAO') {
							if ($_SESSION['company'] == 'unilever') {
								// $cluster_query = mysqli_query($conn,"SELECT * FROM census WHERE $usertype = '$username'"); #original code 05/06/2024
								$cluster_query = mysqli_query($conn, "SELECT * FROM census WHERE code = '$brcode'");
								$fetch_cluster = mysqli_fetch_array($cluster_query);

								$cluster = $fetch_cluster['cluster'];
								if ($cluster == 'o') {
									$cluster = 'c';
								} else {
									$cluster = $fetch_cluster['cluster'];
								}

								$getprd_query = mysqli_query($conn, "SELECT * FROM productlist WHERE tagging='$tagging' AND company='$vendor' AND mcl='1' AND $size LIKE '%$cluster%' ORDER BY description ASC ");
							} else if ($_SESSION['company'] == 'clutch') {
								$getprd_query = mysqli_query($conn, "SELECT * FROM productlist WHERE bu='$bu' AND company='$vendor' AND mcl='1' AND storesize LIKE '%$size%' ORDER BY osaorder ASC ");
							} else {
								// $cluster_query = mysqli_query($conn,"SELECT * FROM census WHERE code = '$brcode'");
								$getprd_query = mysqli_query($conn, "SELECT * FROM productlist WHERE tagging='$tagging' AND category='$header' AND company='$vendor' AND mcl='1' AND storesize LIKE '%$size%' ORDER BY osaorder ASC ");
							}

							$count = mysqli_num_rows($getprd_query);

							if ($count >= 1) {
								?>
					<tr>
						<?php
						if ($_SESSION['company'] == 'unilever') {
							echo '<th class="th-custom" colspan="4">' . $fetch_prd['tagging'] . '</th>';
						} else if ($_SESSION['company'] == 'clutch') {
							echo '<th class="th-custom" colspan="4">' . $fetch_prd['bu'] . '</th>';
						} else {
							echo '<th class="th-custom" colspan="4">' . $fetch_prd['header'] . '</th>';
						}
						?>
					</tr>

					<?php
					if ($_SESSION['company'] == 'clutch') {
						$lastencode_query = mysqli_query($conn, "SELECT * FROM dbosa WHERE code = '$code' ORDER BY dateprocessed DESC");
						$last_maxcap_data = [];

						while ($row_encode = mysqli_fetch_array($lastencode_query)) {
							$last_maxcap_data[$row_encode['mdccode']] = $row_encode['maxcap'];
						}
						?>
						<tr>
							<th class="th-custom1 tbl-th-design">Description</th>
							<th class="th-custom2 tbl-th-design">AVAIL</th>
							<th class="th-custom3 tbl-th-design">OOS</th>
							<th class="th-custom3 tbl-th-design">MAXCAP</th>
							<!-- <th class="th-custom3 tbl-th-design">BU</th> -->
						</tr>
						<?php
						$avail = 1;
						$oos = 0;
						while ($fetch_getprd = mysqli_fetch_array($getprd_query)) {
							$mdc = $fetch_getprd['mdccode'];
							$maxcap_value = isset($last_maxcap_data[$mdc]) ? $last_maxcap_data[$mdc] : 0;
							?>
							<tr class="tr-prd-list">
								<td class="td-description"><?php echo $fetch_getprd['mdccode'] . ' - ' . $fetch_getprd['description']; ?></td>
								<input type="hidden" name="mdccode[<?php echo $fetch_getprd['id']; ?>]"
									value="<?php echo $fetch_getprd['mdccode']; ?>">
								<td class="td-custom">
									<input type="radio" name="choice[<?php echo $fetch_getprd['id']; ?>]" value="<?php echo $avail; ?>" required>
								</td>
								<td class="td-custom">
									<input type="radio" name="choice[<?php echo $fetch_getprd['id']; ?>]" value="<?php echo $oos; ?>" required>
								</td>
								<td class="td-custom" style="width: 35px; height: 30px; max-width: 35px; overflow: hidden;">
									<input type="number" name="maxcap[<?php echo $fetch_getprd['id']; ?>]" value="<?php echo $maxcap_value; ?>"
										required>
								</td>
								<!-- <td class="td-description"><center><?php echo $fetch_getprd['bu']; ?></center></td> -->
							</tr>
							<?php
						}
					} else {
						?>
						<tr>
							<th class="th-custom1 tbl-th-design">Description</th>
							<th class="th-custom2 tbl-th-design">AVAILABLE</th>
							<th class="th-custom3 tbl-th-design">OOS</th>
						</tr>
						<?php
						$avail = 1;
						$oos = 0;
						while ($fetch_getprd = mysqli_fetch_array($getprd_query)) {
							?>
							<tr class="tr-prd-list">
								<td class="td-description"><?php echo $fetch_getprd['mdccode'] . ' - ' . $fetch_getprd['description']; ?></td>
								<input type="hidden" name="mdccode[<?php echo $fetch_getprd['id']; ?>]"
									value="<?php echo $fetch_getprd['mdccode']; ?>">
								<td class="td-custom">
									<input type="radio" name="choice[<?php echo $fetch_getprd['id']; ?>]" value="<?php echo $avail; ?>" required>
								</td>
								<td class="td-custom">
									<input type="radio" name="choice[<?php echo $fetch_getprd['id']; ?>]" value="<?php echo $oos; ?>" required>
								</td>
							</tr>
							<?php
						}
					}
							}
						} elseif (($region == 'GMA' || $region == 'EXPANDED GMA') && ($usertype == 'bms' || $usertype == 'coor' || $usertype == 'rsm' || $usertype == 'reliever')) {

							if (($header == 'SNAIL WHITE' || $header == 'OXECURE' || $header == 'SPARKLE' || $header == 'TRIZIE' || $header == 'SOLA' || $header == 'VITANATURE' || $header == 'TROPICANA' || $header == 'PROMO PACK')) {
								// code...
							} else {
								if ($_SESSION['company'] == 'unilever') {
									// $cluster_query = mysqli_query($conn,"SELECT * FROM census WHERE $usertype = '$username'"); #original code 05/06/2024
									$cluster_query = mysqli_query($conn, "SELECT * FROM census WHERE code = '$brcode'");
									$fetch_cluster = mysqli_fetch_array($cluster_query);

									$cluster = $fetch_cluster['cluster'];
									if ($cluster == 'o') {
										$cluster = 'c';
									} else {
										$cluster = $fetch_cluster['cluster'];
									}

									$getprd_query = mysqli_query($conn, "SELECT * FROM productlist WHERE tagging='$tagging' AND company='$vendor' AND mcl='1' AND $size LIKE '%$cluster%' ORDER BY description ASC ");
								} else if ($_SESSION['company'] == 'clutch') {
									$getprd_query = mysqli_query($conn, "SELECT * FROM productlist WHERE bu='$bu' AND company='$vendor' AND mcl='1' AND storesize LIKE '%$size%' ORDER BY osaorder ASC ");
								} else {
									// $cluster_query = mysqli_query($conn,"SELECT * FROM census WHERE code = '$brcode'");
									$getprd_query = mysqli_query($conn, "SELECT * FROM productlist WHERE tagging='$tagging' AND category='$header' AND company='$vendor' AND mcl='1' AND storesize LIKE '%$size%' ORDER BY osaorder ASC ");
								}

								$count = mysqli_num_rows($getprd_query);

								if ($count >= 1)
								// if ($count > 0)
								{
									?>
						<tr>
							<?php
							if ($_SESSION['company'] == 'unilever') {
								echo '<th class="th-custom" colspan="4">' . $fetch_prd['tagging'] . '</th>';
							} else if ($_SESSION['company'] == 'clutch') {
								echo '<th class="th-custom" colspan="4">' . $fetch_prd['bu'] . '</th>';
							} else {
								echo '<th class="th-custom" colspan="4">' . $fetch_prd['header'] . '</th>';
							}
							?>
						</tr>

						<?php
						if ($_SESSION['company'] == 'clutch') {
							$lastencode_query = mysqli_query($conn, "SELECT * FROM dbosa WHERE code = '$code' ORDER BY dateprocessed DESC");
							$last_maxcap_data = [];

							while ($row_encode = mysqli_fetch_array($lastencode_query)) {
								$last_maxcap_data[$row_encode['mdccode']] = $row_encode['maxcap'];
							}
							?>
							<tr>
								<th class="th-custom1 tbl-th-design">Description</th>
								<th class="th-custom2 tbl-th-design">AVAIL</th>
								<th class="th-custom3 tbl-th-design">OOS</th>
								<th class="th-custom3 tbl-th-design">MAXCAP</th>
								<!-- <th class="th-custom3 tbl-th-design">BU</th> -->
							</tr>
							<?php
							$avail = 1;
							$oos = 0;
							while ($fetch_getprd = mysqli_fetch_array($getprd_query)) {
								$mdc = $fetch_getprd['mdccode'];
								$maxcap_value = isset($last_maxcap_data[$mdc]) ? $last_maxcap_data[$mdc] : 0;
								?>
								<tr class="tr-prd-list">
									<td class="td-description"><?php echo $fetch_getprd['mdccode'] . ' - ' . $fetch_getprd['description']; ?></td>
									<input type="hidden" name="mdccode[<?php echo $fetch_getprd['id']; ?>]"
										value="<?php echo $fetch_getprd['mdccode']; ?>">
									<td class="td-custom">
										<input type="radio" name="choice[<?php echo $fetch_getprd['id']; ?>]" value="<?php echo $avail; ?>" required>
									</td>
									<td class="td-custom">
										<input type="radio" name="choice[<?php echo $fetch_getprd['id']; ?>]" value="<?php echo $oos; ?>" required>
									</td>
									<td class="td-custom" style="width: 35px; height: 30px; max-width: 35px; overflow: hidden;">
										<input type="number" name="maxcap[<?php echo $fetch_getprd['id']; ?>]" value="<?php echo $maxcap_value; ?>"
											required>
									</td>
									<!-- <td class="td-description"><center><?php echo $fetch_getprd['bu']; ?></center></td> -->
								</tr>
								<?php
							}
						} else {
							?>
							<tr>
								<th class="th-custom1 tbl-th-design">Description</th>
								<th class="th-custom2 tbl-th-design">AVAILABLE</th>
								<th class="th-custom3 tbl-th-design">OOS</th>
							</tr>
							<?php
							$avail = 1;
							$oos = 0;
							while ($fetch_getprd = mysqli_fetch_array($getprd_query)) {
								?>
								<tr class="tr-prd-list">
									<td class="td-description"><?php echo $fetch_getprd['mdccode'] . ' - ' . $fetch_getprd['description']; ?></td>
									<input type="hidden" name="mdccode[<?php echo $fetch_getprd['id']; ?>]"
										value="<?php echo $fetch_getprd['mdccode']; ?>">
									<td class="td-custom">
										<input type="radio" name="choice[<?php echo $fetch_getprd['id']; ?>]" value="<?php echo $avail; ?>" required>
									</td>
									<td class="td-custom">
										<input type="radio" name="choice[<?php echo $fetch_getprd['id']; ?>]" value="<?php echo $oos; ?>" required>
									</td>
								</tr>
								<?php
							}
						}
								}
							}
						}
					}
					?>
		</table>
		</td>
		</tr>
		<?php
	}
} else {
	?>
	<tr>
		<td colspan="3" style="text-align: center;font-size: 5vw;color: #5a5a5a;">Please contact your administrator.</td>
	</tr>
	<tr>
		<td class="tbl-form-td2" colspan="3"></td>
	</tr>
	<?php
}

$conn->close();
?>
<script>
	$(document).ready(function () {
		$('input[name^="choice"]').change(function () {
			var id = $(this).attr('name').match(/\d+/)[0];
			if ($(this).val() == <?php echo $oos; ?>) {
				$('input[name="option[' + id + ']"]').removeAttr('disabled');
				$('input[name="option[' + id + ']"]').attr('required', 'required');
			} else {
				$('input[name="option[' + id + ']"]').attr('disabled', true).prop('checked', false);
			}
		});

	});
</script>

<!-- <script>
$(document).ready(function(){
	// Disable all maxcap inputs by default
	$('input[name^="maxcap"]').attr('disabled', true).removeAttr('required');

	$('input[name^="choice"]').change(function() {
		var id = $(this).attr('name').match(/\d+/)[0];
		
		if ($(this).val() == <?php echo $avail; ?>) {
			// If available selected, enable and require maxcap input
			$('input[name="maxcap[' + id + ']"]').removeAttr('disabled').attr('required', 'required');
		} else {
			// If oos selected, disable maxcap input and remove required
			$('input[name="maxcap[' + id + ']"]').attr('disabled', true).removeAttr('required').val('');
		}
	});
});
</script> -->
<?php
include('db.php');

date_default_timezone_set("Asia/Manila");

$value = $_POST['value'];
$category = 'DMPI';
$status = "OKFORDEDUCT";

$startdate = "2019-01-01";
$enddate = date('Y-m-d',(strtotime ( '-1 day' ,strtotime (date("Y-m-d")))));

// get dbraw
$raw_query = mysqli_query($conn,"SELECT * FROM dbraw WHERE category='$category' AND status='$status' AND dmpiclass='$value' AND datecleared BETWEEN '$startdate' AND '$enddate' ORDER BY f325number ASC limit 250 ");
$row = mysqli_num_rows($raw_query);

if ($row >= 1)
{
	while ($fetch_raw = mysqli_fetch_array($raw_query))
	{
		$mdccode = $fetch_raw['mdccode'];

		// get description
		$product_query = mysqli_query($conn,"SELECT * FROM dbproduct WHERE mdccode='$mdccode'");
		$fetch_product = mysqli_fetch_array($product_query);
		?>
		<tr class="tbl-raw-tr" rowid="<?php echo $fetch_raw['id']; ?>">
			<td class="tbl-raw-td1"><?php echo $mdccode; ?></td>
			<td class="tbl-raw-td2"><?php echo $fetch_product['dmpicode']; ?></td>
			<td class="tbl-raw-td3"><?php echo $fetch_product['description']; ?></td>
			<td class="tbl-raw-td4">
				<input type="text" class="input-withNoborder input-quantity" value="<?php echo $fetch_raw['quantity']; ?>" disabled="disabled">
			</td>
			<td class="tbl-raw-td5">
				<input type="text" class="input-withNoborder input-dmpireason" value="<?php echo $fetch_raw['dmpireason']; ?>" disabled="disabled">
			</td>
			<td class="tbl-raw-td6">
				<input type="text" class="input-withNoborder input-expiration" value="<?php echo $fetch_raw['expiration']; ?>" disabled="disabled">
			</td>
		</tr>
		<?php
	}
}
else
{
	?>
	<tr>
		<td style="text-align: center;" colspan="6">No Result Found.</td>
	</tr>
	<?php
}

$conn->close();
?>
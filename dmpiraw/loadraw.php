<?php
include('db.php');

$reference = $_POST['reference'];

$raw_query = mysqli_query($conn,"SELECT * FROM dbraw WHERE dmpiref='$reference' ");
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


$conn->close();
?>
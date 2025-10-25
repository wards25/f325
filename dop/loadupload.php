<?php
session_start();
include('db.php');

$user = $_SESSION['fname'];

// load upload
$load_query = mysqli_query($conn,"SELECT * FROM dbdopupload WHERE user='$user' ");
while ($fetch_load = mysqli_fetch_array($load_query))
{
	$f325number = $fetch_load['f325number'];
	$brcode = $fetch_load['brcode'];
	$mdccode = $fetch_load['mdccode'];

	// branch
	$branch_query = mysqli_query($conn,"SELECT * FROM dbcensus WHERE code='$brcode' ");
	$fetch_branch = mysqli_fetch_array($branch_query);

	if (is_array($fetch_branch))
	{
		$branch_name = $fetch_branch['branchname'];
	}
	else
	{
		$branch_name = "For Fill-up";
	}

	// product
	$product_query = mysqli_query($conn,"SELECT * FROM dbproduct WHERE mdccode='$mdccode' ");
	$fetch_product = mysqli_fetch_array($product_query);

	if (is_array($fetch_product))
	{
		$description = $fetch_product['description'];
	}
	else
	{
		$description = "For Fill-up";
	}

	// check if already upload
	$check_query = mysqli_query($conn,"SELECT * FROM dbmdcdeduction WHERE f325number='$f325number' AND mdccode='$mdccode' ");
	$fetch_check = mysqli_fetch_array($check_query);
	?>
	<tr class="tbl-data-tr" <?php if($description == 'For Fill-up' || $fetch_load['category'] == 'For Fill-up' || $branch_name == 'For Fill-up' || is_array($fetch_check)){echo "style='background-color:#eaadc1;'";} ?>>
		<td class="tbl-data-td tbl-data-td1"><?php echo $fetch_load['f325number']; ?></td>
		<td class="tbl-data-td tbl-data-td2"><?php echo $brcode; ?></td>
		<td class="tbl-data-td tbl-data-td3">
			<input type="text" class="input-style-data" value="<?php echo $branch_name; ?>" disabled="disabled">
		</td>
		<td class="tbl-data-td tbl-data-td4"><?php echo $mdccode; ?></td>
		<td class="tbl-data-td tbl-data-td5">
			<input type="text" class="input-style-data" value="<?php echo $description; ?>" disabled="disabled">
		</td>
		<td class="tbl-data-td tbl-data-td6">
			<?php echo $fetch_load['category']; ?>
		</td>
		<td class="tbl-data-td tbl-data-td7"><?php echo $fetch_load['quantity']; ?></td>
		<td class="tbl-data-td tbl-data-td8"><?php echo number_format($fetch_load['unitcost'],2); ?></td>
		<td class="tbl-data-td tbl-data-td9"><?php echo $fetch_load['dbreference']; ?></td>
		<td class="tbl-data-td tbl-data-td10"><?php echo $fetch_load['status']; ?></td>
		<td class="tbl-data-td tbl-data-td11">
			<?php
			if($description == 'For Fill-up' || $fetch_load['category'] == 'For Fill-up' || $branch_name == 'For Fill-up' || is_array($fetch_check))
			{
				?>
				<button type="button" class="button-raw-delete" value="<?php echo $fetch_load['id']; ?>">X</button>
				<?php
			}
			?>
		</td>
	</tr>
	<?php
}

$conn->close();
?>
<?php
include('db.php');

$dopnumber = $_POST['dopnumber'];
$perpage = $_POST['perpage'];
$pageno = ($_POST['pageno']-1)*$perpage;

// load all raw
$raw_query = mysqli_query($conn,"SELECT * FROM dbmdcdeduction WHERE dopreference='$dopnumber' LIMIT $pageno,$perpage ");
while ($fetch_raw = mysqli_fetch_array($raw_query))
{
	$brcode = $fetch_raw['brcode'];
	$mdccode = $fetch_raw['mdccode'];

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
	$product_query = mysqli_query($conn,"SELECT * FROM dbproduct WHERE mdccode='$mdccode' AND active='1' ");
	$fetch_product = mysqli_fetch_array($product_query);

	if (is_array($fetch_product))
	{
		$description = $fetch_product['description'];
		$category = $fetch_product['category'];
	}
	else
	{
		$description = "For Fill-up";
		$category = "For Fill-up";
	}
	?>
	<tr class="tbl-data-tr">
		<td class="tbl-data-td tbl-data-td1"><?php echo $fetch_raw['f325number']; ?></td>
		<td class="tbl-data-td tbl-data-td2"><?php echo $brcode; ?></td>
		<td class="tbl-data-td tbl-data-td3">
			<input type="text" class="input-style-data" value="<?php echo $branch_name; ?>" readonly>
		</td>
		<td class="tbl-data-td tbl-data-td4"><?php echo $mdccode; ?></td>
		<td class="tbl-data-td tbl-data-td5">
			<input type="text" class="input-style-data" value="<?php echo $description; ?>" readonly>
		</td>
		<td class="tbl-data-td tbl-data-td6">
			<input type="text" class="input-style-data" value="<?php echo $category; ?>" readonly>
		</td>
		<td class="tbl-data-td tbl-data-td7"><?php echo $fetch_raw['quantity']; ?></td>
		<td class="tbl-data-td tbl-data-td8"><?php echo number_format($fetch_raw['unitcost'],2); ?></td>
		<td class="tbl-data-td tbl-data-td9"><?php echo $fetch_raw['dbreference']; ?></td>
		<td class="tbl-data-td tbl-data-td10"><?php echo $fetch_raw['status']; ?></td>
		<td class="tbl-data-td tbl-data-td11"></td>
	</tr>
	<?php
}


$conn->close();
?>
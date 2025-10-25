<?php
include('db.php');

$reference = $_POST['reference'];
$vcode = $_POST['vcode'];

// get dbraw
$raw_query = mysqli_query($conn,"SELECT * FROM dbraw WHERE deductref='$reference' ");
while ($fetch_raw = mysqli_fetch_array($raw_query))
{	
	$f325number = $fetch_raw['f325number'];

	// get month in dbmdcdeduction
	$deduction_query = mysqli_query($conn,"SELECT * FROM dbmdcdeduction WHERE f325number='$f325number' ");
	$fetch_deduction = mysqli_fetch_array($deduction_query);
	if (is_array($fetch_deduction))
	{
		$monthyear = date("M", mktime(0, 0, 0, $fetch_deduction['month'], 10)).'-'.$fetch_deduction['year'];
	}
	else
	{
		$monthyear = '';
	}

	// get f325 detail
	$detail_query = mysqli_query($conn,"SELECT * FROM dbf325number WHERE f325number='$f325number' ");
	$fetch_detail = mysqli_fetch_array($detail_query);
	$brcode = $fetch_detail['brcode'];

	// get region and branch name
	$census_query = mysqli_query($conn,"SELECT code,branchname,region FROM dbcensus WHERE code='$brcode' ");
	$fetch_census = mysqli_fetch_array($census_query);
	?>
	<tr>
		<td class="tbl-order-detail-td9">
			<?php echo $monthyear; ?>
		</td>
		<td class="tbl-order-detail-td10">
			<?php echo $brcode; ?>
		</td>
		<td class="tbl-order-detail-td12">
			<input type="text" class="input-NoBorder" value="<?php echo $fetch_census['branchname']; ?>" disabled="disabled">
		</td>
		<td class="tbl-order-detail-td2">
			<input type="text" class="input-NoBorder" value="<?php echo $fetch_census['region']; ?>" disabled="disabled">
		</td>
		<td class="tbl-order-detail-td11">
			<?php echo $f325number; ?>
		</td>
		<td class="tbl-order-detail-td1">
			<?php echo $mdccode = $fetch_raw['mdccode']; ?>
		</td>
		<?php
		$product_query = mysqli_query($conn,"SELECT * FROM dbproduct WHERE mdccode='$mdccode' AND vendor='$vcode' AND active='1' ");
		$fetch_product = mysqli_fetch_array($product_query);
		if (is_array($fetch_product))
		{
			$itemcode = $fetch_product['itemcode'];
			$description = $fetch_product['description'];
			$uom = $fetch_product['uom'];
		}
		else
		{
			$itemcode = "";
			$description = "Fill up";
			$uom = "";
		}
		?>
		<td class="tbl-order-detail-td3">
			<input type="text" class="input-NoBorder" value="<?php echo $description; ?>" disabled="disabled">
		</td>
		<td class="tbl-order-detail-td4">
			<?php echo $fetch_raw['expiration']; ?>
		</td>
		<td class="tbl-order-detail-td5">
			<?php echo $fetch_raw['reasoncode']; ?>
		</td>
		<td class="tbl-order-detail-td6">
			<?php echo $fetch_raw['deductqty']; ?>
		</td>
		<td class="tbl-order-detail-td7">
			<?php
			if ($fetch_raw['quantity'] >= 2)
			{
				if (is_array($fetch_product))
				{
					echo $uom.'S';
				}
			}
			else
			{
				if (is_array($fetch_product))
				{
					echo $uom;
				}
			}
			?>
		</td>
		<td class="tbl-order-detail-td8">
			<input type="text" class="input-NoBorder input-unitcost" value="<?php echo $fetch_raw['deductcostextended']; ?>" disabled="disabled">
		</td>
	</tr>
	<?php
}

$conn->close();
?>
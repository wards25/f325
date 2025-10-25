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

	// page no
	$pageno_query = mysqli_query($conn,"SELECT pageno,f325number FROM dbf325number WHERE f325number='$f325number' ");
	$fetch_pageno = mysqli_fetch_array($pageno_query);
	?>
	<tr data-order="<?php echo $fetch_pageno['pageno']; ?>">
		<td class="tbl-sku-td tbl-sku-td1">
			<?php echo $monthyear; ?>
		</td>
		<td class="tbl-sku-td tbl-sku-td2">
			<?php echo $brcode; ?>
		</td>
		<td class="tbl-sku-td tbl-sku-td3">
			<input type="text" class="input-NoBorder input-brname" value="<?php echo $fetch_census['branchname']; ?>" disabled="disabled">
		</td>
		<td class="tbl-sku-td tbl-sku-td4">
			<input type="text" class="input-NoBorder input-region" value="<?php echo $fetch_census['region']; ?>" disabled="disabled">
		</td>
		<td class="tbl-sku-td tbl-sku-td5">
			<?php echo $f325number; ?>
		</td>
		<td class="tbl-sku-td tbl-sku-td6">
			<?php echo $mdccode = $fetch_raw['mdccode']; ?>
		</td>
		<?php
		$product_query = mysqli_query($conn,"SELECT * FROM dbproduct WHERE mdccode='$mdccode' AND vendor='$vcode' ");
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
		<td class="tbl-sku-td tbl-sku-td7">
			<input type="text" class="input-NoBorder input-description" value="<?php echo $description; ?>" disabled="disabled">
		</td>
		<td class="tbl-sku-td tbl-sku-td8">
			<?php echo $fetch_raw['expiration']; ?>
		</td>
		<td class="tbl-sku-td tbl-sku-td9">
			<?php echo $fetch_raw['reasoncode']; ?>
		</td>
		<td class="tbl-sku-td tbl-sku-td10">
			<?php echo $fetch_raw['deductqty']; ?>
		</td>
		<td class="tbl-sku-td tbl-sku-td11">
			<?php
			if ($fetch_raw['quantity'] >= 2)
			{
				echo $uom.'S';
			}
			else
			{
				echo $uom;
			}
			?>
		</td>
		<td class="tbl-sku-td tbl-sku-td12">
			<input type="text" class="input-NoBorder input-unitcost" value="<?php echo $fetch_raw['deductcostextended']; ?>" >
		</td>
	</tr>
	<?php
}

$conn->close();
?>
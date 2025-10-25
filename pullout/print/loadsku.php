<?php
include('db.php');

$reference = $_POST['reference'];
$vcode = $_POST['vcode'];

// get dbstock
$stock_query = mysqli_query($conn,"SELECT * FROM dbraw WHERE pulloutref='$reference' ");
while ($fetch_stock = mysqli_fetch_array($stock_query))
{	
	$f325number = $fetch_stock['f325number'];
	$mdccode = $fetch_stock['mdccode'];

	// get f325 detail
	$detail_query = mysqli_query($conn,"SELECT * FROM dbf325number WHERE f325number='$f325number' ");
	$fetch_detail = mysqli_fetch_array($detail_query);
	$brcode = $fetch_detail['brcode'];

	// get region and branch name
	$census_query = mysqli_query($conn,"SELECT * FROM dbcensus WHERE code='$brcode' ");
	$fetch_census = mysqli_fetch_array($census_query);
	?>
	<tr>
		<td class="tbl-sku-td tbl-sku-td1">
			<input type="text" class="input-NoBorder" value="<?php echo $fetch_census['franchise'].' '.$brcode.' - '.$fetch_census['branchname']; ?>" disabled="disabled">
		</td>
		<td class="tbl-sku-td tbl-sku-td2">
			<?php echo $f325number; ?>
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
		<td class="tbl-sku-td tbl-sku-td3">
			<input type="text" class="input-NoBorder" value="<?php echo $mdccode.' -- '.$description; ?>" disabled="disabled">
		</td>
		<td class="tbl-sku-td tbl-sku-td4 quantity-lines" quantity="<?php echo $fetch_stock['quantity']; ?>">
			<?php echo $fetch_stock['quantity']; ?>
		</td>
		<td class="tbl-sku-td tbl-sku-td5">
			<?php
			if ($fetch_stock['quantity'] >= 2)
			{
				echo $uom.'S';
			}
			else
			{
				echo $uom;
			}
			?>
		</td>
		<td class="tbl-sku-td tbl-sku-td6">
			<input type="text" class="input-NoBorder input-unitcost" costextend="<?php echo ($fetch_stock['quantity']*$fetch_stock['unitcost']); ?>" value="<?php echo number_format($fetch_stock['quantity']*$fetch_stock['unitcost'],2); ?>" readonly="readonly">
		</td>
	</tr>
	<?php
}

$conn->close();
?>
<?php
require_once('require/nocache.php');
include('db.php');

$f325number = $_POST['f325number'];

$number = 1;
// query
$order_query = mysqli_query($conn,"SELECT * FROM dbraw WHERE f325number='$f325number' ");
while ($fetch_order = mysqli_fetch_array($order_query))
{
	?>
	<tr class="tbl-order-detail-tr" rowid="<?php echo $fetch_order['id']; ?>" del="0">
		<td class="tbl-order-detail-td10">
			<button type="button" class="button-row-delete">X</button>
		</td>
		<td class="tbl-order-detail-td1">
			<input type="text" class="input-withNoBorder add-search-mdccode input-mdccode" numbercount="<?php echo $number++; ?>" value="<?php echo $mdccode = $fetch_order['mdccode']; ?>">
			<div class="div-prd-scroll">
				<table class="tbl-prd">
					<tbody class="tbody-prd-list"></tbody>
				</table>
			</div>
		</td>
		<?php
		$product_query = mysqli_query($conn,"SELECT * FROM dbproduct WHERE mdccode='$mdccode' AND active='1' ");
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
		<td class="tbl-order-detail-td2">
			<input type="text" class="input-withNoBorder input-itemcode" value="<?php echo $itemcode; ?>" disabled="disabled">
		</td>
		<td class="tbl-order-detail-td3">
			<input type="text" class="input-withNoBorder input-description" value="<?php echo $description; ?>" disabled="disabled">
		</td>
		<td class="tbl-order-detail-td9">
			<input type="text" class="input-withNoBorder input-bbd-date" onclick="$(this).select();" value="<?php echo $fetch_order['expiration']; ?>">
		</td>
		<td class="tbl-order-detail-td4">
			<input type="text" class="input-withNoBorder input-reason-code" onclick="$(this).select();" onkeypress="return /[a-z]/i.test(event.key);" maxlength="1" value="<?php echo $fetch_order['reasoncode']; ?>">
		</td>
		<td class="tbl-order-detail-td5">
			<input type="text" class="input-withNoBorder input-quantity" onclick="$(this).select();" quantity="<?php echo $fetch_order['quantity']; ?>" value="<?php echo $fetch_order['quantity']; ?>">
		</td>
		<td class="tbl-order-detail-td6">
			<?php if($fetch_order['quantity'] > 1){echo $uom.'S';}else{echo $uom;} ?>
		</td>
		<td class="tbl-order-detail-td7">
			<input type="text" class="input-withNoBorder input-unitcost" onclick="$(this).select();" unitcost="<?php echo $fetch_order['unitcost']; ?>" value="<?php echo $fetch_order['unitcost']; ?>">
		</td>
		<td class="tbl-order-detail-td8">
			<input type="text" class="input-withNoBorder input-costextended" costextended="0.00" value="0.00" disabled="disabled">
		</td>
	</tr>
	<?php
}


$conn->close();
?>
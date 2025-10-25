<?php
require_once('require/nocache.php');
include('db.php');

$f325number = $_POST['f325number'];
$vcode = $_POST['vcode'];

$number = 1;

// query
$order_query = mysqli_query($conn,"SELECT * FROM dbraw WHERE f325number='$f325number' ");
while ($fetch_order = mysqli_fetch_array($order_query))
{
		$mdccode = $fetch_order['mdccode'];

		$product_query = mysqli_query($conn,"SELECT * FROM dbproduct WHERE mdccode='$mdccode' AND vendor='$vcode' AND active='1' ");
		$fetch_product = mysqli_fetch_array($product_query);
		if (is_array($fetch_product))
		{
			$id = $fetch_product['mdccode'];
			$itemcode = $fetch_product['itemcode'];
			$description = $fetch_product['description'];
			$category = $fetch_product['category'];
			$uom = $fetch_product['uom'];
			$dmpipack = str_replace(' ', '', $fetch_product['dmpipack']);
		}
		else
		{
			$id = "0";
			$itemcode = "";
			$description = "Fill up";
			$category = "";
			$uom = "";
			$dmpipack = "";
		}
		// get barcode
		$barcode_query = mysqli_query($conn,"SELECT * FROM dbbarcode WHERE mdccode='$mdccode' ");
	?>
	<tr class="tbl-order-detail-tr <?php while($fetch_barcode = mysqli_fetch_array($barcode_query)){echo 'barcode'.$fetch_barcode['barcodenumber'].' ';} ?>" rowid="<?php echo $fetch_order['id']; ?>" del="0">
		<td class="tbl-order-detail-td1">
			<input type="text" class="input-withNoborder add-search-mdccode input-mdccode" numbercount="<?php echo $number++; ?>" value="<?php echo $mdccode; ?>" disabled="disabled">
		</td>
		<?php
		
		?>
		<td class="tbl-order-detail-td2">
			<input type="text" class="input-withNoborder input-itemcode" value="<?php echo $itemcode; ?>" disabled="disabled">
		</td>
		<td class="tbl-order-detail-td3">
			<input type="text" class="input-withNoborder input-description" value="<?php echo $description; ?>" disabled="disabled">
		</td>
		<td class="tbl-order-detail-td4">
			<input type="text" class="input-withNoborder input-bbd-date" onclick="this.select();" value="<?php echo $fetch_order['expiration']; ?>" disabled="disabled">
		</td>
		<td class="tbl-order-detail-td5">
			<select class="select-style-withNoBorder select-dmpireason" <?php if (empty($dmpipack)){echo 'disabled="disabled"';}else{echo 'required="required"';} if ($fetch_order['status'] == 'OKFORDEDUCT') { echo "disabled='disabled'";} ?>>
				<?php
				if ($fetch_order['dmpireason'] == '0')
				{
					?>
					<option value="0"></option>
					<?php
					// check dmpi pack
					if (empty($dmpipack))
					{
						// code...
					}
					else
					{
						// get allow reason
						$reason_query = mysqli_query($conn,"SELECT $dmpipack,reasoncode,reason FROM dbdmpireason WHERE $dmpipack='1'");
						while ($fetch_reason = mysqli_fetch_array($reason_query))
						{
							?>
							<option value="<?php echo $fetch_reason['reasoncode']; ?>" ><?php echo '('.$fetch_reason['reasoncode'].') '.$fetch_reason['reason']; ?></option>
							<?php
						}
					}
				}
				else
				{
					// check dmpi pack
					if (empty($dmpipack))
					{
						// code...
					}
					else
					{
						// get allow reason
						$reason_query = mysqli_query($conn,"SELECT $dmpipack,reasoncode,reason FROM dbdmpireason WHERE $dmpipack='1'");
						while ($fetch_reason = mysqli_fetch_array($reason_query))
						{
							?>
							<option value="<?php echo $fetch_reason['reasoncode']; ?>" <?php if($fetch_reason['reasoncode'] == $fetch_order['dmpireason']){echo 'selected="selected"';} ?>><?php echo '('.$fetch_reason['reasoncode'].') '.$fetch_reason['reason']; ?></option>
							<?php
						}
					}
				}
				?>
			</select>
		</td>
		<td class="tbl-order-detail-td6">
			<input type="text" class="input-withNoborder input-reason-code" onclick="this.select();" onkeypress="return /[a-z]/i.test(event.key);" maxlength="1" value="<?php echo $fetch_order['reasoncode']; ?>">
		</td>
		<td class="tbl-order-detail-td7" >
			<input type="text" class="input-withNoborder input-quantity" onclick="this.select();" quantity="<?php echo $fetch_order['quantity']; ?>" value="<?php echo $fetch_order['quantity']; ?>">
		</td>
		<td class="tbl-order-detail-td8">
			<input type="text" class="input-withNoborder input-unitcost" onclick="this.select();" unitcost="<?php echo $fetch_order['unitcost']; ?>" value="<?php echo $fetch_order['unitcost']; ?>">
		</td>
		<td class="tbl-order-detail-td9">
			<input type="text" class="input-withNoborder input-costextended" costextended="0.00" value="0.00" disabled="disabled">
		</td>
	</tr>
	<?php
}


$conn->close();
?>
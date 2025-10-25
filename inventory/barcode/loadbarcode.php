<?php
include('db.php');

$mdccode = $_POST['mdccode'];

// load barcode
$barcode_query = mysqli_query($conn,"SELECT * FROM dbbarcode WHERE mdccode='$mdccode' ORDER BY barcodenumber ASC ");
while ($fetch_barcode = mysqli_fetch_array($barcode_query))
{
	?>
	<tr>
		<td class="tbl-list-barcode-td1"><?php echo $fetch_barcode['barcodenumber']; ?></td>
		<td class="tbl-list-barcode-td2">
			<button type="button" class="button-WithBorder-Style button-barcode-delete" barcodeid="<?php echo $fetch_barcode['id']; ?>">Delete</button>
		</td>
	</tr>
	<?php
}

$conn->close();
?>
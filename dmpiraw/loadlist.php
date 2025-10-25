<?php
include('db.php');

// load list
$load_query = mysqli_query($conn,"SELECT * FROM dbdmpi ORDER BY id DESC");
$row = mysqli_num_rows($load_query);

if ($row >= 1)
{
	while ($fetch_load = mysqli_fetch_array($load_query))
	{
		?>
		<tr class="tbl-list-order-tr" rowid="<?php echo $fetch_load['id']; ?>">
			<td class="tbl-list-order-td1"><?php echo $fetch_load['reference']; ?></td>
			<td class="tbl-list-order-td2"><?php echo $fetch_load['transactnumber']; ?></td>
			<td class="tbl-list-order-td3"><?php echo $fetch_load['classification']; ?></td>
			<td class="tbl-list-order-td4"><?php echo $fetch_load['processby']; ?></td>
			<td class="tbl-list-order-td5"><?php echo $fetch_load['status']; ?></td>
		</tr>
		<?php
	}
}
else
{
	?>
	<tr>
		<td style="text-align: center;" colspan="5">No Result Found.</td>
	</tr>
	<?php
}

$conn->close();
?>
<?php
session_start();
include('require/nocache.php');
include('db.php');

$query = "SELECT * FROM dbfordeduction";

if (strlen($_POST['company']) >= 1)
{
	$company = $_POST['company'];
	$query .= " WHERE company='$company'";
}
else
{
	// company
	$company = "company='' ";

	for ($i = 1; $i <= 10; $i++)
	{
		//get vendor code of company
		$vendorcode_query = mysqli_query($conn,"SELECT * FROM dbcompany WHERE id='$i' ");
		$fetch_vendorcode = mysqli_fetch_array($vendorcode_query);

		if ($_SESSION['comp'.$fetch_vendorcode['id']]){$company .= "OR company='".$fetch_vendorcode['vendorcode']."'";} 
	}

	$query .= " WHERE (".$company.") ";
}

// arrange by reference number
$query .= "AND (status='FOR BILLED' OR status='PAID') ORDER BY id DESC";

$load_query = mysqli_query($conn,$query);

$row = mysqli_num_rows($load_query);

if ($row >= 1)
{
	while ($fetch_load = mysqli_fetch_array($load_query))
	{
		?>
		<tr class="tbl-list-order-tr" deductid="<?php echo $fetch_load['id']; ?>">
			<td class="tbl-list-order-td1">
				<?php echo $fetch_load['reference']; ?>
			</td>
			<td class="tbl-list-order-td2">
				<?php echo $fetch_load['principal']; ?>
			</td>
			<td class="tbl-list-order-td3">
				<?php
				$vendor_code = $fetch_load['company'];

				// get name of company
				$company_query = mysqli_query($conn,"SELECT * FROM dbcompany WHERE vendorcode='$vendor_code' ");
				$fetch_company = mysqli_fetch_array($company_query);
				echo $fetch_company['name'];
				?>
			</td>
			<td class="tbl-list-order-td4">
				<?php echo $fetch_load['preparedby']; ?>
			</td>
			<td class="tbl-list-order-td5">
				<?php echo date("m-d-Y",strtotime($fetch_load['dateprocessed'])); ?>
			</td>
			<td class="tbl-list-order-td6">
				<?php echo $fetch_load['status']; ?>
			</td>
		</tr>
		<?php
	}
}
else
{
	// no data result
	?>
	<tr>
		<td class="td-no-data" colspan="6">
			No data result.
		</td>
	</tr>
	<?php
}

$conn->close();
?>
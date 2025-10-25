<?php
require_once('require/nocache.php');
include('db.php');

// query
$search_query = "SELECT * FROM dbf325number WHERE f325number ";

// status
if (strlen($_POST['status']) >= 1)
{
	$status = $_POST['status'];

	$search_query .= "AND status='$status' ";
}

// search
if (strlen($_POST['search']) >= 1)
{
	$selectsearch = $_POST['selectsearch'];
	$search = $_POST['search'];

	$search_query .= "AND $selectsearch LIKE '%$search%' ";
}

// company
if (strlen($_POST['company']) >= 1)
{
	$company = $_POST['company'];

	$search_query .= "AND vendor='$company' ";
}

// cluster
if (strlen($_POST['cluster']) >= 1){$cluster = $_POST['cluster'];$search_query .= "AND cluster='$cluster'";}

$search_query .= "ORDER BY f325number ASC LIMIT 500";

// search in database
$search_database = mysqli_query($conn,$search_query);

// total row result
$row = mysqli_num_rows($search_database);

// condition if have result
if ($row >= 1)
{
	// loop result
	while ($fetch_search = mysqli_fetch_array($search_database))
	{
		?>
		<tr class="tbl-list-order-tr" f325id="<?php echo $fetch_search['id']; ?>">
			<td class="tbl-list-order-td1">
				<?php echo $fetch_search['f325number']; ?>
			</td>
			<td class="tbl-list-order-td2">
				<?php
				$code = $fetch_search['brcode'];

				$code_query = mysqli_query($conn,"SELECT * FROM dbcensus WHERE code='$code' ");
				$fetch_code = mysqli_fetch_array($code_query);
				if (is_array($fetch_code))
				{
					echo $fetch_code['franchise'].' '.$code.' - '.$fetch_code['branchname'];
				}
				else
				{
					echo $code.' - ';
				}
				?>
			</td>
			<td class="tbl-list-order-td3">
				<?php echo date("m-d-Y",strtotime($fetch_search['emaildate'])); ?>
			</td>
			<td class="tbl-list-order-td4">
				<?php echo date("m-d-Y",strtotime($fetch_search['f325date'])); ?>
			</td>
			<td class="tbl-list-order-td5">
				<?php
				$vendorcode = $fetch_search['vendor'];

				$vendor_query = mysqli_query($conn,"SELECT * FROM dbcompany WHERE vendorcode='$vendorcode'");
				$fetch_vendor = mysqli_fetch_array($vendor_query);
				if (is_array($fetch_vendor))
				{
					echo $fetch_vendor['name'];
				}
				else
				{
					echo '';
				}
				?>
			</td>
			<td class="tbl-list-order-td6">
				<?php echo $fetch_search['status']; ?>
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
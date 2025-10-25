<?php
include('db.php');

$status = $_POST['status'];

$query = "SELECT * FROM dbcensus WHERE status='$status' ";

// region
if (strlen($_POST['region']) >= 1)
{
	$region = $_POST['region'];

	$query .= "AND region='$region' ";
}

// location
if (strlen($_POST['location']) >= 1)
{
	$location = $_POST['location'];

	$query .= "AND location='$location' ";
}

// search
if (strlen($_POST['search']) >= 1)
{
	$search = utf8_encode($_POST['search']);
	$query .= "AND (code LIKE '%$search%' OR branchname LIKE '%$search%') ";
}

$query .= " ORDER BY code ASC";

$branch_query = mysqli_query($conn,$query);

$row = mysqli_num_rows($branch_query);

if ($row >= 1)
{
	while ($fetch_branch = mysqli_fetch_array($branch_query))
	{
		?>
		<tr class="tbl-list-tr" branchid="<?php echo $fetch_branch['id']; ?>">
			<td class="tbl-list-td1"><?php echo $fetch_branch['code']; ?></td>
			<td class="tbl-list-td2">
				<input type="text" class="input-TableWithNoBorder-Style" style="padding-left: 0.5vw" value="<?php echo $fetch_branch['branchname']; ?>" readonly="readonly">
			</td>
		</tr>
		<?php
	}
}
else
{
	?>
	<tr>
		<td style="text-align: center;" colspan="2">No Result.</td>
	</tr>
	<?php
}

$conn->close();
?>
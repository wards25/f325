<?php
require_once('require/nocache.php');
include('db.php');

$code = $_POST['code'];

// query
$search_query = "SELECT * FROM dbcensus WHERE code LIKE '%$code%' LIMIT 8 ";

// search in database
$search = mysqli_query($conn,$search_query);

// total row result
$row = mysqli_num_rows($search);

// condition if have result
if ($row >= 1)
{
	while ($fetch_search = mysqli_fetch_array($search))
	{
		?>
		<tr class="tbl-branch-tr">
			<td class="tbl-branch-td" code="<?php echo $fetch_search['code']; ?>" branchname="<?php echo $fetch_search['franchise'].' '.$fetch_search['code'].' - '.$fetch_search['branchname']; ?>">
				<?php echo $fetch_search['franchise'].' '.$fetch_search['code'].' - '.$fetch_search['branchname']; ?>
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
		<td style="text-align: center;" colspan="6">
			No data result.
		</td>
	</tr>
	<?php
}

$conn->close();
?>
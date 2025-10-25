<?php
include('db.php');

$category = $_POST['category'];

$query = "SELECT * FROM dbcensus ";

if (isset($_POST['value']))
{
	if (strlen($_POST['value']) >= 1)
	{
		$value = $_POST['value'];

		$query .= "WHERE $category LIKE '%$value%' AND status='1' ";
	}
}

$query .= "GROUP BY $category ORDER BY $category";

$category_query = mysqli_query($conn,$query);
$row = mysqli_num_rows($category_query);

if ($row >= 1)
{
	while ($fetch_category = mysqli_fetch_array($category_query))
	{
		?>
		<tr>
			<td class="td-result-category" category="<?php echo $category; ?>" list="<?php echo $fetch_category[$category]; ?>"><?php echo $fetch_category[$category]; ?></td>
		</tr>
		<?php
	}
}
else
{
	?>
	<tr>
		<td>No list found.</td>
	</tr>
	<?php
}

$conn->close();
?>
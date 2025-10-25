<?php
include('db.php');

$active = $_POST['status'];

$query = "SELECT * FROM dbproduct WHERE active='$active' ";

// category
if (strlen($_POST['category']) >= '1')
{
	$category = $_POST['category'];
	$query .= "AND category='$category' ";
}

// company
if (strlen($_POST['company']) >= '1')
{
	$company = $_POST['company'];
	$query .= "AND vendor='$company' ";
}

// search
if (strlen($_POST['search']) >= '1')
{
	$search = $_POST['search'];
	$query .= "AND (mdccode LIKE '%$search%' OR description LIKE '%$search%') ";
}

$query .= " ORDER BY mdccode ASC";

$product_query = mysqli_query($conn,$query);

$row = mysqli_num_rows($product_query);

if ($row >= 1)
{
	while ($fetch_product = mysqli_fetch_array($product_query))
	{
		?>
		<tr class="tbl-list-tr" prdid="<?php echo $fetch_product['id']; ?>">
			<td class="tbl-list-td1"><?php echo $fetch_product['mdccode']; ?></td>
			<td class="tbl-list-td2">
				<input type="text" class="input-TableWithNoBorder-Style" style="padding-left: 0.5vw" value="<?php echo $fetch_product['description']; ?>" readonly="readonly">
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
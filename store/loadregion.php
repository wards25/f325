<option value="">ALL</option>
<?php
include('db.php');

$query = "SELECT * FROM dbcensus ";

// location
if (strlen($_POST['location']) >= 1)
{
	$location = $_POST['location'];

	$query .= " WHERE location='$location' ";
}

$query .= " GROUP BY region ORDER BY region ASC";

// group by region
$region_query = mysqli_query($conn,$query);
while ($fetch_region = mysqli_fetch_array($region_query))
{
	?>
		<option value="<?php echo $fetch_region['region']; ?>"><?php echo $fetch_region['region']; ?></option>
	<?php
}
$conn->close();
?>
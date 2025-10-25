<option value="">ALL</option>
<?php
include('db.php');

// group by location
$location_query = mysqli_query($conn,"SELECT * FROM dbcensus GROUP BY location ORDER BY location ASC");
while ($fetch_location = mysqli_fetch_array($location_query))
{
	?>
	<option value="<?php echo $fetch_location['location']; ?>"><?php echo $fetch_location['location']; ?></option>
	<?php
}
$conn->close();
?>
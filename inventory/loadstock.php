<?php
include('db.php');

$id = $_POST['id'];
$mdccode = $_POST['mdccode'];

// get location
$location_query = mysqli_query($conn,"SELECT * FROM dblocation WHERE active='1' ");
while ($fetch_location = mysqli_fetch_array($location_query))
{
	$location = $fetch_location['location'];
	$status = "CLEARED";
	$status2 = "SCHEDULED";

	// get remaining stock
	$stock_query = mysqli_query($conn,"SELECT sum(quantity) AS totalquantity FROM dbraw WHERE mdccode='$mdccode' AND location='$location' AND statusout='$status' ");
	$fetch_stock = mysqli_fetch_assoc($stock_query);

	// get on pick-up stocks
	$pick_query = mysqli_query($conn,"SELECT sum(quantity) AS totalpickquantity FROM dbraw WHERE mdccode='$mdccode' AND location='$location' AND status='$status2' ");
	$fetch_pick = mysqli_fetch_assoc($pick_query);
	?>
	<tr>
		<td class="tbl-stock-location-td1">
			<?php echo $fetch_location['location']; ?>
		</td>
		<td class="tbl-stock-location-td2">
			<?php
			if ($fetch_stock['totalquantity'] >= '2')
			{
				echo number_format($fetch_stock['totalquantity'],0).' PCS';
			}
			else
			{
				echo number_format($fetch_stock['totalquantity'],0).' PC';
			}
			?>
		</td>
		<td class="tbl-stock-location-td3">
			<?php
			if ($fetch_pick['totalpickquantity'] >= '2')
			{
				echo number_format($fetch_pick['totalpickquantity'],0).' PCS';
			}
			else
			{
				echo number_format($fetch_pick['totalpickquantity'],0).' PC';
			}
			?>
		</td>
	</tr>
	<?php
}

$conn->close();
?>
<?php
session_start();
include('db.php');

date_default_timezone_set("Asia/Manila");

$startdate = "2019-01-01";
$enddate = date('Y-m-d',(strtotime ( '-1 day' ,strtotime (date("Y-m-d")))));

$category = $_POST['category'];
if ($category == 'DMPI')
{
	$status = "UPLOADED";
}
else
{
	$status = "CLEARED";
}

$stockcount_query = "SELECT * FROM dbraw WHERE category='$category' AND statusout='$status' AND datecleared BETWEEN '$startdate' AND '$enddate' ";

// get location
if (strlen($_POST['location']) >= '1')
{
	$location = $_POST['location'];

	$stockcount_query .= "AND location='$location' ";
}
else
{
	// location
	$location = "location='' ";

	for ($i=1; $i <= 10 ; $i++)
	{ 
		// get location
		$list_query = mysqli_query($conn,"SELECT * FROM dblocation WHERE id='$i' ");
		$fetch_list = mysqli_fetch_array($list_query);

		if($_SESSION['loc'.$fetch_list['id']]){$location .= "OR location='".$fetch_list['location']."'";}
	}

	$stockcount_query .= "AND (".$location.") ";
}

$stockcount_query .= "ORDER BY f325number ASC";

// get dbraw
$stock_query = mysqli_query($conn,$stockcount_query);
while ($fetch_stock = mysqli_fetch_array($stock_query))
{
	$f325number = $fetch_stock['f325number'];
	$mdccode = $fetch_stock['mdccode'];
	?>
	<tr class="tbl-order-detail-tr" skuid="<?php echo $fetch_stock['id']; ?>">
		<td class="tbl-order-detail-td1">
			<input type="text" class="input-NoBorder input-f325number" value="<?php echo $f325number; ?>" disabled="disabled">
		</td>
		<td class="tbl-order-detail-td2">
			<input type="text" class="input-NoBorder input-mdccode" value="<?php echo $fetch_stock['mdccode']; ?>" disabled="disabled">
		</td>
		<?php
		$prd_query = mysqli_query($conn,"SELECT * FROM dbproduct WHERE mdccode='$mdccode' AND active='1' ");
		$fetch_prd = mysqli_fetch_array($prd_query);
		?>
		<td class="tbl-order-detail-td4">
			<?php echo $fetch_prd['description']; ?>
		</td>
		<td class="tbl-order-detail-td5">
			<?php echo $fetch_stock['reasoncode']; ?>
		</td>
		<td class="tbl-order-detail-td6">
			<input type="text" class="input-NoBorder input-quantity" value="<?php echo $fetch_stock['quantity']; ?>" disabled="disabled">
		</td>
		<td class="tbl-order-detail-td7 td-uom">
			<?php
			if ($fetch_stock['quantity'] >= 2)
			{
				echo $fetch_prd['uom'].'S';
			}
			else
			{
				echo $fetch_prd['uom'];
			}
			?>
		</td>
		<td class="tbl-order-detail-td8">
			<input type="text" class="input-NoBorder input-unitcost" costextend="<?php echo number_format($fetch_stock['unitcost']*$fetch_stock['quantity'],2,'.',''); ?>" value="<?php echo number_format($fetch_stock['unitcost']*$fetch_stock['quantity'],2); ?>" disabled="disabled">
		</td>
	</tr>
	<?php
}

$conn->close();
?>
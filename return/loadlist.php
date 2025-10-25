<?php
session_start();
include('db.php');

// query
$load_query = "SELECT * FROM dbproduct ";

// where
$load_query .= "WHERE ";

// get company
if (strlen($_POST['company']) > 1)
{
	$company = $_POST['company'];

	$load_query .= "vendor='$company' ";
}
else
{
	// company
	$company = "vendor='' ";

	for ($i = 1; $i <= 10; $i++)
	{
		//get vendor code of company
		$vendorcode_query = mysqli_query($conn,"SELECT * FROM dbcompany WHERE id='$i' ");
		$fetch_vendorcode = mysqli_fetch_array($vendorcode_query);

		if ($_SESSION['comp'.$fetch_vendorcode['id']]){$company .= "OR vendor='".$fetch_vendorcode['vendorcode']."'";} 
	}

	$load_query .= "(".$company.") ";
}

$load_query .= "GROUP BY category ORDER BY category ASC";

// result from database
$result_db = mysqli_query($conn,$load_query);

// total row result
$row = mysqli_num_rows($result_db);

// condition if have result
if ($row >= 1)
{
	// loop result
	while ($fetch_db = mysqli_fetch_array($result_db))
	{
		?>
		<?php
		$vendorcode = $fetch_db['vendor'];

		// get vendor name
		$vendorname_query = mysqli_query($conn,"SELECT * FROM dbcompany WHERE vendorcode='$vendorcode' ");
		$fetch_vendorname = mysqli_fetch_array($vendorname_query);
		?>
		<tr class="tbl-list-order-tr" category="<?php echo $fetch_db['category']; ?>" refcode="<?php echo $fetch_vendorname['refcode']; ?>" companycode="<?php echo $fetch_vendorname['vendorcode']; ?>" company="<?php echo $fetch_vendorname['name']; ?>">
			<td class="tbl-list-order-td1">
				<?php echo $category = $fetch_db['category']; ?>
			</td>
			<td class="tbl-list-order-td2">
				<?php echo $fetch_vendorname['name']; ?>	
			</td>
			<?php

			if ($category == 'DMPI')
			{
				$received_status = "UPLOADED";
			}
			else
			{
				$received_status = "CLEARED";
			}
			$return_query = "SELECT sum(quantity) AS totalquantity FROM dbraw WHERE category='$category' AND statusout='$received_status' ";

			// get location
			if (strlen($_POST['location']) > 1)
			{
				$location = $_POST['location'];

				$return_query .= "AND location='$location' ";
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

				$return_query .= "AND (".$location.") ";
			}

			if (strlen($_POST['month']))
			{
				$month = $_POST['month'];
				$year = $_POST['year'];
				$return_query .= "AND MONTH(datecollected)='$month' AND YEAR(datecollected)='$year'";
			}
			else
			{
				date_default_timezone_set("Asia/Manila");

				$startdate = "2019-01-01";
				$enddate = date('Y-m-d',(strtotime ( '-1 day' ,strtotime (date("Y-m-d")))));

				$return_query .= "AND datecleared BETWEEN '$startdate' AND '$enddate' ";
			}
			$sum_return_query = mysqli_query($conn,$return_query);
			$fetch_sum_return = mysqli_fetch_assoc($sum_return_query);
			?>
			<td class="tbl-list-order-td3">
				<?php
				if (is_array($fetch_sum_return))
				{
					echo number_format($return = $fetch_sum_return['totalquantity'],2);
				}
				else
				{
					echo $return = '0.00';
				}
				?>
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
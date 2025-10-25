<?php
session_start();
include('db.php');

// mdc deduction
$mdc_status = "OPEN";

// amount deduction
$deduction_status = "FOR BILLING";

// query
$load_query = "SELECT * FROM dbproduct ";

if (strlen($_POST['company']) > 1)
{
	$company = $_POST['company'];

	$load_query .= "WHERE vendor='$company'";
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

	$load_query .= "WHERE (".$company.") ";
}

$load_query .= "GROUP BY category,vendor ORDER BY category ASC";

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
			$deduction_query = "SELECT sum(unitcost) AS totaldeduction FROM dbmdcdeduction WHERE category='$category' AND status='$mdc_status' ";

			if (strlen($_POST['month'])>1)
			{
				$month = $_POST['month'];
				$year = $_POST['year'];
				$deduction_query .= "AND month='$month' AND year='$year'";
			}
			else
			{
				$year = $_POST['year'];
				$deduction_query .= "AND year='$year'";
			}
			$sum_deduction_query = mysqli_query($conn,$deduction_query);
			$fetch_sum_deduction = mysqli_fetch_assoc($sum_deduction_query);
			?>
			<td class="tbl-list-order-td3">
				<?php
				if (is_array($fetch_sum_deduction))
				{
					echo number_format($deduction = $fetch_sum_deduction['totaldeduction'],2);
				}
				else
				{
					echo $deduction = '0.00';
				}
				?>
			</td>
			<?php
			$amount_deduction = "SELECT sum(unitcost) AS totalamountdeduction FROM dbmdcdeduction WHERE vendorcode='$vendorcode' AND category='$category' AND status='$deduction_status' ";

			if (strlen($_POST['month']) >= 1)
			{
				$month = $_POST['month'];
				$year = $_POST['year'];
				$amount_deduction .= "AND month='$month' AND year='$year'";
			}
			else
			{
				$year = $_POST['year'];
				$amount_deduction .= "AND year='$year'";
			}

			$amount_deduction_query = mysqli_query($conn,$amount_deduction);
			$fetch_amount_deduction = mysqli_fetch_assoc($amount_deduction_query)
			?>
			<td class="tbl-list-order-td4">
				<?php
				if (is_array($fetch_amount_deduction))
				{
					echo number_format($deduct = $fetch_amount_deduction['totalamountdeduction'],2);
				}
				else
				{
					echo $deduct = '0.00';
				}
				?>
			</td>
			<?php

			date_default_timezone_set("Asia/Manila");

			$startdate = "2019-01-01";
			$enddate = date('Y-m-d',(strtotime ( '-1 day' ,strtotime (date("Y-m-d")))));

			if ($category == 'dmpi')
			{
				// ready for deduct
				$received_status = "UPLOADED";
			}
			else
			{
				// ready for deduct
				$received_status = "OKFORDEDUCT";
			}

			$fordeduct_query = "SELECT sum(costextended) as totalfordeduct FROM dbraw WHERE category='$category' AND vendorcode='$vendorcode' AND status='$received_status' AND datecleared BETWEEN '$startdate' AND '$enddate' ";

			// get location
			if (strlen($_POST['location']) > 1)
			{
				$location = $_POST['location'];

				$fordeduct_query .= "AND location='$location' ";
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

				$fordeduct_query .= "AND (".$location.") ";
			}

			$for_deduct = mysqli_query($conn,$fordeduct_query);
			$fetch_for_deduct = mysqli_fetch_array($for_deduct);
			?>
			<td class="tbl-list-order-td4">
				<?php
				if (is_array($fetch_for_deduct))
				{
					echo number_format($fetch_for_deduct['totalfordeduct'],2);
				}
				else
				{
					echo '0.00';
				}
				?>
			</td>
			<td class="tbl-list-order-td5">
				<?php
				if ($deduction == 0)
				{
					echo '0.00%';
				}
				else
				{
					if ($deduct == 0)
					{
						echo '0.00%';
					}
					else
					{
						echo round(($deduct * 100) / $deduction,2).'%';
					}
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
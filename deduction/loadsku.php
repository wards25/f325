<?php
session_start();
include('db.php');

date_default_timezone_set("Asia/Manila");

$category = $_POST['category'];
$vendorcode = $_POST['vendorcode'];
$deducttype = $_POST['deducttype'];

if ($category == 'DMPI')
{
	$status = "UPLOADED";
}
else
{
	$status = "OKFORDEDUCT";
}

$startdate = "2019-01-01";
$enddate = date('Y-m-d',(strtotime ( '-1 day' ,strtotime (date("Y-m-d")))));

$deduct_count = "SELECT * FROM dbraw WHERE category='$category' AND status='$status' AND deducttype='$deducttype' AND datecleared BETWEEN '$startdate' AND '$enddate' ";

// get location
if (strlen($_POST['location']) > 1)
{
	$location = $_POST['location'];

	$deduct_count .= "AND location='$location' ";
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

	$deduct_count .= "AND (".$location.") ";
}

$deduct_count .= "ORDER BY f325number ASC";

// get dbraw
$raw_query = mysqli_query($conn,$deduct_count);
while ($fetch_raw = mysqli_fetch_array($raw_query))
{
	$f325number = $fetch_raw['f325number'];

	// check f325 number if same company
	$dbf325number_query = mysqli_query($conn,"SELECT * FROM dbf325number WHERE f325number='$f325number' AND vendor='$vendorcode' ");
	$fetch_dbf325number = mysqli_fetch_array($dbf325number_query);

	if (is_array($fetch_dbf325number))
	{
		$mdccode = $fetch_raw['mdccode'];

		// get CR #
		$cr_query = mysqli_query($conn,"SELECT * FROM dbmdcdeduction WHERE f325number='$f325number' AND mdccode='$mdccode' ");
		$fetch_cr = mysqli_fetch_array($cr_query);
		?>
		<tr class="tbl-order-detail-tr" skuid="<?php echo $fetch_raw['id']; ?>">
			<td class="tbl-order-detail-td9">
				<input type="checkbox" class="input-check input-check-sku" onclick="CheckAll();SubtotalLines();" <?php if(is_array($fetch_cr)){echo 'checked="checked"';}else{echo 'disabled="disabled"';} ?> >
			</td>
			<td class="tbl-order-detail-td1">
				<input type="text" class="input-NoBorder input-f325number" value="<?php echo $fetch_raw['f325number']; ?>" disabled="disabled">
			</td>
			<td class="tbl-order-detail-td10">
				<?php
				if (is_array($fetch_cr))
				{
					echo $fetch_cr['collection'];
				}
				?>
			</td>
			<td class="tbl-order-detail-td2">
				<input type="text" class="input-NoBorder input-mdccode" value="<?php echo $mdccode = $fetch_raw['mdccode']; ?>" disabled="disabled">
			</td>
			<?php
			$prd_query = mysqli_query($conn,"SELECT * FROM dbproduct WHERE mdccode='$mdccode' AND active='1' ");
			$fetch_prd = mysqli_fetch_array($prd_query);
			?>
			<td class="tbl-order-detail-td4">
				<?php echo $fetch_prd['description']; ?>
			</td>
			<td class="tbl-order-detail-td5">
				<?php echo $fetch_raw['reasoncode']; ?>
			</td>
			<td class="tbl-order-detail-td6">
				<input type="text" class="input-NoBorder input-quantity" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" onclick="this.select();" value="<?php echo $fetch_raw['quantity']; ?>" <?php if(is_array($fetch_cr)){}else{echo 'disabled="disabled"';} ?>>
			</td>
			<td class="tbl-order-detail-td7 td-uom">
				<?php
				if ($fetch_raw['quantity'] >= 2)
				{
					echo $fetch_prd['uom'].'S';
				}
				else
				{
					echo $fetch_prd['uom'];
				}
				?>
			</td>
			<td class="tbl-order-detail-td3">
				<?php if(is_array($fetch_cr)){echo $fetch_cr['unitcost'];}else{echo '0.00';} ?>
			</td>
			<td class="tbl-order-detail-td8">
				<input type="text" class="input-NoBorder input-unitcost" data-decimal="2" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');enforceNumberValidation(this);" onclick="this.select();" value="<?php echo number_format($fetch_raw['unitcost']*$fetch_raw['quantity'],2,'.',''); ?>" <?php if(is_array($fetch_cr)){}else{echo 'disabled="disabled"';} ?> >
			</td>
		</tr>
		<?php
	}
}

$conn->close();
?>
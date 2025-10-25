<?php
session_start();
include('db.php');

$load_query = "SELECT * FROM dbdop WHERE ";

// company
$company = "vendorcode='' ";

for ($i = 1; $i <= 10; $i++)
{
	//get vendor code of company
	$vendorcode_query = mysqli_query($conn,"SELECT * FROM dbcompany WHERE id='$i' ");
	$fetch_vendorcode = mysqli_fetch_array($vendorcode_query);

	if ($_SESSION['comp'.$fetch_vendorcode['id']] == '1'){$company .= "OR vendorcode='".$fetch_vendorcode['vendorcode']."'";} 
}

$load_query .= "(".$company.") ";

$load_query .= "ORDER BY id DESC";

// connect to database
$dop_query = mysqli_query($conn,$load_query);

// count row
$row = mysqli_num_rows($dop_query);

if ($row >= 1)
{
	while ($fetch_dop = mysqli_fetch_array($dop_query))
	{
		$vendorcode = $fetch_dop['vendorcode'];
		// get company name
		$company_query = mysqli_query($conn,"SELECT * FROM dbcompany WHERE vendorcode='$vendorcode' ");
		$fetch_company = mysqli_fetch_array($company_query);

		// get month name
		$dateObj   = DateTime::createFromFormat('!m', $fetch_dop['month']);
		$monthName = $dateObj->format('F');

		// year
		$year = $fetch_dop['year'];

		$uploadnumber = $fetch_dop['uploadnumber'];

		// count DOP
		$row_query = mysqli_query($conn,"SELECT COUNT(id) as totalrow FROM dbmdcdeduction WHERE dopreference='$uploadnumber' ");
		$fetch_row = mysqli_fetch_assoc($row_query);

		// count BILLED
		$billed_query = mysqli_query($conn,"SELECT COUNT(id) as totalbilled FROM dbmdcdeduction WHERE dopreference='$uploadnumber' AND (status='FOR BILLED' OR status='PAID') ");
		$fetch_billed = mysqli_fetch_assoc($billed_query);
		?>
		<tr class="tbl-upload-list-tr" dopid="<?php echo $fetch_dop['id']; ?>">
			<td class="tbl-upload-list-td tbl-upload-list-td1"><?php echo $uploadnumber; ?></td>
			<td class="tbl-upload-list-td tbl-upload-list-td2"><?php echo $fetch_company['name']; ?></td>
			<td class="tbl-upload-list-td tbl-upload-list-td6">
				<?php if($fetch_dop['status'] == 'CANCELLED' || $fetch_dop['status'] == 'DRAFT'){}else{echo $fetch_row['totalrow'].' / '.$fetch_billed['totalbilled'];} ?>
			</td>
			<td class="tbl-upload-list-td tbl-upload-list-td3"><?php echo $monthName.' '.$year; ?></td>
			<td class="tbl-upload-list-td tbl-upload-list-td4"><?php echo $fetch_dop['uploadby']; ?></td>
			<td class="tbl-upload-list-td tbl-upload-list-td5"><?php echo $fetch_dop['status']; ?></td>
		</tr>
		<?php
	}
}
else
{
	?>
	<tr>
		<td style="font-size: 0.8vw;height: 1.4vw;text-align: center;color: #5a5a5a;" colspan="4">No data result.</td>
	</tr>
	<?php
}

$conn->close();
?>
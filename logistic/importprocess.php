<?php
include('db.php');

if ($_FILES['file']['name'] != '')
{
	$allow_ext = array('csv');
	$file_array = explode(".", $_FILES['file']['name']);
	$extension = end($file_array);
	$directory = 'junkupload/';

	if (in_array($extension, $allow_ext))
	{
		$new_file_name = rand() . '.' . $extension;
		move_uploaded_file($_FILES['file']['tmp_name'], $directory.$new_file_name);
		$file_data = fopen($directory.$new_file_name,'r');
		fgetcsv($file_data);

		while ($row = fgetcsv($file_data))
		{
			$f325number = str_replace("'","", $row[0]);
			$code = $row[1];
			$tmnumber = $row[2];
			$drivername = $row[3];
			$platenumber = $row[4];
			$datesched = $row[5];
			$remarks = $row[6];

			// check f325 number
			$check_query = mysqli_query($conn,"SELECT f325number,status FROM dbf325number WHERE f325number='$f325number' ");
			$count = mysqli_num_rows($check_query);

			if ($count >= 1)
			{
				$fetch_check = mysqli_fetch_array($check_query);

				$status = $fetch_check['status'];

				if ($status == 'PRINTED')
				{
					?>
					<tr class="tbl-import-raw-tr" <?php if (empty($tmnumber) || empty($platenumber) || empty($drivername) || empty($datesched)) {echo "style='background-color: #efc1d0;'";} ?>>
						<td><input type="text" class="input-NoBorder input-import-f325number" value="<?php echo $f325number; ?>" disabled="disabled"></td>
						<td><?php echo $code; ?></td>
						<td><input type="text" class="input-NoBorder input-import-tmnumber" value="<?php if (empty($tmnumber)) {echo "For Fill-up";}else{echo $tmnumber;} ?>" disabled="disabled"></td>
						<td><input type="text" class="input-NoBorder input-import-drivername" value="<?php if (empty($drivername)) {echo "For Fill-up";}else{echo $drivername;} ?>" disabled="disabled"></td>
						<td><input type="text" class="input-NoBorder input-import-platenumber" value="<?php if (empty($platenumber)) {echo "For Fill-up";}else{echo $platenumber;} ?>" disabled="disabled"></td>
						<td><input type="date" class="input-NoBorder input-import-dateschedule" value="<?php if (empty($datesched)) {}else{echo date("Y-m-d",strtotime($datesched));} ?>" disabled="disabled"></td>
						<td><input type="text" class="input-NoBorder input-import-remarks" value="<?php echo $remarks; ?>" disabled="disabled"></td>
						<td><?php echo $fetch_check['status']; ?></td>
						<td class="tbl-import-raw-td9"><?php if (empty($tmnumber) || empty($platenumber) || empty($drivername) || empty($datesched)) {?><button type="button" class="button-raw-delete">X</button><?php } ?></td>
					</tr>
					<?php
				}
				else
				{
					?>
					<tr class="tbl-import-raw-tr" style="background-color: #efc1d0;">
						<td><?php echo $f325number; ?></td>
						<td style="text-align: left;" colspan="7">This F325 is already scheduled. Please delete this row.</td>
						<td class="tbl-import-raw-td9"><button type="button" class="button-raw-delete">X</button></td>
					</tr>
					<?php
				}
				
			}
			else
			{
				?>
				<tr class="tbl-import-raw-tr" style="background-color: #efc1d0;">
					<td><?php echo $f325number; ?></td>
					<td style="text-align: left;" colspan="7">Your not allow to add data in csv file. Please delete this row.</td>
					<td class="tbl-import-raw-td9"><button type="button" class="button-raw-delete">X</button></td>
				</tr>
				<?php
			}
		}
	}
	else
	{
		?>
		<tr>
			<td colspan="9"><?php echo "Only CSV file format is allowed"; ?></td>
		</tr>
		<?php
	}
}
else
{
	?>
	<tr>
		<td colspan="9"><?php echo "Please Select File"; ?></td>
	</tr>
	<?php
}


$conn->close();
?>
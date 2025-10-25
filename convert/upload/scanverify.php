<?php
include('db.php');

if ($_SERVER['REMOTE_ADDR'] == '::1')
{
	$ipaddress = str_replace("::", "", $_SERVER['REMOTE_ADDR']);
}
else
{
	$ipaddress = str_replace(".", "", $_SERVER['REMOTE_ADDR']);
}

$user_dir = $_SERVER['DOCUMENT_ROOT']."/convert/upload/duplicate/".$ipaddress;
$files = opendir($user_dir);
while ($file = readdir($files))
{
	if ($file != '.' && $file !='..')
	{
		?>
		<tr>
			<td class="tbl-duplicate-td1"><?php echo $file; ?></td>
			<?php
			$directory = 'duplicate/'.$ipaddress.'/';
			$open_file = fopen($directory.$file, 'r');
			fgets($open_file);
			$newname = trim(fgets($open_file));
			$f325number = trim(str_replace('Doc.# - ','',substr(preg_replace('/\s+/', ' ',$newname), strpos(preg_replace('/\s+/', ' ',$newname),'Doc.# - '))));
			$secondline = fgets($open_file);
			$brcode = preg_replace("/[^0-9a-zA-Z]+/", "", preg_replace("/[^\d+$]\b\w+/", "",trim(str_replace(array('Branch - ','.',']','[','(',')',"'",","), '', $secondline))));
			fgets($open_file);
			fgets($open_file);
			fgets($open_file);
			fgets($open_file);
			fgets($open_file);
			$vendor = trim(preg_replace("/[^-0-9]+/", "",str_replace('Shipped To - ',' ',fgets($open_file))));

			// check if branch is available
			$census_query = mysqli_query($conn,"SELECT code FROM dbcensus WHERE code='$brcode' ");
			$fetch_census = mysqli_fetch_array($census_query);

			if (is_array($fetch_census))
			{
				// check if branch is active
				if ($fetch_census['status'] == '1')
				{
					?>
					<td class="tbl-duplicate-td2"><?php echo "Branch is deactivated"; ?></td>
					<?php
				}
				else
				{
					// Check if vendor is available
					$active_query = mysqli_query($conn,"SELECT * FROM dbcompany WHERE vendorcode='$vendor' ");
					$fetch_active = mysqli_fetch_array($active_query);

					if (is_array($fetch_active))
					{
						// check if vendor is active
						if ($fetch_active['status'] == '1')
						{
							?>
							<td class="tbl-duplicate-td2"><?php echo "Vendor is not active"; ?></td>
							<?php
						}
						else
						{
							// check if f325 is exist in db
							$process_query = mysqli_query($conn,"SELECT * FROM dbf325number WHERE f325number='$f325number' ");
							$fetch_process = mysqli_fetch_array($process_query);

							if (is_array($fetch_process))
							{
								?>
								<td class="tbl-duplicate-td2"><?php echo $fetch_process['process']; ?></td>
								<?php
							}
						}
					}
					else
					{
						?>
						<td class="tbl-duplicate-td2"><?php echo "Vendor is not exist"; ?></td>
						<?php
					}
				}
			}
			elseif (preg_match('/\bRef\b/', $f325number))
			{
				?>
				<td class="tbl-duplicate-td2"><?php echo "Summary"; ?></td>
				<?php
			}
			else
			{
				?>
				<td class="tbl-duplicate-td2"><?php echo "Branch not exist"; ?></td>
				<?php
			}

			?>
		</tr>
		<?php
	}
}

$conn->close();
?>
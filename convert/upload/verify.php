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

// user directory duplicate
$user_dir = $_SERVER['DOCUMENT_ROOT']."/convert/upload/duplicate/".$ipaddress;

// user directory upload
$user_upload_dir = $_SERVER['DOCUMENT_ROOT']."/convert/upload/".$ipaddress;

if (file_exists($user_dir))
{
	$files = opendir($user_upload_dir);
	while ($file = readdir($files))
	{
		if ($file != '.' && $file !='..')
		{
			$open_file = fopen($user_upload_dir."/".$file, 'r');
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
			$census_query = mysqli_query($conn,"SELECT code FROM dbcensus WHERE code='$brcode' AND status='1' ");
			$fetch_census = mysqli_fetch_array($census_query);

			if (is_array($fetch_census))
			{
				// check vendor if in ddcompany
				$check_company_query = mysqli_query($conn,"SELECT * FROM dbcompany WHERE vendorcode='$vendor' AND active='1' ");
				$fetch_check_company = mysqli_fetch_array($check_company_query);

				if (is_array($fetch_check_company))
				{
					// check f325 if exist in database
					$check_po_query = mysqli_query($conn,"SELECT * FROM dbf325number WHERE f325number='$f325number' ");
					$fetch_f325number = mysqli_fetch_array($check_po_query);

					if (is_array($fetch_f325number))
					{
						// close file
						fclose($open_file);

						// rename file
						rename($user_upload_dir."/".$file, $user_upload_dir."/".$f325number.".txt");

						// copy file to duplicate folder
						copy($user_upload_dir."/".$f325number.".txt", $user_dir."/".$f325number.".txt");

						// remove file in user upload
						unlink($user_upload_dir."/".$f325number.".txt");
					}
					else
					{
						if (preg_match('/\bRef\b/', $f325number))
						{
							// close file
							fclose($open_file);

							// rename file
							rename($user_upload_dir."/".$file, $user_upload_dir."/".$f325number.".txt");

							// copy file to duplicate folder
							copy($user_upload_dir."/".$f325number.".txt", $user_dir."/".$f325number.".txt");

							// remove file in user upload
							unlink($user_upload_dir."/".$f325number.".txt");
						}
					}
				}
				else
				{
					// close file
					fclose($open_file);

					// rename file
					rename($user_upload_dir."/".$file, $user_upload_dir."/".$f325number.".txt");

					// copy file to duplicate folder
					copy($user_upload_dir."/".$f325number.".txt", $user_dir."/".$f325number.".txt");

					// remove file in user upload
					unlink($user_upload_dir."/".$f325number.".txt");
				}
			}
			else
			{
				// close file
					fclose($open_file);

					// rename file
					rename($user_upload_dir."/".$file, $user_upload_dir."/".$f325number.".txt");

					// copy file to duplicate folder
					copy($user_upload_dir."/".$f325number.".txt", $user_dir."/".$f325number.".txt");

					// remove file in user upload
					unlink($user_upload_dir."/".$f325number.".txt");
			}
		}
	}
}
else
{
	// create folder of user directory duplicate
	mkdir($user_dir);
	$files = opendir($user_upload_dir);
	while ($file = readdir($files))
	{
		if ($file != '.' && $file !='..')
		{
			$open_file = fopen($user_upload_dir."/".$file, 'r');
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
			$census_query = mysqli_query($conn,"SELECT code FROM dbcensus WHERE code='$brcode' AND status='1' ");
			$fetch_census = mysqli_fetch_array($census_query);

			if (is_array($fetch_census))
			{
				// check vendor if in ddcompany
				$check_company_query = mysqli_query($conn,"SELECT * FROM dbcompany WHERE vendorcode='$vendor' AND active='1' ");
				$fetch_check_company = mysqli_fetch_array($check_company_query);

				if (is_array($fetch_check_company))
				{
					// check f325 if exist in database
					$check_po_query = mysqli_query($conn,"SELECT * FROM dbf325number WHERE f325number='$f325number' ");
					$fetch_f325number = mysqli_fetch_array($check_po_query);

					if (is_array($fetch_f325number))
					{
						// close file
						fclose($open_file);

						// rename file
						rename($user_upload_dir."/".$file, $user_upload_dir."/".$f325number.".txt");

						// copy file to duplicate folder
						copy($user_upload_dir."/".$f325number.".txt", $user_dir."/".$f325number.".txt");

						// remove file in user upload
						unlink($user_upload_dir."/".$f325number.".txt");
					}
					else
					{
						if (preg_match('/\bRef\b/', $f325number))
						{
							// close file
							fclose($open_file);

							// rename file
							rename($user_upload_dir."/".$file, $user_upload_dir."/".$f325number.".txt");

							// copy file to duplicate folder
							copy($user_upload_dir."/".$f325number.".txt", $user_dir."/".$f325number.".txt");

							// remove file in user upload
							unlink($user_upload_dir."/".$f325number.".txt");
						}
					}
				}
				else
				{
					// close file
					fclose($open_file);
				
					// rename file
					rename($user_upload_dir."/".$file, $user_upload_dir."/".$f325number.".txt");

					// copy file to duplicate folder
					copy($user_upload_dir."/".$f325number.".txt", $user_dir."/".$f325number.".txt");

					// remove file in user upload
					unlink($user_upload_dir."/".$f325number.".txt");
				}
			}
			else
			{
				// close file
				fclose($open_file);
				
				// rename file
				rename($user_upload_dir."/".$file, $user_upload_dir."/".$f325number.".txt");

				// copy file to duplicate folder
				copy($user_upload_dir."/".$f325number.".txt", $user_dir."/".$f325number.".txt");

				// remove file in user upload
				unlink($user_upload_dir."/".$f325number.".txt");
			}
		}
	}
}

$conn->close();
?>
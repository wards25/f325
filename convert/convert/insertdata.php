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

// move directory
$move_dir = $_SERVER['DOCUMENT_ROOT']."/convert/convert/".$ipaddress;

$f325loc = $move_dir.'/';
$files = glob($f325loc.'*');
foreach($files as $file)
{
	$open_file = fopen($file, "r");
	fgets($open_file);
	$firstline = fgets($open_file);
	$f325number = trim(str_replace('Doc.# - ','',substr(preg_replace('/\s+/', ' ',$firstline), strpos(preg_replace('/\s+/', ' ',$firstline),'Doc.# - '))));
	$secondline = fgets($open_file);
	$brcode = preg_replace("/[^0-9a-zA-Z]+/", "", preg_replace("/[^\d+$]\b\w+/", "",trim(str_replace(array('Branch - ','.',']','[','(',')',"'",","), '', $secondline))));
	fgets($open_file);
	fgets($open_file);
	fgets($open_file);
	fgets($open_file);
	fgets($open_file);
	$vendor = trim(preg_replace("/[^-0-9]+/", "",str_replace('Shipped To - ',' ',fgets($open_file))));
	fgets($open_file);
	fgets($open_file);
	fgets($open_file);
	fgets($open_file);
	fgets($open_file);
	
	while (!feof($open_file))
	{
		$lines = fgets($open_file);
		if (!trim($lines))
		{
		}
		else
		{
			$mdccode = trim(preg_replace("/[^-0-9]+/", "",strtok(trim(preg_replace('/\s+/', ' ', $lines)),' ')));
			if (strlen($mdccode) >= 6 && strlen($mdccode) <= 7)
			{
				$mdccode;
				$check_qty = trim(strtok(str_replace($mdccode, '', preg_replace('/\s+/', ' ', $lines)),' '));
				if (ctype_digit($check_qty))
				{
					$mdccode;
					$check_qty;

					preg_match_all('/\d{2}\/\d{2}\/\d{2}/',$lines,$result);
					$expire_date = trim(str_replace('"', '', preg_replace('/\\\\/', '', preg_replace('/(\[|\]){2}/', '', json_encode($result)))));
					preg_match_all('/\d+\.\d+\b/', preg_replace('/\s+/', ' ', $lines), $cost);
					$cost_each = trim(str_replace(array( '[', ']','"' ),'',substr_replace(preg_replace('/(\[|\]){2}/', '', json_encode($cost)), '', strpos(preg_replace('/(\[|\]){2}/', '', json_encode($cost)), ','))));

					$costextended = $cost_each * $check_qty;
					if (is_numeric($cost_each))
					{
						$cost_position = strpos(preg_replace('/\s+/', ' ', $lines), $cost_each);
						$reason_code = substr(preg_replace('/\s+/', ' ', $lines),$cost_position-2,1);

						// get branch detail
						$branch_query = mysqli_query($conn,"SELECT * FROM dbcensus WHERE code='$brcode' ");
						$fetch_branch = mysqli_fetch_array($branch_query);
						$location = $fetch_branch['location'];
						$deducttype = $fetch_branch['deducttype'];

						$check_query = mysqli_query($conn,"SELECT * FROM dbraw WHERE f325number='$f325number' AND mdccode='$mdccode' ");
						$fetch_check = mysqli_fetch_array($check_query);

						if (is_array($fetch_check))
						{
							// not inserted
						}
						else
						{
							mysqli_query($conn,"INSERT INTO dbraw(f325number,mdccode,category,vendorcode,deducttype,dmpiclass,quantity,expiration,unitcost,costextended,reasoncode,arnumber,arreason,dmpireason,rcvdqty,dmpiref,deductref,deductqty,deductcostextended,datecleared,pulloutref,location,status,statusout,paymentstatus,skustatus,slstatus,skutype) VALUES ('$f325number','$mdccode','','$vendor','$deducttype','','$check_qty','$expire_date','$cost_each','$costextended','$reason_code','','','0','0','','','0','0','0000-00-00','','$location','OPEN','','','0','','') ");
						}
					}
				}
				
			}
		}
	}
	fclose($open_file);
}

$conn->close();
?>
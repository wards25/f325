<?php
session_start();
include('db.php');

date_default_timezone_set("Asia/Manila");
$dateprocessed = date("Y-m-d");
$timeprocessed = date("H:i:s");

$username = $_SESSION['fname'];

$emaildate = $_POST['emaildate'];

if ($_SERVER['REMOTE_ADDR'] == '::1')
{
	$ipaddress = str_replace("::", "", $_SERVER['REMOTE_ADDR']);
}
else
{
	$ipaddress = str_replace(".", "", $_SERVER['REMOTE_ADDR']);
}

$dir = $_SERVER['DOCUMENT_ROOT']."/convert/upload/".$ipaddress;

// move directory
$move_dir = $_SERVER['DOCUMENT_ROOT']."/convert/convert/".$ipaddress;

$files = opendir($dir);
while ($file = readdir($files))
{
	if ($file != '.' && $file !='..')
	{
		if (file_exists($move_dir))
		{
			// copy file to convert folder
			copy($dir."/".$file, $move_dir."/".$file);

			// remove file in upload folder
			unlink($dir."/".$file);

			$directory = $ipaddress.'/';
			$open_file = fopen($directory.$file, 'r');
			fgets($open_file);
			$newname = trim(fgets($open_file));
			$f325number = trim(str_replace('Doc.# - ','',substr(preg_replace('/\s+/', ' ',$newname), strpos(preg_replace('/\s+/', ' ',$newname),'Doc.# - '))));
			$secondline = fgets($open_file);
			$brcode = preg_replace("/[^0-9a-zA-Z]+/", "", preg_replace("/[^\d+$]\b\w+/", "",trim(str_replace(array('Branch - ','.',']','[','(',')',"'",","), '', $secondline))));
			$thirdline = fgets($open_file);
			$preparedby = utf8_encode(preg_replace("/[^a-zA-Z ]/", "", trim(substr_replace(str_replace('Prepared by - ','',$thirdline), '', strpos(str_replace('Prepared by - ','',$thirdline),' on ')))));
			preg_match_all('/\d{2}\/\d{2}\/\d{4}/',$thirdline,$datef325);
			$f325date = date('Y-m-d',strtotime(trim(str_replace('"', '', preg_replace('/\\\\/', '', preg_replace('/(\[|\]){2}/', '', json_encode($datef325)))))));
			fgets($open_file);
			$issuedby = utf8_encode(trim(fgets($open_file)));
			fgets($open_file);
			fgets($open_file);
			$vendor = trim(preg_replace("/[^-0-9]+/", "",str_replace('Shipped To - ',' ',fgets($open_file))));

			$f325_query = mysqli_query($conn,"SELECT * FROM dbf325number WHERE f325number='$f325number' ");
			$fetch_f325number = mysqli_fetch_array($f325_query);

			if (is_array($fetch_f325number))
			{
				
			}
			else
			{
				// get branch detail
				$branch_query = mysqli_query($conn,"SELECT * FROM dbcensus WHERE code='$brcode' ");
				$fetch_branch = mysqli_fetch_array($branch_query);
				$cluster = $fetch_branch['cluster'];
				$location = $fetch_branch['location'];
				$deducttype = $fetch_branch['deducttype'];

				// inser data
				mysqli_query($conn,"INSERT INTO dbf325number(f325number,brcode,preparedby,issuedby,emaildate,f325date,vendor,tmnumber,drivername,platenumber,datesched,datecleared,arnumber,pageno,printremarks,logisticremarks,clearingremarks,cluster,location,deducttype,status,process, verificationdate,verificationreason,ilrno,stamped,cleared_time) VALUES ('$f325number','$brcode','$preparedby','$issuedby','$emaildate','$f325date','$vendor','','','','0000-00-00','0000-00-00','','','','','','$cluster','$location','$deducttype','OPEN','UPLOADED','0000-00-00','','','','') ");

				// insert history
				$processed = 'Convert and Import.';
				mysqli_query($conn,"INSERT INTO dbhistory(processnumber,name,processed,dateprocessed,timeprocessed) VALUES ('$f325number','$username','$processed','$dateprocessed','$timeprocessed')");
			}

			// close open file
			fclose($open_file);

			// rename file
			rename($move_dir."/".$file, $move_dir."/".$f325number.".txt");

			// store file in database
			$database = $_SERVER['DOCUMENT_ROOT']."/convert/convert/database/";

			// check file if exists
			if (file_exists($database."/".$f325number.".txt"))
			{
				
			}
			else
			{
				// copy file to database folder
				copy($move_dir."/".$f325number.".txt", $database."/".$f325number.".txt");
			}
		}
		else
		{
			// create folder of user in convert
			mkdir($move_dir);

			// copy file to convert folder
			copy($dir."/".$file, $move_dir."/".$file);

			// remove file in upload folder
			unlink($dir."/".$file);

			$directory = $ipaddress.'/';
			$open_file = fopen($directory.$file, 'r');
			fgets($open_file);
			$newname = trim(fgets($open_file));
			$f325number = trim(str_replace('Doc.# - ','',substr(preg_replace('/\s+/', ' ',$newname), strpos(preg_replace('/\s+/', ' ',$newname),'Doc.# - '))));
			$secondline = fgets($open_file);
			$brcode = preg_replace("/[^\d+$]\b\w+/", "",trim(str_replace(array('Branch - ','.',']','[','(',')'), '', $secondline)));
			$thirdline = fgets($open_file);
			$preparedby = trim(substr_replace(str_replace('Prepared by - ','',$thirdline), '', strpos(str_replace('Prepared by - ','',$thirdline),' on ')));
			preg_match_all('/\d{2}\/\d{2}\/\d{4}/',$thirdline,$datef325);
			$f325date = date('Y-m-d',strtotime(trim(str_replace('"', '', preg_replace('/\\\\/', '', preg_replace('/(\[|\]){2}/', '', json_encode($datef325)))))));
			fgets($open_file);
			$issuedby = trim(fgets($open_file));
			fgets($open_file);
			fgets($open_file);
			$vendor = trim(preg_replace("/[^-0-9]+/", "",str_replace('Shipped To - ',' ',fgets($open_file))));

			$f325_query = mysqli_query($conn,"SELECT * FROM dbf325number WHERE f325number='$f325number' ");
			$fetch_f325number = mysqli_fetch_array($f325_query);

			if (is_array($fetch_f325number))
			{
				
			}
			else
			{
				// get branch detail
				$branch_query = mysqli_query($conn,"SELECT * FROM dbcensus WHERE code='$brcode' ");
				$fetch_branch = mysqli_fetch_array($branch_query);
				$cluster = $fetch_branch['cluster'];
				$location = $fetch_branch['location'];

				// inser data
				mysqli_query($conn,"INSERT INTO dbf325number(f325number,brcode,preparedby,issuedby,emaildate,f325date,vendor,tmnumber,drivername,platenumber,datesched,datecleared,arnumber,pageno,printremarks,logisticremarks,clearingremarks,cluster,location,deducttype,status,process,verificationdate,verificationreason,ilrno,stamped,cleared_time) VALUES ('$f325number','$brcode','$preparedby','$issuedby','$emaildate','$f325date','$vendor','','','','0000-00-00','0000-00-00','','','','','','$cluster','$location','$deducttype','OPEN','UPLOADED','0000-00-00','','','','') ");

				// insert history
				$processed = 'Convert and Import.';
				mysqli_query($conn,"INSERT INTO dbhistory(processnumber,name,processed,dateprocessed,timeprocessed) VALUES ('$f325number','$username','$processed','$dateprocessed','$timeprocessed')");
			}

			// close open file
			fclose($open_file);

			// rename file
			rename($move_dir."/".$file, $move_dir."/".$f325number.".txt");

			// store file in database
			$database = $_SERVER['DOCUMENT_ROOT']."/convert/convert/database/";

			// check file if exists
			if (file_exists($database."/".$f325number.".txt"))
			{
				
			}
			else
			{
				// copy file to database folder
				copy($move_dir."/".$f325number.".txt", $database."/".$f325number.".txt");
			}
		}
	}
}
$conn->close();
?>
<?php
session_start();
include('db.php');

$dopnumber = $_POST['dopnumber'];
$month = $_POST['month'];
$year = $_POST['year'];
$company = $_POST['company'];
$crnumber = $_POST['crnumber'];

$user = $_SESSION['fname'];

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

		$query = "INSERT INTO dbdopupload(dbreference,collection,f325number,brcode,vendorcode,mdccode,category,quantity,unitcost,month,year,dopreference,status,user) VALUES ";

		while($row = fgetcsv($file_data))
		{
			$f325number = $row[0];
			$brcode = $row[1];
			$mdccode = $row[2];
			$quantity = $row[3];
			$unitcost = str_replace(',', '', $row[4]);


			// product
			$product_query = mysqli_query($conn,"SELECT * FROM dbproduct WHERE mdccode='$mdccode' AND vendor='$company' ");
			$fetch_product = mysqli_fetch_array($product_query);

			if (is_array($fetch_product))
			{
				$category = $fetch_product['category'];
			}
			else
			{
				$category = "For Fill-up";
			}

			// check status
			$check_status_query = mysqli_query($conn,"SELECT * FROM dbraw WHERE f325number='$f325number' AND mdccode='$mdccode' ");
			$fetch_check_status = mysqli_fetch_array($check_status_query);

			if (is_array($fetch_check_status))
			{
				$reference = $fetch_check_status['reference'];
				$status = $fetch_check_status['status'];
			}
			else
			{
				$reference = "";
				$status = "OPEN";
			}

			$values[] = "('$reference','$crnumber','$f325number','$brcode','$company','$mdccode','$category','$quantity','$unitcost','$month','$year','$dopnumber','$status','$user')";
		}
		$query .= join(',',$values);
		mysqli_query($conn, $query);
	}
	else
	{
		echo 'Only CSV file format is allowed';
	}
}
else
{
	echo 'Please Select File';
}

$conn->close();
?>
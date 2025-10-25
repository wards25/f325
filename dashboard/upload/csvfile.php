<?php

$error = '';
$total_line = '';
session_start();
unset($_SESSION['csv_file_name']);
unset($_SESSION['batch']);
if($_FILES['file']['name'] != '')
{
	$allowed_extension = array('csv');
	$file_array = explode(".", $_FILES["file"]["name"]);
	$extension = end($file_array);
	if(in_array($extension, $allowed_extension))
	{
		$new_file_name = rand() . '.' . $extension;
		$_SESSION['csv_file_name'] = $new_file_name;
		$_SESSION['batch'] = pathinfo($_SESSION['csv_file_name'],PATHINFO_FILENAME);
		move_uploaded_file($_FILES['file']['tmp_name'], 'junkupload/'.$new_file_name);
		$file_content = file('junkupload/'. $new_file_name, FILE_SKIP_EMPTY_LINES);
		$total_rows = count($file_content);

		if ($total_rows < 15100 )
		{
			
			$total_line = count($file_content);
		}
		else
		{
			$error = 'Your upload is '.number_format($total_rows).' lines. Limit is 15,000 lines.';
		}
	}
	else
	{
		$error = 'Only CSV file format is allowed';
	}
}
else
{
	$error = 'Please Select File';
}

if($error != '')
{
	$output = array(
		'error'		=>	$error
	);
}	
else
{
	$output = array(
		'success'		=>	true,
		'total_line'	=>	($total_line - 1)
	);
}

echo json_encode($output);

?>
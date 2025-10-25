<?php

$allowed_ext = array('csv','xlsx','xlsb','png','jpeg','pdf','docx');
$file_array = explode(".", $_FILES["files"]["name"]);
$extension = end($file_array);

if (in_array($extension, $allowed_ext))
{
	
}
else
{
	if ($_SERVER['REMOTE_ADDR'] == '::1')
	{
		$ipaddress = str_replace("::", "", $_SERVER['REMOTE_ADDR']);
	}
	else
	{
		$ipaddress = str_replace(".", "", $_SERVER['REMOTE_ADDR']);
	}

	$dir = $_SERVER['DOCUMENT_ROOT']."/convert/upload/".$ipaddress."/";

	if (file_exists($dir))
	{
		$filename = $_FILES['files']['name'];

		$tmp = $ipaddress.'/';

		move_uploaded_file($_FILES['files']['tmp_name'], $tmp.$filename);
	}
	else
	{
		mkdir($dir);

		$filename = $_FILES['files']['name'];

		$tmp = $ipaddress.'/';

		move_uploaded_file($_FILES['files']['tmp_name'], $tmp.$filename);
	}
}
?>
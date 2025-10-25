<?php
require_once('require/nocache.php');

if ($_SERVER['REMOTE_ADDR'] == '::1')
{
	$ipaddress = str_replace("::", "", $_SERVER['REMOTE_ADDR']);
}
else
{
	$ipaddress = str_replace(".", "", $_SERVER['REMOTE_ADDR']);
}

$dir = $_SERVER['DOCUMENT_ROOT']."/convert/upload/".$ipaddress;
$dir2 = $_SERVER['DOCUMENT_ROOT']."/convert/upload/duplicate/".$ipaddress;

if (file_exists($dir))
{
	
}
else
{
	mkdir($dir);
}

if (file_exists($dir2))
{
	
}
else
{
	mkdir($dir2);
}
?>
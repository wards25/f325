<?php

if ($_SERVER['REMOTE_ADDR'] == '::1')
{
	$ipaddress = str_replace("::", "", $_SERVER['REMOTE_ADDR']);
}
else
{
	$ipaddress = str_replace(".", "", $_SERVER['REMOTE_ADDR']);
}

$dir = $_SERVER['DOCUMENT_ROOT']."/convert/upload/".$ipaddress."/";

$files = glob($dir.'*');
if ($files)
{
	echo $filecount = count($files);
}
else
{
	echo '0';
}

?>
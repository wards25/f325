<?php
if ($_SERVER['REMOTE_ADDR'] == '::1')
{
    $ipaddress = str_replace("::", "", $_SERVER['REMOTE_ADDR']);
}
else
{
    $ipaddress = str_replace(".", "", $_SERVER['REMOTE_ADDR']);
}

$files = glob('duplicate/'.$ipaddress.'/*');

foreach($files as $file)
{

    if(is_file($file))
    {
        unlink($file);
    }
}
?>
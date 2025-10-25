<?php
session_start();

$files = glob('junkupload/*');

foreach($files as $file)
{

    if(is_file($file))
    {
        unlink($file);
    }
}

unset($_SESSION['csv_file_name']);
unset($_SESSION['batch']);

?>
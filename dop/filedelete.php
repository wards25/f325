<?php
// delete junk file
$files = glob('junkupload/*');
foreach($files as $file)
{
    if(is_file($file))
    {
        unlink($file);
    }
}
?>
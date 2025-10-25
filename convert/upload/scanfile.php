<?php

if ($_SERVER['REMOTE_ADDR'] == '::1')
{
	$ipaddress = str_replace("::", "", $_SERVER['REMOTE_ADDR']);
}
else
{
	$ipaddress = str_replace(".", "", $_SERVER['REMOTE_ADDR']);
}

$dir = $_SERVER['DOCUMENT_ROOT']."/convert/upload/".$ipaddress;

if (file_exists($dir))
{
	$files = opendir($dir);
	while ($file = readdir($files))
	{
		if ($file != '.' && $file !='..')
		{
			?>
			<tr class="tbl-list-tr">
				<td class="tbl-list-td1"><?php echo $file; ?></td>
				<td class="tbl-list-td2">
					<?php
					$directory = $ipaddress.'/';
					$open_file = fopen($directory.$file, 'r');
					fgets($open_file);
					$newname = trim(fgets($open_file));
					echo trim(str_replace('Doc.# - ','',substr(preg_replace('/\s+/', ' ',$newname), strpos(preg_replace('/\s+/', ' ',$newname),'Doc.# - '))));
					?>
				</td>
			</tr>
			<?php
		}
	}
}
else
{
	mkdir($dir);
	$files = opendir($dir);
	while ($file = readdir($files))
	{
		if ($file != '.' && $file !='..')
		{
			?>
			<tr class="tbl-list-tr">
				<td class="tbl-list-td1"><?php echo $file; ?></td>
				<td class="tbl-list-td2">
					<?php
					$directory = $ipaddress.'/';
					$open_file = fopen($directory.$file, 'r');
					fgets($open_file);
					$newname = trim(fgets($open_file));
					echo trim(str_replace('Doc.# - ','',substr(preg_replace('/\s+/', ' ',$newname), strpos(preg_replace('/\s+/', ' ',$newname),'Doc.# - '))));
					?>
				</td>
			</tr>
			<?php
		}
	}
}
?>
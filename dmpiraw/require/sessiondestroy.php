<?php
if (isset($conn))
{
	// check session destroy if activated
	$session_query = mysqli_query($conn,"SELECT * FROM dbmaintenance");
	$fetch_session = mysqli_fetch_array($session_query);

	if ($fetch_session['sessiondestroy'] == '1')
	{
		header("location:/");
	}
}
?>
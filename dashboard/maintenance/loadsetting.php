<?php
include('db.php');

// load current setting
$load_query = mysqli_query($conn,"SELECT * FROM dbmaintenance");
$fetch_load = mysqli_fetch_array($load_query);


$id = $fetch_load['id'];
$session = $fetch_load['sessiondestroy'];
$announcement = $fetch_load['announcementactive'];
$msg = $fetch_load['systemmsg'];

echo json_encode(array(
	'id' => $id,
	'session' => $session,
	'announcement' => $announcement,
	'msg' => $msg
));


$conn->close();
?>
<?php
include('db.php');

$vcode = $_POST['vcode'];

// check bypass if enabled
$check_query = mysqli_query($conn,"SELECT * FROM dbcompany WHERE vendorcode='$vcode' ");
$fetch_check = mysqli_fetch_array($check_query);

if ($fetch_check['bypass'] == '1')
{
	echo "true";
}
else
{
	echo "false";
}

$conn->close();
?>
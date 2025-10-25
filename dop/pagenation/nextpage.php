<?php
include('db.php');

$dopnumber = $_POST['dopnumber'];
$perpage = $_POST['perpage'];

// sql query in dbmdcdeduction
$query = mysqli_query($conn,"SELECT * FROM dbmdcdeduction WHERE dopreference='$dopnumber' ");
$row = mysqli_num_rows($query);

$totalpage = round($row/$perpage)-1;

echo json_encode(array(
	'totalpage' => $totalpage,
	'totalrow' => $row
));


$conn->close();
?>
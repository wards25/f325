<?php
include('db.php');

$dopnumber = $_POST['dopnumber'];
$status = "CANCELLED";

// update status
mysqli_query($conn,"UPDATE dbdop SET status='$status' WHERE uploadnumber='$dopnumber' ");
echo "Cancelled successfully!";

$conn->close();
?>
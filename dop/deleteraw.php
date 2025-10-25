<?php
include('db.php');

$id = $_POST['id'];

// delete raw
mysqli_query($conn,"DELETE FROM dbdopupload WHERE id='$id' ");

$conn->close();
?>
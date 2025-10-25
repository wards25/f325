<?php
include('db.php');

$value = $_POST['dataType'];

// delete prdlist in db 
mysqli_query($conn,"DELETE FROM $value WHERE id");

// reset auto increment
mysqli_query($conn,"ALTER TABLE $value AUTO_INCREMENT = 1 ");

$conn->close();
?>
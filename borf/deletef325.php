<?php
include('db.php');

$f325number = $_POST['f325number'];
$bms = $_POST['bms'];

// delete f325 in dbborflist
mysqli_query($conn,"DELETE FROM dbborflist WHERE f325number='$f325number' ");

// delete f325 in dbborfraw
mysqli_query($conn,"DELETE FROM dbborfraw WHERE f325number='$f325number' ");

// upload location
$filelocation = "C:/public/www/f325.ramosco.net/filepicture/dbapps/";

// delete f325 in file picture
unlink($filelocation.$f325number.'.jpg');

// delete in dbhistory
mysqli_query($conn,"DELETE FROM dbhistory WHERE name='$bms' ");

echo "Delete successfully!";

$conn->close();
?>
<?php
$dbhost = "localhost";
$dbuser = "deys";
$dbpass = "house123";
$dbname = "fullhouse";

$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

$sql = "UPDATE users SET money = money + 10";

$script=mysqli_query($conn,$sql);

mysqli_close($conn);
?>

<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "full-house";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("Nelze se připojit k databázi");
}

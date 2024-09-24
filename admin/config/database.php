<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbName = "phpdasar";

$db = mysqli_connect($host, $user, $pass, $dbName);

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
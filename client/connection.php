<?php


$host = "localhost";
$username = "root";
$passwd = "8168627861";
$dbname = "NAF1";

$connect = mysqli_connect($host, $username, $passwd, $dbname) or die("Cannot connect to database");
$bg_color = "";

date_default_timezone_set("Africa/Lagos");
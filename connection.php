<?php

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'property_rental';

if(!$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name)) {
    die("Failed to connect to the database");
}

?>
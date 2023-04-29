<?php
$dbserver = 'localhost';
//enter your database username
$dbuser = '';
//enter your database password
$dbpass = '';
//enter your database name
$db = '';
$sqlcxn = mysqli_connect($dbserver, $dbuser, $dbpass, $db) or die
('Database Error');
$dbh = new PDO('mysql:host='.$dbserver.';dbname='.$db, $dbuser, $dbpass);
?>
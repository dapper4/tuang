<?php
/*
 * set var
 */
$Host = "localhost";
$User = "root";
$Password = "";
$Database = "dimsum";

/*
 * connection mysql
 */
$meConnect = mysqli_connect($Host, $User, $Password, $Database) or die("Error conncetion mysql");
mysqli_query($meConnect,"SET NAMES UTF8");
?>

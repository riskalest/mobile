<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$host = "localhost";
$user = "root";
$pass = "";
$dbName = "aplppam";
$kon = mysqli_connect($host,$user, $pass);
if(!$kon)
	echo "Gagal Koneksi...";
$hasil = mysqli_select_db($kon, $dbName);
?>

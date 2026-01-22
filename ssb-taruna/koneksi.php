<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "taruna_ssb"; // Update nama database di sini

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}
?>
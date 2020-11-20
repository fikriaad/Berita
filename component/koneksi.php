<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'berita';
$koneksi = mysqli_connect($host, $user, $pass, $db);
if ($koneksi->connect_errno) {
    echo "konesi gagal ke db:" . $koneksi->connect_error;
    exit();
}

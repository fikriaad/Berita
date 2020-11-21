<?php

$id = $_GET['id'];
// cari gambar
$cari = $koneksi->query("SELECT berita_gambar FROM tb_berita WHERE berita_id='$id'")->fetch_array();
if (!empty($cari['berita_gambar'])) {
    unlink('img/berita/' . $cari['berita_gambar']);
}
$hapus = $koneksi->query("DELETE FROM tb_berita WHERE berita_id='$id'");
if ($hapus) {
    echo "
    <script>alert('Data Berhasil di Hapus')</script>
    <script>window.location='index.php?page=modul/berita/index';</script>
    ";
} else {
    echo "
    <script>alert('Hapus Data Gagal')</script>
    <script>window.location='index.php?page=modul/berita/index';</script>
    ";
}

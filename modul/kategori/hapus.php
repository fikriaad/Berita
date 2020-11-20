<?php

$id = $_GET['id'];
// cari gambar
$cari = $koneksi->query("SELECT kategori_logo FROM tb_kategori WHERE kategori_id='$id'")->fetch_array();
if (!empty($cari['kategori_logo'])) {
    unlink('img/kategori/' . $cari['kategori_logo']);
}
$hapus = $koneksi->query("DELETE FROM tb_kategori WHERE kategori_id='$id'");
if ($hapus) {
    echo "
    <script>alert('Data Berhasil di Hapus')</script>
    <script>window.location='index.php?page=modul/kategori/index';</script>
    ";
} else {
    echo "
    <script>alert('Hapus Data Gagal')</script>
    <script>window.location='index.php?page=modul/kategori/index';</script>
    ";
}

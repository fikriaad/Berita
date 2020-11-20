<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Kategoti</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tambah Data Kategoti</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="card">
            <div class="card-header">
                Amin
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="kategori_nama">
                    </div>
                    <div class="form-group">
                        <label>Logo</label>
                        <input type="file" class="form-control" name="kategori_logo">
                    </div>
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                </form>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>

<!-- aksi simpan -->
<?php
if (isset($_POST['simpan'])) {
    $kategori_nama = $_POST['kategori_nama'];
    $kategori_logo = $_FILES['kategori_logo']['name'];
    $lokasi_logo = $_FILES['kategori_logo']['tmp_name'];

    // ganti nama logo
    $file_name = explode('.', $kategori_logo);
    $nama_file = end($file_name);
    $file_ext = strtolower($nama_file);
    $nama_file = date('YmdHis') . "-" . substr(uniqid('', true), -5) . "." . $file_ext;
    // upload logo
    move_uploaded_file($lokasi_logo, "img/kategori/$nama_file");

    $simpan =  $koneksi->query("INSERT INTO tb_kategori(kategori_nama, kategori_logo)
                                VALUES ('$kategori_nama','$nama_file')");
    if ($simpan) {
        echo "
        <script>alert('Tambah Data Berhasil')</script>
        <script>window.location='index.php?page=modul/kategori/index';</script>
        ";
    } else {
        echo "
        <script>alert('Tambah Data Gagal')</script>
        <script>window.location='index.php?page=modul/kategori/index';</script>
        ";
    }
}
?>
<?php
$data = $koneksi->query("SELECT kategori_id, kategori_nama FROM tb_kategori");
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Berita</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tambah Data Berita</li>
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
                        <label>Id Kategori</label>
                        <select type="text" class="form-control" name="kategori_id">
                            <option selected disabeld>Pilih</option>
                            <?php while ($select = mysqli_fetch_assoc($data)) { ?>
                                <option value="<?php echo $select['kategori_id']; ?>"><?php echo $select['kategori_nama']; ?></option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" name="berita_judul">
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" name="berita_tanggal">
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" class="form-control" name="berita_gambar">
                    </div>
                    <div class="form-group">
                        <label>Penulis</label>
                        <input type="text" class="form-control" name="berita_penulis">
                    </div>
                    <div class="form-group">
                        <label>Isi</label>
                        <textarea type="text" class="form-control" name="berita_isi" id="editor1"></textarea>
                        <script>
                            CKEDITOR.replace('editor1');
                        </script>
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
    $kategori_id = $_POST['kategori_id'];
    $berita_judul = $_POST['berita_judul'];
    $berita_tanggal = $_POST['berita_tanggal'];
    $berita_penulis = $_POST['berita_penulis'];
    $berita_isi = $_POST['berita_isi'];
    $berita_gambar = $_FILES['berita_gambar']['name'];
    $lokasi_gambar = $_FILES['berita_gambar']['tmp_name'];

    // kategori

    // ganti nama gambar
    $file_name = explode('.', $berita_gambar);
    $nama_file = end($file_name);
    $file_ext = strtolower($nama_file);
    $nama_file = date('YmdHis') . "-" . substr(uniqid('', true), -5) . "." . $file_ext;
    // upload gambar
    move_uploaded_file($lokasi_gambar, "img/berita/$nama_file");

    $simpan =  $koneksi->query("INSERT INTO tb_berita (kategori_id, berita_judul, berita_tanggal, berita_gambar, berita_penulis, berita_isi)
                                VALUES ('$kategori_id','$berita_judul','$berita_tanggal','$nama_file','$berita_penulis','$berita_isi')");
    // echo "INSERT INTO tb_berita(berita_nama, kategori_id, berita_gambar, berita_tanggal, berita_penulis, berita_isi)
    // VALUES ('$berita_nama','$kategori_id','$berita_judul','$berita_tanggal','$berita_penulis','$berita_isi','$nama_file')";
    // exit;
    if ($simpan) {
        echo "
        <script>alert('Tambah Data Berhasil')</script>
        <script>window.location='index.php?page=modul/berita/index';</script>
        ";
    } else {
        echo "
        <script>alert('Tambah Data Gagal')</script>
        <script>window.location='index.php?page=modul/berita/index';</script>
        ";
    }
}
?>
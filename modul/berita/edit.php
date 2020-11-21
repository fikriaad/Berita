<?php
$id = $_GET['id'];
$data = $koneksi->query("SELECT * FROM tb_berita WHERE berita_id='$id'")->fetch_array();
$data_kategori = $koneksi->query("SELECT kategori_id, kategori_nama FROM tb_kategori");
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
                    <li class="breadcrumb-item active">Edit Data Berita</li>
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
                Berita
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>ID Kategori</label>
                        <select class="form-control" name="kategori_id">
                            <?php while ($select = mysqli_fetch_assoc($data_kategori)) { ?>
                                <option value="<?php echo $select['kategori_id']; ?>"><?php echo $select['kategori_nama']; ?></option>
                            <?php } ?>
                            <script>
                                document.getElementsByName('kategori_id')[0].value = <?php echo $data['kategori_id'] ?>
                            </script>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" name="berita_judul" value="<?php echo $data['berita_judul'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" name="berita_tanggal" value="<?php echo $data['berita_tanggal'] ?>">
                    </div>
                    <div class=" form-group">
                        <label>Gambar</label>
                        <br>
                        <img src="img/berita/<?php echo $data['berita_gambar'] ?>" alt="" class="text-center" style="width: 100px;height:100px;">
                        <input type="file" class="form-control" name="berita_gambar">
                    </div>
                    <div class="form-group">
                        <label>Penulis</label>
                        <input type="text" class="form-control" name="berita_penulis" value="<?php echo $data['berita_penulis'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Isi</label>
                        <textarea type="text" class="form-control" name="berita_isi" id="editor1"><?php echo $data['berita_isi'] ?></textarea>
                        <script>
                            CKEDITOR.replace('editor1');
                        </script>
                    </div>
                    <button type=" submit" class="btn btn-primary" name="simpan">Edit</button>
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
    $berita_id = $id;
    // ganti judul gambar
    $file_name = explode('.', $berita_gambar);
    $judul_file = end($file_name);
    $file_ext = strtolower($judul_file);
    $judul_file = date('YmdHis') . "-" . substr(uniqid('', true), -5) . "." . $file_ext;

    //cari gambar
    $gambar = $koneksi->query("SELECT berita_gambar FROM tb_berita WHERE berita_id='$id'")->fetch_array();

    // jika tidak gambar
    if ($berita_gambar == null) {
        $simpan = $koneksi->query("UPDATE tb_berita SET berita_judul='$berita_judul'
                                                WHERE 
                                                    berita_id='$berita_id'");
    }
    // jika edit gambar
    elseif ($berita_gambar != null) {
        move_uploaded_file($lokasi_gambar, "img/berita/$judul_file");
        if (!empty($gambar['berita_gambar'])) {
            unlink('img/berita/' . $gambar['berita_gambar']);
        }

        $simpan = $koneksi->query("UPDATE tb_berita SET berita_judul='$berita_judul',
                                                    berita_gambar='$judul_file'
                                                WHERE 
                                                    berita_id='$berita_id'");
    }
    if ($simpan) {
        echo "
        <script>alert('Edit Data Berhasil')</script>
        <script>window.location='index.php?page=modul/berita/index';</script>
        ";
    } else {
        echo "
        <script>alert('Edit Data Gagal')</script>
        <script>window.location='index.php?page=modul/berita/index';</script>
        ";
    }
}
?>
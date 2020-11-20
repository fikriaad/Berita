<?php
$id = $_GET['id'];
$data = $koneksi->query("SELECT * FROM tb_kategori WHERE kategori_id='$id'")->fetch_array();
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Kategori</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Edit Data Kategori</li>
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
                Kategori
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="kategori_nama" value="<?php echo $data['kategori_nama'] ?>">
                    </div>
                    <div class=" form-group">
                        <label>Logo</label>
                        <br>
                        <img src="img/kategori/<?php echo $data['kategori_logo'] ?>" alt="" class="text-center" style="width: 100px;height:100px;">
                        <input type="file" class="form-control" name="kategori_logo">
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
    $kategori_nama = $_POST['kategori_nama'];
    $kategori_logo = $_FILES['kategori_logo']['name'];
    $lokasi_logo = $_FILES['kategori_logo']['tmp_name'];
    $kategori_id = $id;
    // ganti nama logo
    $file_name = explode('.', $kategori_logo);
    $nama_file = end($file_name);
    $file_ext = strtolower($nama_file);
    $nama_file = date('YmdHis') . "-" . substr(uniqid('', true), -5) . "." . $file_ext;

    //cari logo
    $gambar = $koneksi->query("SELECT kategori_logo FROM tb_kategori WHERE kategori_id='$id'")->fetch_array();

    // jika tidak logo
    if ($kategori_logo == null) {
        $simpan = $koneksi->query("UPDATE tb_kategori SET kategori_nama='$kategori_nama'
                                                WHERE 
                                                    kategori_id='$kategori_id'");
    }
    // jika edit logo
    elseif ($kategori_logo != null) {
        move_uploaded_file($lokasi_logo, "img/kategori/$nama_file");
        if (!empty($gambar['kategori_logo'])) {
            unlink('img/kategori/' . $gambar['kategori_logo']);
        }

        $simpan = $koneksi->query("UPDATE tb_kategori SET kategori_nama='$kategori_nama',
                                                    kategori_logo='$nama_file'
                                                WHERE 
                                                    kategori_id='$kategori_id'");
    }
    if ($simpan) {
        echo "
        <script>alert('Edit Data Berhasil')</script>
        <script>window.location='index.php?page=modul/kategori/index';</script>
        ";
    } else {
        echo "
        <script>alert('Edit Data Gagal')</script>
        <script>window.location='index.php?page=modul/kategori/index';</script>
        ";
    }
}
?>
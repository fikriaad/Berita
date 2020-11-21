<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Berita</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data Berita</li>
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
                <a href="?page=modul/berita/tambah" class="btn btn-primary my-4">
                    Tambah Data
                </a>
                <table class="table" id="example1">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Penulis</th>
                            <th scope="col">Isi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ambil = $koneksi->query("SELECT * FROM tb_berita left join tb_kategori on tb_berita.kategori_id=tb_kategori.kategori_id");
                        foreach ($ambil as $a => $pecah) {
                        ?>

                            <tr>
                                <td><?php echo $a + 1 ?></td>
                                <td><?php echo $pecah['kategori_nama'] ?></td>
                                <td><?php echo $pecah['berita_judul'] ?></td>
                                <td><?php echo $pecah['berita_tanggal'] ?></td>
                                <td>
                                    <img src="img/berita/<?php echo $pecah['berita_gambar'] ?>" alt="" style="width: 100px;">
                                </td>
                                <td><?php echo $pecah['berita_penulis'] ?></td>
                                <td><?php echo $pecah['berita_isi'] ?></td>
                                <td>
                                    <a href="index.php?page=modul/berita/edit&id=<?= $pecah['berita_id'] ?>" class="btn btn-warning">Edit</a>
                                    <a href="index.php?page=modul/berita/hapus&id=<?php echo $pecah['berita_id'] ?>" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                        <?php

                        }
                        ?>
                    </tbody>
                </table>


            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
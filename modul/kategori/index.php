<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Kategori</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data Kategori</li>
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
                <a href="?page=modul/kategori/tambah" class="btn btn-primary my-4">
                    Tambah Data
                </a>
                <table class="table" id="example1">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Logo</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ambil = $koneksi->query("SELECT * FROM tb_kategori");
                        foreach ($ambil as $a => $pecah) {
                        ?>

                            <tr>
                                <td><?php echo $a + 1 ?></td>
                                <td><?php echo $pecah['kategori_nama'] ?></td>
                                <td>
                                    <img src="img/kategori/<?php echo $pecah['kategori_logo'] ?>" alt="" style="width: 100px;">
                                </td>
                                <td>
                                    <a href="index.php?page=modul/kategori/edit&id=<?= $pecah['kategori_id'] ?>" class="btn btn-warning">Edit</a>
                                    <a href="index.php?page=modul/kategori/hapus&id=<?php echo $pecah['kategori_id'] ?>" class="btn btn-danger">Hapus</a>
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
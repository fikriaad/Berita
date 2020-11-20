<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Admin</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data Admin</li>
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
                <a href="?page=modul/admin/tambah" class="btn btn-primary my-4">
                    Tambah Data
                </a>
                <table class="table" id="example1">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ambil = $koneksi->query("SELECT * FROM tb_admin");
                        foreach ($ambil as $a => $pecah) {
                        ?>

                            <tr>
                                <td><?php echo $a + 1 ?></td>
                                <td><?php echo $pecah['admin_nama'] ?></td>
                                <td><?php echo $pecah['admin_email'] ?></td>
                                <td>
                                    <img src="img/admin/<?php echo $pecah['admin_foto'] ?>" alt="" style="width: 100px;">
                                </td>
                                <td>
                                    <a href="index.php?page=modul/admin/edit&id=<?= $pecah['admin_id'] ?>" class="btn btn-warning">Edit</a>
                                    <a href="index.php?page=modul/admin/hapus&id=<?= $pecah['admin_id'] ?>" class="btn btn-danger">Hapus</a>
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
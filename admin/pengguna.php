<?php $title = 'Pengguna'; ?>
<?php include_once ('layout/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengguna</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Pengguna</h5>
                            <a href="pengguna.add.php" class="btn btn-primary float-right mb-3">Tambah Pengguna</a>
                            <div class="mt-5">
                                <?php if (isset($_GET['status']) || !empty($_GET['status'])): ?>
                                    <div class="p-2 alert alert-<?= ($_GET['status'] == 'berhasil' ? 'success' : 'danger') ?>"
                                        role="alert">
                                        <h4 class="alert-heading"><?= $_GET['pesan'] ?></h4>
                                        <?php if (isset($_GET['error']) || !empty($_GET['error'])): ?>
                                            <p>
                                                <?= $_GET['error'] ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="table-data">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM user";
                                        $index = 1;
                                        $result = mysqli_query($koneksi, $sql);
                                        while ($data = mysqli_fetch_array($result)):
                                            ?>
                                            <tr>
                                                <th scope="row"><?= $index++ ?></th>
                                                <td><?= $data['name'] ?></td>
                                                <td><?= $data['email'] ?></td>
                                                <td><?= $data['role'] ?></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="pengguna.edit.php?id=<?= $data['id'] ?>"
                                                            class="btn btn-sm btn-warning mr-2">Edit</a>
                                                        <a href="proses.pengguna.delete.php?id=<?= $data['id'] ?>"
                                                            onclick="return confirm('Apakah anda yakin ingin menghapus pengguna ini?')"
                                                            class="btn btn-sm btn-danger">Hapus</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once ('layout/footer.php'); ?>

<script>

    $(function () {
        $('#table-data').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "pageLength": 5,
        });
    });

</script>
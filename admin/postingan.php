<?php $title = 'Postingan'; ?>
<?php include_once ('layout/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Postingan</h1>
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
                            <h5 class="card-title">Daftar Postingan</h5>
                            <a href="postingan.add.php" class="btn btn-primary float-right mb-3">Tambah Postingan</a>
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
                                            <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                                                <th scope="col">Pengguna</th>
                                            <?php endif; ?>
                                            <th scope="col">Judul</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">Thumbnail</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($_SESSION['user']['role'] === 'admin') {
                                            $sql = "SELECT blog.* , user.name AS username FROM blog JOIN user ON blog.user_id = user.id ORDER BY id DESC";
                                        } else {
                                            $sql = "SELECT * FROM blog WHERE user_id = " . $_SESSION['user']['id'] . " ORDER BY id DESC";
                                        }
                                        $index = 1;
                                        $result = mysqli_query($koneksi, $sql);
                                        while ($data = mysqli_fetch_array($result)): ?>
                                            <tr>
                                                <th scope="row"><?= $index++ ?></th>
                                                <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                                                    <td><?= $data['username'] ?></td>
                                                <?php endif; ?>
                                                <td><?= $data['title'] ?></td>
                                                <td><?= $data['deskripsi'] ?></td>
                                                <td>
                                                    <a href="<?= $data['thumbnail'] ?>" target="_blank">Lihat
                                                        thumbnail</a>
                                                </td>
                                                <td><?= $data['tanggal'] ?></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="../article.php?id=<?= $data['id'] ?>" target="_blank"
                                                            class="btn btn-sm btn-success mr-1">Lihat
                                                            Postingan</a>
                                                        <a href="komentar.view.php?id=<?= $data['id'] ?>"
                                                            class="btn btn-sm btn-info mr-1">Lihat Komentar</a>
                                                        <a href="postingan.edit.php?id=<?= $data['id'] ?>"
                                                            class="btn btn-sm btn-warning mr-1">Edit</a>
                                                        <a href="proses.postingan.delete.php?id=<?= $data['id'] ?>"
                                                            onclick="return confirm('Apakah anda yakin ingin menghapus postingan ini?')"
                                                            class="btn btn-sm btn-danger mr-1">Hapus</a>
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
<?php $title = 'Postingan'; ?>
<?php include_once ('layout/header.php'); ?>

<?php
if (!isset($_GET['id']) || empty($_GET['id'])) {
    return header('location: postingan.php');
}
$id = $_GET['id'];

function blogDetails($id)
{
    global $koneksi;
    $sql = "SELECT * FROM blog WHERE id = $id";
    $result = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_array($result);
    return $data;
}

function userDetails($id)
{
    global $koneksi;
    $sql = "SELECT * FROM user WHERE id = $id";
    $result = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_array($result);
    return $data;
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Komentar</h1>
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
                            <div class="mb-2">
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
                            <h5 class="card-title">Komentar : (<?= blogDetails($id)['title'] ?>)</h5>

                            <div class="table-responsive">
                                <table class="table" id="table-data">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Pengguna</th>
                                            <th scope="col">Text</th>
                                            <th scope="col">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM komentar WHERE blog_id = $id";
                                        $index = 1;
                                        $result = mysqli_query($koneksi, $sql);
                                        while ($data = mysqli_fetch_array($result)):
                                            ?>
                                            <tr>
                                                <th scope="row"><?= $index++ ?></th>
                                                <td><?= ($data['user_id'] ? userDetails($data['user_id'])['name'] : 'Anonymous') ?>
                                                </td>
                                                <td><?= $data['text'] ?></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="proses.komentar.delete.php?id=<?= $data['id'] ?>"
                                                            onclick="return confirm('Apakah anda yakin ingin menghapus komentar ini?')"
                                                            class="btn btn-sm btn-danger">Hapus</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                </table>
                            </div>

                            <a href="postingan.php" class="btn btn-outline-primary float-right mt-3">Kembali</a>
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
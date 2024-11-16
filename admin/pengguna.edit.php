<?php $title = 'Pengguna'; ?>
<?php
if (!isset($_GET['id']) || empty($_GET['id'])) {
    return header('location: pengguna.php');
}
$id = $_GET['id'];
?>
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
                            <h4 class="mb-4">Edit Pengguna</h4>
                            <div class="col-lg-12">
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
                            <form action="proses.pengguna.edit.php?id=<?= $id ?>" id="formEdit" method="post"
                                enctype="multipart/form-data">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <?php

                                            $sql = "SELECT * FROM user WHERE id = " . $id;
                                            $result = mysqli_query($koneksi, $sql);
                                            while ($data = mysqli_fetch_array($result)):
                                                ?>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="name">Nama</label>
                                                        <input type="text" value="<?= $data['name'] ?>" name="name"
                                                            id="name" class="form-control" required>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" value="<?= $data['email'] ?>" name="email"
                                                            id="email" class="form-control" required>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" name="password" id="password"
                                                            placeholder="<?= $data['password'] ?>" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="role">Role</label>
                                                        <select name="role" value="<?= $data['role'] ?>" id="role"
                                                            class="form-control" required>
                                                            <option value="">- Pilih Role -</option>
                                                            <option <?= $data['role'] == 'admin' ? 'selected' : '' ?>
                                                                value="admin">Admin</option>
                                                            <option <?= $data['role'] == 'member' ? 'selected' : '' ?>
                                                                value="member">Member</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            <?php endwhile; ?>

                                            <div class="col-lg-12">
                                                <a href="pengguna.php" class="btn btn-outline-primary">Kembali</a>
                                                <button type="submit" class="btn btn-primary float-right">Simpan
                                                    Pembaruan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

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
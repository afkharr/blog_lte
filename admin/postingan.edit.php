<?php $title = 'Postingan'; ?>
<?php
if (!isset($_GET['id']) || empty($_GET['id'])) {
    return header('location: postingan.php');
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
                            <h4 class="mb-4">Edit Postingan</h4>
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
                            <form action="proses.postingan.edit.php?id=<?= $id ?>" onsubmit="submitPostingan(event)"
                                id="formAdd" method="post" enctype="multipart/form-data">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <?php
                                            $sql = "SELECT * FROM blog WHERE id = '$id'";
                                            $result = mysqli_query($koneksi, $sql);
                                            while ($data = mysqli_fetch_array($result)):
                                                ?>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="file_thumbnail">Thumbnail</label>
                                                        <input type="file" name="file_thumbnail" id="file_thumbnail"
                                                            accept="image/jpg, image/jpeg, image/png" class="form-control">
                                                        <input type="hidden" name="thumbnail" id="thumbnail">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="title">Judul</label>
                                                        <input type="text" value="<?= $data['title'] ?>" name="title"
                                                            id="title" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="deskripsi">Deskripsi</label>
                                                        <input type="text" value="<?= $data['deskripsi'] ?>"
                                                            name="deskripsi" id="deskripsi" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="tanggal">Tanggal</label>
                                                        <input type="date" value="<?= $data['tanggal'] ?>" name="tanggal"
                                                            id="tanggal" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="summernote">Konten</label>
                                                        <textarea id="summernote"></textarea>
                                                        <input type="hidden"
                                                            value="<?= htmlspecialchars($data['body'], ENT_QUOTES, 'UTF-8') ?>"
                                                            name="content" id="content">
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>
                                            <div class="col-lg-12">
                                                <a href="postingan.php" class="btn btn-outline-primary">Kembali</a>
                                                <button type="submit" class="btn btn-primary float-right">Simpan
                                                    Perubahan</button>
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

<script>

    $('#summernote').summernote({
        placeholder: 'Mulai dengan menulis konten anda',
        tabsize: 2,
        height: 500,
        callbacks: {
            onImageUpload: function (files) {
                for (let i = 0; i < files.length; i++) {
                    sendFile(files[i]);
                }
            }
        }
    });

    $('#summernote').summernote('code', $('#content').val());

    async function sendFile(file, tipe = "") {
        let data = new FormData();
        data.append("file", file, file.name);
        return new Promise((resolve, reject) => {
            $.ajax({
                data: data,
                type: "POST",
                url: "proses.upload.gambar.php",
                cache: false,
                contentType: false,
                processData: false,
                success: function (img) {
                    if (tipe == "thumbnail") {
                        resolve(img);
                    } else {
                        $('#summernote').summernote('insertImage', img);
                        resolve();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    reject(new Error('File upload failed: ' + textStatus));
                }
            });
        });
    }

    async function submitPostingan(event) {
        event.preventDefault();
        var isiContent = $('#summernote').summernote('code');

        var file_thumbnail = document.getElementById('file_thumbnail').files[0];

        try {
            let thumbnail = '';
            if (file_thumbnail) {
                thumbnail = await sendFile(file_thumbnail, "thumbnail");
            }
            document.getElementById('content').value = isiContent;
            document.getElementById('thumbnail').value = thumbnail;
            document.getElementById('formAdd').submit();
        } catch (error) {
            console.error('Error uploading thumbnail:', error);
        }
    }

</script>
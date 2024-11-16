<?php

require ('../config/koneksi.php');

$id = $_GET['id'];

try {
    $deleteKomentar = "DELETE FROM komentar WHERE blog_id = $id";
    $deleteBlog = "DELETE FROM blog WHERE id = $id";

    mysqli_query($koneksi, $deleteKomentar);
    mysqli_query($koneksi, $deleteBlog);

    header('Location: postingan.php?id=' . $id . '&status=berhasil&pesan=Berhasil menghapus postingan');

} catch (\Throwable $th) {
    header('location: postingan.php?id=' . $_GET['id'] . '&status=gagal&pesan=Gagal menghapus postingan&error=' . $th->getMessage());

}

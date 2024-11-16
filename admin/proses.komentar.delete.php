<?php

require ('../config/koneksi.php');

$id = $_GET['id'];

try {
    $sql = "DELETE FROM komentar WHERE id = $id";
    $result = mysqli_query($koneksi, $sql);
    if ($result === true) {
        header('Location: komentar.view.php?id=' . $id . '&status=berhasil&pesan=Berhasil menghapus komentar');
    } else {
        header('Location: komentar.view.php?id=' . $id . '&status=gagal&pesan=Gagal menghapus komentar');
    }
} catch (\Throwable $th) {
    header('location: komentar.view.php?id=' . $_GET['id'] . '&status=gagal&pesan=Gagal menghapus komentar&error=' . $th->getMessage());

}

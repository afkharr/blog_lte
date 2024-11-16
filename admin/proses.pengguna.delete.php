<?php

require ('../config/koneksi.php');

$id = $_GET['id'];

try {
    $sql = "DELETE FROM user WHERE id = $id";
    $result = mysqli_query($koneksi, $sql);
    if ($result === true) {
        header('Location: pengguna.php?id=' . $id . '&status=berhasil&pesan=Berhasil menghapus pengguna');
    } else {
        header('Location: pengguna.php?id=' . $id . '&status=gagal&pesan=Gagal menghapus pengguna');
    }
} catch (\Throwable $th) {
    header('location: pengguna.php?id=' . $_GET['id'] . '&status=gagal&pesan=Gagal menghapus pengguna&error=' . $th->getMessage());

}

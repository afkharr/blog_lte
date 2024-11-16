<?php
session_start();
include_once ('../config/koneksi.php');

$id = $_GET['id'];
$data = $_POST;
$data['user_id'] = $_SESSION['user']['id'];

if (!empty($data)) {
    if (isset($id)) {

        $sql = "UPDATE blog SET title='" . $data['title'] . "', deskripsi='" . $data['deskripsi'] . "',";

        if (isset($data['thumbnail']) && !empty($data['thumbnail']) && $data['thumbnail'] !== "" && $data['thumbnail'] !== null) {
            $sql .= " thumbnail='" . $data['thumbnail'] . "',";
        }

        $sql .= " body='" . $data['content'] . "', tanggal='" . $data['tanggal'] . "' WHERE id='$id';";

        try {
            $result = mysqli_query($koneksi, $sql);
            if ($result === true) {
                header('location: postingan.edit.php?id=' . $_GET['id'] . '&status=berhasil&pesan=Berhasil mengupdate postingan');
            } else {
                header('location: postingan.edit.php?id=' . $_GET['id'] . '&status=gagal&pesan=Gagal mengupdate postingan');
            }
        } catch (\Throwable $th) {
            header('location: postingan.edit.php?id=' . $_GET['id'] . '&status=gagal&pesan=Gagal mengupdate postingan&error=' . $th->getMessage());
        }
    } else {
        header('location: postingan.edit.php?id=' . $_GET['id'] . '&status=gagal&pesan=Gagal mengupdate postingan&error=ID postingan tidak tersedia');
    }
} else {
    header('location: postingan.edit.php?id=' . $_GET['id'] . '&status=gagal&pesan=Gagal mengupdate postingan&error=Data postingan tidak diberikan');
}

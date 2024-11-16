<?php

include_once ('../config/koneksi.php');

$id = $_GET['id'];
$data = $_POST;
$data['md5_password'] = md5($data['password']) || "";

if (!empty($data) || !empty($id)) {
    if (!empty($data['password'])) {
        $sql = "UPDATE user SET name = '" . $data['name'] . "', email = '" . $data['email'] . "', role = '" . $data['role'] . "', password = '" . $data['md5_password'] . "' WHERE id = '" . $_GET['id'] . "' ";
    } else {
        $sql = "UPDATE user SET name = '" . $data['name'] . "', email = '" . $data['email'] . "', role = '" . $data['role'] . "' WHERE id = '" . $_GET['id'] . "' ";
        // die($sql);
    }
    try {
        $result = mysqli_query($koneksi, $sql);
        if ($result === true) {
            header('location: pengguna.edit.php?id=' . $id . '&status=berhasil&pesan=Berhasil memperbarui pengguna');
        } else {
            header('location: pengguna.edit.php?id=' . $id . '&status=berhasil&pesan=Gagal memperbarui pengguna');
        }
    } catch (\Throwable $th) {
        header('location: pengguna.edit.php?id=' . $id . '&status=gagal&pesan=Gagal memperbarui pengguna&error=' . $th->getMessage());
    }
} else {
    header('location: pengguna.edit.php?id=' . $id);
}
<?php

include_once ('../config/koneksi.php');

$data = $_POST;
$data['md5_password'] = md5($data['password']);

if (!empty($data)) {
    $sql = "INSERT INTO user (name,email,password,role) VALUES ('" . $data['name'] . "','" . $data['email'] . "','" . $data['md5_password'] . "','" . $data['role'] . "')";
    try {
        $result = mysqli_query($koneksi, $sql);
        if ($result === true) {
            header('location: pengguna.add.php?status=berhasil&pesan=Berhasil menambahkan pengguna');
        } else {
            header('location: pengguna.add.php?status=berhasil&pesan=Gagal menambahkan pengguna');
        }
    } catch (\Throwable $th) {
        header('location: pengguna.add.php?status=gagal&pesan=Gagal menambahkan pengguna&error=' . $th->getMessage());
    }
} else {
    header('location: pengguna.add.php');
}
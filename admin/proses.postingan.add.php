<?php
session_start();
include_once ('../config/koneksi.php');

$data = $_POST;
$data['user_id'] = $_SESSION['user']['id'];

if (!empty($data)) {
    $sql = "INSERT INTO blog (title, deskripsi, thumbnail, body, tanggal, user_id) VALUES ('" . $data['title'] . "', '" . $data['deskripsi'] . "', '" . $data['thumbnail'] . "', '" . $data['content'] . "', '" . $data['tanggal'] . "', '" . $data['user_id'] . "');";
    try {
        $result = mysqli_query($koneksi, $sql);
        if ($result === true) {
            header('location: postingan.php?status=berhasil&pesan=Berhasil menambahkan postingan');
        } else {
            header('location: postingan.add.php?status=berhasil&pesan=Gagal menambahkan postingan');
        }
    } catch (\Throwable $th) {
        header('location: postingan.add.php?status=gagal&pesan=Gagal menambahkan postingan&error=' . $th->getMessage());
    }
} else {
    header('location: postingan.add.php');
}
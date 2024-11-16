<?php
session_start();
require ('config/koneksi.php');

if (!isset($_POST) || empty($_POST)) {
    return header('location: index.php');
}

$data = $_POST;
$data['user_id'] = $_SESSION['user']['id'];
$data['id'] = $_GET['id'];

try {
    $sql = "INSERT INTO komentar (text, user_id, blog_id) VALUES ('" . $data['text'] . "', '" . $data['user_id'] . "', '" . $data['id'] . "')";
    mysqli_query($koneksi, $sql);
    return header('location: article.php?id=' . $data['id']);
} catch (\Throwable $th) {
    return header('location: article.php?id=' . $data['id'] . "&error=" . $th->getMessage());
}
<?php
session_start();

if(isset($_GET['id']))
{
    $id = $_GET['id'];
}

require ('config/koneksi.php');
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = md5($password);

    $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$hashed_password'";
    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        $_SESSION['user'] = $user;

        if(!empty($id))
        {
            header("Location: article.php?id=" . $id . '#komentar');
            exit();
        }else{
            header("Location: index.php"); // Redirect to dashboard or any authenticated page
            exit();
        }
    } else {
        header('location: login.php?status=gagal&pesan=Email atau Password salah!');
        exit();
    }
} else {
    header('location: login.php');
    exit();
}
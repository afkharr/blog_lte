<?php
session_start();

if(isset($_GET['id']))
{
    $id = $_GET['id'];
}

require ('config/koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all fields are filled
    if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['name'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $name = $_POST['name'];

        // Check if the email is already registered
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($koneksi, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Email already exists
            header('location: register.php?pesan=Email sudah terdaftar!');
            exit();
        } else {
            // Hash the password
            $hashed_password = md5($password);

            // Insert the new user into the database
            $sql = "INSERT INTO user (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
            if (mysqli_query($koneksi, $sql)) {
                // Registration successful
                if(!empty($id))
                {
                    header('location: login.php?status=berhasil&pesan=Registrasi berhasil, silakan login!&id=' . $id);
                    exit();
                }else{
                    header('location: login.php?status=berhasil&pesan=Registrasi berhasil, silakan login!');
                    exit();
                }
            } else {
                // Registration failed
                header('location: register.php?status=gagal&pesan=Registrasi gagal, silakan coba lagi!');
                exit();
            }
        }
    } else {
        // Fields are empty
        header('location: register.php?status=gagal&pesan=Semua bidang harus diisi!');
        exit();
    }
} else {
    // Not a POST request
    header('location: register.php');
    exit();
}
?>
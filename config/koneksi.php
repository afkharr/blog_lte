<?php

try {
    $koneksi = mysqli_connect("localhost", "root", "", "blog_afkar1");
} catch (\Throwable $th) {
    //throw $th;
    die('Error : ' . $th->getMessage());
}
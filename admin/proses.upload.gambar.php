<?php

if ($_FILES['file']['name']) {
    if (!$_FILES['file']['error']) {
        $name = md5(rand(100, 200));
        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $filename = $name . '.' . $ext;
        $destination = '../assets/images/' . $filename; // Change this directory
        $location = $_FILES["file"]["tmp_name"];

        if (move_uploaded_file($location, $destination)) {
            // Auto-detect the URL
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $host = $_SERVER['HTTP_HOST'];
            $directory = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
            $url = $protocol . $host . '/blog_lte/assets/images/' . $filename;

            echo $url;
        } else {
            echo 'Ooops! There was a problem moving the uploaded file.';
        }
    } else {
        echo 'Ooops! Your upload triggered the following error: ' . $_FILES['file']['error'];
    }
}

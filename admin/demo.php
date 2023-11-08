<?php

if (isset($_POST['update']) && ($_POST['update'])) {
    $errror = [];
    $file = $_FILES['imageFiles'];
    $size_allow = 10;
    $filename = $file['name'];
    $filename = explode('.', $filename);
    $ext = end($filename);
    $new_file = md5(uniqid()) . '.' . $ext;
    $allow_ext = ['png', 'jpg', 'jpeg'];
    $img_final = "../img/uploads/" . $new_file;
    var_dump($img_final);
    if (in_array($ext, $allow_ext)) {
        $size = $file['size'] / 1024 / 1024;
        if ($size <= $size_allow) {
            $upload = move_uploaded_file($file['tmp_name'], '../img/uploads/' . $new_file);
            if (!$upload) {
                $errror[] = 'upload_err';
            }
        } else {
            $errror[] = 'size_err';
        }
    } else {
        $errror[] = 'ext_err';
    }
}
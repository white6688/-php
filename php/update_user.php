<?php
include 'conn_db.php';
error_reporting(0);
session_start();

function update_pwd($username,$newPassword){
    $username = $_POST['username'];
    if (empty($username)) {
        return "用户名不能为空";
    }
    $sql="select * from users where username='$username'";
    $check=select_mysqli($sql);
    if(empty($check)){
        return '用户不存在';
    }

    $newPassword = $_POST['newPassword'];
    if (empty($newPassword)) {
        return "新密码不能为空";
    }
    $sql = "UPDATE users SET password = '$newPassword' WHERE username = '$username'";
    $re = alter_mysqli($sql);
    if ($re) {
        return "密码修改成功";
    } else {
        return "修改失败";
    }
}

function update_img($file){
    $username = $_POST['username'];
    $file_name = $file['name'];
    $tmp_name = $file['tmp_name'];
    $type = $file['type'];
    if ($_FILES['avatar']['error'] == 0) {
        if ($type == 'image/jpeg' || $type == 'image/png') {
            move_uploaded_file($tmp_name, "../img/$file_name");
            alter_mysqli("UPDATE users SET photo = 'img/$file_name' WHERE username = '$username'");
            return "上传成功";
        } else {
            return "上传失败";
        }
    }
}

$username = $_POST['username'];
$newPassword = $_POST['newPassword'];
$file = $_FILES['avatar'];
$re_pwd=update_pwd($username,$newPassword);
$re_img=update_img($file);
echo $re_pwd.'，'.$re_img;

?>
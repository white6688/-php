<?php
include 'conn_db.php';

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$permission = $_REQUEST['permission'];

// 更新用户数据到数据库
$sql = "UPDATE users SET password = '$password', authority = '$permission' WHERE username = '$username'";

$re = alter_mysqli($sql);

if ($re) {
    echo "<script>alert('用户编辑成功'); window.location.href = '../system.html';</script>";
} else {
    echo "<script>alert('Error'); window.location.href = '../system.html';</script>";
}


?>



